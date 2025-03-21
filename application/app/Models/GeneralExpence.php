<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralExpence extends Model {

    /**
     * @primaryKey string - primry key column.
     * @dateFormat string - date storage format
     * @guarded string - allow mass assignment except specified
     * @CREATED_AT string - creation date column
     * @UPDATED_AT string - updated date column
     */

    protected $table = 'general_expence';
    protected $primaryKey = 'generalexpence_id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $guarded = ['generalexpence_id'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * relatioship business rules:
     *         - the Creator (user) can have many Proposals
     *         - the Proposal belongs to one Creator (user)
     */
    // public function creator() {
    //     return $this->belongsTo('App\Models\User', 'doc_creatorid', 'id');
    // }

    /**
     * relatioship business rules:
     *         - the Category can have many Proposals
     *         - the Proposal belongs to one Category
     */
    // public function category() {
    //     return $this->belongsTo('App\Models\Category', 'doc_categoryid', 'category_id');
    // }

    /**
     * relatioship business rules:
     *         - the Proposal can have many Tags
     *         - the Tags belongs to one Proposal
     *         - other tags can belong to other tables
     */
    // public function tags() {
    //     return $this->morphMany('App\Models\Tag', 'tagresource');
    // }
}