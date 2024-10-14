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

class InboundBC23Export implements FromCollection,WithHeadings
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

    public function collection()
    {

        $inbound = $this->query;


        $angkastart = 0;
        $angka = 1;
        $myarray = [];
        foreach($inbound as $inbound){

            $inbound_id = $inbound['id'];

            // include('BC23_get_data.php');
                $inbounddata = DB::table('inbounds')->where('id','=',$inbound_id)->first();
                $inbound_details = json_decode($inbounddata->details, true);

                // $inbound
                $inbound_jenis_tpb = DB::table('inbound_jenis_tpbs')->where('inbound_id','=',$inbound_id)->first();
                $jenis_tpb = DB::table('master_jenis_tpb')->where('id','=',$inbound_jenis_tpb->jenis_tpb_id)->first();

                // $inbound_tujuan_pengiriman = DB::table('inbound_tujuan_pengirimen')->where('inbound_id','=',$inbound_id)->first();
                // $tujuan_pengiriman = DB::table('master_tujuan_pengiriman')->where('id','=',$inbound_tujuan_pengiriman->tujuan_pengiriman_id)->first();

                if($inbound->faktur_pajak == 0){
                    $status_pajak = "IN PROGRESS";
                }
                else{
                    $status_pajak = "DONE";
                }

                if($inbound->partial == 1){
                    $partial = "IN PROGRESS";
                }
                else{
                    $partial = "DONE";
                }

                // $inbound_profile_tpb = DB::table('inbound_profiles')->where('inbound_id','=',$inbound_id)->where('type','=','tpb')->first();
                // $tpb_profile = DB::table('profiles')->where('id','=',$inbound_profile_tpb->profile_id)->first();

                // $inbound_profile_pengirim = DB::table('inbound_profiles')->where('inbound_id','=',$inbound_id)->where('type','=','pengirim-barang')->first();
                // $pengirim_profile = DB::table('profiles')->where('id','=',$inbound_profile_pengirim->profile_id)->first();

                $inbound_transportation = DB::table('inbound_transportations')->where('inbound_id','=',$inbound_id)->first();
                $sarana_angkut = DB::table('transportations')->where('id','=',$inbound_transportation->transportation_id)->first();

                $jumlah_dokumen = DB::table('inbound_documents')->where('inbound_id','=',$inbound_id)->count();
                $arraybarang = [];

                $barangnya = DB::table('inbound_details')->where('inbound_id','=',$inbound_id)->get();
                $jumlah_qty = 0;

                foreach($barangnya as $barangnya){
                $jumlah_qty = $jumlah_qty + $barangnya->quantity;
                $goods = DB::table('goods')->where('id','=',$barangnya->good_id)->first();

                array_push($arraybarang,$goods->name." (".$barangnya->quantity.")");
                }

                $arraybarang = collect($arraybarang);

                $get_portMuat = DB::table('inbound_transportation_ports')->where('inbound_transportation_id','=',$inbound_id)->where('type','=',"muat")->first();
                $get_muat = DB::table('ports')->where('id','=',$get_portMuat->port_id)->first() ?? '';

                $get_portTransit = DB::table('inbound_transportation_ports')->where('inbound_transportation_id','=',$inbound_id)->where('type','=',"transit")->first();
                $get_transit = DB::table('ports')->where('id','=',$get_portTransit->port_id)->first();

                $get_portBongkar = DB::table('inbound_transportation_ports')->where('inbound_transportation_id','=',$inbound_id)->where('type','=',"bongkar")->first();
                $get_bongkar = DB::table('ports')->where('id','=',$get_portBongkar->port_id)->first();

                $get_valas_id = DB::table('inbound_valas')->where('inbound_id','=',$inbound_id)->first();
                $valas = DB::table('master_valas')->where('id','=',$get_valas_id->valas_id)->first();

                $get_warehouse_id = DB::table('inbound_warehouses')->where('inbound_id','=',$inbound_id)->first();
                $warehouse = DB::table('warehouses')->where('id','=',$get_warehouse_id->warehouse_id)->first();

                $nomor_peti_kemas = $inbound_details["nomor_peti_kemas"] ?? '';
                $tipe_peti_kemas = $inbound_details["tipe_peti_kemas"] ?? '';

            array_push($myarray,[
            'No' => $angka,
            'Tipe BC' => 'BC23',
            'No Pengajuan' => $inbound->request_number ?? '',
            'Tanggal Masuk' => $inbound->created_at ?? '',
            'No Pendaftaran' => $inbound_details['nomor_pendaftaran'] ?? '',
            'Tanggal Pendaftaran' => $inbound_details["tanggal_pendaftaran"] ?? '',
            'Status Faktur Pajak' => $status_pajak ?? '',
            'Parsial' => $partial ?? '',
            'Kantor Pabean' => $inbound_details["pabean_tempat"] ?? '',
            'Jenis TPB' => $jenis_tpb->name ?? '',
            'Sarana Angkut' => $sarana_angkut->name ?? '',
            'No Polisi' => $inbound_transportation->vehicle_number ?? '' ,
            'Jumlah Dokumen' => $jumlah_dokumen ?? '',
            'Jumlah Barang' => $arraybarang->implode(',') ?? '',
            'Total Qty Barang' => $jumlah_qty ?? '',
            'Berat Bersih' => $inbound_details["berat_bersih"] ?? '',
            'Berat Kotor' => $inbound_details["berat_kotor"] ?? '',
            'Pelabuhan Muat' => $get_muat->name ?? '',
            'Pelabuhan Transit' => $get_transit->name ?? '',
            'Pelabuhan Bongkar' => $get_bongkar->name ?? '',
            'FOB' => $inbound_details["fob"] ?? '',
            'Freight' => $inbound_details["freight"] ?? '',
            'Asuransi' => $inbound_details["asuransi"] ?? '',
            'Valuta' => $valas->name ?? '',
            'NDPBM' => $inbound_details["ndpbm"] ?? '',
            'Nilai CIF' => $inbound_details["cif"] ?? '',
            'Tempat Timbun' => $warehouse->name ?? '',
            'Peti Kemas (Nomor/ Ukuran Tipe)' => $nomor_peti_kemas." / ".$tipe_peti_kemas,
            'User Input' => $inbound_id ?? '',
        ]);

            $angka = $angka + 1;
            $angkastart = $angkastart + 1;
        }


        return collect($myarray);
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
            'Status Faktur Pajak',
            'Parsial',
            'Kantor Pabean',
            'Jenis TPB',
            'Sarana Angkut',
            'No Polisi',
            'Jumlah Dokumen',
            'Jumlah Barang',
            'Total Qty Barang',
            'Berat Bersih',
            'Berat Kotor',
            'Pelabuhan Muat',
            'Pelabuhan Transit',
            'Pelabuhan Bongkar',
            'FOB',
            'Freight',
            'Asuransi',
            'Valuta',
            'NDPBM',
            'Nilai CIF',
            'Tempat Timbun',
            'Peti Kemas (Nomor/ Ukuran Tipe)',
            'User Input'
        ];
    }

}
