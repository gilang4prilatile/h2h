<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @property integer $id
 * @property integer $inbound_transportation_id
 * @property integer $port_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $type
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property InboundTransportation $inboundTransportation
 * @property Port $port
 * @property User $user
 */
class InboundTransportationPort extends Model
{
    // For Duplicate or Copy Data
    protected $guarded = ['id'];
    protected $table = 'inbound_transportation_ports';
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['inbound_transportation_id', 'port_id', 'created_by', 'updated_by', 'type', 'created_at', 'updated_at'];

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
    public function inboundTransportation()
    {
        return $this->belongsTo('App\Models\InboundTransportation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function port()
    {
        return $this->belongsTo('App\Models\Port');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public static function getDataPorts($inboundTransportationId)
    {
        return self::select(['ports.*', 'inbound_transportation_ports.type'])
            ->join('ports', 'ports.id', '=', 'inbound_transportation_ports.port_id')
            ->where('inbound_transportation_ports.inbound_transportation_id', '=', $inboundTransportationId)
            ->get();
    }

    public static function getDataPortTypes($ransportationId)
    {
        return self::join('ports', 'inbound_transportation_ports.port_id', '=', 'ports.id')
            ->where('inbound_transportation_ports.inbound_transportation_id', $ransportationId)
            ->whereIn('inbound_transportation_ports.type', ['tujuan', 'muat', 'import', 'export', 'bongkar','transit'])
            ->get()
            ->keyBy('type');
    }
    
}
