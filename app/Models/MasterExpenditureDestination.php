<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterExpenditureDestination extends Model
{

    protected $table = 'master_expenditure_destination';
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['created_by', 'updated_by', 'code_document' ,'code', 'name', 'description'];
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
}
