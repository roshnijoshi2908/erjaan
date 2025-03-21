<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for supplier
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\Supplier\CreateResponse;
use App\Http\Responses\Templates\Proposals\DestroyResponse;
use App\Http\Responses\Supplier\EditResponse;
use App\Http\Responses\Supplier\IndexResponse;
use App\Http\Responses\Supplier\StoreResponse;
use App\Http\Responses\Supplier\ShowResponse;
use App\Http\Responses\Supplier\UpdateResponse;
use App\Repositories\SupplierRepository;
use App\Repositories\SupplierCategoryRepository;
use App\Rules\NoTags;
use Illuminate\Http\Request;
use Validator;

class Supplier extends Controller {

    /**
     * The proposal repository instance.
     */
    protected $supplierrepo;

    public function __construct(SupplierRepository $supplierrepo) {

        //parent
        // parent::__construct();

        //authenticated
        // $this->middleware('auth');

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

        $this->supplierrepo = $supplierrepo;
        
        
        //authenticated
        $this->middleware('auth');
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
        $supplier = $this->supplierrepo->search();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('supplier'),
            'supplier' => $supplier,
        ];

        //show the view
        return new IndexResponse($payload);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(SupplierCategoryRepository $supplierCategoryrepo) {
        
        $categories = $supplierCategoryrepo->get();
        
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'categories' => $categories
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
            'supplier_name.required' => __('lang.supplier_name') . '-' . __('lang.is_required'),
            'supplier_address.required' => __('lang.supplier_address') . '-' . __('lang.is_required'),
            'supplier_telephone.required' => __('lang.supplier_telephone') . '-' . __('lang.is_required'),
            'supplier_categoryid.required' => __('lang.supplier_categoryid') . '-' . __('lang.is_required'),
            'supplier_contact_person_name.required' => __('lang.supplier_contact_person_name') . '-' . __('lang.is_required'),
            'supplier_contact_person_mobile.required' => __('lang.supplier_contact_person_mobile') . '-' . __('lang.is_required'),
            'supplier_created_date.required' => __('lang.supplier_created_date') . '-' . __('lang.is_required'),
        ];

