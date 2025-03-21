<?php 

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for general expense category
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\BankRepository;
use App\Http\Responses\Bank\IndexResponse;
use App\Http\Responses\Bank\CreateResponse;
use App\Http\Responses\Bank\StoreResponse;
use App\Http\Responses\Bank\EditResponse;
use App\Http\Responses\Bank\UpdateResponse;
use App\Http\Responses\Bank\DestroyResponse;
use App\Rules\NoTags;
use Illuminate\Http\Request;
use Validator;

class Bank extends Controller {
    
    protected $bankrepo;
    
    public function __construct(BankRepository $bankrepo){
            $this->bankrepo = $bankrepo;
    }
    
    /**
     * Display a listing of banks
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
       $banks = $this->bankrepo->search();
       
         //reponse payload
        $payload = [
            'page' => $this->pageSettings('bank'),
            'banks' => $banks,
        ];
        
        return new IndexResponse($payload);
    }  
    
     public function create() {
        
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
        ];
    
        //show the form
        return new CreateResponse($payload);
    }
    
    
     /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function store() {

        //custom error messages
        $messages = [
            'name.required' => __('lang.bank_name') . '-' . __('lang.is_required'),
        ];

        //validate
        $validator = Validator::make(request()->all(), [
            'name' => [
                'required',
                new NoTags,
            ],
        ], $messages);

        //errors
        if ($validator->fails()) {
            $errors = $validator->errors();
            $messages = '';
            foreach ($errors->all() as $message) {
                $messages .= "<li>$message</li>";
            }

            abort(409, $messages);
        }
        
          //check duplicates
        if (\App\Models\Bank::where('name', request('name'))
            ->exists()) {
            abort(409, __('lang.bank_name_already_exists'));
        }
        
        $bank = new \App\Models\Bank();
        $bank->name = request('name');
        $bank->creator_id = auth()->id();
        $bank->save();
        
        $bankId = $bank->id;
         
        //count rows
        $bank = $this->bankrepo->search();
        $count = count($bank);
        
        
        //get the template object (friendly for rendering in blade template)
        $bank = $this->bankrepo->search($bankId);

        //reponse payload
        $payload = [
            'banks' => $bank,
            'count' => $count,
        ];

        //process reponse
        return new StoreResponse($payload);
    }
    
    /**
     * Show the form for editing the specified resource.
     * @param int $id resource id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        //get the proposal
        $bank = $this->bankrepo->search($id);
       

        //not found
        if (!$bank = $bank->first()) {
            abort(409, 'The requested bank could not be loaded');
        }

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'banks' => $bank,
        ];

        //response
        return new EditResponse($payload);
    }
    
    /**
     * Update the specified resource in storage.
     * @param int $id resource id
     * @return \Illuminate\Http\Response
     */
    public function update($id) {

        //get the template
        $bank = \App\Models\Bank::Where('id', $id)->first();

        //custom error messages
        $messages = [
            'name.required' => __('lang.bank_name') . '-' . __('lang.is_required'),
        ];

        //validate
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
        ], $messages);

        //errors
        if ($validator->fails()) {
            $errors = $validator->errors();
            $messages = '';
            foreach ($errors->all() as $message) {
                $messages .= "<li>$message</li>";
            }

            abort(409, $messages);
        }

        //update
        $bank->name = request('name');
        $bank->save();

        //get category
        $bank = $this->bankrepo->search($id);

        //reponse payload
        $payload = [
            'banks' => $bank,
            'id' => $id,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }
    
        /**
     * Remove the specified item from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

       //get record
        if (!\App\Models\Bank::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $bank = $this->bankrepo->search($id);
        $bank = $bank->first();

        //delete the category
        $bank->delete();

        //reponse payload
        $payload = [
            'bank' => $id,
        ];

        //generate a response
        return new DestroyResponse($payload);
    }
     private function pageSettings($section = '', $data = []) {

        //common settings
        $page = [
            'crumbs' => [
                __('lang.bank'),
            ],
            'meta_title' => __('lang.bank'),
            'heading' => __('lang.bank'),
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'bank',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_settings' => 'active',
            'submenu_bank' => 'active',
            'sidepanel_id' => 'sidepanel-filter-bank',
            'dynamic_search_url' => 'bank/search?source=' . request('source') . '&action=search',
            'add_button_classes' => '',
            'load_more_button_route' => 'bank',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_bank'),
            'add_modal_create_url' => url('bank/create'),
            'add_modal_action_url' => url('bank'),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
            'add_modal_size' => 'sm'
        ];

        //contracts list page
        if ($section == 'bank') {
            $page += [
                'meta_title' => __('lang.bank'),
                'heading' => __('lang.bank'),
            ];
            if (request('source') == 'ext') {
                $page += [
                    'list_page_actions_size' => 'col-lg-12',
                ];
            }
            return $page;
        }

        //create new resource
        if ($section == 'create') {
            $page += [
                'section' => 'create',
                'create_type' => 'bank',
            ];
            return $page;
        }

        //edit new resource
        if ($section == 'edit') {
            $page += [
                'section' => 'edit',
            ];
            return $page;
        }

        //ext page settings
        if ($section == 'ext') {

            $page += [
                'list_page_actions_size' => 'col-lg-12',

            ];

            return $page;
        }

        //return
        return $page;
    }
}