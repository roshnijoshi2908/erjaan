<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for category
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Responses\Supplier\Category\CreateResponse;
use App\Http\Responses\Supplier\Category\DestroyResponse;
use App\Http\Responses\Supplier\Category\EditResponse;
use App\Http\Responses\Supplier\Category\IndexResponse;
use App\Http\Responses\Supplier\Category\StoreResponse;
use App\Http\Responses\Supplier\Category\UpdateResponse;
use App\Repositories\SupplierCategoryRepository;
use App\Rules\NoTags;
use Illuminate\Http\Request;
use Validator;

class Supplier extends Controller {
    
    /**
     * The proposal repository instance.
     */
    protected $supplierCategoryrepo;

    public function __construct(SupplierCategoryRepository $supplierCategoryrepo) {

        //parent
        parent::__construct();

        //authenticated
        $this->middleware('auth');

        // $this->middleware('proposalTemplatesMiddlewareIndex')->only([
        //     'index',
        //     'create',
        //     'store',
        //     'update',
        // ]);

        // $this->middleware('proposalTemplatesMiddlewareEdit')->only([
        //     'edit',
        //     'update',
        // ]);

        // $this->middleware('proposalTemplatesMiddlewareCreate')->only([
        //     'create',
        //     'store',
        // ]);

        // $this->middleware('proposalTemplatesMiddlewareDestroy')->only([
        //     'destroy',
        // ]);

        $this->supplierCategoryrepo = $supplierCategoryrepo;
    }

    /**
     * Display a listing of templates
     * @urlquery
     *    - [page] numeric|null (pagination page number)
     *    - [source] ext|null  (ext: when called from embedded pages)
     *    - [action] load | null (load: when making additional ajax calls)
     * @return blade view | ajax view
     */
    public function index() {

        //get team members
        $categorySupplier = $this->supplierCategoryrepo->search();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('supplierCategory'),
            'supplierCategory' => $categorySupplier,
        ];

        //show the view
        return new IndexResponse($payload);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
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
            'category_name.required' => __('lang.supplier_category') . '-' . __('lang.is_required'),
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
        if (\App\Models\SupplierCategory::where('category_name', request('category_name'))
            ->exists()) {
            abort(409, __('lang.category_already_exists'));
        }
        
        $supplierCategory = new \App\Models\SupplierCategory();
        $supplierCategory->category_name = request('category_name');
        $supplierCategory->category_creatorid = auth()->id();
        $supplierCategory->save();
        
        $supplierCategoryId = $supplierCategory->supplier_category_id;
         
        //count rows
        $supplierCategory = $this->supplierCategoryrepo->search();
        $count = count($supplierCategory);
        
        
        //get the template object (friendly for rendering in blade template)
        $supplierCategory = $this->supplierCategoryrepo->search($supplierCategoryId);

        //reponse payload
        $payload = [
            'supplierCategory' => $supplierCategory,
            'count' => $count,
        ];

        //process reponse
        return new StoreResponse($payload);
    }

    /**
     * Display the specified resource.
     * @param int $id resource id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        //page settings
        $page = $this->pageSettings('edit');

        //get the proposal
        $supplierCategory = $this->supplierCategoryrepo->search($id);

        //not found
        if (!$supplierCategory = $supplierCategory->first()) {
            abort(409, __('lang.hello'));
        }

        //reponse payload
        $payload = [
            'page' => $page,
            'supplierCategory' => $supplierCategory,
        ];

        //response
        return new EditResponse($payload);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id resource id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        //get the proposal
        $supplierCategory = $this->supplierCategoryrepo->search($id);

        //not found
        if (!$supplierCategory = $supplierCategory->first()) {
            abort(409, 'The requested proposal could not be loaded');
        }

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'supplierCategory' => $supplierCategory,
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
        $supplierCategory = \App\Models\SupplierCategory::Where('supplier_category_id', $id)->first();

        //custom error messages
        $messages = [
            'category_name.required' => __('lang.supplier_category') . '-' . __('lang.is_required'),
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
        $supplierCategory->category_name = request('category_name');
        $supplierCategory->save();

        //get proposal
        $supplierCategory = $this->supplierCategoryrepo->search($id);

        //reponse payload
        $payload = [
            'supplierCategory' => $supplierCategory,
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
        if (!\App\Models\SupplierCategory::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $categories = $this->supplierCategoryrepo->search($id);
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
                __('lang.supplier'),
                __('lang.supplier_category'),
            ],
            'meta_title' => __('lang.supplier_category') . ' - ' . __('lang.supplier'),
            'heading' => __('lang.supplier_category'),
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'supplier',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_suppliers' => 'active',
            'submenu_suppliers_category' => 'active',
            'sidepanel_id' => 'sidepanel-filter-supplier',
            'dynamic_search_url' => url('supplier/category/search?action=search&supplier_category_id=' . request('supplier_category_id')),
            'add_button_classes' => 'add-edit-supplier-category-button',
            'load_more_button_route' => 'supplier',
            'source' => 'list',
        ];

        //return
        return $page;
    }
}