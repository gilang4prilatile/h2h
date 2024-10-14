<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class City extends Model
{    
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
    protected $fillable = ['city', 'province','status', 'created_at', 'updated_at', 'created_by', 'updated_by'];

    public function inbounds()
    {
        return $this->hasMany('App\Models\Inbound');
    }

    public function outbounds()
    {
        return $this->hasMany('App\Models\Outbound');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function getCodeNameAttribute()
    {
        return "{$this->province} , {$this->city}";
    }
}

