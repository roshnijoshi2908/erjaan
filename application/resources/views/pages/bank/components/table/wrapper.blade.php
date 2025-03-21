<!--checkbox actions-->
@include('pages.bank.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.bank.components.table.table')
<!--filter-->
<!--if(auth()->user()->is_team)-->
@include('pages.bank.components.misc.filter-bank')
<!--endif-->
<!--filter-->