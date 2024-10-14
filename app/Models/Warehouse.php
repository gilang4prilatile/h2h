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
 * @property InboundBc40Header[] $inboundBc40Headers
 * @property Item[] $items
 * @property MasterJenisTpb[] $masterJenisTpbs
 * @property MasterKppbc[] $masterKppbcs
 * @property MasterPackage[] $masterPackages
 * @property MasterPengirimBarang[] $masterPengirimBarangs
 * @property MasterTpb[] $masterTpbs
 * @property MasterTujuanPengiriman[] $masterTujuanPengirimen
 * @property User[] $users
 */
class Warehouse extends Model
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
    protected $fillable = ['code', 'name', 'city', 'notifier', 'position','division', 'address', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inboundBc40Headers()
    {
        return $this->hasMany('App\Models\InboundBc40Header');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function masterJenisTpbs()
    {
        return $this->hasMany('App\Models\MasterJenisTpb');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function masterKppbcs()
    {
        return $this->hasMany('App\Models\MasterKppbc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function masterPackages()
    {
        return $this->hasMany('App\Models\MasterPackage');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function masterPengirimBarangs()
    {
        return $this->hasMany('App\Models\MasterPengirimBarang');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function masterTpbs()
    {
        return $this->hasMany('App\Models\MasterTpb');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function masterTujuanPengirimen()
    {
        return $this->hasMany('App\Models\MasterTujuanPengiriman');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
