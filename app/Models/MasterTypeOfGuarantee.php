<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTypeOfGuarantee extends Model
{
    use HasFactory;
    protected $table = "master_type_of_guarantee";

    /**
     * @var array
     */
    protected $fillable = ['code', 'name'];

    public function createdBy()
    {
        return $this->belongsTo('App/User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App/User', 'updated_by');
    }
    
}
