<?php

namespace App\Http\Controllers;

use App\Models\partial;
use App\Http\Requests\StorepartialRequest;
use App\Http\Requests\UpdatepartialRequest;
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
use App\Models\OutboundDetailRawGood;
use App\Models\Status;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Str;

class PartialController extends Controller
{
    public function getpartialinbound($id, $sku){

        $nomor_pengajuan = Inbound::find($id);
        $NomorPengajuan = $nomor_pengajuan->request_number;
        $datapartial = DB::table('partials')->where('Nomor_pengajuan','=',$NomorPengajuan)->where('Sku_Barang','=',$sku)->orderBy('tanggal')->get();
        
        $parstatus = DB::table('partials')->where('Nomor_Pengajuan','=',$NomorPengajuan)->where('Sku_Barang','=',$sku)->first();
        
        if($parstatus == null || $parstatus->status >= 0){
            $mysession = Session::get('bc_id');

            if($mysession == 'bc40'){
                $toolbar = "BC 40";
                $mainUrl = url('inbound/bc-40');
                $moduleNav = "inboundbc40";
                Session(['urlku' => 'inbound/bc-40']);
            }
            
            else if($mysession == 'bc23'){
                $toolbar = "BC 23";
                $mainUrl = url('inbound/bc-23');
                $moduleNav = "inboundbc23";
                Session(['urlku' => 'inbound/bc-23']);
            }

            if($parstatus == null){
                $statuspars = 0;
            }
            else{
                $statuspars = $parstatus->status;
            }

            $status_inbound = Status::find($nomor_pengajuan->status_id);
            $goods = DB::table('goods')->orWhereJsonContains('details->kode_barang', $sku)->first();
            

        $__user = auth()->user();
        $partial = DB::table('partials')->where('Nomor_pengajuan','=',$nomor_pengajuan->request_number)->where('Sku_Barang','=',$sku)->first();
        return view('inbound.components.detail.partial_goods_table', compact('moduleNav','__user','id','sku','partial','datapartial','statuspars','status_inbound','mainUrl','toolbar','goods')); 
        }
        // else if($parstatus->status == 1){
        //     return redirect()->back()->with("error","Quantity Partial Sudah Terpenuhi");
        // }

    }

