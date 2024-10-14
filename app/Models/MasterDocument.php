<?php

namespace App\Models;

use App\Models\Traits\SelectBox;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class MasterDocument extends Model
{

    use SelectBox;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['code', 'name','file', 'created_at', 'updated_at'];
    protected $appends  = ['code_name'];

    public function getCodeNameAttribute()
    {
        return "({$this->code}) {$this->name}";
    }

}
