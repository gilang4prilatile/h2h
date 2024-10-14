<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $inbound_id
 * @property integer $status_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Inbound $inbound
 * @property Status $status
 * @property User $user
 */
class InboundHistory extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['inbound_id', 'status_id', 'created_by', 'updated_by', 'description', 'created_at', 'updated_at'];

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
    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updateBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
