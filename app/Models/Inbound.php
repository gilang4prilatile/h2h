<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

/**
 * @property integer $id
 * @property integer $bc_form_id
 * @property integer $status_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $request_number
 * @property mixed $details
 * @property string $created_at
 * @property string $updated_at
 * @property BcForm $bcForm
 * @property User $user
 * @property Status $status
 * @property User $user
 * @property InboundDetail[] $inboundDetails
 * @property InboundDocument[] $inboundDocuments
 * @property InboundHistory[] $inboundHistories
 * @property InboundJenisTpb[] $inboundJenisTpbs
 * @property InboundKppbc[] $inboundKppbcs
 * @property InboundPackage[] $inboundPackages
 * @property InboundPengirimBarang[] $inboundPengirimBarangs
 * @property InboundPenjualBarang[] $inboundPenjualBarangs
 * @property InboundPembeliBarang[] $inboundPembeliBarangs
 * @property InboundTpb[] $inboundTpbs
 * @property InboundTujuanPengiriman[] $
 * @property partial[]
 */
class Inbound extends Model
{
    use HasFactory;

    protected $casts = ["details" => "array"];
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['bc_form_id', 'status_id', 'request_number', 'faktur_pajak' , 'details','city_id','pib_type_id','payment_type_id','import_type_id','peb_type_id','export_category_id','trade_type_id','commodity_id','bulk_id', 'export_loading_port_id', 'intangible_status','created_by', 'updated_by', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bcForm()
    {
        return $this->belongsTo('App\Models\BcForm');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function paymentType()
    {
        return $this->belongsTo('App\Models\MasterPaymentType');
    }

    public function placeOfOrigin()
    {
        return $this->belongsTo('App\Models\MasterPlaceOfOrigin');
    }

    public function importType()
    {
        return $this->belongsTo('App\Models\MasterImportType');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inboundDetails()
    {
        return $this->hasMany('App\Models\InboundDetail');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inboundDocuments()
    {
        return $this->hasMany('App\Models\InboundDocument')->groupBy('seri_document');
    }

    public function inboundPetiKemas()
    {
        return $this->hasMany('App\Models\inboundPetiKemas')->groupBy('no_seri');
    }

    public function inboundPackaging()
    {
        return $this->hasMany('App\Models\inboundPackaging')->groupBy('no_seri');
    }

    public function inboundBank()
    {
        return $this->hasMany('App\Models\inboundBank')->groupBy('id')->orderBy('id');
    }

    public function inboundDocumentsExcel()
    {
        return $this->hasMany('App\Models\InboundDocument')->groupBy('seri_barang')->groupBy('seri_document');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function histories()
    {
        return $this->hasMany('App\Models\InboundHistory');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inboundJenisTpb()
    {
        return $this->hasOne('App\Models\InboundJenisTpb');
    }

    public function inboundJenisTpbAsal()
    {
        return $this->hasOne('App\Models\InboundJenisTpb')->where('type', 'asal');
    }

    public function inboundJenisTpbTujuan()
    {
        return $this->hasOne('App\Models\InboundJenisTpb')->where('type', 'tujuan');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inboundKppbc()
    {
        return $this->hasOne('App\Models\InboundKppbc');
    }

    public function inboundKppbcBongkar()
    {
        return $this->hasOne('App\Models\InboundKppbc')->where('type', 'bongkar');
    }

    public function inboundKppbcPengawas()
    {
        return $this->hasOne('App\Models\InboundKppbc')->where('type', 'pengawas');
    }

    public function inboundKppbcAsal()
    {
        return $this->hasOne('App\Models\InboundKppbc')->where('type', 'asal');
    }

    public function inboundKppbcTujuan()
    {
        return $this->hasOne('App\Models\InboundKppbc')->where('type', 'tujuan');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inboundPackages()
    {
        return $this->hasMany('App\Models\InboundPackage');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inboundPengirimBarang()
    {
        return $this->hasOne('App\Models\InboundProfile')->where('type', 'pengirim-barang');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function inboundProfile()
    {
        return $this->hasMany('App\Models\InboundProfile');
    }

    public function inboundTpb()
    {
        return $this->hasOne('App\Models\InboundProfile')->where('type', 'tpb');
    }

    public function inboundTpbAsal()
    {
        return $this->hasOne('App\Models\InboundProfile')->where('type', 'tpb-asal');
    }

    public function inboundTpbTujuan()
    {
        return $this->hasOne('App\Models\InboundProfile')->where('type', 'tpb-tujuan');
    }

    public function inboundImportir()
    {
        return $this->hasOne('App\Models\InboundProfile')->where('type', 'importir');
    }

    public function inboundExportir()
    {
        return $this->hasOne('App\Models\InboundProfile')->where('type', 'exportir');
    }

    public function inboundPemilikBarang()
    {
        return $this->hasOne('App\Models\InboundProfile')->where('type', 'pemilik-barang');
    }

    public function inboundPembeliBarang()
    {
        return $this->hasOne('App\Models\InboundProfile')->where('type', 'pembeli-barang');
    }

    public function inboundPenerimaBarang()
    {
        return $this->hasOne('App\Models\InboundProfile')->where('type', 'penerima-barang');
    }

    public function inboundPenjualBarang()
    {
        return $this->hasOne('App\Models\InboundProfile')->where('type', 'penjual-barang');
    }

    public function inboundPemusatanBarang()
    {
        return $this->hasOne('App\Models\InboundProfile')->where('type', 'pemusatan-barang');
    }

    public function inboundPemasokBarang()
    {
        return $this->hasOne('App\Models\InboundProfile')->where('type', 'pemasok-barang');
    }

    public function inboundPpjk()
    {
        return $this->hasOne('App\Models\InboundProfile')->where('type', 'ppjk');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inboundTujuanPengiriman()
    {
        return $this->hasOne('App\Models\InboundTujuanPengiriman');
    }

    public function inboundTransportation()
    {
        return $this->hasMany('App\Models\InboundTransportation');
    }

    public function exportLoadingPort()
    {
        return $this->hasOne('App\Models\Port', 'id', 'export_loading_port_id');
    }

    public function inboundValas()
    {
        return $this->hasOne(InboundValas::class);
    }

    public function inboundWarehouse()
    {
        return $this->hasOne(InboundWarehouse::class);
    }

    public function inboundTPS()
    {
        return $this->hasOne('App\Models\InboundTPS');
    }

    public function inboundPartial()
    {
        return $this->hasOne('App\Models\partial');
    }

    public function inboundExportType()
    {
        return $this->belongsTo('App\Models\MasterExportType', 'peb_type_id');
    }

    public function inboundExportCategory()
    {
        return $this->belongsTo('App\Models\MasterExportCategory', 'export_category_id');
    }

    public function inboundTradeType()
    {
        return $this->belongsTo('App\Models\MasterTradeType', 'trade_type_id');
    }

    public function inboundPaymentType()
    {
        return $this->belongsTo('App\Models\MasterPaymentType', 'payment_type_id');
    }

    



}
