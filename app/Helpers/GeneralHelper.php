<?php

namespace App\Helpers;
use Carbon\Carbon;
use App\Models\Inbound;
use App\Models\InboundProfile;
use App\Models\InboundTransportation;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log; 
use Illuminate\Http\Client\Response;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\MasterFasilitas;
use DB;

class GeneralHelper
{
    
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => rtrim(env('API_CIESA_URL'), '/') . '/',
        ]);
        
    }

    public function getTokenFromSession()
    {
        return Session::get('beacukai_token', null);
    }

    public function refreshTokenFromSession()
    {
        return Session::get('beacukai_refresh_token', null);
    }

    public function storeTokenInSession($tokenData)
    {
        Session::put('beacukai_token', $tokenData['access_token']);
        Session::put('beacukai_refresh_token', $tokenData['refresh_token']); 
        Session::put('beacukai_token_expires_in', time() + $tokenData['expires_in']);
    }

    public function isTokenExpired()
    {
        $expiresIn = Session::get('beacukai_token_expires_in', 0);
        return time() > $expiresIn;
    }

    public function getToken()
    {
        $url = env('API_CIESA_URL') . '/nle-oauth/v1/user/login';
        $headers = [
            'Content-Type' => 'application/json'
        ];

        $body = [
            'username' => env('API_CIESA_USERNAME'),
            'password' => env('API_CIESA_PASSWORD')
        ];

        try {
            $response = Http::withoutVerifying()
                ->withHeaders($headers)
                ->post($url, $body);

            if ($response->successful()) {
                $data = $response->json(); 
                return $data;
            } else { 
                return response()->json(['error' => 'Invalid response from API'], $response->status());
            }
        } catch (\Throwable $e) { 
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getTokenDev()
    {
        $url = env('API_CIESA_URL') . '/nle-oauth/v1/user/login';
        $headers = [
            'Content-Type' => 'application/json'
        ];

        $body = [
            'username' => env('DEVAPI_CIESA_USERNAME'),
            'password' => env('DEVAPI_CIESA_PASSWORD')
        ];

        try {
            $response = Http::withoutVerifying()
                ->withHeaders($headers)
                ->post($url, $body);

            if ($response->successful()) {
                $data = $response->json(); 
                return $data;
            } else { 
                return response()->json(['error' => 'Invalid response from API'], $response->status());
            }
        } catch (\Throwable $e) { 
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function refreshToken()
    {
        $refreshToken = $this->refreshTokenFromSession();
        if (!$refreshToken) {
            return $this->getToken(); 
        }
        $url = env('API_CIESA_URL') . '/auth-amws/v1/user/update-token';
        
        try {
            $response = Http::withoutVerifying()
                            ->withHeaders([
                                'Authorization' => $refreshToken,
                                'Content-Type' => 'application/json',
                            ])
                            ->post($url);

            if ($response->successful()) {
                $data = $response->json();
                $this->storeTokenInSession($data);

                return $data['access_token'];
            } else { 
                Log::error('Invalid response from API: ' . $response->body());
                return response()->json(['error' => 'Invalid response from API'], $response->status());
            }
        } catch (\Throwable $e) { 
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    } 
 

    public function refreshTokenDev()
    {
        $refreshToken = $this->refreshTokenFromSession();
        if (!$refreshToken) {
            return $this->getTokenDev(); 
        }
        $url = env('API_CIESA_URL') . '/auth-amws/v1/user/update-token';
        
        try {
            $response = Http::withoutVerifying()
                            ->withHeaders([
                                'Authorization' => $refreshToken,
                                'Content-Type' => 'application/json',
                            ])
                            ->post($url);

            if ($response->successful()) {
                $data = $response->json();
                $this->storeTokenInSession($data);

                return $data['access_token'];
            } else { 
                Log::error('Invalid response from API: ' . $response->body());
                return response()->json(['error' => 'Invalid response from API'], $response->status());
            }
        } catch (\Throwable $e) { 
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    } 
 
    protected function retryRequest($method, $url, $options)
    {
        $response = Http::withHeaders($options['headers'])
                        ->withOptions(['verify' => false]) 
                        ->bodyFormat('json')
                        ->send($method, $url, $options);

        return $response->successful() ? $response->json() : null;
    }

    public function makeRequest($endpoint, $method = 'GET', $data = [])
    {
        $endpoint       = env('API_CIESA_URL'). $endpoint;
        $tokenData      = !$this->isTokenExpired() ? $this->getTokenFromSession() : $this->refreshToken();
        $accessToken    = $tokenData['item']['access_token'];
        $headers        = [
                            'Authorization' => 'Bearer ' . $accessToken,
                            'Accept' => 'application/json',
                          ];

        try { 
            $httpClient = Http::withHeaders($headers)
                            ->withOptions(['verify' => false]); 
 
            if (strtolower($method) === 'post') {
                $response = $httpClient->post($endpoint, $data);
            } else { 
                $response = $httpClient->get($endpoint);
            }
 
            if ($response->successful()) {
                return $response->json();
            } else { 
                Log::error('Response error: ' . $response->body());
                Log::error('Status code: ' . $response->status());
                Log::error('Headers sent: ' . json_encode($headers));
                Log::error('Request endpoint: ' . $endpoint);
                return response()->json(['error' => 'Failed to make request: ' . $response->body()], $response->status());
            }
        } catch (\Exception $e) { 
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function makeDevRequest($endpoint, $method = 'GET', $data = [])
    {
        $endpoint       = env('DEVAPI_CIESA_URL'). $endpoint;
        $tokenData      = !$this->isTokenExpired() ? $this->getTokenFromSession() : $this->refreshTokenDev();
        $accessToken    = $tokenData['item']['access_token'];
        $headers        = [
                            'Authorization' => 'Bearer ' . $accessToken,
                            'Accept' => 'application/json',
                          ];

        try { 
            $httpClient = Http::withHeaders($headers)
                            ->withOptions(['verify' => false]); 
 
            if (strtolower($method) === 'post') {
                $response = $httpClient->post($endpoint, $data);
            } else { 
                $response = $httpClient->get($endpoint);
            }
 
            if ($response->successful()) {
                return $response->json();
            } else { 
                Log::error('Response error: ' . $response->body());
                Log::error('Status code: ' . $response->status());
                Log::error('Headers sent: ' . json_encode($headers));
                Log::error('Request endpoint: ' . $endpoint);
                return response()->json(['error' => 'Failed to make request: ' . $response->body()], $response->status());
            }
        } catch (\Exception $e) { 
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    } 
   
    public function getStatusAllBc()
    { 
        $inbounds = Inbound::where('created_by', auth()->id())->whereIn('status_id', [13, 14, 16])->get();
        if (!$inbounds) {
            return response()->json(['error' => 'Nomor Aju tidak ditemukan'], 400);
        }
        $results = [];
        foreach($inbounds as $inbound){
            $aju = substr(str_replace('-', '', $inbound->request_number), 0 , 26);
            try {
                $response = $this->fetchApiResponse("/openapi/status/{$aju}", "dataStatus");
                $resultReponse = json_decode(json_encode($response), true);
                if($resultReponse['status'] == 'Error'){
                    $results[] = [
                        'no_aju'        => $aju,
                        'date'          => date('Y-m-d H:i:s'),
                        'description'   => $resultReponse['message']
                    ];
                }else {
                    $results[] = [
                        'no_aju'        => $aju,
                        'date'          => $resultReponse['data'][0]['waktuStatus'],
                        'description'   => $resultReponse['data'][0]['keterangan']
                    ];
                }

            }catch(Exception $e){

                $results[] = [
                    'no_aju'        => $aju,
                    'date'          => date('Y-m-d H:i:s'),
                    'description'   => $e->getMessage()
                ];

            }

        }

        return $results ;
    }

    public function getStatusBc($nomorAju)
    { 
        $Inbound = Inbound::where('request_number', $nomorAju)->first();

        if (!$Inbound) {
            return response()->json(['error' => 'Nomor Aju tidak ditemukan'], 400);
        }

        $nomorAju = str_replace("-", "", $nomorAju);
        $Aju = substr($nomorAju, 0, 26);
        $endpoint = "/openapi/status/{$Aju}";

        return $this->fetchApiResponse($endpoint, "dataStatus");
    }

    public function getKurs($kodeValuta)
    {
        if (!$kodeValuta) {
            return response()->json(['error' => 'Kode valuta kosong'], 400);
        }

       $endpoint = "/openapi/kurs/{$kodeValuta}";
       // $endpoint = "/Referensi/v1/kurs/{$kodeValuta}";
       // $fetchApiResponse=$this->fetchApiResponse($endpoint, "data"); 
        return $this->fetchApiResponse($endpoint, "data");
  
    }

    public function getBc11($param)
    {
        $requiredParams = ['kodeKantor', 'namaImportir', 'noHostBl', 'tglHostBl'];
        
        foreach ($requiredParams as $paramName) {
            if (empty($param->$paramName)) {
                return response()->json(['error' => "$paramName kosong"], 400);
            }
        } 
        $endpoint = "/openapi/manifes-bc11?noHostBl={$param->noHostBl}&tglHostBl={$param->tglHostBl}&kodeKantor={$param->kodeKantor}&nama={$param->namaImportir}";

        return $this->fetchApiResponseBc11($endpoint, "data");
    }

    public function getLartas($hscode)
    {
        if (!$hscode) {
            return response()->json(['error' => 'hscode kosong'], 400);
        }
 
        $endpoint = "/openapi/hs-lartas?kodeHs={$hscode}";
        return $this->fetchApiResponseDev($endpoint, "data");
    }

    public function getTarifHscode($hscode, $date)
    {
        if (!$hscode) {
            return response()->json(['error' => 'kodeHs kosong'], 400);
        }

        if (!$date) {
            return response()->json(['error' => 'tanggal kosong'], 400);
        }

        $endpoint = "/openapi/tarif-hs?kodeHs={$hscode}&tanggal={$date}";
        return $this->fetchApiResponse($endpoint, "posTarif");
    }
    
    private function fetchApiResponse($endpoint, $type)
    {
        try {
            $response = $this->makeRequest($endpoint, 'GET');  
            $resultReponse = json_decode(json_encode($response), true);
            if (isset($resultReponse['status']) && $resultReponse['status'] == true && isset($resultReponse[$type])) {
                return [
                    'status' => 'Success',
                    'data' => $resultReponse[$type]
                ];
            } else {
                return [
                    'status' => 'Error',
                    'message' => 'Data tidak ditemukan atau terjadi kesalahan'
                ];
            }
        } catch (\Exception $e) {
            return [
                'status' => 'Error',
                'message' => 'Terjadi kesalahan saat menghubungkan ke API'
            ];
        }
    }
    private function fetchApiResponseBc11($endpoint, $type = null)
    {
        try { 
            // Lakukan request ke API
            $response = $this->makeRequest($endpoint, 'GET');  
            $resultResponse = json_decode(json_encode($response), true);
 
            if (is_array($resultResponse) && !empty($resultResponse) && isset($resultResponse['noBc11']) && !empty($resultResponse['noBc11'])) {
                return [
                    'status' => 'Success',
                    'data' => $resultResponse
                ];
            } else {
                return [
                    'status' => 'Error',
                    'message' => isset($resultResponse['respon']) && !empty($resultResponse['respon']) 
                                ? $resultResponse['respon'] 
                                : 'Data tidak ditemukan atau terjadi kesalahan'
                ];
            }
        } catch (\Exception $e) { 
            return [
                'status' => 'Error',
                'message' => 'Terjadi kesalahan saat menghubungkan ke API: ' . $e->getMessage()
            ];
        }
    }


    private function fetchApiResponseDev($endpoint, $type)
    {
        try {
            $response = $this->makeDevRequest($endpoint, 'GET'); 
            
            if (isset($response['status']) && $response['status'] == true && isset($response[$type])) {
                return [
                    'status' => 'Success',
                    'data' => $response[$type]
                ];
            } else {
                return [
                    'status' => 'Error',
                    'message' => 'Data tidak ditemukan atau terjadi kesalahan'
                ];
            }
        } catch (\Exception $e) {
            return [
                'status' => 'Error',
                'message' => 'Terjadi kesalahan saat menghubungkan ke API'
            ];
        }
    }

    public function getCombinedData($hscode) {
        $date = date("Y-m-d");
        $lartas = $this->getLartas($hscode);
        $tarif = $this->getTarifHscode($hscode, $date);

        if ($lartas['status'] == 'Success' && $tarif['status'] == 'Success') {
            $tarifMap = [
                'BM' => 0,
                'PPN' => 11,
                'PPH' => 0,
                'PPNBM' => 0
            ];

            foreach ($tarif['data'] as $item) {
                if ($item['kodeJenisPungutan'] && isset($tarifMap[$item['kodeJenisPungutan']])) {
                    $tarifMap[$item['kodeJenisPungutan']] = $item['tarif'];
                }
            }

            $DokumenFasilitas = [];
            foreach ($lartas['data'] as $item) {
                if ($item['kodeJenisPungutan'] == "BM") {
                    $fasilitas = MasterFasilitas::where('code', '=', $item['kodeFasilitas'])->first();
                    if ($fasilitas) {
                        $DokumenFasilitas[] = "- " . $fasilitas->name;
                    }
                }
            }

            return [
                'status' => 'Success',
                'lartas' => $lartas['data'],
                'DokumenFasilitas' => $DokumenFasilitas,
                'tarifMap' => $tarifMap
            ];
        } else {
            return [
                'status' => 'Error',
                'message' => 'Data tidak ditemukan atau terjadi kesalahan'
            ];
        }
    }

    public function generateRequestNumber($bcform,$parameter) { 
        $firstPart = str_pad($parameter, 6, "0", STR_PAD_LEFT);
     
        $secondPart = '013444';
        $thirdPart = Carbon::now()->format('Ymd');
        $fourthPart = $this->generateSequenceNumber($bcform);
    
        return $firstPart . '-' . $secondPart . '-' . $thirdPart . '-' . $fourthPart;
    }
    
    public function generateSequenceNumber($bcform) {
        if($bcform == 1){
            $latestInbound = Inbound::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
        }else{
            $latestInbound = Inbound::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
        } 
        if ($latestInbound) { 
            $lastNumber = substr($latestInbound->request_number, -6);
            $sequenceNumber = intval($lastNumber) + 1;
        } else { 
            $sequenceNumber = 1;
        }
    
        return str_pad($sequenceNumber, 6, "0", STR_PAD_LEFT);
    }

    public function storeProfile($filteredInput) 
    {
        $profileIds = []; 
        $entities = [
            'importir', 'exportir', 'pemasok', 'pemilik', 'penerima', 'pengirim', 'penjual', 'pembeli', 'pemusatan', 'ppjk'
        ];
    
        foreach ($entities as $entity) {
            if ($filteredInput->has($entity . '_nama') && $filteredInput->get($entity . '_nama')) { 
                $profileIds[$entity] = $this->processEntities($filteredInput, $entity);
            }
        }
     
        return $profileIds;
    }

    private function processEntities($filteredInput, $entity) {

        $createEntity = true;

        $entityTypeMap = [
            'importir'    => 'importir',
            'exportir'    => 'exportir',
            'pemasok'     => 'pemasok-barang',
            'pemilik'     => 'pemilik-barang',
            'penerima'    => 'penerima-barang',
            'pengirim'    => 'pengirim-barang',
            'penjual'     => 'penjual-barang',
            'pembeli'     => 'pembeli-barang',
            'pemusatan'   => 'pemusatan-barang',
            'ppjk'        => 'ppjk' 
        ];
        
        $entityType [] = $entityTypeMap[$entity] ?? 'user'; // Default ke 'user' jika tidak ditemukan di map
    
        $entityDataDetail = [];  
     
        if (in_array($entity, ['importir', 'pemilik', 'pemusatan', 'ppjk'])) {
            $entityType = ['importir-barang', 'pemilik-barang', 'pemusatan-barang', 'ppjk'];
            $entityDataDetail['tipe_identitas'] = $filteredInput->get($entity . '_tipe_identitas');
            $entityDataDetail['nomor_identitas'] = $filteredInput->get($entity . '_nomor_identitas');
        }
    
        if (in_array($entity, ['importir'])) {
            $entityDataDetail['tipe_api'] = $filteredInput->get($entity . '_tipe_api');
            $entityDataDetail['nomor_api'] = $filteredInput->get($entity . '_api_nib_nomor');
            $entityDataDetail['status'] = $filteredInput->get($entity . '_status');
            $entityType = ['importir'];
        }  

        if (in_array($entity, ['exportir'])) {

            $entityType = ['exportir' , 'pemilik-barang'];

            $entityDataDetail['tipe_identitas'] = $filteredInput->get($entity . '_tipe_identitas');
            $entityDataDetail['nomor_identitas'] = $filteredInput->get($entity . '_nomor_identitas');
            $entityDataDetail['status_pengusaha'] = $filteredInput->get($entity . '_entrepreneur_status');
        }   

        $checkEntity = Profile::where([
            'name'                      => $filteredInput->get($entity . '_nama'),
            'address'                   => $filteredInput->get($entity . '_alamat'),
        ]); 

        if($filteredInput->get($entity . '_tipe_identitas') != null)
            $checkEntity->whereJsonContains('details->tipe_identitas', $filteredInput->get($entity . '_tipe_identitas'));

        if($filteredInput->get($entity . '_nomor_identitas') != null)
            $checkEntity->whereJsonContains('details->nomor_identitas', $filteredInput->get($entity . '_nomor_identitas'));

        $checkEntity = $checkEntity->first();
        
        if($checkEntity){

            $margeTypesEntity = [];
            $margeDetailsEntity = [];

            // Check Type

            $typesFromEntityData = is_array($checkEntity->types) ? $checkEntity->types : json_decode($checkEntity->types);
            $detailFromEntityData = is_array($checkEntity->details) ? $checkEntity->details : [$checkEntity->details];

            if(!in_array($entityTypeMap[$entity], $typesFromEntityData))
                $margeTypesEntity = array_merge([$entityTypeMap[$entity]], $typesFromEntityData);
                
            $margeDetailsEntity = array_merge($detailFromEntityData, $entityDataDetail);
            Profile::where('id', $checkEntity->id)->update([
                'types'     => !empty($margeTypesEntity) ? $margeTypesEntity : $typesFromEntityData,
                'details'   => !empty($margeDetailsEntity) ? $margeDetailsEntity : $detailFromEntityData
            ]);

            $createEntity = false;
            $profileId = $checkEntity->id;
        }
        
        $entityProfile = new Profile();

        if (in_array($entity, ['penjual', 'pengirim', 'pembeli', 'penerima'])) {
            $entityType = ['penjual-barang', 'pengirim-barang', 'pembeli-barang', 'penerima-barang'];
        }

        if($createEntity){
            $entityProfile->name        = strtoupper($filteredInput->get($entity . '_nama'));
            $entityProfile->address     = strtoupper($filteredInput->get($entity . '_alamat')); 
            $entityProfile->types       = $entityType;
            $entityProfile->details     = $entityDataDetail;
            $entityProfile->country_id  = $filteredInput->get($entity . '_negara') ?? null;
            $entityProfile->warehouse_id = auth()->user()->warehouse_id;
            
            $entityProfile->save();
            $profileId  = $entityProfile->id;
        }
        
        return $profileId;
    } 

    //{"tipe_identitas":"ktp","nomor_identitas":"1234567891234569","tipe_api":"apip","nomor_api":"567567567567","nomor_izin":"-","niper":"-","nomor_ppjk":"-","tanggal_ppjk":"-"}
    private function processEntity($request, $entity) {
        $entityDataDetail = [
            'tipe_identitas'  => $request->input($entity . 'indentitas_type'),
            'nomor_identitas' => $request->input($entity . 'indentitas_nomor'),
            'tipe_api'        => $request->input($entity . 'tipe_api'),
            'nomor_api'       => $request->input($entity . 'api_nib_nomor'),
            'status'          => $request->input($entity . 'status'),
            'negara'          => $request->input($entity . 'negara'), 
        ];
        $entityProfile          = new Profile();
        $entityProfile->name    = $request->input($entity . 'nama');
        $entityProfile->address = $request->input($entity . 'alamat');
        $entityProfile->details = json_encode($entityDataDetail);  
        $entityProfile->save();
    } 

    public function storeP(Request $request) { 
        $fileTypes = [
            'importir' => 'importir',
            'pemasok-barang' => 'pemasok-barang',
            'pemilik-barang' => 'pemilik-barang',
            'penerima-barang' => 'penerima-barang',
            'pengirim-barang' => 'pengirim-barang',
            'ppjk' => 'ppjk',
            'tpb' => 'tpb',
            'user' => 'user',
        ];
     
        $validatedData = $request->validate([
            'importir_nama' => ['nullable', Rule::in([$fileTypes['importir']])],
            'pemilik_nama' => ['nullable', Rule::in([$fileTypes['pemilik-barang']])],
            'penjual_nama' => ['nullable', Rule::in([$fileTypes['pemasok-barang']])],
            'pengirim_nama' => ['nullable', Rule::in([$fileTypes['pengirim-barang']])],
            'pemusatan_nama' => ['nullable', Rule::in([$fileTypes['penerima-barang']])], 
        ]);
     
        foreach ($fileTypes as $entity => $fileType) {
            if ($request->filled($entity . '_nama')) {
                $this->processEntity2($request, $entity, $fileType);
            }
        }
     
        return redirect()->back()->with('success', 'Data berhasil diproses.');
    }
    
    private function processEntity2($request, $entity, $fileType) {
        $entityData = [
            'nama' => $request->input($entity . '_nama'), 
        ];
        $entityProfile = new Profile();
        $entityProfile->details = json_encode($entityData);  
        $entityProfile->file_type = $fileType; 
        $entityProfile->save();
    } 

    public function duplicatedInbound($id, $bc)
    {

        DB::beginTransaction();

        $inbound = Inbound::with([
            'inboundDetails.good',
            'inboundDetails.hsCode',
            'inboundDetails.ratePreference',
            'inboundDocuments',
            'inboundDocuments.file', 
            'inboundKppbcAsal',
            'inboundPpjk',
            'inboundTransportation.transportation',
            'inboundValas.masterValas',
            'inboundPackaging',
            'inboundPetiKemas',
            'inboundExportir',
            'inboundPembeliBarang',
            'inboundPenerimaBarang',
            'inboundPpjk',
        ])->find($id);

        $helper                     = new GeneralHelper();
        $nomorPengajuan             = $bc == "BC30" ? $helper->generateRequestNumber(1, 30) : $helper->generateRequestNumber(1, 20);

        $inbound['request_number']   = $nomorPengajuan;
        $inbound['bc_form_id']       = $bc == "BC30" ? 7 : 6;
        $inbound['status_id']        = $bc == "BC30" ? 13 : 11;

        $newInbound = $inbound->replicate();
        $newInbound->save();

        $getInboundDetails = $inbound->inboundDetails->toArray();
        $newInbound->inboundDetails()->createMany($getInboundDetails);

        $getInboundDocuments = $inbound->inboundDocuments->toArray();
        $newInbound->inboundDocuments()->createMany($getInboundDocuments);
        
        if($bc == "BC20"){ 
            $getinboundKppbcPengawas = $inbound->inboundKppbcPengawas->toArray();
            $newInbound->inboundKppbcPengawas()->create($getinboundKppbcPengawas);
        }else{
            $getinboundKppbcAsal = $inbound->inboundKppbcAsal->toArray();
            $newInbound->inboundKppbcAsal()->create($getinboundKppbcAsal);
        }
        

        $getinboundPpjk = $inbound->inboundPpjk->toArray();
        $newInbound->inboundPpjk()->create($getinboundPpjk);

        $getinboundTransportation = $inbound->inboundTransportation->toArray();
        $iTransportation = $newInbound->inboundTransportation()->createMany($getinboundTransportation);

        $data_ports = DB::table('inbound_transportation_ports')
                    ->select(['inbound_transportation_ports.*'])
                    ->join('ports', 'ports.id', '=', 'inbound_transportation_ports.port_id')
                    ->whereIn('inbound_transportation_ports.inbound_transportation_id', $inbound->inboundTransportation->pluck('id'))
                    ->get()->toArray(); 
        // Manual fill data
 
            $inboundTransportations = InboundTransportation::whereIn('id', $iTransportation->pluck('id'))->get();
            foreach($inboundTransportations  as $inboundTransportation){
                $ports = [];

                
                foreach ($data_ports as $row_ports) {

                
                    if($bc == "BC30"){
                        if ($row_ports->type == "muat") {
                            array_push($ports, [
                                "inbound_transportation_id" => $inboundTransportation->id,
                                "port_id" => $row_ports->port_id, 
                                "type" => "muat"
                            ]);
                        }
                        if ($row_ports->type == "export") {
                            array_push($ports, [
                            "inbound_transportation_id" => $inboundTransportation->id,
                                "port_id" => $row_ports->port_id, 
                                "type" => "export"
                            ]);
                        }
                        if ($row_ports->type == "bongkar") {
                            array_push($ports, [
                                "inbound_transportation_id" => $inboundTransportation->id,
                                "port_id" => $row_ports->port_id, 
                                "type" => "bongkar"
                            ]);
                        }
                    }else{ 
                
                        if ($row_ports->type == "muat") {
                            array_push($ports, [
                                "inbound_transportation_id" => $inboundTransportation->id,
                                "port_id" => $row_ports->port_id, "type" => "muat"
                            ]);
                        }
                        if ($row_ports->type == "transit") {
                            array_push($ports, [
                                "inbound_transportation_id" => $inboundTransportation->id,
                                "port_id" => $row_ports->port_id, "type" => "transit"
                            ]);
                        }
                        if ($row_ports->type == "bongkar") {
                            array_push($ports, [
                                "inbound_transportation_id" => $inboundTransportation->id,
                                "port_id" => $row_ports->port_id, "type" => "bongkar"
                            ]);
                        }

                    }

                    if ($row_ports->type == "tujuan") {
                        array_push($ports, [
                        "inbound_transportation_id" => $inboundTransportation->id,
                            "port_id" => $row_ports->port_id, 
                            "type" => "tujuan"
                        ]);
                    }  
                }
                $inboundTransportation->transportationPorts()->insert($ports);
            }
       

        $getinboundKppbc = $inbound->inboundKppbc->toArray();
        $newInbound->inboundKppbc()->create($getinboundKppbc);

        $getinboundValas = $inbound->inboundValas->toArray();
        $newInbound->inboundValas()->create($getinboundValas);

        $getinboundPackaging = $inbound->inboundPackaging->toArray();
        $newInbound->inboundPackaging()->createMany($getinboundPackaging);

        $getinboundPetiKemas = $inbound->inboundPetiKemas->toArray();
        $newInbound->inboundPetiKemas()->createMany($getinboundPetiKemas);

        $getinboundbank = $inbound->inboundBank->toArray();
        $newInbound->inboundBank()->createMany($getinboundbank);

        if($bc == "BC30"){
            $newInbound->inboundPembeliBarang()->create(["profile_id" => $inbound->inboundPembeliBarang->profile_id , "type" => "pembeli-barang"]);
            $newInbound->inboundPenerimaBarang()->create(["profile_id" => $inbound->inboundPenerimaBarang->profile_id, "type" => "penerima-barang"]);
            $newInbound->inboundExportir()->create(["profile_id" => $inbound->inboundExportir->profile_id, "type" => "exportir"]);
            $inboundPemilikBarang = InboundProfile::with('profile')
            ->where([
                ['inbound_id', '=', $inbound->id],
                ['type', '=', 'pemilik-barang']
            ])->get();

            foreach($inboundPemilikBarang as $key=>$pemilikBarang){
                $newInbound->inboundpemilikBarang()->create(
                [
                    "profile_id" => $pemilikBarang->profile_id, 
                    "type" => "pemilik-barang" , 
                    "good_facility" => $pemilikBarang->good_facility
                ]);
            }

        }

        if($bc == "BC20"){ 
            $newInbound->inboundTPS()->create(["master_tps_id" => $inbound->inboundTPS->master_tps_id]);
            $newInbound->inboundImportir()->create(["profile_id" => $inbound->inboundImportir->profile_id , "type" => "importir"]);
            $newInbound->inboundPemilikBarang()->create(["profile_id" => $inbound->inboundPemilikBarang->profile_id , "type" => "pemilik-barang"]);
            $newInbound->inboundPengirimBarang()->create(["profile_id" => $inbound->inboundPengirimBarang->profile_id , "type" => "pengirim-barang"]);
            $newInbound->inboundPenjualBarang()->create(["profile_id" => $inbound->inboundPenjualBarang->profile_id , "type" => "penjual-barang"]);
            $newInbound->inboundPemusatanBarang()->create(["profile_id" => $inbound->inboundPemusatanBarang->profile_id , "type" => "pemusatan-barang"]);

        }


        $newInbound->inboundPpjk()->create(["profile_id" => $inbound->inboundPpjk->profile_id, "type" => "ppjk"]);

        if(!$newInbound 
        || !$inboundTransportations){
            DB::rollback();
            return true;
        }

        DB::commit();
        return false;

    }

}
