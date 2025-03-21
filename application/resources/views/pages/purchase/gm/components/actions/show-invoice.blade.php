    <div class="card-body p-t-0 p-b-0">
        <div>
            <table class="table no-border m-b-0">
                <tbody>
                    <tr>
                        <td class="p-l-0 p-t-5 w-50">{{ cleanLang(__('lang.all_invoices')) }}</td>
                        <td class="font-medium p-r-0 p-t-5">
                            {{ runtimeMoneyFormat($project->sum_invoices_all) }}
                            <div class="progress">
                                @if($project->sum_invoices_all > 0)
                                <div class="progress-bar bg-info w-100 h-px-3" role="progressbar">
                                    @else
                                    <div class="progress-bar bg-info w-0 h-px-3" role="progressbar">
                                        @endif
                                    </div>
                                </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-l-0 p-t-5">{{ cleanLang(__('lang.payments')) }}</td>
                        <td class="font-medium p-r-0 p-t-5">
                            {{ runtimeMoneyFormat($project->sum_all_payments) }}
                            <div class="progress">
                                <div class="progress-bar bg-success {{ runtimeProjectInvoicesBars($project->sum_invoices_all, $project->sum_all_payments) }}"
                                    role="progressbar"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-l-0 p-t-5">{{ cleanLang(__('lang.balance_due')) }}</td>
                        <td class="font-medium p-r-0 p-t-5">
                            {{ runtimeMoneyFormat($project->sum_invoices_all - $project->sum_all_payments) }}
                            <div class="progress">
                                <div class="progress-bar bg-warning {{ runtimeProjectInvoicesBars($project->sum_invoices_all, ($project->sum_invoices_all - $project->sum_all_payments)) }}"
                                    role="progressbar"></div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>