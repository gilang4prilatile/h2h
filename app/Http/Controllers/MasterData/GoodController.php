<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Good;
use App\Models\GoodConversion;
use App\Models\HsCode;
use App\Models\MasterTypeGoods;
use App\Models\Profile;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GoodController extends MasterDataController
{

    public function __construct() {
        parent::__construct();
        $this->view .= "goods.";
        $this->mainUrl = url('master-data/goods');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getIndex(){
    	$data = array();
		$data['__user'] = auth()->user();
        $data['moduleNav'] = 'goods';
        $query = new Good();
        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $query = $query->whereHas('createdBy', function($query) use ($user) {
                $query->where('profile_id', $user->profile_id);
            });

        }
        $data['jenis_barang'] = [
            'baku' => 'Baku',
            'penolong' => 'Penolong',
            'pengemas' => 'Pengemas',
            'habis-pakai' => 'Kimia',
            'sparepart' => 'Sparepart',
            'atk' => 'ATK'
        ];
        $data['asal_barang'] = [
            'local' => 'Local',
            'import' => 'Import'
        ];

		$data['data_dk'] = $query->whereDoesntHave('goodConversions')->get();
		return view('master-data.goods.index',$data);
    }

    public function getCreate(){
    	$data = array();
		$data['__user'] = auth()->user();
        $data['moduleNav'] = 'goods';
        $data['data_uom'] = DB::table('master_uom')
            ->get();
        $data['hscodes'] = HsCode::all()->pluck('name', 'id');
        $data['jenisBarang'] = MasterTypeGoods::all()->pluck('name', 'name');
        $data['asalBarang'] = [
            'local' => 'Local',
            'import' => 'Import'
        ];
		return view ('master-data.goods.create',$data);
    }

    public function postCreate(Request $request){
        $rules = [
            'kode_barang' => 'required',
            'merk' => 'required',
            'spesifikasi_lain' => 'required',
            'type' => 'required',
            'ukuran' => 'required',
            'uraian' => 'required',
            'uom_id' => 'required',
            'name' => 'required',
            'nett_weight' => 'required',
            'volume' => 'required',
        ];

        $customMessages = [
            'required' => ':attribute wajib di isi',
        ];
        $this->validate($request, $rules, $customMessages);

        $goodExistsCount = Good::whereJsonContains('details->kode_barang', $request->kode_barang)->count();
        if ($goodExistsCount > 0) {
            return redirect($this->mainUrl)->with("error", "Failed to save the data because the good already exists");
        }

        $detail = array();
        $detail['kode_barang'] = $request->post('kode_barang');
        $detail['merk'] = $request->post('merk');
        $detail['spesifikasi_lain'] = $request->post('spesifikasi_lain');
        $detail['type'] = $request->post('type');
        $detail['ukuran'] = $request->post('ukuran');
        $detail['uraian'] = $request->post('uraian');
        $detail['jenis_barang'] = $request->post('jenis_barang');
        $detail['asal_barang'] = $request->post('asal_barang');

        $insert_goods = array();
        $insert_goods['uom_id'] = $request->post('uom_id');
        $insert_goods['name'] = $request->post('name');
        $insert_goods['nett_weight'] = $request->post('nett_weight');
        $insert_goods['volume'] = $request->post('volume');
        // $insert_goods['amount'] = $request->post('amount');
        $insert_goods['details'] = $detail;
        $insert_goods['kode_barang'] = $request->post('kode_barang');
        // $insert_goods['hscode_id'] = $request->post('hscode_id');
        $id_goods = Good::create($insert_goods);
        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function getDelete($id){
        DB::beginTransaction();

        $goodConversion = GoodConversion::where('good_conversion_id', $id)->get();

        if(empty($goodConversion)){
            DB::rollBack();
            return redirect($this->mainUrl)->with("error", "Data cannot be deleted because it is being used!");
        }

        try {
            DB::table('good_conversions')
                ->where('good_id','=',$id)
                ->delete();

            DB::table('goods')
                ->where('id','=',$id)
                ->delete();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect($this->mainUrl)->with("error", "Failed to delete the specified resource");
        }

        DB::commit();
        return redirect($this->mainUrl)->with("success", "Data has been deleted");
    }

    public function getUpdate($id){
        $data = array();
        $data['__user'] = auth()->user();
        $data['moduleNav'] = 'goods';
        $data['data_uom'] = DB::table('master_uom')
            ->get();
        $data['row_goods'] = DB::table('goods')
            ->where('id','=',$id)
            ->first();
        $data['row_goods_detail'] = json_decode(stripcslashes(trim($data['row_goods']->details,'"')),true);
        $data['hscodes'] = HsCode::all()->pluck('name', 'id');
        $data['jenisBarang'] = MasterTypeGoods::all()->pluck('name', 'name');
        $data['asalBarang'] = [
            'local' => 'Local',
            'import' => 'Import'
        ];
		return view('master-data.goods.update',$data);
    }

    public function postUpdate($id,Request $request){
        $rules = [
            'kode_barang' => 'required',
            'merk' => 'required',
            'spesifikasi_lain' => 'required',
            'type' => 'required',
            'ukuran' => 'required',
            'uraian' => 'required',
            'uom_id' => 'required',
            'name' => 'required',
            'nett_weight' => 'required',
            'volume' => 'required',
        ];

        $customMessages = [
            'required' => ':attribute wajib di isi',
        ];
        $this->validate($request, $rules, $customMessages);
        $goodExistsCount = Good::whereJsonContains('details->kode_barang', $request->kode_barang)->count();
        if ($goodExistsCount > 1) {
            return redirect($this->mainUrl)->with("error", "Failed to update the data because the good already exists");
        }
        $detail = array();
        $detail['kode_barang'] = $request->post('kode_barang');
        $detail['merk'] = $request->post('merk');
        $detail['spesifikasi_lain'] = $request->post('spesifikasi_lain');
        $detail['type'] = $request->post('type');
        $detail['ukuran'] = $request->post('ukuran');
        $detail['uraian'] = $request->post('uraian');
        $detail['jenis_barang'] = $request->post('jenis_barang');
        $detail['asal_barang'] = $request->post('asal_barang');

        $insert_goods = array();
        $insert_goods['uom_id'] = $request->post('uom_id');
        $insert_goods['name'] = $request->post('name');
        $insert_goods['nett_weight'] = $request->post('nett_weight');
        $insert_goods['volume'] = $request->post('volume');
        // $insert_goods['amount'] = $request->post('amount');
        $insert_goods['details'] = $detail;
        $insert_goods['kode_barang'] = $request->post('kode_barang');
        $insert_goods['hscode_id'] = $request->post('hscode_id');
        $id_goods = Good::find($id)->update($insert_goods);
        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function getRawGoods(Request $request)
    {
        $query = new Good();
        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $query = $query->whereHas('createdBy', function($query) use ($user) {
                $query->where('profile_id', $user->profile_id);
            });
        }
        return $query->whereDoesntHave('goodConversions')->where('name', 'like', '%'.$request->input('term').'%')->get();
    }

    public function getAll(Request $request)
    {
        return Good::where('name', 'like', '%'.$request->input('term').'%')->get();
    }

    public function postCreateAjax(Request $request)
    {

        if(isset($request->details['kode_barang']) 
        && $request->details['kode_barang'] != ''){
            $goodsCount = Good::whereJsonContains('details->kode_barang', $request->details['kode_barang'])->count();
            if ($goodsCount > 0) {
                return response()->json([
                    'message' => 'Failed to create a new good because the good already exists',
                ], 400);
            }

            $collection = $request->all();
            $collection['kode_barang'] = $request->details['kode_barang'];

        }else {

            $lastCode   = Good::where('kode_barang', 'like', 'BRHTH%')->get()->last();
            $lstNumber  = '';
            $lengthCode = 6;
            if($lastCode == null){
                $lstNumber = '000001';
            }else {
                $incrementCode = intval(explode('BRHTH', $lastCode->kode_barang)[1]) + 1;
                $loopZero = $lengthCode - strlen($incrementCode);
                for($i = 0 ; $i < $loopZero ; $i++){
                    $lstNumber .= '0';
                }
                $lstNumber .= $incrementCode;
            }

            $collection = $request->all();
            $collection['kode_barang'] =  "BRHTH$lstNumber";
            $collection['name'] = $request->details['uraian']; 
            $collection['details']['kode_barang'] =  "BRHTH$lstNumber";
  
        }
        
        $collection['uom_id'] = $request->details['uom_id'];
        return Good::create($collection);
    }

    public function filter(Request $request){

        $data = array();
        $data['__user'] = auth()->user();
        $data['moduleNav'] = 'goods';
        $user = auth()->user();
        $kode_barang = $request->get('kode_barang');
        $name = $request->get('name');
        $merk = $request->get('merk');
        $asal_barang = $request->get('asal_barang');
        $jenis_barang = $request->get('jenis_barang');

        $query = (new Good())->newQuery();

        if (!$user->hasRole(['Super Admin'])) {
            $query = $query->whereHas('createdBy', function($query) use ($user) {
                $query->where('profile_id', $user->profile_id);
            });

        }

        if ($kode_barang != null) {
            $query->where('details->kode_barang',"like","%".$kode_barang."%");

        }

        if ($name != null) {
            $query->where('name',"like","%".$name."%");

        }

        if ($merk != null) {
            $query->where('details->merk',"like","%".$merk."%");

        }

        if ($jenis_barang != null) {
            $query->where('details->jenis_barang',"like","%".$jenis_barang."%");

        }

        if ($asal_barang != null) {
            $query->where('details->asal_barang',"like","%".$asal_barang."%");

        }
        $data['jenis_barang'] = [
            'baku' => 'Baku',
            'penolong' => 'Penolong',
            'pengemas' => 'Pengemas',
            'habis-pakai' => 'Kimia',
            'sparepart' => 'Sparepart',
            'atk' => 'ATK'
        ];
        $data['asal_barang'] = [
            'local' => 'Local',
            'import' => 'Import'
        ];

        $data['data_dk'] = $query->whereDoesntHave('goodConversions')->get();
        return view('master-data.goods.index',$data);
    }

    public function getDetail($id){

        $data_hscode = HsCode::select([
            'hs_codes.*',

        ])->where('hs_codes.id','=',$id)
            ->first();

            if(isset($data_hscode['details']['status_lantas'])){
                if($data_hscode['details']['status_lantas'] == 1){
                    $data_hscode['status_lantas'] = 'Yes';
                }elseif ($data_hscode['details']['status_lantas'] == 0){
                    $data_hscode['status_lantas'] =  'No';
                }


            }else{
                $data_hscode['status_lantas'] = null;
            }

             return response()->json($data_hscode); 

    }

    public function getSearch(Request $request)
    {
        $search = $request->get('search');
        $result = Good::where('kode_barang', 'like', "%{$search}%")
                    ->orWhere('details', 'like', "%{$search}%")
                    ->get()
                    ->map(function ($v) {
                        return [
                            "id"                => $v->id,
                            "text"              => $v->kode_barang . " - " . $v->details['description_id'],

                        ];
                    });
        return json_encode($result);
    }
    
    public function getRawGoodSearch(Request $request)
    {

        $search = $request->get('search');
        $query = new Good();
        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $query = $query->whereHas('createdBy', function($query) use ($user) {
                $query->where('profile_id', $user->profile_id);
            });
        }

        $query = $query->whereDoesntHave('goodConversions')
                        ->where('kode_barang', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->get() 
                        ->map(function ($v) {
                            return [
                                "id"                => $v->id,
                                "text"              =>  "[{$v->kode_barang}] {$v->name}"
    
                            ];
                        });

        return json_encode($query);

    }

    public function getDetailRawGood($id)
    {
        $result = Good::find($id);
        if($result != null){
            return json_encode(['status' => 'success' , 'good' => $result]);
        }
        return json_encode(['status'    => 'failed']);   
    }
    
}
