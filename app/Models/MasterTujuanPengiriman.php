<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\MasterTujuanPengiriman
 *
 * @property integer $id
 * @property integer $warehouse_id
 * @property integer $created_by
 * @property string $code
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Warehouse $warehouse
 * @method static Builder|MasterTujuanPengiriman newModelQuery()
 * @method static Builder|MasterTujuanPengiriman newQuery()
 * @method static Builder|MasterTujuanPengiriman query()
 * @method static Builder|MasterTujuanPengiriman whereCode($value)
 * @method static Builder|MasterTujuanPengiriman whereCreatedAt($value)
 * @method static Builder|MasterTujuanPengiriman whereCreatedBy($value)
 * @method static Builder|MasterTujuanPengiriman whereId($value)
 * @method static Builder|MasterTujuanPengiriman whereName($value)
 * @method static Builder|MasterTujuanPengiriman whereUpdatedAt($value)
 * @method static Builder|MasterTujuanPengiriman whereWarehouseId($value)
 * @mixin Eloquent
 */
class MasterTujuanPengiriman extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_delivery_destination';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    // protected $fillable = ['warehouse_id', 'created_by', 'code', 'name', 'created_at', 'updated_at'];
    protected $fillable = ['code_document', 'code', 'name', 'created_by',  'updated_by', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    /**
     * @return BelongsTo
     */
    // public function warehouse()
    // {
    //     return $this->belongsTo('App\Models\Warehouse');
    // }

    public function getSelectBox($bc = ""): array
    {
        $data = $this;

        $data = $data->get()
            ->pluck("name", "id")
            ->toArray();

        return ['' => '-- Select --'] + $data;
    }
}
