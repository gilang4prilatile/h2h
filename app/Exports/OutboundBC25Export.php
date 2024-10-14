<?php

namespace App\Exports;

use App\Models\Outbound;
use App\Models\OutboundJenisTpb;
use App\Models\OutboundTujuanPengiriman;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use function Composer\Autoload\includeFile;

class OutboundBC25Export implements FromCollection,WithHeadings
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

        $outbound = $this->query;


        $angkastart = 0;
        $angka = 1;
        $myarray = [];
        foreach($outbound as $outbound){

            $outbound_id = $outbound['id'];


            $outbounddata = DB::table('outbounds')->where('id','=',$outbound_id)->first();
            $outbound_details = json_decode($outbounddata->details, true);

            // $outbound
            $outbound_jenis_tpb = DB::table('outbound_jenis_tpbs')->where('outbound_id','=',$outbound_id)->first();
            $jenis_tpb = DB::table('master_jenis_tpb')->where('id','=',$outbound_jenis_tpb->jenis_tpb_id)->first();


            if($outbound->faktur_pajak == 0){
                $status_pajak = "IN PROGRESS";
            }
            else{
                $status_pajak = "DONE";
            }

            if($outbound->partial == 1){
                $partial = "IN PROGRESS";
            }
            else{
                $partial = "DONE";
            }


           $outbound_transportation = DB::table('outbound_transport_lines')->where('outbound_id','=',$outbound_id)->first();
           $sarana_angkut = DB::table('transportations')->where('id','=',$outbound_transportation->transport_line_id)->first();

            $jumlah_dokumen = DB::table('outbound_documents')->where('outbound_id','=',$outbound_id)->count();
            $arraybarang = [];

            $barangnya = DB::table('outbound_details')->where('outbound_id','=',$outbound_id)->get();
            $jumlah_qty = 0;

            foreach($barangnya as $barangnya){
                $jumlah_qty = $jumlah_qty + $barangnya->quantity;
                $goods = DB::table('goods')->where('id','=',$barangnya->good_id)->first();

                array_push($arraybarang,$goods->name." (".$barangnya->quantity.")");
            }

            $arraybarang = collect($arraybarang);

            array_push($myarray,[
                'No' => $angka,
                'Tipe BC' => 'BC25',
                'No Pengajuan' => $outbound->request_number ?? '',
                'Tanggal Masuk' => $outbound->created_at ?? '',
                'No Pendaftaran' => $outbound_details['nomor_pendaftaran'] ?? '',
                'Tanggal Pendaftaran' => $outbound_details["tanggal_pendaftaran"] ?? '',
                'Status Faktur Pajak' => $status_pajak ?? '',
                'Parsial' => $partial ?? '',
                'Kantor Pabean' => $outbound_details["pabean_tempat"] ?? '',
                'Jenis TPB' => $jenis_tpb->name ?? '',
                'Tujuan Pengiriman' => $outbound->outboundTujuanPengiriman->masterTujuanPengiriman->name ?? '',
                'Pengusaha TPB' => $outbound->outboundTpb->profile->name ?? '',
                'Pengirim Barang' => $outbound->outboundPengirimBarang->profile->name ?? '',
                'Sarana Angkut' => $sarana_angkut->name ?? '',
                'No Polisi' => $outbound_transportation->vehicle_number ?? '',
                'Harga Penyerahan' => $outbound_details['harga_penyerahan'] ?? '',
                'Jumlah Dokumen' => $jumlah_dokumen ?? '',
                'Jumlah Barang' => $arraybarang->implode(',') ?? '',
                'Total Qty Barang' => $jumlah_qty ?? '',
                'Volume' => $outbound_details['volume'] ?? '',
                'Berat Bersih' => $outbound_details["berat_bersih"] ?? '',
                'Berat Kotor' => $outbound_details["berat_kotor"] ?? '',
                'User Input' => $outbound_id ?? '',
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
            'Tujuan Pengiriman',
            'Pengusaha TPB',
            'Pengirim Barang',
            'Sarana Angkut',
            'No Polisi',
            'Harga Penyerahan',
            'Jumlah Dokumen',
            'Jumlah Barang',
            'Total Qty Barang',
            'Volume',
            'Berat Bersih',
            'Berat Kotor',
            'User Input',
        ];
    }

}
