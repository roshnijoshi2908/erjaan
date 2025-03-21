<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceSetting extends Model {

    /**
     * @primaryKey string - primry key column.
     * @guarded string - allow mass assignment except specified
     */
    protected $primaryKey = 'id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $guarded = ['id'];
    protected $fillable = ['user_id','logo','text_color_code','color_code'];
    
}
