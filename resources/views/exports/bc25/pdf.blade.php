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

        .h-full {
            height: 100%;
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

        .w-20p {
            width: 20%;
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

        .pull-top {

            vertical-align: top;
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

        <div class="text-lg text-center">PEMBERITAHUAN IMPOR BARANG DARI TEMPAT PENIMBUNAN BERIKAT</div>
        <table class="w-full no-spacing-border">
            <tr>
                <table class="border w-full" style="border-bottom: none">
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <p class="text-sm">Kantor Pabean</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">: {{ $outbound->city->city ?? ''}}</p>
                                    </td>
                                </tr>
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
                                        <p class="text-sm">A. Jenis TPB</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">: {{ $outbound->outboundJenisTpb->masterJenisTpb->name ?? '' }} </p>
                                    </td>
                                </tr>
                            </table>

                        </td>
                        <td>
                            <p class="text-sm">Tanggal : {{ $outbound->details['tanggal_pendaftaran'] }}</p>
                        </td>
                        <td class="pull-top">
                            <span class="text-sm border " style="padding: 0px 5px 0px">{{ $outbound->outboundKppbc->masterKppbc->code }}</span>
                            <br>
                        </td>
                        <td class="pull-top">
                            <span class="text-sm">Halaman 1 dari 3</span>
                            <br>
                        </td>
                    </tr>
                </table>
            </tr>


            <tr>
                <table class="w-full no-spacing-border">
                    <tr>
                        <td class="border w-50p m-cell" style="border-right: none">
                            <table>
                                <tr>
                                    <td class=" w-50p">
                                        <p class="text-md  ">DATA PEMBERITAHUAN<br>
                                            PENYELENGGARA/PENGUSAHA TPB</p>
                                    </td>
                                </tr>
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
                                <tr>
                                    <td>
                                        <p class="text-sm">5. API</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">: {{ $outbound->outboundTpb->profile->details['jenis_api'] ?? '' }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td class="border w-50p m-cell">
                            <table>
                                <tr>
                                    <td class="w-50p" style="border-bottom: none;border-left: none">
                                        <p class="text-md ">DIISI OLEH BEA DAN CUKAI</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm">6. Nomor Pendaftaran</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">: {{ $outbound->details['nomor_pendaftaran'] ?? '' }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm">7. Tanggal</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">: {{ $outbound->details['tanggal_pendaftaran'] ?? '' }}</p>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                </table>
            </tr>



            <tr>
                <table class="w-full no-spacing-border">
                    <tr>
                        <td class="border w-50p m-cell" style="border-top: none;border-right: none">
                            <table>
                                <tr>
                                    <td class=" w-full" colspan="2">
                                        <p class="text-md">PEMILIK BARANG</p>
                                    </td>
                                </tr>
                                <tr class=" w-full">
                                    <td>
                                        <p class="text-sm">6. NPWP</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">: {{ $outbound->outboundPemilikBarang->profile->details['nomor_identitas'] ?? '' }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm">7. Nama</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">: {{ $outbound->outboundPemilikBarang->profile->name ?? '' }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm">8. Alamat</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">: {{ $outbound->outboundPemilikBarang->profile->address ?? '' }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td colspan="2" class="border" style="border-top: none">
                            <table class="no-spacing-border w-full">
                                <tr>
                                    <td class="w-50p m-cell">
                                        <table class="w-full no-spacing-border">
                                            <tr>
                                                <td class="w-25p">
                                                    <p class="text-sm">14. Invoice</p>
                                                </td>
                                                <td class="w-30p">
                                                    @foreach($outbound->outboundDocuments as $outboundDocument)
                                                    <p class="text-sm">{{$outboundDocument->document_id == 90 ? ": ".$outboundDocument->details['nomor_dokumen'] : ''}}</p>
                                                    @endforeach
                                                </td>
                                                <td class="w-5p">
                                                    <p class="text-sm">Tgl</p>
                                                </td>
                                                <td class="w-20p">
                                                    @foreach($outbound->outboundDocuments as $outboundDocument)
                                                    <p class="text-sm">{{$outboundDocument->document_id == 90 ? ": ".$outboundDocument->details['date'] : ''}}</p>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="w-25p">
                                                    <p class="text-sm">15. Packing List</p>
                                                </td>
                                                <td class="w-30p">
                                                    @foreach($outbound->outboundDocuments as $outboundDocument)
                                                    <p class="text-sm">{{$outboundDocument->document_id == 1 ? ": ".$outboundDocument->details['nomor_dokumen'] : ''}}</p>
                                                    @endforeach
                                                </td>
                                                <td class="w-5p">
                                                    <p class="text-sm">Tgl</p>
                                                </td>
                                                <td class="w-20p">
                                                    @foreach($outbound->outboundDocuments as $outboundDocument)
                                                    <p class="text-sm">{{$outboundDocument->document_id == 1 ? ": ".$outboundDocument->details['date'] : ''}}</p>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="w-25p">
                                                    <p class="text-sm">16. Kontrak</p>
                                                </td>
                                                <td class="w-30p">
                                                    @foreach($outbound->outboundDocuments as $outboundDocument)
                                                    <p class="text-sm">{{$outboundDocument->document_id == 86 ? ": ".$outboundDocument->details['nomor_dokumen'] : ''}}</p>
                                                    @endforeach
                                                </td>
                                                <td class="w-5p">
                                                    <p class="text-sm">Tgl</p>
                                                </td>
                                                <td class="w-20p">
                                                    @foreach($outbound->outboundDocuments as $outboundDocument)
                                                    <p class="text-sm">{{$outboundDocument->document_id == 86 ? ": ".$outboundDocument->details['date'] : ''}}</p>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="w-25p">
                                                    <p class="text-sm">17. Fasilitas Impor</p>
                                                </td>
                                                <td class="w-30p">
                                                    @foreach($outbound->outboundDocuments as $outboundDocument)
                                                    <p class="text-sm">{{$outboundDocument->document_id == 10 ? ": ".$outboundDocument->details['nomor_dokumen'] : ''}}</p>
                                                    @endforeach
                                                </td>
                                                <td class="w-5p">
                                                    <p class="text-sm">Tgl</p>
                                                </td>
                                                <td class="w-20p">
                                                    @foreach($outbound->outboundDocuments as $outboundDocument)
                                                    <p class="text-sm">{{$outboundDocument->document_id == 10 ? ": ".$outboundDocument->details['date'] : ''}}</p>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="w-25p">
                                                    <p class="text-sm">18. Surat Keputusan<br>
                                                        /Dokumen Lainya</p>
                                                </td>
                                                <td class="w-30p">
                                                    @foreach($outbound->outboundDocuments as $outboundDocument)
                                                    <p class="text-sm">{{$outboundDocument->document_id == 142 ? ": ".$outboundDocument->details['nomor_dokumen'] : ''}}</p>
                                                    @endforeach
                                                </td>
                                                <td class="w-5p">
                                                    <p class="text-sm">Tgl</p>
                                                </td>
                                                <td class="w-20p">
                                                    @foreach($outbound->outboundDocuments as $outboundDocument)
                                                    <p class="text-sm">{{$outboundDocument->document_id == 142 ? ": ".$outboundDocument->details['date'] : ''}}</p>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>

                    </tr>


                </table>
            </tr>

            <tr>
                <td>
                    <table class="w-full no-spacing-border">
                        <tr>
                            <td class="border w-50p m-cell" style="border-top: none;border-right: none" rowspan="3">
                                <table>
                                    <tr>
                                        <td class=" w-full" colspan="2">
                                            <p class="text-md  ">PENERIMA BARANG</p>
                                        </td>
                                    </tr>
                                    <tr class=" w-full">
                                        <td>
                                            <p class="text-sm">9. NPWP</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundPenerimaBarang->profile->details['nomor_identitas'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">10. Nama</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundPenerimaBarang->profile->name ?? '' }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">11. Alamat</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundPenerimaBarang->profile->address ?? ''  }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">12. NIPER</p>

                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundPenerimaBarang->profile->details['niper'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">13. API</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundPenerimaBarang->profile->details['tipe_api'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td class="border m-cell w-25p" style="border-top: none;border-right: none;">
                                <table>
                                    <tr>
                                        <td class="w-45p">
                                            <p class="text-sm">19. Valuta</p>
                                        </td>
                                        <td class="pull-top ">
                                            <span class="text-sm border pull-right " style="padding: 0px 5px 0px">{{ $outbound->outboundValas->masterValas->code ?? '' }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundValas->masterValas->nominal ?? '' }}</p>
                                        </td>

                                    </tr>
                                </table>
                            </td>
                            <td class="border m-cell w-25p" style="border-top: none">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-sm">20. NDPBM</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->details['ndpbm'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pull-right">

                                        </td>

                                    </tr>
                                </table>
                            </td>
                        </tr>


                        <tr>
                            <td class="border m-cell w-full" style="border-top: none" colspan="2">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-sm">21. Nilai CIF</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->details['nilai_cif'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">22. Harga Penyerahan</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->details['harga_penyerahan'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="border m-cell" style="border-top: none" colspan="2">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-sm">23. Jenis Sarana Pengangkut</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundTransportLine->transportLine->name ?? '' }}</p>
                                        </td>
                                    </tr>

                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <table class="w-full no-spacing-border text-md" style="border-top: none;border-bottom: none">
                    <td class="border w-33p m-cell" style="border-top: none;border-right: none">
                        <table>
                            <tr class="w-full text-md">
                                <td>
                                    24. Nomor, Ukuran dan Tipe Peti Kemas
                                </td>

                            </tr>
                            <tr class="w-full text-sm">
                                <td>
                                    {{ $outbound->details['nomor_peti_kemas']  ?? '' }}
                                    {{ $ukuranpeti->name  ?? '' }}
                                    {{ $tipepeti->name ?? '' }}

                                </td>
                            </tr>

                        </table>

                    </td>
                    <td class="border w-33p m-cell" style="border-top: none;border-left: none;border-right: none">
                        <table>
                            <tr class="w-full text-md">
                                <td>
                                    25. Jumlah, Jenis dan Merek Kemasan
                                </td>

                            </tr>
                            <tr class="w-full text-sm">
                                <td>
                                    {{ $outbound->outboundDetails[0]->package_details['jumlah']   ?? '' }}
                                    {{ $outbound->outboundDetails[0]->package->name ?? '' }}
                                    {{ $outbound->outboundDetails[0]->package_details['merk'] ?? '' }}

                                </td>
                            </tr>

                        </table>

                    </td>
                    <td class="border w-33p m-cell" style="border-top: none">
                        <table>
                            <tr>
                                <td>
                                    <p class="text-sm">26. Berat Kotor (Kg)</p>
                                </td>
                                <td>
                                    <p class="text-sm">: {{ $outbound->details['berat_kotor'] ?? '' }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="text-sm">27. Berat Bersih (Kg)</p>
                                </td>
                                <td>
                                    <p class="text-sm">: {{ $outbound->details['berat_bersih'] ?? '' }}</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </table>
            </tr>

            <tr>
                <td>
                    <table class="w-full no-spacing-border text-md">
                        <tr>
                            <td class="border w-5p m-cell text-center text-sm" style="border-top: none;border-right: none;">
                                28. No.
                            </td>
                            <td class="border w-35p m-cell" style="border-top: none;border-right: none;">
                                29. - Pos Tarif/HS<br>
                                - Kode barang<br>
                                - Uraian barang secara lengkap, merk, tipe,<br>
                                ukuran, spesifikasi lain<br>
                                - Fasilitas Impor<br>
                                - Surat Keputusan/Dokumen Lainnya<br>
                            </td>
                            <td class="border w-15p m-cell" style="border-top: none;border-right: none;">
                                30.- Kategori Barang <br>
                                - Kondisi Barang <br>

                            </td>
                            <td class="border w-15p m-cell" style="border-top: none;border-right: none;">
                                31. - Tarif dan Fasilitas <br>
                                - BM -BMT <br>
                                - Cukai <br>
                                - PPN <br>
                                - PPnBM <br>
                                - PPh <br>

                            </td>
                            <td class="border w-15p m-cell" style="border-top: none;border-right: none;
                        ">
                                32. - Jumlah dan <br>
                                Jenis Satuan <br>
                                - Berat Bersih <br>
                                (kg) <br>
                                - Jumlah dan <br>
                                Jenis Kemasan <br>
                            </td>
                            <td class="border w-15p m-cell" style="border-top: none;">
                                33. - Nilai CIF <br>
                                - Harga <br>
                                Penyerahan <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="border w-full m-cell text-center">
                    ------------------------- {{ $countbarang }} Jenis barang. Lihat lembar lanjutan -------------------------
                </td>
            </tr>
            {{-- @foreach($outbound->outboundDetails as $key=>$outboundDetail)
                <tr>
                    <td>
                        <table class="w-full no-spacing-border text-sm">
                            <tr>
                                <td class="border w-5p m-cell" style="border-top: none;border-right: none"> --}}
            {{-- {{ $key + 1 }}--}}
            {{-- </td>
                                <td class="border w-35p m-cell" style="border-top: none;border-right: none">
                                    <p>
                                        HS: {{ $outboundDetail->hsCode->code ?? '' }} &emsp;
            Kode: {{ $outboundDetail->details['kode_barang'] ?? '' }}<br>
            Uraian: {{ $outboundDetail->details['uraian'] ?? '' }}<br>
            Merk: {{ $outboundDetail->details['merk'] ?? '' }}<br>
            Ukuran: {{ $outboundDetail->details['ukuran'] ?? '' }}<br>
            Type: {{ $outboundDetail->details['type'] ?? '' }}<br>
            Lain lain: {{ $outboundDetail->details['spesifikasi_lain'] ?? '' }}<br>
            Fasilitas: {{ $outboundDetail->details['spesifikasi_lain'] ?? '' }}<br>
            Dokumen: {{ $outbound->outboundDocuments[0]->masterDocument->name ?? '' }}
            </p>

            </td>
            <td class="border w-15p m-cell" style="border-top: none;border-right: none">
                <p>Kategori: 1<br>
                    Hasil Produksi</p>
                <p>
                    <br>
                    <br>
                <p>Kondisi: 1<br>
                    Tidak Rusak</p>
                <p>
            </td>
            <td class="border w-15p m-cell" style="border-top: none;border-right: none">
                <p class="text-sm">
                    BM: {{ $outboundDetail->details['bm_value'] ?? ''}} &nbsp; {{$outboundDetail->details['bm_tax_value'] ?? '' }}<br>
                    BMT: {{ $outboundDetail->details['bmt_value'] ?? ''}} &nbsp; {{$outboundDetail->details['bmt_tax_value'] ?? '' }}<br>
                    Cukai: {{ $outboundDetail->details['cukai_value'] ?? ''}} &nbsp; {{$outboundDetail->details['cukai_tax_value'] ?? ''}}<br>
                    PPH: {{ $outboundDetail->details['pph_value'] ?? ''}} &nbsp; {{$outboundDetail->details['pph_tax_value'] ?? ''}}<br>
                    PPN: {{ $outboundDetail->details['ppn_value'] ?? ''}} &nbsp; {{$outboundDetail->details['ppn_tax_value'] ?? ''}}<br>
                    PPNBM: {{ $outboundDetail->details['ppnbm_value'] ?? ''}} &nbsp; {{$outboundDetail->details['ppnbm_tax_value'] ?? ''}}<br>

                </p>
            </td>
            <td class="border w-15p m-cell" style="border-top: none;border-right: none">
                <p class="text-sm">
                    Jumlah dan jenis satuan: {{ $outbound->outboundDetails[0]->quantity ?? '' . ' ' .  $outbound->outboundDetails[0]->package->name  ?? '' }}
                </p>
                <p class="text-sm">
                    berat bersih: {{$outbound->outboundDetails[0]->nett_weight ?? '' }}
                </p>
                <br><br>
                <p class="text-sm">
                    Jumlah kemasan: {{ $outbound->outboundDetails[0]->package_details['jumlah']  ?? '' }}
                </p>
                <p class="text-sm">
                    Jenis kemasan: {{ $outbound->outboundDetails[0]->package->name ?? '' }}
                </p>

            </td>
            <td class="border w-15p m-cell" style="border-top: none">
                <p>
                    CIF: {{ $outbound->details['cif'] ?? '' }}
                </p>
                <p>
                    Harga Penyerahan: {{ $outbound->details['harga_penyerahan'] ?? '' }}
                </p>
            </td>
            </tr>

        </table>
        </td>

        </tr>
        @endforeach --}}

        <tr>
            <td>
                <table class="w-full no-spacing-border text-md">
                    <tr>
                        <td class="border w-20p m-cell text-center " colspan="2" style="border-right: none;border-bottom: none">
                            Jenis Pungutan
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-right: none;border-bottom: none">
                            Dibayar <br>
                            (Rp)
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-right: none;border-bottom: none">
                            Dibebaskan <br>
                            (Rp)
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-right: none;border-bottom: none">
                            Ditanggung Pemerintah <br>
                            (Rp)
                        </td>
                        <td class="border w-20p m-cell text-center" style="border-bottom: none">
                            Sudah Dilunasi <br>
                            (Rp)
                        </td>
                    </tr>
                    <tr class="text-sm">
                        <td class="border w-5p m-cell text-center " style="border-right: none;border-bottom: none">
                            34
                        </td>
                        <td class="border w-15p m-cell text-center " style="border-right: none;border-bottom: none">
                            BM
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{ $outbound->details['bm_ditangguhkan'] ?? '' }}</p>
                        </td>
                        <td class="border w-20p m-cell text-center" style="border-right: none;border-bottom: none">
                            <p>{{$outbound->details['bm_dibebaskan'] ?? ''}}</p>
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$outbound->details['bm_tidak_dipungut'] ?? ''}}</p>
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-bottom: none">
                            0
                        </td>

                    </tr>
                    <tr class="text-sm">
                        <td class="border w-5p m-cell text-center " style="border-right: none;border-bottom: none">
                            35
                        </td>
                        <td class="border w-15p m-cell text-center " style="border-right: none;border-bottom: none">
                            BMT
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$outbound->details['bmt_ditangguhkan'] ?? ''}}</p>
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$outbound->details['bmt_dibebaskan'] ?? '' }}</p>
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$outbound->details['bmt_tidak_dipungut'] ?? ''}}</p>
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-bottom: none">
                            0
                        </td>

                    </tr>
                    <tr class="text-sm">
                        <td class="border w-5p m-cell text-center " style="border-right: none;border-bottom: none">
                            36
                        </td>
                        <td class="border w-15p m-cell text-center " style="border-right: none;border-bottom: none">
                            Cukai
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$outbound->details['cukai_ditangguhkan'] ?? ''}}</p>
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$outbound->details['cukai_dibebaskan'] ?? ''}}</p>
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$outbound->details['cukai_tidak_dipungut'] ?? ''}}</p>
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-bottom: none">
                            0
                        </td>

                    </tr>
                    <tr class="text-sm">
                        <td class="border w-5p m-cell text-center " style="border-right: none;border-bottom: none">
                            37
                        </td>
                        <td class="border w-15p m-cell text-center " style="border-right: none;border-bottom: none">
                            PPN
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$outbound->details['ppn_ditangguhkan'] ?? 0}}</p>
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$outbound->details['ppn_dibebaskan'] ?? 0}}</p>
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$outbound->details['ppn_tidak_dipungut'] ?? 0}}</p>
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-bottom: none">
                            0
                        </td>

                    </tr>
                    <tr class="text-sm">
                        <td class="border w-5p m-cell text-center " style="border-right: none;border-bottom: none">
                            38
                        </td>
                        <td class="border w-15p m-cell text-center " style="border-right: none;border-bottom: none">
                            PPnBM
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$outbound->details['ppnbm_ditangguhkan'] ?? 0}}</p>
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$outbound->details['ppnbm_dibebaskan'] ?? 0}}</p>
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$outbound->details['ppnbm_tidak_dipungut'] ?? 0}}</p>
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-bottom: none">
                            0
                        </td>

                    </tr>
                    <tr class="text-sm">
                        <td class="border w-5p m-cell text-center " style="border-right: none;border-bottom: none">
                            39
                        </td>
                        <td class="border w-15p m-cell text-center " style="border-right: none;border-bottom: none">
                            PPh
                        </td>
                        <td class="border w-20p m-cel text-center " style="border-right: none;border-bottom: none">
                            <p>{{$outbound->details['pph_ditangguhkan'] ?? 0}}</p>
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$outbound->details['pph_dibebaskan'] ?? 0 }}</p>
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$outbound->details['pph_tidak_dipungut'] ?? 0}}</p>
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-bottom: none">
                            0
                        </td>

                    </tr>
                    <tr class="text-sm">
                        <td class="border w-5p m-cell text-center " style="border-right: none;border-bottom: none">
                            40
                        </td>
                        <td class="border w-15p m-cell text-center " style="border-right: none;border-bottom: none">
                            TOTAL
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$outbound->details['total_ditangguhkan'] ?? 0}}</p>
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$outbound->details['total_dibebaskan'] ?? 0}}</p>
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$outbound->details['total_tidak_dipungut'] ?? 0}}</p>
                        </td>
                        <td class="border w-20p m-cell text-center " style="border-bottom: none">
                            0
                        </td>

                    </tr>

                </table>
            </td>

        </tr>

        <tr>
            <td>
                <table class="w-full no-spacing-border">
                    <tr>
                        <td class="border m-cell text-sm w-50p" rowspan="2" style="border-right: none">
                            C. PENGESAHAN PENGUSAHA TPB<br><br>
                            Dengan ini saya menyatakan bertanggung jawab atas<br>
                            kebenaran hal-hal yang diberitahukan dalam pemberitahuan pabean ini<br>
                            Tempat, Tanggal : {{ $outbound->city->city }}, {{ $outbound->details['pabean_tanggal'] }}<br>
                            <p>Nama Lengkap : {{ $outbound->details['pabean_pemberitahu'] }}</p>
                            <p>Jabatan : {{ $outbound->details['pabean_jabatan'] }}</p>
                            Tanda Tangan dan Stempel Perusahaan :<br>
                            <br>
                            <br>
                            <br>
                            <br>
                        </td>
                        <td class="border m-cell text-sm" style="border-bottom: none">
                            E. UNTUK PEMBAYARAN<br><br>

                            <div>
                                Pembayaran &emsp; <span class="text-sm border " style="padding: 0px 5px 0px">1</span> &emsp; 1.Bank &emsp; 2.Pos
                                &emsp; 3.Kantor Pabean<br>
                            </div>
                            <br>
                            <div>
                                Wajib Bayar &emsp; <span class="text-sm border " style="padding: 0px 5px 0px">2</span> &emsp; 1.Pengusaha TPB &emsp;
                                2.Penerima<br>
                            </div>

                            <br>
                            &emsp; &emsp; &emsp; &emsp; &emsp; Tanggal:
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td class="border text-center">
                            Nama/Stempel Instansi<br>
                            <br><br><br><br>
                            Nama/Stempel
                        </td>
                    </tr>
                </table>
            </td>

        </tr>
        </table>
        <span class="text-xs">Rangkap ke-1 / 2 / 3 : Pengusaha TPB / KPPBC Pengawas / Penerima Barang</span>
    </div>

    <div class="page_break"></div>

    <div class="page-2 letter-a4">
        <table class="w-full no-spacing-border">
            <tr>
                <p class="text-md text-center m-top">
                    LEMBAR LANJUTAN DATA BARANG<br>
                    PEMBERITAHUAN IMPOR BARANG DARI TEMPAT PENIMBUNAN BERIKAT
                </p>
            </tr>
            <tr>
                <td>
                    <table class="w-full border">
                        <tr>
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                            <p class="text-sm">Kantor Pabean</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundKppbc->masterKppbc->description ?? ''}}</p>
                                        </td>
                                    </tr>
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
                                            <p class="text-sm">Nomor Pendaftaran</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->details['nomor_pendaftaran'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                            <td>
                                <p class="text-sm">Tanggal : {{ $outbound->details['tanggal_pendaftaran'] }}</p>
                            </td>
                            <td class="pull-top">
                                <span class="text-sm border " style="padding: 0px 5px 0px">{{ $outbound->outboundKppbc->masterKppbc->code }}</span>
                                <br>
                            </td>
                            <td class="pull-top">
                                <span class="text-sm">Halaman 3 dari 3</span>
                                <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <table class="w-full no-spacing-border">
                        <table class="w-full no-spacing-border text-md">
                            <tr>
                                <td class="border w-5p m-cell text-center text-sm" style="border-top: none;border-right: none;">
                                    28. No.
                                </td>
                                <td class="border w-35p m-cell" style="border-top: none;border-right: none;">
                                    29. - Pos Tarif/HS<br>
                                    - Kode barang<br>
                                    - Uraian barang secara lengkap, merk, tipe,<br>
                                    ukuran, spesifikasi lain<br>
                                    - Fasilitas Impor<br>
                                    - Surat Keputusan/Dokumen Lainnya<br>
                                </td>
                                <td class="border w-15p m-cell" style="border-top: none;border-right: none;">
                                    30.- Kategori Barang <br>
                                    - Kondisi Barang <br>

                                </td>
                                <td class="border w-15p m-cell" style="border-top: none;border-right: none;">
                                    31. - Tarif dan Fasilitas <br>
                                    - BM -BMT <br>
                                    - Cukai <br>
                                    - PPN <br>
                                    - PPnBM <br>
                                    - PPh <br>

                                </td>
                                <td class="border w-15p m-cell" style="border-top: none;border-right: none;">
                                    32. - Jumlah dan <br>
                                    Jenis Satuan <br>
                                    - Berat Bersih <br>
                                    (kg) <br>
                                    - Jumlah dan <br>
                                    Jenis Kemasan <br>
                                </td>
                                <td class="border w-15p m-cell" style="border-top: none;">
                                    33. - Nilai CIF <br>
                                    - Harga <br>
                                    Penyerahan <br>
                                </td>
                            </tr>
                        </table>
                        @foreach($outbound->outboundDetails as $key=>$outboundDetail)
                        <tr>
                            <td>
                                <table class="w-full no-spacing-border text-sm">
                                    <tr>
                                        <td class="border w-5p m-cell" style="border-top: none;border-right: none">
                                            {{ $key + 1 }}
                                        </td>
                                        <td class="border w-35p m-cell" style="border-top: none;border-right: none">
                                            <p>
                                                Pos: {{ $outboundDetail->hsCode->code ?? '' }} <br>
                                                Kode Brg: {{ $outboundDetail->details['kode_barang'] ?? '' }}<br>
                                                {{ $outboundDetail->good->name }}<br>
                                                Uraian: {{ $outboundDetail->details['uraian'] ?? '' }}<br>
                                                Merk: {{ $outboundDetail->details['merk'] ?? '' }}<br>
                                                Ukuran: {{ $outboundDetail->details['ukuran'] ?? '' }}<br>
                                                Type: {{ $outboundDetail->details['type'] ?? '' }}<br>
                                                Lain lain: {{ $outboundDetail->details['spesifikasi_lain'] ?? '' }}<br>
                                                Fasilitas: {{ $hasilfasilitas[$key] ?? '' }}
                                                <br>
                                                Dokumen: {{ $outbound->outboundDocuments[0]->masterDocument->name ?? '' }}
                                            </p>

                                        </td>
                                        <td class="border w-15p m-cell" style="border-top: none;border-right: none">
                                            <p>Kategori: 1<br>
                                                Hasil Produksi</p>
                                            <p>
                                                <br>
                                                <br>
                                            <p>Kondisi: 1<br>
                                                Tidak Rusak</p>
                                            <p>
                                        </td>
                                        <td class="border w-15p m-cell" style="border-top: none;border-right: none">
                                            <p class="text-sm">
                                                BM: 
                                                {{ isset($outboundDetail->details['bm']) ? $outboundDetail->details['bm'] : ''}}%, 
                                                {{ isset($outboundDetail->details['bm_tax_value']) ? $outboundDetail->details['bm_tax_value'] : '' }}% 
                                                {{ isset($Taxtype[$key]['bm_tax_type']) ? $Taxtype[$key]['bm_tax_type'] : '' }}
                                                <br>

                                                BMT: 
                                                {{ isset($outboundDetail->details['bmt']) ? $outboundDetail->details['bmt'] : ''}}%, 
                                                {{ isset($outboundDetail->details['bmt_tax_value']) ? $outboundDetail->details['bmt_tax_value'] : '' }}% 
                                                {{ isset($Taxtype[$key]['bmt_tax_type']) ? $Taxtype[$key]['bmt_tax_type'] : '' }}
                                                <br>

                                                Cukai: 
                                                {{ isset($outboundDetail->details['cukai']) ? $outboundDetail->details['cukai'] : ''}}%, 
                                                {{ isset($outboundDetail->details['cukai_tax_value']) ? $outboundDetail->details['cukai_tax_value'] : ''}}% 
                                                {{ isset($Taxtype[$key]['cukai_tax_type']) ? $Taxtype[$key]['cukai_tax_type'] : '' }}
                                                <br>

                                                PPH: {{ isset($outboundDetail->details['pph']) ? $outboundDetail->details['pph'] : ''}}%,
                                                {{ isset($outboundDetail->details['pph_tax_value']) ? $outboundDetail->details['pph_tax_value'] : ''}}%
                                                {{ isset($Taxtype[$key]['pph_tax_type']) ? $Taxtype[$key]['pph_tax_type'] : '' }}
                                                <br>

                                                PPN: 
                                                {{ isset($outboundDetail->details['ppn']) ? $outboundDetail->details['ppn'] : ''}}%, 
                                                {{ isset($outboundDetail->details['ppn_tax_value']) ? $outboundDetail->details['ppn_tax_value'] : ''}}% 
                                                {{ isset($Taxtype[$key]['ppn_tax_type']) ?  $Taxtype[$key]['ppn_tax_type'] : '' }}
                                                <br>

                                                PPNBM: 
                                                {{ isset($outboundDetail->details['ppnbm']) ? $outboundDetail->details['ppnbm'] : ''}}%, 
                                                {{ isset($outboundDetail->details['ppnbm_tax_value']) ? $outboundDetail->details['ppnbm_tax_value'] : ''}}% 
                                                {{ isset($Taxtype[$key]['ppnbm_tax_type']) ? $Taxtype[$key]['ppnbm_tax_type'] : '' }}
                                                <br>

                                            </p>
                                        </td>
                                        <td class="border w-15p m-cell" style="border-top: none;border-right: none">
                                            <p class="text-sm">
                                                Jumlah dan jenis satuan: {{ $outbound->outboundDetails[0]->quantity ?? '' . ' ' .  $outbound->outboundDetails[0]->package->name ?? ''  }}
                                            </p>
                                            <p class="text-sm">
                                                berat bersih: {{$outbound->outboundDetails[0]->nett_weight ?? '' }}
                                            </p>
                                            <br><br>
                                            <p class="text-sm">
                                                Jumlah kemasan: {{ $outbound->outboundDetails[0]->package_details['jumlah']  ?? '' }}
                                            </p>
                                            <p class="text-sm">
                                                Jenis kemasan: {{ $outbound->outboundDetails[0]->package->name ?? '' }}
                                            </p>

                                        </td>
                                        <td class="border w-15p m-cell" style="border-top: none">
                                            <p>
                                                CIF: {{ $outbound->details['nilai_cif'] ?? '' }}
                                            </p>
                                            <p>
                                                Harga Penyerahan: {{ $outbound->details['harga_penyerahan'] ?? '' }}
                                            </p>
                                        </td>
                                    </tr>

                                </table>
                            </td>

                        </tr>
                        @endforeach
                    </table>
                </td>
            </tr>

        </table>
        <table class="no-spacing-border w-full">
            <tr class=" text-sm">
                <td class="border m-cell">
                    C. PENGESAHAN PENGUSAHA TPB<br><br>
                    Dengan ini saya menyatakan bertanggung jawab atas<br>
                    kebenaran hal-hal yang diberitahukan dalam pemberitahuan pabean ini<br>
                    Tempat, Tanggal : {{ $outbound->city->city }}, {{ $outbound->details['pabean_tanggal'] }}<br>
                    <p>Nama Lengkap : {{ $outbound->details['pabean_pemberitahu'] }}</p>
                    <p>Jabatan : {{ $outbound->details['pabean_jabatan'] }}</p>
                    Tanda Tangan dan Stempel Perusahaan :<br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </td>
            </tr>

        </table>
        <span class="text-xs">Rangkap ke-1 / 2 / 3 : Kantor Pabean / Pengusaha TPB / Pengirim Barang</span>
    </div>

    <div class="page_break"></div>

    <div class="page-2 letter-a4">

        <div class="text-lg text-center">LEMBAR LANJUTAN DOKUMEN PELENGKAP PABEAN<br>
            PEMBERITAHUAN IMPOR BARANG DARI TEMPAT PENIMBUNAN BERIKAT</div>
        <table class="w-full no-spacing-border">
            <tr>
                <td>
                    <table class="w-full border">
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
                                            <p class="text-sm">Kantor Pabean</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundKppbc->masterKppbc->description ?? ''}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">Nomor Pengajuan</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundJenisTpb->masterJenisTpb->name ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                            <td>
                                <p class="text-sm">Tanggal : {{ $outbound->details['tanggal_pendaftaran'] }}</p>
                            </td>
                            <td class="pull-top">
                                <span class="text-sm border " style="padding: 0px 5px 0px">{{ $outbound->outboundKppbc->masterKppbc->code }}</span>
                                <br>
                            </td>
                            <td class="pull-top">
                                <span class="text-sm">Halaman 2 dari 3</span>
                                <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="w-full">
                    <table class="no-spacing-border w-full text-md" style="border-top: none">
                        <tr>
                            <td class="border w-5p m-cell" style="border-right: none;border-bottom: none;border-top: none">No.</td>
                            <td class="border w-40p m-cell" style="border-right: none;border-bottom: none;border-top: none">Jenis Dokumen</td>
                            <td class="border w-25p m-cell" style="border-right: none;border-bottom: none;border-top: none">Nomor Dokumen</td>
                            <td class="border w-25p m-cell" style="border-bottom: none;border-top: none">Tanggal Dokumen</td>
                        </tr>
                    </table>
                </td>
            </tr>

            @if(isset($outbound->outboundDocuments))
            @foreach($outbound->outboundDocuments as $key=>$outboundDocument)
            <tr>
                <td class="w-full">
                    <table class="no-spacing-border w-full" style="border-right: none;border-bottom: none">
                        <tr>
                            <td class="border w-5p m-cell" style="border-right: none;border-bottom: none">
                                <p class="text-sm">
                                    {{ $key + 1 }}
                                </p>
                            </td>
                            <td class="border w-40p m-cell" style="border-right: none;border-bottom: none">
                                <p class="text-sm">
                                    {{ $outboundDocument->masterDocument->name }}
                                </p>
                            </td>
                            <td class="border w-25p m-cell" style="border-right: none;border-bottom: none">
                                <p class="text-sm">
                                    {{ $outboundDocument->details['nomor_dokumen'] }}
                                </p>
                            </td>
                            <td class="border w-25p m-cell" style="border-bottom: none">
                                <p class="text-sm">
                                    {{ $outboundDocument->details['date'] }}
                                </p>
                            </td>
                        </tr>

                    </table>
                </td>

            </tr>
            @endforeach
            @if(count($outbound->outboundDocuments) == 0)
            <tr>
                <td class="w-full">
                    <table class="no-spacing-border w-full" style="border-right: none;border-bottom: none">
                        <tr>
                            <td class="border w-5p m-top">
                                <p class="text-sm">

                                </p>
                            </td>
                            <td class="border w-40p m-top" style="border-right: none;border-bottom: none">
                                <p class="text-sm">

                                </p>
                            </td>
                            <td class="border w-25p m-top" style="border-right: none;border-bottom: none">
                                <p class="text-sm">

                                </p>
                            </td>
                            <td class="border w-25p m-top" style="border-bottom: none">
                                <p class="text-sm">

                                </p>
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
            @endif
            @else
            <tr>
                <td class="w-full">
                    <table class="no-spacing-border w-full">
                        <tr>
                            <td class="border w-5p m-top" style="border-right: none;border-bottom: none">
                                <p class="text-sm">

                                </p>
                            </td>
                            <td class="border w-40p m-top" style="border-right: none;border-bottom: none">
                                <p class="text-sm">

                                </p>
                            </td>
                            <td class="border w-25p m-top" style="border-right: none;border-bottom: none">
                                <p class="text-sm">

                                </p>
                            </td>
                            <td class="border w-25p m-top" style="border-bottom: none">
                                <p class="text-sm">

                                </p>
                            </td>
                        </tr>

                    </table>
                </td>

            </tr>
            @endif
            <tr>
                <td class="w-full">
                    <table class="no-spacing-border w-full">
                        <tr>
                            <td class="border m-cell">
                                <p class="text-md m-cell">C. PENGESAHAN PENGUSAHA TPB</p>
                                <p class="text-sm m-cell">
                                    Tempat, Tanggal : {{ $outbound->city->city }}, {{ $outbound->details['pabean_tanggal'] }}
                                </p>
                                <p class="text-sm m-cell">
                                    Nama Lengkap : {{ $outbound->details['pabean_pemberitahu'] }}
                                </p>
                                <p class="text-sm m-cell">
                                    Jabatan : {{ $outbound->details['pabean_jabatan'] }}
                                </p>
                                <p class="text-sm m-cell">
                                    Tanda Tangan dan Stempel Perusahaan :<br><br><br><br><br>
                                </p>
                            </td>
                        </tr>

                    </table>
                </td>

            </tr>

            <span class="text-xs">Rangkap ke-1 / 2 / 3 : Pengusaha TPB / KPPBC Pengawas / Penerima Barang</span>
        </table>
    </div>


    <div class="page_break"></div>


    <div class="page-2 letter-a4">

        <div class="text-md text-center">LEMBAR LAMPIRAN<br>
            DATA PENGGUNAAN BARANG DAN/ATAU BAHAN IMPOR<br>
            PEMBERITAHUAN IMPOR BARANG DARI TEMPAT PENIMBUNAN BERIKAT<div class="pull-right text-sm"> BC 2.5</div>
        </div>
        <table class="w-full no-spacing-border">
            <tr>
                <td>
                    <table class="w-full border">
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
                                            <p class="text-sm">Kantor Pabean</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundKppbc->masterKppbc->description ?? ''}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">Nomor Pengajuan</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundJenisTpb->masterJenisTpb->name ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                            <td>

                            </td>
                            <td>
                                <p class="text-sm">Tanggal : {{ $outbound->details['tanggal_pendaftaran'] }}</p>
                            </td>
                            <td class="pull-top">
                                <span class="text-sm border " style="padding: 0px 5px 0px">{{ $outbound->outboundKppbc->masterKppbc->code }}</span>
                                <br>
                            </td>
                            <td class="pull-top">
                                <span class="text-sm">Halaman 3 dari 3</span>
                                <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="w-full no-spacing-border">
            <tr>
                <td class="border m-cell w-5p text-center text-sm" style="border-right: none; border-top: none">
                    No. Urut Barang
                </td>
                <td class="border m-cell w-15p text-sm" style="border-right: none; border-top: none">
                    - Kode Kantor<br>
                    - No/Tgl Daftar BC 2.3,<br>
                    BC 2.7, Lainnya *)<br>
                </td>
                <td class="border m-cell w-10p text-sm" style="border-right: none; border-top: none">
                    No. Urut<br>
                    Dalam<br>
                    - BC 2.3<br>
                    - BC 2.7<br>
                    - Lainnya *)<br>

                </td>
                <td class="border m-cell w-20p text-sm" style="border-right: none; border-top: none">
                    - Pos tarif/ HS, uraian jumlah<br>
                    dan jenis barang secara<br>
                    lengkap, kode barang merk,<br>
                    tipe, ukuran, dan spesifikasi<br>
                    lain<br>
                    - Perijinan/Fasilitas<br>
                </td>
                <td class="border m-cell w-10p text-sm" style="border-right: none; border-top: none">
                    - Jumlah<br>
                    - Satuan<br>
                </td>
                <td class="border m-cell w-20p text-sm" style="border-right: none; border-top: none">
                    Nilai<br>
                    - CIF<br>
                    - Harga<br>
                    penyerahan (Rp)<br>
                </td>
                <td class="border m-cell w-20p text-sm" style=" border-top: none">
                    Nilai (Rp)<br>
                    BM, BMT, Cukai,<br>
                    PPN, PPnBM,<br>
                    PPh 22<br>
                </td>
            </tr>
        </table>
        <table class="w-full no-spacing-border">
            <tr>
                <td class="border m-cell w-5p text-center text-sm" style="border-right: none; border-top: none">
                    <p style="padding-left: 10px; padding-right: 10px">(1)</p>
                </td>
                <td class="border m-cell text-center w-15p text-sm" style="border-right: none; border-top: none">
                    (2)
                </td>
                <td class="border m-cell text-center w-10p text-sm" style="border-right: none; border-top: none">
                    (3)

                </td>
                <td class="border m-cell text-center w-20p text-sm" style="border-right: none; border-top: none">
                    (4)
                </td>
                <td class="border m-cell text-center w-10p text-sm" style="border-right: none; border-top: none">
                    (5)
                </td>
                <td class="border m-cell text-center w-20p text-sm" style="border-right: none; border-top: none">
                    (6)
                </td>
                <td class="border m-cell text-center w-20p text-sm" style=" border-top: none">
                    (7)
                </td>
            </tr>
        </table>
        @if($outbound->details['type_calculate'] == 1)
        @foreach($outbound->outboundDetails as $key1=>$outboundnya)
        @foreach ($outboundnya->outboundDetailRawGoods as $key2=>$outboundnya2)
        @if ($outboundnya2->bc_form_id == 3)
        <table class="w-full no-spacing-border">
            <tr>
                <td class="border m-cell w-5p text-center text-sm" style="border-right: none; border-top: none">
                    <p style="padding-left: 9px; padding-right: 9px">{{ $key1+1 }}.{{ $key2+1 }}</p>
                </td>
                <td class="border m-cell w-15p text-sm" style="border-right: none; border-top: none">
                    Kantor : {{ $outboundnya2->inboundDetail->inbound->inboundKppbc->masterKppbc->code }}<br>
                    {{ $outboundnya2->inboundDetail->inbound->inboundKppbc->masterKppbc->description }}<br><br>
                    Dok. Asal {{ $outboundnya2->inboundDetail->inbound->bcForm->name }}<br><br>
                    No. {{ $outboundnya2->inboundDetail->inbound->request_number }}<br><br>
                    Tgl. {{ date('d-m-Y', strtotime($outboundnya2->inboundDetail->inbound->created_at)); }}<br>

                </td>
                <td class="border m-cell w-10p text-sm" style="border-right: none; border-top: none">
                    Seri barang ke-{{ $key1+1 }}

                </td>
                <td class="border m-cell w-20p text-sm" style="border-right: none; border-top: none">
                    Pos: {{ $outboundnya2->hsCode->code ?? '' }} <br>
                    Kode Brg: {{ $outboundnya2->details['kode_barang'] ?? '' }}<br>
                    {{ $outboundnya2->good->name }}<br>
                    Uraian: {{ $outboundnya2->details['uraian'] ?? '' }}<br>
                    Merk: {{ $outboundnya2->details['merk'] ?? '' }}<br>
                    Ukuran: {{ $outboundnya2->details['ukuran'] ?? '' }}<br>
                    Type: {{ $outboundnya2->details['type'] ?? '' }}<br>
                    Lain lain: {{ $outboundnya2->details['spesifikasi_lain'] ?? '' }}<br>
                    Fasilitas: -
                    {{-- @foreach ($fasilitas as $fasilitas)
                                                {{ $fasilitas->id }} <br>
                    @endforeach --}}
                    <br>
                    Dokumen: {{ $outbound->outboundDocuments[0]->masterDocument->name ?? '' }}
                </td>
                <td class="border m-cell w-10p text-sm" style="border-right: none; border-top: none">
                    - {{ $outboundnya2->quantity }}<br>
                    - {{ $outboundnya2->good->uom->name }}
                </td>
                <td class="border m-cell w-20p text-sm" style="border-right: none; border-top: none">
                    <p>CIF : </p><br>
                    <p style="text-align: right">{{ $outboundnya2->details['nilai_cif'] }}</p><br>
                    <p>Harga Penyerahan : </p><br>
                    <p style="text-align: right">0.00</p>
                </td>
                <td class="border m-cell w-20p text-sm" style=" border-top: none">
                    <p>BM</p>
                    <p style="text-align: right">{{ isset($outboundnya2->inboundDetail->details['bm_tax_value']) ? $outboundnya2->inboundDetail->details['bm_tax_value'] : '' }}</p>
                    <p>PPN</p>
                    <p style="text-align: right">{{ isset($outboundnya2->inboundDetail->details['ppn_tax_value']) ? $outboundnya2->inboundDetail->details['ppn_tax_value'] : '' }}</p>
                    <p>PPNBM</p>
                    <p style="text-align: right">{{ isset($outboundnya2->inboundDetail->details['ppnbm_tax_value']) ? $outboundnya2->inboundDetail->details['ppnbm_tax_value'] : '' }}</p>
                    <p>PPH</p>
                    <p style="text-align: right">{{ isset($outboundnya2->inboundDetail->details['pph_tax_value']) ? $outboundnya2->inboundDetail->details['pph_tax_value'] : '' }}</p>
                </td>
            </tr>
        </table>
        @endif
        @endforeach
        @endforeach
        @endif
        @if ($outbound->details['type_calculate'] == 0)
        @foreach($outbound->outboundDetails as $key1=>$outboundnya)
        @foreach ($outboundnya->inventoryOutboundDetail as $key2=>$outboundnya2)
        @if ($outboundnya2->bc_form_id == 3)
        <table class="w-full no-spacing-border">
            <tr>
                <td class="border m-cell w-5p text-center text-sm" style="border-right: none; border-top: none">
                    <p style="padding-left: 9px; padding-right: 9px">{{ $key1+1 }}.{{ $key2+1 }}</p>
                </td>
                <td class="border m-cell w-15p text-sm" style="border-right: none; border-top: none">
                    Kantor : {{ $outboundnya2->inboundDetail->inbound->inboundKppbc->masterKppbc->code }}<br>
                    {{ $outboundnya2->inboundDetail->inbound->inboundKppbc->masterKppbc->description }}<br><br>
                    Dok. Asal {{ $outboundnya2->inboundDetail->inbound->bcForm->name }}<br><br>
                    No. {{ $outboundnya2->inboundDetail->inbound->request_number }}<br><br>
                    Tgl. {{ date('d-m-Y', strtotime($outboundnya2->inboundDetail->inbound->created_at)) }}<br>

                </td>
                <td class="border m-cell w-10p text-sm" style="border-right: none; border-top: none">
                    Seri barang ke-{{ $key1+1 }}

                </td>
                <td class="border m-cell w-20p text-sm" style="border-right: none; border-top: none">
                    Pos: {{ $outboundnya2->inboundDetail->hsCode->code ?? '' }} <br>
                    Kode Brg: {{ $outboundnya2->inboundDetail->details['kode_barang'] ?? '' }}<br>
                    {{ $outboundnya2->good->name }}<br>
                    Uraian: {{ $outboundnya2->good->details['uraian'] ?? '' }}<br>
                    Merk: {{ $outboundnya2->good->details['merk'] ?? '' }}<br>
                    Ukuran: {{ $outboundnya2->good->details['ukuran'] ?? '' }}<br>
                    Type: {{ $outboundnya2->good->details['type'] ?? '' }}<br>
                    Lain lain: {{ $outboundnya2->good->details['spesifikasi_lain'] ?? '' }}<br>
                    Fasilitas: -
                    {{-- @foreach ($fasilitas as $fasilitas)
                                                {{ $fasilitas->id }} <br>
                    @endforeach --}}
                    <br>
                    Dokumen: {{ $outbound->outboundDocuments[0]->masterDocument->name ?? '' }}
                </td>
                <td class="border m-cell w-10p text-sm" style="border-right: none; border-top: none">
                    - {{ $outboundnya2->quantity_good_conversion }}<br>
                    - {{ $outboundnya2->good->uom->name }}
                </td>
                <td class="border m-cell w-20p text-sm" style="border-right: none; border-top: none">
                    <p>CIF : </p><br>
                    <p style="text-align: right">{{ $outboundnya2->inboundDetail->details['nilai_cif'] ?? '' }}</p><br>
                    <p>Harga Penyerahan : </p><br>
                    <p style="text-align: right">{{ $outboundnya2->inboundDetail->details['harga_penyerahan'] ?? '' }}</p>
                </td>
                <td class="border m-cell w-20p text-sm" style=" border-top: none">
                    <p>BM</p>
                    <p style="text-align: right">{{ $outboundnya2->inboundDetail->details['bm_tax_value'] ?? '' }}</p>
                    <p>PPN</p>
                    <p style="text-align: right">{{ $outboundnya2->inboundDetail->details['ppn_tax_value'] ?? '' }}</p>
                    <p>PPNBM</p>
                    <p style="text-align: right">{{ $outboundnya2->inboundDetail->details['ppnbm_tax_value'] ?? '' }}</p>
                    <p>PPH</p>
                    <p style="text-align: right">{{ $outboundnya2->inboundDetail->details['pph_tax_value'] ?? '' }}</p>
                </td>
            </tr>
        </table>
        @endif
        @endforeach
        @endforeach
        @endif
        <table class="no-spacing-border w-full">
            <tr class=" text-sm">
                <td class="border m-cell">
                    C. PENGESAHAN PENGUSAHA TPB<br><br>
                    Dengan ini saya menyatakan bertanggung jawab atas<br>
                    kebenaran hal-hal yang diberitahukan dalam pemberitahuan pabean ini<br>
                    Tempat, Tanggal : {{ $outbound->city->city }}, {{ $outbound->details['pabean_tanggal'] }}<br>
                    <p>Nama Lengkap : {{ $outbound->details['pabean_pemberitahu'] }}</p>
                    <p>Jabatan : {{ $outbound->details['pabean_jabatan'] }}</p>
                    Tanda Tangan dan Stempel Perusahaan :<br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </td>
            </tr>

        </table>
        <span class="text-xs">Rangkap ke-1 / 2 / 3 : Kantor Pabean / Pengusaha TPB / Pengirim Barang</span>

    </div>

    <div class="page_break"></div>


    <div class="page-2 letter-a4">

        <div class="text-md text-center">LEMBAR LAMPIRAN<br>
            DATA PENGGUNAAN BARANG DAN/ATAU BAHAN TLDDP<br>
            PEMBERITAHUAN IMPOR BARANG DARI TEMPAT PENIMBUNAN BERIKAT<div class="pull-right text-sm"> BC 2.5</div>
        </div>
        <table class="w-full no-spacing-border">
            <tr>
                <td>
                    <table class="w-full border">
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
                                            <p class="text-sm">Kantor Pabean</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundKppbc->masterKppbc->description ?? ''}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">Nomor Pengajuan</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $outbound->outboundJenisTpb->masterJenisTpb->name ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                            <td>
                                <p class="text-sm">Tanggal : {{ $outbound->details['tanggal_pendaftaran'] }}</p>
                            </td>
                            <td class="pull-top">
                                <span class="text-sm border " style="padding: 0px 5px 0px">{{ $outbound->outboundKppbc->masterKppbc->code }}</span>
                                <br>
                            </td>
                            <td class="pull-top">
                                <span class="text-sm">Halaman 3 dari 3</span>
                                <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="w-full no-spacing-border">
            <tr>
                <td class="border m-cell w-5p text-center text-sm" style="border-right: none; border-top: none">
                    No. Urut Barang
                </td>
                <td class="border m-cell w-15p text-sm" style="border-right: none; border-top: none">
                    - Kode Kantor<br>
                    - No/Tgl Daftar BC 4.0,<br>
                    BC 2.7, Lainnya *)<br>
                </td>
                <td class="border m-cell w-10p text-sm" style="border-right: none; border-top: none">
                    No. Urut<br>
                    Dalam<br>
                    - BC 4.0<br>
                    - BC 2.7<br>
                    - Lainnya *)<br>

                </td>
                <td class="border m-cell w-20p text-sm" style="border-right: none; border-top: none">
                    - Pos tarif/ HS, uraian jumlah<br>
                    dan jenis barang secara<br>
                    lengkap, kode barang merk,<br>
                    tipe, ukuran, dan spesifikasi<br>
                    lain<br>
                    - Perijinan/Fasilitas<br>
                </td>
                <td class="border m-cell w-10p text-sm" style="border-right: none; border-top: none">
                    - Jumlah<br>
                    - Satuan<br>
                </td>
                <td class="border m-cell w-20p text-sm" style="border-right: none; border-top: none">
                    Nilai (Rp)<br>
                    - Harga perolehan<br>
                    - Harga<br>
                    penyerahan (Rp)<br>
                </td>
                <td class="border m-cell w-20p text-sm" style=" border-top: none">
                    Nilai PPN (Rp)
                </td>
            </tr>
        </table>
        <table class="w-full no-spacing-border">
            <tr>
                <td class="border m-cell w-5p text-center text-sm" style="border-right: none; border-top: none">
                    <p style="padding-left: 10px; padding-right: 10px">(1)</p>
                </td>
                <td class="border m-cell text-center w-15p text-sm" style="border-right: none; border-top: none">
                    (2)
                </td>
                <td class="border m-cell text-center w-10p text-sm" style="border-right: none; border-top: none">
                    (3)

                </td>
                <td class="border m-cell text-center w-20p text-sm" style="border-right: none; border-top: none">
                    (4)
                </td>
                <td class="border m-cell text-center w-10p text-sm" style="border-right: none; border-top: none">
                    (5)
                </td>
                <td class="border m-cell text-center w-20p text-sm" style="border-right: none; border-top: none">
                    (6)
                </td>
                <td class="border m-cell text-center w-20p text-sm" style=" border-top: none">
                    (7)
                </td>
            </tr>
        </table>
        @if($outbound->details['type_calculate'] == 1)
        @foreach($outbound->outboundDetails as $key1=>$outboundnya)
        @foreach ($outboundnya->outboundDetailRawGoods as $key2=>$outboundnya2)
        @if ($outboundnya2->bc_form_id == 1)
        <table class="w-full no-spacing-border">
            <tr>
                <td class="border m-cell w-5p text-center text-sm" style="border-right: none; border-top: none">
                    <p style="padding-left: 9px; padding-right: 9px">{{ $key1+1 }}.{{ $key2+1 }}</p>
                </td>
                <td class="border m-cell w-15p text-sm" style="border-right: none; border-top: none">
                    Kantor : {{ $outboundnya2->inboundDetail->inbound->inboundKppbc->masterKppbc->code ?? '' }}<br>
                    {{ $outboundnya2->inboundDetail->inbound->inboundKppbc->masterKppbc->description ?? '' }}<br><br>
                    Dok. Asal {{ $outboundnya2->inboundDetail->inbound->bcForm->name ?? '' }}<br><br>
                    No. {{ $outboundnya2->inboundDetail->inbound->request_number ?? '' }}<br><br>
                    Tgl. {{ date('d-m-Y', strtotime($outboundnya2->inboundDetail->inbound->created_at)); }}<br>

                </td>
                <td class="border m-cell w-10p text-sm" style="border-right: none; border-top: none">
                    Seri barang ke-{{ $key1+1 }}

                </td>
                <td class="border m-cell w-20p text-sm" style="border-right: none; border-top: none">
                    Pos: {{ $outboundnya2->hsCode->code ?? '' }} <br>
                    Kode Brg: {{ $outboundnya2->details['kode_barang'] ?? '' }}<br>
                    {{ $outboundnya2->good->name ?? '' }}<br>
                    Uraian: {{ $outboundnya2->details['uraian'] ?? '' }}<br>
                    Merk: {{ $outboundnya2->details['merk'] ?? '' }}<br>
                    Ukuran: {{ $outboundnya2->details['ukuran'] ?? '' }}<br>
                    Type: {{ $outboundnya2->details['type'] ?? '' }}<br>
                    Lain lain: {{ $outboundnya2->details['spesifikasi_lain'] ?? '' }}<br>
                    Fasilitas: -
                    {{-- @foreach ($fasilitas as $fasilitas)
                                                {{ $fasilitas->id }} <br>
                    @endforeach --}}
                    <br>
                    Dokumen: {{ $outbound->outboundDocuments[0]->masterDocument->name ?? '' }}
                </td>
                <td class="border m-cell w-10p text-sm" style="border-right: none; border-top: none">
                    - {{ $outboundnya2->quantity ?? '' }}<br>
                    - {{ $outboundnya2->good->uom->name ?? '' }}
                </td>
                <td class="border m-cell w-20p text-sm" style="border-right: none; border-top: none">
                    <p>Harga Perolehan : </p><br>
                    <p style="text-align: right">{{ $outboundnya2->inboundDetail->details['harga_perolehan'] ?? '' }}</p><br>
                    <p>Harga Penyerahan : </p><br>
                    <p style="text-align: right">{{ $outboundnya2->inboundDetail->details['harga_penyerahan'] ?? '' }}</p>
                </td>
                <td class="border m-cell w-20p text-sm" style=" border-top: none">
                    <p style="text-align: right">{{ $outboundnya2->inboundDetail->details['ppn_tax_value'] ?? '' }}</p>
                </td>
            </tr>
        </table>
        @endif
        @endforeach
        @endforeach


        @endif
        @if ($outbound->details['type_calculate'] == 0)
        @foreach($outbound->outboundDetails as $key1=>$outboundnya)
        @foreach ($outboundnya->inventoryOutboundDetail as $key2=>$outboundnya2)
        @if ($outboundnya2->bc_form_id == 1)
        <table class="w-full no-spacing-border">
            <tr>
                <td class="border m-cell w-5p text-center text-sm" style="border-right: none; border-top: none">
                    <p style="padding-left: 9px; padding-right: 9px">{{ $key1+1 }}.{{ $key2+1 }}</p>
                </td>
                <td class="border m-cell w-15p text-sm" style="border-right: none; border-top: none">
                    Kantor : {{ $outboundnya2->inboundDetail->inbound->inboundKppbc->masterKppbc->code }}<br>
                    {{ $outboundnya2->inboundDetail->inbound->inboundKppbc->masterKppbc->description }}<br><br>
                    Dok. Asal {{ $outboundnya2->inboundDetail->inbound->bcForm->name }}<br><br>
                    No. {{ $outboundnya2->inboundDetail->inbound->request_number }}<br><br>
                    Tgl. {{ date('d-m-Y', strtotime($outboundnya2->inboundDetail->inbound->created_at)) }}<br>

                </td>
                <td class="border m-cell w-10p text-sm" style="border-right: none; border-top: none">
                    Seri barang ke-{{ $key1+1 }}

                </td>
                <td class="border m-cell w-20p text-sm" style="border-right: none; border-top: none">
                    Pos: {{ $outboundnya2->inboundDetail->hsCode->code ?? '' }} <br>
                    Kode Brg: {{ $outboundnya2->inboundDetail->details['kode_barang'] ?? '' }}<br>
                    {{ $outboundnya2->good->name }}<br>
                    Uraian: {{ $outboundnya2->good->details['uraian'] ?? '' }}<br>
                    Merk: {{ $outboundnya2->good->details['merk'] ?? '' }}<br>
                    Ukuran: {{ $outboundnya2->good->details['ukuran'] ?? '' }}<br>
                    Type: {{ $outboundnya2->good->details['type'] ?? '' }}<br>
                    Lain lain: {{ $outboundnya2->good->details['spesifikasi_lain'] ?? '' }}<br>
                    Fasilitas: -
                    {{-- @foreach ($fasilitas as $fasilitas)
                                                {{ $fasilitas->id }} <br>
                    @endforeach --}}
                    <br>
                    Dokumen: {{ $outbound->outboundDocuments[0]->masterDocument->name ?? '' }}
                </td>
                <td class="border m-cell w-10p text-sm" style="border-right: none; border-top: none">
                    - {{ $outboundnya2->quantity_good_conversion }}<br>
                    - {{ $outboundnya2->good->uom->name }}
                </td>
                <td class="border m-cell w-20p text-sm" style="border-right: none; border-top: none">
                    <p>Harga Perolehan : </p><br>
                    <p style="text-align: right">{{ $outboundnya2->inboundDetail->details['harga_perolehan'] ?? '' }}</p><br>
                    <p>Harga Penyerahan : </p><br>
                    <p style="text-align: right">{{ $outboundnya2->inboundDetail->details['harga_penyerahan'] ?? '' }}</p>
                </td>
                <td class="border m-cell w-20p text-sm" style=" border-top: none">
                    <p style="text-align: right">{{ $outboundnya2->details['ppn_tax_value'] ?? ''  }}</p>
                </td>
            </tr>
        </table>
        @endif
        @endforeach
        @endforeach
        @endif
        <table class="no-spacing-border w-full">
            <tr class=" text-sm">
                <td class="border m-cell">
                    C. PENGESAHAN PENGUSAHA TPB<br><br>
                    Dengan ini saya menyatakan bertanggung jawab atas<br>
                    kebenaran hal-hal yang diberitahukan dalam pemberitahuan pabean ini<br>
                    Tempat, Tanggal : {{ $outbound->city->city }}, {{ $outbound->details['pabean_tanggal'] }}<br>
                    <p>Nama Lengkap : {{ $outbound->details['pabean_pemberitahu'] }}</p>
                    <p>Jabatan : {{ $outbound->details['pabean_jabatan'] }}</p>
                    Tanda Tangan dan Stempel Perusahaan :<br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </td>
            </tr>

        </table>
        <span class="text-xs">Rangkap ke-1 / 2 / 3 : Kantor Pabean / Pengusaha TPB / Pengirim Barang</span>

    </div>

</div>

</html>