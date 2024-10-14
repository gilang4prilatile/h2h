<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $code
 * @property mixed $details
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property User $user
 */
class HsCode extends Model
{
    protected $casts = ['details' => 'array'];
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['created_by', 'updated_by', 'code', 'details', 'created_at', 'updated_at', 'type', 'parent_id'];

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
    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function hsCode()
    {
        return $this->belongsTo(HsCode::class, 'parent_id');
    }

    public function hsCodes()
    {
        return $this->hasMany(HsCode::class);
    }
}
