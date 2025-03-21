<!--checkbox actions-->
@include('pages.purchase.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.purchase.components.table.table')
<!--filter-->
<!--if(auth()->user()->is_team)-->
@include('pages.purchase.components.misc.filter-purchase')
@include('pages.export.purchase.export')
<!--endif-->
<!--filter-->