    public function postpartialinbound(Request $request, $id, $sku){

        DB::beginTransaction();

        if($request->tanggal_partial == null){
            return redirect()->back()->with("error", "Tanggal Partial Tolong Diisi");
        }

        $inbound = Inbound::find($id);
        $NomorPengajuan = $inbound->request_number;
        $check_qty = DB::table('partials')->where('Nomor_pengajuan','=',$NomorPengajuan)->where('Sku_Barang','=',$sku)->sum('Qty');

        $goodid = DB::table('goods')->orWhereJsonContains('details->kode_barang', $sku)->first();
        $checkdetail_qty = DB::table('inbound_details')->where('inbound_id','=',$id)->where('good_id','=',$goodid->id)->first();

        $checkBC = DB::table('bc_forms')->where('id','=', $inbound->bc_form_id)->first();
        $bcnya = $checkBC->name;
        
        // if quantity BC lebih besar Quantity input dan yang sudah ada (status 0 (Blom Selesai))
        if(round($checkdetail_qty->quantity, 5) > round($check_qty + $request->jumlah_partial, 5)){
            
            $partial = new partial();
            $partial->Nomor_Pengajuan = $NomorPengajuan;
            $partial->Sku_Barang = $sku;
            $partial->Qty = $request->jumlah_partial;
            $partial->tanggal = $request->tanggal_partial;
            $partial->status = $request->status;
            $partial->keterangan = $request->keterangan ?? '-';
            $partial->jenis_BC = $bcnya;
            $partial->created_by = auth()->user()->id;
            $partial->save();

            $urlku = Session::get('urlku');

            if($partial){
                DB::commit();
                return redirect($urlku."/detail/partial/".$id."/".$sku)->with("success", "Data has been inserted");
            }

            DB::rollBack();
            return redirect($urlku."/detail/partial/".$id."/".$sku)->with("error", "Something Error !");
        }

        // else if quantity BC sama besar dengan Quantity Input + yang sudah ada (Status 1 (Sudah Selesai))
        elseif(round($checkdetail_qty->quantity, 5) == round($check_qty + $request->jumlah_partial, 5)){
            $partial = new partial();
            $partial->Nomor_Pengajuan = $NomorPengajuan;
            $partial->Sku_Barang = $sku;
            $partial->Qty = $request->jumlah_partial;
            $partial->tanggal = $request->tanggal_partial;
            $partial->status = $request->status;
            $partial->keterangan = $request->keterangan ?? '-';
            $partial->jenis_BC = $bcnya;
            $partial->created_by = auth()->user()->id;
            $partial->save();

            $urlku = Session::get('urlku');

            // Change Status Partial Inbound jika semua barang sudah selesai partial
            $getgood = DB::table('inbound_details')->where('inbound_id','=', $id)->get();

            // $tanda = 0;
            // $jumlahloop = sizeof($getgood);

            // for($i = 0; $i < $jumlahloop; $i++){
            //     $goodcode = DB::table('goods')->find($getgood[$i]->good_id);
            //     $paksa = json_decode($goodcode->details,true);
            //     $parstatus = DB::table('partials')->where('Nomor_Pengajuan','=',$NomorPengajuan)->where('Sku_Barang','=',$paksa['kode_barang'])->first();
            //     if($parstatus == null){

            //     }
            //     else if($parstatus->status == 1){
            //         $tanda = $tanda + 1;
            //     }
            // }

            // if($tanda == sizeof($getgood)){
            //     DB::table('inbounds')->where('request_number','=', $NomorPengajuan)->update([
            //         'partial' => 2
            //     ]);
            // }
      
            if($partial){
                DB::commit();
                return redirect($urlku."/detail/partial/".$id."/".$sku)->with("success", "Data has been inserted");
            }

            DB::rollBack();
            return redirect($urlku."/detail/partial/".$id."/".$sku)->with("error", "Something Error !");

        }
        // else Qty Input dan yang sudah ada melebihi Qty BC
        else{
            $hasil = round($checkdetail_qty->quantity - $check_qty, 5);
            DB::rollBack();
            return redirect()->back()->with("error", "Quantity yang diinput melebihi quantity tersisa, quantity tersisa: ".$hasil);
        }
    }

    public function sppdPartialinbound($id)
    {

        DB::beginTransaction();
    
        $partialSave    = false;

        $partial        = DB::table('partials')->where('id', $id)->first();

        $good           = Good::orWhereJsonContains('details->kode_barang', $partial->Sku_Barang)->first();
        $inbound        = Inbound::where('request_number', $partial->Nomor_Pengajuan)->first();
        $inboundDetail  = InboundDetail::where('inbound_id', $inbound->id)->where('good_id', $good->id)->first();

        $inventory = Inventory::where('inbound_detail_id', $inboundDetail->id)->first();
        if($inventory){
            $inventory->quantity += $partial->Qty;
            $inventory->save();

            $inventory->histories()->create([
                'type'              => 'inbound',
                'quantity'          => $partial->Qty,
                'current_quantity'  => $partial->Qty,
                'created_by'        => auth()->user()->id
            ]);

        }else {
            $inventory = new Inventory();
            $inventory->good_id = $inboundDetail->good_id;
            $inventory->inbound_detail_id = $inboundDetail->id;
            $inventory->quantity = $partial->Qty;
            $inventory->created_by = auth()->user()->id;
            $inventory->save();
        }

        if($inventory->quantity == $inboundDetail->quantity){
            $inbound->partial = 2;
            $inbound->save();
        }

        $partialSave = DB::table('partials')->where('id', $id)->update([
            'status' => 1,
            'keterangan' => '-'
        ]);

        if($inventory && $partialSave){
            DB::commit();
            return redirect()->back()->with("success", "Data has been inserted");
        }

        return redirect()->back()->with("error", "Something Error !");

    }

