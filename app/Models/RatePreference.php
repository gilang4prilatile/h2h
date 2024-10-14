<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $name
 * @property string $regulation
 * @property string $date
 * @property float $fee_percentage
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property User $user
 * @property InboundDetail[] $inboundDetails
 */
class RatePreference extends Model
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
    protected $fillable = ['created_by', 'updated_by', 'name', 'regulation', 'date', 'fee_percentage', 'created_at', 'updated_at','code'];

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
    public function inboundDetails()
    {
        return $this->hasMany('App\Models\InboundDetail');
    }

    public function getCodeNameAttribute()
    {
        return "({$this->code}) {$this->name}";
    }
}
