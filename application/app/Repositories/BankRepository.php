<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for purchases
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Log;


class BankRepository{



    /**
     * The template repository instance.
     */
    protected $bank;

    /**
     * Inject dependecies
     */
    public function __construct(Bank $bank) {
        $this->bank = $bank;
    }


        /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @return object purchase collection
     */
    public function search($id = '') {

        $bank = $this->bank->newQuery();

        $bank->selectRaw('banks.*,users.first_name, users.avatar_directory, users.avatar_filename');
        
        $bank->leftJoin('users', 'users.id', '=', 'banks.creator_id');


        //filters: id
        if (is_numeric($id)) {
            $bank->where('banks.id', $id);
        }
        
      

        $bank->orderBy('banks.id', 'desc');
        
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            if (Schema::hasColumn('banks', request('orderby'))) {
                $bank->orderBy(request('orderby'), request('sortorder'));
            }
        }
        

        // Get the results and return them.
        return $bank->paginate(config('system.settings_system_pagination_limits'));
    }
}