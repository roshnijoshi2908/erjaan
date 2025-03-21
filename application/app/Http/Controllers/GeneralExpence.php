<?php 

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for general-expence
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\GeneralExpenceRepository;
use App\Repositories\GeneralExpenceCategoryRepository;
use App\Repositories\AttachmentRepository;
use App\Repositories\GeneralExpenceSubcategoryRepository;
use App\Repositories\EventRepository;
use App\Repositories\UserRepository;
use App\Repositories\EventTrackingRepository;
use App\Http\Responses\GeneralExpence\IndexResponse;
use App\Http\Responses\GeneralExpence\CreateResponse;
use App\Http\Responses\GeneralExpence\StoreResponse;
use App\Rules\NoTags;
use Illuminate\Http\Request;
use Validator;


class GeneralExpence extends Controller {
    
       protected $generalexpencerepo;
        /*protected $clientrepo;
        protected $projectrepo;
        protected $supplierrepo;*/
        
        
        public function __construct(GeneralExpenceRepository $generalexpencerepo, GeneralExpenceCategoryRepository $generalexpencecatrepo, GeneralExpenceSubcategoryRepository $generalexpencesubcatrepo, AttachmentRepository $attachmentrepo, EventRepository $eventrepo,
        EventTrackingRepository $trackingrepo, UserRepository $userrepo){
            $this->generalexpencerepo = $generalexpencerepo;
            $this->generalexpencecatrepo = $generalexpencecatrepo;
            $this->generalexpencesubcatrepo = $generalexpencesubcatrepo;
            $this->attachmentrepo = $attachmentrepo;
            $this->eventrepo = $eventrepo;
            $this->trackingrepo = $trackingrepo;
            $this->userrepo = $userrepo;
            
             //authenticated
            $this->middleware('auth');
            
        }

