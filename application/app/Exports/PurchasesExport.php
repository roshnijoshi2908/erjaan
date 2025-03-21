<?php

namespace App\Exports;

use App\Repositories\PurchasesRepository;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PurchasesExport implements FromCollection, WithHeadings, WithMapping {

    /**
     * The purchase repo repository
     */
    protected $purchaseRepo;


    public function __construct(PurchasesRepository $purchaseRepo) {

        $this->purchaseRepo = $purchaseRepo;

    }

    //get the purchases
    public function collection() {

        //search
        $purchases = $this->purchaseRepo->search('', ['no_pagination' => true, 'order_by_asc' => true]);
        //return
        return $purchases;
    }

    //map the columns that we want
    public function map($purchases): array{

        $map = [];

        //standard fields - loop thorugh all post data
        if (is_array(request('standard_field'))) {
            foreach (request('standard_field') as $key => $value) {
                
                if ($value == 'on') {
                   switch ($key) {
                        case 'purchase_id':
                            $map[] = $purchases->purchase_id;
                            break;
                        case 'project_title':
                            $map[] = $purchases->project_title;
                            break;
                        case 'supplier_id':
                            $map[] = $purchases->supplier_id;
                            break;
                        case 'supplier_name':
                            $map[] = $purchases->supplier_name;
                            break;
                        case 'client_id':
                            $map[] = $purchases->client_id;
                            break;
                        case 'client_name':
                            $map[] = $purchases->client_company_name;
                            break;
                        case 'purchase_created_by':
                            $map[] = $purchases->creator_first_name;
                            break;
                        case 'purchase_request_date':
                            $map[] = $purchases->purchase_request_date;
                            break;
                        case 'purchase_items_list':
                            $map[] = $purchases->purchase_items_list; 
                            break;
                        case 'costs_for_each_item':
                            $map[] = $purchases->costs_for_each_item; 
                            break;
                        case 'total_cost':
                            $map[] = $purchases->total_cost;
                            break;
                        case 'paid':
                            $map[] = $purchases->paid ? 'Yes' : 'No'; // Assuming paid is a boolean
                            break;
                        case 'selected_the_bank':
                            $map[] = $purchases->selected_the_bank;
                            break;
                        case 'purchase_status':
                            $map[] = $purchases->purchase_status;
                            break;
                        case 'purchase_approve_by':
                            $map[] = $purchases->approver_first_name;
                            break;
                        // default:
                        //     $map[] = $purchases->{$key}; // Fallback to the $projects object
                        //     break;
                    }
                }
            }
        }
        // dd($map);

        return $map;
    }

    //create heading
    public function headings(): array
    {

        //headings
        $heading = [];

        //lang - standard fields
        $standard_lang = [
            'purchase_id' => __('lang.id'),
            'project_title' => __('lang.project'),
            'supplier_id' => __('lang.supplier_id'),
            'supplier_name' => __('lang.supplier'),
            'client_id' => __('lang.client_id'),
            'client_name' => __('lang.client_name'),
            'purchase_created_by' => __('lang.created_by'),
            'purchase_request_date' => __('lang.request_date'),
            'purchase_items_list' => __('lang.purchase_items_list'),
            'costs_for_each_item' => __('lang.costs_for_each_item'),
            'total_cost' => __('lang.total_cost'),
            'paid' => __('lang.paid'),
            'selected_the_bank' => __('lang.selected_the_bank'),
            'purchase_status' => __('lang.status'),
            'purchase_approve_by' => __('lang.approved_by'),
        ];
        
         if (is_array(request('standard_field'))) {
            foreach (request('standard_field') as $key => $value) {
                if ($value == 'on') {
                    $heading[] = (isset($standard_lang[$key])) ? $standard_lang[$key] : $key;
                }
            }
        }

        //return full headings
        return $heading;
    }
}
