<?php

namespace App\Http\Controllers\Air;

use App\Http\Controllers\Inbound\InboundController;
use App\Http\Controllers\Air\AnnouncementController;
use App\Helpers\GeneralHelper;
use App\Helpers\ComboHelper;
use App\Exports\OutboundBC23Export;
use App\Http\Requests\StoreInboundBC20Request;
use App\Http\Requests\StoreInboundRequest;
use App\Http\Requests\UpdateInboundRequest;
use App\Models\City;
use App\Models\Good;
use App\Models\HsCode;
use App\Models\Inbound;
use App\Models\InboundDetail;
use App\Models\InboundKppbc;
use App\Models\Inventory;
use App\Models\MasterDocument;
use App\Models\MasterJenisTpb;
use App\Models\MasterKppbc;
use App\Models\MasterPackage;
use App\Models\MasterTujuanPengiriman;
use App\Models\MasterUom;
use App\Models\MasterValas;
use Illuminate\Support\Str;
use App\Models\Port;
use App\Models\Profile;
use App\Models\Transportation;
use App\Models\Warehouse;
use App\Models\MasterImportType;
use App\Models\MasterPaymentType;
use App\Models\MasterBank;
use App\Models\MasterInstitutionalPermission;
use App\Models\MasterFasilitas;
use App\Models\InboundTransportation;
use App\Models\InboundTransportationPort; 
use App\Services\InboundService;
use App\Services\MasterData\DocumentService;
use App\Services\MasterData\JenisTpbService;
use App\Services\MasterData\KppbcService;
use App\Services\MasterData\PackageService;
use App\Services\MasterData\PengirimBarangService;
use App\Services\MasterData\TpbService;
use App\Services\MasterData\TujuanPengirimanService;
use Auth;
use DB;
use Exception;
use Throwable;
use Illuminate\Http\Request;
use App\Http\Controllers\MainController;
use App\Models\InboundDocument;
use App\Models\RatePreference;
use App\Exports\InboundBC20Export;
use App\Models\Country;
use App\Models\MasterIncoterm;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session; 
use App\Models\TransportLine;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Exports\TemplateBC20Export;
use App\Http\Requests\MasterData\UkuranPetiKemasRequest;
use App\Models\File;
use App\Models\MasterTypePetiKemas;
use App\Models\MasterUkuranPetiKemas; 
use App\Models\MasterTPS;
use App\Models\MasterTypeGoods;
use App\Http\Requests\UploadRequest;
use App\Services\ImportService;
use App\Imports\InboundDetails;
use App\Jobs\ProcessInboundDetailsJob;
use App\Jobs\ProcessFormBCJob;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Validator;
use Carbon\Carbon;

class AirPibController extends AnnouncementController
{
    public string $view;
    public string $mainUrl;

    protected $importService;
    

    public function __construct(ImportService $importService) 
    {
        set_time_limit(3600);
        ini_set('memory_limit', '512M');
        parent::__construct();

        $this->importService = $importService; // Set the import service

        // The rest of your existing setup
        $this->view .= "air.pib.";
        $this->mainUrl = url('air/pib');
        view()->share("mainUrl", $this->mainUrl);
        // view()->share("authToken", auth()->user()->token);
    }

    public function getIndex()
    {     
        $helpercombo = new ComboHelper();
        $user        = auth()->user(); 
        return $this->makeView("index.index", 
                                    array(
                                        'moduleNav' => 'airpib', 
                                        'jenisBarangTidakBerwujud'  => $helpercombo->getJenisBarangTidakBerwujud()
                                    )
                                );
    }

    public function getCopy($id)
    {
        $helper = new GeneralHelper();
        $result = $helper->duplicatedInbound($id, "BC20");
        if($result){
            return redirect()->back();
        }

        return redirect()->back();
    }

    public function getData(Request $request)
    {
        $user = auth()->user();
        $bc = 'BC20';
        $canEdit = $user->can('edit air pib');
        $canDelete = $user->can('delete air pib');
        return parent::getDataTable($bc, $canEdit, $canDelete, 7, $request);
    }

    public function getCreate()
    {
        $helper         = new GeneralHelper();
        $helpercombo    = new ComboHelper();
        $nomorPengajuan = $helper->generateRequestNumber(1, 20);
        $tanggalHariIni = date('d-m-Y');  
        $user = auth()->user();  
        return $this->makeView("add.add", [
            "mainUrl"                   => $this->mainUrl,
            "nomorPengajuan"            => $nomorPengajuan,
            "tanggalHariIni"            => $tanggalHariIni,
            "kppbcSelectBox"            => MasterKppbc::all()->pluck("code_name", "id"),
            "jenisTpbSelectBox"         => MasterJenisTpb::all()->pluck("code_name", "id"),
            "importirSelectBox"         => getprofile('importir'),
            "pemilikBarangSelectBox"    => getprofile('pemilik-barang'),
            "penjualBarangSelectBox"    => getprofile('penjual-barang'),
            "pengirimBarangSelectBox"   => getprofile('pengirim-barang'),
            "ppjkSelectBox"             => getprofile('ppjk'),
            "pemusatanSelectBox"        => getprofile('pemusatan-barang'),
            "packageSelectBox"          => MasterPackage::all()->pluck("code_name", "id"),
            "citySelectBox"             => City::all()->pluck("city", "id"),
            "documentSelectBox"         => MasterDocument::all()->pluck("code_name", "id"),
            "uoms"                      => MasterUom::all()->pluck("code_name", "id"),
            "masterIncoterms"           => MasterIncoterm::all()->pluck("code_name", "id"),
            "masterUkuranPetiKemas"     => MasterUkuranPetiKemas::all()->pluck("code_name", "id"),
            "masterTypePetiKemas"       => MasterTypePetiKemas::all()->pluck("code_name", "id"),
            "country"                   => Country::all()->pluck("code_name", "code"),
            "countryid"                 => Country::all()->pluck("code_name", "id"),
            "containers"                => $helpercombo->getContainers(),
            "transportations"           => Transportation::whereIn("transport_line_id", [1, 2])->get()->pluck("code_name", "id"), // Transportasi Laut dan Udara
            "valas"                     => MasterValas::all()->pluck("code_name", "code"),
            "warehouses"                => Warehouse::all()->pluck("name", "id"),
            "tps"                       => MasterTPS::all()->pluck('code_name', 'id'),
            "masterPaymentType"         => MasterPaymentType::all()->pluck('code_name', 'id'),
            "masterImportType"          => MasterImportType::all()->pluck('code_name', 'id'),
            "FasilitasSelectBox"        => MasterFasilitas::all()->pluck("code_name", "id"),
            "IzinSelectBox"             => MasterInstitutionalPermission::all()->pluck("code_name", "id"),
            'moduleNav'                 => 'airpib',
            'bmTypes'                   => $helpercombo->getBmTypes(),
            'TradeTransactionTypes'     => $helpercombo->getTradeTransactionTypes(),
            'JenisBarangTidakBerwujud'  => $helpercombo->getJenisBarangTidakBerwujud(),
            'taxTypes'                  => $helpercombo->getTaxTypes(), 
            'cukaiCommodity'            => $helpercombo->getCukaiCommodity(),
            'cukaiCommodityCode'        => $helpercombo->getCukaiCommodityCode(),
            'jenisPetiKemas'            => $helpercombo->getJenisPetiKemas(),
            'TutupPu'                   => $helpercombo->getTutupPu(),
            'kondisiBarang'             => $helpercombo->getKondisiBarang(),
            'jenisIdentitas'            => $helpercombo->getJenisIdentitas(),
            'jenisApi'                  => $helpercombo->getJenisApi(),
            'statusImportir'            => $helpercombo->getStatusImportir(),
            'jenisTransaksi'            => $helpercombo->getJenisTransaksi(),
            'hsCodes'                   => HsCode::where('type', 'sub-pos-asean')->get()->map(function ($v) {
                return [
                    "id" => $v->code,
                    "text" => $v->code . " - " . $v->details['description_id'],
                ];
            })->pluck('text', 'id')->prepend("-- Select -- ", ""),
            'jenisBarang' => MasterTypeGoods::all()->pluck('name', 'name'),
            'user_customer' => $user->profile_id,
            'user' => $user,
            'division'  => $user->warehouse->division ?? "",
            'user_kota' => getkota()
        ]);
    }
    
