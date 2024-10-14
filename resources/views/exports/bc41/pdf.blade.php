
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    .letter-a4 {
        padding: 30px 20px 30px 20px;
    }

    .m-cell {
        padding: 5px 10px 5px 10px;
    }

    .m-top {
        padding: 10px 20px 10px 20px;
    }

    .w-full {
        width: 100%;
    }

    .w-85p {
        width: 85%;
    }

    .w-70p {
        width: 70%;
    }

    .w-50p {
        width: 50%;
    }

    .w-45p {
        width: 45%;
    }

    .w-55p {
        width: 55%;
    }

    .w-60p {
        width: 60% !important;
    }

    .w-65p {
        width: 65% !important;
    }

    .w-25p {
        width: 25%;
    }

    .w-35p {
        width: 35%;
    }


    .w-30p {
        width: 30%;
    }

    .w-33p {
        width: 33%;
    }

    .w-15p {
        width: 15%;
    }

    .w-10p {
        width: 10%;
    }

    .w-5p {
        width: 5%;
    }

    .no-spacing-border {
        border-spacing: 0;
    }

    .no-padmar {
        padding: 0;
        margin: 0;
    }

    .border {
        border: 1px solid #000;
    }

    .text-center {
        text-align: center;
    }

    .text-lg {
        font-size: 22px;
    }

    .text-md {
        font-size: 14px;
    }

    .text-sm {
        font-size: 12px;
    }

    .text-xs {
        font-size: 10px;
    }

    .pull-right {
        float: right;
    }

    .pull-left {
        float: left;
    }

    .page_break {
        page-break-before: always;
    }
</style>
</head>

