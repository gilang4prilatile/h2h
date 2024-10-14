<?php

namespace App\Models\Ftz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterExpenditureGoals extends Model
{
    use HasFactory;
    protected $table = "master_expenditure_goals_ftz";

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