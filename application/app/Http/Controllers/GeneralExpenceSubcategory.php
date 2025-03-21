<?php 

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for purchase
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\GeneralExpenceRepository;
use App\Repositories\GeneralExpenceCategoryRepository;
use App\Repositories\GeneralExpenceSubcategoryRepository;
use App\Http\Responses\GeneralExpence\Subcategory\IndexResponse;
use App\Http\Responses\GeneralExpence\Subcategory\CreateResponse;
use App\Http\Responses\GeneralExpence\Subcategory\StoreResponse;
use App\Http\Responses\GeneralExpence\Subcategory\EditResponse;
use App\Http\Responses\GeneralExpence\Subcategory\UpdateResponse;
use App\Http\Responses\GeneralExpence\Subcategory\DestroyResponse;
use App\Rules\NoTags;
use Illuminate\Http\Request;
use Validator;

class GeneralExpenceSubcategory extends Controller {
    
       protected $generalexpencecatrepo;
       protected $generalexpencesubcatrepo;
        /*protected $clientrepo;
        protected $projectrepo;
        protected $supplierrepo;*/
        
        
        public function __construct(GeneralExpenceCategoryRepository $generalexpencecatrepo, GeneralExpenceSubcategoryRepository $generalexpencesubcatrepo){

            $this->generalexpencecatrepo = $generalexpencecatrepo;
            $this->generalexpencesubcatrepo = $generalexpencesubcatrepo;
            $this->middleware('auth');
            
        }

