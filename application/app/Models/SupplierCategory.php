<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierCategory extends Model {

    /**
     * @primaryKey string - primry key column.
     * @dateFormat string - date storage format
     * @guarded string - allow mass assignment except specified
     * @CREATED_AT string - creation date column
     * @UPDATED_AT string - updated date column
     */
    protected $table = 'supplier_categories';
    protected $primaryKey = 'supplier_category_id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $guarded = ['supplier_category_id'];
    const CREATED_AT = 'supplier_category_created';
    const UPDATED_AT = 'supplier_category_updated';

    /**
     * relatioship business rules:
     *         - the Creator (user) can have many Categories
     *         - the Category belongs to one Creator (user)
     */
    public function creator() {
        return $this->belongsTo('App\Models\User', 'category_creatorid', 'id');
    }
    
    
    /**
     * relatioship business rules:
     *         - the Category can have many Proposal
     *         - the Contract belongs to one Category
     */
    public function supplier() {
        return $this->hasMany('App\Models\Supplier', 'supplier_categoryid', 'supplier_category_id');
    }
}
