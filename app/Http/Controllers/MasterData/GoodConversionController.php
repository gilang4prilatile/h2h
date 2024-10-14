<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\BcForm;
use App\Models\Good;
use App\Models\GoodConversion;
use App\Models\Inbound;
use App\Models\InboundDetail;
use App\Models\Inventory;
use App\Models\InventoryConversion;
use App\Models\InventoryConversionHistory;
use App\Models\InventoryOutboundDetail;
use App\Models\Outbound;
use App\Models\OutboundDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Carbon\Carbon;

class GoodConversionController extends MasterDataController
{
    public function __construct()
    {

        parent::__construct();
        $this->view .= "good-conversions";
        $this->mainUrl = url('master-data/good-conversions');

        view()->share("mainUrl", $this->mainUrl);
    }
    public function getIndex()
    {
        $query = new Good();
        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $query = $query->whereHas('createdBy', function ($query) use ($user) {
                $query->where('profile_id', $user->profile_id);
            });
        }
        $data = array();
        $data['__user'] = auth()->user();
        $data['moduleNav'] = 'good-conversions';
        $data['data_dk'] = $query
            ->select([
                'goods.*',
                'good_conversions.good_id',
                'good_conversions.quantity'
            ])
            ->join('good_conversions', 'goods.id', '=', 'good_conversions.good_id')
            ->groupBy('goods.id')
            ->get();
        foreach ($data['data_dk'] as $row) {
            $goods = DB::table('good_conversions')
                ->join('goods as from', 'from.id', '=', 'good_conversions.good_conversion_id')
                ->where('good_conversions.good_id', '=', $row->good_id)
                ->get();
            $row_detail = "";
            foreach ($goods as $rg) {
                $row_detail = $row_detail . $rg->name . " x" . abs($rg->quantity) . "<br/>";
            }
            $row->detail = $row_detail;
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

        return $this->makeView("index", $data);
    }
    public function getCreate()
    {
        $data = array();
        $data['__user'] = auth()->user();
        $data['moduleNav'] = 'good-conversions';
        $data['data_uom'] = DB::table('master_uom')
            ->get();
        $query = new Good();
        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $query = $query->whereHas('createdBy', function ($query) use ($user) {
                $query->where('profile_id', $user->profile_id);
            });
        }
        $data['data_goods'] = $query->with('uom')
            ->whereDoesntHave("goodConversions")
            ->whereJsonContains('details', function ($q) {
                $q->whereIn('jenis_barang', ['baku', 'penolong', 'pengemas']);
            })
            ->get();

