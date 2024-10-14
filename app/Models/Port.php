<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $code
 * @property string $name
 * @property mixed $details
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property User $user
 */
class Port extends Model
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
    protected $fillable = ['created_by', 'updated_by', 'country_id','master_kppbc_id','master_kppbc_code', 'code', 'name','details', 'created_at', 'updated_at'];

    protected $appends  = ['code_name'];
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
    
    public function getCodeNameAttribute()
    {
        return "{$this->code} - {$this->name}";
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function masterKppbc()
    {
        return $this->belongsTo('App\Models\MasterKppbc', 'master_kppbc_code', 'code');
    }
}
