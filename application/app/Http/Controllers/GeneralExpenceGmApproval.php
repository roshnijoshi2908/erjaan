<?php 

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for purchase
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\GeneralExpence\IndexResponse;
use App\Http\Responses\GeneralExpence\GmApprovals\ChangeStatusResponse;
use App\Http\Responses\GeneralExpence\GmApprovals\UpdateResponse;
use App\Repositories\GeneralExpenceRepository;
use App\Repositories\GeneralExpenceCategoryRepository;
use App\Repositories\GeneralExpenceSubcategoryRepository;
use App\Repositories\EventRepository;
use App\Repositories\UserRepository;
use App\Repositories\EventTrackingRepository;

class GeneralExpenceGmApproval extends Controller {
    
        /**
        * The purchase repository instance.
        */
        protected $generalexpencerepo;
        
        public function __construct(GeneralExpenceRepository $generalexpencerepo,GeneralExpenceCategoryRepository $generalexpencecatrepo, GeneralExpenceSubcategoryRepository $generalexpencesubcatrepo,EventRepository $eventrepo,
        EventTrackingRepository $trackingrepo, UserRepository $userrepo){
            $this->generalexpencerepo = $generalexpencerepo;
            $this->generalexpencecatrepo = $generalexpencecatrepo;
            $this->generalexpencesubcatrepo = $generalexpencesubcatrepo;
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
            'page' => $this->pageSettings('purchase'),
            'generalexpence' => $generalexpence,
            'change_status' => 1,
            'accountant' => 0,
            'generalexpencecat' => $generalexpencecat,
            'generalexpencesubcat' => $generalexpencesubcat
        ];

        //show the view
        return new IndexResponse($payload);
    }    
    
    
    /**
     * Show the form for changing a gm Approvels status
     * @return \Illuminate\Http\Response
     */
    public function changeStatus() {
        
        
        //get the purchase
        $generalExpence = \App\Models\GeneralExpence::Where('generalexpence_id', request()->route('id'))->first();
        
        $generalexpencecat = $this->generalexpencecatrepo->search();
        $generalexpencesubcat = $this->generalexpencesubcatrepo->search();

        //reponse payload
        $payload = [
            'generalExpence' => $generalExpence,
            'change_status' => 1,
            'accountant' => 0,
            'generalexpencecat' => $generalexpencecat,
            'generalexpencesubcat' => $generalexpencesubcat
        ];

        //show the form
        return new ChangeStatusResponse($payload);
    }
    
    /**
     * change status expense status
     * @return \Illuminate\Http\Response
     */
    public function changeStatusUpdate() {

        //validate the purchases exists
        $generalExpence = \App\Models\GeneralExpence::Where('generalexpence_id', request()->route('id'))->first();
        
        $generalexpencecat = $this->generalexpencecatrepo->search();
        $generalexpencesubcat = $this->generalexpencesubcatrepo->search();

        //old status
        $old_status = $generalExpence->status;

        //update the status
        $generalExpence->status = request('status');
        $generalExpence->approved_by = auth()->id();
        
        $generalExpence->save();
        
         //get refreshed general-expense
        $generalExpence = $this->generalexpencerepo->search(request()->route('id'));
        
        
         if(request('status') == 'approved') {
             $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'general_expence',
            'event_item_id' => request()->route('id'),
            'event_item_lang' => 'event_approved_general_expence',
            'event_item_content' => __('lang.general_expence'),
            'event_item_content2' => '',
            'event_parent_type' => 'general_expence_accountant',
            'event_parent_id' => request()->route('id'),
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
            $users = $this->userrepo->getGenaralExpenceAccountantUsers('ids');
            
            //record notification
            $this->trackingrepo->recordEvent($data, $users, $event_id);
        }
         }
        
        
      
        //reponse payload
        $payload = [
            'generalexpence' => $generalExpence,
            'generalexpence_id' => request()->route('id'),
            'change_status' => 1,
            'accountant' => 0,
            'generalexpencecat' => $generalexpencecat,
            'generalexpencesubcat' => $generalexpencesubcat
        ];

        //show the form
        return new UpdateResponse($payload);
    }
    
   
    
    /**
     * basic page setting for this section of the app
     * @param string $section page section (optional)
     * @param array $data any other data (optional)
     * @return array
     */
     
    private function pageSettings($section = '', $data = []) {

        //common settings
        $page = [
            'crumbs' => [
                __('lang.general_expence'),
                __('lang.gm_approvals')
            ],
            'meta_title' => __('lang.general_expence'),
            'heading' => __('lang.gm_approvals'),
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'gm_approvals',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_general_expence' => 'active',
            'submenu_gm_approvals' => 'active',
            'sidepanel_id' => 'sidepanel-filter-gm-approvals',
            'dynamic_search_url' => url('general-expense/gm-approvals/search?action=search&purchase_id=' . request('purchase_id')),
            'add_button_classes' => 'edit-add-modal-button',
            'loaGmApprovalstton_route' => 'general-expense/gm-approvals',
            'source' => 'list',
        ];

        return $page;
    }
}