        return $this->makeView("create", $data);
    }
    public function postCreate(Request $request)
    {

        DB::beginTransaction();

        $goodExistsCount = Good::whereJsonContains('details->kode_barang', $request->details['kode_barang'])->count();
        if ($goodExistsCount > 0) {
            DB::rollBack();
            return redirect($this->mainUrl)->with("error", "Failed to save the data because the code good already exists");
        }

        $good = Good::create($request->all());
        $updateGood = Good::where('id', $good->id)->first();
        if ($updateGood) {
            $updateGood->kode_barang = $request->details['kode_barang'];;
            $updateGood->save();
        }

        if (!$good || !$updateGood) {
            DB::rollBack();
            return redirect($this->mainUrl)->with("error", "Failed to save the data");
        }

        $insert_gc = [];
        $raw_gc = $request->post('good_conversion_id');
        $quantity = $request->post('quantity');
        $user = Auth::user();
        for ($i = 0; $i < count($raw_gc); $i++) {
            $row_gc = array();
            $row_gc['good_id'] = $good->id;
            $row_gc['good_conversion_id'] = $raw_gc[$i];
            $row_gc['quantity'] = $quantity[$i];
            $row_gc['created_by'] = $user->id;
            $row_gc['created_at'] = Carbon::now();
            array_push($insert_gc, $row_gc);
        }

        $goodConversion = GoodConversion::insert($insert_gc);
        if (!$goodConversion) {
            DB::rollBack();
            return redirect($this->mainUrl)->with("error", "Failed to save the data");
        }
        DB::commit();
        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function getDelete($id)
    {

        DB::beginTransaction();

        $outboundDetails = OutboundDetail::where('good_id', $id)
            ->count();

        if ($outboundDetails > 0) {
            return redirect($this->mainUrl)->with("error", "Data cannot been delete");
        }

        $deleteGoods  = Good::find($id);

        $goodConversions  = GoodConversion::where('good_id', $id)->get();
        $inventoryConversion = InventoryConversion::where('good_id', $id)->count();

        $inventoryConversionHistory = true;
        $inventory = true;
        $deleteGoodConversion = true;

        if ($inventoryConversion == 0) {
            foreach ($goodConversions as $goodConversion) {
                $deleteGoodConversion = GoodConversion::find($goodConversion->id)->delete();
            }
            $deleteGoods->delete();
            if ($deleteGoodConversion && $deleteGoods) {
                DB::commit();
                return redirect($this->mainUrl)->with("success", "Data has been deleted");
            }
        }

        $inventoryConversionHistories = InventoryConversionHistory::where('inventory_conversion_id', $inventoryConversion->id)->get();
        foreach ($inventoryConversionHistories as $inventoryConversionHistory) {

            $quantityUpdate = $inventoryConversionHistory->quantity_good;

            // Update Inventory
            $inventory = Inventory::find($inventoryConversionHistory->inventory_id);
            $inventory->quantity += $quantityUpdate;
            $inventory->save();

            // Delete History Conversion
            $inventoryConversionHistory = InventoryConversionHistory::find($inventoryConversionHistory->id)->delete();
        }

        foreach ($goodConversions as $goodConversion) {
            $deleteGoodConversion = GoodConversion::find($goodConversion->id)->delete();
        }

        $inventoryConversion->delete();
        $deleteGoods->delete();

        if ($deleteGoods && $goodConversions && $inventoryConversion && $inventoryConversionHistory && $inventory) {
            DB::commit();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        }

        DB::rollBack();
        return redirect($this->mainUrl)->with("error", "Data cannot been delete");
    }

    public function getUpdate($id)
    {
        $data = array();
        $data['__user'] = auth()->user();
        $data['moduleNav'] = 'good-conversions';
        $data['data_uom'] = DB::table('master_uom')
            ->get();
        $query = new Good();
        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $query = $query->whereHas('createdBy', function ($query) use ($user) {
                $query->where('profile_id', $user->profile_id);
            });
        }

        $data['data_goods'] = $query->with("uom")
            ->whereDoesntHave("goodConversions")
            ->whereJsonContains('details', function ($q) {
                $q->whereIn('jenis_barang', ['baku', 'penolong', 'pengemas']);
            })
            ->where('id', '!=', $id)
            ->get();

        $data['row_goods'] = Good::with(['uom', 'goodConversions'])->find($id);
        $data['row_goods_detail'] = $data['row_goods']->details;


        $gc_detail = DB::table('good_conversions')
            ->where('good_conversions.good_id', '=', $id)
            ->get();
        if (count($gc_detail) == 0) {
            return redirect()->action([GoodConversionsController::class, 'getIndex']);
        } else {
            $data_id_gc = array();
            $data_qty_gc = array();
            foreach ($gc_detail as $row) {
                array_push($data_id_gc, $row->good_conversion_id);
                $data_qty_gc[$row->good_conversion_id] = $row->quantity;
            }
            $data['data_id_gc'] = $data_id_gc;
            $data['data_qty_gc'] = $data_qty_gc;
            return $this->makeView("update", $data);
        }
    }

    public function postUpdate($id, Request $request)
    {

        DB::beginTransaction();

        $goodExistsCount = Good::whereJsonContains('details->kode_barang', $request->details['kode_barang'])->count();
        if ($goodExistsCount > 0) {
            DB::rollBack();
            return redirect($this->mainUrl)->with("error", "Failed to save the data because the code good already exists");
        }

        $inventoryConversion = InventoryConversion::where('good_id', $id)->count();
        $outboundDetails = OutboundDetail::where('good_id', $id)->count();

        if ($outboundDetails > 0 || $inventoryConversion > 0) {
            return redirect($this->mainUrl)->with("error", "Data has been used !");
        }


        $good = Good::find($id);
        $updateGood = $good->update($request->all());
        if ($updateGood) {
            $good->kode_barang = $request->details['kode_barang'];
            $good->save();
        }


        if (!$updateGood || !$good) {
            DB::rollBack();
            return redirect($this->mainUrl)->with("error", "Failed to update the data 1");
        }

        $deleteGoodConversions = $good->goodConversions()->delete();
        if (!$deleteGoodConversions) {
            DB::rollBack();
            return redirect($this->mainUrl)->with("error", "Failed to update the data 2");
        }
        $insert_gc = [];
        $raw_gc = $request->post('good_conversion_id');
        $quantity = $request->post('quantity');
        for ($i = 0; $i < count($raw_gc); $i++) {
            $row_gc = array();
            $row_gc['good_id'] = $id;
            $row_gc['good_conversion_id'] = $raw_gc[$i];
            $row_gc['quantity'] = $quantity[$i];
            array_push($insert_gc, $row_gc);
        }
        $saveGoodConversions = $good->goodConversions()->insert($insert_gc);
        if (!$saveGoodConversions) {
            DB::rollBack();
            return redirect($this->mainUrl)->with("error", "Failed to update the data 3");
        }
        DB::commit();
        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function getDetailstock($id)
    {
        $query = new Good();
        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $query = $query->whereHas('createdBy', function ($query) use ($user) {
                $query->where('profile_id', $user->profile_id);
            });
        }
        $data = array();
        $data['__user'] = auth()->user();
        $data['moduleNav'] = 'good-conversions';
        return $this->makeView("detailstock", $data);
    }

    public function getCth()
    {


        $id = 625;
        $quantity = 1;
        $dataInventory = [];

        if (isset($outboundID)) {

            $inventoryOutboundDetails = InventoryOutboundDetail::where('outbound_id', $outboundID)->where('good_conversion_id', $id)->get();

            foreach ($inventoryOutboundDetails as $inventoryOutboundDetail) {

                $inbound       = Inbound::find($inventoryOutboundDetail->inbound_id);
                $inboundDetail = InboundDetail::find($inventoryOutboundDetail->inbound_detail_id);


                $good = Good::find($inboundDetail->good_id);
                $good['inbound'] = $inbound;
                $good['good_id'] = $inventoryOutboundDetail->good_conversion_id;
                $good['bc'] = BcForm::find($inbound->bc_form_id)->name;
                $good['bc_form_id'] = $inbound->bc_form_id;
                $good['good_conversion'] = Good::find($inventoryOutboundDetail->good_conversion_id)->name;
                $good['good_conversion_id'] = Good::find($inventoryOutboundDetail->good_conversion_id)->id;
                $good['to_quantity'] = $inventoryOutboundDetail->quantity_good_conversion;
                $good['inbound_detail_id'] = $inboundDetail->id;
                $good['quantity'] =  $inventoryOutboundDetail->quantity_good;
                $dataInventory[] = $good;
            }

            return response()->json([
                'status'    => 'success',
                'data'      => $dataInventory
            ]);
        }

        // Relationships Sumber Barang
        $inventoryConversion = InventoryConversion::where('good_id', $id)->first();
        $goods = GoodConversion::where('good_id', $inventoryConversion->good_id)->get();

        $quantityMaps = [];
        $quantityMins = [];
        foreach ($goods as $good) {
            $quantityMaps[$good->good_conversion_id] = $quantity * $good->quantity;
            $quantityMins[$good->good_conversion_id] = $good->quantity;
        }

        $inventoryConversionHistories = InventoryConversionHistory::select('inventory_conversion_histories.*',  'inventory_conversions.quantity as quantity_real')
            ->join('inventory_conversions', 'inventory_conversion_histories.inventory_conversion_id', '=', 'inventory_conversions.id')
            ->join('inventories', 'inventory_conversion_histories.inventory_id', '=', 'inventories.id')
            ->where('inventory_conversions.id', $inventoryConversion->id)
            ->where('inventory_conversion_histories.quantity', '!=', 0)
            ->where('type', 'conversion')
            ->orderBy('created_at', 'ASC')
            ->orderBy('inventory_id', 'ASC')
            ->groupBy('inventories.id')
            ->groupBy('inventory_id')
            ->get();

        dd($inventoryConversionHistories);

        foreach ($inventoryConversionHistories as $inventoryConversionHistory) {

            $inventoryOutboundDetails = InventoryOutboundDetail::where('inventory_conversion_id', $inventoryConversionHistory->inventory_conversion_id)
                ->where('status', 0)
                ->get();


            if ($inventoryOutboundDetails) {

                foreach ($inventoryOutboundDetails as $inventoryOutboundDetail) {

                    if ($inventoryOutboundDetail->inv_conversion_history_id == $inventoryConversionHistory->id) {

                        $inventoryConversionHistory->quantity_good -= $inventoryOutboundDetail->quantity_good_conversion;
                    }
                }
            }

            $inventoryInbound = Inventory::find($inventoryConversionHistory->inventory_id);
            $inboundDetail    = InboundDetail::find($inventoryInbound->inbound_detail_id);
            $inbound          = Inbound::find($inboundDetail->inbound_id);

            $goodConversion   = GoodConversion::where('good_id', $inventoryConversion->good_id)->first();
            $limitInventoryConversion = $inventoryConversionHistory->quantity_good;

            if (
                $limitInventoryConversion >= $quantityMaps[$inboundDetail->good_id]
                && $quantityMaps[$inboundDetail->good_id]
                && $limitInventoryConversion != 0
            ) {

                $good = Good::find($inboundDetail->good_id);
                $good['inbound'] = $inbound;
                $good['request_number'] = $inbound->request_number;
                $good['good_id'] = $goodConversion->good_id;
                $good['bc'] = BcForm::find($inbound->bc_form_id)->name;
                $good['bc_form_id'] = $inbound->bc_form_id;
                $good['good_conversion'] = Good::find($goodConversion->good_id)->name;
                $good['good_conversion_id'] = Good::find($goodConversion->good_id)->id;
                $good['to_quantity'] = $goodConversion->quantity;
                $good['inbound_detail_id'] = $inboundDetail->id;
                $good['quantity'] =  $quantityMaps[$inboundDetail->good_id];
                $dataInventory[] = $good;

                $quantityMaps[$inboundDetail->good_id] = $limitInventoryConversion - $quantityMaps[$inboundDetail->good_id];


                $quantityMaps[$inboundDetail->good_id] = 0;

                continue;
            } else if (
                $quantityMaps[$inboundDetail->good_id] != 0
                && $limitInventoryConversion != 0
            ) {

                $good = Good::find($inboundDetail->good_id);
                $good['inbound'] = $inbound;
                $good['good_id'] = $goodConversion->good_id;
                $good['request_number'] = $inbound->request_number;
                $good['bc'] = BcForm::find($inbound->bc_form_id)->name;
                $good['bc_form_id'] = $inbound->bc_form_id;
                $good['good_conversion'] = Good::find($goodConversion->good_id)->name;
                $good['good_conversion_id'] = Good::find($goodConversion->good_id)->id;
                $good['to_quantity'] = $goodConversion->quantity;
                $good['inbound_detail_id'] = $inboundDetail->id;
                $good['quantity'] =  $quantityMaps[$inboundDetail->good_id];
                $dataInventory[] = $good;

                $quantityMaps[$inboundDetail->good_id] -= $limitInventoryConversion;

                continue;
            }
        }

        return response()->json([
            'status'    => 'success',
            'data'      => $dataInventory
        ]);
    }

    public function postRawGoodConversion(Request $request)
    {

        $outboundID = $request->outbound_id;
        $outbound = Outbound::find($outboundID);
        $id = $request->good_id;
        $quantity = $request->quantity;

        $dataInventory = [];

        if (isset($outboundID)) {

            $inventoryOutboundDetails = InventoryOutboundDetail::where('outbound_id', $outboundID)->where('good_conversion_id', $id)->get();

            foreach ($inventoryOutboundDetails as $inventoryOutboundDetail) {

                $inbound       = Inbound::find($inventoryOutboundDetail->inbound_id);
                $inboundDetail = InboundDetail::find($inventoryOutboundDetail->inbound_detail_id);

                $good = Good::find($inboundDetail->good_id);
                $good['inbound'] = $inbound;
                $good['inbound_detail'] = $inboundDetail;
                $good['good_id'] = $inventoryOutboundDetail->good_conversion_id;
                $good['request_number'] = $inbound->request_number;
                $good['bc'] = BcForm::find($inbound->bc_form_id)->name;
                $good['bc_form_id'] = $inbound->bc_form_id;
                $good['good_conversion'] = Good::find($inventoryOutboundDetail->good_conversion_id)->name;
                $good['good_conversion_id'] = Good::find($inventoryOutboundDetail->good_conversion_id)->id;
                $good['to_quantity'] = $inventoryOutboundDetail->quantity_good_conversion;
                $good['inbound_detail_id'] = $inboundDetail->id;
                $good['quantity'] =  $inventoryOutboundDetail->quantity_good_conversion;
                $dataInventory[] = $good;
            }

            return response()->json([
                'status'    => 'success',
                'data'      => $dataInventory
            ]);
        }

        // Relationships Sumber Barang
        $inventoryConversion = InventoryConversion::where('good_id', $id)->where('bc_form_id', 4)->first();
        $goods = GoodConversion::where('good_id', $inventoryConversion->good_id)->get();

        $quantityMaps = [];
        $quantityMins = [];
        foreach ($goods as $good) {
            $quantityMaps[$good->good_conversion_id] = $quantity * $good->quantity;
            $quantityMins[$good->good_conversion_id] = $good->quantity;
        }

        $inventoryConversionHistories = InventoryConversionHistory::select('inventory_conversion_histories.*',  DB::raw('SUM(inventory_conversion_histories.quantity_good) as quantity_good'))
            ->join('inventory_conversions', 'inventory_conversion_histories.inventory_conversion_id', '=', 'inventory_conversions.id')
            ->join('inventories', 'inventory_conversion_histories.inventory_id', '=', 'inventories.id')
            ->where('inventory_conversions.id', $inventoryConversion->id)
            ->where('inventory_conversion_histories.quantity', '!=', 0)
            ->where('inventory_conversion_histories.type', 'conversion')
            ->orderBy('created_at', 'ASC')
            ->orderBy('inventory_id', 'ASC')
            ->groupBy('inventories.id')
            ->get();

        foreach ($inventoryConversionHistories as $inventoryConversionHistory) {

            $inventoryOutboundDetails = InventoryOutboundDetail::where('inv_conversion_history_id', $inventoryConversionHistory->id)
                ->get();

            if ($inventoryOutboundDetails) {

                foreach ($inventoryOutboundDetails as $inventoryOutboundDetail) {
                    $inventoryConversionHistory->quantity_good -= $inventoryOutboundDetail->quantity_good_conversion;
                }
            }

            $inventoryInbound = Inventory::find($inventoryConversionHistory->inventory_id);
            $inboundDetail    = InboundDetail::find($inventoryInbound->inbound_detail_id);
            $inbound          = Inbound::find($inboundDetail->inbound_id);

            $goodConversion   = GoodConversion::where('good_id', $inventoryConversion->good_id)->first();
            $limitInventoryConversion = $inventoryConversionHistory->quantity_good;

            if (
                $limitInventoryConversion >= $quantityMaps[$inboundDetail->good_id]
                && $quantityMaps[$inboundDetail->good_id]
                && $limitInventoryConversion != 0
            ) {

                $good = Good::find($inboundDetail->good_id);
                $good['inbound'] = $inbound;
                $good['inbound_detail'] = $inboundDetail;
                $good['request_number'] = $inbound->request_number;
                $good['good_id'] = $goodConversion->good_id;
                $good['bc'] = BcForm::find($inbound->bc_form_id)->name;
                $good['bc_form_id'] = $inbound->bc_form_id;
                $good['good_conversion'] = Good::find($goodConversion->good_id)->name;
                $good['good_conversion_id'] = Good::find($goodConversion->good_id)->id;
                $good['to_quantity'] = $goodConversion->quantity;
                $good['inbound_detail_id'] = $inboundDetail->id;
                $good['quantity'] =  $quantityMaps[$inboundDetail->good_id];
                $dataInventory[] = $good;

                $quantityMaps[$inboundDetail->good_id] = $limitInventoryConversion - $quantityMaps[$inboundDetail->good_id];


                $quantityMaps[$inboundDetail->good_id] = 0;

                continue;
            } else if (
                $quantityMaps[$inboundDetail->good_id] != 0
                && $limitInventoryConversion != 0
            ) {

                $good = Good::find($inboundDetail->good_id);
                $good['inbound'] = $inbound;
                $good['inbound_detail'] = $inboundDetail;
                $good['good_id'] = $goodConversion->good_id;
                $good['request_number'] = $inbound->request_number;
                $good['bc'] = BcForm::find($inbound->bc_form_id)->name;
                $good['bc_form_id'] = $inbound->bc_form_id;
                $good['good_conversion'] = Good::find($goodConversion->good_id)->name;
                $good['good_conversion_id'] = Good::find($goodConversion->good_id)->id;
                $good['to_quantity'] = $goodConversion->quantity;
                $good['inbound_detail_id'] = $inboundDetail->id;
                $good['quantity'] =  $inventoryConversionHistory->quantity_good;
                $dataInventory[] = $good;

                $quantityMaps[$inboundDetail->good_id] -= $limitInventoryConversion;

                continue;
            }
        }

        return response()->json([
            'status'    => 'success',
            'history'   => $inventoryConversionHistories,
            'data'      => $dataInventory
        ]);
    }

    public function getGoodConversionByIdAjax($id)
    {

        $goodConversion = Good::with(['goodConversions', 'goodConversions.rawGood', 'goodConversions.rawGood.uom'])->find($id);

        return response()->json([
            'status' => 'success',
            'data'   => $goodConversion
        ]);
    }

    public function filter(Request $request)
    {

        $query = new Good();
        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $query = $query->whereHas('createdBy', function ($query) use ($user) {
                $query->where('profile_id', $user->profile_id);
            });
        }

        $data = array();
        $data['__user'] = auth()->user();
        $data['moduleNav'] = 'good-conversions';
        $user = auth()->user();
        $kode_barang = $request->get('kode_barang');
        $name = $request->get('name');
        $merk = $request->get('merk');
        $asal_barang = $request->get('asal_barang');
        $jenis_barang = $request->get('jenis_barang');

        $query = (new Good())->newQuery();


        if ($kode_barang != null) {
            $query->where('details->kode_barang', "like", "%" . $kode_barang . "%");
        }

        if ($name != null) {
            $query->where('name', "like", "%" . $name . "%");
        }

        if ($merk != null) {
            $query->where('details->merk', "like", "%" . $merk . "%");
        }

        if ($jenis_barang != null) {
            $query->where('details->jenis_barang', "like", "%" . $jenis_barang . "%");
        }

        if ($asal_barang != null) {
            $query->where('details->asal_barang', "like", "%" . $asal_barang . "%");
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

        $data['data_dk'] = $query
            ->select([
                'goods.*',
                'good_conversions.good_id',
                'good_conversions.quantity'
            ])
            ->join('good_conversions', 'goods.id', '=', 'good_conversions.good_id')
            ->groupBy('goods.id')
            ->get();
        foreach ($data['data_dk'] as $row) {
            $goods = DB::table('good_conversions')
                ->join('goods as from', 'from.id', '=', 'good_conversions.good_conversion_id')
                ->where('good_conversions.good_id', '=', $row->good_id)
                ->get();
            $row_detail = "";
            foreach ($goods as $rg) {
                $row_detail = $row_detail . $rg->name . " x" . $rg->quantity . "<br/>";
            }
            $row->detail = $row_detail;
        }

        $data['data_dk'] = $query->get();
        return view('master-data.good-conversions.index', $data);
    }
}
