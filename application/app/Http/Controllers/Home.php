<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for home page
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use App\Http\Responses\Home\HomeResponse;
use App\Http\Responses\Home\HomesResponse;
use App\Repositories\EventRepository;
use App\Repositories\EventTrackingRepository;
use App\Repositories\LeadRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\StatsRepository;
use App\Repositories\TaskRepository;
use App\Permissions\LeadPermissions;
use App\Repositories\CustomFieldsRepository;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\LeadSources;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Home extends Controller
{

    private $page = array();

    protected $statsrepo;
    protected $eventsrepo;
    protected $trackingrepo;
    protected $projectrepo;
    protected $taskrepo;
    protected $leadrepo;
    protected $leadpermissions;
    protected $customrepo;

    public function __construct(
        StatsRepository $statsrepo,
        EventRepository $eventsrepo,
        EventTrackingRepository $trackingrepo,
        ProjectRepository $projectrepo,
        TaskRepository $taskrepo,
        LeadRepository $leadrepo,
        LeadPermissions $leadpermissions,
        CustomFieldsRepository $customrepo
    ) {

        //parent
        parent::__construct();

        $this->statsrepo = $statsrepo;
        $this->eventsrepo = $eventsrepo;
        $this->trackingrepo = $trackingrepo;
        $this->projectrepo = $projectrepo;
        $this->taskrepo = $taskrepo;
        $this->leadrepo = $leadrepo;
        $this->leadpermissions = $leadpermissions;
        $this->customrepo = $customrepo;

        //authenticated
        $this->middleware('auth');

        $this->middleware('homeMiddlewareIndex')->only([
            'index',
            'dashboard'
        ]);
    }

    /**
     * Display the home page
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $page = $this->pageSettings();

        $payload = [];

        //Team Dashboards
        if (auth()->user()->type == 'team') {
            //admin user
            if (auth()->user()->is_admin) {
                //get payload
                $payload = $this->adminDashboard();
            }
            //team uder
            if (!auth()->user()->is_admin) {
                //get payload
                $payload = $this->teamDashboard();
            }
        }

        //Client Dashboards
        if (auth()->user()->type == 'client') {
            //get payload
            $payload = $this->clientDashboard();
        }

        //[AFFILIATE]
        if (config('settings.custom_modules.cs_affiliate')) {
            if (auth()->user()->type == 'cs_affiliate') {
                //get payload
                $payload = $this->csAffiliateDashboard();
                return view('pages/cs_affiliates/home/home', compact('page', 'payload'));
            }
        }

        //page
        $payload['page'] = $page;

        //process reponse
        return new HomeResponse($payload);
    }

    public function dashboard()
    {

        $filter = '';
        $from = '';
        $to = '';
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        if (request()->get('filter')) {
            
            $filter = request()->get('filter');
            if ($filter == 'last-month') {
                $month = Carbon::now()->subMonth()->month;
            } else if ($filter == 'last-year') {
                $year = Carbon::now()->subYear()->year;
            } else if ($filter == 'custom') {
                $from = request()->get('start_date');
                $to = request()->get('end_date');
            }
        }

        $page = $this->pageSettingsdashboard();

        $payload = [];

        //get leads
        $leads = \App\Models\Lead::orderBy('lead_id', 'asc');
        //$leads = new \App\Models\Lead;
        
        // $salesPersons = \App\Models\User::with('assignedLeads')->where('is_this_sales_person', 'on');
        $salesPersons = \App\Models\User::with('assignedLeads')->orderBy('id', 'asc');


        //all available lead statuses
        $statuses = \App\Models\LeadStatus::orderBy('leadstatus_position', 'asc');
        
        

        if ($filter != '') {
            if ($filter == 'current-month') {
                $leads = $leads->whereMonth('lead_created', $month);
                // $statuses = $statuses->whereMonth('leadstatus_created', $month);
            } else if ($filter == 'last-month') {
                $leads = $leads->whereMonth('lead_created', $month);
                // $statuses = $statuses->whereMonth('leadstatus_created', $month);
            } else if ($filter == 'this-year') {
                $leads = $leads->whereYear('lead_created', $year);
                // $statuses = $statuses->whereYear('leadstatus_created', $year);
            } else if ($filter == 'last-year') {
                $leads = $leads->whereYear('lead_created', $year);
                // $statuses = $statuses->whereYear('leadstatus_created', $year);
            } else if ($filter == 'custom') {
                $leads = $leads->whereBetween('lead_created', [$from, $to]);
                // $statuses = $statuses->whereBetween('leadstatus_created', [$from, $to]);
            }
        } else {
            $leads = $leads->whereMonth('lead_created', $month);
            // $statuses = $statuses->whereMonth('leadstatus_created', $month);
        }

        if ($filter != '') {
            if ($filter == 'current-month') {
                $salesPersons = $salesPersons->whereMonth('created', $month);
                // $statuses = $statuses->whereMonth('leadstatus_created', $month);
            } else if ($filter == 'last-month') {
                $salesPersons = $salesPersons->whereMonth('created', $month);
                // $statuses = $statuses->whereMonth('leadstatus_created', $month);
            } else if ($filter == 'this-year') {
                $salesPersons = $salesPersons->whereYear('created', $year);
                // $statuses = $statuses->whereYear('leadstatus_created', $year);
            } else if ($filter == 'last-year') {
                $salesPersons = $salesPersons->whereYear('created', $year);
                // $statuses = $statuses->whereYear('leadstatus_created', $year);
            } else if ($filter == 'custom') {
                $salesPersons = $salesPersons->whereBetween('created', [$from, $to]);
                // $statuses = $statuses->whereBetween('leadstatus_created', [$from, $to]);
            }
        } else {
            $salesPersons = $salesPersons->whereMonth('created', $month);
            // $statuses = $statuses->whereMonth('leadstatus_created', $month);
        }
        
        $leads = $leads->get();
        $salesPersons = $salesPersons->get();
        $statuses = $statuses->get();
        
        $boards = $this->leadBoards();

        // Count leads by their status
        $statusCount = $leads->groupBy('lead_status')->map(function ($leads) {
            return $leads->count();
        });
    
        
        $categoryValue = [];
        $categoryData = [__('lang.categories')];
        // for ($i = 1; $i < 13; $i++) {
        //     // $categoryData[] = Category::whereMonth('category_created', $i)->count();
        //     if ((($filter == 'current-month' || $filter == 'last-month' || $filter == '') && $month == $i) || ($filter == 'this-year' || $filter == 'last-year')) {
        //         // $categoryData[] = Category::whereMonth('category_created', $i)->whereYear('category_created', $year)->withCount('leads');
        //         $categoriesMap = Category::whereMonth('category_created', $i)
        //             ->whereYear('category_created', $year)
        //             ->withCount('leads')
        //             ->get()
        //             ->map(function ($category) {
        //                 return [
        //                     'category' => $category->name,
        //                     'leads_count' => $category->leads_count
        //                 ];
        //             });
        //         $categoryData[] = $categoriesMap->sum('leads_count');
        //         // } else if (($filter == 'this-year' || $filter == 'last-year')) {
        //         //     $categoryData[] = Category::whereMonth('category_created', $i)->whereYear('category_created', $year)->count();
        //     } else {
        //         $categoryData[] = 0;
        //     }
        //     $categoryValue[] = date("M", mktime(0, 0, 0, $i, 1));
        // }
        // $categories = Category::where('category_creatorid', auth()->id())->where('category_type', 'lead')->get();
        $categories = Category::where('category_type', 'lead')->get();
        foreach ($categories as $key => $value) {
            //  $categoriesMap = Category::where('category_creatorid', auth()->id())->where('category_type', 'lead')
            $categoriesMap = Category::where('category_type', 'lead')
                ->where('category_name', $value->category_name)
                ->withCount('leads');
            if ($filter == 'current-month') {
                $categoriesMap = $categoriesMap->whereMonth('category_created', $month);
            } else if ($filter == 'last-month') {
                $categoriesMap = $categoriesMap->whereMonth('category_created', $month);
            } else if ($filter == 'this-year') {
                $categoriesMap = $categoriesMap->whereYear('category_created', $year);
            } else if ($filter == 'last-year') {
                $categoriesMap = $categoriesMap->whereYear('category_created', $year);
            } else if ($filter == 'custom') {
                $categoriesMap = $categoriesMap->whereBetween('category_created', [$from, $to]);
            }
            
                

            $categoriesMap = $categoriesMap->get()
                ->map(function ($category) {
                    return [
                        'category' => $category->name,
                        'leads_count' => $category->leads_count
                    ];
                });
                
            $categoryData[] = $categoriesMap->sum('leads_count');
            $categoryValue[] = $value->category_name;
            
        }
        
        $leadSourceValue = [];
        $leadSourceData = [__('lang.lead_sources')];
        // for ($i = 1; $i < 13; $i++) {
        //     // $leadSourceData[] = LeadSources::whereMonth('leadsources_created', $i)->count();
        //     if (($filter == 'current-month' || $filter == 'last-month' || $filter == '') && $month == $i) {
        //         $leadSourceData[] = LeadSources::whereMonth('leadsources_created', $i)->whereYear('leadsources_created', $year)->count();
        //     } else if (($filter == 'this-year' || $filter == 'last-year')) {
        //         $leadSourceData[] = LeadSources::whereMonth('leadsources_created', $i)->whereYear('leadsources_created', $year)->count();
        //     } else {
        //         $leadSourceData[] = 0;
        //     }
        //     $leadSourceValue[] = date("M", mktime(0, 0, 0, $i, 1));
        // }
        $leadSources = LeadSources::get();
        // $leadSources = LeadSources::where('leadsources_creatorid', auth()->id())->get();
        foreach ($leadSources as $key => $value) {
            //  $leadSourcesMap = LeadSources::where('leadsources_creatorid', auth()->id())
            $leadSourcesMap = LeadSources::where('leadsources_title', $value->leadsources_title);
            if ($filter == 'current-month') {
                $leadSourcesMap = $leadSourcesMap->whereMonth('leadsources_created', $month);
            } else if ($filter == 'last-month') {
                $leadSourcesMap = $leadSourcesMap->whereMonth('leadsources_created', $month);
            } else if ($filter == 'this-year') {
                $leadSourcesMap = $leadSourcesMap->whereYear('leadsources_created', $year);
            } else if ($filter == 'last-year') {
                $leadSourcesMap = $leadSourcesMap->whereYear('leadsources_created', $year);
            } else if ($filter == 'custom') {
                $leadSourcesMap = $leadSourcesMap->whereBetween('leadsources_created', [$from, $to]);
            }

            $leadSourceData[] = $leadSourcesMap->count();
            $leadSourceValue[] = $value->leadsources_title;
        }

        // leads
        $leadsValue = [];
        $leadsData = [__('lang.leads_converted')];
        for ($i = 1; $i < 13; $i++) {
            if (($filter == 'current-month' || $filter == 'last-month' || $filter == '') && $month == $i) {
                $leadsData[] = Lead::whereMonth('lead_created', $i)->whereYear('lead_created', $year)->where('lead_status', 2)->count();
            } else if (($filter == 'this-year' || $filter == 'last-year')) {
                $leadsData[] = Lead::whereMonth('lead_created', $i)->whereYear('lead_created', $year)->where('lead_status', 2)->count();
            } else {
                $leadsData[] = 0;
            }
            $leadsValue[] = date("M", mktime(0, 0, 0, $i, 1));
        }

        $filters = [
            'filter' => $filter,
            'month' => $month,
            'year' => $year,
            'from' => $from,
            'to' => $to,
        ];

        //[leads] - alltime
        $data = $this->widgetLeads($filters);
        $payload['leads_stats'] = json_encode($data['stats']);
        $payload['leads_key_colors'] = json_encode($data['leads_key_colors']);
        $payload['leads_chart_center_title'] = $data['leads_chart_center_title'];
        $payload['year'] = $year;

        $statusCounts = [];
        foreach ($boards as $board) {
            $statusCounts[$board['name']] = $board['leads']->total();
        }
        
        // Get the count of new and converted statuses
        $newLeadsCount = $leads->where('lead_status', '1')->count();
        $convertedLeadsCount = $leads->where('lead_status', '2')->count();

        $totalLeads = $newLeadsCount + $convertedLeadsCount;
        $conversionRatio = ($totalLeads > 0) ? ($convertedLeadsCount / $totalLeads) * 100 : 0;

        $qualifiedLeadsCount = $leads->where('lead_status', '3')->count();

        $totalConvertedQualified = $convertedLeadsCount + $qualifiedLeadsCount;
        $convertedQualifiedRatio = ($totalConvertedQualified > 0) ? ($qualifiedLeadsCount / $totalConvertedQualified) * 100 : 0;

        $topLeadCreators = Lead::select('lead_creatorid', DB::raw('count(*) as lead_count'))
            ->groupBy('lead_creatorid')
            ->orderByDesc('lead_count')
            ->take(3)
            ->pluck('lead_creatorid');

        $leadTop3 = Lead::select('lead_creatorid', DB::raw('count(*) as lead_count'))
            ->with('creator')
            ->whereIn('lead_creatorid', $topLeadCreators);
            if ($filter == 'current-month') {
                $leadTop3 = $leadTop3->whereMonth('lead_created', $month);
            } else if ($filter == 'last-month') {
                $leadTop3 = $leadTop3->whereMonth('lead_created', $month);
            } else if ($filter == 'this-year') {
                $leadTop3 = $leadTop3->whereYear('lead_created', $year);
            } else if ($filter == 'last-year') {
                $leadTop3 = $leadTop3->whereYear('lead_created', $year);
            } else if ($filter == 'custom') {
                $leadTop3 = $leadTop3->whereBetween('lead_created', [$from, $to]);
            }
        $leadTop3 = $leadTop3
        ->groupBy('lead_creatorid')
        ->orderByDesc('lead_count')
        ->get();

        $topRevenueCreators = Lead::select('lead_creatorid', DB::raw('SUM(lead_value) as total_lead_value'))
            ->groupBy('lead_creatorid')
            ->orderByDesc('total_lead_value')
            ->take(3)
            ->pluck('lead_creatorid');
            

        $top3Revenues = Lead::select('lead_creatorid', DB::raw('SUM(lead_value) as total_lead_value'))
            ->with('creator')
            ->where('lead_converted'  ,'yes')
            ->whereIn('lead_creatorid', $topRevenueCreators);

            if ($filter == 'current-month') {
                $top3Revenues = $top3Revenues->whereMonth('lead_created', $month);
            } else if ($filter == 'last-month') {
                $top3Revenues = $top3Revenues->whereMonth('lead_created', $month);
            } else if ($filter == 'this-year') {
                $top3Revenues = $top3Revenues->whereYear('lead_created', $year);
            } else if ($filter == 'last-year') {
                $top3Revenues = $top3Revenues->whereYear('lead_created', $year);
            } else if ($filter == 'custom') {
                $top3Revenues = $top3Revenues->whereBetween('lead_created', [$from, $to]);
            }
        $top3Revenues = $top3Revenues
        ->groupBy('lead_creatorid')
        ->orderByDesc('total_lead_value')
        ->get();


        //reponse payload
        $payload = [
            'salesPersons' => $salesPersons,
            'leads' => $leads,
            'leads' => $leads,
            'leadTop3' => $leadTop3,
            'top3Revenues' => $top3Revenues,
            'categoryData' => json_encode($categoryData),
            'categoryValue' => json_encode($categoryValue),
            'leadSourceData' => json_encode($leadSourceData),
            'leadSourceValue' => json_encode($leadSourceValue),
            'leadsData' => json_encode($leadsData),
            'leadsValue' => json_encode($leadsValue),
            'stats' => $this->statsWidget(),
            'statuses' => $statuses,
            'boards' => $boards,
            'payload' => $payload,
            'statusCounts' => $statusCounts,
            'statusCount' => $statusCount,
            'conversionRatio' => $conversionRatio,
            'convertedQualifiedRatio' => $convertedQualifiedRatio,
        ];
        //page
        $payload['page'] = $page;
        return new HomesResponse($payload);
    }

    /**
     * pass the lead through the LeadPermissions class and apply user permissions.
     * @param object lead instance of the lead model
     * @return \Illuminate\Http\Response
     */
    private function applyPermissions($lead = '')
    {

        //sanity - make sure this is a valid lead object
        if ($lead instanceof \App\Models\Lead) {
            //edit permissions
            $lead->permission_edit_lead = $this->leadpermissions->check('edit', $lead);
            //delete permissions
            $lead->permission_delete_lead = $this->leadpermissions->check('delete', $lead);
            //edit participate
            $lead->permission_participate = $this->leadpermissions->check('participate', $lead);
        }
    }

    /**
     * send each lead for processing
     * @param object leads collection of the lead model
     * @return object
     */
    private function processLeads($leads = '')
    {
        //sanity - make sure this is a valid leads object
        if ($leads instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            foreach ($leads as $lead) {
                $this->processLead($lead);
            }
        }
    }


    /**
     * check the lead for the following:
     *    1. Check if lead is assigned to me - add 'assigned_to_me' (yes/no) attribute
     *    2. check if there are any running timers on the leads - add 'running_timer' (yes/no)
     * @param object lead instance of the lead model
     * @return object
     */
    private function processLead($lead = '')
    {

        //sanity - make sure this is a valid lead object
        if ($lead instanceof \App\Models\Lead) {

            //default values
            $lead->assigned_to_me = false;
            $lead->has_attachments = false;
            $lead->has_comments = false;
            $lead->has_checklist = false;

            //check if the lead is assigned to me
            foreach ($lead->assigned as $user) {
                if ($user->id == auth()->id()) {
                    //its assigned to me
                    $lead->assigned_to_me = true;
                }
            }

            $lead->has_attachments = ($lead->attachments_count > 0) ? true : false;
            $lead->has_comments = ($lead->comments_count > 0) ? true : false;
            $lead->has_checklist = ($lead->checklists_count > 0) ? true : false;

            //custom fields
            $lead->fields = $this->getCustomFields($lead);
        }
    }

    /**
     * get all custom fields for clients
     *   - if they are being used in the 'edit' modal form, also get the current data
     *     from the cliet record. Store this temporarily in '$field->customfields_name'
     *     this will then be used to prefill data in the custom fields
     * @param model client model - only when showing the edit modal form
     * @return collection
     */
    public function getCustomFields($obj = '')
    {

        //set typs
        request()->merge([
            'customfields_type' => 'leads',
        ]);

        //show all fields
        config(['settings.custom_fields_display_limit' => 1000]);

        //get fields
        $fields = $this->customrepo->search();

        //when in editing view - get current value that is stored for this custom field
        if ($obj instanceof \App\Models\Lead) {
            foreach ($fields as $field) {
                $field->current_value = $obj[$field->customfields_name];
            }
        }

        return $fields;
    }

    /**
     * data for the stats widget
     * @return array
     */
    private function statsWidget($data = array())
    {
        //TO DO IN THE FUTURE
        return [];
    }

    /**
     * process/group leads into boards
     * @return object
     */
    private function leadBoards()
    {

        $statuses = \App\Models\LeadStatus::orderBy('leadstatus_position', 'asc')->get();

        foreach ($statuses as $status) {

            request()->merge([
                'filter_single_lead_status' => $status->leadstatus_id,
                'query_type' => 'kanban',
            ]);

            //get leads
            $leads = $this->leadrepo->search();

            //process lead
            $this->processLeads($leads);

            //count rows
            $count = $leads->total();

            //apply some permissions
            if ($leads) {
                foreach ($leads as $lead) {
                    $this->applyPermissions($lead);
                }
            }

            //apply custom fields
            if ($leads) {
                foreach ($leads as $lead) {
                    $lead->fields = $this->getCustomFields($lead);
                }
            }

            //initial loadmore button
            if ($leads->currentPage() < $leads->lastPage()) {
                $boards[$status->leadstatus_id]['load_more'] = '';
                $boards[$status->leadstatus_id]['load_more_url'] = loadMoreButtonUrl($leads->currentPage() + 1, $status->leadstatus_id);
            } else {

                $boards[$status->leadstatus_id]['load_more'] = 'hidden';
                $boards[$status->leadstatus_id]['load_more_url'] = '';
            }

            $boards[$status->leadstatus_id]['name'] = $status->leadstatus_title;
            $boards[$status->leadstatus_id]['id'] = $status->leadstatus_id;
            $boards[$status->leadstatus_id]['leads'] = $leads;
            $boards[$status->leadstatus_id]['color'] = $status->leadstatus_color;
        }

        return $boards;
    }
    /**
     * [AFFILIATE]
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function csAffiliateDashboard()
    {

        //get events
        $events = \App\Models\Custom\CSEvent::Where('cs_event_affliateid', auth()->id())->orderBy('cs_event_id', 'DESC')
            ->take(100)
            ->get();

        //get projects
        $projects = \App\Models\Custom\CSAffiliateProject::leftJoin('projects', 'projects.project_id', '=', 'cs_affiliate_projects.cs_affiliate_project_projectid')
            ->selectRaw('*')
            ->Where('cs_affiliate_project_affiliateid', auth()->id())
            ->where('cs_affiliate_project_status', 'active')
            ->orderBy('cs_affiliate_project_id', 'DESC')
            ->take(100)
            ->get();

        //Profits - today
        $today = \Carbon\Carbon::now()->format('Y-m-d');
        $profits['today'] = \App\Models\Custom\CSAffiliateEarning::where('cs_affiliate_earning_commission_approval_date', $today)
            ->where('cs_affiliate_earning_affiliateid', auth()->id())
            ->where('cs_affiliate_earning_status', 'paid')
            ->sum('cs_affiliate_earning_amount');

        //Profits - today
        $start = \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = \Carbon\Carbon::now()->endOfMonth()->format('Y-m-d');
        $profits['this_month'] = \App\Models\Custom\CSAffiliateEarning::where('cs_affiliate_earning_commission_approval_date', '>=', $start)
            ->where('cs_affiliate_earning_commission_approval_date', '<=', $end)
            ->where('cs_affiliate_earning_status', 'paid')
            ->where('cs_affiliate_earning_affiliateid', auth()->id())
            ->sum('cs_affiliate_earning_amount');

        //Profits - all time
        $profits['all_time'] = \App\Models\Custom\CSAffiliateEarning::where('cs_affiliate_earning_affiliateid', auth()->id())
            ->where('cs_affiliate_earning_status', 'paid')
            ->sum('cs_affiliate_earning_amount');

        //Profits - pending
        $profits['pending'] = \App\Models\Custom\CSAffiliateEarning::where('cs_affiliate_earning_affiliateid', auth()->id())
            ->where('cs_affiliate_earning_status', 'unpaid')
            ->sum('cs_affiliate_earning_amount');

        $payload = [
            'events' => $events,
            'projects' => $projects,
            'profits' => $profits,
        ];

        return $payload;
    }

    /**
     * display team dashboard
     * @return \Illuminate\Http\Response
     */
    public function teamDashboard()
    {

        //payload
        $payload = [];

        //[projects][all]
        $payload['projects'] = [
            'pending' => $this->statsrepo->countProjects([
                'status' => 'pending',
                'assigned' => auth()->id(),
            ]),
        ];

        //tasks]
        $payload['tasks'] = [
            'new' => $this->statsrepo->countTasks([
                'status' => 'new',
                'assigned' => auth()->id(),
            ]),
            'pending' => $this->statsrepo->countTasks([
                'status' => 'pending',
                'assigned' => auth()->id(),
            ]),
            'completed' => $this->statsrepo->countTasks([
                'status' => 'completed',
                'assigned' => auth()->id(),
            ]),
        ];

        //filter
        request()->merge([
            'eventtracking_userid' => auth()->id(),
        ]);
        $payload['all_events'] = $this->trackingrepo->search(20);

        //filter
        request()->merge([
            'filter_assigned' => [auth()->id()],
        ]);
        $payload['my_projects'] = $this->projectrepo->search('', ['limit' => 30]);

        //return payload
        return $payload;
    }

    /**
     * display client dashboard
     * @return \Illuminate\Http\Response
     */
    public function clientDashboard()
    {

        //payload
        $payload = [];

        //[invoices]
        $payload['invoices'] = [
            'due' => $this->statsrepo->sumCountInvoices([
                'type' => 'sum',
                'status' => 'due',
                'client_id' => auth()->user()->clientid,
            ]),
            'overdue' => $this->statsrepo->sumCountInvoices([
                'type' => 'sum',
                'status' => 'overdue',
                'client_id' => auth()->user()->clientid,
            ]),
        ];

        //[projects][all]
        $payload['projects'] = [
            'pending' => $this->statsrepo->countProjects([
                'status' => 'pending',
                'client_id' => auth()->user()->clientid,
            ]),
            'completed' => $this->statsrepo->countProjects([
                'status' => 'completed',
                'client_id' => auth()->user()->clientid,
            ]),
        ];

        //filter
        request()->merge([
            'eventtracking_userid' => auth()->id(),
        ]);
        $payload['all_events'] = $this->trackingrepo->search(20);

        //filter
        request()->merge([
            'filter_project_clientid' => auth()->user()->clientid,
        ]);
        $payload['my_projects'] = $this->projectrepo->search('', ['limit' => 30]);

        //return payload
        return $payload;
    }

    /**
     * display admin User
     * @return \Illuminate\Http\Response
     */
    public function adminDashboard()
    {
        $filter = '';
        $from = '';
        $to = '';
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        if (request()->get('filter')) {
            $filter = request()->get('filter');
            if ($filter == 'last-month') {
                $month = Carbon::now()->subMonth()->month;
            } else if ($filter == 'last-year') {
                $year = Carbon::now()->subYear()->year;
            } else if ($filter == 'custom') {
                $from = request()->get('start_date');
                $to = request()->get('end_date');
            }
        }

        //payload
        $payload = [];
       
        
        //[payments]
        $payload['payments'] = [
            'today' => $this->statsrepo->sumCountPayments([
                'type' => 'sum',
                'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            ]),
            'this_month' => $this->statsrepo->sumCountPayments([
                'type' => 'sum',
                'start_date' => \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d'),
                'end_date' => \Carbon\Carbon::now()->lastOfMonth()->format('Y-m-d'),
            ]),
        ];

        //[invoices]
        $payload['invoices'] = [
            'due' => $this->statsrepo->sumCountInvoices([
                'type' => 'sum',
                'status' => 'due',
            ]),
            'overdue' => $this->statsrepo->sumCountInvoices([
                'type' => 'sum',
                'status' => 'overdue',
            ]),
        ];

        //[income][yearly]
        $payload['income'] = $this->statsrepo->sumYearlyIncome([
            'period' => 'this_year',
        ]);

        //[expense][yearly]
        $payload['expenses'] = $this->statsrepo->sumYearlyExpenses([
            'period' => 'this_year',
        ]);

        //[projects][all]
        $payload['all_projects'] = [
            'not_started' => $this->statsrepo->countProjects([
                'status' => 'not_started',
            ]),
            'in_progress' => $this->statsrepo->countProjects([
                'status' =>
                'in_progress',
            ]),
            'on_hold' => $this->statsrepo->countProjects([
                'status' => 'on_hold',
            ]),
            'completed' => $this->statsrepo->countProjects([
                'status' => 'completed',
            ]),
        ];

        //[projects][ny]
        $payload['my_projects'] = [
            'not_started' => $this->statsrepo->countProjects([
                'status' => 'not_started',
                'assigned' => auth()->id(),
            ]),
            'in_progress' => $this->statsrepo->countProjects([
                'status' => 'in_progress',
                'assigned' => auth()->id(),
            ]),
            'on_hold' => $this->statsrepo->countProjects([
                'status' => 'on_hold',
                'assigned' => auth()->id(),
            ]),
            'completed' => $this->statsrepo->countProjects([
                'status' => 'completed',
                'assigned' => auth()->id(),
            ]),
        ];

        //filter
        $payload['all_events'] = $this->eventsrepo->search([
            'pagination' => 20,
            'filter' => 'timeline_visible',
        ]);

        //[leads] - alltime
        $data = $this->widgetLeads('alltime');
        $payload['leads_stats'] = json_encode($data['stats']);
        $payload['leads_key_colors'] = json_encode($data['leads_key_colors']);
        $payload['leads_chart_center_title'] = $data['leads_chart_center_title'];

        //filter payments-today
        $payload['filter_payment_today'] = \Carbon\Carbon::now()->format('Y-m-d');

        //filter payments - this month
        $payload['filter_payment_month_start'] = \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d');
        $payload['filter_payment_month_end'] = \Carbon\Carbon::now()->lastOfMonth()->format('Y-m-d');

        
        //category chart
        $categoryValue = [];
        $categoriesMap = [];
        $categoryData = [__('lang.categories')];
        $categories = Category::where('category_creatorid', auth()->id())->where('category_type', 'project')->get();
        
        foreach ($categories as $key => $value) {
            /*$categoriesMap = Category::where('category_creatorid', auth()->id())
                ->where('category_type', 'project')
                ->where('category_name', $value->category_name)
                ->withCount('leads');*/
            $categoriesMap = Category::where('category_creatorid', auth()->id())
                ->where('category_type', 'project')
                ->where('category_name', $value->category_name)
                ->withCount('projects');
              
             // if($key==0){
                 //  dd($categoriesMap->toSql());
               //   dd($categoriesMap->get());
              //}
            if ($filter == 'current-month') {
                $categoriesMap = $categoriesMap->whereMonth('category_created', $month);
            } else if ($filter == 'last-month') {
                $categoriesMap = $categoriesMap->whereMonth('category_created', $month);
            } else if ($filter == 'this-year') {
                $categoriesMap = $categoriesMap->whereYear('category_created', $year);
            } else if ($filter == 'last-year') {
                $categoriesMap = $categoriesMap->whereYear('category_created', $year);
            } else if ($filter == 'custom') {
                $categoriesMap = $categoriesMap->whereBetween('category_created', [$from, $to]);
            }
            
            $categoriesMap = $categoriesMap->get();
            $categoryData[] = $categoriesMap->sum('projects_count');
            $categoryValue[] = $value->category_name;
        }
        
        $payload['categoryData'] = json_encode($categoryData);
        $payload['categoryValue'] = json_encode($categoryValue);
        //return payload
        
        return $payload;
    }

    /**
     * create a leads widget
     * [UPCOMING] call this via ajax for dynamically changing dashboad filters
     * @param string $filter [alltime|...]  //add as we go
     * @return \Illuminate\Http\Response
     */
    public function widgetLeads($filter)
    {

        $payload['stats'] = [];
        $payload['leads_key_colors'] = [];
        $payload['leads_chart_center_title'] = __('lang.leads');

        $counter = 0;

        //do this for each lead category
        foreach (config('home.lead_statuses') as $status) {

            //count all leads
            $count = 0;
            if (!is_array($filter) && $filter == 'alltime') {
                $count = \App\Models\Lead::where(['lead_status' => $status['id'], 'lead_creatorid' => auth()->id()])->count();
            } else if (is_array($filter)) {
                $leads = \App\Models\Lead::where(['lead_status' => $status['id'], 'lead_creatorid' => auth()->id()]);
                if ($filter['filter'] != '') {
                    if ($filter['filter'] == 'current-month') {
                        $leads = $leads->whereMonth('lead_created', $filter['month']);
                        // $statuses = $statuses->whereMonth('leadstatus_created', $month);
                    } else if ($filter == 'last-month') {
                        $leads = $leads->whereMonth('lead_created', $filter['month']);
                        // $statuses = $statuses->whereMonth('leadstatus_created', $month);
                    } else if ($filter == 'this-year') {
                        $leads = $leads->whereYear('lead_created', $filter['year']);
                        // $statuses = $statuses->whereYear('leadstatus_created', $year);
                    } else if ($filter == 'last-year') {
                        $leads = $leads->whereYear('lead_created', $filter['year']);
                        // $statuses = $statuses->whereYear('leadstatus_created', $year);
                    } else if ($filter == 'custom') {
                        $leads = $leads->whereBetween('lead_created', [$filter['from'], $filter['to']]);
                        // $statuses = $statuses->whereBetween('leadstatus_created', [$from, $to]);
                    }
                } else {
                    $leads = $leads->whereMonth('lead_created', $filter['month']);
                    // $statuses = $statuses->whereMonth('leadstatus_created', $month);
                }
                $count = $leads->count();
            }

            //add to array
            $payload['stats'][] = [
                $status['title'], $count,
            ];

            //add to counter
            $counter += $count;

            $payload['leads_key_colors'][] = $status['colorcode'];
        }

        // no lead in system - display something (No Leads - 100%) in chart
        if ($counter == 0) {
            $payload['stats'][] = [
                'No Leads', 1,
            ];
            $payload['leads_key_colors'][] = "#eff4f5";
            $payload['leads_chart_center_title'] = __('lang.no_leads');
        }
        return $payload;
    }
    /**
     * basic page setting for this section of the app
     * @param string $section page section (optional)
     * @param array $data any other data (optional)
     * @return array
     */
    private function pageSettings($section = '', $data = [])
    {

        $page = [
            'crumbs' => [
                __('lang.home'),
            ],
            'crumbs_special_class' => 'main-pages-crumbs',
            'page' => 'home',
            'meta_title' => __('lang.home'),
            'heading' => __('lang.home'),
            'mainmenu_home' => 'active',
            'add_button_classes' => '',
        ];

        return $page;
    }

    /**
     * basic page setting for this section of the app
     * @param string $section page section (optional)
     * @param array $data any other data (optional)
     * @return array
     */
    private function pageSettingsdashboard($section = '', $data = [])
    {

        $page = [
            'crumbs' => [
                __('lang.home'),
            ],
            'crumbs_special_class' => 'main-pages-crumbs',
            'page' => 'home',
            'meta_title' => __('lang.home'),
            'heading' => __('lang.home'),
            'mainmenu_homes' => 'active',
            'add_button_classes' => '',
        ];

        return $page;
    }
}
