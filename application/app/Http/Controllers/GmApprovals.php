<?php 

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for purchase
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\Purchases\GmApprovals\IndexResponse;
use App\Http\Responses\Purchases\GmApprovals\ChangeStatusResponse;
use App\Http\Responses\Purchases\GmApprovals\UpdateResponse;
use App\Http\Responses\Purchases\GmApprovals\ShowResponse;
use App\Http\Responses\Purchases\CreateResponse;
use App\Repositories\PurchasesRepository;
use App\Repositories\ClientRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\SupplierRepository;
use App\Repositories\EventRepository;
use App\Repositories\UserRepository;
use App\Repositories\EventTrackingRepository;

class GmApprovals extends Controller {
    
        /**
        * The purchase repository instance.
        */
        protected $purchaserepo;
        protected $clientrepo;
        protected $projectrepo;
        protected $supplierrepo;
        
        
        public function __construct(PurchasesRepository $purchaserepo,ClientRepository $clientrepo,ProjectRepository $projectrepo,SupplierRepository $supplierrepo, EventRepository $eventrepo,
        EventTrackingRepository $trackingrepo, UserRepository $userrepo){
            $this->purchaserepo = $purchaserepo;
            $this->clientrepo = $clientrepo;
            $this->projectrepo = $projectrepo;
            $this->supplierrepo = $supplierrepo;
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
        
        $purchase = $this->purchaserepo->search();

         //reponse payload
        $payload = [
            'page' => $this->pageSettings('purchase'),
            'purchase' => $purchase,
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
     * Show the form for changing a gm Approvels status
     * @return \Illuminate\Http\Response
     */
    public function changeStatus() {
        
        
        //get the purchase
        $purchase = \App\Models\Purchase::Where('purchase_id', request()->route('purchase'))->first();

        //reponse payload
        $payload = [
            'purchase' => $purchase,
        ];

        //show the form
        return new ChangeStatusResponse($payload);
    }
    
    /**
     * change status purchase status
     * @return \Illuminate\Http\Response
     */
    public function changeStatusUpdate() {

        //validate the purchases exists
        $purchase = \App\Models\Purchase::Where('purchase_id', request()->route('purchase'))->first();

        //old status
        $old_status = $purchase->purchase_status;

        //update the project
        $purchase->purchase_status = request('purchase_status');
        $purchase->approved_by = auth()->id();
        
        $purchase->save();
        
         //get refreshed purchase
        $purchases = $this->purchaserepo->search(request()->route('purchase'));
        $purchase = $purchases->first();
        $purchaseId = $purchase->purchase_id;
        
       if(request('purchase_status') == 'approved') {
           $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'purchase',
            'event_item_id' => $purchaseId,
            'event_item_lang' => 'event_approved_purchase',
            'event_item_content' => __('lang.purchases'),
            'event_item_content2' => '',
            'event_parent_type' => 'purchase_accountant',
            'event_parent_id' => $purchaseId,
            'event_parent_title' => 'purchase ',
            'event_clientid' => $purchase->purchase_clientid,
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'eventresource_type' => 'project',
            'eventresource_id' =>  $purchase->purchase_projectid,
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
        
        
    
        //reponse payload
        $payload = [
            'purchase' => $purchases,
            'purchase_id' => request()->route('purchase'),
        ];

        //show the form
        return new UpdateResponse($payload);
    }
    
    /**
     * Display the specified resource.
     * @param int $id resource id
     * @return \Illuminate\Http\Response
     */
    public function showInvoice($id) {
        
       
        
        //page settings
        $page = $this->pageSettings('show');
        
        
        //get the project
        $projects = $this->projectrepo->search($id);

        //project
        $project = $projects->first();
        
        //not found
        if (!$projects = $projects->first()) {
            abort(409, __('lang.hello'));
        }

        //reponse payload
        $payload = [
            'page' => $page,
            'project' => $project,
        ];

        //response
        return new ShowResponse($payload);
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
                __('lang.gm_approvals')
            ],
            'meta_title' => __('lang.procurement'),
            'heading' => __('lang.gm_approvals'),
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'gm_approvals',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_procurement' => 'active',
            'submenu_gm_approvals' => 'active',
            'sidepanel_id' => 'sidepanel-filter-gm-approvals',
            'dynamic_search_url' => url('gm-approvals/search?action=search&purchase_id=' . request('purchase_id')),
            'add_button_classes' => 'add-edit-gm-approvals-button',
            'loaGmApprovalstton_route' => 'gm-approvals',
            'source' => 'list',
        ];

        return $page;
    }
}
