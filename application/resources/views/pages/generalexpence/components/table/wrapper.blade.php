<!--checkbox actions-->
@include('pages.generalexpence.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.generalexpence.components.table.table')
<!--filter-->
<!--if(auth()->user()->is_team)-->
@include('pages.generalexpence.components.misc.filter-generalexpence')
<!--endif-->
<!--filter-->