<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterIncoterm extends Model
{
    use HasFactory;
    
    protected $appends  = ['code_name'];
    
    protected $table = 'master_incoterms';
    protected $keyType = 'integer';

    protected $fillable = ['code', 'description', 'formula', 'created_at', 'updated_at', 'created_by' , 'updated_by'];
    
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
        return "{$this->code} - {$this->description}";
    }
}
