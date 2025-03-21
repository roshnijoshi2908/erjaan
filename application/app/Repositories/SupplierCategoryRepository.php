<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for templates
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\SupplierCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Log;


class SupplierCategoryRepository{



    /**
     * The template repository instance.
     */
    protected $supplierCategory;

    /**
     * Inject dependecies
     */
    public function __construct(SupplierCategory $supplierCategory) {
        $this->supplierCategory = $supplierCategory;
    }

    
    
    /**
     * get all categories on a given type
     * @param string $type the type of the category
     * @return object
     */
    public function get($type = '') {

        //new object
        $query = $this->supplierCategory->newQuery();
        
        //get
        return $query->get();
    }
        /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @return object templates collection
     */
    public function search($id = '') {

        $supplierCategory = $this->supplierCategory->newQuery();

        $supplierCategory->selectRaw('*');

        $supplierCategory->leftJoin('users', 'users.id', '=', 'supplier_categories.category_creatorid');


        //filters: id
        if (is_numeric($id)) {
            $supplierCategory->where('supplier_category_id', $id);
        }

        $supplierCategory->orderBy('supplier_category_id', 'desc');


        // Get the results and return them.
        return $supplierCategory->paginate(config('system.settings_system_pagination_limits'));
    }
}