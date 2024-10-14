<?php

namespace App\Exports;

use App\Models\Inbound;
use Illuminate\Validation\Rules\In;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use phpDocumentor\Reflection\Types\Collection;

class BC40Export implements FromCollection,WithHeadings,WithMapping
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

        return new Inbound([
            'id' => $row[0],
        ]);
    }


    public function collection()
    {

        return $this->query;
    }

    private $rows = 0;


    public function map($inbound) : array {
        $res = [];
        $quantity = ($inbound->inboundDetails->pluck('quantity'));
        $good = ($inbound->inboundDetails->pluck('good.name'));
        for($i = 0 ; $i < $quantity->count(); $i++){
           array_push($res,$good[$i].'('.$quantity[$i].')');

        }
        $res = collect($res);

        return [
            ++$this->rows,
            $inbound->bcForm->name ?? '',
            $inbound->request_number ?? '',
            $inbound->created_at ?? '',
            $inbound->details['nomor_pendaftaran'] ?? '',
            $inbound->details['tanggal_pendaftaran'] ?? '',
            $inbound->faktur_pajak == 0 ? 'IN PROGRESS' : 'DONE',
            $inbound->partial == 1 ?'IN PROGRESS' : 'DONE',
            $outbound->city->city ?? '',
            $inbound->inboundJenisTpb->masterJenisTpb->name ?? '',
            $inbound->inboundTujuanPengiriman->masterTujuanPengiriman->name ?? '',
            $inbound->inboundTpb->profile->name ?? '',
            $inbound->inboundPengirimBarang->profile->name ?? '',
            $inbound->inboundTransportation->transportation->name ?? '',
            $inbound->inboundTransportation->vehicle_number ?? '',
            $inbound->details['harga_penyerahan'] ?? '',
            $inbound->inboundDocuments->pluck('document_id')->unique()->count(),
            $res->implode(','),
            $inbound->inboundDetails->sum('quantity'),
            $inbound->details['volume'] ?? '',
            $inbound->details['berat_bersih'] ?? '',
            $inbound->details['berat_kotor'] ??'',
            $inbound->id ? $inbound->id : '',
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
