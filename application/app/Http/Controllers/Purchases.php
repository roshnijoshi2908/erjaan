<?php 

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for purchase
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\Purchases\IndexResponse;
use App\Http\Responses\Purchases\CreateResponse;
use App\Http\Responses\Purchases\StoreResponse;
use App\Repositories\PurchasesRepository;
use App\Repositories\ClientRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\SupplierRepository;
use App\Repositories\BankRepository;
use App\Repositories\EventRepository;
use App\Repositories\UserRepository;
use App\Repositories\EventTrackingRepository;
use App\Repositories\CustomFieldsRepository;
use App\Http\Responses\Supplier\ShowResponse;
use Illuminate\Http\Request;



use Validator;

class Purchases extends Controller {
    
        /**
        * The purchase repository instance.
        */
        protected $purchaserepo;
        protected $clientrepo;
        protected $projectrepo;
        protected $supplierrepo;
        
        
        public function __construct(PurchasesRepository $purchaserepo,ClientRepository $clientrepo,ProjectRepository $projectrepo,SupplierRepository $supplierrepo, CustomFieldsRepository $customrepo, EventRepository $eventrepo,
        EventTrackingRepository $trackingrepo, UserRepository $userrepo, BankRepository $bankrepo){
            $this->purchaserepo = $purchaserepo;
            $this->clientrepo = $clientrepo;
            $this->projectrepo = $projectrepo;
            $this->supplierrepo = $supplierrepo;
            $this->customrepo = $customrepo;
            $this->eventrepo = $eventrepo;
            $this->trackingrepo = $trackingrepo;
            $this->userrepo = $userrepo;
            $this->bankrepo = $bankrepo;
            
            //authenticated
            $this->middleware('auth');
            
        }

    /**
     * Display a listing of purchases
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $purchase = $this->purchaserepo->search();
        $supplier = $this->supplierrepo->search();
        $project = $this->projectrepo->search();
        $client = $this->clientrepo->search();

         //reponse payload
        $payload = [
            'page' => $this->pageSettings('purchase'),
            'purchase' => $purchase,
            'supplier' => $supplier,
            'project' => $project,
            'client' => $client,
           
        ];
        

        //show the view
        return new IndexResponse($payload);
    } 
    
     /**
     * Display a listing of purchases
     * @return \Illuminate\Http\Response
     */
    public function show() {
        
        $purchase = $this->purchaserepo->search();
        $supplier = $this->supplierrepo->search();
        $project = $this->projectrepo->search();
        $client = $this->clientrepo->search();

         //reponse payload
        $payload = [
            'page' => $this->pageSettings('purchase'),
            'purchase' => $purchase,
            'supplier' => $supplier,
            'project' => $project,
            'client' => $client,
           
        ];
        

        //show the view
        return new IndexResponse($payload);
    }

    
    public function create() {
        
        //get clients
        $client = $this->clientrepo->search();
        
        //get projects
        $project = $this->projectrepo->search();
        
        //get supplier
        $supplier = $this->supplierrepo->search();
        
        $banks = $this->bankrepo->search();
        
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'client' => $client,
            'project' => $project,
            'supplier' => $supplier, 
            'banks' => $banks
        ];
    