    /**
     * Display a listing of purchases
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
       $generalexpence = $this->generalexpencerepo->search();
       $generalexpencecat = $this->generalexpencecatrepo->search();
       $generalexpencesubcat = $this->generalexpencesubcatrepo->search();
        
         //reponse payload
        $payload = [
            'page' => $this->pageSettings('generalexpence'),
            'generalexpence' => $generalexpence,
            'change_status' => 0,
            'accountant' => 0,
            'generalexpencecat' => $generalexpencecat,
            'generalexpencesubcat' => $generalexpencesubcat
        ];
        
        return new IndexResponse($payload);
    }   
    
     public function create() {
         
         $generalExpenceCategory = $this->generalexpencecatrepo->search();
        
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'generalExpenceCategory' => $generalExpenceCategory,
        ];
    
        //show the form
        return new CreateResponse($payload);
    }
    
    public function getSubcategories($categoryId) {
        $subcategories = \App\Models\GeneralExpenceSubcategory::where('expense_category_id', $categoryId)->get();
        return response()->json($subcategories);
    }
    
    public function store() {
      
        
        $messages = [
            'purpose.required' => __('lang.purpose') . '-' . __('lang.is_required'),
            'comments.required' => __('lang.comments') . '-' . __('lang.is_required'),
            'amount.required' => __('lang.amount') . '-' . __('lang.is_required'),
            'expence_categoryid.required' => __('lang.expence_category') . '-' . __('lang.is_required'),
            'expence_subcategoryid.required' => __('lang.expence_subcategory') . '-' . __('lang.is_required'),
        ];
        
         //validate
            $validator = Validator::make(request()->all(), [
            'purpose' => 'required',
            'comments' => 'required',
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'expence_categoryid' => 'required',
            'expence_subcategoryid' => 'required',
        ], $messages);
        
         if ($validator->fails()) {
            $errors = $validator->errors();
            $messages = '';
            foreach ($errors->all() as $message) {
                $messages .= "<li>$message</li>";
            }

            abort(409, $messages);
        }
        
        $generalExpence = new \App\Models\GeneralExpence();
        $generalExpence->purpose = request('purpose');
        $generalExpence->comments = request('comments');
        $generalExpence->amount = request('amount');
        $generalExpence->category = request('expence_categoryid');
        $generalExpence->subcategory = request('expence_subcategoryid');
        
        $generalExpence->status = 'new';
        // $generalExpence->paid = request('paid');
        // $generalExpence->bank = request('selected_the_bank');
     
        
        $generalExpence->created_by = auth()->id();
        $generalExpence->save();
        
        $generalExpenceId = $generalExpence->generalexpence_id;
        
        $generalExpence = $this->generalexpencerepo->search();
        $count = count($generalExpence);
        
        
        //get the template object (friendly for rendering in blade template)
        $generalExpence = $this->generalexpencerepo->search($generalExpenceId);
        
         //[save attachments] loop through and save each attachment
        if (request()->filled('attachments')) {
            foreach (request('attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => request('expense_clientid'),
                    'attachmentresource_type' => 'general_expense_request',
                    'attachmentresource_id' => $generalExpenceId,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        
        $generalexpencecat = $this->generalexpencecatrepo->search();
        $generalexpencesubcat = $this->generalexpencesubcatrepo->search();
        
        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'general_expence',
            'event_item_id' => $generalExpenceId,
            'event_item_lang' => 'event_created_general_expence',
            'event_item_content' => __('lang.general_expence'),
            'event_item_content2' => '',
            'event_parent_type' => 'general_expence_gm_approver',
            'event_parent_id' => $generalExpenceId,
            'event_parent_title' => 'general_expence',
            'event_clientid' =>null,
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'eventresource_type' => 'general_expence',
            'eventresource_id' =>  null,
            'event_notification_category' => 'notifications_tasks_activity',

        ];
        
        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users (main client)
            $users = $this->userrepo->getGenaralExpenceGmApproversUsers('ids');
            
            //record notification
            $this->trackingrepo->recordEvent($data, $users, $event_id);
        }

        //reponse payload
        $payload = [
            'generalexpence' => $generalExpence,
            'count' => $count,
            'change_status' => 0,
            'accountant' => 0,
            'generalexpencecat' => $generalexpencecat,
            'generalexpencesubcat' => $generalexpencesubcat
        ];

        //process reponse
        return new StoreResponse($payload);
        
    }
    
    private function pageSettings($section = '', $data = []) {

        //common settings
        $page = [
            'crumbs' => [
                __('lang.general_expence'),
                __('lang.general_expence_request')
            ],
            'meta_title' => __('lang.general_expence'),
            'heading' => __('lang.general_expence_request'),
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'general_expence_request',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_general_expence' => 'active',
            'submenu_generalexpences' => 'active',
            // 'submenu_purchase_request' => 'active',
            // 'submenu_gm_approvals' => 'active',
            'sidepanel_id' => 'sidepanel-filter-general-expense',
            'dynamic_search_url' => url('general-expense/search?action=search&start_date=' . request('filter_start_date_start') . '&endDate=' . request('filter_start_date_end') . '&category=' . request('filter_general_expence_category') . '&subcategory=' . request('filter_general_expence_subcategory') ),
            'add_button_classes' => 'add-edit-general-expense-button',
            'load_more_button_route' => 'general-expense',
            'source' => 'list',
        ];

        config([
            //visibility - add project buttton
            'visibility.list_page_actions_add_button' => true,
            //visibility - filter button
            'visibility.list_page_actions_filter_button' => true,
            //visibility - search field
            'visibility.list_page_actions_search' => false,
            //visibility - toggle stats
            'visibility.stats_toggle_button' => false,
            'visibility.left_menu_toggle_button' => true,
        ]);

        $page += [
            'add_modal_title' => __('lang.add_expence_req'),
            'add_modal_create_url' => url('general-expense/create?generalexpence_id=' . request('generalexpence_id') . '&generalexpence_type=' . request('generalexpence_type') . '&filter_category=' . request('filter_category')),
            'add_modal_action_url' => url('general-expense'),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        if ($section == 'create') {
            $page += [
                'section' => 'create',
            ];
            return $page;
        }

        //return
        return $page;
    }
    
    
    
}
