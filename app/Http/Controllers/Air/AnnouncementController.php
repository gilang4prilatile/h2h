<?php

namespace App\Http\Controllers\Air;

use App\Exports\BC40Export;
use App\Http\Controllers\MainController;
use App\Models\Inbound;
use App\Models\InboundDocument;
use App\Models\File as ModelFile;
use App\Models\Inventory;
use App\Models\partial;
use File;
use DB;
use Illuminate\Http\Request;
use function PHPUnit\Framework\at;
use Illuminate\Support\Facades\Session;
use PHPUnit\Framework\Constraint\Count;

class AnnouncementController extends MainController
{

    public function __construct() {
        ini_set('max_execution_time', 600);
        parent::__construct();
    }

    public function getDataTable($bc, $canEdit, $canDelete, $doneStatusId,Request $request=null)
    {

        $query = Inbound::with([
            'inboundKppbcPengawas', 
            'inboundPpjk', 
            'inboundImportir', 
            'inboundPemilikBarang', 
            'inboundPemusatanBarang', 
            'inboundPengirimBarang', 
            'inboundPenjualBarang',
            'createdBy'
        ])->select("inbounds.*")
        ->join('bc_forms', 'inbounds.bc_form_id', '=', 'bc_forms.id')
        ->where('bc_forms.name', '=', $bc);
        
        if($request !=null){
            $formArray = filterDataTableToArray($request->form);
        
            if($formArray['request_number']!=null) {
                $query = $query->where('request_number', "like", "%" . $formArray['request_number'] . "%");
            }
            
            if($formArray['ppjk']!=null || $formArray['ppjk']!="") {
                $query = $query->whereHas('inboundPpjk.profile', function($q) use ($formArray) {
                    $q->where('name', "like", "%" . $formArray['ppjk'] . "%");
                });
            }
            
            if($formArray['importir']!=null || $formArray['importir']!="") {
                $query = $query->whereHas('inboundImportir.profile', function($q) use ($formArray) {
                    $q->where('name', "like", "%" . $formArray['importir'] . "%");
                });
            } 

            if($formArray['pemusatan']!=null || $formArray['pemusatan']!="") {
                $query = $query->whereHas('inboundPemusatanBarang.profile', function($q) use ($formArray) {
                    $q->where('name', "like", "%" . $formArray['pemusatan'] . "%");
                });
            } 

            if($formArray['pemilik']!=null || $formArray['pemilik']!="") {
                $query = $query->whereHas('inboundPemilikBarang.profile', function($q) use ($formArray) {
                    $q->where('name', "like", "%" . $formArray['pemilik'] . "%");
                });
            } 

            if($formArray['penjual']!=null || $formArray['penjual']!="") {
                $query = $query->whereHas('inboundPenjualBarang.profile', function($q) use ($formArray) {
                    $q->where('name', "like", "%" . $formArray['penjual'] . "%");
                });
            } 

            if($formArray['pengirim']!=null || $formArray['pengirim']!="") {
                $query = $query->whereHas('inboundPengirimBarang.profile', function($q) use ($formArray) {
                    $q->where('name', "like", "%" . $formArray['pengirim'] . "%");
                });
            } 

            if(isset($formArray['nomor_pendaftaran']) 
            && $formArray['nomor_pendaftaran']!=null) {
                $query = $query->where('details->nomor_pendaftaran', "like", "%" . $formArray['nomor_pendaftaran'] . "%");
            }
        
            if($formArray['status']!=null){
                $query = $query->where('status_id', "like", $formArray['status'] );
            }

            if($formArray['intangible_status']!=null){
                $query = $query->where('intangible_status', "like", $formArray['intangible_status'] );
            } 
        
            if (isset($formArray['tanggal_pendaftaran_1']) 
            && $formArray['tanggal_pendaftaran_1'] != null
            && isset($formArray['tanggal_pendaftaran_2'])
            && $formArray['tanggal_pendaftaran_2'] != null)    {
                $query->whereBetween('details->tanggal_pendaftaran', [$formArray['tanggal_pendaftaran_1'], $formArray['tanggal_pendaftaran_2']]);
            }
        }
        
        $query->orderBy('created_at', 'DESC')->get();
        Session::put('query', $query->get());
        
        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $query = $query->whereHas('createdBy', function($query) use ($user) {
                $query->where('warehouse_id', $user->warehouse_id);
                $query->where('profile_id', $user->profile_id);
        
            });
        }
        
