<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $bc_form_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property BcForm $bcForm
 * @property User $user
 * @property InboundHistory[] $inboundHistories
 * @property Inbound[] $inbounds
 * @property OutboundHistory[] $outboundHistories
 * @property Outbound[] $outbounds
 */
class Status extends Model
{
    use HasFactory;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['bc_form_id', 'created_by', 'updated_by', 'name', 'description', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bcForm()
    {
        return $this->belongsTo('App\Models\BcForm');
    }

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
    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inboundHistories()
    {
        return $this->hasMany('App\Models\InboundHistory');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inbounds()
    {
        return $this->hasMany('App\Models\Inbound');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function outboundHistories()
    {
        return $this->hasMany('App\Models\OutboundHistory');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function outbounds()
    {
        return $this->hasMany('App\Models\Outbound');
    }
}
