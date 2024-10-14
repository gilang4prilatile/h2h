<?php

namespace App\Helpers;
use Carbon\Carbon;
use App\Models\Inbound;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log; 
use Illuminate\Http\Client\Response;

class ComboHelper
{
    
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => rtrim(env('API_CIESA_URL'), '/') . '/',
        ]);
        
    }

    function getBmTypes() {
        return [
            1 => "1 - ADVOLORUM",
            2 => "2 - SPESIFIK"
        ];
    }
    

    function getJenisBarangTidakBerwujud() {
        return [
            0 => "YA",
            1 => "TIDAK"
        ];
    }
    
    function getTaxTypes() {
        return [
            1 => "1 - DIBAYARKAN",
            3 => "3 - DITANGGUHKAN",
            4 => "4 - BERKALA",
            5 => "5 - DIBEBASKAN",
            6 => "6 - TIDAK DIPUNGUT",
            7 => "7 - SUDAH DILUNASI",
            8 => "8 - DIJAMINKAN",
            9 => "9 - DITUNDA",
        ];
    }
    
    /* 1  DIBAYAR
        2  DITANGGUNG PEMERINTAH
        3  DITANGGUHKAN
        4  BERKALA
        5  DIBEBASKAN
        6  TIDAK DIPUNGUT
        7  SUDAH DILUNASI
        8  DIJAMINKAN
        9  DITUNDA*/

    function getCukaiCommodity() {
        return [
            1 => "1 - EA",
            2 => "2 - MMEA",
            3 => "3 - HASIL TEMBAKAU"
        ];
    }

    
    function getTradeTransactionTypes() {
        return [
            "IMB" => "IMB - TRANSAKSI PERDAGANGAN DENGAN IMBAL DAGANG",
            "IOA" => "IOA - PEMBAYARAN DILAKUKAN DENGAN INTEROFFICE ACCOUNT",
            "KMD" => "KMD - PEMBAYARAN KEMUDIAN",
            "KON" => "KON - PEMBAYARAN DILAKUKAN DENGAN KONSINYASI",
            "LAI" => "LAI - TRANSAKSI PERDAGANGAN ATAU CARA PEMBAYARAN LAINNYA",
            "PMK" => "PMK - PEMBAYARAN DILAKUKAN DIMUKA",
            "RLC" => "RLC - PEMBAYARAN DENGAN RED CLAUSE LETTER OF CREDIT",
            "SLC" => "SLC - PEMBAYARAN DENGAN SIGHT LETTER OF CREDIT",
            "ULC" => "ULC - PEMBAYARAN DENGAN USANCE LETTER OF CREDIT",
            "WSI" => "WSI - PEMBAYARAN DILAKUKAN DENGAN WESEL INKASO"
        ];
    }
    
    

    function getCukaiCommodityCode() {
        return [
            1 => "1 - MMA",
            2 => "2 - MMB",
            3 => "3 - MMC"
        ];
    }

    function getjenisPetiKemas() {
        return [
            4 => "4 - EMPTY",
            7 => "7 - LCL",
            8 => "8 - FCL" 
        ];
    }

    function getLocationCheck() {
        return [
            1 => "1 - KP TEMPAT PEMUATAN",
            2 => "2 - GUDANG EKSPORTIR",
            3 => "3 - TEMPAT LAIN YANG DIIZINKAN",
            4 => "4 - TPS",
            5 => "5 - TPP",
            6 => "6 - TPB"
        ];
    }
    

    function getContainers() {
        return ["FCL" => "FCL", "LCL" => "LCL"];
    }

    function getTutupPu() {
        return [
            11 => "BC 1.1",
            12 => "BC 1.2",
            14 => "BC 1.4" 
        ];
    }

    function getKondisiBarang() {
        return [
            1 => "BARU",
            2 => "BUKAN BARU",
            3 => "BAIK",
            4 => "SEGAR",
            5 => "BEKU",
            6 => "BAIK/BARU",
            7 => "BAIK/BEKU",
            8 => "BAIK/BEKAS"
        ];
    }
    

    function getJenisIdentitas() {
        return [
            "npwp-12-digit" => "0 - NPWP 12 DIGIT",
            "npwp-10-digit" => "1 - NPWP 10 DIGIT",
            "paspor" => "2 - PASPOR",
            "ktp" => "3 - KTP",
            "lainnya" => "4 - LAINNYA",
            "npwp-15-digit" => "5 - NPWP 15 DIGIT",
            "npwp-16-digit" => "6 - NPWP 16 DIGIT",
        ];
    }

    function getJenisApi() {
        return [
            1 => "(APIU) ANGKA PENGENAL IMPORTIR UMUM",
            2 => "(APIP) ANGKA PENGENAL IMPORTIR PERSEOROAN",
            4 => "(APIT) ANGKA PENGENAL IMPORTIR TERBATAS"
        ];
    }

    function getStatusImportir() {
        return [
            0 => "MITA",
            1 => "AEO",
            2 =>"LAINNYA"
        ];
    }

    function getJenisTransaksi() {
        return [
            "NTR" => "NTR - TRANSAKSI JUAL BELI",
            "AST" => "AST - ASSIST",
            "BTR" => "BTR - BUKAN TRANSAKSI JUAL BELI LAINNYA",
            "CAM" => "CAM - BARANG TERDIRI DARI BARANG-BARANG YANG MERUPAKAN OBYEK TRANSAKSI GABUNGAN DARI DUA ATAU LEBIH JENIS TRANSAKSI 1 SAMPAI DENGAN 10",
            "CMA" => "CMA - BUKAN TRANSAKSI JUAL BELI BERUPA BARANG HADIAH/PROMOSI/CONTOH",
            "FRE" => "FRE - FREIGHT",
            "FTR" => "FTR - TRANSAKSI JUAL BELI BERDASARKAN HARGA FUTURES (FUTURE PRICE), YAITU HARGA YANG BARU DAPAT DITENTUKAN SETELAH PIB DISAMPAIKAN",
            "HBH" => "HBH - BUKAN TRANSAKSI JUAL BELI BERUPA BARANG BANTUAN/HIBAH",
            "INS" => "INS - INSURANCE",
            "ITM" => "ITM - BUKAN TRANSAKSI JUAL BELI BERUPA BARANG YANG DIIMPOR OLEH INTERMEDIARY YANG TIDAK MEMBELI BARANG",
            "KON" => "KON - BUKAN TRANSAKSI JUAL BELI BERUPA BARANG KONSINYASI",
            "LES" => "LES - BUKAN TRANSAKSI JUAL BELI BERUPA BARANG SEWA (LEASING)",
            "PRO" => "PRO - TRANSAKSI JUAL BELI MENGANDUNG PROCEEDS YANG NILAINYA BELUM DAPAT DITENTUKAN",
            "ROY" => "ROY - TRANSAKSI JUAL BELI MENGANDUNG ROYALTI YANG NILAINYA BELUM DAPAT DITENTUKAN",
            "TIP" => "TIP - TITIPAN"
        ];
    } 
    
    function getJenisTandaPengaman() {
        return [
            1 => "KABEL",
            2 => "KUNCI LOGAM",
            3 => "KUNCI PLASTIK",
            4 => "LAINNYA",
        ];
    }

    function getJenisVD() {
        return [
            'BTR' => "BTR - BUKAN TRANSAKSI JUAL BELI LAINNYA",
            'CAM' => "CAM - BARANG TERDIRI DARI BARANG-BARANG YANG MERUPAKAN OBYEK TRANSAKSI GABUNGAN DARI DUA ATAU LEBIH JENIS TRANSAKSI 1 SAMPAI DENGAN 10",
            'CMA' => "CMA - BUKAN TRANSAKSI JUAL BELI BERUPA BARANG HADIAH/PROMOSI/CONTOH",
            'FTR' => "FTR - TRANSAKSI JUAL BELI BERDASARKAN HARGA FUTURES (FUTURE PRICE), YAITU HARGA YANG BARU DAPAT DITENTUKAN SETELAH PIB DISAMPAIKAN",
            'HBH' => "HBH - BUKAN TRANSAKSI JUAL BELI BERUPA BARANG BANTUAN/HIBAH",
            'ITM' => "ITM - BUKAN TRANSAKSI JUAL BELI BERUPA BARANG YANG DIIMPOR OLEH INTERMEDIARY YANG TIDAK MEMBELI BARANG",
            'KON' => "KON - BUKAN TRANSAKSI JUAL BELI BERUPA BARANG KONSINYASI",
            'LES' => "LES - BUKAN TRANSAKSI JUAL BELI BERUPA BARANG SEWA (LEASING)",
            'NTR' => "NTR - TRANSAKSI JUAL BELI",
            'PRO' => "PRO - TRANSAKSI JUAL BELI MENGANDUNG PROCEEDS YANG NILAINYA BELUM DAPAT DITENTUKAN",
            'ROY' => "ROY - TRANSAKSI JUAL BELI MENGANDUNG ROYALTI YANG NILAINYA BELUM DAPAT DITENTUKAN",
            'TIP' => "TIP - TITIPAN"
        ];
    }

    function getKomoditiCukai() {
        return [
            1 => "1 - HASIL TEMBAKAU",
            2 => "2 - MMEA",
            3 => "3 - EA",
            4 => "4 - test"
        ];
    }

    function getLokasiBayar() {
        return [
            1 => "1 - BANK",
            2 => "2 - POS",
            3 => "3 - KANTOR PABEAN",
            4 => "4 - NTPN"
        ];
    }

    function getTujuanPemasukan() {
        return [
            1 => "1 - EKS-DIPERBAIKI",
            2 => "2 - EKS-DISUBKONTRAKKAN",
            3 => "3 - EKS-DIPINJAMKAN",
            4 => "4 - RETURN BAHAN BAKU",
            5 => "5 - PEMASUKAN MELEWATI JANGKA WAKTU",
            6 => "6 - LAINNYA"
        ];
    }

    function getGoodsTypesFtz() {
        return [
            1=> "1 - BARANG JADI",
            2=> "2 - BAHAN BAKU",
            3=> "3 - BAHAN PENOLONG",
            4=> "4 - MESIN / SPAREPART",
            5=> "5 - PERALATAN / KONSTRUKSI",
            6=> "6 - BARANG CONTOH / TEST",
            7=> "7 - LAINNYA",
            8=> "8 - LEBIH DARI SATU JENIS BARANG"
        ];
    }

    public function getEntityTypeExel($kodeEntitas)
    {
        $types = [
            1  => 'importir',
            2  => 'exportir',
            3  => 'pengusaha',
            4  => 'ppjk',
            5  => 'pemasok-barang',
            6  => 'pembeli-barang',
            7  => 'pemilik-barang',
            8  => 'penerima-barang',
            9  => 'pengirim-barang',
            10 => 'penjual-barang',
            11 => 'pemusatan-barang'
        ];

        return isset($types[$kodeEntitas]) ? [$types[$kodeEntitas]] : [];
    }

    public function getJenisIdentitasExel($kodeJenisIdentitas)
    {
        $identitas = [
            0 => "npwp-12-digit",
            1 => "npwp-10-digit",
            2 => "paspor",
            3 => "ktp",
            4 => "lainnya",
            5 => "npwp-15-digit",
            6 => "npwp-16-digit",
        ];

        return isset($identitas[$kodeJenisIdentitas]) ? $identitas[$kodeJenisIdentitas] : null;
    }

    public function getJenisApiExel($kodeApi)
    {
        $api = [
            01 => "apiu",
            02 => "apip",
            04 => "apit"
        ];

        return isset($api[$kodeApi]) ? $api[$kodeApi] : null;
    }

    public function getStatusImportirExel($kodeStatus)
    {
        $status = [
            0 => "MITA",
            1 => "AEO",
            2 => "LAINNYA"
        ];

        return isset($status[$kodeStatus]) ? $status[$kodeStatus] : null;
    }

    public function getjenisPetiKemasExel($kode)
    {
        $status = [
            4 => "4 - EMPTY",
            7 => "7 - LCL",
            8 => "8 - FCL" 
        ];

        return isset($status[$kode]) ? $status[$kode] : null;
    } 

    public function getKondisiBarangExel($kode)
    {
        $status = [
            1 => "BARU",
            2 => "BUKAN BARU",
            3 => "BAIK",
            4 => "SEGAR",
            5 => "BEKU",
            6 => "BAIK/BARU",
            7 => "BAIK/BEKU",
            8 => "BAIK/BEKAS"
        ];

        return isset($status[$kode]) ? $status[$kode] : null;
    }  

    public function getTaxTypesExel($kode)
    {
        $status = [
            1 => "1 - DIBAYARKAN",
            3 => "3 - DITANGGUHKAN",
            4 => "4 - BERKALA",
            5 => "5 - DIBEBASKAN",
            6 => "6 - TIDAK DIPUNGUT",
            7 => "7 - SUDAH DILUNASI",
            8 => "8 - DIJAMINKAN",
            9 => "9 - DITUNDA",
        ];

        return isset($status[$kode]) ? $status[$kode] : null;
    }   
}
