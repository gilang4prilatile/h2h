<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Action
 *
 * @property integer $id
 * @property integer $menu_id
 * @property string $url
 * @property string $name
 * @property boolean $type
 * @property string $created_at
 * @property string $updated_at
 * @property Menu $menu
 * @property string $code
 * @method static Builder|Action newModelQuery()
 * @method static Builder|Action newQuery()
 * @method static Builder|Action query()
 * @method static Builder|Action whereCode($value)
 * @method static Builder|Action whereCreatedAt($value)
 * @method static Builder|Action whereId($value)
 * @method static Builder|Action whereMenuId($value)
 * @method static Builder|Action whereName($value)
 * @method static Builder|Action whereType($value)
 * @method static Builder|Action whereUpdatedAt($value)
 * @method static Builder|Action whereUrl($value)
 * @mixin Eloquent
 */
class Action extends Model
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
    protected $fillable = ['menu_id', 'url', 'name', 'type', 'created_at', 'updated_at', 'code'];

    /**
     * @return BelongsTo
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo('App\Models\Menu');
    }
}
