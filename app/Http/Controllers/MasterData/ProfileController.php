<?php

namespace App\Http\Controllers\MasterData;

use App\Helpers\ComboHelper;
use App\Helpers\GeneralHelper;
use App\Http\Controllers\MasterData\MasterDataController;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Country;
use App\Models\MasterEntrepreneurStatus;
use App\Models\Profile;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
class ProfileController extends MasterDataController
{

    public function __construct() {
        parent::__construct();

        $this->view .= "profile.";
        $this->mainUrl = url('master-data/profile');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request) {
        $formArray = filterDataTableToArray($request->form);

        $query = Profile::select('*');

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $query = $query->whereHas('createdBy', function($query) use ($user) {
                $query->where('warehouse_id', $user->warehouse_id);
                $query->where('profile_id', $user->profile_id);
            });
        }

        $canEdit = auth()->user()->can('edit master-data profile');
        $canDelete = auth()->user()->can('delete master-data profile');
        return datatables()->of($query)
            ->addColumn("actions", function ($row) use ($canEdit, $canDelete) {
                return view("components.table.actions", [
                    "actions" => [
                        "edit" => !$canEdit ? null : [
                            "url" => $this->mainUrl . '/edit/' . $row->id,
                        ],
                        "delete" => !$canDelete ? null : [
                            "url" => $this->mainUrl . '/delete/' . $row->id,
                        ],
                    ]
                ]);
            })
            ->make();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->makeView("index",array('moduleNav'=>'client'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $helpercombo = new ComboHelper();
        return $this->makeView("form", [
            "model" => new Profile(),
            'moduleNav'=>'client',
            'tipe_identitas'=> $helpercombo->getJenisIdentitas(),
            "countries" => Country::all()->pluck("name", "id"),
            "types" => [
                'importir'          => 'Importir',
                'exportir'          => 'Exportir',
                'pemasok-barang'    => 'Pemasok Barang',
                'pemilik-barang'    => 'Pemilik Barang',
                'penerima-barang'   => 'Penerima Barang',
                'pengirim-barang'   => 'Pengirim Barang',
                'penjual-barang'    => 'Penjual Barang',
                'pembeli-barang'    => 'Pembeli Barang',
                'pemusatan-barang'  => 'Pemusatan Barang',
                'ppjk'              => 'PPJK',
                'tpb'               => 'TPB',
                'user'              => 'User',
            ],
            "tipe_api" => [
                'apip' => 'APIP',
                'apiu' => 'APIU'
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request)
    {

        // dd($request->all());
        if (Profile::create($request->all())) {
            return redirect($this->mainUrl)->with("success", "Data has been saved");
        }

        return redirect($this->mainUrl)->with("error", "Failed to saved the data");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $helpercombo = new ComboHelper();
        return $this->makeView("form", [
            "model" => Profile::find($id),
            'moduleNav'=>'client',
            'tipe_identitas' => $helpercombo->getJenisIdentitas(),
            "countries" => Country::all()->pluck("name", "id"),
            "types" => [
                'importir'          => 'Importir',
                'exportir'          => 'Exportir',
                'pemasok-barang'    => 'Pemasok Barang',
                'pemilik-barang'    => 'Pemilik Barang',
                'penerima-barang'   => 'Penerima Barang',
                'pengirim-barang'   => 'Pengirim Barang',
                'penjual-barang'    => 'Penjual Barang',
                'pembeli-barang'    => 'pembeli Barang',
                'pemusatan-barang'  => 'pemusatan Barang',
                'ppjk'              => 'PPJK',
                'tpb'               => 'TPB',
                'user'              => 'User',
            ],
            "tipe_api" => [
                'apip' => 'APIP',
                'apiu' => 'APIU'
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProfileRequest  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function postEdit(UpdateProfileRequest $request, $id)
    {
        if (Profile::find($id)->update($request->all())) {
            return redirect($this->mainUrl)->with("success", "Data has been updated");
        }

        return redirect($this->mainUrl)->with("error", "Failed to update the specified resource");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function getDelete($id)
    {   

        $deleteProfile = Profile::findOrFail($id);
        try {
            $deleteProfile->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (\Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getDetail($id)
    {
        $data_country = Profile::select([
                'profiles.*',
                'countries.name as name_country',
                'warehouses.name as name_warehouse'
            ])
            ->leftjoin('countries','countries.id','=','profiles.country_id')
            ->leftjoin('warehouses','warehouses.id','=','profiles.warehouse_id')
            ->where('profiles.id','=',$id)
            ->first();
        if(isset($data_country['details']['tipe_identitas'])){
            $data_country['tipe_identitas'] = $data_country['details']['tipe_identitas'] ;
        }else{
            $data_country['tipe_identitas'] = null;
        }

        if(isset($data_country['details']['nomor_identitas'])){
            $data_country['nomor_identitas'] = $data_country['details']['nomor_identitas'];
        }else{
            $data_country['nomor_identitas'] = null;
        }

        if(isset($data_country['details']['nomor_izin'])){
            $data_country['nomor_izin'] = $data_country['details']['nomor_izin'];
        }else{
            $data_country['nomor_izin'] = null;
        }

        if(isset($data_country['details']['jenis_api'])){
            $data_country['jenis_api'] = $data_country['details']['jenis_api'];
        }else{
            $data_country['jenis_api'] = null;
        }

        if(isset($data_country['details']['npwp'])){
            $data_country['npwp'] = $data_country['details']['npwp'];
        }else{
            $data_country['npwp'] = null;
        }

        if(isset($data_country['details']['nomor_ppjk'])){
            $data_country['nomor_ppjk'] = $data_country['details']['nomor_ppjk'];
        }else{
            $data_country['nomor_ppjk'] = null;
        }

        if(isset($data_country['details']['tanggal_ppjk'])){
            $data_country['tanggal_ppjk'] = $data_country['details']['tanggal_ppjk'];
        }else{
            $data_country['tanggal_ppjk'] = null;
        }

        
        if(isset($data_country['details']['status_pengusaha'])){
            $masterEntrepreneurStatus = MasterEntrepreneurStatus::find($data_country['details']['status_pengusaha']);
            $data_country['status_pengusaha'] = "{$masterEntrepreneurStatus->code} - {$masterEntrepreneurStatus->name}";
        }else{
            $data_country['status_pengusaha'] = null;
        }

        return response()->json($data_country);
    }

    public function postCreateAjax(Request $request)
    {

        $helper  = new GeneralHelper();
        $inputData = collect($request->all());
        $profileCreate = [];
        if(!isset($request->pemilik_barang_id)){
            $profileCreate[] = 'pemilik_';
        }
        $filteredInput = $inputData->filter(function($value, $key) use ($profileCreate) {
            return Str::startsWith($key, $profileCreate);
        });

        $entitas = $helper->storeProfile($filteredInput);

        if (empty($entitas)) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Failed to create a new owner good because already exists',
            ]);
        }

        return response()->json([
            'status'    => 'success',
            'data'      => $entitas,
        ]);
    }

    public function getDataProfile($type){

        if($type == 'pemilik-barang'){
            $result = Profile::whereJsonContains('types', $type)->get();
        }

        return json_encode($result);

    }

    public function formNomorIzin()
    {
        return $this->makeView("partials.nomor_izin_form", []);
    }

    public function formCountry()
    {
        return $this->makeView("partials.country_form", [
            "countries" => Country::all()->pluck("name", "id"),
        ]);
    }

    public function formApi()
    {
        return $this->makeView("partials.api_form", [
            "tipe_api" => [
                'apip' => 'APIP',
                'apiu' => 'APIU'
            ]
        ]);
    }

    public function formPpjk()
    {
        return $this->makeView("partials.ppjk_form", []);
    }

    public function formNiper()
    {
        return $this->makeView("partials.niper_form", []);
    }

    public function formWarehouse()
    {
        return $this->makeView("partials.warehouse_form", [
            "warehouses" => Warehouse::all()->pluck("name", "id"),
        ]);
    }
}
