<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\MasterKppbc
 *
 * @property integer $id
 * @property integer $warehouse_id
 * @property integer $created_by
 * @property string $code
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Warehouse $warehouse
 * @method static Builder|MasterKppbc newModelQuery()
 * @method static Builder|MasterKppbc newQuery()
 * @method static Builder|MasterKppbc query()
 * @method static Builder|MasterKppbc whereCode($value)
 * @method static Builder|MasterKppbc whereCreatedAt($value)
 * @method static Builder|MasterKppbc whereCreatedBy($value)
 * @method static Builder|MasterKppbc whereDescription($value)
 * @method static Builder|MasterKppbc whereId($value)
 * @method static Builder|MasterKppbc whereUpdatedAt($value)
 * @method static Builder|MasterKppbc whereWarehouseId($value)
 * @mixin Eloquent
 */
class MasterKppbc extends Model
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_kppbc';
    
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['warehouse_id', 'created_by', 'code', 'description', 'created_at', 'updated_at'];

    protected $appends  = ['code_name'];
    /**
     * @return BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    /**
     * @return BelongsTo
     */
    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    /**
     * @return BelongsTo
     */
    public function port()
    {
        return $this->belongsTo('App\Models\Port');
    }

    public function getSelectBox()
    {
        $data = $this->all()
            ->pluck("description", "id")
            ->toArray();

        return ['' => '-- Select --'] + $data;
    }

    public function getCodeNameAttribute()
    {
        return "{$this->code} - {$this->description}";
    }
}
