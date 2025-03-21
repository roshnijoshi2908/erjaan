<!--task resources (comment|checklists|files)-->
@if($event->event_parent_type == 'task')
<a href="{{ url('/tasks/v/'.$event->event_parent_id.'/'.str_slug($event->event_parent_title)) }}">
        ({{ runtimeLang($event->event_parent_type) }}
        #{{ $event->event_parent_id }}) -
        {{ $event->event_parent_title }}</a>
@endif


<!--task (actual)-->
@if($event->event_parent_type == 'project' && $event->event_item == 'task')
<div class="x-reference">
        <a href="{{ _url('projects/'.$event->event_parent_id.'/tasks') }}"> ({{ runtimeLang($event->event_parent_type) }}
                #{{ $event->event_parent_id }}) -
                {{ $event->event_parent_title }}</a></div>
@endif


<!--lead (all event types)-->
@if($event->event_parent_type == 'lead')
<a href="{{ url('/leads/v/'.$event->event_parent_id.'/'.str_slug($event->event_parent_title)) }}">
        ({{ runtimeLang($event->event_parent_type) }} #{{ $event->event_parent_id }}) -
        {{ $event->event_parent_title }}</a>
@endif


<!--project (invoices)-->
@if($event->event_parent_type == 'project' && $event->event_item == 'invoice')
<div class="x-reference">
        <a href="{{ _url('projects/'.$event->event_parent_id.'/invoices') }}">
                ({{ runtimeLang($event->event_parent_type) }}
                #{{ $event->event_parent_id }}) -
                {{ $event->event_parent_title }}</a></div>
@endif


<!--project (files)-->
@if($event->event_parent_type == 'project' && $event->event_item == 'file')
<div class="x-reference">
        <a href="{{ _url('projects/'.$event->event_parent_id.'/files') }}"> ({{ runtimeLang($event->event_parent_type) }}
                #{{ $event->event_parent_id }}) -
                {{ $event->event_parent_title }}</a></div>
@endif


<!--project (estimates)-->
@if($event->event_parent_type == 'project' && $event->event_item == 'estimate')
<div class="x-reference">
        <a href="{{ _url('projects/'.$event->event_parent_id.'/estimates') }}">
                ({{ runtimeLang($event->event_parent_type) }}
                #{{ $event->event_parent_id }}) -
                {{ $event->event_parent_title }}</a></div>
@endif


<!--project (comments)-->
@if($event->event_parent_type == 'project' && $event->event_item == 'comment')
<div class="x-reference">
        <a href="{{ _url('projects/'.$event->event_parent_id.'/comments') }}">
                ({{ runtimeLang($event->event_parent_type) }}
                #{{ $event->event_parent_id }}) -
                {{ $event->event_parent_title }}</a></div>
@endif


<!--tickets-->
@if($event->event_item == 'ticket')
<div class="x-reference">
        {{ $event->event_item_content2 }}</div>
@endif

<!--purchase gm-->
@if($event->event_parent_type == 'purchase_gm_approver')
<div class="x-reference">
        <a href="{{ _url('gm-approvals') }}">
                ({{ runtimeLang($event->event_parent_title) }}
                #{{ $event->event_parent_id }}) </a></div>
@endif

<!--purchase accountant-->
@if($event->event_parent_type == 'purchase_accountant')
<div class="x-reference">
        <a href="{{ _url('accountant') }}">
                ({{ runtimeLang($event->event_parent_title) }}
                #{{ $event->event_parent_id }})}</a></div>
@endif

<!--general expence gm-->
@if($event->event_parent_type == 'general_expence_gm_approver')
<div class="x-reference">
        <a href="{{ _url('general-expense/gm-approvals') }}">
                ({{ runtimeLang($event->event_parent_title) }}
                #{{ $event->event_parent_id }})</a></div>
@endif

<!--general expence accountant-->
@if($event->event_parent_type == 'general_expence_accountant')
<div class="x-reference">
        <a href="{{ _url('general-expense/accountant') }}">
                ({{ runtimeLang($event->event_parent_title) }}
                #{{ $event->event_parent_id }})</a></div>
@endif