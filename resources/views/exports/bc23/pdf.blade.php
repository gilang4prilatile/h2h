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

        .w-7p {
            width: 7%;
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

        <div class="text-md text-center">
            PEMBERITAHUAN IMPOR BARANG UNTUK DITIMBUN <br>
            DI TEMPAT PENIMBUNAN BERIKAT <span style="float: right">BC 2.3</span></div>
        <table class="w-full no-spacing-border">
            <tr>
                <table class="border w-full" style="border-bottom: none">
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <p class="text-sm">Nomor Pengajuan</p>
                                    </td>
                                    <td colspan="2">
                                        <p class="text-sm">
                                            : {{ $inbound->request_number ?? ''}}
                                        </p>
                                    </td>
                                    <td></td>
                                    <td>
                                        <span class="text-sm">Halaman ke-1 dari 2</span>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm">A. Tujuan</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">: <span class="text-sm border" style="padding-right:6px;"> {{ $tujuanTPBBC }} </span></p>
                                    </td>
                                    <td colspan="3">
                                        <p class="text-sm">{{ $htmlTujuanTPB }}</p>
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
                        <td class="border w-50p m-cell" style="border-right: none">
                            <table>
                                <tr>
                                    <td class="w-70p" colspan="2">
                                        <p class="text-md">B. DATA PEMBERITAHUAN<br>
                                            PEMASOK</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm">1. Nama, <br>Alamat, <br>Negara</p>
                                    </td>
                                    <td>
                                        @if(isset($inbound->inboundPpjk))
                                            <p class="text-sm">: {{ $inbound->inboundPpjk->profile->name ?? '' }},<br>
                                                {{ $inbound->inboundPpjk->profile->address ?? '' }},<br>
                                                {{ $countryppjk->name ?? '' }}
                                            </p>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td class="border w-50p m-cell">
                            <table>
                                <tr>
                                    <td class="w-50p" style="border-bottom: none;border-left: none" colspan="3">
                                        <p class="text-md ">D. DIISI OLEH BEA DAN CUKAI</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p class="text-sm">No. dan Tgl. Pendaftaran</p>
                                    </td>
                                    <td>
                                        <div class="border" style="padding: 10px 55px"></div>

                                    </td>
                                    <td colspan="2">
                                        <div class="border" style="padding: 10px 55px"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm">Kantor Pabean Bongkar</p>
                                    </td>
                                    <td colspan="2">
                                        <p class="text-sm">: {{ $inbound->inboundKppbcBongkar->masterKppbc->description ?? '' }}</p>
                                    </td>
                                    <td>
                                        <div class="text-sm border" style="padding-left: 2px; padding-right: 2px;">{{ $inbound->inboundKppbcBongkar->masterKppbc->code ?? ''  }}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm">Kantor Pabean Pengawas</p>
                                    </td>
                                    <td colspan="2">
                                        <p class="text-sm">: {{ $inbound->inboundKppbcPengawas->masterKppbc->description ?? '' }}</p>
                                    </td>
                                    <td>
                                        <div class="text-sm border" style="padding-left: 2px; padding-right: 2px;">{{ $inbound->inboundKppbcPengawas->masterKppbc->code ?? ''  }}</div>
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
                                        <p class="text-md  ">IMPORTIR</p>
                                    </td>
                                </tr>
                                <tr class=" w-full">
                                    <td>
                                        <p class="text-sm">2. Identitas (NPWP)</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">: {{ $inbound->inboundImportir->profile->details['nomor_identitas'] ?? '' }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm">3. Nama, Alamat</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">: {{ $inbound->inboundImportir->profile->name ?? '' }}, {{ $inbound->inboundImportir->profile->address ?? '' }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm">4. No Izin TPB</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">: {{ $inbound->inboundImportir->profile->details['nomor_izin'] ?? '' }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm">5. API</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">: {{ $inbound->inboundImportir->profile->details['nomor_api'] ?? '' }}</p>
                                    </td>
                                </tr>

                            </table>
                            <br>
                            <hr class="w-full">
                            <br>
                            <table>
                                <tr>
                                    <td class=" w-full" colspan="2">
                                        <p class="text-md  ">PEMILIK BARANG</p>
                                    </td>
                                </tr>
                                <tr class=" w-full">
                                    <td>
                                        <p class="text-sm">6. Identitas (NPWP)</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">: {{ $inbound->inboundPemilikBarang->profile->details['nomor_identitas'] ?? '' }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm">7. Nama, Alamat</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">: {{ $inbound->inboundPemilikBarang->profile->name ?? '' }}, {{ $inbound->inboundImportir->profile->address ?? '' }}</p>
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <hr class="w-full">
                            <br>
                            <table>
                                <tr>
                                    <td class=" w-full" colspan="2">
                                        <p class="text-md  ">PPJK</p>
                                    </td>
                                </tr>
                                <tr class=" w-full">
                                    <td>
                                        <p class="text-sm">8. NPWP</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">: {{ isset($inbound->inboundPpjk) ? $inbound->inboundPpjk->profile->details['nomor_identitas'] : '' }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm">9. Nama, Alamat</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">: {{ isset($inbound->inboundPpjk) ? $inbound->inboundPpjk->profile->name : '' }}, {{ isset($inbound->inboundPpjk) ? $inbound->inboundPpjk->profile->address : '' }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm">10. No dan tgl NP-PPJK</p>
                                    </td>
                                    <td class="w-25p">
                                        <div class="border" style="padding: 10px">
                                            <p class="text-sm">{{ isset($inbound->inboundPpjk) ? $inbound->inboundPpjk->profile->details['nomor_ppjk'] : '' }}</p>
                                        </div>
                                    </td>
                                    <td class="w-25p">
                                        <div class="border" style="padding: 10px">
                                            <p class="text-sm">{{ isset($inbound->inboundPpjk) ? $inbound->inboundPpjk->profile->details['tanggal_ppjk'] : '' }}</p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>

                        <td colspan="3" class="border" style="border-top: none">
                            <table class="no-spacing-border w-full">
                                <tr>
                                    <td class="w-50p m-cell">
                                        <table class="w-full ">
                                            <tr>
                                                <td class="w-25p">
                                                    <p class="text-sm">16. Invoice</p>
                                                </td>
                                                <td class="w-30p">
                                                    @foreach($inbound->inboundDocuments as $inboundDocument)
                                                    <p class="text-sm">{{$inboundDocument->document_id == 90 ? ": ". $inboundDocument->details['nomor_dokumen'] : ''}}</p>
                                                    @endforeach
                                                </td>
                                                <td class="w-5p">
                                                    <p class="text-sm">Tgl</p>
                                                </td>
                                                <td class="w-20p">
                                                    @foreach($inbound->inboundDocuments as $inboundDocument)
                                                    <p class="text-sm">{{$inboundDocument->document_id == 90 ? ": ". $inboundDocument->details['date'] : ''}}</p>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <br>
                                            <tr>
                                                <td class="w-25p">
                                                    <p class="text-sm">17. Fasilitas Impor</p>
                                                </td>
                                                <td class="w-30p">
                                                    @foreach($inbound->inboundDocuments as $inboundDocument)
                                                    <p class="text-sm">{{$inboundDocument->document_id == 10 ? ": ". $inboundDocument->details['nomor_dokumen'] : ''}}</p>
                                                    @endforeach
                                                </td>
                                                <td class="w-5p">
                                                    <p class="text-sm">Tgl</p>
                                                </td>
                                                <td class="w-20p">
                                                    @foreach($inbound->inboundDocuments as $inboundDocument)
                                                    <p class="text-sm">{{$inboundDocument->document_id == 10 ? ": ". $inboundDocument->details['date'] : ''}}</p>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <br>
                                            <tr>
                                                <td class="w-25p">
                                                    <p class="text-sm">18. Surat Keputusan<br>
                                                        /Dokumen Lainya</p>
                                                </td>
                                                <td class="w-30p">
                                                    @foreach($inbound->inboundDocuments as $inboundDocument)
                                                    <p class="text-sm">{{$inboundDocument->document_id == 142 ? ": ". $inboundDocument->details['nomor_dokumen'] : ''}}</p>
                                                    @endforeach
                                                </td>
                                                <td class="w-5p">
                                                    <p class="text-sm">Tgl</p>
                                                </td>
                                                <td class="w-20p">
                                                    @foreach($inbound->inboundDocuments as $inboundDocument)
                                                    <p class="text-sm">{{$inboundDocument->document_id == 142 ? ": ". $inboundDocument->details['date'] : ''}}</p>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <br>
                                            <tr>
                                                <td class="w-25p">
                                                    <p class="text-sm">19. LC</p>
                                                </td>
                                                <td class="w-30p">
                                                    @foreach($inbound->inboundDocuments as $inboundDocument)
                                                    <p class="text-sm">{{$inboundDocument->document_id == 465 ? ": ". $inboundDocument->details['nomor_dokumen'] : ''}}</p>
                                                    @endforeach
                                                </td>
                                                <td class="w-5p">
                                                    <p class="text-sm">Tgl</p>
                                                </td>
                                                <td class="w-20p">
                                                    @foreach($inbound->inboundDocuments as $inboundDocument)
                                                    <p class="text-sm">{{$inboundDocument->document_id == 465 ? ": ". $inboundDocument->details['date'] : ''}}</p>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <br>
                                            <tr>
                                                <td class="w-25p">
                                                    <p class="text-sm">20. BL / AWB</p>
                                                </td>
                                                <td class="w-30p">
                                                    @foreach($inbound->inboundDocuments as $inboundDocument)
                                                    <p class="text-sm">{{$inboundDocument->document_id == 705 ? ": ". $inboundDocument->details['nomor_dokumen'] : ''}}</p>
                                                    @endforeach
                                                </td>
                                                <td class="w-5p">
                                                    <p class="text-sm">Tgl</p>
                                                </td>
                                                <td class="w-20p">
                                                    @foreach($inbound->inboundDocuments as $inboundDocument)
                                                    <p class="text-sm">{{$inboundDocument->document_id == 705 ? ": ". $inboundDocument->details['date'] : ''}}</p>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <br>
                                            <tr>
                                                <td class="w-25p">
                                                    <p class="text-sm">21. BC 1.1</p>
                                                </td>
                                                <td class="w-30p">
                                                    @foreach($inbound->inboundDocuments as $inboundDocument)
                                                    <p class="text-sm">{{$inboundDocument->document_id == 104 ? ": ". $inboundDocument->details['nomor_dokumen'] : ''}}</p>
                                                    @endforeach
                                                </td>
                                                <td class="w-5p">
                                                    <p class="text-sm">Tgl</p>
                                                </td>
                                                <td class="w-20p">
                                                    @foreach($inbound->inboundDocuments as $inboundDocument)
                                                    <p class="text-sm">{{$inboundDocument->document_id == 104 ? ": ". $inboundDocument->details['date'] : ''}}</p>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td colspan="3">
                                                    @foreach($inbound->inboundDocuments as $inboundDocument)
                                                    <p class="text-sm">{{$inboundDocument->document_id == 104 ? "Pos : ". $inboundDocument->details['nomor_pos_dokumen'] : ''}} &nbsp; {{ $inboundDocument->document_id == 104 ? "Sub Pos : ". $inboundDocument->details['nomor_sub_pos_dokumen'] : ''}} &nbsp; {{ $inboundDocument->document_id == 104 ? "Sub Sub Pos : ".$inboundDocument->details['nomor_sub_sub_pos_dokumen'] : ''}}</p>
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

            {{-- <tr>
            <td>
            <table class="w-full no-spacing-border" >
                <tr >
                    <td class="border w-50p m-cell" style="border-top: none;border-right: none" rowspan="3">
                        <table>
                            <tr>
                                <td class=" w-full" colspan="2" >
                                    <p class="text-md  "  >PEMILIK BARANG</p>
                                </td>
                            </tr>
                            <tr class=" w-full">
                                <td>
                                    <p class="text-sm">2.  Identitas (NPWP)</p>
                                </td>
                                <td>
                                    <p class="text-sm">: {{ $inbound->inboundPemilikBarang->profile->details['nomor_identitas'] ?? '' }}</p>
            </td>
            </tr>
            <tr>
                <td>
                    <p class="text-sm">3. Nama, Alamat</p>
                </td>
                <td>
                    <p class="text-sm">: {{ $inbound->inboundPemilikBarang->profile->name ?? '' }}, {{ $inbound->inboundImportir->profile->address ?? '' }}</p>
                </td>
            </tr>
        </table>
        </td> --}}
        {{-- <td class="border m-cell w-25p" style="border-top: none;border-right: none;">
                        <table >
                            <tr>
                                <td class="w-45p">
                                    <p class="text-sm">19. Valuta</p>
                                </td>
                                <td class="w-45p">
                                    <p class="text-sm">: {{ $inbound->inboundTpb->profile->address ?? '' }}</p>
        </td>
        <td class="pull-top ">
            <span class="text-sm border pull-right " style="padding: 0px 5px 0px">USD</span>
        </td>
        </tr>
        <tr>
            <td>
                <p class="text-sm">: {{ $inbound->inboundValas->masterValas->name ?? '' }}</p>
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
                        <p class="text-sm">: {{ $inbound->details['ndpbm'] ?? '' }}</p>
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
                            <p class="text-sm">: {{ $inbound->details['cif'] ?? '' }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="text-sm">22. Harga Penyerahan</p>
                        </td>
                        <td>
                            <p class="text-sm">: {{ $inbound->details['harga_penyerahan'] ?? '' }}</p>
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
                            <p class="text-sm">: {{ $inbound->inboundTransportation->transportation->name ?? '' }}</p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr> --}}
        {{-- </table>
            </td>
        </tr> --}}

        <tr>
            <table class="w-full no-spacing-border text-md" style="border-top: none;border-bottom: none">
                <td class="border w-50p m-cell" style="border-top: none;border-right: none">
                    <table>
                        <tr class="w-full text-md">
                            <td>
                                11. Cara Pengangkutan :
                            </td>

                        </tr>
                        <tr class="w-full text-sm">
                            <td></td>
                            <td class="pull-right">
                                @if ($inbound->inboundTransportation->transportation->name == 'Pesawat')

                                UDARA <span class="border" style="padding: 2px 10px">1</span>
                                @else
                                LAUT <span class="border" style="padding: 2px 10px">1</span>
                                @endif

                            </td>
                        </tr>

                    </table>

                </td>
                <td class="border w-50p m-cell" style="border-top: none;">
                    <table>
                        <tr class="w-full text-md">
                            <td>
                                22. Tempat Penimbunan :
                            </td>

                        </tr>
                        <tr class="w-full text-sm">
                            <td></td>
                            <td>
                                {{ $inbound->inboundTPS->masterTPS->name   ?? '' }}
                                <span class="border" style="padding: 2px 10px">{{ $inbound->inboundTPS->masterTPS->code_warehouse   ?? '' }}</span>

                            </td>
                        </tr>

                    </table>

                </td>
            </table>
        </tr>

        <tr>
            <table class="w-full no-spacing-border text-md" style="border-top: none;border-bottom: none">
                <td class="border w-50p m-cell" style="border-top: none;border-right: none">
                    <table>
                        <tr class="w-full text-md">
                            <td colspan="2">
                                12. Nama Sarana Pengangkut & No. Voy/Flight dan Bendera :
                                <br>
                            </td>

                        </tr>
                        <tr class="w-full text-sm">
                            <td class="w-50p">
                                {{ $inbound->inboundTransportation->transportation->name ?? '' }}
                                {{ $inbound->inboundTransportation->vehicle_number ?? '' }}
                            </td>
                            <td class="w-50p">
                                {{ $countrytransport->name ?? '' }}
                                <span class="border" style="padding: 2px 10px">{{ $inbound->inboundTransportation->country_code ?? '' }}</span>
                            </td>
                        </tr>

                    </table>

                </td>
                <td class="border w-25p m-cell" style="border-top: none;border-right: none">
                    <table>
                        <tr class="w-full text-md">
                            <td>
                                23. Valuta :
                            </td>

                        </tr>
                        <tr class="w-full text-sm">
                            <td>
                                {{ $inbound->inboundValas->masterValas->name   ?? '' }}
                                <span class="border" style="padding: 2px 10px">{{ $inbound->inboundValas->masterValas->code   ?? '' }}</span>

                            </td>
                        </tr>

                    </table>

                </td>
                <td class="border w-25p m-cell" style="border-top: none;">
                    <table>
                        <tr class="w-full text-md">
                            <td>
                                24. NDPBM :
                            </td>

                        </tr>
                        <tr class="w-full text-sm">
                            <td class="w-75p"></td>
                            <td>
                                {{ $inbound->details['ndpbm'] ?? '' }}

                            </td>
                        </tr>

                    </table>

                </td>
            </table>
        </tr>

        <tr>
            <table class="w-full no-spacing-border text-md" style="border-top: none;border-bottom: none">
                <td class="border w-50p m-cell" style="border-top: none;border-right: none">
                    <table>
                        <tr class="w-33p text-md">
                            <td class="w-33p text-md">
                                13. Pelabuhan Muat <br>
                                14. Pelabuhan Transit <br>
                                15. Pelabuhan Bongkar
                            </td>
                            <td class="w-33p text-sm">
                                : {{ $loadingport->name ?? '' }}<br>
                                : {{ $transitPort->name ?? '' }}<br>
                                : {{ $unloadingPort->name ?? '' }}
                            </td>
                            <td class="w-33p text-sm">
                                <span class="border d-flex" style="padding: 0px 10px;text-align: right">{{ $loadingport->code   ?? '' }}</span><br>
                                <span class="border d-flex" style="padding: 0px 10px;text-align: right">{{ $transitPort->code   ?? '' }}</span><br>
                                <span class="border d-flex" style="padding: 0px 10px;text-align: right">{{ $unloadingPort->code  ?? '' }}</span>
                            </td>
                        </tr>


                    </table>

                </td>
                <td class="border w-25p m-cell" style="border-top: none;border-right: none">
                    <table>
                        <tr class="w-25p text-sm">
                            <td>
                                25. FOB : <br>
                                26. Freight : <br>
                                27. Asuransi LN/DN :
                            </td>
                            <td>
                                {{ $inbound->details['fob'] ?? '' }}<br>
                                {{ $inbound->details['freight'] ?? '' }}<br>
                                {{ $inbound->details['asuransi'] ?? '' }}
                            </td>
                        </tr>
                        <tr class="w-50p text-sm">

                        </tr>

                    </table>

                </td>
                <td class="border w-25p m-cell" style="border-top: none;">
                    <table>
                        <tr class="w-full text-md">
                            <td>
                                28. Nilai CIF :
                            </td>

                        </tr>
                        <tr class="w-full text-sm">
                            <td class="w-75p"></td>
                            <td style="text-align: right">
                                {{ $inbound->details['nilai_cif'] ?? '' }}

                            </td>
                        </tr>
                        <tr class="w-full text-sm">
                            <td class="w-75p">Rp. </td>
                            <td>
                                {{ $inbound ->details['cif_rp'] ?? '' }}

                            </td>
                        </tr>

                    </table>

                </td>
            </table>
        </tr>

        <tr>
            <table class="w-full no-spacing-border text-md" style="border-top: none;border-bottom: none">
                <td class="border w-33p m-cell" style="border-top: none;border-right: none">
                    <table>
                        <tr class="w-full text-md">
                            <td>
                                29. Nomor, Ukuran dan Tipe Peti Kemas
                            </td>

                        </tr>
                        <tr class="w-full text-sm">
                            <td>
                                {{ $inbound->details['nomor_peti_kemas']  ?? '' }},
                                {{ $ukuranpeti->name ?? '' }}&
                                {{ $tipepeti->name ?? '' }}

                            </td>
                        </tr>

                    </table>

                </td>
                <td class="border w-33p m-cell" style="border-top: none;border-left: none;border-right: none">
                    <table>
                        <tr class="w-full text-md">
                            <td>
                                30. Jumlah, Jenis dan Merek Kemasan
                            </td>

                        </tr>
                        @foreach($inbound->inboundDetails as $inboundDetail)
                        <tr class="w-full text-sm">
                            <td>
                                {{ $inboundDetail->details['kode_barang']   ?? '' }} :
                                {{ $inboundDetail->package_details['jumlah']   ?? '' }},
                                {{ $inboundDetail->package->name ?? '' }},
                                {{ $inboundDetail->package_details['merk'] ?? '' }}
                            </td>
                        </tr>
                        @endforeach

                    </table>

                </td>
                <td class="border w-33p m-cell" style="border-top: none">
                    <table>
                        <tr>
                            <td>
                                <p class="text-sm">31. Berat Kotor (Kg)</p>
                            </td>
                            <td>
                                <p class="text-sm">: {{ $inbound->details['berat_kotor'] ?? '' }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="text-sm">32. Berat Bersih (Kg)</p>
                            </td>
                            <td>
                                <p class="text-sm">: {{ $inbound->details['berat_bersih'] ?? '' }}</p>
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
                        <td class="border w-7p m-cell text-center text-sm" style="border-top: none;border-right: none;">
                            33. No.
                        </td>
                        <td class="border w-35p m-cell" style="border-top: none;border-right: none;">
                            34. - Pos Tarif/HS<br>
                            - Kode barang<br>
                            - Uraian barang secara lengkap, merk, tipe,<br>
                            ukuran, spesifikasi lain<br>
                            - Jumlah dan Jenis Kemasan<br>
                            - Fasilitas Impor<br>
                            - Surat Keputusan/Dokumen Lainnya<br>
                        </td>
                        <td class="border w-15p m-cell" style="border-top: none;border-right: none;">
                            35. Kategori Barang <br>

                        </td>
                        <td class="border w-10p m-cell" style="border-top: none;border-right:none">
                            36. Negara Asal
                        </td>
                        <td class="border w-20p m-cell" style="border-top: none;border-right: none;">
                            37. - Tarif dan Fasilitas <br>
                            - BM -BMT <br>
                            - Cukai <br>
                            - PPN <br>
                            - PPnBM <br>
                            - PPh <br>

                        </td>
                        <td class="border w-15p m-cell" style="border-top: none;border-right: none;
                        ">
                            38. - Jumlah dan <br>
                            Jenis Satuan <br>
                            - Berat Bersih <br>
                        </td>
                        <td class="border w-15p m-cell" style="border-top: none;">
                            39. Nilai CIF <br>
                        </td>

                    </tr>
                </table>
            </td>
        </tr>
        @foreach($inbound->inboundDetails as $key=>$inboundDetail)
        <tr>
            <td>
                <table class="w-full no-spacing-border text-sm">
                    <tr>
                        <td class="border w-7p m-cell" style="border-top: none;border-right: none">
                            {{ $key + 1 }}
                        </td>
                        <td class="border w-35p m-cell" style="border-top: none;border-right: none">
                            <p>
                                HS: {{ $inboundDetail->hsCode->code ?? '' }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Kode: {{ $inboundDetail->details['kode_barang'] ?? '' }}<br>
                                Uraian: {{ $inboundDetail->details['uraian'] ?? '' }},
                                Merk: {{ $inboundDetail->details['merk'] ?? '' }},
                                Tipe: {{ $inboundDetail->details['type'] ?? '' }},
                                Ukuran: {{ $inboundDetail->details['ukuran'] ?? '' }},
                                Spesifikasi lain: {{ $inboundDetail->details['spesifikasi_lain'] ?? '' }}<br>
                                Kemasan: {{ $inboundDetail->package_details['jumlah'] ?? '' }} ({{ $inboundDetail->package->name ?? '' }})<br>
                                {{-- Fasilitas: @foreach ( $inbound->inboundDocuments- as )

                                    @endforeach<br> --}}
                                Dokumen: No. {{ $inbound->inboundDocuments[0]->details['nomor_dokumen'] ?? '' }}<br>
                                Tgl. {{ $inbound->inboundDocuments[0]->details['date'] ?? '' }}
                            </p>

                        </td>
                        <td class="border w-15p m-cell" style="border-top: none;border-right: none">
                            <p>{{ $inboundDetail->quantity ?? '' }} ({{ $inboundDetail->details['jenis_barang'] ?? '' }})</p>
                            <br>
                        </td>
                        <td class="border w-10p m-cell" style="border-top: none;border-right: none">
                            <p>
                                {{ $countrytransport->name ?? '' }} ({{ $inbound->inboundTransportation->country_code ?? '' }})
                            </p>
                        </td>
                        <td class="border w-20p m-cell" style="border-top: none;border-right: none">
                            <p class="text-sm">

                                @if(isset($inboundDetail->details['bm']))
                                BM: {{ $inboundDetail->details['bm'] ?? ''}} {{ $inboundDetail->details['bm_type'] == 1 ? '%' : ''}}, {{$inboundDetail->details['bm_tax_value'] ?? ''  . '%' }} {{ $Taxtype[$key]['bm_tax_type']  ?? '' }}<br>
                                @endif

                                @if(isset($inboundDetail->details['bmt']))
                                BMT : {{ $inboundDetail->details['bmt'] ?? ''}},
                                {{ $inboundDetail->details['bmt_tax_value'] ?? ''}}
                                {{ $Taxtype[$key]['bmt_tax_type']  ?? '' }}<br>
                                @endif

                                @if(isset($inboundDetail->details['cukai']))
                                Cukai: {{ $inboundDetail->details['cukai'] ?? ''  . '%'}}, {{$inboundDetail->details['cukai_tax_value'] ?? ''  . '%'}} {{ $Taxtype[$key]['cukai_tax_type']  ?? '' }}<br>
                                @endif

                                @if(isset($inboundDetail->details['pph']))
                                PPH: {{ $inboundDetail->details['pph'] ?? ''  . '%'}}, {{$inboundDetail->details['pph_tax_value'] ?? ''}} {{ $Taxtype[$key]['pph_tax_type']  ?? '' }}<br>
                                @endif

                                @if(isset($inboundDetail->details['ppn']))
                                PPN: {{ $inboundDetail->details['ppn'] ?? ''}}, {{$inboundDetail->details['ppn_tax_value'] ?? ''}} {{ $Taxtype[$key]['ppn_tax_type']  ?? '' }}<br>
                                @endif

                                @if($inboundDetail->details['ppnbm'])
                                PPNBM: {{ $inboundDetail->details['ppnbm'] ?? ''}}, {{$inboundDetail->details['ppnbm_tax_value'] ?? ''}} {{ $Taxtype[$key]['ppnbm_tax_type']  ?? '' }}<br>
                                @endif
                            </p>
                        </td>
                        <td class="border w-15p m-cell" style="border-top: none;border-right: none">
                            <p class="text-sm">
                                - {{ $inboundDetail->quantity }}<br>
                                - {{ $inboundDetail->good->uom->name }}<br>
                            </p>
                            <p class="text-sm">
                                - {{$inboundDetail->nett_weight ?? '' }}
                            </p>
                            <br>

                        </td>
                        <td class="border w-15p m-cell" style="border-top: none">
                            <p>
                                {{ $inboundDetail->details['nilai_cif'] ?? '' }}
                            </p>
                        </td>
                    </tr>

                </table>
            </td>

        </tr>
        @endforeach

        <tr>
            <td>
                <table class="w-full no-spacing-border text-md">
                    <tr>
                        <td class="border w-20p m-cell text-center " colspan="2" style="border-right: none;border-bottom: none">
                            Jenis Pungutan
                        </td>
                        <td class="border w-25p m-cell text-center " style="border-right: none;border-bottom: none">
                            Ditangguhkan (Rp)
                        </td>
                        <td class="border w-25p m-cell text-center " style="border-right: none;border-bottom: none">
                            Dibebaskan (Rp)
                        </td>
                        <td class="border w-25p m-cell text-center " style="border-bottom: none">
                            Tidak Dipungut (Rp)
                        </td>
                    </tr>
                    <tr class="text-sm">
                        <td class="border w-5p m-cell text-center " style="border-right: none;border-bottom: none">
                            34
                        </td>
                        <td class="border w-15p m-cell text-center " style="border-right: none;border-bottom: none">
                            BM
                        </td>
                        <td class="border w-25p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{ $inbound->details['bm_ditangguhkan'] ?? '0' }}</p>
                        </td>
                        <td class="border w-25p m-cell text-center" style="border-right: none;border-bottom: none">
                            <p>{{$inbound->details['bm_dibebaskan'] ?? '0'}}</p>
                        </td>
                        <td class="border w-25p m-cell text-center " style="border-bottom: none">
                            <p>{{$inbound->details['bm_tidak_dipungut'] ?? '0'}}</p>
                        </td>

                    </tr>
                    <tr class="text-sm">
                        <td class="border w-5p m-cell text-center " style="border-right: none;border-bottom: none">
                            35
                        </td>
                        <td class="border w-15p m-cell text-center " style="border-right: none;border-bottom: none">
                            BMT
                        </td>
                        <td class="border w-25p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$inbound->details['bmt_ditangguhkan'] ?? '0'}}</p>
                        </td>
                        <td class="border w-25p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$inbound->details['bmt_dibebaskan'] ?? '0' }}</p>
                        </td>
                        <td class="border w-25p m-cell text-center " style="border-bottom: none">
                            <p>{{$inbound->details['bmt_tidak_dipungut'] ?? '0'}}</p>
                        </td>

                    </tr>
                    <tr class="text-sm">
                        <td class="border w-5p m-cell text-center " style="border-right: none;border-bottom: none">
                            36
                        </td>
                        <td class="border w-15p m-cell text-center " style="border-right: none;border-bottom: none">
                            Cukai
                        </td>
                        <td class="border w-25p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$inbound->details['cukai_ditangguhkan'] ?? '0'}}</p>
                        </td>
                        <td class="border w-25p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$inbound->details['cukai_dibebaskan'] ?? '0'}}</p>
                        </td>
                        <td class="border w-25p m-cell text-center " style="border-bottom: none">
                            <p>{{$inbound->details['cukai_tidak_dipungut'] ?? '0'}}</p>
                        </td>

                    </tr>
                    <tr class="text-sm">
                        <td class="border w-5p m-cell text-center " style="border-right: none;border-bottom: none">
                            37
                        </td>
                        <td class="border w-15p m-cell text-center " style="border-right: none;border-bottom: none">
                            PPN
                        </td>
                        <td class="border w-25p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$inbound->details['ppn_ditangguhkan'] ?? '0'}}</p>
                        </td>
                        <td class="border w-25p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$inbound->details['ppn_dibebaskan'] ?? '0'}}</p>
                        </td>
                        <td class="border w-25p m-cell text-center " style="border-bottom: none">
                            <p>{{$inbound->details['ppn_tidak_dipungut'] ?? '0'}}</p>
                        </td>

                    </tr>
                    <tr class="text-sm">
                        <td class="border w-5p m-cell text-center " style="border-right: none;border-bottom: none">
                            38
                        </td>
                        <td class="border w-15p m-cell text-center " style="border-right: none;border-bottom: none">
                            PPnBM
                        </td>
                        <td class="border w-25p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$inbound->details['ppnbm_ditangguhkan'] ?? '0'}}</p>
                        </td>
                        <td class="border w-25p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$inbound->details['ppnbm_dibebaskan'] ?? '0'}}</p>
                        </td>
                        <td class="border w-25p m-cell text-center " style="border-bottom: none">
                            <p>{{$inbound->details['ppnbm_tidak_dipungut'] ?? '0'}}</p>
                        </td>

                    </tr>
                    <tr class="text-sm">
                        <td class="border w-5p m-cell text-center " style="border-right: none;border-bottom: none">
                            39
                        </td>
                        <td class="border w-15p m-cell text-center " style="border-right: none;border-bottom: none">
                            PPh
                        </td>
                        <td class="border w-25p m-cel text-center " style="border-right: none;border-bottom: none">
                            <p>{{$inbound->details['pph_ditangguhkan'] ?? '0'}}</p>
                        </td>
                        <td class="border w-25p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$inbound->details['pph_dibebaskan'] ?? '0' }}</p>
                        </td>
                        <td class="border w-25p m-cell text-center " style="border-bottom: none">
                            <p>{{$inbound->details['pph_tidak_dipungut'] ?? '0'}}</p>
                        </td>

                    </tr>
                    <tr class="text-sm">
                        <td class="border w-5p m-cell text-center " style="border-right: none;border-bottom: none">
                            40
                        </td>
                        <td class="border w-15p m-cell text-center " style="border-right: none;border-bottom: none">
                            TOTAL
                        </td>
                        <td class="border w-25p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$inbound->details['total_ditangguhkan'] ?? '0'}}</p>
                        </td>
                        <td class="border w-25p m-cell text-center " style="border-right: none;border-bottom: none">
                            <p>{{$inbound->details['total_dibebaskan'] ?? '0'}}</p>
                        </td>
                        <td class="border w-25p m-cell text-center " style="border-bottom: none">
                            <p>{{$inbound->details['total_tidak_dipungut'] ?? '0'}}</p>
                        </td>

                    </tr>

                </table>
            </td>

        </tr>

        <tr>
            <td>
                <table class="w-full no-spacing-border">
                    <tr>
                        <td class="border m-cell text-sm w-50p" style="border-right: none">
                            C. PENGESAHAN PENGUSAHA TPB<br><br>
                            Dengan ini saya menyatakan bertanggung jawab atas<br>
                            kebenaran hal-hal yang diberitahukan dalam pemberitahuan pabean ini<br>
                            Tempat, Tanggal : {{ $inbound->city->city }}, {{ date('d F Y', strtotime($inbound->details['pabean_tanggal'])) }}<br>
                            <p>Nama Lengkap : {{ $inbound->details['pabean_pemberitahu'] }}</p>
                            <p>Jabatan : {{ $inbound->details['pabean_jabatan'] }}</p>
                            Tanda Tangan dan Stempel Perusahaan :<br>
                            <br>
                            <br>
                            <br>
                            <br>
                        </td>
                        <td class="border text-md pull-top">
                            &nbsp;E. UNTUK PEJABAT BEA DAN CUKAI

                        </td>
                    </tr>
                    <tr>

                    </tr>
                </table>
            </td>

        </tr>
        </table>
        <span class="text-xs">Rangkap ke-1 / 2 / 3 : Pengusaha TPB / KPPBC Pengawas / Penerima Barang</span>
    </div>

    <div class="page_break"></div>


    <div class="page-2 letter-a4">

        <div class="text-md text-center">
            LEMBAR LAMPIRAN<br>
            PEMBERITAHUAN IMPOR BARANG UNTUK DITIMBUN<br>
            DI TEMPAT PENIMBUNAN BERIKAT<br>
            UNTUK DOKUMEN DAN SKEP/PERSETUJUAN <span style="float: right">BC 2.3</span></div>
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
                                                : {{ $inbound->request_number ?? ''}}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">Nomor Pendaftaran</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">: {{ $inbound->details['nomor_pendaftaran'] ?? ''}}</p>
                                        </td>
                                    </tr>
                                </table>

                            </td>

                            <td class="pull-top">
                                <span class="text-sm">Halaman ke-2 dari 2</span>
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
                            <td class="border w-40p m-cell" style="border-right: none;border-bottom: none;border-top: none">Jenis Dokumen</td>
                            <td class="border w-25p m-cell" style="border-right: none;border-bottom: none;border-top: none">Nomor Dokumen</td>
                            <td class="border w-25p m-cell" style="border-bottom: none;border-top: none">Tanggal Dokumen</td>
                        </tr>
                    </table>
                </td>
            </tr>

            @if(isset($inbound->inboundDocuments))
            @foreach($inbound->inboundDocuments as $key=>$inboundDocument)
            <tr>
                <td class="w-full">
                    <table class="no-spacing-border w-full" style="border-right: none;border-bottom: none">
                        <tr>
                            <td class="border w-40p m-cell" style="border-right: none;border-bottom: none">
                                <p class="text-sm">
                                    {{ $inboundDocument->masterDocument->name }}
                                </p>
                            </td>
                            <td class="border w-25p m-cell" style="border-right: none;border-bottom: none">
                                <p class="text-sm">
                                    {{ $inboundDocument->details['nomor_dokumen'] }}
                                </p>
                            </td>
                            <td class="border w-25p m-cell" style="border-bottom: none">
                                <p class="text-sm">
                                    {{ $inboundDocument->details['date'] }}
                                </p>
                            </td>
                        </tr>

                    </table>
                </td>

            </tr>
            @endforeach
            @if(count($inbound->inboundDocuments) == 0)
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
                                    Tempat, Tanggal :{{ $inbound->city->city }}, {{ date('d F Y', strtotime($inbound->details['pabean_tanggal'])) }}
                                </p>
                                <p class="text-sm m-cell">
                                    Nama Lengkap :{{ $inbound->details['pabean_pemberitahu'] }}
                                </p>
                                <p class="text-sm m-cell">
                                    Jabatan :{{ $inbound->details['pabean_jabatan'] }}
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



</div>

</html>