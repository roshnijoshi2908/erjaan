<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for accounts
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\Accountant\IndexResponse;
use App\Http\Responses\Purchases\CreateResponse;
use App\Models\Purchase;
use App\Repositories\PurchasesRepository;
use App\Repositories\ClientRepository;
use App\Http\Responses\Accountant\UpdateResponse;
use App\Http\Responses\Accountant\EditResponse;

use App\Repositories\CustomFieldsRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

use App\Repositories\ProjectRepository;
use App\Repositories\SupplierRepository;
use App\Repositories\BankRepository;
use Validator;
class Accounts extends Controller
{

    /**
     * The purchase repository instance.
     */
    protected $purchaserepo;
    protected $clientrepo;
    protected $projectrepo;
    protected $supplierrepo;
    protected $customrepo;
    protected $bankrepo;



    public function __construct(PurchasesRepository $purchaserepo, ClientRepository $clientrepo, ProjectRepository $projectrepo, SupplierRepository $supplierrepo, CustomFieldsRepository $customrepo, BankRepository $bankrepo)
    {
        $this->purchaserepo = $purchaserepo;
        $this->clientrepo = $clientrepo;
        $this->projectrepo = $projectrepo;
        $this->supplierrepo = $supplierrepo;
        $this->customrepo = $customrepo;
        $this->bankrepo = $bankrepo;
                
        $this->middleware('auth');

    }