    public function deletePartialinbound($id){

        // $idnya = partial::where('id','=', $id)->first();

        // DB::table('partials')
        // ->where('Nomor_Pengajuan','=', $idnya->Nomor_Pengajuan)
        // ->where('Sku_Barang','=',$idnya->Sku_Barang)
        // ->update([
        //     'status' => 0
        // ]);

        partial::where('id','=', $id)->delete();
        
        return redirect()->back()->with("success", "Data has been deleted");

    }


    //Start Outbound


    public function getpartialoutbound($id, $sku){

        $nomor_pengajuan = DB::table('outbounds')->find($id);
        $NomorPengajuan = $nomor_pengajuan->request_number;
        $datapartial = DB::table('partials')->where('Nomor_pengajuan','=',$NomorPengajuan)->where('Sku_Barang','=',$sku)->orderBy('tanggal')->get();
        
        $parstatus = DB::table('partials')->where('Nomor_Pengajuan','=',$NomorPengajuan)->where('Sku_Barang','=',$sku)->first();

        if($parstatus == null || $parstatus->status >= 0){
            $mysession = Session::get('bc_id');

            if($mysession == 'bc41'){
                $toolbar = "BC 41";
                $mainUrl = url('outbound/bc-41');
                $moduleNav = "outboundbc41";
                Session(['urlku' => 'outbound/bc-41']);
            }
            
            else if($mysession == 'bc25'){
                $toolbar = "BC 25";
                $mainUrl = url('outbound/bc-25');
                $moduleNav = "outboundbc25";
                Session(['urlku' => 'outbound/bc-25']);
            }

            if($parstatus == null){
                $statuspars = 0;
            }
            else{
                $statuspars = $parstatus->status;
            }

            $status_outbound = $nomor_pengajuan->status_id;
            $goods = DB::table('goods')->orWhereJsonContains('details->kode_barang', $sku)->first();
            

        $__user = auth()->user();
        $partial = DB::table('partials')->where('Nomor_pengajuan','=',$nomor_pengajuan->request_number)->where('Sku_Barang','=',$sku)->first();
        return view('outbound.components.detail.partial_goods_table', compact('moduleNav','__user','id','sku','partial','datapartial','statuspars','status_outbound','toolbar','mainUrl','goods')); 
        }
    }

