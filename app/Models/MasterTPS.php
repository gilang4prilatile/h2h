<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTPS extends Model
{

    protected $table = 'master_tps';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['code_office', 'code_warehouse', 'name' , 'alamat' , 'created_at', 'updated_at'];

    protected $appends  = ['code_name'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inboundTPS()
    {
        return $this->hasMany('App\Models\InboundTPS');
    }

    public function getCodeNameAttribute()
    {
        return "({$this->code_warehouse}) {$this->name}";
    }
}
