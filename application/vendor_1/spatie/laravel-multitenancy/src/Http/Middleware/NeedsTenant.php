<?php

namespace Spatie\Multitenancy\Http\Middleware;

use Closure;
use Spatie\Multitenancy\Exceptions\NoCurrentTenant;
use Spatie\Multitenancy\Models\Concerns\UsesTenantModel;
use Illuminate\Support\Facades\Log;

class NeedsTenant {
    use UsesTenantModel;

    public function handle($request, Closure $next) {

        /** -------------------------------------------------------------------------
         * [NEXTLOOP] - April 2023
         * A url was requested but tenant corresponding was not found for it
         *  - rather than throw an exception (which will clog up the log files)
         *      - we will just abort with a 404 error and log it for debugging
         *      - we have replaced the comment out code with this code.
         * -------------------------------------------------------------------------*/
        if (!$this->getTenantModel()::checkCurrent()) {
            Log::info("A tenant is required for this URL (" . request()->url() . ") and none was found - will exit with a 404 error", ['process' => '[permissions]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            abort(404);
        }

        /*
        if (! $this->getTenantModel()::checkCurrent()) {
        return $this->handleInvalidRequest();
        }
         */

        return $next($request);
    }

    public function handleInvalidRequest(): void {
        throw NoCurrentTenant::make();
    }
}
