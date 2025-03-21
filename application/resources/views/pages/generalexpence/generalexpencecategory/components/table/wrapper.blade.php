<!--checkbox actions-->
@include('pages.generalexpence.generalexpencecategory.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.generalexpence.generalexpencecategory.components.table.table')
<!--filter-->
<!--if(auth()->user()->is_team)-->
@include('pages.generalexpence.generalexpencecategory.components.misc.filter-generalexpence')
<!--endif-->
<!--filter-->