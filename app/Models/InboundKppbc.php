<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $inbound_id
 * @property integer $kppbc_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Inbound $inbound
 * @property MasterKppbc $masterKppbc
 * @property User $user
 */
class InboundKppbc extends Model
{

    // For Duplicate or Copy Data
    protected $guarded = ['id'];

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['inbound_id', 'kppbc_id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'type'];

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
    public function inbound()
    {
        return $this->belongsTo('App\Models\Inbound');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function masterKppbc()
    {
        return $this->belongsTo('App\Models\MasterKppbc', 'kppbc_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
