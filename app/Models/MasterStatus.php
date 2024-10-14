<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterStatus extends Model
{
    use HasFactory;
    protected $table = "master_status";

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
        return $this->updatedBy('App/User', 'updated_by');
    }

}
