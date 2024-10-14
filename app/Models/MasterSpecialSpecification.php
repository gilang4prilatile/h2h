<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSpecialSpecification extends Model
{
    use HasFactory;
    protected $table = "master_special_specifications";

    /**
     * @var array
     */
    protected $fillable = ['group','code', 'name'];

    public function createdBy()
    {
        return $this->belongsTo('App/User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App/User', 'updated_by');
    }

}
