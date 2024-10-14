<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterFasilitas extends Model
{
    use HasFactory;

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
    protected $fillable = ['created_by', 'updated_by', 'name', 'created_at', 'updated_at','code'];
    
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

    public function outboundDetail(){
        return $this->hasMany('App\Models\InboundDetail');
    }

    public function getCodeNameAttribute()
    {
        return "[{$this->code}] {$this->name}";
    }
}