        $data_tables = datatables()->of($query)
            ->addColumn("actions", function ($row) use ($canEdit, $canDelete, $doneStatusId) {
                $view = [
                    "url" => $this->mainUrl . '/detail/' . $row->id,
                    "label" => "",
                ];
                $edit = [
                    "url" => $this->mainUrl . '/edit/' . $row->id,
                    "label" => "",
                ];
                $delete = [
                    "url" => $this->mainUrl . '/delete/' . $row->id,
                    "label" => "",
                ];
                $excel = [
                    "url" => $this->mainUrl . '/excel/' . $row->id,
                    "label" => ''
                ];
        
                $pdf = [
                    "url" => $this->mainUrl . '/pdf/' . $row->id,
                    "label" => ''
                ];
        
                $copy = [
                    "url" => $this->mainUrl . '/copy/' . $row->id,
                    "label" => ''
                ];
        
                if ($row->status_id == $doneStatusId) {
                    $edit = [];
                    $delete = [];
                }
                return view("components.table.actions", [
                    "actions" => [
                        "view" => $view,
                        "edit" => $canEdit ? $edit : null,
                        "delete" => $canDelete ? $delete : null,
                        "excel" => $excel,
                        "pdf" => $pdf,
                        "copy" => $copy
                    ],
        
                ]);
            })
            ->addColumn("intangible_status", function ($row) {
                return $row->intangible_status == 0 ? "YA" : "TIDAK";
            })
            ->addColumn("dokumen", function ($row) use ($canEdit, $canDelete, $doneStatusId) {
                    $dokumen = DB::table('inbound_documents')->where('inbound_id','=',$row->id)->count();
                    return $dokumen;
            })
            ->addColumn("barang", function ($row) use ($canEdit, $canDelete, $doneStatusId) {
                    $barang = DB::table('inbound_details')->where('inbound_id','=',$row->id)->sum('quantity');
                    return $barang;
            })
            ->addColumn("jumlah_barang", function ($row) use ($canEdit, $canDelete, $doneStatusId) {
                    $jumlah_barang = DB::table('inbound_details')->where('inbound_id','=',$row->id)->count();
                    return $jumlah_barang;
            })
            ->addColumn("kppbc_pengawas", function ($row) {
                return $row->inboundKppbcPengawas->masterKppbc->code_name  ? $row->inboundKppbcPengawas->masterKppbc->code_name: '-';
            })
            ->addColumn("ppjk", function ($row) {
                return $row->inboundPpjk->profile->name  ?? '-';
            })
            ->addColumn("importir", function ($row) {
                return $row->inboundImportir->profile->name ?? '-';
            })
            ->addColumn("pemilik_barang", function ($row) {
                return $row->inboundPemilikBarang->profile->name ?? '-';
            })
            ->addColumn("pemusatan_barang", function ($row) {
                return $row->inboundPemusatanBarang->profile->name ?? '-';
            })
            ->addColumn("pengirim_barang", function ($row) {
                if($row->intangible_status ==0 ){
                    return $row->inboundPengirimBarang->profile->name ?? '-';
                }else{
                    return "-";   
                }
            })
            ->addColumn("penjual_barang", function ($row) {
                return $row->inboundPenjualBarang->profile->name ?? '-';
            })
            ->addColumn("createdBy", function ($row) {
                return $row->createdBy->name  ? $row->createdBy->name : '-';
            })
            ->make();
        
