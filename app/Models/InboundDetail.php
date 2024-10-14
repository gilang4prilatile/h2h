<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $inbound_id
 * @property integer $good_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $quantity
 * @property float $nett_weight
 * @property float $volume
 * @property float $amount
 * @property mixed $details
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Good $good
 * @property Inbound $inbound
 * @property User $user
 * @property Inventory[] $inventories
 */
class InboundDetail extends Model
{
    // For Duplicate or Copy Data
    protected $guarded = ['id'];
    protected $casts = ["details" => "array", "package_details" => "array"];
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = [
        'inbound_id', 
        'good_id', 
        'created_by', 
        'updated_by', 
        'quantity', 
        'nett_weight', 
        'volume', 
        'amount', 
        'details', 
        'created_at', 
        'updated_at', 
        'package_id', 
        'package_details',
        'hs_code_id',
        'lartas',
        'no_seri',
        'rate_preference_id'        
    ];

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
    public function good()
    {
        return $this->belongsTo('App\Models\Good');
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventories()
    {
        return $this->hasMany('App\Models\Inventory');
    }

    public function package() {
        return $this->belongsTo(MasterPackage::class, 'package_id');
    }

    public function hsCode() {
        return $this->belongsTo(HsCode::class, 'hs_code_id');
    }

    public function ratePreference() {
        return $this->belongsTo(RatePreference::class, 'rate_preference_id');
    }
}
