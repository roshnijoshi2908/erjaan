<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for purchases
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\GeneralExpence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Log;


class GeneralExpenceRepository{



    /**
     * The template repository instance.
     */
    protected $generalexpence;

    /**
     * Inject dependecies
     */
    public function __construct(GeneralExpence $generalexpence) {
        $this->generalexpence = $generalexpence;
    }


        /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @return object purchase collection
     */
    public function search($id = '', $data = []) {

        $generalexpence = $this->generalexpence->newQuery();

        $generalexpence->selectRaw('
            general_expence.*, 
            general_expence_categories.*, 
            general_expence_subcategories.*, 
            users.first_name as creator_first_name, 
            users.last_name as creator_last_name, 
            approver.first_name as approver_first_name, 
            approver.last_name as approver_last_name,
            banks.name as bank_name
        ');
        
        $generalexpence->leftJoin('users', 'users.id', '=', 'general_expence.created_by')
            ->leftJoin('users as approver', 'approver.id', '=', 'general_expence.approved_by')
            ->leftJoin('general_expence_categories', 'general_expence_categories.expense_category_id', '=', 'general_expence.category')
            ->leftJoin('general_expence_subcategories', 'general_expence_subcategories.expense_subcategory_id', '=', 'general_expence.subcategory')
            ->leftJoin('banks', 'banks.id', '=', 'general_expence.bank');
            
         if (is_numeric($id)) {
            $generalexpence->where('generalexpence_id', $id);
        }
        
        if (isset($data['status'])) {
            $generalexpence->where('general_expence.status', $data['status']);
        }
        
         //filter: created date (start)
        if (request()->filled('filter_start_date_start')) {
            $generalexpence->whereDate('general_expence.created_at', '>=', request('filter_start_date_start'));
        }

        //filter: created date (end)
        if (request()->filled('filter_start_date_end')) {
            $generalexpence->whereDate('general_expence.created_at', '<=', request('filter_start_date_end'));
        }
        
         //filter: category
        if (request()->filled('filter_general_expence_category')) {
            $generalexpence->where('general_expence.category', request('filter_general_expence_category'));
        }
        
        //filter: subcategory
        if (request()->filled('filter_general_expence_subcategory')) {
            $generalexpence->where('general_expence.subcategory', request('filter_general_expence_subcategory'));
        }
        
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //direct column name
            if (Schema::hasColumn('general_expence', request('orderby'))) {
                $generalexpence->orderBy(request('orderby'), request('sortorder'));
            }
        } else {
            $generalexpence->orderBy('general_expence.generalexpence_id', 'desc');
        }
        
        $generalexpence->orderBy('general_expence.generalexpence_id', 'desc');


        // Get the results and return them.
        return $generalexpence->paginate(config('system.settings_system_pagination_limits'));
    }
}