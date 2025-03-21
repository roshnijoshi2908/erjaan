<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for templates
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Log;


class SupplierRepository{



    /**
     * The template repository instance.
     */
    protected $supplier;

    /**
     * Inject dependecies
     */
    public function __construct(Supplier $supplier) {
        $this->supplier = $supplier;
    }


        /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @return object templates collection
     */
    public function search($id = '') {

        $supplier = $this->supplier->newQuery();

        $supplier->selectRaw('
            suppliers.*,
            supplier_categories.category_name,
            COALESCE(COUNT(purchases.purchase_id), 0) as total_purchases,
            COALESCE(SUM(purchases.total_cost), 0) as total_purchase_amount,
            COALESCE(SUM(CASE WHEN purchases.paid = 1 THEN purchases.total_cost ELSE 0 END), 0) as total_paid_amount,
            COALESCE(SUM(CASE WHEN purchases.paid = 0 THEN purchases.total_cost ELSE 0 END), 0) as unpaid_amount
        ');
        
        // Joining the users, supplier categories, and purchases tables
        $supplier->leftJoin('users', 'users.id', '=', 'suppliers.supplier_created_by');
        $supplier->leftJoin('supplier_categories', 'supplier_category_id', '=', 'suppliers.supplier_categoryid');
        $supplier->leftJoin('purchases', 'purchases.purchase_supplierid', '=', 'suppliers.supplier_id');
        
        // Filter: supplier ID
        if (is_numeric($id)) {
            $supplier->where('suppliers.supplier_id', $id);
        }
        
        // Grouping by supplier to aggregate the results
        $supplier->groupBy('suppliers.supplier_id', 'suppliers.supplier_name', 'supplier_categories.category_name');
        
        // Order by supplier ID
        $supplier->orderBy('suppliers.supplier_id', 'desc');


        // Get the results and return them.
        return $supplier->paginate(config('system.settings_system_pagination_limits'));
    }
}