        //show the form
        return new CreateResponse($payload);
    }
    
    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        //custom error messages
        // $messages = [
        //     'purchase_clientid.required' => __('lang.purchase_clientid') . '-' . __('lang.is_required'),
        //     'purchase_projectid.required' => __('lang.purchase_projectid') . '-' . __('lang.is_required'),
        //     'purchase_supplierid.required' => __('lang.purchase_supplierid') . '-' . __('lang.is_required'),
        //     'purchase_request_date.required' => __('lang.request_date') . '-' . __('lang.is_required'),
        //     'purchase_items_list.required' => __('lang.purchase_items_list') . '-' . __('lang.is_required'),
        //     'costs_for_each_item.required' => __('lang.costs_for_each_item') . '-' . __('lang.is_required'),
        //     'total_cost.required' => __('lang.total_cost') . '-' . __('lang.is_required'),
        //     // 'approved_by.required' => __('lang.approved_by') . '-' . __('lang.is_required'),
        //     // 'pending_with.required' => __('lang.pending_with') . '-' . __('lang.is_required'),
        // ];

        // //validate
        // $validator = Validator::make(request()->all(), [
        //     'purchase_clientid' => 'required',
        //     'purchase_projectid' => 'required',
        //     'purchase_supplierid' => 'required',
        //     'purchase_request_date' => 'required',
        //     'purchase_items_list' => 'required',
        //     'costs_for_each_item' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        //     'total_cost' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        // ], $messages);
        

       // You can now access all items like this:
        
        $rules = [];
        $messages = [];
        
        $rules["purchase_request_date"] = 'required';
        $messages["purchase_request_date"] = __('lang.request_date') . '-' . __('lang.is_required');
        
        foreach ($request->input('description') as $key => $value) {
            $row = $key + 1; 
        
            
            $rules["description.{$key}"] = 'required|string';
            $rules["quantity.{$key}"] = 'required|numeric|min:1';
            $rules["unit_price.{$key}"] = 'required|regex:/^\d+(\.\d{1,2})?$/';
        
           
            $messages["description.{$key}.required"] = __('lang.description') . " for row {$row} - " . __('lang.is_required');
            $messages["quantity.{$key}.required"] = __('lang.qty') . " for row {$row} - " . __('lang.is_required');
            $messages["quantity.{$key}.numeric"] = __('lang.qty') . " for row {$row} - " . __('lang.must_be_a_number');
            $messages["quantity.{$key}.min"] = __('lang.qty') . " for row {$row} - " . __('lang.minimum_value_is_1');
            $messages["unit_price.{$key}.required"] = __('lang.unit_price') . " for row {$row} - " . __('lang.is_required');
            $messages["unit_price.{$key}.regex"] = __('lang.unit_price') . " for row {$row} - " . __('lang.must_be_valid_number');
        }
        
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            $errors = $validator->errors();
            $messages = '';
            foreach ($errors->all() as $message) {
                $messages .= "<li>$message</li>";
            }
        
            abort(409, $messages);
        }

        
        $descriptions = implode(',', request('description'));
        $quantities = implode(',', request('quantity'));
        $unitPrices = implode(',', request('unit_price'));
    
        
        $totalCost = array_sum(array_map(function ($qty, $unitPrice) {
            return $qty * $unitPrice;
        }, request('quantity'), request('unit_price')));
    
        $purchase = new \App\Models\Purchase();
        $purchase->purchase_creatorid = auth()->id();
        $purchase->purchase_clientid = request('purchase_clientid');
        $purchase->purchase_projectid = request('purchase_projectid');
        $purchase->purchase_supplierid = request('purchase_supplierid');
        $purchase->purchase_request_date = request('purchase_request_date');
        $purchase->purchase_items_list = $descriptions;
        $purchase->quantities = $quantities;
        $purchase->costs_for_each_item = $unitPrices;
        $purchase->total_cost = $totalCost;
        // $purchase->paid = request('paid');
        $purchase->purchase_status = 'pending';
        // $purchase->selected_the_bank = request('selected_the_bank');
        $purchase->save();

        $purchaseId = $purchase->purchase_id;

        //count rows
        $purchase = $this->purchaserepo->search();
        $count = count($purchase);

        //get the purchase object (friendly for rendering in blade purchase)
        $purchase = $this->purchaserepo->search($purchaseId);
        
        
        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'purchase',
            'event_item_id' => $purchaseId,
            'event_item_lang' => 'event_created_purchase',
            'event_item_content' => __('lang.purchases'),
            'event_item_content2' => '',
            'event_parent_type' => 'purchase_gm_approver',
            'event_parent_id' => $purchaseId,
            'event_parent_title' => 'purchase ',
            'event_clientid' =>request('purchase_clientid'),
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'eventresource_type' => 'project',
            'eventresource_id' =>  request('purchase_projectid'),
            'event_notification_category' => 'notifications_tasks_activity',

        ];
        
        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users (main client)
            $users = $this->userrepo->getPurchaseGmApproversUsers('ids');
            
            //record notification
            $this->trackingrepo->recordEvent($data, $users, $event_id);
        }
        

        //reponse payload
        $payload = [
            'purchase' => $purchase,
            'count' => $count,
        ];
        
        // return redirect()->back();
        //process reponse
        return new StoreResponse($payload);

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
                __('lang.procurement'),
                __('lang.purchases')
            ],
            'meta_title' => __('lang.procurement'),
            'heading' => __('lang.purchases'),
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'purchases',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_procurement' => 'active',
            'submenu_purchases' => 'active',
            // 'submenu_purchase_request' => 'active',
            // 'submenu_gm_approvals' => 'active',
            'sidepanel_id' => 'sidepanel-filter-purchase',
            // 'dynamic_search_url' => url('purchase/search?action=search&purchase_id=' . request('purchase_id')),
            
            'dynamic_search_url' => url('purchase/search?action=search&search_query=' . request('search_query') . '&purchase_id=' . request('purchase_id') . '&filter_purchase_status=' . request('filter_purchase_status') . '&filter_purchase_supplier=' . request('filter_purchase_supplier') . '&filter_purchase_project=' . request('filter_purchase_project') . '&filter_purchase_client=' . request('filter_purchase_client')),
            'add_button_classes' => 'add-edit-purchase-button',

            'load_more_button_route' => 'purchases',
            'source' => 'list',
            
        ];
        
        config([
            //visibility - add purchase buttton
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
            'add_modal_title' => __('lang.add_purchase'),
            'add_modal_create_url' => url('purchase/create?purchaseresource_id=' . request('purchaseresource_id') . '&purchaseresource_type=' . request('purchaseresource_type') . '&filter_category=' . request('filter_category')),
            'add_modal_action_url' => url('purchase'),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];
        //return
        
        if ($section == 'create') {
            $page += [
                'section' => 'create',
            ];
            return $page;
        }
        
        return $page;
    }
        /**
     * Display a listing of purchases
     * @return \Illuminate\Http\Response
     */
    public function return() {
        
       
        
        if(request('purchase_id') !== null) {
            $purchases = \App\Models\Purchase::Where('purchase_id', request('purchase_id'))->first();
            $purchases->purchase_status = "returned";
            $purchases->save();
            
            //Send notification
            $purchaseRow = $this->purchaserepo->search(request('purchase_id'));
            $purchaseRow = $purchaseRow->first();
            
            $data = [
                'event_creatorid' => auth()->id(),
                'event_item' => 'purchase',
                'event_item_id' => $purchaseRow->purchase_id,
                'event_item_lang' => 'event_returend_purchase',
                'event_item_content' => __('lang.purchases'),
                'event_item_content2' => '',
                'event_parent_type' => 'purchase_accountant',
                'event_parent_id' =>  $purchaseRow->purchase_id,
                'event_parent_title' => 'test ',
                'event_clientid' => $purchaseRow->purchase_clientid,
                'event_show_item' => 'yes',
                'event_show_in_timeline' => 'yes',
                'eventresource_type' => 'project',
                'eventresource_id' =>  $purchaseRow->purchase_projectid,
                'event_notification_category' => 'notifications_tasks_activity',

            ];
        
            //record event
            if ($event_id = $this->eventrepo->create($data)) {
                //get users (main client)
                $users = $this->userrepo->getPurchaseAccountantUsers('ids');
                
                //record notification
                $this->trackingrepo->recordEvent($data, $users, $event_id);
            }
            
        } else {
           foreach (request('ids') as $id => $value) {
                //only checked items
                if ($value == 'on') {
                    $purchases = \App\Models\Purchase::Where('purchase_id', $id)->first();
                    $purchases->purchase_status = "returned";
                    $purchases->save();
                    
                    //Send notification
                    $purchaseRow = $this->purchaserepo->search($id);
                    $purchaseRow = $purchaseRow->first();
                    
                    $data = [
                        'event_creatorid' => auth()->id(),
                        'event_item' => 'purchase',
                        'event_item_id' => $purchaseRow->purchase_id,
                        'event_item_lang' => 'event_returend_purchase',
                        'event_item_content' => __('lang.purchases'),
                        'event_item_content2' => '',
                        'event_parent_type' => 'purchase_accountant',
                        'event_parent_id' =>  $purchaseRow->purchase_id,
                        'event_parent_title' => 'purchase ',
                        'event_clientid' => $purchaseRow->purchase_clientid,
                        'event_show_item' => 'yes',
                        'event_show_in_timeline' => 'yes',
                        'eventresource_type' => 'project',
                        'eventresource_id' =>  $purchaseRow->purchase_projectid,
                        'event_notification_category' => 'notifications_tasks_activity',
            
                    ];
                    
                    //record event
                    if ($event_id = $this->eventrepo->create($data)) {
                        //get users (main client)
                        $users = $this->userrepo->getPurchaseAccountantUsers('ids');
                        
                        //record notification
                        $this->trackingrepo->recordEvent($data, $users, $event_id);
                    }
                }
            } 
        }
        
        
         $purchase = $this->purchaserepo->search();
        
        
         $payload = [
            'page' => $this->pageSettings('purchase'),
            'purchase' => $purchase,
        ];

        //show the view
        return new IndexResponse($payload);
        
    }
    
}
