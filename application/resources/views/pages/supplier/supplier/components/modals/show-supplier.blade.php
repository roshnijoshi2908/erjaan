<div class="row">
    <div class="col-lg-12">
        <div class="p-b-30">

            <table class="table table-bordered payment-details">
                <tbody>
                    <tr>
                        <td>{{ cleanLang(__('lang.supplier_id')) }}</td>
                        <td>#{{ $supplier->supplier_id }}</td>
                    </tr>
                    <tr class="font-16 font-weight-600">
                            <td>{{ cleanLang(__('lang.supplier_name')) }}</td>
                            <td>
                                {{ $supplier->supplier_name }}</td>
                            </td>
                        </tr>
                    <tr>
                        <td>{{ cleanLang(__('lang.supplier_address')) }}</td>
                        <td> {{ $supplier->supplier_address }}
                        </td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('lang.supplier_telephone')) }}</td>
                        <td>{{ $supplier->supplier_telephone }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('lang.supplier_category')) }}</td>
                        <td>{{ $categories->firstWhere('supplier_category_id', $supplier->supplier_categoryid)->category_name ?? __('lang.not_found') }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('lang.supplier_contact_person_name')) }}</td>
                        <td>{{ $supplier->supplier_contact_person_name }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('lang.supplier_contact_person_mobile')) }}</td>
                        <td>{{ $supplier->supplier_contact_person_mobile }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('lang.supplier_created_date')) }}</td>
                        <td>{{ $supplier->supplier_created_date }}</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>