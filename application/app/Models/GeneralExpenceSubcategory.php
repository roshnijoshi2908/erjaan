<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralExpenceSubcategory extends Model {

    /**
     * @primaryKey string - primry key column.
     * @dateFormat string - date storage format
     * @guarded string - allow mass assignment except specified
     * @CREATED_AT string - creation date column
     * @UPDATED_AT string - updated date column
     */

    protected $table = 'general_expence_subcategories';
    protected $primaryKey = 'expense_subcategory_id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $guarded = ['expense_subcategory_id'];
    const CREATED_AT = 'expense_subcategory_created';
    const UPDATED_AT = 'expense_subcategory_updated';
}