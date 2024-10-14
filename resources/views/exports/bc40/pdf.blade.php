<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

<body>
    <div class="container">
        <div class="page-1 letter-a4">
            <table class="w-full no-spacing-border">
                <tr>
                    <td class="border w-15p">
                        <p class="m-top text-center text-lg">
                            BC 4.0
                        </p>
                    </td>
                    <td class="border w-85p">
                        <p class="text-md text-center m-top">
                            PEMBERITAHUAN PEMASUKAN BARANG ASAL TEMPAT LAIN DALAM DAERAH PABEAN KE
                            TEMPAT PENIMBUNAN BERIKAT
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
                                                        : {{ $inbound->request_number ?? ''}}
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p class="text-sm">A. KANTOR PABEAN</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm">: {{ $inbound->inboundKppbc->masterKppbc->description ?? ''}}</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p class="text-sm">B. JENIS TPB</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm">: {{ $inbound->inboundJenisTpb->masterJenisTpb->name ?? '' }}</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p class="text-sm">C. TUJUAN PENGIRIMAN</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm">: {{ $inbound->inboundTujuanPengiriman->masterTujuanPengiriman->name ?? '' }}</p>
                                                </td>
                                            </tr>
                                        </table>

                                    </td>
                                    <td>
                                        <span class="text-sm pull-right">Halaman ke-1 dari 3</span>
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
                                    <p class="text-md m-cell">PENGIRIM BARANG</p>
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
                                                <p class="text-sm">: {{ $inbound->inboundTpb->profile->details['nomor_identitas'] ?? '' }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="text-sm">2. Nama</p>
                                            </td>
                                            <td>
                                                <p class="text-sm">: {{ $inbound->inboundTpb->profile->name ?? '' }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="text-sm">3. Alamat</p>
                                            </td>
                                            <td>
                                                <p class="text-sm">: {{ $inbound->inboundTpb->profile->address ?? '' }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="text-sm">4. No izin TPB</p>
                                            </td>
                                            <td>
                                                <p class="text-sm">: {{ $inbound->inboundTpb->profile->details['nomor_izin'] ?? '' }}</p>
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
                                                <p class="text-sm">: {{ $inbound->inboundPengirimBarang->profile->details['nomor_identitas'] ?? '' }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="text-sm">2. Nama</p>
                                            </td>
                                            <td>
                                                <p class="text-sm">: {{ $inbound->inboundPengirimBarang->profile->name ?? '' }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="text-sm">3. Alamat</p>
                                            </td>
                                            <td>
                                                <p class="text-sm">: {{ $inbound->inboundPengirimBarang->profile->address ?? '' }}</p>
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
                                            <td class="w-25p">
                                                <p class="text-sm">8. Packing List</p>
                                            </td>
                                            <td class="w-30p">@foreach($inbound->inboundDocuments as $inboundDocument)
                                                <p class="text-sm">{{$inboundDocument->document_id == 1 ? ": ". $inboundDocument->details['nomor_dokumen'] : ''}}</p>
                                                @endforeach
                                            </td>
                                            <td class="w-5p">
                                                <p class="text-sm">Tgl</p>
                                            </td>
                                            <td class="w-20p">@foreach($inbound->inboundDocuments as $inboundDocument)
                                                <p class="text-sm">{{$inboundDocument->document_id == 1 ? ": ". $inboundDocument->details['date'] : ''}}</p>
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-25p">
                                                <p class="text-sm">9. Kontrak</p>
                                            </td>
                                            <td class="w-30p">@foreach($inbound->inboundDocuments as $inboundDocument)
                                                <p class="text-sm">{{$inboundDocument->document_id == 2 ? ": ". $inboundDocument->details['nomor_dokumen'] : ''}}</p>
                                                @endforeach
                                            </td>
                                            <td class="w-5p">
                                                <p class="text-sm">Tgl</p>
                                            </td>
                                            <td class="w-20p">@foreach($inbound->inboundDocuments as $inboundDocument)
                                                <p class="text-sm">{{$inboundDocument->document_id == 2 ? ": ". $inboundDocument->details['date'] : ''}}</p>
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-25p">
                                                <p class="text-sm">10. Faktur Fajak</p>
                                            </td>
                                            <td class="w-30p">@foreach($inbound->inboundDocuments as $inboundDocument)
                                                <p class="text-sm">{{$inboundDocument->document_id == 3 ? ": ". $inboundDocument->details['nomor_dokumen'] : ''}}</p>
                                                @endforeach
                                            </td>
                                            <td class="w-5p">
                                                <p class="text-sm">Tgl</p>
                                            </td>
                                            <td class="w-20p">@foreach($inbound->inboundDocuments as $inboundDocument)
                                                <p class="text-sm">{{$inboundDocument->document_id == 3 ? ": ". $inboundDocument->details['date'] : ''}}</p>
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
                                            <td class="w-5p">@foreach($inbound->inboundDocuments as $inboundDocument)
                                                <p class="text-sm">{{$inboundDocument->document_id == 142 ? ": ". $inboundDocument->details['nomor_dokumen'] : ''}}</p>
                                                @endforeach
                                            </td>
                                            <td class="w-5p">
                                                <p class="text-sm">Tgl</p>
                                            </td>
                                            <td class="w-25p">@foreach($inbound->inboundDocuments as $inboundDocument)
                                                <p class="text-sm">{{$inboundDocument->document_id == 142 ? ": ". $inboundDocument->details['date'] : ''}}</p>
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

                {{-- <tr>
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
                                                <p class="text-sm">: {{ $inbound->details['nomor_pendaftaran'] ?? '' }}</p>
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
                            <p class="text-sm">. {{ $inbound->details['tanggal_pendaftaran'] ?? '' }}</p>
                        </td>
                    </tr>
                </table>
            </td>
            </tr>
            </table>
            </td>
            </tr> --}}

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
                                            <p class="text-sm">13. Jenis Sarana Pengangkut Darat</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $inbound->inboundTransportation->transportation->name ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td class="w-50p m-cell">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-sm">14. No Polisi</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $inbound->inboundTransportation->vehicle_number ?? '' }}</p>
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
                                            <p class="text-sm">15. Harga Penyerahan</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: Rp {{ $inbound->details['harga_penyerahan'] ?? '' }}</p>
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
                                            <p class="text-sm">16. Jenis Kemasan</p>
                                        </td>
                                        <td>
                                            <p class="text-sm"> :
                                                @foreach($inbound->inboundDetails as $key=>$inboundDetail)
                                                <span>[{{ $inboundDetail->details['kode_barang'] ?? '' }}]{{ $inboundDetail->package->name ?? '' }}{{ count($inbound->inboundDetails) != ($key + 1) ? ',' : '' }}</span>
                                                @endforeach
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">17. Merek Kemasan</p>
                                        </td>
                                        <td>
                                            <p class="text-sm"> :
                                                @foreach($inbound->inboundDetails as $key=>$inboundDetail)
                                                <span>[{{ $inboundDetail->details['kode_barang'] ?? '' }}]{{ $inboundDetail->package_details['merk'] ?? '' }}{{ count($inbound->inboundDetails) != ($key + 1) ? ',' : '' }}</span>
                                                @endforeach
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td class="w-50p m-cell">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-sm">18. Jumlah Kemasan</p>
                                        </td>
                                        <td>
                                            <p class="text-sm"> :
                                                @foreach($inbound->inboundDetails as $key=>$inboundDetail)
                                                <span>[{{ $inboundDetail->details['kode_barang'] ?? '' }}]{{ $inboundDetail->package_details['jumlah'] ?? '' }}{{ count($inbound->inboundDetails) != ($key + 1) ? ',' : '' }}</span>
                                                @endforeach
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
                                            <p class="text-sm">19. Volume (m3)</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $inbound->details['volume'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td class="w-33p m-cell">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-sm">20. Berat Kotor (Kg)</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $inbound->details['berat_kotor'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 33%;padding:5px 10px 5px 10px">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-sm">21. Berat Bersih (Kg)</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $inbound->details['berat_bersih'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="text-center">
                <td colspan="2">
                    <table class="w-full no-spacing-border">
                        <tr>
                            <td class="border w-5p m-cell">
                                <p class="text-sm">
                                    22
                                </p>
                                <p class="text-sm">
                                    No.
                                </p>
                            </td>
                            <td class="border w-40p m-cell">
                                <p class="text-sm">
                                    23
                                </p>
                                <p class="text-sm">
                                    Uraian jumlah dan jenis barang secara lengkap, kode barang,
                                    merk, tipe, ukuran, dan spesifikasi lain
                                </p>
                            </td>
                            <td class="border w-25p m-cell">
                                <p class="text-sm">
                                    24
                                </p>
                                <p class="text-sm">
                                    - Jumlah & Jenis Satuan
                                    - Berat Bersih (Kg)
                                    - Volume(m3)
                                </p>
                            </td>
                            <td class="border w-25p m-cell">
                                <p class="text-sm">
                                    25
                                </p>
                                <p class="text-sm">
                                    - Harga penyerahan (Rp)
                                </p>
                            </td>

                        </tr>
                        {{-- @foreach($inbound->inboundDetails as $key=>$inboundDetail)
                            <tr>
                                <td class="border w-5p m-cell">
                                    <p class="text-sm">
                                        {{ $key + 1 }}
                        </p>
                </td>
                <td class="border w-40p m-cell">
                    <p class="text-sm">
                        {{ '- Kode Barang : ' . $inboundDetail->good->details['kode_barang'] ?? '' }}
                    </p>
                    <p class="text-sm">
                        - {{ $inboundDetail->good->name ?? '' }},
                        Merek : {{ $inboundDetail->good->details['merk'] ?? '' }},
                        Tipe : {{ $inboundDetail->good->details['type'] ?? '' }},
                        Ukuran : {{ $inboundDetail->good->details['ukuran'] ?? '' }},
                        Spesifikasi lain : {{ $inboundDetail->good->details['spesifikasi_lain'] ?? '' }},
                    </p>

                </td>
                <td class="border w-25p m-cell">
                    <p class="text-sm">
                        - {{ $inboundDetail->quantity ?? '' . ' ' .  $inboundDetail->package->name ?? ''  }}
                    </p>
                    <p class="text-sm">
                        - {{ $inboundDetail->good->nett_weight ?? '' }}
                    </p>
                    <p class="text-sm">
                        - {{ $inboundDetail->volume  ?? ''}}
                    </p>
                </td>
                <td class="border w-25p m-cell">
                    <p class="text-sm">
                        Rp {{ $inbound->details['harga_penyerahan'] ?? '' }}
                    </p>
                </td>

            </tr>

            @endforeach --}}
            <tr>
                <td colspan="4" class="border w-full m-cell text-center">
                    ------------------------- {{ $countbarang }} Jenis barang. Lihat lembar lanjutan -------------------------
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
                                    {{ $inbound->city->city ?? '' }}, {{ date('d-F-Y', strtotime($inbound->details['pabean_tanggal'])) ?? '' }}
                                </p>
                                <br><br>
                                <p class="text-sm text-center">
                                    {{ $inbound->details['pabean_pemberitahu'] ?? '' }}
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
                            BC 4.0
                        </p>
                    </td>
                    <td class="border w-85p">
                        <p class="text-md text-center m-top">
                            LEMBAR LANJUTAN<br>
                            DATA BARANG
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
                                                        : {{ $inbound->request_number ?? ''}}
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p class="text-sm">A. KANTOR PABEAN</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm">: {{ $inbound->inboundKppbc->masterKppbc->description ?? ''}}</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p class="text-sm">B. JENIS TPB</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm">: {{ $inbound->inboundJenisTpb->masterJenisTpb->name ?? '' }}</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p class="text-sm">C. TUJUAN PENGIRIMAN</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm">: {{ $inbound->inboundTujuanPengiriman->masterTujuanPengiriman->name ?? '' }}</p>
                                                </td>
                                            </tr>
                                        </table>

                                    </td>
                                    <td>
                                        <span class="text-sm pull-right">Halaman ke-2 dari 3</span>
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
                                        22
                                    </p>
                                    <p class="text-sm">
                                        No.
                                    </p>
                                </td>
                                <td class="border w-40p m-cell">
                                    <p class="text-sm">
                                        23
                                    </p>
                                    <p class="text-sm">
                                        Uraian jumlah dan jenis barang secara lengkap, kode barang,
                                        merk, tipe, ukuran, dan spesifikasi lain
                                    </p>
                                </td>
                                <td class="border w-25p m-cell">
                                    <p class="text-sm">
                                        24
                                    </p>
                                    <p class="text-sm">
                                        - Jumlah & Jenis Satuan<br>
                                        - Berat Bersih (Kg)<br>
                                        - Volume(m3)
                                    </p>
                                </td>
                                <td class="border w-25p m-cell">
                                    <p class="text-sm">
                                        25
                                    </p>
                                    <p class="text-sm">
                                        - Harga penyerahan (Rp)
                                    </p>
                                </td>

                            </tr>
                            @foreach($inbound->inboundDetails as $key=>$inboundDetail)
                            <tr>
                                <td class="border w-5p m-cell">
                                    <p class="text-sm">
                                        {{ $key + 1 }}
                                    </p>
                                </td>
                                <td class="border w-40p m-cell">
                                    <p class="text-sm">
                                        {{ '- Kode Barang : ' . $inboundDetail->good->details['kode_barang'] ?? '' }}
                                    </p>
                                    <p class="text-sm">
                                        - {{ $inboundDetail->good->name ?? '' }},
                                        Merek : {{ $inboundDetail->good->details['merk'] ?? '' }},
                                        Tipe : {{ $inboundDetail->good->details['type'] ?? '' }},
                                        Ukuran : {{ $inboundDetail->good->details['ukuran'] ?? '' }},
                                        Spesifikasi lain : {{ $inboundDetail->good->details['spesifikasi_lain'] ?? '' }},
                                    </p>

                                </td>
                                <td class="border w-25p m-cell">
                                    <p class="text-sm">
                                        - {{ $inboundDetail->quantity . ' ' .  $inboundDetail->good->uom->name }}
                                    </p>
                                    <p class="text-sm">
                                        - {{ $inboundDetail->nett_weight ?? '' }}
                                    </p>
                                    <p class="text-sm">
                                        - {{ $inboundDetail->volume  ?? ''}}
                                    </p>
                                </td>
                                <td class="border w-25p m-cell">
                                    <p class="text-sm">
                                        Rp {{ $inboundDetail->details['harga_penyerahan'] ?? '' }}
                                    </p>
                                </td>

                            </tr>

                            @endforeach
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
                                <td class="w-50p m-cell">
                                </td>
                                <td class="w-50p m-cell">
                                    <p class="text-sm">
                                        Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal
                                        yang diberitahukan dalam pemberitahuan pabean ini.
                                    </p>
                                    <br>
                                    <p class="text-sm text-center">
                                        {{ $inbound->city->city ?? '' }}, {{ date('d-F-Y', strtotime($inbound->details['pabean_tanggal'])) ?? '' }}
                                    </p>
                                    <br><br>
                                    <p class="text-sm text-center">
                                        {{ $inbound->details['pabean_pemberitahu'] ?? '' }}
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
                            BC 4.0
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
                                                        : {{ $inbound->request_number ?? ''}}
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p class="text-sm">A. KANTOR PABEAN</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm">: {{ $inbound->inboundKppbc->masterKppbc->description ?? ''}}</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p class="text-sm">B. JENIS TPB</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm">: {{ $inbound->inboundJenisTpb->masterJenisTpb->name ?? '' }}</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p class="text-sm">C. TUJUAN PENGIRIMAN</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm">: {{ $inbound->inboundTujuanPengiriman->masterTujuanPengiriman->name ?? '' }}</p>
                                                </td>
                                            </tr>
                                        </table>

                                    </td>
                                    <td>
                                        <span class="text-sm pull-right">Halaman ke-3 dari 3</span>
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
                                    <p class="text-md">
                                        NO
                                    </p>
                                </td>
                                <td class="border w-40p m-cell">
                                    <p class="text-md">
                                        JENIS DOKUMEN
                                    </p>
                                </td>
                                <td class="border w-25p m-cell">
                                    <p class="text-md">
                                        NOMOR
                                    </p>
                                </td>
                                <td class="border w-25p m-cell">
                                    <p class="text-md">
                                        TANGGAL
                                    </p>
                                </td>

                            </tr>
                            @foreach($inbound->inboundDocuments as $key=>$inboundDocument)
                            <tr>
                                <td class="border w-5p m-cell">
                                    <p class="text-sm">
                                        {{ $key + 1 }}
                                    </p>
                                </td>
                                <td class="border w-40p m-cell">
                                    <p class="text-sm">
                                        {{ $inboundDocument->masterDocument->name ?? '' }}
                                    </p>

                                </td>
                                <td class="border w-25p m-cell">
                                    <p class="text-md">
                                        - {{ $inboundDocument->details['nomor_dokumen']}}
                                    </p>
                                </td>
                                <td class="border w-25p m-cell">
                                    <p class="text-md">
                                        {{ date('d-m-Y', strtotime($inboundDocument->details['date'])) ?? '' }}
                                    </p>
                                </td>

                            </tr>

                            @endforeach
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
                                <td class="w-50p m-cell">
                                </td>
                                <td class="w-50p m-cell">
                                    <p class="text-sm">
                                        Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal
                                        yang diberitahukan dalam pemberitahuan pabean ini.
                                    </p>
                                    <br>
                                    <p class="text-sm text-center">
                                        {{ $inbound->city->city ?? '' }}, {{ date('d-F-Y', strtotime($inbound->details['pabean_tanggal'])) ?? '' }}
                                    </p>
                                    <br><br>
                                    <p class="text-sm text-center">
                                        {{ $inbound->details['pabean_pemberitahu'] ?? '' }}
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
</body>

</html>