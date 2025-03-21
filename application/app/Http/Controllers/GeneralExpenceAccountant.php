<?php 

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for purchase
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\GeneralExpence\IndexResponse;
use App\Http\Responses\GeneralExpence\Accountant\EditResponse;
use App\Http\Responses\GeneralExpence\Accountant\UpdateResponse;
use App\Repositories\GeneralExpenceRepository;
use App\Repositories\GeneralExpenceCategoryRepository;
use App\Repositories\GeneralExpenceSubcategoryRepository;
use App\Repositories\BankRepository;

class GeneralExpenceAccountant extends Controller {
    
        /**
        * The purchase repository instance.
        */
        protected $generalexpencerepo;
          protected $bankrepo;
        
        public function __construct(GeneralExpenceRepository $generalexpencerepo, GeneralExpenceCategoryRepository $generalexpencecatrepo, GeneralExpenceSubcategoryRepository $generalexpencesubcatrepo, BankRepository $bankrepo ){
            $this->generalexpencerepo = $generalexpencerepo;
            $this->generalexpencecatrepo = $generalexpencecatrepo;
            $this->generalexpencesubcatrepo = $generalexpencesubcatrepo;
            $this->bankrepo = $bankrepo;
            
             $this->middleware('auth');
            
        }

    /**
     * Display a listing of purchases
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $generalexpence = $this->generalexpencerepo->search('', ['status' => 'approved']);
        $generalexpencecat = $this->generalexpencecatrepo->search();
        $generalexpencesubcat = $this->generalexpencesubcatrepo->search();

         //reponse payload
        $payload = [
            'page' => $this->pageSettings('purchase'),
            'generalexpence' => $generalexpence,
            'change_status' => 0,
            'accountant' => 1,
            'generalexpencecat' => $generalexpencecat,
            'generalexpencesubcat' => $generalexpencesubcat
        ];

        //show the view
        return new IndexResponse($payload);
    }    
    
    
    /**
     * Show the form for changing a gm Approvels status
     * @return \Illuminate\Http\Response
     */
    public function edit() {
        
        
        //get the purchase
        $generalExpence = \App\Models\GeneralExpence::Where('generalexpence_id', request()->route('id'))->first();
        $banks = $this->bankrepo->search();

        //reponse payload
        $payload = [
            'generalExpence' => $generalExpence,
            'banks' => $banks
        ];

        //show the form
        return new EditResponse($payload);
    }
    
    /**
     * change status expense status
     * @return \Illuminate\Http\Response
     */
    public function update() {

        //validate the purchases exists
        $generalExpence = \App\Models\GeneralExpence::Where('generalexpence_id', request()->route('id'))->first();

        //old status
        $old_status = $generalExpence->status;

        //update the status
        $generalExpence->paid = request('paid');
        $generalExpence->bank = request('bank');
        
        $generalExpence->save();
        
         //get refreshed general-expense
        $generalExpence = $this->generalexpencerepo->search(request()->route('id'));
      
        //reponse payload
        $payload = [
            'generalexpence' => $generalExpence,
            'generalexpence_id' => request()->route('id'),
            'change_status' => 0,
            'accountant' => 1
        ];

        //show the form
        return new UpdateResponse($payload);
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
                __('lang.general_expence'),
                __('lang.accountant')
            ],
            'meta_title' => __('lang.general_expence'),
            'heading' => __('lang.accountant'),
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'accountant',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_general_expence' => 'active',
            'submenu_accountant' => 'active',
            'sidepanel_id' => 'sidepanel-filter-accountant',
            'dynamic_search_url' => url('general-expense/accountant/search?action=search&purchase_id=' . request('purchase_id')),
            'add_button_classes' => 'add-edit-accountant-button',
            'loaGmApprovalstton_route' => 'general-expense/accountant',
            'source' => 'list',
        ];

        return $page;
    }
}
