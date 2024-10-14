<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Country
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @method static Builder|Country newModelQuery()
 * @method static Builder|Country newQuery()
 * @method static Builder|Country query()
 * @method static Builder|Country selectBox()
 * @method static Builder|Country whereCode($value)
 * @method static Builder|Country whereCreatedAt($value)
 * @method static Builder|Country whereId($value)
 * @method static Builder|Country whereName($value)
 * @method static Builder|Country whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Country extends Model
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
    protected $fillable = ['code', 'name', 'created_at', 'updated_at', 'created_by', 'updated_by'];

    protected $appends  = ['code_name'];

    public function scopeSelectBox($query): array
    {
        $res = $query->pluck("name", "id")
            ->toArray();

        return ['' => ''] + $res;
    }

    public function getCodeNameAttribute()
    {
        return "{$this->code} - {$this->name}";
    }

}