    public function postpartialoutbound(Request $request, $id, $sku){
        
        DB::beginTransaction();

        if($request->tanggal_partial == null){
            return redirect()->back()->with("error", "Tanggal Partial Tolong Diisi");
        }

        $nomor_pengajuan = DB::table('outbounds')->find($id);
        $NomorPengajuan = $nomor_pengajuan->request_number;
        $check_qty = DB::table('partials')->where('Nomor_pengajuan','=',$NomorPengajuan)->where('Sku_Barang','=',$sku)->sum('Qty');

        $goodid = DB::table('goods')->orWhereJsonContains('details->kode_barang', $sku)->first();
        $checkdetail_qty = DB::table('outbound_details')->where('outbound_id','=',$id)->where('good_id','=',$goodid->id)->first();

        $checkBC = DB::table('bc_forms')->where('id','=', $nomor_pengajuan->bc_form_id)->first();
        $bcnya = $checkBC->name;
        
        $urlku = Session::get('urlku');
        // if quantity BC lebih besar Quantity input dan yang sudah ada (status 1 (Blom Selesai))
        if(round($checkdetail_qty->quantity, 5) > round($check_qty + $request->jumlah_partial, 5)){
            
            $partial = new partial();
            $partial->Nomor_Pengajuan = $NomorPengajuan;
            $partial->Sku_Barang = $sku;
            $partial->Qty = $request->jumlah_partial;
            $partial->tanggal = $request->tanggal_partial;
            $partial->status = $request->status;
            $partial->keterangan = $request->keterangan ?? '-';
            $partial->jenis_BC = $bcnya;
            $partial->created_by = auth()->user()->id;
            $partial->save();

            if($partial){
                DB::commit();
                return redirect($urlku."/detail/partial/".$id."/".$sku)->with("success", "Data has been inserted");
            }

            DB::rollBack();
            return redirect($urlku."/detail/partial/".$id."/".$sku)->with("error", "Something Error !");
            
        }

        // else if quantity BC sama besar dengan Quantity Input + yang sudah ada (Status 0 (Sudah Selesai))
        elseif(round($checkdetail_qty->quantity, 5) == round($check_qty + $request->jumlah_partial, 5)){
            $partial = new partial();
            $partial->Nomor_Pengajuan = $NomorPengajuan;
            $partial->Sku_Barang = $sku;
            $partial->Qty = $request->jumlah_partial;
            $partial->tanggal = $request->tanggal_partial;
            $partial->status = $request->status;
            $partial->keterangan = $request->keterangan ?? '-';
            $partial->jenis_BC = $bcnya;
            $partial->created_by = auth()->user()->id;
            $partial->save();

            // DB::table('partials')->where('Nomor_Pengajuan','=', $NomorPengajuan)->where('Sku_Barang','=',$sku)->update([
            //     'status' => 1
            // ]);

            // Change Status Partial Inbound jika semua barang sudah selesai partial
            $getgood = DB::table('outbound_details')->where('outbound_id','=', $id)->get();

            // $tanda = 0;
            // $jumlahloop = sizeof($getgood);

            // for($i = 0; $i < $jumlahloop; $i++){
            //     $goodcode = DB::table('goods')->find($getgood[$i]->good_id);
            //     $paksa = json_decode($goodcode->details,true);
            //     $parstatus = DB::table('partials')->where('Nomor_Pengajuan','=',$NomorPengajuan)->where('Sku_Barang','=',$paksa['kode_barang'])->first();
            //     if($parstatus == null){
                    
            //     }
            //     else if($parstatus->status == 1){
            //         $tanda = $tanda + 1;
            //     }
            // }

            // if($tanda == sizeof($getgood)){
            //     DB::table('outbounds')->where('request_number','=', $NomorPengajuan)->update([
            //         'partial' => 2
            //     ]);
            // }

            if($partial){
                DB::commit();
                return redirect($urlku."/detail/partial/".$id."/".$sku)->with("success", "Data has been inserted");
            }

            DB::rollBack();
            return redirect($urlku."/detail/partial/".$id."/".$sku)->with("error", "Something Error !");

        }
        // else Qty Input dan yang sudah ada melebihi Qty BC
        else{
            $hasil = round($checkdetail_qty->quantity - $check_qty, 5);
            return redirect()->back()->with("error", "Quantity yang diinput melebihi quantity tersisa, quantity tersisa: ".$hasil);
        }
    }