    public function postCreate(StoreInboundBC20Request $request)
    {
        
        $helper         = new GeneralHelper();
        $validation = Validator::make($request->all(), [
            'inbound_documents.*.file' => 'max:5000',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->with("error", "Please Check All File Size !");
        }
         
        DB::beginTransaction(); 
        $nomorPengajuan             = $helper->generateRequestNumber(1, 20);
        $request['request_number']  = $nomorPengajuan;
        $request['bc_form_id']      = 6;
        $request['status_id']       = 11;
        
        // open upload file bc
        if ($request->hasFile('dokumen_bc')) {
            $fileBC                 = $request->file('dokumen_bc');
            $fileExtBC              = $request->file('dokumen_bc')->guessExtension();
            $fileNameBC             = "IBN" . date('YmdHis') . "." . $fileExtBC;
            $destinationPathBC      = public_path() . '/upload_file/documents/inbound_documents_bc20';
            $fileBC->move($destinationPathBC, $fileNameBC);
            $request['dokumen_bc']  = $fileNameBC;
        } else {
            unset($request->dokumen_bc);
        }
        
        // close upload file bc
        $inbound                = Inbound::create($request->all());
        $profileCreate = [];

        if(!isset($request->importir_id)){
            $profileCreate[] = 'importir_';
        }

        if(!isset($request->pemilik_barang_id)){
            $profileCreate[] = 'pemilik_';
        }

        if(!isset($request->pengirim_barang_id)){
            $profileCreate[] = 'pengirim_';
        }

        if(!isset($request->penjual_barang_id)){
            $profileCreate[] = 'penjual_';
        }

        if(!isset($request->pemusatan_barang_id)){
            $profileCreate[] = 'pemusatan_';
        }

        if(!isset($request->ppjk_id)){
            $profileCreate[] = 'ppjk_';
        }

        $inputData = collect($request->all());
        
        // Menyaring input berdasarkan prefix 
        $filteredInput = $inputData->filter(function($value, $key) use ($profileCreate) {
            return Str::startsWith($key, $profileCreate);
        });
        
        $entitas = $helper->storeProfile($filteredInput);
       // $inboundPpjk            = true;
        $inboundKppbcPengawas   = $inbound->inboundKppbcPengawas()->create(["kppbc_id" => $request->kppbc_pengawas_id, "type" => "pengawas"]); 
        
        $importir_id            = $entitas['importir'] ?? $request->importir_id;
        $pemilik_barang_id      = $entitas['pemilik'] ?? $request->pemilik_barang_id;
        $pengirim_barang_id     = $entitas['pengirim'] ?? $request->pengirim_barang_id;
        $penjual_barang_id      = $entitas['penjual'] ?? $request->penjual_barang_id;
        $pemusatan_barang_id    = $entitas['pemusatan'] ?? $request->pemusatan_barang_id;
        

        if($importir_id){
            $inboundImportir        = $inbound->inboundImportir()->create(["profile_id" => $importir_id, "type" => "importir"]);
        }if($pemilik_barang_id){
            $inboundPemilikBarang   = $inbound->inboundPemilikBarang()->create(["profile_id" => $pemilik_barang_id, "type" => "pemilik-barang"]);
        }if($penjual_barang_id){
            $inboundPenjualBarang   = $inbound->inboundPenjualBarang()->create(["profile_id" => $penjual_barang_id, "type" => "penjual-barang"]);
        }if($pemusatan_barang_id){
            $inboundPemusatanBarang = $inbound->inboundPemusatanBarang()->create(["profile_id" => $pemusatan_barang_id, "type" => "pemusatan-barang"]);
        } 
        
        if(isset($request->ppjk_id)) {
            $inboundPpjk        = $inbound->inboundPpjk()->create(["profile_id" => $request->ppjk_id, "type" => "ppjk"]);
        }
        
        $inboundTransportation  = $inbound->inboundTransportation()->create(["transportation_id" => $request->details['transportation_id'] ?? 9, "vehicle_number" => $request->vehicle_number ?? 1, "country_code" => $request->country_id ?? "-", "name" => $request->transport_lines_id ?? "-"]);
        if($request->intangible_status  == 0){            
            $inboundTPS             = $inbound->inboundTPS()->create(["master_tps_id" => $request->master_tps_id]);
            if($pengirim_barang_id){
                $inboundPengirimBarang  = $inbound->inboundPengirimBarang()->create(["profile_id" => $pengirim_barang_id, "type" => "pengirim-barang"]);
            }
        }
        

        if(isset($request->valas_id)){
            $valas = DB::table('master_valas')->where('code', '=', $request->valas_id)->first();
            $inboundValas           = $inbound->inboundValas()->create(["valas_id" => $valas->id]);
        }

        $inboundTransportationLoadingPort   = true;
        $inboundTransportationTransitPort   = true;
        $inboundTransportationUnloadingPort = true;
       
            $ports = [];
            
            if ($request->destination_port_id != "") {
                array_push($ports, [
                    "inbound_transportation_id" => $inboundTransportation->id,
                    "port_id" => $request->destination_port_id, "type" => "tujuan"
                ]);
            }

            if ($request->loading_port_id != "") {
                array_push($ports, [
                    "inbound_transportation_id" => $inboundTransportation->id,
                    "port_id" => $request->loading_port_id, "type" => "muat"
                ]);
            }
            if ($request->transit_port_id != "") {
                array_push($ports, [
                    "inbound_transportation_id" => $inboundTransportation->id,
                    "port_id" => $request->transit_port_id, "type" => "transit"
                ]);
            }
            if ($request->unloading_port_id != "") {
                array_push($ports, [
                    "inbound_transportation_id" => $inboundTransportation->id,
                    "port_id" => $request->unloading_port_id, "type" => "bongkar"
                ]);
            }


            

            if (count($ports) > 0) {
                $inboundTransportationPorts = $inboundTransportation->transportationPorts()->insert($ports);
            }

           
      
        
        $checkFakturPajak = 0;
       
       // $valas = DB::table('hs_codes')->where('code', '=', $request->valas_id)->first();
        if(isset($request->list_barang)){ 

            $inboundDetails = json_decode($request->list_barang, true);
     
            if (json_last_error() === JSON_ERROR_NONE) { 
                foreach ($inboundDetails as &$detail) {
                    if (isset($detail['hs_code_id'])) {
                        $hs_code_id = $detail['hs_code_id'];
                       
                        $hs_codes = DB::table('hs_codes')->where('code', '=', $hs_code_id)->first();
                         
                        if ($hs_codes) { 
                            $detail['hs_code_id'] = $hs_codes->id;
                        } else {
                            $detail['hs_code_id'] = null;  
                        }
                    } else {
                        $detail['hs_code_id'] = null;  
                    }
                } 
                if($request->intangible_status  == 1){
                    $detail['package_id'] = 999;
                }
                $details = $inbound->inboundDetails()->createMany($inboundDetails);
            } else { 
                return response()->json(['error' => 'Error decoding JSON: ' . json_last_error_msg()]);
            } 
            $inboundDocuments = [];
            // dd($request->inbound_documents);

            for ($i = 0; $i < count($inboundDetails); $i++) {

                $seriBarang = $i + 1;
                if(count($inboundDetails[$i]['good_documents']) > 0){ 
                    for ($x = 0; $x < count($inboundDetails[$i]['good_documents']); $x++) {

                        for ($e = 0; $e < count($request->inbound_documents); $e++) {

                            $documentData       = $request->inbound_documents[$inboundDetails[$i]['good_documents'][$x]];
                             
                            $seriDoc            = $inboundDetails[$i]['good_documents'][$x] + 1;
                            $inboundDocument    = [
                                "seri_barang"       => $seriBarang,
                                "seri_document"     => $seriDoc,
                                "document_id"       => $documentData["document_id"],
                                "inbound_detail_id" => $details[$i]->id,
                                "id_fasilitas"                      => $documentData["id_fasilitas"],
                                "id_institutional_permission"       => $documentData["id_institutional_permission"],
                                "details"           => [
                                    "date"          => $documentData["date"],
                                    "nomor_dokumen" => $documentData["nomor_dokumen"]
                                ]
                            ];

                            if ($inboundDocument['document_id'] == 3) {
                                $checkFakturPajak = 1;
                            }

                            array_push($inboundDocuments, $inboundDocument);
                            break;
                        }
                    }
                }
            }
           
            //start dokumen header
            $seriDoc = 1;
            if(isset($request->inbound_documents) && count($request->inbound_documents) > 0){
               
                for ($e = 0; $e < count($request->inbound_documents); $e++) {
                    if (!empty($inboundDocuments)) {

                        foreach ($inboundDocuments as $inboundDocument) {

                            $inboundDoc = $request->inbound_documents[$e];
                        
                            if (
                                $inboundDoc['nomor_dokumen'] != $inboundDocument['details']['nomor_dokumen'] || $inboundDoc['document_id'] != $inboundDocument['document_id']
                            ) {

                                $inboundDocument = [
                                    "seri_barang"       => NULL,
                                    "seri_document"     => $seriDoc,
                                    "document_id"       => $inboundDoc["document_id"],
                                    "inbound_detail_id" => NULL,
                                    "details"           => [
                                        "date"          => $inboundDoc["date"],
                                        "nomor_dokumen" => $inboundDoc["nomor_dokumen"]
                                    ]
                                ];

                                if ($inboundDocument['document_id'] == 3) {
                                    $checkFakturPajak = 1;
                                }

                                array_push($inboundDocuments, $inboundDocument);
                                break;
                            } else {
                                $seriDoc++;
                                break;
                            }
                        }

                        $seriDoc++;
                        continue;
                    } 

                    $inboundDoc = $request->inbound_documents[$e];
                    $inboundDocument = [
                        "seri_barang"       => NULL,
                        "seri_document"     => $seriDoc,
                        "document_id"       => $inboundDoc["document_id"],
                        "inbound_detail_id" => NULL,
                        "details" => [
                            "date"          => $inboundDoc["date"],
                            "nomor_dokumen" => $inboundDoc["nomor_dokumen"]
                        ]
                    ];

                    if ($inboundDocument['document_id'] == 3) {
                        $checkFakturPajak = 1;
                    }

                    array_push($inboundDocuments, $inboundDocument);
                    $seriDoc++;
                }
                $documents      = $inbound->inboundDocuments()->createMany($inboundDocuments);
            }
            //end dokumen header
            
            //start petikemas header
            $inboundPetiKemass = [];
            $seriPK = 1;
            if(isset($request->inbound_peti_kemas) && count($request->inbound_peti_kemas) > 0 ){
                
                for ($e = 0; $e < count($request->inbound_peti_kemas); $e++) {

                    if (!empty($inboundPetiKemass)) {

                        foreach ($inboundPetiKemass as $inboundPetiKemas) {
                            // $inboundPK['nomor_peti_kemas'] != $inboundPetiKemas['details']['nomor_peti_kemas']
                            $inboundPK = $request->inbound_peti_kemas[$e];
                            if (
                                $inboundPK['nomor_peti_kemas'] !=  ['nomor_peti_kemas']
                            ) {

                                $inboundPetiKemas = [ 
                                    "no_seri"     		=> $seriPK,
                                    "container_id"      => $inboundPK["container_id"],
                                    "details"           => [
                                        "nomor_peti_kemas"     => $inboundPK["nomor_peti_kemas"],
                                        "jenis_peti_kemas"     => $inboundPK["jenis_peti_kemas"],
                                        "ukuran_peti_kemas_id" => $inboundPK["ukuran_peti_kemas_id"]
                                    ]
                                ]; 

                                array_push($inboundPetiKemass, $inboundPetiKemas);
                                break;
                            } else {
                                $seriPK++;
                                break;
                            }
                        }

                        $seriPK++;
                        continue;
                    } 

                    $inboundPK 		  = $request->inbound_peti_kemas[$e];
                    $inboundPetiKemas = [
                        "no_seri"        		=> $seriPK,
                        "container_id"       	=> $inboundPK["container_id"], 
                        "details" 				=> [
                            "nomor_peti_kemas"     => $inboundPK["nomor_peti_kemas"],
                            "jenis_peti_kemas"     => $inboundPK["jenis_peti_kemas"],
                            "ukuran_peti_kemas_id" => $inboundPK["ukuran_peti_kemas_id"]
                        ]
                    ];
        
                    array_push($inboundPetiKemass, $inboundPetiKemas);
                    $seriPK++;
                }
                $ipetikemas      = $inbound->inboundPetiKemas()->createMany($inboundPetiKemass);
            }
            //end petikemas header
            
            //start kemasan header
            $inboundKemass = [];
            $seriKMS = 1;
            if(isset($request->inbound_kemasan) && count($request->inbound_kemasan) > 0){
                 
                for ($e = 0; $e < count($request->inbound_kemasan); $e++) {

                    if (!empty($inboundKemass)) {
                        //dd($inboundKemass); die();
                        foreach ($inboundKemass as $inboundKemas) {

                            $inboundKms = $request->inbound_kemasan[$e];

                            if ($inboundKms['packaging_id'] !=  ['packaging_id']) {

                                $inboundKemas = [ 
                                    "no_seri"     		=> $seriKMS,
                                    "packaging_id"      => $inboundKms["packaging_id"],
                                    "details"           => [
                                        "jumlah_kemasan"     => $inboundKms["jumlah_kemasan"],
                                        "merek"    			 => $inboundKms["merek"]
                                    ]
                                ]; 

                                array_push($inboundKemass, $inboundKemas);
                                break;
                            } else {
                                $seriKMS++;
                                break;
                            }
                        }

                        $seriKMS++;
                        continue;
                    } 

                    $inboundKms 		  = $request->inbound_kemasan[$e];
                    $inboundKemas = [
                        "no_seri"        		=> $seriKMS,
                        "packaging_id"       	=> $inboundKms["packaging_id"], 
                        "details" 				=> [
                            "jumlah_kemasan"     => $inboundKms["jumlah_kemasan"],
                            "merek"    			 => $inboundKms["merek"]
                        ]
                    ];
        
                    array_push($inboundKemass, $inboundKemas);
                    $seriKMS++;
                }
                $ikemasan      = $inbound->inboundPackaging()->createMany($inboundKemass);
            } 
            //end kemasan header
            
            $groupSeriDoc   = $documents->unique(['seri_document']);
            $indexOfDoc     = 0;
        
            if(count($groupSeriDoc) > 0){
                foreach ($groupSeriDoc as $key => $document) {
                    if (isset($request->inbound_documents[$indexOfDoc])) {
                        if (!array_key_exists('file', $request->inbound_documents[$indexOfDoc])) {
                            continue;
                        }
                        $file                       = $request->inbound_documents[$indexOfDoc]['file'];
                        $fileName                   = $file->getClientOriginalName();
                        $randFileName               =  Str::random(15) . '.' . $file->getClientOriginalExtension();
                        $destinationPath            = 'upload_file/documents/inbound_documents_bc20';
                        $destinationPathPublic      = public_path() . '/' . $destinationPath;
                        $document->file()->create([
                            "name"      => $fileName,
                            "path"      => $destinationPath . '/' . $randFileName
                        ]);
                        $file->move($destinationPathPublic, $randFileName);
                        $indexOfDoc++;
                    }
                }
            }  
        }
        if (
            !$inbound 
            || !$inboundKppbcPengawas || 
            !$inboundImportir || !$inboundPemilikBarang  || !$inboundPenjualBarang || !$inboundPemusatanBarang || !$inboundPpjk || 
            !$details || !$documents || !$inboundValas 
        ) {
            DB::rollBack();
            return redirect()->back()->with("error", "Failed to create the specified resource")->withInput();
        }

        DB::commit();

        if ($checkFakturPajak == 0) {
            Inbound::where('request_number', '=', $request->request_number)->update([
                'faktur_pajak' => 2
            ]);
        }
 
        if ($checkFakturPajak == 1) {
            $ambilInbID = DB::table('inbounds')->where('request_number', '=', $request->request_number)->first();
            $checkJenisFile = DB::table('inbound_documents')->where('inbound_id', '=', $ambilInbID->id)->where('document_id', '=', 3)->first();
            $checkFile = DB::table('files')->where('fileable_id', '=', $checkJenisFile->id)->first();

            // ada faktur pajak dan ada file, column faktur_pajak = 1
            if ($checkFile != null) {
                DB::table('inbounds')->where('request_number', '=', $request->request_number)->update([
                    'faktur_pajak' => 1
                ]);
            }
        }
        


        if ($request->no_pos_dokumen_bc != "") {
            $getnewdataid   = DB::table('inbounds')->where('request_number', '=', $request->request_number)->first();
            $getnewdetailid = DB::table('inbound_details')->where('inbound_id', '=', $getnewdataid->id)->first();

            $dokumeninboundBC1                      = new InboundDocument();
            $dokumeninboundBC1->document_id         = '104';
            $dokumeninboundBC1->inbound_id          = $getnewdataid->id;
            $dokumeninboundBC1->inbound_detail_id   = $getnewdetailid->id;
            $dokumeninboundBC1->seri_document       = 0;
            $dokumeninboundBC1->seri_barang         = 0;
            $dokumeninboundBC1->details = [
                "date"                          => $request->tanggal_bc,
                "nomor_dokumen"                 => $request->no_dokumen_bc,
                "nomor_pos_dokumen"             => $request->no_pos_dokumen_bc,
                "nomor_sub_pos_dokumen"         => $request->no_sub_pos_dokumen_bc,
                "nomor_sub_sub_pos_dokumen"     => $request->no_sub_sub_pos_dokumen_bc
            ];
            $dokumeninboundBC1->created_by = auth()->user()->id;
            $dokumeninboundBC1->save();


           /* $getnewdokumenid = DB::table('inbound_documents')->where('inbound_id', '=', $getnewdataid->id)->where('document_id', '=', 104)->first();

            $filebcku = $request->file('dokumen_bc');
            $filerealname = $filebcku->getClientOriginalName();
            $dokumenBC1 = new File();
            $dokumenBC1->name = $filerealname;
            $dokumenBC1->path = "upload_file/documents/inbound_documents_bc20/" . $fileNameBC;
            $dokumenBC1->fileable_type = "App\Models\InboundDocument";
            $dokumenBC1->fileable_id = $getnewdokumenid->id;
            $dokumenBC1->created_by = auth()->user()->id;
            $dokumenBC1->save();*/
        } else {
            unset($request->dokumen_bc);
        }

        return redirect($this->mainUrl)->with("success", "Data has been created");
    }

    public function getEdit($id)
    {
        $user = auth()->user();
        $helpercombo    = new ComboHelper();
        $inbound = Inbound::with([
            'inboundDetails.good',
            'inboundDetails.hsCode',
            'inboundDetails.ratePreference',
            'inboundDocuments',
            'inboundDocuments.file',
            'inboundJenisTpb',
            'inboundKppbcPengawas',
            'inboundPengirimBarang.profile',
            'inboundTpb.profile',
            'inboundTujuanPengiriman',
            'inboundTransportation.transportation',
            'inboundTransportation.loadingPort',
            #'inboundTransportation.unloadingPort',
            #'inboundTransportation.transitPort',
            'inboundValas.masterValas',
            'inboundWarehouse.warehouse'
        ])->find($id);

        $bc11dokumen = DB::table('inbound_documents')->where('inbound_id', '=', $id)->where('document_id', '=', 104)->first();
        if ($bc11dokumen != null) {
            $bc11dokumens   = json_decode($bc11dokumen->details);
            $bc11files      = File::where('fileable_id', '=', $bc11dokumen->id)->first();
        }   

        $data_ports = DB::table('inbound_transportation_ports')
        ->select(['ports.*', 'inbound_transportation_ports.type'])
        ->join('ports', 'ports.id', '=', 'inbound_transportation_ports.port_id')
        ->whereIn('inbound_transportation_ports.inbound_transportation_id', $inbound->inboundTransportation->pluck('id'))
        ->get();

        
        $muat    = "";
        $transit = "";
        $bongkar = "";
        $tujuan  = ""; 

        foreach ($data_ports as $row_ports) {
            if ($row_ports->type == "muat") {
                $muat = $row_ports;
            }
            if ($row_ports->type == "transit") {
                $transit = $row_ports;
            }
            if ($row_ports->type == "bongkar") {
                $bongkar = $row_ports;
            }
            if ($row_ports->type == "tujuan") {
                $tujuan = $row_ports;
            }
        }
        $inbound['muat']        = $muat;
        $inbound['transit']     = $transit;
        $inbound['bongkar']     = $bongkar;
        $inbound['tujuan']      = $tujuan; 

        return $this->makeView("edit.edit", [
            "bc"                        => "BC20",
            "inbound"                   => $inbound,
            "intangible_status"         => $inbound->intangible_status == 0 ? "" : "display:none;",
            "mainUrl"                   => $this->mainUrl,
            "tanggalHariIni"            => date('Y-m-d'),
            "kppbcSelectBox"            => MasterKppbc::all()->pluck("code_name", "id"),
            "jenisTpbSelectBox"         => MasterJenisTpb::all()->pluck("code_name", "id"),
            "importirSelectBox"         => Profile::whereJsonContains('types', 'importir')->get()->pluck("name", "id"),
            "ppjkSelectBox"             => Profile::whereJsonContains('types', 'ppjk')->get()->pluck("name", "id"),
            "penjualBarangSelectBox"    => Profile::whereJsonContains('types', 'penjual-barang')->get()->pluck("name", "id"),
            "pengirimBarangSelectBox"   => Profile::whereJsonContains('types', 'pengirim-barang')->get()->pluck("name", "id"),
            "pemilikBarangSelectBox"    => Profile::whereJsonContains('types', 'pemilik-barang')->get()->pluck("name", "id"),
            "pemusatanSelectBox"        => Profile::whereJsonContains('types', 'pemusatan-barang')->get()->pluck("name", "id"),
            "masterUkuranPetiKemas"     => MasterUkuranPetiKemas::all()->pluck("code_name", "id"),
            "masterTypePetiKemas"       => MasterTypePetiKemas::all()->pluck("code_name", "id"),
            "masterIncoterms"           => MasterIncoterm::all()->pluck("code_name", "id"),
            "packageSelectBox"          => MasterPackage::all()->pluck("code_name", "id"),
            "citySelectBox"             => City::all()->pluck("city", "id"),
            "documentSelectBox"         => MasterDocument::all()->pluck("code_name", "id"),
            "FasilitasSelectBox"        => MasterFasilitas::all()->pluck("code_name", "id"),
            "IzinSelectBox"             => MasterInstitutionalPermission::all()->pluck("code_name", "id"),
            "uoms"                      => MasterUom::all()->pluck("code_name", "id"),
            "containers"                => $helpercombo->getContainers(),
            "transportations"           => Transportation::whereIn("transport_line_id", [1, 2])->get()->pluck("code_name", "id"), // Transportasi Laut dan Udara
            "country"                   => Country::all()->pluck("code_name", "code"),
            "valas"                     => MasterValas::all()->pluck("name", "id"),
            "warehouses"                => Warehouse::all()->pluck("name", "id"),
            "tps"                       => MasterTPS::all()->pluck('code_name', 'id'),
            "masterPaymentType"         => MasterPaymentType::all()->pluck('code_name', 'id'),
            "masterImportType"          => MasterImportType::all()->pluck('code_name', 'id'),
            'moduleNav'                 => 'airpib',
            'bmTypes'                   => $helpercombo->getBmTypes(),
            'TradeTransactionTypes'     => $helpercombo->getTradeTransactionTypes(),
            'JenisBarangTidakBerwujud'  => $helpercombo->getJenisBarangTidakBerwujud(),
            'taxTypes'                  => $helpercombo->getTaxTypes(), 
            'cukaiCommodity'            => $helpercombo->getCukaiCommodity(),
            'cukaiCommodityCode'        => $helpercombo->getCukaiCommodityCode(),
            'jenisPetiKemas'            => $helpercombo->getJenisPetiKemas(),
            'TutupPu'                   => $helpercombo->getTutupPu(),
            'kondisiBarang'             => $helpercombo->getKondisiBarang(),
            'jenisTransaksi'            => $helpercombo->getJenisTransaksi(),
            'hsCodes' => HsCode::where('type', 'sub-pos-asean')->get()->map(function ($v) {
                return [
                    "id" => $v->id,
                    "text" => $v->code . " - " . $v->details['description_id'],
                ];
            })->pluck('text', 'id')->prepend("-- Select -- ", ""),
            'jenisBarang' => MasterTypeGoods::all()->pluck('name', 'name'),
            'dokubc11' => $bc11dokumens ?? '',
            'bc11files' => $bc11files ?? '',
            'division'  => $user->warehouse->division ?? ""
        ]);
    }

    public function getDetail($id)
    {
        $helpercombo    = new ComboHelper();
        $inbound = Inbound::with([
            'inboundDetails.good',
            'inboundDetails.hsCode',
            'inboundDetails.ratePreference',
            'inboundDocuments.masterDocument',
            'inboundTPS.masterTPS',
            'inboundDocuments.file',
            'inboundJenisTpb.masterJenisTpb',
            'inboundKppbc.masterKppbc',
            'inboundPengirimBarang.profile',
            'inboundTpb.profile',
            'inboundTujuanPengiriman.masterTujuanPengiriman',
            'inboundTransportation.transportation',
            'inboundTransportation.loadingPort',
            // 'inboundTransportation.unloadingPort',
            // 'inboundTransportation.transitPort',
            'inboundValas.masterValas',
            'inboundWarehouse.warehouse'
        ])->find($id);
        if (
            isset($inbound->details['ukuran_peti_kemas_id'])
            && isset($inbound->details['type_peti_kemas_id'])
        ) {

            $ukuranPetiKemas    = MasterUkuranPetiKemas::find($inbound->details['ukuran_peti_kemas_id']);
            $typePetiKemas      = MasterTypePetiKemas::find($inbound->details['type_peti_kemas_id']);

            $inbound['ukuranPetiKemas'] = $ukuranPetiKemas;
            $inbound['typePetiKemas']   = $typePetiKemas;
        }

        Session(['bc_id' => 'bc20']);

        $bc11dokumen = DB::table('inbound_documents')->where('inbound_id', '=', $id)->where('document_id', '=', 104)->first();

        if ($bc11dokumen != null) {
            $bc11dokumens   = json_decode($bc11dokumen->details);
            $bc11files = DB::table('files')->where('fileable_id', '=', $bc11dokumen->id)->first();
        }

        $nomor_pengajuan = Inbound::find($id);
        $NomorPengajuan  = $nomor_pengajuan->request_number;
        $getgoodid = DB::table('inbound_details')->where('inbound_id', '=', $id)->get();
        $sizegetgood = sizeof($getgoodid);
        $arrayku = [];
        $datagoods = [];
        for ($i = 0; $i < $sizegetgood; $i++) {
            $getgood = DB::table('goods')->where('id', '=', $getgoodid[$i]->good_id)->first();
            $collectla = json_decode($getgood->details);
            $datagoods['inboundDetail_id'] = $getgoodid[$i]->id;
            $datagoods['quantity'] = $getgoodid[$i]->quantity;
            $datagoods['name'] = $getgood->name;
            $datagoods['kode_barang'] = $collectla->kode_barang;
            $datagoods['total_partial'] = 0;

            array_push($arrayku, $datagoods);
        }

       
        //$data_ports = InboundTransportationPort::getDataPorts($inbound->inboundTransportation->id);
        $data_ports = DB::table('inbound_transportation_ports')
        ->select(['ports.*', 'inbound_transportation_ports.type'])
        ->join('ports', 'ports.id', '=', 'inbound_transportation_ports.port_id')
        ->whereIn('inbound_transportation_ports.inbound_transportation_id', $inbound->inboundTransportation->pluck('id'))
        ->get();

        $muat = "";
        $transit = "";
        $bongkar = "";
        $tujuan = "";
        foreach ($data_ports as $row_ports) {
            if ($row_ports->type == "muat") {
                $muat = $row_ports;
            }
            if ($row_ports->type == "transit") {
                $transit = $row_ports;
            }
            if ($row_ports->type == "bongkar") {
                $bongkar = $row_ports;
            }
            if ($row_ports->type == "tujuan") {
                $tujuan = $row_ports;
            }
        }
        $inbound['muat']    = $muat;
        $inbound['transit'] = $transit;
        $inbound['bongkar'] = $bongkar;
        $inbound['tujuan']  = $tujuan;

        $inbound['country'] = DB::table('inbound_transportations')
            ->join('countries', 'countries.code', '=', 'inbound_transportations.country_code')
            ->where('inbound_id', '=', $id)->first();

        return $this->makeView("detail.detail", [
            "bc"                        => "BC20",
            "partialLink"               => '',
            'dokubc11'                  => $bc11dokumens ?? '',
            'bc11files'                 => $bc11files ?? '',
            "arrayku"                   => $arrayku,
            "kppbcSelectBox"            => MasterKppbc::all()->pluck("description", "id"),
            "jenisTpbSelectBox"         => MasterJenisTpb::all()->pluck("name", "id"),
            "importirSelectBox"         => getprofile('importir'),
            "pemilikBarangSelectBox"    => getprofile('pemilik-barang'),
            "penjualBarangSelectBox"    => getprofile('penjual-barang'),
            "pengirimBarangSelectBox"   => getprofile('pengirim-barang'),
            "ppjkSelectBox"             => getprofile('ppjk'),
            "pemusatanSelectBox"        => getprofile('pemusatan-barang'),
            "masterUkuranPetiKemas"     => MasterUkuranPetiKemas::all()->pluck("name", "id"),
            "masterTypePetiKemas"       => MasterTypePetiKemas::all()->pluck("name", "id"),
            "masterIncoterms"           => MasterIncoterm::all()->pluck("code", "id"),
            "packageSelectBox"          => MasterPackage::all()->pluck("name", "id"),
            "citySelectBox"             => City::all()->pluck("city", "id"),
            "documentSelectBox"         => MasterDocument::all()->pluck("code_name", "id"),
            "uoms"                      => MasterUom::all()->pluck("name", "id"),
            "containers"                => $helpercombo->getContainers(),
            "transportations"           => Transportation::whereIn("transport_line_id", [1, 2])->get()->pluck("name", "id"), // Transportasi Laut dan Udara
            "country"                   => Country::all()->pluck("name", "code"),
            "valas"                     => MasterValas::all()->pluck("name", "id"),
            "warehouses"                => Warehouse::all()->pluck("name", "id"),
            "tps"                       => MasterTPS::all()->pluck('name', 'id'),
            "masterPaymentType"         => MasterPaymentType::all()->pluck('name', 'id'),
            "masterImportType"          => MasterImportType::all()->pluck('name', 'id'),
            "inbound"                   => $inbound,
            "intangible_status"         => $inbound->intangible_status == 0 ? "" : "display:none;",
            "mainUrl"                   => $this->mainUrl,
            "canDone"                   => $inbound->status_id != 7,
            'idDone'                    => 7,
            "partialLink"               => '',
            'moduleNav'                 => 'airpib',
            "bankSelectBox"             => MasterBank::all()->pluck("name", "id"),
            "packageSelectBox"          => MasterPackage::all()->pluck("name", "id"),
            "uoms"                      => MasterUom::all()->pluck("name", "id"),
            'hsCodes'                   => HsCode::where('type', 'sub-pos-asean')->get()->map(function ($v) {
                return [
                    "id"                => $v->id,
                    "text"              => $v->code . " - " . $v->details['description_id']
                ];
            })->pluck('text', 'id')->prepend("-- Select -- ", ""),
            'jenisBarang'               => MasterTypeGoods::all()->pluck('name', 'name'),
            "masterIncoterms"           => MasterIncoterm::all()->pluck("code", "id"),
            'TradeTransactionTypes'     => $helpercombo->getTradeTransactionTypes(),
            'bmTypes'                   => $helpercombo->getBmTypes(),
            'JenisBarangTidakBerwujud'  => $helpercombo->getJenisBarangTidakBerwujud(),
            'taxTypes'                  => $helpercombo->getTaxTypes(), 
            'cukaiCommodity'            => $helpercombo->getCukaiCommodity(),
            'cukaiCommodityCode'        => $helpercombo->getCukaiCommodityCode(),
            'jenisPetiKemas'            => $helpercombo->getJenisPetiKemas(),
            'TutupPu'                   => $helpercombo->getTutupPu(),
            'kondisiBarang'             => $helpercombo->getKondisiBarang()
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $inbound = Inbound::find($id);
        // open upload file bc
       /* if ($request->hasFile('dokumen_bc')) {
            $file               = $request->file('dokumen_bc');
            $fileExt            = $request->file('dokumen_bc')->guessExtension();
            $fileName           = "IBN" . date('YmdHis') . "." . $fileExt;
            $destinationPath    = public_path() . '/upload_file';
            $file->move($destinationPath, $fileName);
            $request['dokumen_bc'] = $fileName;
        } else {
            unset($request->dokumen_bc);
        }*/
        // close upload file bc
        $update                     = $inbound->update($request->all()); 
       // $inboundPpjk              = true;
        $inboundKppbcPengawas       = $inbound->inboundKppbcPengawas()->update(["kppbc_id" => $request->kppbc_pengawas_id, "type" => "pengawas"]);

        $inboundImportir            = $inbound->inboundImportir()->update(["profile_id" => $request->importir_id, "type" => "importir"]);
        $inboundPemilikBarang       = $inbound->inboundPemilikBarang()->update(["profile_id" => $request->pemilik_barang_id, "type" => "pemilik-barang"]);
        if($inbound->intangible_status == 0){
            $inboundPengirimBarang      = $inbound->inboundPengirimBarang()->update(["profile_id" => $request->pengirim_barang_id, "type" => "pengirim-barang"]);
        }
        
        $inboundPenjualBarang       = $inbound->inboundPenjualBarang()->update(["profile_id" => $request->penjual_barang_id, "type" => "penjual-barang"]);
        $inboundPemusatanBarang     = $inbound->inboundPemusatanBarang()->update(["profile_id" => $request->pemusatan_barang_id, "type" => "pemusatan-barang"]);
       // if (isset($request->ppjk_id))
        $inboundPpjk                = $inbound->inboundPpjk()->update(["profile_id" => $request->ppjk_id, "type" => "ppjk"]);
        $inboundValas               = $inbound->inboundValas()->update(["valas_id" => $request->valas_id]);

        if($request->vehicle_number  == 0){
            $inboundTransportation      = $inbound->inboundTransportation()->update(["transportation_id" => $request->transportation_id, "vehicle_number" => $request->vehicle_number, "country_code" => $request->country_id]);
            $inboundTPS                 = $inbound->inboundTPS()->update(["master_tps_id" => $request->master_tps_id]);
        }

        $inboundTransportationLoadingPort   = true;
        $inboundTransportationTransitPort   = true;
        $inboundTransportationUnloadingPort = true;
        
        if ($request->loading_port_id != "") {
            $inboundTransportationLoadingPort = $inbound->inboundTransportation->loadingPort()->update([
                "port_id" => $request->loading_port_id,
                "type" => "muat"
            ]);
        }
        if ($request->transit_port_id != "") {
            $inboundTransportationTransitPort = $inbound->inboundTransportation->transitPort()->update([
                "port_id" => $request->transit_port_id,
                "type" => "transit"
            ]);
        }
        if ($request->unloading_port_id != "") {
            $inboundTransportationUnloadingPort = $inbound->inboundTransportation->unloadingPort()->update([
                "port_id" => $request->unloading_port_id,
                "type" => "bongkar"
            ]);
        }

        if (
            !$update || !$inboundKppbcPengawas || !$inboundPemilikBarang || !$inboundPenjualBarang || !$inboundPemusatanBarang || 
            !$inboundPpjk || !$inboundImportir || !$inboundTransportationLoadingPort || 
            !$inboundTransportationTransitPort || !$inboundTransportationUnloadingPort || !$inboundValas  
        ) {
            DB::rollBack();
            return redirect()->back()->with("error", "Failed to update the specified resource")->withInput();
        }

        DB::commit();

        // }

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }
    


    public function getDone($id)
    {
        $statusId = 7; // DONE
        $bc = 'bc20';
        return parent::inboundDone($id, $statusId, $bc);
    }

    public function getExcel($id) //formatByBC
    {
        $inbound = Inbound::with([

            'inboundDetails.good.uom',
            'inboundDetails.good',
            'inboundDetails.hsCode',
            'inboundDetails.package',
            'inboundDetails.ratePreference',
            'inboundDocuments.masterDocument',
            'inboundDocuments.file',
            'inboundJenisTpb.masterJenisTpb',
            'inboundKppbc.masterKppbc',
            'inboundPengirimBarang.profile',
            'inboundTpb.profile',
            'inboundTujuanPengiriman.masterTujuanPengiriman',
            'inboundTransportation.transportation'
        ])->find($id);

        return (new TemplateBC20Export($inbound))->download('BC20 - ' . date('Y-m-dHis') . '.xlsx');
    }

    public function export()
    {
        $query = Session::get('query');
        return Excel::download(new InboundBC20Export($query), 'BC20 - ' . date('Y-m-dHis') . '.xlsx');
    }

    public function getPdf($id)
    {
        $inbound = Inbound::with([
            'city',
            'inboundDetails.good',
            'inboundDetails.hsCode',
            'inboundDetails.package',
            'inboundDetails.ratePreference',
            'inboundDocuments.masterDocument',
            'inboundDocuments.file',
            'inboundKppbc.masterKppbc',
            'inboundPengirimBarang.profile',
            'inboundTpb.profile',
            'inboundTujuanPengiriman.masterTujuanPengiriman',
            'inboundTransportation.transportation',
            'inboundPackages.masterPackage',
            'inboundPetiKemas.masterTypePetiKemas'
        ])->find($id);

        //$tujuantpb = MasterJenisTpb::all();

        $htmlTujuanTPB  = "";
        $tujuanTPBBC    = 0;
           
       /* foreach ($tujuantpb as $key => $tpb) {
            if ($tpb->id == $inbound->inboundJenisTpb->masterJenisTpb->id) {
                $tujuanTPBBC = ($key + 1);
            }
            $htmlTujuanTPB .= ($key + 1) . ". " . $tpb->name . " ";
        }*/


        $country_id         = isset($inbound->inboundPpjk) ? $inbound->inboundPpjk->profile->country_id : '';
        $countryppjk        = Country::find($country_id);

        $country_transport  = $inbound->inboundTransportation->pluck('country_code');
        $countrytransport   = DB::table('countries')->where('code', '=', $country_transport)->first();

        $transport_id       = DB::table('inbound_transportations')->where('inbound_id', '=', $id)->first();

        $ports = DB::table('inbound_transportation_ports')->where('inbound_transportation_id', $transport_id->id)
            ->whereIn('type', ['tujuan', 'muat', 'transit', 'bongkar'])
            ->get()
            ->keyBy('type');

        $destinationport    = Port::find($ports['tujuan']->port_id ?? null);
        $loadingport        = Port::find($ports['muat']->port_id ?? null);
        $transitPort        = isset($ports['transit']) ? Port::find($ports['transit']->port_id) : null;
        $unloadingPort      = Port::find($ports['bongkar']->port_id ?? null);

        //$ukuranpeti         = MasterUkuranPetiKemas::find($inbound->details['ukuran_peti_kemas_id']);
        //$tipepeti           = MasterTypePetiKemas::find($inbound->details['type_peti_kemas_id']);

        $Taxtype = array();

        foreach ($inbound->inboundDetails as $key => $inboundDetail) {
            $arrayku = ['bm', 'ppn', 'ppnbm', 'pph'];
            foreach ($arrayku as $arrayku) {

                if ($inboundDetail->details[$arrayku] != 0) {

                    if ($inboundDetail->details[$arrayku . '_tax_type'] == '1') {
                        $Taxtype[$key][$arrayku . '_tax_type'] = "TG";
                    }
                    if ($inboundDetail->details[$arrayku . '_tax_type'] == '5') {
                        $Taxtype[$key][$arrayku . '_tax_type'] = "BBS";
                    }
                    if ($inboundDetail->details[$arrayku . '_tax_type'] == '6') {
                        $Taxtype[$key][$arrayku . '_tax_type'] = "TDP";
                    }
                }
            }
        }   

        $kontainerData = [];
        $jenisMapping = [
            4 => 'EMPTY',
            7 => 'LCL',
            8 => 'FCL'
        ];
  
        foreach ($inbound->inboundPetiKemas as $item) {
            $ukuranPetiKemas = MasterUkuranPetiKemas::find($item->details['ukuran_peti_kemas_id'])->code ?? '';
            $status = $item->details['jenis_peti_kemas'] ?? null;
            $jenisPetiKemas = $jenisMapping[$status] ?? '';
 
            $kontainerData[] = [
                'nomor_peti_kemas' => $item->details['nomor_peti_kemas'] ?? '',
                'ukuran_peti_kemas' => $ukuranPetiKemas,
                'jenis_peti_kemas' => $jenisPetiKemas
            ];
        }
        
        $pdf = view('exports.bc20.pdf', compact('inbound', 'kontainerData','countryppjk', 'countrytransport', 'loadingport', 'transitPort','destinationport', 'unloadingPort', 'Taxtype', 'htmlTujuanTPB', 'tujuanTPBBC'));

        return $pdf;
    }


    //public function postSend($id,$status)
    public function postSend(Request $request)
    {     

        $status = $request->status;
        $helper = new GeneralHelper();
        foreach($request->inbound_id as $key=>$id){

            $inboundData = Inbound::with([
                'inboundDetails.good',
                'inboundDetails.hsCode',
                'inboundDetails.ratePreference',
                'inboundDocuments',
                'inboundDocuments.file',
                'inboundJenisTpb',
                'inboundKppbcPengawas',
                'inboundPengirimBarang.profile',
                'inboundTpb.profile',
                'inboundTujuanPengiriman',
                'inboundTransportation.transportation',
                'inboundTransportation.loadingPort',
                'inboundValas.masterValas',
                'inboundWarehouse.warehouse'
            ])->find($id); 

            if (!$inboundData) {
                return response()->json(['error' => 'Data tidak ditemukan'], 404);
            }

            $nomorAju   = str_replace("-", "", $inboundData->request_number);
            $Aju        = substr($nomorAju, 0, 26); 
            
            $bc11dokumen = InboundDocument::where('inbound_id', '=', $id)->where('document_id', '=', 104)->first();
        
            if ($bc11dokumen != null) { 
                $bc11dokumens = is_string($bc11dokumen->details) ? json_decode($bc11dokumen->details, true) : $bc11dokumen->details;

            }  
            $transportData = InboundTransportation::where('inbound_id', $id)->first();
            
            if ($transportData) {

                $data_ports = DB::table('inbound_transportation_ports')
                ->join('ports', 'ports.id', '=', 'inbound_transportation_ports.port_id')
                ->where('inbound_transportation_ports.inbound_transportation_id', '=', $transportData->id)
                ->get();
    
                $muat = ""; $transit = ""; $bongkar = ""; $tujuan = "";
                
                foreach ($data_ports as $row_ports) {
                    if ($row_ports->type == "muat") {
                        $muat = $row_ports->code;
                    }
                    if ($row_ports->type == "transit") {
                        $transit = $row_ports->code;
                    }
                    if ($row_ports->type == "bongkar") {
                        $bongkar = $row_ports->code;
                    }
                    if ($row_ports->type == "tujuan") {
                        $tujuan = $row_ports->code;
                    }
                }

                $destinationport = isset($tujuan) ? $tujuan : null;
                $loadingport     = isset($muat) ? $muat : null;
                $transitPort     = isset($transit) ? $transit : null; 
                
            } 
            //barang & barang tarif
                $inboundDetails = $inboundData->inboundDetails;
                $jumlahbar = 0;
                $jumlahkem = 0;

                foreach ($inboundDetails as $barang) {
                    $jumlahbar += $barang->quantity;
                    $jumlahkem += $barang->package_details['jumlah'];
                }
                
                $seribarang = 1;
                $payload_detailbarang = [];  
                
                foreach ($inboundDetails as $item) {
                    
                    $hs_codes = Hscode::where('id', '=', $item->hs_code_id)->first();
                    
                    $status_lantas = "T"; // Set nilai default
                    
                    if ($hs_codes) {
                        $hs_code_details = is_string($hs_codes->details) ? json_decode($hs_codes->details, true) : $hs_codes->details;
                        
                        if (isset($hs_code_details->status_lantas)) {
                            $status_lantas = $hs_code_details->status_lantas == 0 ? "T" :"Y" ;
                        }
                    }
                
                    
                    $barangTarif = []; // Initialize the array to store tariff details
                    $arrayku     = ['bm', 'ppn', 'ppnbm', 'pph'];
                
                    foreach ($arrayku as $taxType) {
                        $KodeFasilitas = 0;
                        $kodeJenisTarif = 0;
                        $jenistarif = '';
                        $tarif = 0;
                        $tarif_fasi = 0;
                
                        // Determine the KodeFasilitas based on tax type
                        if ($item->details[$taxType . '_tax_type'] == '0') {
                            $KodeFasilitas = 1;
                        } elseif ($item->details[$taxType . '_tax_type'] == '1') {
                            $KodeFasilitas = 2;
                        } elseif ($item->details[$taxType . '_tax_type'] == '5') {
                            $KodeFasilitas = 4;
                        } elseif ($item->details[$taxType . '_tax_type'] == '6') {
                            $KodeFasilitas = 5;
                        }
                        
                        // Switch-case for tax types
                        // Daftar jenis tarif dan properti yang sesuai
                        $tarifProperties = [
                            'bm'    => ['BM', $item->details['bm'], $item->details['bm_tax_value'], $item->details['bm_tax_type']],
                            'bmt'   => ['BMT', $item->details['bmt'], $item->details['bmt_tax_value'], $item->details['bmt_tax_type']],
                            'ppn'   => ['PPN', $item->details['ppn'], $item->details['ppn_tax_value'], $item->details['ppn_tax_type']],
                            'ppnbm' => ['PPNBM', $item->details['ppnbm'], $item->details['ppnbm_tax_value'], $item->details['ppnbm_tax_type']],
                            'pph'   => ['PPH', $item->details['pph'], $item->details['pph_tax_value'], $item->details['pph_tax_type']],
                            'cukai' => ['CUKAI', $item->details['cukai_jumlah'], $item->details['cukai_besar_tarif'], $item->details['cukai_nilai']],
                        ];
                        // Set nilai default
                        
                        $jenistarif = 'N';
                        $tarif = $tarif_fasi = $kodeJenisTarif = null;
                        
                        
                        // Periksa apakah $taxType ada dalam daftar
                        if (array_key_exists($taxType, $tarifProperties)) {
                            list($jenistarif, $tarif, $tarif_fasi, $kodeJenisTarif) = $tarifProperties[$taxType];
                        }

                        $barangTarif[] = [
                            "jumlahSatuan"        => floatval($item->quantity?? 0),
                            "kodeFasilitasTarif"  => (string)($KodeFasilitas),
                            "kodeJenisPungutan"   => $jenistarif,
                            "kodeJenisTarif"      => $kodeJenisTarif,
                            "nilaiBayar"          => 0,
                            "nilaiFasilitas"      => 0,
                            "seriBarang"          => $seribarang,
                            "tarif"               => floatval($tarif?? 0),
                            "tarifFasilitas"      => floatval($tarif_fasi?? 0),
                        ]; 
                    }
                    $datadetail = [
                        "barangDokumen" => [
                            ["seriDokumen" => "1"]
                        ],
                        "barangTarif" => $barangTarif,
                        "barangVd" => 
                            ["kodeJenisVd" => (string)("NTR"), "nilaiBarangVd" => 0.0001] ,
                        "barangSpekKhusus" => [
                        ],
                        "barangPemilik" => [
                        ]       
                    ];
                    
                    $kodeKondisiBarang      =1;
                    $kodeNegaraAsal         ="SG";
                    if($inboundData->intangible_status == 1){ //barangTidakBersujud
                        $payloadWujudBarangDetail = [
                            "kodeAsalBahanBaku "    =>(string)($item->details['kodeAsalBahanBaku'] ?? ""),
                            "kodeJenisNilai  "      => (string)($item->details['kodeJenisNilai'] ?? ""),
                            "spesifikasiLain  "     => (string)($item->details['spesifikasiLain'] ?? ""),
                        ]; 
                    }else{
                        $payloadWujudBarangDetail = [ //barangBersujud
                            "bruto"               => floatval($item->nett_weight ?? 0),
                            "hargaPatokan"        => 0,
                            "hjeCukai"            => floatval($item->details['harga_satuan'] ?? 0),
                            "jumlahBahanBaku"     => 0,
                            "jumlahDilekatkan"    => 0,
                            "jumlahKemasan"       => floatval($barang->package_details['jumlah'] ?? 0),
                            "jumlahPitaCukai"     => 0,
                            "jumlahRealisasi"     => 0,
                            "kapasitasSilinder"   => 0,
                            "kodeJenisKemasan"    => (string)($item->package->code ?? 0),
                            "kodeKondisiBarang"   => (string)($kodeKondisiBarang),
                            "netto"               => floatval($item->nett_weight ?? 0),
                            "nilaiDanaSawit"      => 0,
                            "nilaiDevisa"         => 0,
                            "pernyataanLartas"    => (string)($status_lantas ?? 'T'),
                            "persentaseImpor"     => 0,
                            "saldoAkhir"          => 0,
                            "saldoAwal"           => 0,
                            "seriBarangDokAsal"   => 0,
                            "seriIjin"            => 0,
                            "tahunPembuatan"      => 0,
                            "tarifCukai"          => 0,
                            "volume"              => floatval($item->volume ?? 0), 
                        ]; 
                    }

                    $payload_detailbarang[] = array_merge([
                        "asuransi"            => floatval($item->details['asuransi'] ?? 0),
                        "bruto"               => floatval($item->nett_weight ?? 0),
                        "cif"                 => floatval($item->details['nilai_cif'] ?? 0),
                        "cifRupiah"           => floatval($item->details['cif_rp'] ?? 0),
                        "diskon"              => floatval($item->details['biaya_pengurang'] ?? 0),
                        "fob"                 => floatval($item->details['fob'] ?? 0),
                        "freight"             => floatval($item->details['freight'] ?? 0),
                        "hargaEkspor"         => 0,
                        "hargaPenyerahan"     => 0,
                        "hargaPerolehan"      => 0,
                        "hargaSatuan"         => floatval($item->details['harga_satuan'] ?? 0),
                        "isiPerKemasan"       => floatval($item->isiPerKemasan ?? 0),
                        "jumlahSatuan"        => floatval($item->quantity ?? 0),
                        "kodeNegaraAsal"      => (string)($kodeNegaraAsal ?? "SG"),
                        "kodeSatuanBarang"    => (string)($item->package->code ?? 0),
                        "merk"                => (string)($item->details['merk'] ?? 0),
                        "ndpbm"               => $item->details['ndpbm'] ?? 0,
                        "nilaiBarang"         => floatval($item->nilaiBarang ?? 0),
                        "nilaiTambah"         => floatval($item->details['biaya_penambah'] ?? 0),
                        "posTarif"            => (string)($hs_codes->code ?? 0),
                        "seriBarang"          => $seribarang ?? 0,
                        "tipe"                => (string)($item->details['type'] ?? 0),
                        "uraian"              => (string)($item->details['uraian'] ?? 0),
                    ], $payloadWujudBarangDetail, [
                        "barangTarif"         => $barangTarif,
                        "barangVd"            => [],
                        "barangDokumen"       => [],
                        "barangSpekKhusus"    => [], 
                        "barangPemilik"       => []   
                    ]);
                
                    $seribarang++;
                }
                /* "barangDokumen"       => [["seriDokumen" => "1"]], "barangTarif"         => $barangTarif, "barangVd"            =>  ["kodeJenisVd" => (string)("NTR"), "nilaiBarangVd" => 0.0001],*/  
            //End barang & barang tarif

            //Star entitas
                $entitasData = $inboundData->inboundProfile;
                // Define a mapping for type to kodeEntitas and namaEntitas
                $typeMapping = [
                    "importir"          => ["kode" => 1, "nama" => "IMPORTIR"],
                    "pemilik-barang"    => ["kode" => 7, "nama" => "PEMILIK"],
                    "pengirim-barang"   => ["kode" => 9, "nama" => "PENGIRIM"],
                    "penjual-barang"    => ["kode" => 10, "nama" => "PENJUAL"],
                    "pemusatan-barang"  => ["kode" => 11, "nama" => "PEMUSATAN"],
                    "ppjk"              => ["kode" => 4, "nama" => "PPJK"],
                ];

                $entitas = []; 
                $entitasNo = 1;
                foreach ($entitasData as $item) {
                    // Initialize entitasItem array
                    $entitasItem = [];

                    // Use the mapping for kodeEntitas and namaEntitas if the type is available
                    if (isset($item->type) && array_key_exists($item->type, $typeMapping)) {
                        $entitasItem["kodeEntitas"] = (string)($typeMapping[$item->type]['kode']);
                        $entitasItem["namaEntitas"] = $typeMapping[$item->type]['nama'];
                    } 
                    // Add other fields only if they are set
                    if (isset($item->profile->address) ) {
                        $entitasItem["alamatEntitas"] = $item->profile->address;
                    }

                    if (isset($item->profile->address) && ($item->type =="penjual-barang" || $item->type =="pengirim-barang")) {
                        $entitasItem["kodeNegara"] = "SG";//$item->profile->country->code;
                    }
                    
                    if (isset($item->profile->details['tipe_api']) && $item->type =="importir") {
                        $entitasItem["kodeJenisApi"] = "01";//item->profile->details['tipe_api'];
                        $entitasItem["kodeStatus"]   = "AEO";
                    }
                    if (isset($item->profile->details['tipe_identitas'])) {
                        if($item->profile->details['tipe_identitas'] == "npwp-12-digit" || $item->profile->details['tipe_identitas'] == 0){
                            $kodeJenisIdentitas =0;
                        }else if($item->profile->details['tipe_identitas'] == "npwp-10-digit" || $item->profile->details['tipe_identitas'] == 1){
                            $kodeJenisIdentitas =1;
                        }else if($item->profile->details['tipe_identitas'] == "paspor" || $item->profile->details['tipe_identitas'] == 2){
                            $kodeJenisIdentitas =2;    
                        }else if($item->profile->details['tipe_identitas'] == "ktp" || $item->profile->details['tipe_identitas'] == 3){
                            $kodeJenisIdentitas =3;        
                        }else if($item->profile->details['tipe_identitas'] == "lainnya" || $item->profile->details['tipe_identitas'] == 4){
                            $kodeJenisIdentitas =4;
                        }else{//npwp-15-digit
                            $kodeJenisIdentitas =5;
                        }
                        $entitasItem["kodeJenisIdentitas"] = (string)(5);
                        
                    }
                    if (isset($item->profile->kodeStatus)) {
                        $entitasItem["kodeStatus"] = $item->profile->kodeStatus;
                    }
                    if (isset($item->profile->details['niper'])) {
                        $entitasItem["nibEntitas"] = $item->profile->details['niper'];
                    }
                    if (isset($item->profile->details['nomor_identitas'])) {
                        $entitasItem["nomorIdentitas"] = $item->profile->details['nomor_identitas'];
                    }
                    
                    $entitasItem["seriEntitas"] = $entitasNo;
                    $entitasNo ++;
                    // Add entitasItem to entitas array
                    $entitas[] = $entitasItem;
                }
            //End entitas

            //Star Kemasan    
                $kemasanData = $inboundData->inboundPackaging;
                $kemasan = [];

                foreach ($kemasanData as $item) {
                    $kemasan[] = [
                        "jumlahKemasan"     => floatval($item->details['jumlah_kemasan'] ?? 0),
                        "kodeJenisKemasan"  => $item->masterPackage->code,
                        "merkKemasan"       => $item->details['merek'],
                        "seriKemasan"       => $item->no_seri,
                    ];
                }

            //End Kemasan

            //Star kontainer
                $kontainerData = $inboundData->inboundPetiKemas;
                $kontainer = [];

                foreach ($kontainerData as $item) {
                    $ukuranPetiKemas    = MasterUkuranPetiKemas::find($item->details['ukuran_peti_kemas_id']);
                    $kontainer[] = [
                        "kodeJenisKontainer"    => $item->details['jenis_peti_kemas'],
                        "kodeTipeKontainer"     => (string)($item->masterTypePetiKemas->id),
                        "kodeUkuranKontainer"   => (string)($ukuranPetiKemas->code), //[20, 40, 45, 60]
                        "nomorKontainer"        => $item->details['nomor_peti_kemas'],
                        "seriKontainer"         => $item->no_seri,
                    ];
                }
            //End kontainer
            
            //Star dokumen
                $dokumenData = $inboundData->inboundDocuments;
                $item380 = null;
                $item705or740 = null;
                $remainingItems = [];

                foreach ($dokumenData as $item) {
                    if ($item->masterDocument->code == 380 && is_null($item380)) {
                        $item380 = $item; // Menyimpan item dengan code 380
                    } elseif (($item->masterDocument->code == 705 || $item->masterDocument->code == 740) && is_null($item705or740)) {
                        $item705or740 = $item; // Menyimpan item pertama dengan code 705 atau 740
                    } else {
                        $remainingItems[] = $item; // Menyimpan sisanya
                    }
                } 
                // Menggabungkan item berdasarkan urutan yang diinginkan
                $dokumens = [];
                $dokumen = [];
                if (!is_null($item380)) {
                    $dokumens[] = $item380;
                }
                if (!is_null($item705or740)) {
                    $dokumens[] = $item705or740;
                }
                $dokumens = array_merge($dokumens, $remainingItems);

                // Proses untuk mengubah item menjadi format yang diinginkan
                foreach ($dokumens as $item) {
                    $dokumen[] = [
                        "idDokumen"      => (string)($item->masterDocument->id),
                        "kodeDokumen"    => $item->masterDocument->code,
                        "kodeFasilitas"  => "", // Sesuaikan sesuai kebutuhan
                        "nomorDokumen"   => $item->details['nomor_dokumen'],
                        "seriDokumen"    => $item->seri_document,
                        "tanggalDokumen" => $item->details['date'], // Assuming it's a Carbon instance
                    ];
                }
            //End dokumen 
            //Star pengangkut 
            $pengangkut[] = [
                "kodeBendera"       => $inboundData->inboundTransportation->first()->country_code,
                "namaPengangkut"    => (string)($inboundData->inboundTransportation->first()->id),
                "nomorPengangkut"   => $inboundData->inboundTransportation->first()->vehicle_number,
                "kodeCaraAngkut"    => (string)($inboundData->inboundTransportation->first()->transportation_id),
                "seriPengangkut"    => 1,
            ];
            
            //End pengangkut
            $isFinal     = false;
            $status_id   = 12;
            if($inboundData->status_id== 11 && $status == 0){
                $isFinal = false;
                $status_id   = 12;
            }else if($inboundData->status_id== 12 && $status == 1){
                $isFinal     = true;
                $status_id   = 15;

            }
            //Star Payload 
                if($inboundData->intangible_status == 1){ //barangTidakBersujud
                    $payloadWujudBarangHeader = [
                        "flagBarangTidakBerwujud"    => "Y",
                    ]; 
                }else{ 
                    $payloadWujudBarangHeader = [ //barangBersujud
                        "bruto"              => floatval($inboundData->details['berat_kotor'] ?? 0),
                        "disclaimer"         => (string)("1"),
                        "flagVd"             => (string)("T"),
                        "fob"                => floatval($inboundData->details['fob'] ?? 0),
                        "idPengguna"         => $inboundData->details['pabean_pemberitahu'] ?? "",
                        "jumlahTandaPengaman"=> count($inboundData->inboundPackaging) ?? 0,
                        "kodePelMuat"        => (string)($loadingport ?? ""),
                        "kodeTps"            => (string)($inboundData->inboundTPS->masterTPS->code_warehouse ?? ""),
                        "kodeTutupPu"        => (string)($inboundData->kodeTutupPu ?? "11"),
                        "nilaiIncoterm"      => floatval($inboundData->details['nilai_cif'] ?? 0),
                        "nilaiMaklon"        => 0,
                        "nomorBc11"          => $bc11dokumens['nomor_dokumen'] ?? "0",
                        "posBc11"            => $bc11dokumens['nomor_pos_dokumen'] ?? "0",
                        "subPosBc11"         => $bc11dokumens['nomor_sub_pos_dokumen'] ?? "00000000",
                        "tanggalAju"         => $inboundData->details['tanggal_pendaftaran'] ?? null,
                        "tanggalBc11"        => $bc11dokumens['date'] ?? null,
                        "tanggalTiba"        => $inboundData->details['estimated_arrival_date'] ?? date("Y-m-d"),
                        "totalDanaSawit"     => 0,
                        "volume"             => 0,
                        "vd"                 => 0,
                    ]; 

                    $payloadWujudBarangHeaderKemasan= [ //barangBersujud
                        "kemasan"              => $kemasan,
                    ];

                    $payloadWujudBarangHeaderkontainer= [ //barangBersujud
                        "kontainer"              => $kontainer,
                    ];
                    $payloadWujudBarangHeaderpengangkut= [ //barangBersujud
                        "pengangkut"              => $pengangkut,
                    ];
                } 
                $dataToSendBase  = 
                        array_merge([
                        "isFinal"            => $isFinal,
                        "asalData"           => (string)("S"),
                        "asuransi"           => floatval($inboundData->details['asuransi'] ?? 0),
                        "biayaPengurang"     => floatval($inboundData->details['biaya_pengurang'] ?? 0),
                        "biayaTambahan"      => floatval($inboundData->details['biaya_penambah'] ?? 0),
                        "cif"                => floatval($inboundData->details['nilai_cif'] ?? 0),
                        "freight"            => floatval($inboundData->details['freight'] ?? 0),
                        "hargaPenyerahan"    => 0,
                        "jabatanTtd"         => $inboundData->details['pabean_jabatan'] ?? "",
                        "jumlahKontainer"    => count($inboundData->inboundPetiKemas) ?? 0,
                        "kodeAsuransi"       => (string)("LN"),
                        "kodeCaraBayar"      => (string)($inboundData->payment_type_id ?? 0),
                        "kodeDokumen"        => (string)("20"),
                        "kodeIncoterm"       => (string)(""),
                        "kodeJenisImpor"     => (string)($inboundData->import_type_id ?? ""),
                        "kodeJenisNilai"     => "KMD",
                        "kodeJenisProsedur"  => (string)($inboundData->kodeJenisProsedur ?? "1"),
                        "kodeKantor"         => (string)($inboundData->inboundKppbcPengawas->masterKppbc->code ?? ""),
                        "kodePelTransit"     => (string)($transitPort ?? ""),
                        "kodePelTujuan"      => (string)($destinationport ?? ""),
                        "kodeValuta"         => (string)($inboundData->inboundValas->masterValas->code ?? ""),
                        "kotaTtd"            => (string)($inboundData->city->city ?? ""),
                        "namaTtd"            => $inboundData->details['pabean_pemberitahu'] ?? "",
                        "ndpbm"              => floatval($inboundData->details['ndpbm'] ?? 0),
                        "netto"              => $inboundData->nett_weight ?? 0,
                        "nilaiBarang"        => floatval($inboundData->details['cif_rp'] ?? 0),
                        "nomorAju"           => $Aju ?? "",
                        "seri"               => $bc11dokumens->seri ?? 0,                
                        "tanggalTtd"         => $inboundData->details['pabean_tanggal'] ?? "0",
                    ], $payloadWujudBarangHeader 
                );

                $dataToSend = array_merge(
                    $dataToSendBase,
                    ["barang" => $payload_detailbarang],
                    ["entitas" => $entitas],
                    $payloadWujudBarangHeaderKemasan,
                    $payloadWujudBarangHeaderkontainer,
                    ["dokumen" => $dokumen],
                    $payloadWujudBarangHeaderpengangkut
                );
            //End Payload  country_code
            //print_r(json_encode($dataToSend)); die();
            $endpoint = "/openapi/document";  
            $response =  $helper->makeRequest($endpoint, 'POST', $dataToSend);
        // dd($response); 
            if (isset($resultReponse['original'])) { 
                $results[] = [
                    'status'    => 'error',
                    'no_aju'    => $Aju, 
                    'message'   => $resultReponse['original']['error']
                ];
            
            } else  if (isset($response['status']) && $response['status'] == "OK") { 

                $results[] = [
                    'status'    => 'success',
                    'no_aju'    => $Aju, 
                    'message'   => $response['message'],
                    'idHeader'  => $response['idHeader']
                ];
            
            } 
        }   
        
        return response()->json($results);
        
    }


    public function uploadInboundDetailGood(UploadRequest $request)
    {
        if (isset($request->type) && $request->type == 'add') {
            $results = [];
            $goods = Excel::toArray(new InboundDetails('', ''), $request->file('file'))[0];

            foreach ($goods as $good) {
                // Pengecekan untuk hs_code
                $hs_code = HsCode::where('code', $good['hs_code'])->first();
                $hs_code_id = $hs_code ? $hs_code->id : null;

                // Pengecekan untuk uom_id
                $uom = MasterUom::where('code', $good['kode_satuan'])->first();
                $uom_id = $uom ? $uom->id : null;

                // Pengecekan untuk package_id
                $package = MasterPackage::where('code', $good['kode_kemasan'])->first();
                $package_id = $package ? $package->id : null;

                $results[] = [
                    'good_id' => '',
                    'hs_code_id' => $hs_code_id,
                    'lartas' => $good['lartas'] ?? 0,
                    'details' => [
                        'kode_barang' => $good['kode_barang'],
                        'uraian' => $good['uraian'],
                        'spesifikasi_lain' => $good['spesifikasi_lain'],
                        'merk' => $good['merek'],
                        'type' => $good['tipe'],
                        'ukuran' => $good['ukuran'],
                        'item_country' => $good['kode_negara_asal'],
                        'item_place_of_origin' => '',
                        'uom_id' => $uom_id,
                        'fob' => $good['amount'] ?? 0,
                        'volume' => $good['volume'],
                        'netto' => $good['netto'],
                        'fob_unit' => '',
                        'entitas_barang_id' => '',
                    ],
                    'name' => $good['nama_barang'],
                    'good_documents' => [],
                    'quantity' => $good['jumlah_satuan'],
                    'package_details' => [
                        'jumlah' => $good['jumlah_kemasan']
                    ],
                    'package_id' => $package_id
                ];
            }

            return response()->json([
                'status' => 'success',
                'data' => $results
            ]);
        } else {
            try {
                $file = $request->file('file');
                $filePath = $file->store('public/uploads/pib');
                $idInbound = $request->id_inbound;
                $userId = auth()->user()->id;

                ProcessInboundDetailsJob::dispatch($filePath, $idInbound, $userId);

                return back()->with('success', 'File upload berhasil dan sedang diproses.');
            } catch (Throwable $e) {
                Log::error($e->getMessage());
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }


    public function uploadAll(UploadRequest $request)
    {
        try {
            $file = $request->file('file');
            // Simpan file di folder 'upload-sheet' dan dapatkan path lengkap
            $filePath = $file->move(public_path('upload-sheet'), $file->getClientOriginalName());
            //$filePath       = $file->store('public/uploads/pib-all-sheet');
            // Hanya kirim path-nya sebagai string
            $filePath = 'upload-sheet' . DIRECTORY_SEPARATOR . $file->getClientOriginalName();

            $userId = auth()->user()->id;            
            $helper = new GeneralHelper(); 
            $nomorPengajuan = $helper->generateRequestNumber(1, 20);
            $bc = 20;

            // Dispatch job dengan filePath sebagai string
            ProcessFormBCJob::dispatch($filePath, $bc, $nomorPengajuan, $userId);

            return back()->with('success', 'File upload berhasil dan sedang diproses.');
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    /*
     public function uploadInboundDetailGood(UploadRequest $request)
    {
        // Validasi file dilakukan oleh UploadRequest
        $idInbound = $request->id_inbound;
        $this->importService->importInboundDetails($request->file('file'),$idInbound);

        return back()->with('success', 'Inbound details imported successfully.');
    }
    */

    public function getStatus($nomorAju)
    { 
        $helper = new GeneralHelper();
        return $helper->getStatusBc($nomorAju); 
    } 

    public function getKurs($kodeValuta)
    { 
        $helper = new GeneralHelper();
        return  $helper->getKurs($kodeValuta);  
    } 

    public function getLartas($hscode)
    { 
        $helper = new GeneralHelper();
        return $helper->getLartas($hscode); 
    } 

    public function getTarif($hscode)
    { 
        $date = date("Y-m-d");
        $helper = new GeneralHelper();
        return $helper->getTarifHscode($hscode,$date); 
    }
    
    /*public function getBCSatuSatu(Request $request)
    {
        print_r($request->All()); die();
        $params = (object) [
            'kodeKantor'    => $request->input('kodeKantor'),
            'namaImportir'  => $request->input('namaImportir'),
            'noHostBl'      => $request->input('nomor_dokumen'),
            'tglHostBl'     => $request->input('tanggal_dokumen')
        ];

        $helper = new GeneralHelper();
        return $helper->getBc11($params);
    }*/

    public function getBcSatuSatu(Request $request)
    { 
        
        $tanggalDokumen = $request->input('tanggal_dokumen');
        
        //$formattedDate = Carbon::createFromFormat('Y-m-d', $tanggalDokumen)->format('d-m-Y');
        
        $params = (object) [
            'kodeKantor'    => $request->input('kodeKantor'),
            'namaImportir'  => $request->input('namaImportir'),
            'noHostBl'      => $request->input('nomor_dokumen'),
            'tglHostBl'     => $tanggalDokumen 
        ]; 
        
        $helper = new GeneralHelper();
        $response = $helper->getBc11($params);
        
        if ($response['status'] == 'Success') {
            return response()->json([
                'status' => 'Success',
                'data' => $response['data']  
            ]);
        } else {
            return response()->json([
                'status' => 'Error',
                'error' => $response['message'] 
            ], 500);
        }
    }

    public function getTarifhs($hscode)
    {
        $helper = new GeneralHelper();
        $result = $helper->getCombinedData($hscode);

        if ($result['status'] == 'Success') {
            return response()->json($result);
        } else {
            return response()->json(['error' => $result['message']], 404);
        }
    } 
  
}
