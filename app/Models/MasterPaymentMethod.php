<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPaymentMethod extends Model
{
    use HasFactory;
    protected $table = "master_payment_methods";

    /**
     * @var array
     */
    protected $fillable = ['code', 'name', 'group' , 'created_at' , 'updated_at', 'created_by', 'updated_by'];

    public function createdBy()
    {
        return $this->belongsTo('App/User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App/User', 'updated_by');
    }
}