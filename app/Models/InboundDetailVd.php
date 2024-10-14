<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $document_id
 * @property integer $inbound_id
 * @property integer $inbound_detail_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $document_number
 * @property string $date
 * @property string $created_at
 * @property string $updated_at
 * @property User $user 
 * @property InboundDetail $inboundDetail
 * @property Inbound $inbound
 * @property User $user
 */
class InboundDetailVd extends Model
{
    protected $table = "inbound_detail_vd";
    // For Duplicate or Copy Data
    protected $guarded = ['id'];
    protected $casts   = ["details" => "array"];
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['inbound_id', 'inbound_detail_id', 'no_seri', 'details', 'created_by', 'updated_by','created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    } 

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inboundDetail()
    {
        return $this->belongsTo('App\Models\InboundDetail');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inbound()
    {
        return $this->belongsTo('App\Models\Inbound');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    
}