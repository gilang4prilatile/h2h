<?php

namespace App\Models\Ftz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterOriginGood extends Model
{
    use HasFactory;
    protected $table = "master_origin_of_goods_ftz";

    /**
     * @var array
     */
    protected $fillable = ['code', 'name'];
    protected $appends  = ['code_name'];
    public function createdBy()
    {
        return $this->belongsTo('App/User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App/User', 'updated_by');
    }
    public function getCodeNameAttribute()
    {
        return "{$this->code} - {$this->name}";
    }
}