<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [index] precheck processes for clients
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Supplier;

use Closure;
use Log;

class Index {

    /**
     * This middleware does the following
     *   2. checks users permissions to [view] clients
     *   3. modifies the request object as needed
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        //various frontend and visibility settings
        $this->fronteEnd();

        //permission: does user have permission view clients
        if (auth()->user()->role->role_supplier >= 1) {
            return $next($request);
        }
        
        if (auth()->user()->role->role_supplier >= 1) {
            //limit to own expenses, if applicable
            if (auth()->user()->role->role_expenses_scope == 'own') {
                request()->merge([
                    'filter_supplier_creatorid' => auth()->id(),
                ]);
            }
            return $next($request);
        }

        //permission denied
        Log::error("permission denied", ['process' => '[permissions][supplier][index]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'user_id' => auth()->id()]);
        abort(403);
    }

    /*
     * various frontend and visibility settings
     */
    private function fronteEnd() {

        /**
         * shorten resource type and id (for easy appending in blade templates)
         * [usage]
         *   replace the usual url('client') with urlResource('client'), in blade templated
         * */
        if (request('supplierresource_type') != '' || is_numeric(request('supplierresource_id'))) {
            request()->merge([
                'resource_query' => 'ref=list&supplierresource_type=' . request('supplierresource_type') . '&supplierresource_id=' . request('supplierresource_id'),
            ]);
        } else {
            request()->merge([
                'resource_query' => 'ref=list',
            ]);
        }

        //permissions -viewing
        if (auth()->user()->role->role_supplier >= 1) {
            config([
                'visibility.list_page_actions_filter_button' => true,
                'visibility.list_page_actions_search' => true,
            ]);
        }

        //permissions -adding
        if (auth()->user()->role->role_supplier >= 2) {
            config([
                'visibility.list_page_actions_add_button' => true,
                'visibility.action_buttons_edit' => true,
                'visibility.clients_col_checkboxes' => true,
                'visibility.action_column' => true,
            ]);
        }

        //permissions -deleting
        if (auth()->user()->role->role_supplier >= 3) {
            config([
                'visibility.list_page_actions_add_button' => true,
                'visibility.action_buttons_delete' => true,
            ]);
        }

        //importing and exporting
        // config([
        //     'visibility.list_page_actions_exporting' => (auth()->user()->role->role_content_export == 'yes') ? true : false,
        //     'visibility.list_page_actions_importing' => (auth()->user()->role->role_content_import == 'yes') ? true : false,
        // ]);
    }

}