<div class="container">
    <div class="page-1 letter-a4">
        <table class="w-full no-spacing-border">
            <tr>
                <td class="border w-15p">
                    <p class="m-top text-center text-lg">
                        BC 4.1
                    </p>
                </td>
                <td class="border w-85p">
                    <p class="text-md text-center m-top">
                        PEMBERITAHUAN PENGELUARAN KEMBALI BARANG ASAL TEMPAT LAIN DALAM DAERAH
                        PABEAN DARI TEMPAT PENIMBUNAN BERIKAT
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="border">
                    <p class="m-cell text-md">HEADER</p>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="border">

                    <div class="m-cell">

                        <table class="w-full">
                            <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                <p class="text-sm">Nomor Pengajuan</p>
                                            </td>
                                            <td>
                                                <p class="text-sm">
                                                    : {{ $outbound->request_number ?? ''}}
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="text-sm">A. KANTOR PABEAN</p>
                                            </td>
                                            <td>
                                                <p class="text-sm">: {{ $outbound->outboundKppbc->masterKppbc->description ?? ''}}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="text-sm">B. JENIS TPB</p>
                                            </td>
                                            <td>
                                                <p class="text-sm">: {{ $outbound->outboundJenisTpb->masterJenisTpb->name ?? '' }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="text-sm">C. TUJUAN PENGIRIMAN</p>
                                            </td>
                                            <td>
                                                <p class="text-sm">: {{ $outbound->outboundTujuanPengiriman->masterTujuanPengiriman->name ?? '' }}</p>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                                <td>
                                    <span class="text-sm pull-right">Halaman 1 dari 3</span>
                                    <br>
                                    <table class="border w-full m-cell">
                                        <tr>
                                            <td colspan="2">
                                                <p class="text-sm">
                                                    F. KOLOM KHUSUS BEA DAN CUKAI
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="text-sm">
                                                    Nomor Pendaftaran
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-sm">
                                                    :
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <p class="text-sm">
                                                    Tanggal
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-sm">
                                                    :
                                                </p>
                                            </td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                        </table>

                    </div>


                </td>
            </tr>
            <tr>
                <td colspan="2" class="border">
                    <p class="text-md m-cell">D. DATA PEMBERITAHUAN</p>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="no-padmar">

                    <table class="no-spacing-border w-full">
                        <tr>
                            <td class="border w-50p">
                                <p class="text-md m-cell">PENGUSAHA TPB</p>
                            </td>
                            <td class="border w-50p">
                                <p class="text-md m-cell">PENERIMA BARANG</p>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>

            <tr>
                <td colspan="2" class="no-padmar">
                    <table class="w-full no-spacing-border">
                        <tr>
                            <td class="border w-50p m-cell">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-sm">1. NPWP</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundTpb->profile->details['nomor_identitas'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">2. Nama</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundTpb->profile->name ?? '' }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">3. Alamat</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundTpb->profile->address ?? '' }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">4. No izin TPB</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundTpb->profile->details['nomor_izin'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td class="border w-50p m-cell">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-sm">5. NPWP</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundPengirimBarang->profile->details['nomor_identitas'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">2. Nama</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundPengirimBarang->profile->name ?? '' }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">3. Alamat</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundPengirimBarang->profile->address ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="border">
                    <p class="text-md m-cell">DOKUMEN PELENGKAP PABEAN</p>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="border">
                    <table class="no-spacing-border w-full">
                        <tr>
                            <td class="w-50p m-cell">
                                <table class="w-full no-spacing-border">
                                    <tr>
                                        <td class="w-25p" >
                                            <p class="text-sm">8. Packing List</p>
                                        </td>
                                        <td class="w-30p">
                                            @foreach($outbound->outboundDocuments as $outboundDocument)
                                                <p class="text-sm">{{$outboundDocument->document_id == 1 ? ": ".$outboundDocument->details['nomor_dokumen'] : ''}}</p>
                                            @endforeach
                                        </td>
                                        <td class="w-5p">
                                            <p class="text-sm">Tgl</p>
                                        </td>
                                        <td class="w-30p">
                                            @foreach($outbound->outboundDocuments as $outboundDocument)
                                                <p class="text-sm">{{$outboundDocument->document_id == 1 ? ": ".$outboundDocument->details['date'] : ''}}</p>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-25p">
                                            <p class="text-sm">9. Kontrak</p>
                                        </td>
                                        <td class="w-30p">
                                            @foreach($outbound->outboundDocuments as $outboundDocument)
                                                <p class="text-sm">{{$outboundDocument->document_id == 2 ? ": ".$outboundDocument->details['nomor_dokumen'] : ''}}</p>
                                            @endforeach
                                        </td>
                                        <td class="w-5p">
                                            <p class="text-sm">Tgl</p>
                                        </td>
                                        <td class="w-20p">
                                            @foreach($outbound->outboundDocuments as $outboundDocument)
                                                <p class="text-sm">{{$outboundDocument->document_id == 2 ? ": ".$outboundDocument->details['date'] : ''}}</p>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-25p">
                                            <p class="text-sm">10. Faktur Pajak</p>
                                        </td>
                                        <td class="w-30p">
                                            @foreach($outbound->outboundDocuments as $outboundDocument)
                                                <p class="text-sm">{{$outboundDocument->document_id == 3 ? ": ".$outboundDocument->details['nomor_dokumen'] : ''}}</p>
                                            @endforeach
                                        </td>
                                        <td class="w-5p">
                                            <p class="text-sm">Tgl</p>
                                        </td>
                                        <td class="w-20p">
                                            @foreach($outbound->outboundDocuments as $outboundDocument)
                                                <p class="text-sm">{{$outboundDocument->document_id == 3 ? ": ".$outboundDocument->details['date'] : ''}}</p>
                                            @endforeach
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td class="w-50p m-cell">
                                <table class="w-full no-spacing-border">
                                    <tr>
                                        <td class="w-60p">
                                            <p class="text-sm">11. Surat Keputusan/Persetujuan</p>
                                        </td>
                                        <td class="w-5p">
                                            @foreach($outbound->outboundDocuments as $outboundDocument)
                                                <p class="text-sm">{{$outboundDocument->document_id == 142 ? ": ". $outboundDocument->details['nomor_dokumen'] : ''}}</p>
                                            @endforeach
                                        </td>
                                        <td class="w-5p">
                                            <p class="text-sm">Tgl</p>
                                        </td>
                                        <td class="w-25p">
                                            @foreach($outbound->outboundDocuments as $outboundDocument)
                                                <p class="text-sm">{{$outboundDocument->document_id == 142 ? ": ". $outboundDocument->details['date'] : ''}}</p>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-40p">
                                            <p class="text-sm">12. Jenis / Nomor dokumen lainnya</p>
                                        </td>
                                        <td class="w-30p">
                                            <p class="text-sm">:</p>
                                        </td>
                                        <td class="w-5p">
                                            <p class="text-sm">Tgl</p>
                                        </td>
                                        <td class="w-20p">
                                            <p class="text-sm">.</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="border">
                    <p class="text-md m-cell">RIWAYAT BARANG</p>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="border">
                    <table class="no-spacing-border w-full">
                        <tr>
                            <td class="w-50p m-cell">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-sm">13. Nomor dan Tanggal BC 4.0 asal</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->details['nomor_pendaftaran'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td class="w-50p m-cell">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-sm">Tgl</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">.  {{ $outbound->details['tanggal_pendaftaran'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="border">
                    <p class="text-md m-cell">DATA PENGANGKUTAN</p>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="border">
                    <table class="w-full no-spacing-border">
                        <tr>
                            <td class="w-50p m-cell">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-sm">14. Jenis Sarana Pengangkut Darat</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundTransportation->transportation->name ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td class="w-50p m-cell">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-sm">15. No Polisi</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundTransportation->vehicle_number ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="border">
                    <p class="text-md m-cell">DATA PERDAGANGAN</p>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="border">
                    <table class="w-full no-spacing-border">
                        <tr>
                            <td class="w-50p m-cell">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-sm">16. Harga Penyerahan</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: Rp {{ $outbound->details['harga_penyerahan'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="border">
                    <p class="text-md m-cell">DATA PENGEMAS</p>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="border">
                    <table class="no-spacing-border w-full">
                        <tr>
                            <td class="w-50p m-cell">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-sm">17. Jenis Kemasan</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundDetails[0]->package->name ?? '' }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">18. Merek Kemasan</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundDetails[0]->package_details['merk'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td class="w-50p m-cell">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-sm">19. Jumlah Kemasan</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundDetails[0]->package_details['jumlah'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="border">
                    <p class="text-md m-cell">DATA BARANG</p>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="border">
                    <table class="w-full no-spacing-border">
                        <tr>
                            <td class="w-33p m-cell">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-sm">20. Volume (m3)</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->details['volume'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td class="w-33p m-cell">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-sm">21. Berat Kotor (Kg)</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->details['berat_kotor'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 33%;padding:5px 10px 5px 10px">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-sm">22. Berat Bersih (Kg)</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->details['berat_bersih'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <table class="w-full no-spacing-border">
                        <tr>
                            <td class="border w-5p m-cell">
                                <p class="text-sm">
                                    23
                                </p>
                                <p class="text-sm">
                                    No.
                                </p>
                            </td>
                            <td class="border w-40p m-cell">
                                <p class="text-sm">
                                    24
                                </p>
                                <p class="text-sm">
                                    Uraian jumlah dan jenis barang secara lengkap, kode barang,
                                    merk, tipe, ukuran, dan spesifikasi lain
                                </p>
                            </td>
                            <td class="border w-25p m-cell">
                                <p class="text-sm">
                                    25
                                </p>
                                <p class="text-sm">
                                    - Jumlah & Jenis Satuan
                                    - Berat Bersih (Kg)
                                    - Volume(m3)
                                </p>
                            </td>
                            <td class="border w-25p m-cell">
                                <p class="text-sm">
                                    26
                                </p>
                                <p class="text-sm">
                                    - Harga penyerahan (Rp)
                                </p>
                            </td>

                        </tr>
                        @foreach($outbound->outboundDetails as $key=>$outboundDetail)
                        <tr>
                            <td class="border w-5p m-cell">
                                <p class="text-sm">
                                    {{ $key + 1 }}
                                </p>
                            </td>
                            <td class="border w-40p m-cell">
                                <p class="text-sm">
                                    {{ '- Kode Barang : ' . $outboundDetail->good->details['kode_barang'] ?? '' }}
                                </p>
                                <p class="text-sm">
                                    - {{ $outboundDetail->good->name ?? '' }},
                                    Merek : {{ $outboundDetail->good->details['merk'] ?? '' }},
                                    Tipe : {{ $outboundDetail->good->details['type'] ?? '' }},
                                    Ukuran : {{ $outboundDetail->good->details['ukuran'] ?? '' }},
                                    Spesifikasi lain : {{ $outboundDetail->good->details['spesifikasi_lain'] ?? '' }},
                                </p>

                            </td>
                            <td class="border w-25p m-cell">
                                <p class="text-sm">
                                    - {{ $outboundDetail->quantity . ' ' .  $outboundDetail->good->uom->name  }}
                                </p>
                                <p class="text-sm">
                                    - {{ $outboundDetail->good->nett_weight ?? '' }}
                                </p>
                                <p class="text-sm">
                                    - {{ $outboundDetail->volume  ?? ''}}
                                </p>
                            </td>
                            <td class="border w-25p m-cell">
                                <p class="text-sm">
                                    Rp {{ $outboundDetail->details['harga_penyerahan'] ?? '' }}
                                </p>
                            </td>

                            </tr>

                        @endforeach
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="no-padmar">

                    <table class="w-full no-spacing-border">
                        <tr>
                            <td class="border w-50p">
                                <p class="text-md m-cell">G. UNTUK PEJABAT BAE DAN CUKAI</p>
                            </td>
                            <td class="border w-50p">
                                <p class="text-md m-cell">E. TANDA TANGAN PENGUSAHA TPB</p>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <table class="w-full no-spacing-border">
                        <tr>
                            <td class="border w-50p m-cell">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-sm">Nama</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">:</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">NIP</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">:</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td class="border w-50p m-cell">
                                <p class="text-sm">
                                    Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal
                                    yang diberitahukan dalam pemberitahuan pabean ini.
                                </p>
                                <br>
                                <p class="text-sm text-center">
                                    {{ $outbound->city->city ?? '' }}, {{ $outbound->details['pabean_tanggal'] ?? '' }}
                                </p>
                                <br><br>
                                <p class="text-sm text-center">
                                    {{ $outbound->details['pabean_pemberitahu'] ?? '' }}
                                </p>
                                <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

        </table>
        <span class="text-xs">Rangkap ke-1 / 2 / 3 : Kantor Pabean / Pengusaha TPB / Pengirim Barang</span>

    </div>

    <div class="page_break"></div>

    <div class="page-2 letter-a4">
        <table class="w-full no-spacing-border">
            <tr>
                <td class="border w-15p">
                    <p class="m-top text-center text-lg">
                        BC 4.1
                    </p>
                </td>
                <td class="border w-85p">
                    <p class="text-md text-center m-top">
                        LEMBAR LANJUTAN<br>
                        DOKUMEN PELENGKAP PABEAN
                    </p>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="border">
                    <p class="m-cell text-md">HEADER</p>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="border">

                    <div class="m-cell">

                        <table class="w-full">
                            <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                <p class="text-sm">Nomor Pengajuan</p>
                                            </td>
                                            <td>
                                                <p class="text-sm">
                                                    : {{ $outbound->request_number ?? ''}}
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="text-sm">A. KANTOR PABEAN</p>
                                            </td>
                                            <td>
                                                <p class="text-sm">: {{ $outbound->outboundKppbc->masterKppbc->description ?? ''}}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="text-sm">B. JENIS TPB</p>
                                            </td>
                                            <td>
                                                <p class="text-sm">: {{ $outbound->outboundJenisTpb->masterJenisTpb->name ?? '' }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="text-sm">C. TUJUAN PENGIRIMAN</p>
                                            </td>
                                            <td>
                                                <p class="text-sm">: {{ $outbound->outboundTujuanPengiriman->masterTujuanPengiriman->name ?? '' }}</p>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                                <td>
                                    <span class="text-sm pull-right">Halaman 1 dari 3</span>
                                    <br>
                                    <table class="border w-full m-cell">
                                        <tr>
                                            <td colspan="2">
                                                <p class="text-sm">
                                                    F. KOLOM KHUSUS BEA DAN CUKAI
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="text-sm">
                                                    Nomor Pendaftaran
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-sm">
                                                    :
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <p class="text-sm">
                                                    Tanggal
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-sm">
                                                    :
                                                </p>
                                            </td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                        </table>

                    </div>


                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <table class="w-full no-spacing-border">
                        <tr>
                            <td class="border w-5p m-cell">
                                <p class="text-sm">
                                    No.
                                </p>
                            </td>
                            <td class="border w-40p m-cell">
                                <p class="text-sm">
                                    JENIS DOKUMEN
                                </p>
                            </td>
                            <td class="border w-25p m-cell">
                                <p class="text-sm">
                                    NOMOR
                                </p>
                            </td>
                            <td class="border w-25p m-cell">
                                <p class="text-sm">
                                    TANGGAL
                                </p>
                            </td>

                        </tr>
                        @foreach($outbound->outboundDocuments as $key=>$outboundDocument)
                            <tr>
                                <td class="border w-5p m-cell">
                                    <p class="text-sm">
                                        {{ $key + 1 }}
                                    </p>
                                </td>
                                <td class="border w-40p m-cell">
                                    <p class="text-sm">
                                        {{ $outboundDocument->masterDocument->name }}
                                    </p>
                                </td>
                                <td class="border w-25p m-cell">
                                    <p class="text-sm">
                                        {{ $outboundDocument->details['nomor_dokumen'] }}
                                    </p>
                                </td>
                                <td class="border w-25p m-cell">
                                    <p class="text-sm">
                                        {{ $outboundDocument->details['date'] }}
                                    </p>
                                </td>

                            </tr>
                        @endforeach
                        @if(count($outbound->outboundDocuments) == 0)
                            <tr>
                                <td class="border w-5p m-top">
                                    <p class="text-sm">

                                    </p>
                                </td>
                                <td class="border w-40p m-top">
                                    <p class="text-sm">

                                    </p>
                                </td>
                                <td class="border w-25p m-top">
                                    <p class="text-sm">

                                    </p>
                                </td>
                                <td class="border w-25p m-top">
                                    <p class="text-sm">

                                    </p>
                                </td>

                            </tr>
                        @endif
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="no-padmar border">

                    <table class="w-full no-spacing-border">
                        <tr>
                            <td class=" w-50p"></td>
                            <td class=" w-50p">
                                <p class="text-md m-cell">E. TANDA TANGAN PENGUSAHA TPB</p>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>

            <tr>
                <td colspan="2" class="border">
                    <table class="w-full no-spacing-border">
                        <tr>
                            <td class="border w-50p m-cell">
                            </td>
                            <td class="border w-50p m-cell">
                                <p class="text-sm">
                                    Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal
                                    yang diberitahukan dalam pemberitahuan pabean ini.
                                </p>
                                <br>
                                <p class="text-sm text-center">
                                    {{ $outbound->city->city ?? ''}}, {{ $outbound->details['pabean_tanggal'] ?? '' }}
                                </p>
                                <br><br>
                                <p class="text-sm text-center">
                                    {{ $outbound->details['pabean_pemberitahu'] ?? '' }}
                                </p>
                                <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

        </table>
        <span class="text-xs">Rangkap ke-1 / 2 / 3 : Kantor Pabean / Pengusaha TPB / Pengirim Barang</span>
    </div>

    <div class="page_break"></div>

    <div class="page-3 letter-a4">
        <table class="w-full no-spacing-border">
            <tr>
                <td class="border w-15p">
                    <p class="m-top text-center text-lg">
                        BC 4.1
                    </p>
                </td>
                <td class="border w-85p">
                    <p class="text-md text-center m-top">
                        LEMBAR LAMPIRAN<br>
                        KONVERSI PEMAKAIAN BAHAN
                    </p>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="border">
                    <p class="m-cell text-md">HEADER</p>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="border m-cell">
                    <table class="w-full">
                        <tr>
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-sm">Nomor Pengajuan</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">
                                                : {{ $outbound->request_number ?? ''}}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <p class="text-sm">A. KANTOR PABEAN</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundKppbc->masterKppbc->description ?? ''}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">B. JENIS TPB</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundJenisTpb->masterJenisTpb->name ?? '' }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">C. TUJUAN PENGIRIMAN</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundTujuanPengiriman->masterTujuanPengiriman->name ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>

                            <td>
                                <span class="text-sm pull-right">Halaman 1 dari 3</span>
                                <br>
                                <table class="border w-full m-cell">
                                    <tr>
                                        <td colspan="2">
                                            <p class="text-sm">
                                                F. KOLOM KHUSUS BEA DAN CUKAI
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">
                                                Nomor Pendaftaran
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm">
                                                :
                                            </p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <p class="text-sm">
                                                Tanggal
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm">
                                                :
                                            </p>
                                        </td>
                                    </tr>

                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="no-padmar">
                    
                    <table class="w-full no-spacing-border">
                        <tr>
                            <td class="border w-50p">
                                <p class="text-md m-cell text-center">Barang Jadi</p>
                            </td>
                            <td class="border w-50p">
                                <p class="text-md m-cell text-center">Bahan baku yang digunakan</p>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>

            <tr>
                <td colspan="2" class="no-padmar">

                    <table class="w-full no-spacing-border">
                        <tr>
                            <td class="border m-cell" style="max-width: 5% !important; width: 5% !important">
                                <p class="text-sm">No</p>
                            </td>
                            <td class="border m-cell" style="max-width: 25% !important; width: 25% !important">
                                <p class="text-sm">
                                    Uraian jumlah dan jenis barang secara lengkap, kode barang, merk, tipe, ukuran, dan spesifikasi lain
                                </p>
                            </td>
                            <td class="border m-cell" style="max-width: 10% !important; width: 10% !important">
                                <p class="text-sm">
                                    Jumlah
                                </p>
                            </td>
                            <td class="border m-cell" style="max-width: 10% !important; width: 10% !important">
                                <p class="text-sm">
                                    Satuan
                                </p>
                            </td>
                            <td class="border m-cell" style="max-width: 30% !important; width: 30% !important">
                                <p class="text-sm">
                                    Uraian jumlah dan jenis barang secara lengkap, kode barang, merk, tipe, ukuran, dan spesifikasi lain
                                </p>
                            </td>
                            <td class="border m-cell" style="max-width: 10% !important; width: 10% !important">
                                <p class="text-sm">
                                    Jumlah
                                </p>
                            </td>
                            <td class="border m-cell" style="max-width: 10% !important; width: 10% !important">
                                <p class="text-sm">
                                    Satuan
                                </p>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>
            @foreach($outbound->outboundDetails as $key=>$outboundDetail) 
            <?php $count = count($outboundDetail->inventoryOutboundDetail);?>
                @foreach($outboundDetail->inventoryOutboundDetail as $key1=>$inventoryOutboundDetail)
                <table class="w-full no-spacing-border">
                    <tr>
                        <td class="border m-cell" style="max-width: 5% !important; width: 5% !important">
                            <p class="text-sm">{{ $key + 1 }}.{{ $key1 + 1 }}</p>
                        </td>
                        <td class="border m-cell" style="max-width: 25% !important; width: 25% !important">
                            <p class="text-sm">
                                {{ '- Kode Barang : ' . $outboundDetail->good->details['kode_barang'] ?? '' }}
                            </p>
                            <p class="text-sm">
                                - {{ $outboundDetail->good->name ?? '' }},
                                Merek : {{ $outboundDetail->good->details['merk'] ?? '' }},
                                Tipe : {{ $outboundDetail->good->details['type'] ?? '' }},
                                Ukuran : {{ $outboundDetail->good->details['ukuran'] ?? '' }},
                                Spesifikasi lain : {{ $outboundDetail->good->details['spesifikasi_lain'] ?? '' }},
                            </p>
                        </td>
                        <td class="border m-cell" style="max-width: 10% !important; width: 10% !important">
                            <p class="text-sm">
                                {{ $outboundDetail->quantity ?? '' }}
                            </p>
                        </td>
                        <td class="border m-cell" style="max-width: 10% !important; width: 10% !important">
                            <p class="text-sm">
                                {{ $outboundDetail->good->uom->name ?? '' }}
                            </p>
                        </td>
                        {{-- <td> --}}
                    {{-- </tr> --}}
                       

                                {{-- <table class="w-full no-spacing-border" > --}}

                                    {{-- <tr> --}}
                                        <td class="border m-cell" style="max-width: 30% !important; width: 30% !important" >

                                            <p class="text-sm">
                                                - {{ $inventoryOutboundDetail->good->name ?? '' }},
                                                Merek : {{ $inventoryOutboundDetail->good->details['merk'] ?? '' }},
                                                Tipe : {{ $inventoryOutboundDetail->good->details['type'] ?? '' }},
                                                Ukuran : {{ $inventoryOutboundDetail->good->details['ukuran'] ?? '' }},
                                                Spesifikasi lain : {{ $inventoryOutboundDetail->good->details['spesifikasi_lain'] ?? '' }},
                                            </p><br>
                                        </td>
                                        <td class="border m-cell" style="max-width: 10% !important; width: 10% !important">
                                            <p class="text-sm">
                                                {{ $inventoryOutboundDetail->quantity_good_conversion ?? '' }}
                                            </p><br>
                                        </td>
                                        <td class="border m-cell" style="max-width: 10% !important; width: 10% !important">
                                            <p class="text-sm">
                                                {{ $inventoryOutboundDetail->inboundDetail->good->uom->name ?? '' }}
                                            </p><br>
                                        </td>
                                    {{-- </tr> --}}

                                {{-- </table> --}}

                        {{-- </td> --}}


                </table>
                        @endforeach
            @endforeach

        <table class="w-full no-spacing-border">
            <tr>
                <td colspan="2" class="no-padmar border">

                    <table class="w-full no-spacing-border">
                        <tr>
                            <td class=" w-50p"></td>
                            <td class=" w-50p">
                                <p class="text-md m-cell">E. TANDA TANGAN PENGUSAHA TPB</p>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>

            <tr>
                <td colspan="2" class="border">
                    <table class="w-full no-spacing-border">
                        <tr>
                            <td class="w-50p m-cell">
                            </td>
                            <td class="w-50p m-cell">
                                <p class="text-sm">
                                    Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal
                                    yang diberitahukan dalam pemberitahuan pabean ini.
                                </p>
                                <br>
                                <p class="text-sm text-center">
                                    {{ $outbound->city->city ?? ''}}, {{ $outbound->details['pabean_tanggal'] ?? '' }}
                                </p>
                                <br><br>
                                <p class="text-sm text-center">
                                    {{ $outbound->details['pabean_pemberitahu'] ?? ''}}
                                </p>
                                <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <span class="text-xs">Rangkap ke-1 / 2 / 3 : Kantor Pabean / Pengusaha TPB / Pengirim Barang</span>
    </div>


</div>

</html>
