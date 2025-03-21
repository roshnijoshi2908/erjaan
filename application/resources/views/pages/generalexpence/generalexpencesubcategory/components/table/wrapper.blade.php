<!--checkbox actions-->
@include('pages.generalexpence.generalexpencesubcategory.components.actions.checkbox-actions')

<!--main table view-->

@include('pages.generalexpence.generalexpencesubcategory.components.table.table')
<!--filter-->
<!--if(auth()->user()->is_team)-->
@include('pages.generalexpence.generalexpencesubcategory.components.misc.filter-generalexpence')
<!--endif-->
<!--filter-->