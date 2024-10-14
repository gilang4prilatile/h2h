<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTypePetiKemas extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'created_at', 'updated_at', 'created_by', 'updated_by'];

    protected $appends  = ['code_name'];

    public function getCodeNameAttribute()
    {
        return "{$this->code} - {$this->name}";
    }

}
