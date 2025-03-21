<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for purchases
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\GeneralExpenceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Log;


class GeneralExpenceCategoryRepository{



    /**
     * The template repository instance.
     */
    protected $generalexpencecategory;

    /**
     * Inject dependecies
     */
    public function __construct(GeneralExpenceCategory $generalexpencecategory) {
        $this->generalexpencecategory = $generalexpencecategory;
    }


        /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @return object purchase collection
     */
    public function search($id = '') {

        $generalexpencecategory = $this->generalexpencecategory->newQuery();

        $generalexpencecategory->selectRaw('*');
        
        $generalexpencecategory->leftJoin('users', 'users.id', '=', 'general_expence_categories.category_creatorid');


        //filters: id
        if (is_numeric($id)) {
            $generalexpencecategory->where('expense_category_id', $id);
        }

      

        $generalexpencecategory->orderBy('expense_category_id', 'desc');


        // Get the results and return them.
        return $generalexpencecategory->paginate(config('system.settings_system_pagination_limits'));
    }
}