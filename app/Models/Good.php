<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $uom_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $name
 * @property float $nett_weight
 * @property float $volume
 * @property float $amount
 * @property mixed $details
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property MasterUom $masterUom
 * @property User $user
 * @property GoodConversion[] $goodConversions
 * @property GoodConversion[] $goodConversions
 * @property InboundDetail[] $inboundDetails
 */
class Good extends Model
{
    use HasFactory;

    protected $appends  = ['code_name'];

    protected $casts = ["details" => "array"];
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['uom_id', 'created_by', 'updated_by', 'name', 'nett_weight', 'volume', 'amount', 'details', 'created_at', 'updated_at', 'kode_barang'];

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
    public function uom()
    {
        return $this->belongsTo('App\Models\MasterUom', 'uom_id');
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
    public function goodConversions()
    {
        return $this->hasMany('App\Models\GoodConversion');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inboundDetails()
    {
        return $this->hasMany('App\Models\InboundDetail');
    }

    public function hsCode()
    {
        return $this->belongsTo('App\Models\MasterHsCode', 'hscode_id');
    }

    public function inventoryConversions()
    {
        return $this->hasMany('App\Models\InventoryConversion');
    }

    public function getCodeNameAttribute()
    {
        return "[{$this->details['kode_barang']}] {$this->name}";
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function OutboundDetailRawGood()
    {
        return $this->hasMany('App\Models\OutboundDetailRawGood');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventoryOutDetail()
    {
        return $this->hasMany('App\Models\InventoryOutDetail');
    }
}