    /**
     * Display a listing of purchases
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $purchase = Purchase::where('purchase_status', 'approved')
            ->leftJoin('users', 'users.id', '=', 'purchases.purchase_creatorid')
            ->leftJoin('clients', 'clients.client_id', '=', 'purchases.purchase_clientid')
            ->leftJoin('projects', 'projects.project_id', '=', 'purchases.purchase_projectid')
            ->leftJoin('suppliers', 'suppliers.supplier_id', '=', 'purchases.purchase_supplierid')
            ->leftJoin('banks', 'banks.id', '=', 'purchases.selected_the_bank')->paginate(10);
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('accountant'),
            'templates' => $purchase,
        ];
       //show the view
        return new IndexResponse($payload);
    }


    public function create()
    {

        //get clients
        $client = $this->clientrepo->search();

        //get projects
        $project = $this->projectrepo->search();

        //get supplier
        $supplier = $this->supplierrepo->search();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'client' => $client,
            'project' => $project,
            'supplier' => $supplier,
        ];

        //show the form
        return new CreateResponse($payload);
    }
    
     /**
     * Show the form for editing the specified project
     * @param object CategoryRepository instance of the repository
     * @param int $id project id
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchasesRepository $purchaserepo,CategoryRepository $categoryrepo, $id)
    {

        //get the purchase
        $purchase = Purchase::leftJoin('users', 'users.id', '=', 'purchases.purchase_creatorid')
            ->leftJoin('clients', 'clients.client_id', '=', 'purchases.purchase_clientid')
            ->leftJoin('projects', 'projects.project_id', '=', 'purchases.purchase_projectid')
            ->leftJoin('suppliers', 'suppliers.supplier_id', '=', 'purchases.purchase_supplierid')->find($id);
            
            
        $banks = $this->bankrepo->search();




        //client categories
        $categories = $categoryrepo->get('project');

        

        // //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'purchase' => $purchase,
            'categories' => $categories,
            'fields' => $this->getCustomFields($purchase),
            'banks' => $banks
        ];

        // //response
        return new EditResponse($payload);
    }

    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //custom error messages
        $messages = [
            'purchase_clientid.required' => __('lang.purchase_clientid') . '-' . __('lang.is_required'),
            'purchase_projectid.required' => __('lang.purchase_projectid') . '-' . __('lang.is_required'),
            'purchase_supplierid.required' => __('lang.purchase_supplierid') . '-' . __('lang.is_required'),
            'purchase_request_date.required' => __('lang.purchase_request_date') . '-' . __('lang.is_required'),
            'purchase_items_list.required' => __('lang.purchase_items_list') . '-' . __('lang.is_required'),
            'costs_for_each_item.required' => __('lang.costs_for_each_item') . '-' . __('lang.is_required'),
            'total_cost.required' => __('lang.total_cost') . '-' . __('lang.is_required'),
            'approved_by.required' => __('lang.approved_by') . '-' . __('lang.is_required'),
            'pending_with.required' => __('lang.pending_with') . '-' . __('lang.is_required'),
        ];

        //validate
        $validator = Validator::make(request()->all(), [
            'purchase_clientid' => 'required',
            'purchase_projectid' => 'required',
            'purchase_supplierid' => 'required',
            'purchase_request_date' => 'required',
            'purchase_items_list' => 'required',
            'costs_for_each_item' => 'required',
            'total_cost' => 'required',
            'approved_by' => 'required',
            'pending_with' => 'required',
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

        $purchase = new \App\Models\Purchase();
        $purchase->purchase_creatorid = auth()->id();
        $purchase->purchase_clientid = request('purchase_clientid');
        $purchase->purchase_projectid = request('purchase_projectid');
        $purchase->purchase_supplierid = request('purchase_supplierid');
        $purchase->purchase_request_date = request('purchase_request_date');
        $purchase->purchase_items_list = request('purchase_items_list');
        $purchase->costs_for_each_item = request('costs_for_each_item');
        $purchase->total_cost = request('total_cost');
        $purchase->status = request('status');
        $purchase->approved_by = request('approved_by');
        $purchase->pending_with = request('pending_with');
        $purchase->paid = request('paid');
        $purchase->selected_the_bank = request('selected_the_bank');
        $purchase->save();

        $purchaseId = $purchase->purchase_id;

        //count rows
        $purchase = $this->purchaserepo->search();
        $count = count($purchase);

        //get the purchase object (friendly for rendering in blade purchase)
        $purchase = $this->purchaserepo->search($purchaseId);

        //reponse payload
        $payload = [
            'purchase' => $purchase,
            'count' => $count,
        ];

        return redirect()->back();
        //process reponse
        // return new StoreResponse($payload);

    }

    public function List_Purchase()
    {
       $purchase = Purchase::where('purchase_status', 'approved')
            ->leftJoin('users', 'users.id', '=', 'purchases.purchase_creatorid')
            ->leftJoin('clients', 'clients.client_id', '=', 'purchases.purchase_clientid')
            ->leftJoin('projects', 'projects.project_id', '=', 'purchases.purchase_projectid')
            ->leftJoin('suppliers', 'suppliers.supplier_id', '=', 'purchases.purchase_supplierid')->paginate(10);
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('accountant'),
            'templates' => $purchase,
        ];
        // dd($purchase);
       //show the view
        return new IndexResponse($payload);
    }


    /**
     * basic page setting for this section of the app
     * @param string $section page section (optional)
     * @param array $data any other data (optional)
     * @return array
     */
    private function pageSettings($section = '', $data = [])
    {

        //common settings
        $page = [
            'crumbs' => [
                __('lang.procurement'),
                __('lang.accountant')
            ],
            'meta_title' => __('lang.procurement'),
            'heading' => __('lang.accountant'),
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'accountant',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_procurement' => 'active',
            'submenu_accountant' => 'active',
            // 'submenu_purchase_request' => 'active',
            // 'submenu_gm_approvals' => 'active',
            'sidepanel_id' => 'sidepanel-filter-purchase',
            'dynamic_search_url' => url('purchase/search?action=search&purchase_id=' . request('purchase_id')),
            'add_button_classes' => 'add-edit-purchase-button',
            'load_more_button_route' => 'purchases',
            'source' => 'list',
        ];

        //return
        return $page;
    }
      /**
     * Update the specified resource in storage.
     * @param int $id resource id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id) {

            // Check if the record exists before trying to update
            $purchase = Purchase::find($id);
            if (!$purchase) {
                // If no record is found, redirect back with an error message
                return  new UpdateResponse();
            }
            // Validate the request input before updating (optional but recommended)
            $request->validate([
                'selected_the_bank' => 'required|string', // Adjust validation rules as per your needs
                'paid' => 'required|boolean', // Assuming 'paid' is a boolean
            ]);
            // Update the record with validated input
            $purchase->selected_the_bank = $request->selected_the_bank; // Fix the typo here
            $purchase->paid = $request->paid;
            $purchase->save(); // Use save() instead of update() to avoid potential issues
            //reponse payload
            
            $purchase = Purchase::where('purchase_status', 'approved')
                ->where('purchase_id', $id)
                ->leftJoin('users', 'users.id', '=', 'purchases.purchase_creatorid')
                ->leftJoin('clients', 'clients.client_id', '=', 'purchases.purchase_clientid')
                ->leftJoin('projects', 'projects.project_id', '=', 'purchases.purchase_projectid')
                ->leftJoin('suppliers', 'suppliers.supplier_id', '=', 'purchases.purchase_supplierid')
                ->leftJoin('banks', 'banks.id', '=', 'purchases.selected_the_bank')->paginate(10);
                
            $payload = [
                'page' => $this->pageSettings('accountant'),
                'templates' => $purchase,
            ];
            // Redirect back with success message
            return new UpdateResponse($payload);
     
    }
    
    
    
     /**
     * get all custom fields for clients
     *   - if they are being used in the 'edit' modal form, also get the current data
     *     from the cliet record. Store this temporarily in '$field->customfields_name'
     *     this will then be used to prefill data in the custom fields
     * @param model client model - only when showing the edit modal form
     * @return collection
     */
    public function getCustomFields($obj = '') {

        //set typs
        request()->merge([
            'customfields_type' => 'purchase',
            'filter_show_standard_form_status' => 'enabled',
            'sort_by' => 'customfields_position',
        ]);

        //show all fields
        config(['settings.custom_fields_display_limit' => 1000]);

        //get fields
        $fields = $this->customrepo->search();

        //when in editing view - get current value that is stored for this custom field
        if ($obj instanceof \App\Models\Purchase) {
            foreach ($fields as $field) {
                $field->current_value = $obj[$field->customfields_name];
            }
        }

        return $fields;
    }
}
