<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for purchases
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Log;


class PurchasesRepository{



    /**
     * The template repository instance.
     */
    protected $purchase;

    /**
     * Inject dependecies
     */
    public function __construct(Purchase $purchase) {
        $this->purchase = $purchase;
    }


        /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @return object purchase collection
     */
    public function search($id = '', $data = []) {

        $purchases = $this->purchase->newQuery();

        // $purchases->selectRaw('*,approver.first_name as approver_first_name');

        // $purchases->leftJoin('users', 'users.id', '=', 'purchases.purchase_creatorid');
        // $purchases->leftJoin('users as approver', 'users.id', '=', 'purchases.approved_by');
        // $purchases->leftJoin('clients', 'clients.client_id', '=', 'purchases.purchase_clientid');
        // $purchases->leftJoin('projects', 'projects.project_id', '=', 'purchases.purchase_projectid');
        // $purchases->leftJoin('suppliers', 'suppliers.supplier_id', '=', 'purchases.purchase_supplierid');
        
        $purchases->selectRaw('
            purchases.*, 
            users.first_name as creator_first_name, 
            users.last_name as creator_last_name, 
            approver.first_name as approver_first_name, 
            approver.last_name as approver_last_name,
            clients.*, 
            projects.*, 
            suppliers.*,
            banks.name as name
            
        ');
        
        $purchases->leftJoin('users', 'users.id', '=', 'purchases.purchase_creatorid');
        $purchases->leftJoin('users as approver', 'approver.id', '=', 'purchases.approved_by');
        $purchases->leftJoin('clients', 'clients.client_id', '=', 'purchases.purchase_clientid');
        $purchases->leftJoin('projects', 'projects.project_id', '=', 'purchases.purchase_projectid');
        $purchases->leftJoin('suppliers', 'suppliers.supplier_id', '=', 'purchases.purchase_supplierid');
        $purchases->leftJoin('banks', 'banks.id', '=', 'purchases.selected_the_bank');


        // $purchases->leftJoin('users', 'users.id', '=', 'purchases.purchase_creatorid');


        //filters: id
        // if (is_numeric($id)) {
        //     $purchases->where('contract_template_id', $id);
        // }
       if (request()->filled('filter_purchase_supplier')) {
            $supplierId = (int) request('filter_purchase_supplier'); 
            $purchases->where('purchases.purchase_supplierid', $supplierId);
        }
        
        if (request()->filled('filter_purchase_status')) {
            $purchases->where('purchases.purchase_status', request('filter_purchase_status'));
        }
        
        if (request()->filled('filter_purchase_project')) {
            $projectId = (int) request('filter_purchase_supplier');
            $purchases->where('purchases.purchase_projectid', $projectId);
        }
        
         if (request()->filled('filter_purchase_client')) {
            $clientId = (int) request('filter_purchase_client');
            $purchases->where('purchases.purchase_clientid', $clientId);
        }
       
        
        if (isset($data['purchase_clientid'])) {
            $clientId = (int) $data['purchase_clientid'];
            $purchases->where('purchases.purchase_clientid', $clientId);
        }

        if (isset($data['purchase_status'])) {
            $purchases->where('purchases.purchase_status', $data['purchase_status']);
        }


        // if(isset($data['order_by_asc']) && $data['order_by_asc']) {
        //      $purchases->orderBy('purchase_id', 'asc');
        // }

        $purchases->orderBy('purchase_id', 'desc');
        


        // Get the results and return them.
        return $purchases->paginate(config('system.settings_system_pagination_limits'));
    }
}