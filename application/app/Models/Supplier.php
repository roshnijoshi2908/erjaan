<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model {

    /**
     * @primaryKey string - primry key column.
     * @dateFormat string - date storage format
     * @guarded string - allow mass assignment except specified
     * @CREATED_AT string - creation date column
     * @UPDATED_AT string - updated date column
     */
    protected $table = 'suppliers';
    protected $primaryKey = 'supplier_id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $guarded = ['supplier_id'];
    const CREATED_AT = 'supplier_created';
    const UPDATED_AT = 'supplier_updated';

    /**
     * relatioship business rules:
     *         - the Creator (user) can have many Categories
     *         - the Category belongs to one Creator (user)
     */
    public function creator() {
        return $this->belongsTo('App\Models\User', 'supplier_created_by', 'id');
    }
    
    /**
     * relatioship business rules:
     *         - the Category can have many Proposals
     *         - the Proposal belongs to one Category
     */
    public function supplierCategory() {
        return $this->belongsTo('App\Models\SupplierCategory', 'supplier_categoryid', 'supplier_category_id');
    }
}
