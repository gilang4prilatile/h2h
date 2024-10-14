<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $name
 * @property string $address
 * @property string $type
 * @property mixed $details
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property User $user
 * @property InboundProfile[] $inboundProfiles
 * @property OutboundProfile[] $outboundProfiles
 */
class Profile extends Model
{
    // For Duplicate or Copy Data
    protected $guarded = ['id'];
    protected $casts = ["details" => "array", "types" => "array"];
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['created_by', 'updated_by', 'name', 'address', 'country_id', 'types', 'warehouse_id' , 'details', 'created_at', 'updated_at'];

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
    public function inboundProfiles()
    {
        return $this->hasMany('App\Models\InboundProfile');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function outboundProfiles()
    {
        return $this->hasMany('App\Models\OutboundProfile');
    }
    
    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }
}