    public function sppdPartialoutbound($id)
    {

        DB::beginTransaction();
    
        $partialSave    = false;
        $canSPPDOutbound= true;
        $partial        = DB::table('partials')->where('id', $id)->first();

        $good           = Good::orWhereJsonContains('details->kode_barang', $partial->Sku_Barang)->first();
        $outbound       = Outbound::where('request_number', $partial->Nomor_Pengajuan)->first();
        $bc             = $outbound->bc_form_id == 2 ? 'BC41' : 'BC25';
        $outboundDetail = OutboundDetail::where('outbound_id', $outbound->id)->where('good_id', $good->id)->first();

        $inventoryOutboundDetailsBackups = [];

        if($outbound->bc_form_id == 4 && $outbound->details['type_calculate'] != 0){

            $goodConversions = GoodConversion::where('good_id', $outboundDetail->good_id)->get();
            foreach($goodConversions as $goodConversion){

                $good = Good::find($goodConversion->good_conversion_id);
                $outboundDetailRawGood = OutboundDetailRawGood::where('good_id', $good->id)
                                        ->where('good_conversion_id', $goodConversion->good_id)
                                        ->where('outbound_detail_id', $outboundDetail->id)
                                        ->first();

                if(!$outboundDetailRawGood || empty($outboundDetailRawGood)){
                    $canSPPDOutbound = false;
                }
            }

        }

        if(!$canSPPDOutbound){
            return redirect()->back()->with("error", "Failed to SPPD Good Because Calculate not Finished !");
        }
 
        $inventoryConversion = InventoryConversion::where('good_id', $outboundDetail->good_id)
                                ->where('bc_form_id', $outbound->bc_form_id)
                                ->first();

        $goods = GoodConversion::where('good_id', $inventoryConversion->good_id)->get();

        $quantityMaps = [];
        $quantityMins = [];
        foreach($goods as $good){
            $quantityMaps[$good->good_conversion_id] = $partial->Qty * $good->quantity;
            $quantityMins[$good->good_conversion_id] = $good->quantity;
        }

        // Set Inventory Conversions Quantity

        $outboundQuantity = $partial->Qty;
        $inventoryConversion->quantity -= $outboundQuantity;
        $inventoryConversion->total_outbound += $outboundQuantity;
        $inventoryConversion->save();

        // Check Data Bahan Baku / Konversi 
        // START
        $inventoryConversionHistories = InventoryConversionHistory::select('inventory_conversion_histories.*',  DB::raw('SUM(inventory_conversion_histories.quantity_good) as quantity_good'))
                                        ->join('inventory_conversions', 'inventory_conversion_histories.inventory_conversion_id', '=' , 'inventory_conversions.id')
                                        ->join('inventories', 'inventory_conversion_histories.inventory_id', '=', 'inventories.id')
                                        ->join('bc_forms', 'inventory_conversion_histories.bc_form_id', '=', 'bc_forms.id')
                                        ->where('inventory_conversions.id', $inventoryConversion->id)
                                        ->where('inventory_conversion_histories.quantity', '!=', 0)
                                        ->where('inventory_conversion_histories.type', 'conversion')
                                        ->where('bc_forms.name', $bc)
                                        ->orderBy('created_at', 'ASC')
                                        ->orderBy('inventory_id', 'ASC')
                                        ->groupBy('inventories.id')
                                        ->get();
        $inventoryHistoryIDs = [];
        foreach($inventoryConversionHistories as $inventoryConversionHistory){
            $inventoryHistoryIDs[] = $inventoryConversionHistory->inventory_id;
        }

        $inventoryOutboundDetailsBackups = OutboundDetail::select('outbound_details.*')
                                            ->join('inventory_outbound_details', 'inventory_outbound_details.outbound_detail_id', '=', 'outbound_details.id')
                                            ->join('inventories', 'inventory_outbound_details.inventory_id', '=', 'inventories.id')
                                            ->where('inventory_outbound_details.status', 0)
                                            ->whereIn('inventory_id', $inventoryHistoryIDs)
                                            ->whereNotIn('outbound_details.id' , [$outboundDetail->id])
                                            ->groupBy('outbound_details.id')
                                            ->get();
    
        $inventoryOutboundDetails = InventoryOutboundDetail::whereIn('inventory_id', $inventoryHistoryIDs)
                                    ->where('inventory_conversion_id', $inventoryConversion->id)
                                    ->where('status', 0)
                                    ->get();
        
        foreach($inventoryOutboundDetails as $inventoryOutboundDetail){
            $inventoryOutboundDetail->delete();
        }

        $codeProduction = 'PRD' . Carbon::now()->format('Ymdhis') . strtoupper(Str::random(4));    
        foreach($inventoryConversionHistories as $inventoryConversionHistory){

            $inventoryOutboundDetails = InventoryOutboundDetail::where('inv_conversion_history_id', $inventoryConversionHistory->id)
                                        ->get();
                  
            if($inventoryOutboundDetails){

                foreach($inventoryOutboundDetails as $inventoryOutboundDetail){

                    $inventoryConversionHistory->quantity_good -= $inventoryOutboundDetail->quantity_good_conversion;

                }

            }
            
            $inventoryInbound = Inventory::find($inventoryConversionHistory->inventory_id);          
            $inboundDetail    = InboundDetail::find($inventoryInbound->inbound_detail_id);
            $inbound          = Inbound::find($inboundDetail->inbound_id);
            
            $goodConversion   = GoodConversion::where('good_id', $inventoryConversion->good_id)->first();
            
            // $countQuantityOutbound = 0;
            $limitInventoryConversion = $inventoryConversionHistory->quantity_good;
       
            if($limitInventoryConversion == 0){
                continue;
            }
      
            if($limitInventoryConversion >= $quantityMaps[$inboundDetail->good_id] 
            && $quantityMaps[$inboundDetail->good_id] 
            && $limitInventoryConversion != 0){
                
                $quantityOutboundData = $quantityMaps[$inboundDetail->good_id]  / $quantityMins[$inboundDetail->good_id];
                // $quantityGoodData    = ($quantityOutboundData < 1 ? 1 : $quantityOutboundData) * $quantityMins[$inboundDetail->good_id];

                $inventoryOutboundDetailData = [
                    'outbound_id' => $outbound->id,
                    'outbound_detail_id' => $outboundDetail->id,
                    'inventory_id' =>  $inventoryInbound->id,
                    'inventory_conversion_id' =>  $inventoryConversionHistory->inventory_conversion_id,
                    'inv_conversion_history_id' => $inventoryConversionHistory->id,
                    'inbound_id' => $inbound->id,
                    'inbound_detail_id' => $inboundDetail->id,
                    'good_id' => $inboundDetail->good_id,
                    'good_conversion_id' => $goodConversion->good_id,
                    'status' => 1,
                    'quantity_good_conversion' => $quantityMaps[$inboundDetail->good_id],
                    'quantity_outbound' => floatval($outboundDetail->quantity),
                    'created_by' => auth()->user()->id
                ];
                
                $history = $inventoryConversion->histories()->create([
                    "code_production" => $codeProduction,
                    "bc_form_id"    => $outbound->bc_form_id,
                    "inventory_id" => $inventoryInbound->id,
                    "current_quantity" => floatval($partial->Qty),
                    "quantity" => floatval($partial->Qty),
                    "quantity_good" => $quantityMaps[$inboundDetail->good_id] ,
                    "type" => "outbound"
                ]);

                $quantityMaps[$inboundDetail->good_id] = round($limitInventoryConversion, 5) - round($quantityMaps[$inboundDetail->good_id], 5);
        
                $insertInventoryOutboundDetail = InventoryOutboundDetail::create($inventoryOutboundDetailData);
            
                $quantityMaps[$inboundDetail->good_id] = 0;
        
                if (!$insertInventoryOutboundDetail || !$inventoryConversion || !$history) {
                    DB::rollBack();
                    return;
                }
                continue;

            }else if($quantityMaps[$inboundDetail->good_id] != 0 
            && $limitInventoryConversion != 0 ){
                
                $quantityOutboundData = $inventoryConversionHistory->quantity_good / $quantityMaps[$inboundDetail->good_id];

                $inventoryOutboundDetailData = [
                    'outbound_id' => $outbound->id,
                    'outbound_detail_id' => $outboundDetail->id,
                    'inventory_id' =>  $inventoryInbound->id,
                    'inventory_conversion_id' =>  $inventoryConversionHistory->inventory_conversion_id,
                    'inv_conversion_history_id' => $inventoryConversionHistory->id,
                    'inbound_id' => $inbound->id,
                    'inbound_detail_id' => $inboundDetail->id,
                    'good_id' => $inboundDetail->good_id,
                    'good_conversion_id' => $goodConversion->good_id,
                    'status' => 1,
                    'quantity_good_conversion' => $inventoryConversionHistory->quantity_good,
                    'quantity_outbound' => floatval($quantityOutboundData),
                    'created_by' => auth()->user()->id
                ];

                $history = $inventoryConversion->histories()->create([
                    "code_production" => $codeProduction,
                    "bc_form_id"    => $outbound->bc_form_id,
                    "inventory_id" => $inventoryInbound->id,
                    "current_quantity" => floatval($quantityOutboundData),
                    "quantity" => floatval($quantityOutboundData),
                    "quantity_good" => $inventoryConversionHistory->quantity_good ,
                    "type" => "outbound"
                ]);

                $quantityMaps[$inboundDetail->good_id] = round($quantityMaps[$inboundDetail->good_id], 5) - round($limitInventoryConversion, 5);
                $insertInventoryOutboundDetail = InventoryOutboundDetail::create($inventoryOutboundDetailData);
            
                if (!$insertInventoryOutboundDetail || !$inventoryConversion || !$history) {
                    DB::rollBack();
                    return;
                }
            
                continue;

            }

        }    
   
        foreach ($quantityMaps as $quantity) {
            if ($quantity > 0) {
                DB::rollBack();
                return redirect()->back()->with("error", "Failed to update good conversion");
            }
        }

        // END

        DB::commit();
        
        DB::beginTransaction();
    
        foreach($inventoryOutboundDetailsBackups as $inventoryOutboundDetailsBackup){
           
            $inventoryConversion = InventoryConversion::where('good_id', $inventoryOutboundDetailsBackup->good_id)->first();
            $goods = GoodConversion::where('good_id', $inventoryConversion->good_id)->get();
     
            $quantityMaps = [];
            $quantityMins = [];
            foreach($goods as $good){
                $quantityMaps[$good->good_conversion_id] = $inventoryOutboundDetailsBackup->quantity * $good->quantity;
                $quantityMins[$good->good_conversion_id] = $good->quantity;
            }
     
            $outboundQuantity = $inventoryOutboundDetailsBackup->quantity;
            $inventoryConversionHistories = InventoryConversionHistory::select('inventory_conversion_histories.*',  DB::raw('SUM(inventory_conversion_histories.quantity_good) as quantity_good'))
                                            ->join('inventory_conversions', 'inventory_conversion_histories.inventory_conversion_id', '=' , 'inventory_conversions.id')
                                            ->join('inventories', 'inventory_conversion_histories.inventory_id', '=', 'inventories.id')
                                            ->join('bc_forms', 'inventory_conversion_histories.bc_form_id', '=', 'bc_forms.id')
                                            ->where('inventory_conversions.id', $inventoryConversion->id)
                                            ->where('inventory_conversion_histories.quantity', '!=', 0)
                                            ->where('inventory_conversion_histories.type', 'conversion')
                                            ->where('bc_forms.name', $bc)
                                            ->orderBy('created_at', 'ASC')
                                            ->orderBy('inventory_id', 'ASC')
                                            ->groupBy('inventories.id')
                                            ->get();

            foreach($inventoryConversionHistories as $inventoryConversionHistory){

                $inventoryOutboundDetails = InventoryOutboundDetail::where('inv_conversion_history_id', $inventoryConversionHistory->id)
                                            ->get();

                if($inventoryOutboundDetails){

                    foreach($inventoryOutboundDetails as $inventoryOutboundDetail){
                        $inventoryConversionHistory->quantity_good -= $inventoryOutboundDetail->quantity_good_conversion;
                    }

                }
                
                $inventoryInbound = Inventory::find($inventoryConversionHistory->inventory_id);          
                $inboundDetail    = InboundDetail::find($inventoryInbound->inbound_detail_id);
                $inbound          = Inbound::find($inboundDetail->inbound_id);
                
                $goodConversion   = GoodConversion::where('good_id', $inventoryConversion->good_id)->first();
                
                $limitInventoryConversion = $inventoryConversionHistory->quantity_good;
    
                if($limitInventoryConversion >= $quantityMaps[$inboundDetail->good_id] 
                && $quantityMaps[$inboundDetail->good_id] 
                && $limitInventoryConversion != 0){
                    
                    $quantityOutboundData = $quantityMaps[$inboundDetail->good_id]  / $quantityMins[$inboundDetail->good_id];
                    // $quantityGoodData    = ($quantityOutboundData < 1 ? 1 : $quantityOutboundData) * $quantityMins[$inboundDetail->good_id];

                    $inventoryOutboundDetailData = [
                        'outbound_id' => $inventoryOutboundDetailsBackup->outbound_id,
                        'outbound_detail_id' => $inventoryOutboundDetailsBackup->id,
                        'inventory_id' =>  $inventoryInbound->id,
                        'inventory_conversion_id' =>  $inventoryConversionHistory->inventory_conversion_id,
                        'inv_conversion_history_id' => $inventoryConversionHistory->id,
                        'inbound_id' => $inbound->id,
                        'inbound_detail_id' => $inboundDetail->id,
                        'good_id' => $inboundDetail->good_id,
                        'good_conversion_id' => $goodConversion->good_id,
                        'status' => 0,
                        'quantity_good_conversion' => $quantityMaps[$inboundDetail->good_id],
                        'quantity_outbound' => $inventoryOutboundDetailsBackup->quantity,
                        'created_by' => auth()->user()->id
                    ];

                    $quantityMaps[$inboundDetail->good_id] = round($limitInventoryConversion, 5) - round($quantityMaps[$inboundDetail->good_id], 5);
            
                    $insertInventoryOutboundDetail = InventoryOutboundDetail::create($inventoryOutboundDetailData);

                    $quantityMaps[$inboundDetail->good_id] = 0;

                    if (!$insertInventoryOutboundDetail || !$inventoryConversion) {
                        DB::rollBack();
                        return;
                    }
                    continue;

                }else if($quantityMaps[$inboundDetail->good_id] != 0 
                && $limitInventoryConversion != 0 ){
                                   
                    $quantityOutboundData = $inventoryConversionHistory->quantity_good / $quantityMaps[$inboundDetail->good_id];

                    $inventoryOutboundDetailData = [
                        'outbound_id' => $inventoryOutboundDetailsBackup->outbound_id,
                        'outbound_detail_id' => $inventoryOutboundDetailsBackup->id,
                        'inventory_id' =>  $inventoryInbound->id,
                        'inventory_conversion_id' =>  $inventoryConversionHistory->inventory_conversion_id,
                        'inv_conversion_history_id' => $inventoryConversionHistory->id,
                        'inbound_id' => $inbound->id,
                        'inbound_detail_id' => $inboundDetail->id,
                        'good_id' => $inboundDetail->good_id,
                        'good_conversion_id' => $goodConversion->good_id,
                        'status' => 0,
                        'quantity_good_conversion' => $inventoryConversionHistory->quantity_good,
                        'quantity_outbound' => ceil($quantityOutboundData),
                        'created_by' => auth()->user()->id
                    ];

                    $quantityMaps[$inboundDetail->good_id] = round($quantityMaps[$inboundDetail->good_id], 5) - round($limitInventoryConversion, 5);
                    $insertInventoryOutboundDetail = InventoryOutboundDetail::create($inventoryOutboundDetailData);

                    if (!$insertInventoryOutboundDetail || !$inventoryConversion) {
                        DB::rollBack();
                        return;
                    }

                    continue;

                }

            }    

            foreach ($quantityMaps as $quantity) {
                if ($quantity > 0) {
                    DB::rollBack();
                    // return redirect($this->mainUrl)->with("error", "Failed to update good conversion");
                }
            }

        }
        
        $partialSave = DB::table('partials')->where('id', $id)->update([
            'status' => 1
        ]);

        DB::commit();
        return redirect()->back()->with("success", "Data has been inserted");


    }

    public function deletePartialoutbound($id){
        
        // $idnya = partial::where('id','=', $id)->first();

        // DB::table('partials')
        // ->where('Nomor_Pengajuan','=', $idnya->Nomor_Pengajuan)
        // ->where('Sku_Barang','=',$idnya->Sku_Barang)
        // ->update([
        //     'status' => 0
        // ]);

        partial::where('id','=', $id)->delete();
    
        return redirect()->back()->with("success", "Data has been deleted");

    }
}