            return $data_tables;
         
    }

    public function inboundDone($inboundId, $statusId, $bc) {
        return(123);
        DB::beginTransaction();

        $inbound = Inbound::find($inboundId);

        $details = true;
        $canSub  = true;

        $details = $inbound->inboundDetails()->get();
     
        foreach($details as $detail){

            $quantityPartial = 0;

            if($inbound->partial == 0){
                $detail->inventories()->create([
                    "good_id" => $detail->good_id,
                    "quantity" => $detail->quantity
                ]);
            }
           
            if($inbound->partial == 1){
                
                $inventory = Inventory::where('inbound_detail_id', $detail->id)->first();
                $partials = partial::where('Nomor_Pengajuan', $inbound->request_number)->where('Sku_Barang', $detail->details['kode_barang'])->get();
            
                foreach($partials as $partial){
                    $quantityPartial += $partial->Qty;
                }
         
                if($quantityPartial != $detail->quantity){
                   
                    $canSub = false;
                    break;
                }

                if($inventory){

                    foreach($partials as $partial){

                        if($partial->status == 0){

                            $inventory->quantity += $partial->Qty;
                            $inventory->save();

                            $inventory->histories()->create([
                                'type'              => 'inbound',
                                'quantity'          => $partial->Qty,
                                'current_quantity'  => $partial->Qty,
                                'created_by'        => auth()->user()->id
                            ]);

                            $partialUpdate = partial::find($partial->id);
                            $partialUpdate->status = 1;
                            $partialUpdate->save();
                        }

                    }

                    continue;
               
                }
                
                $quantityInventoryPartial = 0;

                foreach($partials as $partial){
                    
                    if($partial->status == 0){
                        $partialUpdate = partial::find($partial->id);
                        $partialUpdate->status = 1;
                        $partialUpdate->save();

                        $quantityInventoryPartial += $partialUpdate->Qty;

                    }


                }

                $inventory = new Inventory();
                $inventory->good_id = $detail->good_id;
                $inventory->inbound_detail_id = $detail->id;
                $inventory->quantity = $quantityInventoryPartial;
                $inventory->created_by = auth()->user()->id;
                $inventory->save();
       
                if(!$partialUpdate && !$inventory){
                    DB::rollBack();
                    return redirect()->back()->with("error", "Please check your partial data !");
                }

                
            }

        }

        $inbound->status_id = $statusId; // DONE
        if($inbound->partial == 1){
            $inbound->partial = 2;
        }
        $inbound->save();

        if(!$canSub){
      
            DB::rollBack();
            return redirect()->back()->with("error", "Please check your partial data !");
        }
    
        if($inbound && $details){
            DB::commit();
            return redirect($this->mainUrl)->with("success", "Data has been updated");
        }

        DB::rollBack();
        return redirect($this->mainUrl)->with("error", "Failed to update the specified resource");
    }

    public function getDelete($id)
    {

        DB::beginTransaction();
        $deleteInbound      = Inbound::find($id);
        $inboundDocuments   = InboundDocument::where('inbound_id', $deleteInbound->id)
                                ->groupBy('seri_document')
                                ->get();

        $deleteFile = true;
        $deleteFileDocuments = true;

        foreach($inboundDocuments as $inboundDocument){


            $fileDocs = ModelFile::where('fileable_id', $inboundDocument->id)->get();
            foreach($fileDocs as $fd){

                $deleteFile = File::delete($fd->path);
                $deleteFileDocuments = ModelFile::find($fd->id)->delete();

            }



        }

        $deleteInbound->delete();
        if ($deleteInbound && $deleteFile && $deleteFileDocuments) {
            DB::commit();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        }
        DB::rollBack();
        return redirect($this->mainUrl)->with("error", "Failed to delete the specified resource");

    }

    public function getValidationRequestNumber($requestNumber = null, $bcFormId = null)
    {

        $findData = Inbound::where('request_number', $requestNumber)
                    ->where('bc_form_id', $bcFormId)
                    ->first();

        return response()->json(['find_data' => $findData != null ? true : false]);

    }

    public function getValidationRegisterNumber($registerNumber = null, $bcFormId = null)
    {

        $findData = Inbound::where('details->nomor_pendaftaran', $registerNumber)
                    ->where('bc_form_id', $bcFormId)
                    ->first();
                    
        return response()->json(['find_data' => $findData != null ? true : false]);

    }
}
