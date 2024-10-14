<?php

namespace App\Exports;



use App\Models\Outbound;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use phpDocumentor\Reflection\Types\Collection;

class BC41Export implements FromCollection,WithHeadings,WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($query)
    {

        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $query = $query->where('created_by',$user->id);
        }
        $this->query = $query;
    }


    public function model(array $row)
    {
        ++$this->rows;

        return new Outbound([
            'id' => $row[0],
        ]);
    }


    public function collection()
    {
        return $this->query;
    }

    private $rows = 0;


    public function map($outbound) : array {
        $res = [];
        $quantity = ($outbound->outboundDetails->pluck('quantity'));
        $good = ($outbound->outboundDetails->pluck('good.name'));
        for($i = 0 ; $i < $quantity->count(); $i++){
            array_push($res,$good[$i].'('.$quantity[$i].')');

        }
        $res = collect($res);


        return [
            ++$this->rows,
            $outbound->bcForm->name ?? '',
            $outbound->request_number ?? '',
            $outbound->created_at ?? '',
            $outbound->details['nomor_pendaftaran'] ?? '',
            $outbound->details['tanggal_pendaftaran'] ?? '',
            $outbound->faktur_pajak == 0 ? 'IN PROGRESS' : 'DONE',
            $outbound->partial == 1 ?'IN PROGRESS' : 'DONE',
            $outbound->city->city ?? '',
            $outbound->outboundJenisTpb->masterJenisTpb->name ?? '',
            $outbound->outboundTujuanPengiriman->masterTujuanPengiriman->name ?? '',
            $outbound->outboundTpb->profile->name ?? '',
            $outbound->outboundPengirimBarang->profile->name ?? '',
            $outbound->outboundTransportation->transportation->name ?? '',
            $outbound->outboundTransportation->vehicle_number ?? '',
            $outbound->details['harga_penyerahan'] ?? '',
            $outbound->outboundDocuments->pluck('document_id')->unique()->count(),
            $res->implode(','),
            $outbound->outboundDetails->sum('quantity') ,
            $outbound->details['volume'] ?? '',
            $outbound->details['berat_bersih'] ?? '',
            $outbound->details['berat_kotor'] ??'',
            $outbound->id ?? '',
        ];

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
        ] ;
    }
}
