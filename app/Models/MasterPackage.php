<?php

namespace App\Models;

use App\User;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\MasterPackage
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
 * @method static Builder|MasterPackage newModelQuery()
 * @method static Builder|MasterPackage newQuery()
 * @method static Builder|MasterPackage query()
 * @method static Builder|MasterPackage whereCode($value)
 * @method static Builder|MasterPackage whereCreatedAt($value)
 * @method static Builder|MasterPackage whereCreatedBy($value)
 * @method static Builder|MasterPackage whereId($value)
 * @method static Builder|MasterPackage whereName($value)
 * @method static Builder|MasterPackage whereUpdatedAt($value)
 * @method static Builder|MasterPackage whereWarehouseId($value)
 * @mixin Eloquent
 */
class MasterPackage extends Model
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
    protected $fillable = ['warehouse_id', 'created_by', 'code', 'name', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    protected $appends  = ['code_name'];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    /**
     * @return BelongsTo
     */
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function getSelectBox(): array
    {
        $data = $this->selectRaw("id, concat(code,' - ',name) as description")
            ->get()
            ->pluck("description", "id")
            ->toArray();

        return ['' => '-- Select --'] + $data;
    }

    public function getCodeNameAttribute()
    {
        return "{$this->code} - {$this->name}";
    }
}
