<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTypeGoods extends Model
{
    use HasFactory;
    protected $table = "master_type_goods";

    /**
     * @var array
     */
    protected $fillable = ['code', 'name'];

}
