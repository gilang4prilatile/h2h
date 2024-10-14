<?php

namespace App\Exports;

use App\Models\Inbound;
use App\Models\InboundJenisTpb;
use App\Models\InboundTujuanPengiriman;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use function Composer\Autoload\includeFile;

class InboundBC30Export implements FromCollection,WithHeadings
{
    use Exportable;

    public function __construct($query)
    {
        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $query = $query->where('created_by',$user->id);
        }
        $this->query = $query;
    }

    public function headings(): array
    {

        return [
            'No',
            'Tipe BC',
            'No Pengajuan',
            'Tanggal Masuk',
            'No Pendaftaran',
            'Tanggal Pendaftaran',
            'Kantor Pabean',
            'Jenis PIB',
            'Jenis Import',
            'Cara Bayar',
            'Exportir',
            'Pemilik Barang',
            'PPJK',
            'Pembeli Barang',
            'Penerima Barang', 
            'Sarana Angkut',
            'No Polisi',
            'Jumlah Dokumen',
            'Jumlah Barang',
            'Jumlah Kemasan',
            'Jumlah Bank Devisa',
            'Jumlah Peti Kemas',
            'Total Qty Barang',
            'Berat Bersih',
            'Berat Kotor',
            'Pelabuhan Muat',
            'Pelabuhan Transit',
            'Pelabuhan Bongkar',
            'Pelabuhan Tujuan',
            'FOB',
            'Freight',
            'Asuransi',
            'Valuta',
            'NDPBM',
            'Nilai CIF',
            'Tempat Timbun',
            'Peti Kemas (Nomor/ Ukuran Tipe)',
            'Kota',
            'Tanggal',
            'Pemberitahu',
            'Jabatan',
            'Status',
            'User Input'
        ];
    }

    public function collection()
    {

        $inbound = $this->query;


        $angkastart = 0;
        $angka = 1;
        $myarray = [];
        foreach($inbound as $inbound){

            $inbound_id = $inbound['id'];

            // include('BC23_get_data.php');
                $inbounddata        = DB::table('inbounds')->where('id','=',$inbound_id)->first();
                $inbound_details    = json_decode($inbounddata->details, true);

                $inbound_transportation = DB::table('inbound_transportations')->where('inbound_id','=',$inbound_id)->first();
                $sarana_angkut          = DB::table('transportations')->where('id','=',$inbound_transportation->transportation_id)->first();

                $jumlah_dokumen         = DB::table('inbound_documents')->where('inbound_id','=',$inbound_id)->count();
                $arraybarang            = [];

                $barangnya  = DB::table('inbound_details')->where('inbound_id','=',$inbound_id)->get();
                $jumlah_qty = 0;

                foreach($barangnya as $barangnya){
                    $jumlah_qty     = $jumlah_qty + $barangnya->quantity;
                    $goods          = DB::table('goods')->where('id','=',$barangnya->good_id)->first();

                    array_push($arraybarang,$goods->name." (".$barangnya->quantity.")");
                }

                $arraybarang = collect($arraybarang);

                $muat       = ""; $transit    = ""; $bongkar    = ""; $tujuan     = "";
                $data_ports = DB::table('inbound_transportation_ports')
                            ->select(['ports.*', 'inbound_transportation_ports.type'])
                            ->join('ports', 'ports.id', '=', 'inbound_transportation_ports.port_id')
                            ->where('inbound_transportation_ports.inbound_transportation_id', '=', $inbound->inboundTransportation->id)
                            ->get();
                
                foreach ($data_ports as $row_ports) {
                    if ($row_ports->type == "muat") {
                        $muat = $row_ports->name;
                    }
                    if ($row_ports->type == "export") {
                        $export = $row_ports->name;
                    }
                    if ($row_ports->type == "bongkar") {
                        $bongkar = $row_ports->name;
                    }
                    if ($row_ports->type == "tujuan") {
                        $tujuan = $row_ports->name;
                    }
                } 

                $get_valas_id       = DB::table('inbound_valas')->where('inbound_id','=',$inbound_id)->first();
                $valas              = DB::table('master_valas')->where('id','=',$get_valas_id->valas_id)->first();

                $nomor_peti_kemas   = $inbound_details["nomor_peti_kemas"] ?? '';
                $tipe_peti_kemas    = $inbound_details["tipe_peti_kemas"] ?? '';

                array_push($myarray, [
                    'No'                        => $angka,
                    'Tipe BC'                   => 'BC30',
                    'No Pengajuan'              => $inbound->request_number ?? '',
                    'Tanggal Masuk'             => $inbound->created_at ?? '',
                    'No Pendaftaran'            => $inbound_details['nomor_pendaftaran'] ?? '',
                    'Tanggal Pendaftaran'       => $inbound_details["tanggal_pendaftaran"] ?? '',  
                    'Kantor Pabean'             => $inbound->inboundKppbcPengawas->masterKppbc->description ?? '', 
                    'Jenis PIB'                 => $inbound->pib_type_id == 1 ? 'Biasa' : 'Berkala', 
                    'Jenis Import'              => $inbound->importType->name ?? '', 
                    'Cara Bayar'                => $inbound->paymentType->name ?? '', 
                    'Exportir'                  => $inbound->inboundExportir->profile->name ?? '',
                    'Pemilik Barang'            => $inbound->inboundPemilikBarang->profile->name ?? '',
                    'PPJK'                      => $inbound->inboundPpjk->profile->name ?? '',
                    'Pembeli Barang'            => $inbound->inboundPembeliBarang->profile->name ?? '',
                    'Penerima Barang'           => $inbound->inboundPenerimaBarang->profile->name ?? '', 
                    'Sarana Angkut'             => $sarana_angkut->name ?? '',
                    'No Polisi'                 => $inbound_transportation->vehicle_number ?? '',
                    'Jumlah Dokumen'            => $jumlah_dokumen ?? '',
                    'Jumlah Barang'             => $arraybarang->implode(',') ?? '',
                    'Jumlah Kemasan'            => count($inbound->inboundPetiKemas) ?? '',
                    'Jumlah Peti Kemas'         => count($inbound->inboundPackaging) ?? '',
                    'Jumlah Bank Devisa'        => count($inbound->inboundBank) ?? '',
                    'Total Qty Barang'          => $jumlah_qty ?? '',
                    'Berat Bersih'              => $inbound_details["berat_bersih"] ?? '',
                    'Berat Kotor'               => $inbound_details["berat_kotor"] ?? '',
                    'Pelabuhan Muat'            => $muat,
                    'Pelabuhan Export'          => $export,
                    'Pelabuhan Bongkar'         => $bongkar,
                    'Pelabuhan Tujuan'          => $tujuan,
                    'FOB'                       => $inbound_details["fob"] ?? '',
                    'Freight'                   => $inbound_details["freight"] ?? '',
                    'Asuransi'                  => $inbound_details["asuransi"] ?? '',
                    'Valuta'                    => $valas->name ?? '',
                    'NDPBM'                     => $inbound_details["ndpbm"] ?? '',
                    'Nilai CIF'                 => $inbound_details["cif"] ?? '',
                    'Tempat Timbun'             => '',
                    'Peti Kemas (Nomor/ Ukuran Tipe)' => $nomor_peti_kemas . " / " . $tipe_peti_kemas,
                    'Kota'                      => $inbound->city->city ?? '',
                    'Tanggal'                   => date('d F Y', strtotime($inbound->details['pabean_tanggal'])) ?? '',
                    'Pemberitahu'               => $inbound->details['pabean_pemberitahu'] ?? '',
                    'Jabatan'                   => $inbound->details['pabean_jabatan'] ?? '',
                    'Status'                    => $inbound->status->name ?? '',
                    'User Input'                => $inbound->createdBy->name ?? '',
                ]);
                

            $angka = $angka + 1;
            $angkastart = $angkastart + 1;
        } 
        return collect($myarray);
    } 

}