        //validate
        $validator = Validator::make(request()->all(), [
            'supplier_name' => [
                'required',
                new NoTags,
            ],
            'supplier_address' => 'required',
            'supplier_telephone' => 'required|numeric',
            'supplier_categoryid' => 'required',
            'supplier_contact_person_name' => 'required',
            'supplier_contact_person_mobile' => 'required|numeric',
            'supplier_created_date' => 'required',
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

        $supplier = new \App\Models\Supplier();
        $supplier->supplier_created_by = auth()->id();
        $supplier->supplier_name = request('supplier_name');
        $supplier->supplier_address = request('supplier_address');
        $supplier->supplier_telephone = request('supplier_telephone');
        $supplier->supplier_categoryid = request('supplier_categoryid');
        $supplier->supplier_contact_person_name = request('supplier_contact_person_name');
        $supplier->supplier_contact_person_mobile = request('supplier_contact_person_mobile');
        $supplier->supplier_created_date = request('supplier_created_date');
        $supplier->save();

        $supplierId = $supplier->supplier_id;

        //count rows
        $supplier = $this->supplierrepo->search();
        $count = count($supplier);

        //get the supplier object (friendly for rendering in blade supplier)
        $supplier = $this->supplierrepo->search($supplierId);

        //reponse payload
        $payload = [
            'supplier' => $supplier,
            'count' => $count,
        ];
        
        // return redirect('/supplier');
        //process reponse
        return new StoreResponse($payload);

    }

    /**
     * Display the specified resource.
     * @param int $id resource id
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierCategoryRepository $supplierCategoryrepo,$id) {
        
        //page settings
        $page = $this->pageSettings('show');

        //get the proposal
        $supplier = $this->supplierrepo->search($id);

        $categories = $supplierCategoryrepo->get();
        
        //not found
        if (!$supplier = $supplier->first()) {
            abort(409, __('lang.hello'));
        }

        //reponse payload
        $payload = [
            'page' => $page,
            'supplier' => $supplier,
            'categories' => $categories
        ];

        //response
        return new ShowResponse($payload);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id resource id
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplierCategoryRepository $supplierCategoryrepo,$id) {
    
        //get the proposal
        $supplier = $this->supplierrepo->search($id);

        $categories = $supplierCategoryrepo->get();

        //not found
        if (!$supplier = $supplier->first()) {
            abort(409, 'The requested proposal could not be loaded');
        }

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'supplier' => $supplier,
            'categories' => $categories,
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
        $supplier = \App\Models\Supplier::Where('supplier_id', $id)->first();

        //custom error messages
         $messages = [
            'supplier_name.required' => __('lang.supplier_name') . '-' . __('lang.is_required'),
            'supplier_address.required' => __('lang.supplier_address') . '-' . __('lang.is_required'),
            'supplier_telephone.required' => __('lang.supplier_telephone') . '-' . __('lang.is_required'),
            'supplier_categoryid.required' => __('lang.supplier_categoryid') . '-' . __('lang.is_required'),
            'supplier_contact_person_name.required' => __('lang.supplier_contact_person_name') . '-' . __('lang.is_required'),
            'supplier_contact_person_mobile.required' => __('lang.supplier_contact_person_mobile') . '-' . __('lang.is_required'),
            'supplier_created_date.required' => __('lang.supplier_created_date') . '-' . __('lang.is_required'),
        ];

        //validate
        $validator = Validator::make(request()->all(), [
            'supplier_name' => 'required',
            'supplier_address' => 'required',
            'supplier_telephone' => 'required|numeric',
            'supplier_categoryid' => 'required',
            'supplier_contact_person_name' => 'required',
            'supplier_contact_person_mobile' => 'required|numeric',
            'supplier_created_date' => 'required',
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
        $supplier->supplier_name = request('supplier_name');
        $supplier->supplier_address = request('supplier_address');
        $supplier->supplier_telephone = request('supplier_telephone');
        $supplier->supplier_categoryid = request('supplier_categoryid');
        $supplier->supplier_contact_person_name = request('supplier_contact_person_name');
        $supplier->supplier_contact_person_mobile = request('supplier_contact_person_mobile');
        $supplier->supplier_created_date = request('supplier_created_date');
        $supplier->save();

        //get proposal
        $suppliers = $this->supplierrepo->search($id);

        //reponse payload
        $payload = [
            'supplier' => $suppliers,
            'id' => $id,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

    /**
     * Remove the specified item from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy() {

        //delete each record in the array
        $allrows = array();
        foreach (request('ids') as $id => $value) {
            //only checked template
            if ($value == 'on') {
                if ($template = \App\Models\ProposalTemplate::Where('proposal_template_id', $id)->first()) {
                    //delete client
                    $template->delete();
                }
                //add to array
                $allrows[] = $id;
            }
        }
        //reponse payload
        $payload = [
            'allrows' => $allrows,
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
            ],
            'meta_title' => __('lang.supplier'),
            'heading' => __('lang.supplier'),
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'supplier',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_suppliers' => 'active',
            'submenu_supplier' => 'active',
            'sidepanel_id' => 'sidepanel-filter-supplier',
            'dynamic_search_url' => url('supplier/search?action=search&supplier_id=' . request('supplier_id')),
            'add_button_classes' => 'add-edit-supplier-button',
            'load_more_button_route' => 'supplier',
            'source' => 'list',
        ];
        
            //default modal settings (modify for sepecif sections)
         $page += [
            'add_modal_title' => __('lang.add_supplier'),
            'add_modal_create_url' => url('supplier/create'),
            'add_modal_action_url' => url('supplier?suppliertresource_id=' . request('supplierresource_id') . '&supplierresource_type=' . request('supplierresource_type') . '&filter_category=' . request('filter_category')),
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