<?php

namespace App\Models;

use App\User;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\MasterJenisTpb
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
 * @method static Builder|MasterJenisTpb newModelQuery()
 * @method static Builder|MasterJenisTpb newQuery()
 * @method static Builder|MasterJenisTpb query()
 * @method static Builder|MasterJenisTpb whereCode($value)
 * @method static Builder|MasterJenisTpb whereCreatedAt($value)
 * @method static Builder|MasterJenisTpb whereCreatedBy($value)
 * @method static Builder|MasterJenisTpb whereId($value)
 * @method static Builder|MasterJenisTpb whereName($value)
 * @method static Builder|MasterJenisTpb whereUpdatedAt($value)
 * @method static Builder|MasterJenisTpb whereWarehouseId($value)
 * @mixin Eloquent
 */
class MasterJenisTpb extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_jenis_tpb';
    protected $appends  = ['code_name'];
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

    public function getSelectBox($bc = ""): array
    {
        $data = $this;

        if (!empty($bc)) {
            $data = $data->where("bc", $bc);
        }

        $data = $data->get()
            ->pluck("name", "id")
            ->toArray();

        return ['' => '-- Select --'] + $data;
    }

    public function getCodeNameAttribute()
    {
        return "{$this->code} - {$this->name}";
    }
}
