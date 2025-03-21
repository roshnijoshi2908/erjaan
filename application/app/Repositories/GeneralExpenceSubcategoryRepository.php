<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for purchases
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\GeneralExpenceSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Log;


class GeneralExpenceSubcategoryRepository{



    /**
     * The template repository instance.
     */
    protected $generalexpencesubcategory;

    /**
     * Inject dependecies
     */
    public function __construct(GeneralExpenceSubcategory $generalexpencesubcategory) {
        $this->generalexpencesubcategory = $generalexpencesubcategory;
    }


        /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @return object purchase collection
     */
    public function search($id = '') {

        $generalexpencesubcategory = $this->generalexpencesubcategory->newQuery();

        $generalexpencesubcategory->selectRaw('*');
        $generalexpencesubcategory->leftJoin('users', 'users.id', '=', 'general_expence_subcategories.subcategory_creatorid');
        
        $generalexpencesubcategory->leftJoin('general_expence_categories', 'general_expence_categories.expense_category_id', '=', 'general_expence_subcategories.expense_category_id');


        //filters: id
        if (is_numeric($id)) {
            $generalexpencesubcategory->where('expense_subcategory_id', $id);
        }

        $generalexpencesubcategory->orderBy('expense_subcategory_id', 'desc');


        // Get the results and return them.
        return $generalexpencesubcategory->paginate(config('system.settings_system_pagination_limits'));
    }
}