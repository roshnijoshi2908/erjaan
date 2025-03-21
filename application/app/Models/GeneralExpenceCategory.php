<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralExpenceCategory extends Model {

    /**
     * @primaryKey string - primry key column.
     * @dateFormat string - date storage format
     * @guarded string - allow mass assignment except specified
     * @CREATED_AT string - creation date column
     * @UPDATED_AT string - updated date column
     */

    protected $table = 'general_expence_categories';
    protected $primaryKey = 'expense_category_id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $guarded = ['expense_category_id'];
    const CREATED_AT = 'expense_category_created';
    const UPDATED_AT = 'expense_category_updated';
}