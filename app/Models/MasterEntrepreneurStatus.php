<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterEntrepreneurStatus extends Model
{
    protected $table = 'master_entrepreneur_status';
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['code', 'name', 'created_at', 'updated_at', 'created_by', 'updated_by'];

    public function scopeSelectBox($query): array
    {
        $res = $query->pluck("name", "id")
            ->toArray();

        return ['' => ''] + $res;
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
