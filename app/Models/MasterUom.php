<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MasterUom
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @method static Builder|MasterUom newModelQuery()
 * @method static Builder|MasterUom newQuery()
 * @method static Builder|MasterUom query()
 * @method static Builder|MasterUom whereCode($value)
 * @method static Builder|MasterUom whereCreatedAt($value)
 * @method static Builder|MasterUom whereId($value)
 * @method static Builder|MasterUom whereName($value)
 * @method static Builder|MasterUom whereUpdatedAt($value)
 * @mixin Eloquent
 */
class MasterUom extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_uom';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['code', 'name', 'created_at', 'updated_at'];
    protected $appends  = ['code_name'];

    public function getSelectBox()
    {
        $data = $this
            ->selectRaw("id, name")
            ->get()
            ->pluck("name", "id")
            ->toArray();

        return ['' => '-- Select --'] + $data;
    }

    public function getCodeNameAttribute()
    {
        return "{$this->code} - {$this->name}";
    }
}
