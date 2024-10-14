<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @property integer $id
 * @property integer $inbound_id
 * @property integer $transportation_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $vehicle_number
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Inbound $inbound
 * @property Transportation $transportation
 * @property User $user
 */
class InboundTransportation extends Model
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
    protected $fillable = ['no_seri','inbound_id', 'transportation_id', 'name', 'created_by', 'updated_by', 'vehicle_number', 'created_at', 'updated_at', 'country_code'];

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
    public function transportation()
    {
        return $this->belongsTo('App\Models\Transportation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function transportationPorts()
    {
        return $this->hasMany('App\Models\InboundTransportationPort');
    }

    public function loadingPort()
    {
        return $this->hasOne('App\Models\InboundTransportationPort')->where('type', 'muat');
    }

    public function unloadingPort()
    {
        return $this->hasOne('App\Models\InboundTransportationPort')->where('type', 'bongkar');
    }

    public function transitPort()
    {
        return $this->hasOne('App\Models\InboundTransportationPort')->where('type', 'transit');
    }

    public function destinationPort()
    {
        return $this->hasOne('App\Models\InboundTransportationPort')->where('type', 'tujuan');
    }

    public function exportPort()
    {
        return $this->hasOne('App\Models\InboundTransportationPort')->where('type', 'export');
    }
}
