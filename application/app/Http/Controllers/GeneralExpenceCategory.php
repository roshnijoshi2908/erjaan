<?php 

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for general expense category
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\GeneralExpenceCategoryRepository;
use App\Http\Responses\GeneralExpence\Category\IndexResponse;
use App\Http\Responses\GeneralExpence\Category\CreateResponse;
use App\Http\Responses\GeneralExpence\Category\StoreResponse;
use App\Http\Responses\GeneralExpence\Category\EditResponse;
use App\Http\Responses\GeneralExpence\Category\UpdateResponse;
use App\Http\Responses\GeneralExpence\Category\DestroyResponse;
use App\Repositories\ClientRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\SupplierRepository;
use App\Rules\NoTags;
use Illuminate\Http\Request;
use Validator;

class GeneralExpenceCategory extends Controller {
    
       protected $generalexpencecatrepo;
        /*protected $clientrepo;
        protected $projectrepo;
        protected $supplierrepo;*/
        
        
        public function __construct(GeneralExpenceCategoryRepository $generalexpencecatrepo/*,ClientRepository $clientrepo,ProjectRepository $projectrepo,SupplierRepository $supplierrepo*/){
            $this->generalexpencecatrepo = $generalexpencecatrepo;
            $this->middleware('auth');
            
        }

    /**
     * Display a listing of expense categories
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
       $generalexpencecat = $this->generalexpencecatrepo->search();
        
         //reponse payload
        $payload = [
            'page' => $this->pageSettings('general_expense_category'),
            'generalexpencecat' => $generalexpencecat,
        ];
        
        return new IndexResponse($payload);
    }   
    
     public function create() {
        
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
        ];
    
        //show the form
        return new CreateResponse($payload);
    }
    
        /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function store() {

        //custom error messages
        $messages = [
            'category_name.required' => __('lang.general_expence_category') . '-' . __('lang.is_required'),
        ];

        //validate
        $validator = Validator::make(request()->all(), [
            'category_name' => [
                'required',
                new NoTags,
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
        if (\App\Models\GeneralExpenceCategory::where('category_name', request('category_name'))
            ->exists()) {
            abort(409, __('lang.category_already_exists'));
        }
        
        $generalExpenceCategory = new \App\Models\GeneralExpenceCategory();
        $generalExpenceCategory->category_name = request('category_name');
        $generalExpenceCategory->category_creatorid = auth()->id();
        $generalExpenceCategory->save();
        
        $generalExpenceCategoryId = $generalExpenceCategory->expense_category_id;
         
        //count rows
        $generalExpenceCategory = $this->generalexpencecatrepo->search();
        $count = count($generalExpenceCategory);
        
        
        //get the template object (friendly for rendering in blade template)
        $generalExpenceCategory = $this->generalexpencecatrepo->search($generalExpenceCategoryId);

        //reponse payload
        $payload = [
            'generalexpencecat' => $generalExpenceCategory,
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
        $generalExpenceCategory = $this->generalexpencecatrepo->search($id);

        //not found
        if (!$generalExpenceCategory = $generalExpenceCategory->first()) {
            abort(409, 'The requested proposal could not be loaded');
        }

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'generalexpencecat' => $generalExpenceCategory,
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
        $generalExpenceCategory = \App\Models\GeneralExpenceCategory::Where('expense_category_id', $id)->first();

        //custom error messages
        $messages = [
            'category_name.required' => __('lang.general_expence_category') . '-' . __('lang.is_required'),
        ];

        //validate
        $validator = Validator::make(request()->all(), [
            'category_name' => 'required',
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
        $generalExpenceCategory->category_name = request('category_name');
        $generalExpenceCategory->save();

        //get category
        $generalExpenceCategory = $this->generalexpencecatrepo->search($id);

        //reponse payload
        $payload = [
            'generalexpencecat' => $generalExpenceCategory,
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
        if (!\App\Models\GeneralExpenceCategory::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $categories = $this->generalexpencecatrepo->search($id);
        $category = $categories->first();

        //delete the category
        $category->delete();

        //reponse payload
        $payload = [
            'category' => $id,
        ];

        //generate a response
        return new DestroyResponse($payload);
    }
    
    private function pageSettings($section = '', $data = []) {

        //common settings
        $page = [
            'crumbs' => [
                __('lang.general_expence'),
                __('lang.general_expence_category')
            ],
            'meta_title' => __('lang.general_expence'),
            'heading' => __('lang.general_expence_category'),
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'generalexpencecategory',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_general_expence' => 'active',
            'submenu_generalexpences_category' => 'active',
            // 'submenu_purchase_request' => 'active',
            // 'submenu_gm_approvals' => 'active',
            'sidepanel_id' => 'sidepanel-filter-expense-category',
            'dynamic_search_url' => url('general-expense/category/search?action=search&expense_category_id=' . request('expense_category_id')),
            'add_button_classes' => 'add-edit-category-button',
            'load_more_button_route' => 'generalexpencecategory',
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
            'add_modal_title' => __('lang.add_category'),
            'add_modal_create_url' => url('general-expense/category/create?generalexpence_category_id=' . request('expense_category_id') . '&generalexpence_type=' . request('generalexpence_type') . '&filter_category=' . request('filter_category')),
            'add_modal_action_url' => url('general-expense/category'),
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