    /**
     * Display a listing of purchases
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
       $generalexpencesubcat = $this->generalexpencesubcatrepo->search();
        
         //reponse payload
        $payload = [
            'page' => $this->pageSettings('general_expense_subcategory'),
            'generalexpencesubcat' => $generalexpencesubcat,
        ];
        
        return new IndexResponse($payload);
    }  
    
     public function create() {
        
        $generalExpenceCategory = $this->generalexpencecatrepo->search();
        
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'generalExpenceCategory'=> $generalExpenceCategory
           
        ];
    
        //show the form
        return new CreateResponse($payload);
    }
    
     public function store() {

        //custom error messages
        $messages = [
            'expense_subcategory_name.required' => __('lang.general_expence_subcategory') . '-' . __('lang.is_required'),
            'expence_categoryid.required' =>  __('lang.general_expence_category') . '-' . __('lang.is_required'),
        ];

        //validate
        $validator = Validator::make(request()->all(), [
            'expense_subcategory_name' => [
                'required',
                new NoTags,
            ],
            'expence_categoryid' => [
                'required',
            ],
        ], $messages);

        //errors
        if ($validator->fails()) {
            $errors = $validator->errors();
            $messages = '';
            foreach ($errors->all() as $message) {
                $messages .= "<li>$message</li>";
            }

            abort(409, $messages);
        }
        
          //check duplicates
        if (\App\Models\GeneralExpenceSubcategory::where('expense_subcategory_name', request('expense_subcategory_name'))
            ->exists()) {
            abort(409, __('lang.subcategory_already_exists'));
        }
        
        $generalExpenceSubcategory = new \App\Models\GeneralExpenceSubcategory();
        $generalExpenceSubcategory->expense_subcategory_name = request('expense_subcategory_name');
        $generalExpenceSubcategory->expense_category_id = request('expence_categoryid');
        $generalExpenceSubcategory->subcategory_creatorid = auth()->id();
        $generalExpenceSubcategory->save();
        
        $generalExpenceSubcategoryId = $generalExpenceSubcategory->expense_subcategory_id;
         
        //count rows
        $generalExpenceSubcategory = $this->generalexpencesubcatrepo->search();
        $count = count($generalExpenceSubcategory);
        
        
        //get the template object (friendly for rendering in blade template)
        $generalExpenceSubcategory = $this->generalexpencesubcatrepo->search($generalExpenceSubcategoryId);

        //reponse payload
        $payload = [
            'generalexpencesubcat' => $generalExpenceSubcategory,
            'count' => $count,
        ];

        //process reponse
        return new StoreResponse($payload);
    }
    
        /**
     * Show the form for editing the specified resource.
     * @param int $id resource id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        //get the proposal
        $generalExpenceSubcategory = $this->generalexpencesubcatrepo->search($id);
        $generalExpenceCategory = $this->generalexpencecatrepo->search();

        //not found
        if (!$generalExpenceSubcategory = $generalExpenceSubcategory->first()) {
            abort(409, 'The requested proposal could not be loaded');
        }

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'generalexpencesubcat' => $generalExpenceSubcategory,
            'generalExpenceCategory' => $generalExpenceCategory
        ];

        //response
        return new EditResponse($payload);
    }
    
    /**
     * Update the specified resource in storage.
     * @param int $id resource id
     * @return \Illuminate\Http\Response
     */
    public function update($id) {

        //get the template
        $generalExpenceSubcategory = \App\Models\GeneralExpenceSubcategory::Where('expense_subcategory_id', $id)->first();

        //custom error messages
        $messages = [
            'expense_subcategory_name.required' => __('lang.general_expence_subcategory') . '-' . __('lang.is_required'),
        ];

        //validate
        $validator = Validator::make(request()->all(), [
            'expense_subcategory_name' => 'required',
        ], $messages);

        //errors
        if ($validator->fails()) {
            $errors = $validator->errors();
            $messages = '';
            foreach ($errors->all() as $message) {
                $messages .= "<li>$message</li>";
            }

            abort(409, $messages);
        }

        //update
        $generalExpenceSubcategory->expense_subcategory_name = request('expense_subcategory_name');
        $generalExpenceSubcategory->expense_category_id = (int) request('expence_categoryid');
        $generalExpenceSubcategory->save();

        //get category
        $generalExpenceSubcategory = $this->generalexpencesubcatrepo->search($id);
        

        //reponse payload
        $payload = [
            'generalexpencesubcat' => $generalExpenceSubcategory,
            'id' => $id,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }
    
        /**
     * Remove the specified item from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

       //get record
        if (!\App\Models\GeneralExpenceSubcategory::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $subcategories = $this->generalexpencesubcatrepo->search($id);
        $subcategory = $subcategories->first();

        //delete the subcategory
        $subcategory->delete();

        //reponse payload
        $payload = [
            'subcategory' => $id,
        ];

        //generate a response
        return new DestroyResponse($payload);
    }
    
    private function pageSettings($section = '', $data = []) {

        //common settings
        $page = [
            'crumbs' => [
                __('lang.general_expence'),
                __('lang.general_expence_subcategory')
            ],
            'meta_title' => __('lang.general_expence'),
            'heading' => __('lang.general_expence_subcategory'),
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'generalexpencesubcategory',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_general_expence' => 'active',
            'submenu_generalexpences_subcategory' => 'active',
            // 'submenu_purchase_request' => 'active',
            // 'submenu_gm_approvals' => 'active',
            'sidepanel_id' => 'sidepanel-filter-expense-subcategory',
            'dynamic_search_url' => url('general-expense/subcategory/search?action=search&expense_subcategory_id=' . request('expense_subcategory_id')),
            'add_button_classes' => 'add-edit-subcategory-button',
            'load_more_button_route' => 'generalexpencesubcategory',
            'source' => 'list',
        ];

        config([
            //visibility - add project buttton
            'visibility.list_page_actions_add_button' => true,
            //visibility - filter button
            'visibility.list_page_actions_filter_button' => false,
            //visibility - search field
            'visibility.list_page_actions_search' => false,
            //visibility - toggle stats
            'visibility.stats_toggle_button' => false,
            'visibility.left_menu_toggle_button' => true,
        ]);

        $page += [
            'add_modal_title' => __('lang.add_subcategory'),
            'add_modal_create_url' => url('general-expense/subcategory/create?generalexpence_subcategory_id=' . request('expense_category_id') . '&generalexpence_type=' . request('generalexpence_type') . '&filter_category=' . request('filter_category')),
            'add_modal_action_url' => url('general-expense/subcategory'),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
            'add_modal_size' => 'modal-sm',
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
