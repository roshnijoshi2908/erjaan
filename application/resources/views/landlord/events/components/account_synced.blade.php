<!--GENERAL FEED-->
@if(in_array(request('ref-source'), ['home','events']) || !request()->filled('ref-source'))
<!--title-->
<div class="m-t-7">
    @lang('lang.event_synced_account')
</div>
<!--link to customer-->
<div class="m-t-3">
    <a href="{{ url('app-admin/customer').$event->event_customer_id }}" target="_blank">{{ $event->event_payload_1 }}</a>
</div>
@endif

<!--CUSTOMER PAGE-->
@if(in_array(request('ref-source'), ['customer']))
<!--title-->
<div class="m-t-7">
    @lang('lang.event_synced_account')
</div>
@endif