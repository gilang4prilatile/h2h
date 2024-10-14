<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTradeMethod extends Model
{
    use HasFactory;
    protected $table = "master_trade_methods";

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