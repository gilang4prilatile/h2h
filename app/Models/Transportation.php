<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $transport_line_id
 * @property integer $country_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property Country $country
 * @property User $user
 * @property TransportLine $transportLine
 * @property User $user
 */
class Transportation extends Model
{
    protected $table = 'transportations';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['transport_line_id', 'country_id', 'created_by', 'updated_by', 'code', 'name', 'description', 'created_at', 'updated_at'];

    protected $appends  = ['code_name'];
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
    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transportLine()
    {
        return $this->belongsTo('App\Models\TransportLine');
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

}
