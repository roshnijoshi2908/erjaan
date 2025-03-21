
@php
    $contact_lead = null;
    if (request()->has('kanban_lead_id') && request('kanban_lead_id') !== null) {
        $contact_lead = \App\Models\Lead::where('lead_id', (int) request('kanban_lead_id'))->first();
    }
@endphp
<div class="boards count-{{ @count($leads ?? []) }} js-trigger-leads-kanban-board" id="leads-view-wrapper" data-position="{{ url('leads/update-position') }}">
    <center>
        <h2 style="font-size:33px">
            {{ ucfirst($contact_lead->lead_firstname ?? '') }} {{ ucfirst($contact_lead->lead_lastname ?? '') }}
        </h2>
    </center>

    <!--each board-->
    @foreach($boards as $board)
    <!--board-->
    @include('pages.leads.components.kanban.board')
    @endforeach
</div>