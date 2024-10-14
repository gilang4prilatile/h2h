<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style>
            * {
                margin: 0;
                padding: 0;
            }
            p,
            .text-fam{
                font-weight: 500;
                font-family:Arial, Helvetica, sans-serif;
                padding-bottom: 2px;
            }
            .container{
                min-width: 800px;
            }
            .hvs-a4 {
                padding: 30px 20px 30px 20px;
            }

            .m-cell {
                padding: 5px 10px 5px 10px;
            }

            .m-top {
                padding: 10px 20px 10px 20px;
            }

            .h-100 {
                height: 100%;
            }

            .w-100 {
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
            .p-0{
                padding:0;
            }
            .m-0{
                margin:0;
            }
            .px-1{
                padding: 0 1px;
            }
            .px-2{
                padding: 0 2px;
            }
            .px-3{
                padding: 0 3px;
            }
            .py-1{
                padding: 1px 0;
            }
            .py-2{
                padding: 2px 0;
            }
            .py-3{
                padding: 3px 0;
            }
            .pl-2{
                padding-left: 2px;
            }
            .pr-2{
                padding-right: 2px;
            }
            .mx-1{
                margin : 0 1px
            }
            .mx-2{
                margin : 0 2px
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
                font-size: 9px;
            }

            .text-xs {
                font-size: 9px;
            }
            .text-2xs {
                font-size: 8px;
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

            .underline{
                text-decoration: underline;
            }
            .table-collapse {
                border-collapse: collapse;
            }
            .table-collapse table, 
            .table-collapse td, 
            .table-collapse th{
                border: 1px solid black;
            }
            .table-collapse td, 
            .table-collapse th{
                padding: 0 2px;
            }
            .table-collapse th{
                text-align: center;
            }

        </style>
        
    <script src="{{ URL::asset('metronic/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>

<style type="text/css" media="print">
    @page
    {
        size: auto;   /* auto is the initial value */
        margin-top: 0mm;  /* this affects the margin in the printer settings */
        margin-bottom: 0mm;  /* this affects the margin in the printer settings */
    }
</style>

<script>

    function printpage()
    {
        window.print();
    }

</script>

    </head>
    <body onload="printpage();">
        <div class="container">
            <!-- page 1 -->
            <div class="page-1 hvs-a4">
                <!-- judul -->
                <div class="text-md text-center" style="margin-bottom: 2px;">
                    <p>
                        PEMBERITAHUAN IMPOR BARANG (PIB) - Draft  <span style="float: right">BC 2.0</span>
                    </p> 
                </div>
                <!-- data awal -->
                <div class="w-100 border ">
                    <table class="no-spacing-border w-100 px-2">
                        <tr>
                            <td style="width: 100px;">
                                <p class="text-sm">Kantor Pabean</p>
                            </td>
                            <td>
                                <p class="text-sm">: {{ $inbound->inboundKppbcPengawas->masterKppbc->description ?? '' }}<</p>
                            </td>
                            <td style="text-align: center;width: 100px;">
                                <p class="border text-sm" style="width: 90px;border-top: none;">{{ $inbound->inboundKppbcPengawas->masterKppbc->code ?? ''  }}</p>
                            </td>
                            <td style="text-align: right; padding: 0 30px;">
                                <p class="text-sm">Halaman ke-1 dari 1</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">
                                <p class="text-sm" >Kantor Pangajuan</p>
                            </td>
                            <td>
                                <p class="text-sm">: {{ $inbound->request_number ?? ''}}</p>
                            </td>
                            <td style="width: 120px;">
                                <p class="text-sm">Tanggal Pengajuan</p>
                            </td>
                            <td>
                                <p class="text-sm">:  {{ $inbound->details['tanggal_pendaftaran'] ?? null }}</p>
                            </td>
                        </tr>
                    </table>

                    <table class="px-2">
                        <tr>
                            <td>
                                <p class="text-sm">A. JENIS PIB</p>
                            </td>
                            <td>
                                <p class="text-sm" style="margin: 0 8px 0 4px;">:</p>
                            </td>
                            <td class="border mx-2" >
                                <p class="text-sm text-center w-100" style="height: 12px; width: 13px;"> {{ $inbound->pib_type_id ?? ''}}</p>
                            </td>
                            <td style="padding-right: 20px;">
                                <p class="text-sm">1. Biasa;</p>
                            </td>
                            <td style="padding-right: 20px;">
                                <p class="text-sm">2. Berkala;</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="text-sm">B. JENIS IMPOR</p>
                            </td>
                            <td>
                                <p class="text-sm" style="margin: 0 8px 0 4px;">:</p>
                            </td>
                            <td class="border">
                                <p class="text-sm text-center w-100" style="height: 12px; width: 13px">{{ $inbound->import_type_id ?? ''}}</p>
                            </td>
                            <td style="padding-right: 20px;">
                                <p class="text-sm">1. Untuk Dipakai;</p>
                            </td>
                            <td style="padding-right: 20px;">
                                <p class="text-sm">2. Sementara;</p>
                            </td>
                            <td style="padding-right: 20px;">
                                <p class="text-sm">5. Pelayanan Segera;</p>
                            </td>
                            <td style="padding-right: 20px;">
                                <p class="text-sm">9. Gabungan 1 & 2.</p>
                            </td>
                        </tr>
                        <tr >
                            <td>
                                <p class="text-sm">C. CARA PEMBAYARAN</p>
                            </td>
                            <td>
                                <p class="text-sm" style="margin: 0 8px 0 4px;">:</p>
                            </td>
                            <td class="border" >
                                <p class="text-sm text-center w-100" style="height: 12px; width: 13px">{{ $inbound->payment_type_id ?? ''}}</p>
                            </td>
                            <td style="padding-right: 20px;">
                                <p class="text-sm">1. Biasa/Tunai;</p>
                            </td>
                            <td style="padding-right: 20px;">
                                <p class="text-sm">2. Berkala;</p>
                            </td>
                            <td style="padding-right: 20px;">
                                <p class="text-sm">3. Dengan Jaminan;</p>
                            </td>
                            <td style="padding-right: 20px;">
                                <p class="text-sm">9. Lainnya</p>
                            </td>
                        </tr>
                    </table>

                </div>

                <!-- data -->
                <div class="w-100 border" style="border-top: none;border-bottom: none;">
                    <p class="px-2 text-sm">D. Data</p>
                </div>

                <!-- data tengah  -->
                <div class="w-100 border" style="display: grid; grid-template-columns: 50% 50%;">
                    <!-- bagian kiri -->
                    <div class="bag-kiri w-100 " style="border-right: 1px solid black; display: grid;">
                        <!-- pengirim -->
                        <div class="pengirim pl-2" style="border-bottom: 1px solid black; display: flex; flex-direction: column;">
                            <!-- judul -->
                            <div class="judul">
                                <p class="text-xs underline">
                                    PENGIRIM 
                                    <span class="border text-center" style="float: right;width: 50px; border-top: none;border-right: none;min-height: 12px;">{{ $inbound->inboundPengirimBarang->profile->country->code ?? '' }}</span>
                                </p>
                            </div>
                            <!-- content -->
                            <div class="content w-100 h-100" style="display:flex; ">
                                <div class="h-100" style="display: flex; align-items: start;">
                                    <p class="text-xs">1.</p> 
                                </div>
                                <div>
                                    <p class="text-xs">
                                        Nama, Alamat : {{ $inbound->inboundPengirimBarang->profile->name ?? '' }}
                                    </p>
                                    <br>
                                    <p class="text-xs">
                                    {{ $inbound->inboundPengirimBarang->profile->address ?? '' }}
                                    </p>
                                </div>
                            </div>
                            <div class="w-100" style="display: flex; flex-direction: row-reverse;">
                                <p class="text-xs border" style="width: 120px; text-align: right; border-bottom: none; border-right: none;">
                                {{ $inbound->inboundPengirimBarang->profile->country->name ?? '' }}
                                </p>
                            </div>
                        </div>
                        <!-- penjual -->
                        <div class="penjual pl-2 h-100" style="border-bottom: 1px solid black;display: flex; flex-direction: column;">
                            <!-- judul -->
                            <div class="judul">
                                <p class="text-xs underline">
                                    PENJUAL 
                                    <span class="border text-center" style="float: right;width: 50px; border-top: none;border-right: none;min-height: 12px;"> {{ $inbound->inboundPenjualBarang->profile->country->code ?? '' }}</span>
                                </p>
                            </div>
                            <!-- content -->
                            <div class="content w-100 h-100" style="display:flex; ">
                                <div class="h-100" style="display: flex; align-items: start;">
                                    <p class="text-xs">1.</p> 
                                </div>
                                <div>
                                    <p class="text-xs">
                                        Nama, Alamat : {{ $inbound->inboundPenjualBarang->profile->name ?? '' }}
                                    </p>
                                    <br>
                                    <p class="text-xs">
                                    {{ $inbound->inboundPenjualBarang->profile->address ?? '' }}
                                    </p>
                                </div>
                            </div>
                            <div class="w-100" style="display: flex; flex-direction: row-reverse;">
                                <p class="text-xs border" style="width: 120px; text-align: right; border-bottom: none; border-right: none;">
                                {{ $inbound->inboundPenjualBarang->profile->country->name ?? '' }}
                                </p>
                            </div>
                        </div>
                        <!-- importir -->
                        <div class="importir pl-2" style="border-bottom: 1px solid black; display: flex; flex-direction: column;">
                            <!-- judul -->
                            <div class="judul py-1">
                                <p class="text-xs underline" style="padding-top: 1px;">
                                    IMPORTIR 
                                    <!-- <span class="border text-center" style="float: right;width: 50px; border-top: none;border-right: none;">CN</span> -->
                                </p>
                            </div>
                            <!-- content -->
                            <div class="content w-100" style="display: flex; flex-direction: column;">
                                <!-- nomer 2 -->
                                <div class="w-100" style="display:flex; ">
                                    <div class="h-100" style="display: flex; align-items: start;">
                                        <p class="text-xs">2.</p> 
                                    </div>
                                    <div>
                                        <p class="text-xs">
                                            Identitas :  {{ $inbound->inboundImportir->profile->details['nomor_identitas'] ?? '' }}
                                        </p>
                                    </div>
                                </div>
                                <!-- nomer 3 -->
                                <div class="w-100" style="display:flex; ">
                                    <div class="h-100" style="display: flex; align-items: start;">
                                        <p class="text-xs">3.</p> 
                                    </div>
                                    <div>
                                        <p class="text-xs">
                                            Nama, Alamat : {{ $inbound->inboundImportir->profile->name ?? '' }}
                                        </p>
                                        <br>
                                        <p class="text-xs">
                                        {{ $inbound->inboundImportir->profile->address ?? '' }}
                                        </p>
                                        <br>
                                    </div>
                                </div>
                                @php
                                    // Definisikan array untuk mapping status ke deskripsi
                                    $statusMapping = [
                                        0 => 'MITA',
                                        1 => 'AEO',
                                        2 => 'LAINNYA'
                                    ];

                                    // Ambil status dari details['status'], pastikan nilainya tersedia
                                    $status = $inbound->inboundImportir->profile->details['status'] ?? null;

                                    // Cari deskripsi status, jika ada nilainya
                                    $statusDescription = isset($statusMapping[$status]) ? $statusMapping[$status] : '';
                                @endphp
                                <!-- nomor 4 dan 5 -->
                                <div class="w-100" style="display:flex; ">
                                    <!-- nomor 4 -->
                                    <div class="w-50p" style="display: flex; flex-direction: row;">
                                        <div class="h-100" style="display: flex; align-items: start;">
                                            <p class="text-xs">4.</p> 
                                        </div>
                                        <div>
                                            <p class="text-xs">
                                                Status :     {{ $statusDescription }}
                                            </p>
                                        </div>

                                        
                                    </div>
                                    <!-- nomor 5 -->
                                    <div class="w-50p" style="display: flex; flex-direction: row;">
                                        <div class="h-100" style="display: flex; align-items: start;">
                                            <p class="text-xs">4.</p> 
                                        </div>
                                        <div>
                                            <p class="text-xs">
                                                NIB :    {{ $inbound->inboundImportir->profile->details['nomor_api'] ?? '' }} 
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- pemilik barang -->
                        <div class="pemilik-barang pl-2" style="border-bottom: 1px solid black; display: flex; flex-direction: column;">
                            <!-- judul -->
                            <div class="judul">
                                <p class="text-xs underline" style="padding-top: 1px;">
                                    PEMILIK BARANG 
                                    <!-- <span class="border text-center" style="float: right;width: 50px; border-top: none;border-right: none;">CN</span> -->
                                </p>
                            </div>
                            <!-- content -->
                            <div class="content w-100" style="display: flex; flex-direction: column;">
                                <!-- nomer 2a -->
                                <div class="w-100" style="display:flex; ">
                                    <div class="h-100" style="display: flex; align-items: start;">
                                        <p class="text-xs">2a.</p> 
                                    </div>
                                    <div>
                                        <p class="text-xs">
                                        Identitas :  {{ $inbound->inboundPemilikBarang->profile->details['nomor_identitas']?? '' }}
                                        </p>
                                    </div>
                                </div>
                                <!-- nomer 3a -->
                                <div class="w-100" style="display:flex; ">
                                    <div class="h-100" style="display: flex; align-items: start;">
                                        <p class="text-xs">3a.</p> 
                                    </div>
                                    <div>
                                        <p class="text-xs">
                                            Nama, Alamat : {{ $inbound->inboundPemilikBarang->profile->name ?? '' }}
                                        </p>
                                        <br>
                                        <p class="text-xs">
                                        {{ $inbound->inboundPemilikBarang->profile->address ?? '' }}
                                        </p>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- PPJK -->
                        <div class="ppjk pl-2" style="display: flex; flex-direction: column;">
                            <!-- judul -->
                            <div class="judul">
                                <p class="text-xs underline" style="padding-top: 1px;">
                                    PPJK 
                                    <!-- <span class="border text-center" style="float: right;width: 50px; border-top: none;border-right: none;">CN</span> -->
                                </p>
                            </div>
                            <!-- content -->
                            <div class="content w-100" style="display: flex; flex-direction: column;">
                                <!-- nomer 6 -->
                                <div class="w-100" style="display:flex; ">
                                    <div class="h-100" style="display: flex; align-items: start">
                                        <p class="text-xs">6. </p> 
                                    </div>
                                    <div>
                                        <p class="text-xs">
                                            NPWP :  {{ $inbound->inboundPpjk->profile->details['nomor_identitas'] ?? '' }}
                                        </p>
                                    </div>
                                </div>
                                <!-- nomer 7 -->
                                <div class="w-100" style="display:flex; ">
                                    <div class="h-100" style="display: flex; align-items: start;">
                                        <p class="text-xs">7. </p> 
                                    </div>
                                    <div>
                                        <p class="text-xs">
                                            Nama, Alamat : {{ $inbound->inboundPpjk->profile->name ?? '' }}
                                        </p>
                                        <br>
                                        <p class="text-xs">
                                        {{ $inbound->inboundPpjk->profile->address ?? '' }}
                                        </p>
                                        <br>
                                    </div>
                                </div>
                                <!-- nomer 8 -->
                                <div class="w-100" style="display:flex; ">
                                    <div class="h-100" style="display: flex; align-items: start">
                                        <p class="text-xs">8. </p> 
                                    </div>
                                    <div>
                                        <p class="text-xs">
                                            NP-PPJK : {{ $inbound->inboundPpjk->profile->details['nomor_ppjk'] ?? '' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- bagian kanan -->
                    <div class="bag-kanan w-100" style="display: grid;">
                        <!-- nomor dan tanggal pendaftaran -->
                        <div class="nomor-tgl pl-2" style="border-bottom: 1px solid black; display: flex; flex-direction: column;">
                            <div class="w-100 h-100 pl-2" style="display:flex; ">
                                <div class="h-100" style="display: flex; align-items: start;">
                                    <p class="text-xs">G.</p> 
                                </div>
                                <div>
                                    <p class="text-xs">
                                        Nomor dan Tanggal Pendaftaran
                                    </p>
                                    <p class="text-xs" style="min-height: 15px;">
                                    {{$inbound->details['nomor_pendaftaran'] ?? null}}, {{$inbound->details['tanggal_pendaftaran'] ?? null}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Pengangkutan -->
                        <div class="pengangkutan" style="border-bottom: 1px solid black; display: flex; flex-direction: row;">
                            <!-- judul -->
                            <div class="w-100 h-100 pl-2" style="display:flex; ">
                                <div class="h-100" style="display: flex; align-items: start;" style="margin: 2px;">
                                    <p class="text-xs">9.</p> 
                                </div>
                                <div>
                                    <p class="text-xs">
                                        Cara Pengangkutan : {{ $inbound->inboundTransportation->first()->transportation->name ?? '' }}
                                    </p>
                                </div>
                            </div>
                            <div class="px-2" style="border-left: 1px solid black;width: 52px">
                                <p class="text-xs w-100 text-center">
                                    1
                                </p>
                            </div>
                        </div>
                        <!-- sarana pengangkutan -->
                        <div class="sarana-pengangkutan pl-2" style="border-bottom: 1px solid black; display: flex;flex-direction: row;min-height: 45px;">
                            <p class="text-xs">10.</p>
                            <!-- judul -->
                            <div class="pl-2 w-100">
                                <p class="text-xs">
                                    Nama Sarana Pengangkutan & No.voy/Flight dan Bendera
                                    <span class="border text-center py-1" style="float: right;width: 50px; border-top: none;border-right: none;min-height: 12px;">{{ $countrytransport->code ?? '' }}</span>
                                </p>
                                <p class="text-xs">{{$inbound->inboundTransportation->pluck('name')->first() ?? null}} </p>
                                <div style="display: grid; grid-template-columns: 50% 50%;">
                                    <p class="text-xs">{{ $inbound->inboundTransportation->pluck('vehicle_number')->first() ?? '' }}</p>
                                    <p class="text-xs">{{ $countrytransport->name ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Perkiraan tanggal tiba -->
                        <div class="perkiraan-tgl-tiba" style="border-bottom: 1px solid black; display: flex; flex-direction: row;">
                            <!-- judul -->
                            <div class="w-100 h-100 pl-2 py-1" style="display:flex; ">
                                <div class="h-100" style="display: flex; align-items: start;" style="margin: 2px;">
                                    <p class="text-xs">11.</p> 
                                </div>
                                <div>
                                    <p class="text-xs">
                                        Perkiraan Tanggal Tiba : {{$inbound->details['estimated_arrival_date'] ?? '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Pelabuhan -->
                        <div class="pelabuhan" style="border-bottom: 1px solid black; height: fit-content;">
                            <table class="no-spacing-border pl-2">
                                <tr class="no-spacing-border">
                                    <td>
                                        <p class="text-xs py-2">12.</p>
                                    </td>
                                    <td class="w-100">
                                        <p class="text-xs py-2">Pelabuhan Muat :  {{ $loadingport->name ?? '' }}</p>
                                    </td>
                                    <td style="border-left: 1px solid black;border-bottom: 1px solid black;">
                                        <p class="text-xs py-3 text-center">{{ $loadingport->code ?? '' }}</p>
                                    </td>
                                </tr>
                                <tr class="no-spacing-border">
                                    <td>
                                        <p class="text-xs py-2">13.</p>
                                    </td>
                                    <td class="w-100">
                                        <p class="text-xs py-2">Pelabuhan Transit : {{ $transitPort->name ?? '' }}</p>
                                    </td>
                                    <td style="border-left: 1px solid black;border-bottom: 1px solid black;">
                                        <p class="text-xs py-3 text-center" style="min-width: 100px;"> {{ $transitPort->code ?? '' }} </p>
                                    </td>
                                </tr>
                                <tr class="no-spacing-border">
                                    <td>
                                        <p class="text-xs py-2">14.</p>
                                    </td>
                                    <td class="w-100">
                                        <p class="text-xs py-2">Pelabuhan Tujuan : {{ $destinationport->name ?? '' }}</p>
                                    </td>
                                    <td style="border-left: 1px solid black;">
                                        <p class="text-xs py-3 text-center" style="min-width: 100px;">{{ $destinationport->code ?? '' }}</p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!-- detail -->
                         @php
                            // Variabel default
                            $nomorInvoice = $dateInvoice = '';
                            $nomorBlAwb = $dateBlAwb = '';
                            $nomorMBlAwb = $dateMBlAwb = '';
                            $nomorBC11 = $dateBC11 = $nomorBC11Pos =  $nomorBC11SubPos = '';
                            $nomorFormE = $dateFormE = '';

                            // Loop untuk dokumen-dokumen inbound
                            foreach ($inbound->inboundDocuments as $inboundDocument) {
                                switch ($inboundDocument->document_id) {
                                    case 107:
                                    case 108:
                                        // House BL/AWB
                                        $nomorBlAwb = $inboundDocument->details['nomor_dokumen'] ?? '';
                                        $dateBlAwb = $inboundDocument->details['date'] ?? '';
                                        break;

                                    case 106:
                                    case 109:
                                        // Master BL/AWB
                                        $nomorMBlAwb = $inboundDocument->details['nomor_dokumen'] ?? '';
                                        $dateMBlAwb = $inboundDocument->details['date'] ?? '';
                                        break;

                                    case 5:
                                        // Invoice
                                        $nomorInvoice = $inboundDocument->details['nomor_dokumen'] ?? '';
                                        $dateInvoice = $inboundDocument->details['date'] ?? '';
                                        break;
                                    case 104:
                                        // bc11
                                        $nomorBC11       = $inboundDocument->details['nomor_dokumen'] ?? '';
                                        $dateBC11        = $inboundDocument->details['date'] ?? '';
                                        $nomorBC11Pos    = $inboundDocument->details['nomor_pos_dokumen'] ?? '';
                                        $nomorBC11SubPos = $inboundDocument->details['nomor_sub_pos_dokumen'] ?? '';
                                        break;
                                    case 133:
                                        // Invoice
                                        $nomorformE = $inboundDocument->details['nomor_dokumen'] ?? '';
                                        $dateformE = $inboundDocument->details['date'] ?? '';
                                        break;    
                                }
                            }
                        @endphp
                        <div class="detail pl-2" style="border-bottom: 1px solid black;display: flex; flex-direction: column;">
                            <div class="py-1 invoice"  style="display: flex; flex-direction: row;">
                                <p class="text-xs">15.</p>
                                <p class="text-xs" style="min-width: 80px">Invoice</p>
                                <p class="text-xs">:</p>
                                <p class="text-xs w-100">No. {{$nomorInvoice}} </p>
                                <p class="text-xs" style="min-width: 100px;">Tgl. {{$dateInvoice}}</p>
                            </div>
                            <div class="py-1 transaksi"  style="display: flex; flex-direction: row;">
                                <p class="text-xs">16.</p>
                                <p class="text-xs" style="min-width: 100px">Transaksi <label class="border" style="padding: 0 2px;">{{$inbound->details['jenis_transaksi_id'] ?? "-"}}</label></p>
                                <p class="text-xs">:</p>
                                <p class="text-xs w-100">No. </p>
                                <p class="text-xs" style="min-width: 100px;">Tgl. </p>
                            </div>
                            <div class="py-1 bl-awb"     style="display: flex; flex-direction: row;">
                                <p class="text-xs">17.</p>
                                <div class="grup w-100">
                                    <div class="class1" style="display: flex; flex-direction: row;">
                                        <p class="text-xs" style="min-width: 80px">House-BL/AWB</p>
                                        <p class="text-xs">:</p>
                                        <p class="text-xs w-100">No. {{$nomorBlAwb}} </p>
                                        <p class="text-xs" style="min-width: 100px;">Tgl. {{$dateBlAwb}}</p>
                                    </div>
                                    <div class="class1" style="display: flex; flex-direction: row;">
                                        <p class="text-xs" style="min-width: 80px">Master-BL/AWB</p>
                                        <p class="text-xs">:</p>
                                        <p class="text-xs w-100">No. {{$nomorMBlAwb}} </p>
                                        <p class="text-xs" style="min-width: 100px;">Tgl. {{$dateMBlAwb}}</p>
                                    </div>
                                </div>
                            </div> 
                            <div class="py-1 bc"   style="display: flex; flex-direction: row;">
                                <p class="text-xs">18.</p>
                                <p class="text-xs" style="min-width: 80px">BC 1.1/1.2</p>
                                <p class="text-xs">:</p>
                                <p class="text-xs w-100">No. {{$nomorBC11}}</p>
                                <p class="text-xs" style="min-width: 100px;">Tgl. {{$dateBC11}}</p>
                            </div>
                            <div class="py-1" style="display: grid; grid-template-columns: 40% 30% 30%;">
                                <span></span>
                                <p class="text-xs">Pos. {{$nomorBC11Pos}}</p>
                                <p class="text-xs">Sub pos. {{$nomorBC11SubPos}}</p>
                            </div> 
                        </div>
                        <!-- PEMENUHAN PERSYARATAN -->
                        <div class="pemenuhan-persyaratan pl-2" style="border-bottom: 1px solid black; display: flex;flex-direction: row; min-height: 45px;">
                            <p class="text-xs pl-1">19.</p>
                            <!-- judul -->
                            <div class="pl-2 w-100">
                                <p class="text-xs">
                                    Pemenuhan Persyaratan/Fasilitas Impor
                                    <span class="border text-center py-1" style="float: right;width: 50px; border-top: none;border-right: none;min-height: 12px;">69</span>
                                </p>
                                <div style="display: grid; grid-template-columns: 50% 50%;">
                                    <p class="text-xs">No.  RC237558852220036</p>
                                    <p class="text-xs">TGL. 28-11-2023</p>
                                </div>
                            </div>
                        </div>
                        <!-- tempat penimbunan -->
                        <div class="tempat-penimbunan pl-2" style="border-bottom: 1px solid black; display: flex;flex-direction: row;">
                            <p class="text-xs">20.</p>
                            <!-- judul -->
                            <div class="pl-2 w-100">
                                <p class="text-xs">
                                    Tempat Penimbunan
                                    <span class="border text-center py-1" style="float: right;width: 60px; border-top: none;border-right: none;">{{ $inbound->inboundTPS->masterTPS->code_warehouse   ?? '' }}</span>
                                </p>
                                <p class="text-xs" style="min-height: 13px;">{{ $inbound->inboundTPS->masterTPS->code_warehouse   ?? '' }} - {{ $inbound->inboundTPS->masterTPS->name   ?? '' }}</p>
                            </div>
                        </div>

                        <!-- detail 2 -->
                        <div class="detail2 pl-2" style="border-bottom: 1px solid black; display: grid;grid-template-columns: 50% 50%;">
                            <!-- valuta -->
                            <div class="valuta pl-2" style="display: flex;flex-direction: row; min-height: 45px;">
                                <p class="text-xs">21.</p>
                                <!-- judul -->
                                <div class="pl-2 w-100" style="border-right: 1px solid black;">
                                    <p class="text-xs">
                                        Valuta :
                                        <span class="border text-center py-1" style="float: right;width: 50px; border-top: none;border-right: none;min-height: 12px;"> {{ $inbound->inboundValas->masterValas->code   ?? '' }}</span>
                                    </p>
                                    <p class="text-xs" style="min-height: 20px;"> {{ $inbound->inboundValas->masterValas->name   ?? '' }}</p>
                                </div>
                            </div>
                            <!-- NDPBM -->
                            <div class="ndpbm pl-2" style="display: flex;flex-direction: row; min-height: 45px;">
                                <p class="text-xs">22.</p>
                                <!-- judul -->
                                <div class="pl-2 w-100">
                                    <p class="text-xs">
                                        NDPBM :
                                        <!-- <span class="border text-center py-1" style="float: right;width: 50px; border-top: none;border-right: none;">USD</span> -->
                                    </p>
                                    <p class="text-xs" style="min-height: 20px;"> {{ $inbound->details['ndpbm'] ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- detail 3 -->
                        <div class="detail3 pl-2" style=" display: grid;grid-template-columns: 50% 50%;">
                            <!-- nilai,asuransi,freight -->
                            <div class="campur pl-2" style="display: flex;flex-direction: column; min-height: 45px; border-right: 1px solid black;">
                                <!-- nilai -->
                                <div class="nilai" style="display: flex;">
                                    <p class="text-xs">23.&nbsp</p>    
                                    <p class="text-xs">Nilai :</p>     
                                    <p class="text-xs" style="padding-right: 10px;">CIF</p>    
                                    <p class="text-xs"> {{ $inbound->details['nilai_cif'] ?? '0.00' }}</p>    
                                </div>
                                <!-- Asuransi -->
                                <div class="asuransi" style="display: flex;">
                                    <p class="text-xs">24.&nbsp</p>    
                                    <p class="text-xs">Asuransi/LDN :</p>     
                                    <p class="text-xs"> {{ $inbound->details['asuransi'] ?? '0.00' }}</p>    
                                </div>
                                <!-- freight -->
                                <div class="freight" style="display: flex;">
                                    <p class="text-xs">25.&nbsp</p>
                                    <p class="text-xs">Freight :</p> 
                                    <p class="text-xs">  {{ $inbound->details['freight'] ?? '0.00' }}</p>
                                </div>
                            </div>
                            <!-- nilai pabean -->
                            <div class="ndpbm pl-2" style="display: flex;flex-direction: column; min-height: 45px;">
                                <div style="display: flex;flex-direction: row;">
                                    <p class="text-xs">26.</p>
                                    <!-- judul -->
                                    <div class="pl-2 w-100">
                                        <p class="text-xs">
                                            Nilai Pabean :
                                            <span class="border text-center py-1" style="float: right;width: 50px; border-top: none;border-right: none;min-height: 12px;"></span>
                                        </p>
                                    </div>
                                </div>
                                <p class="text-xs" style="min-height: 20px;"> {{ $inbound ->details['fob'] ?? '0.00' }}</p>
                                <p class="text-xs">Rp. {{ $inbound ->details['cif_rp'] ?? '0.00' }}</p>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end data tengah -->
                <!-- data tengah 2 -->
                <div class="data-tengah-2 w-100 border" style="min-height: 80px; border-top: none;display: grid;grid-template-columns: 32% 32% 18% 18%;">
                    <div class="pl-2 py-1" style="border-right: 1px solid black;">
                        <p class="text-sm">27. Nomor. Ukuran, dan Tipe Peti</p>
                        @foreach($kontainerData as $kontainer)
                            <p class="text-xs">
                                {{ $kontainer['nomor_peti_kemas'] }}, 
                                {{ $kontainer['ukuran_peti_kemas'] }} 
                                dan {{ $kontainer['jenis_peti_kemas'] }}
                            </p>
                        @endforeach
                    </div>
                    <div class="pl-2 py-1" style="border-right: 1px solid black;">
                        <p class="text-sm">28. Jumlah. Jenis, dan Merek Kemas : </p>
                        @if(isset($inbound->inboundPackaging))
                        @foreach($inbound->inboundPackaging as $key=>$inboundPackaging)
                        <p class="text-xs">{{ $inboundPackaging->details['jumlah_kemasan'] ?? '' }}, {{ $inboundPackaging->masterPackage->name ?? '' }} dan {{ $inboundPackaging->details['merek'] ?? '' }}</p>
                        @endforeach 
                        @endif
                    </div>
                    <div class="pl-2 py-1" style="border-right: 1px solid black;">
                        <p class="text-sm">29. Berat Kotor (Kg)</p>
                        <p class="text-xs" > &nbsp; &nbsp; &nbsp;{{ $inbound->details['berat_kotor'] ?? '' }}</p>
                    </div>
                    <div class="pl-2 py-1">
                        <p class="text-sm">30. Berat Bersih (Kg)</p>
                        <p class="text-xs">&nbsp; &nbsp; &nbsp; {{ $inbound->details['berat_bersih'] ?? '' }}</p>
                    </div>
                </div>
                <!-- end data tengah 2 -->

              
              

                <!-- table -->
                <div class="w-100 no-spacing-border border" style="border-bottom: none; border-top: none;">
                    <table class="w-100 no-spacing-border w-100 table-collapse">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-xs text-fam" style="width:16%">Jenis Pungutan</th>
                                <th             class="text-xs text-fam" style="width:14%">Dibayar</th>
                                <th             class="text-xs text-fam" style="width:14%">Ditanggung</th>
                                <th             class="text-xs text-fam" style="width:14%">Ditunda</th>
                                <th             class="text-xs text-fam" style="width:14%">Tidak Dipungut</th>
                                <th             class="text-xs text-fam" style="width:14%">Dibebaskan</th>
                                <th             class="text-xs text-fam" style="width:14%">Telah Dilunaskan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 15px;"        class="text-xs text-fam">37.</td>
                                <td                             class="text-xs text-fam">BM</td>
                                <td style="text-align: right;"  class="text-xs text-fam">
                                    {{ number_format(@$inbound->details['bm_dibayarkan'],2,',','.') ?? '0.00'}}
                                </td>
                                <td style="text-align: right;"  class="text-xs text-fam">
                                    {{ number_format(@$inbound->details['bm_ditangguhkan'],2,',','.') ?? '0.00'}}
                                </td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                                <td style="text-align: right;"  class="text-xs text-fam">
                                    {{ number_format($inbound->details['bm_tidak_dipungut'],2,',','.') ?? '0.00'}}
                                </td>
                                <td style="text-align: right;"  class="text-xs text-fam">
                                    {{ number_format(@$inbound->details['bm_dibebaskan'],2,',','.') ?? '0.00'}}
                                </td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                            </tr>
                            <tr>
                                <td style="width: 15px;"        class="text-xs text-fam">38.</td>
                                <td                             class="text-xs text-fam">BM KITE</td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                            </tr>
                            <tr>
                                <td style="width: 15px;"        class="text-xs text-fam">39.</td>
                                <td                             class="text-xs text-fam">BMT</td>
                                <td style="text-align: right;"  class="text-xs text-fam"> 
                                    {{ number_format($inbound->details['bmt_dibayarkan'] ?? 0, 2, ',', '.') }}
                                </td>
                                <td style="text-align: right;"  class="text-xs text-fam"> 
                                    {{ number_format($inbound->details['bmt_ditangguhkan'] ?? 0, 2, ',', '.') }}
                                </td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                                <td style="text-align: right;"  class="text-xs text-fam"> 
                                    {{ number_format($inbound->details['bmt_tidak_dipungut'] ?? 0, 2, ',', '.') }}
                                </td>
                                <td style="text-align: right;"  class="text-xs text-fam"> 
                                    {{ number_format($inbound->details['bmt_dibebaskan'] ?? 0, 2, ',', '.') }}
                                </td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                            </tr>
                            <tr>
                                <td style="width: 15px;"        class="text-xs text-fam">40.</td>
                                <td                             class="text-xs text-fam">Cukai</td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                            </tr>
                            <tr>
                                <td style="width: 15px;"        class="text-xs text-fam">41.</td>
                                <td                             class="text-xs text-fam">PPN</td>
                                <td style="text-align: right;"  class="text-xs text-fam"> 
                                    {{ number_format($inbound->details['ppn_dibayarkan'] ?? 0, 2, ',', '.') }}
                                </td>
                                <td style="text-align: right;"  class="text-xs text-fam"> 
                                    {{ number_format($inbound->details['ppn_ditangguhkan'] ?? 0, 2, ',', '.') }}
                                </td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                                <td style="text-align: right;"  class="text-xs text-fam"> 
                                    {{ number_format($inbound->details['ppn_tidak_dipungut'] ?? 0, 2, ',', '.') }}
                                </td>
                                <td style="text-align: right;"  class="text-xs text-fam"> 
                                    {{ number_format($inbound->details['ppn_dibebaskan'] ?? 0, 2, ',', '.') }}
                                </td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                            </tr>
                            <tr>
                                <td style="width: 15px;"        class="text-xs text-fam">42.</td>
                                <td                             class="text-xs text-fam">PPnBM</td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                            </tr>
                            <tr>
                                <td style="width: 15px;"        class="text-xs text-fam">43.</td>
                                <td                             class="text-xs text-fam">PPh</td>
                                <td style="text-align: right;"  class="text-xs text-fam"> 
                                    {{ number_format($inbound->details['pph_dibayarkan'] ?? 0, 2, ',', '.') }}
                                </td>
                                <td style="text-align: right;"  class="text-xs text-fam"> 
                                    {{ number_format($inbound->details['pph_ditangguhkan'] ?? 0, 2, ',', '.') }}
                                </td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                                <td style="text-align: right;"  class="text-xs text-fam"> 
                                    {{ number_format($inbound->details['pph_tidak_dipungut'] ?? 0, 2, ',', '.') }}
                                </td>
                                <td style="text-align: right;"  class="text-xs text-fam"> 
                                    {{ number_format($inbound->details['pph_dibebaskan'] ?? 0, 2, ',', '.') }}
                                </td>
                                <td style="text-align: right;"  class="text-xs text-fam">0.00</td>
                            </tr>
                            <tr>
                                <td style="width: 15px;" class="text-xs text-fam">44.</td>
                                <td class="text-xs text-fam">TOTAL</td>
                                <td style="text-align: right;" class="text-xs text-fam">
                                    {{ number_format($inbound->details['total_dibayarkan'] ?? 0, 2, ',', '.') }}
                                </td>
                                <td style="text-align: right;" class="text-xs text-fam">
                                    {{ number_format($inbound->details['total_ditangguhkan'] ?? 0, 2, ',', '.') }}
                                </td>
                                <td style="text-align: right;" class="text-xs text-fam">0.00</td>
                                <td style="text-align: right;" class="text-xs text-fam">
                                    {{ number_format($inbound->details['total_tidak_dipungut'] ?? 0, 2, ',', '.') }}
                                </td>
                                <td style="text-align: right;" class="text-xs text-fam">
                                    {{ number_format($inbound->details['total_dibebaskan'] ?? 0, 2, ',', '.') }}
                                </td>
                                <td style="text-align: right;" class="text-xs text-fam">0.00</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- end table -->

                <!-- pernyataan -->
                <div class="pernyataan w-100 border" style="border-top: none;display: grid; grid-template-columns: 50% 50%;">
                    <div style="border-right: 1px solid black; padding: 2px 4px;">
                        <p class="text-sm">F. Dengan ini saya menyatakan :</p>
                        <ol style="padding-left: 20px;" type="a">
                            <li class="text-fam text-sm" style="text-align: justify;">
                                Bertanggung jawabatas kebenaran hal - hal yang diberitahukan dalam dokumen ini
                                dan keabsahan dokumenpelengkap pabean yang menjadi dasar buatan dokumen ini
                                <br> ; dan
                            </li>
                            <li class="text-fam text-sm" style="text-align: justify;">
                                Sanggup menyiapkan dan menyerahkan barang impor untuk diperiksa, serta
                                menyaksikan pemeriksaan fisik. Dalam hal saya tidak memenuhi ketentuan ini dalam
                                jangka waktu yang ditetapkan maka saya menguasakannya kepada pengusaha
                                Tempat Penimbunan Sementara tempat pemeriksaan atas risiko dan biaya saya.
                            </li>
                        </ol>

                        <!-- ttd -->
                        <div class="text-center py-1">
                            <p class="text-sm"> {{ $inbound->city->city }} , {{ date('d F Y', strtotime($inbound->details['pabean_tanggal'])) }}<br>Importir/PPJK</p>
                            <br>
                            <br>
                            <p class="text-sm">{{ $inbound->details['pabean_pemberitahu'] }}<br>{{ $inbound->details['pabean_jabatan'] }}</p>
                        </div>
                    </div>

                    <!-- pembayaran dan Jaminan -->
                    <div style="padding: 2px 4px;" >
                        <p class="text-sm underline" style="padding-bottom: 5px;">E. UNTUK PEMBAYARAN DAN JAMINAN</p>

                        <table class="w-100" style="padding-bottom: 5px;">
                            <tr>
                                <td class="text-xs text-fam">a. Pembayaran&nbsp;</td>
                                <td class="border text-center text-xs text-fam" style="width: 12px; height: 12px;">1</td>
                                <td class="text-xs text-fam">1. Bank</td>
                                <td class="text-xs text-fam">2. Post</td>
                                <td class="text-xs text-fam">3. Kantor Pabean</td>
                            </tr>
                            <tr>
                                <td class="text-xs text-fam">b. Jaminan&nbsp;</td>
                                <td class="border text-center text-xs text-fam" style="width: 12px; height: 12px;">1</td>
                                <td class="text-xs text-fam" colspan="2">1. Tunai</td>
                                <td class="text-xs text-fam">2. Bank Garansi</td>
                            </tr>
                            <tr>
                                <td colspan="2"><!--kosong--> </td>
                                <td class="text-xs text-fam" colspan="2">3. Customs Bond</td>
                                <td class="text-xs text-fam">4. Lainnya</td>
                            </tr>
                        </table>
                        <div style="padding: 0 4px;">
                            <table class="table-collapse w-100" style="min-height: 50px;">
                                <thead>
                                    <tr>
                                        <td><!--kosong--> </td>
                                        <td class="text-sm text-fam text-center">Nomor</td>
                                        <td class="text-sm text-fam text-center">Tanggal</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-xs text-fam text-center">a.</td>
                                        <td class="text-xs text-fam"></td>
                                        <td class="text-xs text-fam"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-xs text-fam text-center">b.</td>
                                        <td class="text-xs text-fam"></td>
                                        <td class="text-xs text-fam"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end pernyataan -->

                <p class="text-sm py-2 w-100" style="text-align: right;">Rangkap ke-1/2/3/4 untuk Importir/Kantor Pabean/BPS/BI</p>
            </div>
            <!-- end page 1 -->

                <!-- page 2 -->
            <div class="page-2 hvs-a4">
                <!-- judul -->
                <div class="text-md text-center" style="margin-bottom: 2px;">
                    <p>
                        LEMBAR LANJUTAN DOKUMEN DAN PEMENUHAN PERSYARATAN/FASILITAS 
                    </p> 
                    <p>
                        PEMBERITAHUAN IMPOR BARANG (PIB)<span style="float: right">BC 2.0</span>
                    </p> 
                </div>
                <!-- header -->
                <div class="w-100 border " style="border-bottom: none; padding-bottom: 5px;">
                    <table class="no-spacing-border w-100 px-2">
                        <tr>
                            <td style="min-width: 100px;">
                                <p class="text-sm">Kantor Pabean</p>
                            </td>
                            <td style="min-width: 200px;">
                                <p class="text-sm">: {{ $inbound->inboundKppbcPengawas->masterKppbc->description ?? ''  }}</p>
                            </td>
                            <td style="text-align: center;" colspan="2">
                                <p class="border text-sm" style="width: 90px;border-top: none;">{{ $inbound->inboundKppbcPengawas->masterKppbc->code ?? ''  }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="min-width: 100px;">
                                <p class="text-sm" >Nomor Pangajuan</p>
                            </td>
                            <td style="min-width: 200px;">
                                <p class="text-sm">: {{ $inbound->request_number ?? ''}}</p>
                            </td>
                            <td style="min-width: 100px;">
                                <p class="text-sm" style="min-width: 100px;">Tanggal Pengajuan</p>
                            </td>
                            <td style="min-width: 200px;">
                                <p class="text-sm">: {{ $inbound->details['tanggal_pendaftaran'] ?? null }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="min-width: 100px;">
                                <p class="text-sm" >Nomor</p>
                            </td>
                            <td style="min-width: 200px;">
                                <p class="text-sm">: {{ $inbound->request_number ?? ''}}</p>
                            </td>
                            <td style="min-width: 100px;">
                                <p class="text-sm">Tanggal</p>
                            </td>
                            <td style="min-width: 200px;">
                                <p class="text-sm">: {{ $inbound->details['tanggal_pendaftaran'] ?? null }}</p>
                            </td>
                        </tr>
                    </table>
                </div>
                  <!-- data tengah 4 -->
                     <!-- data tengah 3 -->
                <div class="data-tengah-3 w-100 border" style="min-height: 60px; display: grid;grid-template-columns: 3% 25% 18% 18% 18% 18%;">
                    <div class="pl-2 py-1" style="border-right: 1px solid black;">
                        <p class="text-xs text-center">31 No.</p>
                    </div>

                    <div class="pl-2 py-1" style="display: flex;flex-direction: row; border-right: 1px solid black;">
                        <p class="text-xs">32.&nbsp;</p>
                        <div class="w-100">
                            <p class="text-2xs">- Pos Tarif HS</p>
                            <p class="text-2xs">- Uraian Jenis Barang, Merek, Tipe, Spesifikasi Wajib</p>
                            <p class="text-2xs">- Negara asal Barang</p>
                        </div>
                    </div>
                    <div class="pl-2 py-1" style="display: flex;flex-direction: row; border-right: 1px solid black;">
                        <p class="text-xs">33.&nbsp;</p>
                        <div class="w-100">
                            <p class="text-xs">Keterangan</p>
                            <p class="text-2xs">- Fasilitas & No. Urut</p>
                            <p class="text-2xs">- Persyaratan & No. Urut</p>
                        </div>
                    </div>
                    <div class="pl-2 py-1" style="display: flex;flex-direction: row; border-right: 1px solid black;">
                        <p class="text-xs">34.&nbsp;</p>
                        <div class="w-100">
                            <p class="text-xs">Tarif dan Fasilitas</p>
                            <!-- <p class="text-xs">- Uraian Jenis Barang, Merek, Tipe, Spesifikasi Wajib</p>
                            <p class="text-xs">- Negara asal Barang</p> -->
                        </div>
                    </div>
                    <div class="pl-2 py-1" style="display: flex;flex-direction: row; border-right: 1px solid black;">
                        <p class="text-xs">35.&nbsp;</p>
                        <div class="w-100">
                            <p class="text-2xs">- Jumlah dan Jenis Satuan Barang</p>
                            <p class="text-2xs">- Berat Bersih (Kg)</p>
                            <p class="text-2xs">- Jumlah dan Jenis</p>
                        </div>
                    </div>
                    <div class="pl-2 py-1" style="display: flex;flex-direction: row; ">
                        <p class="text-xs">36.&nbsp;</p>
                        <div class="w-100">
                            <p class="text-2xs">- Nilai Pabean</p>
                            <p class="text-2xs">- Jenis</p>
                            <p class="text-2xs">- Nilai yang Ditambahkan</p>
                        </div>
                    </div>
                </div>
                <!-- end data tengah 3 -->

                  @foreach($inbound->inboundDetails as $key=>$inboundDetail)
                    <div class="data-tengah-4 w-100 border" style="min-height: 90px; border-top: none;display: grid;grid-template-columns: 3% 25% 18% 18% 18% 18%;">
                        <div class="pl-2 py-1" style="border-right: 1px solid black;">
                            <p class="text-xs text-center"> {{ $key + 1 }}</p>
                        </div>
                        <div class="pl-2 py-1" style="border-right: 1px solid black;">
                            <div style="display: grid; grid-template-columns: 50% 50%;">
                                <p class="text-2xs">Pos Tarif : {{ $inboundDetail->hsCode->code ?? '' }}</p>
                                <p class="text-2xs">Kode Barang : {{ $inboundDetail->details['kode_barang'] ?? '' }}</p>
                            </div>
                            <p class="text-xs">Uraian : {{ $inboundDetail->details['uraian'] ?? '' }}</p>
                            <p class="text-xs">
                                    Merk: {{ $inboundDetail->details['merk'] ?? '' }}, 
                                    Tipe: {{ $inboundDetail->details['type'] ?? '' }}, 
                                    Ukuran:  {{ $inboundDetail->details['ukuran'] ?? '' }}, 
                                    Spesifikasi lain: {{ $inboundDetail->details['spesifikasi_lain'] ?? '' }},
                                    Kemasan: {{ $inboundDetail->package_details['jumlah'] ?? '' }} ({{ $inboundDetail->package->name ?? '' }})
                            </p>
                            <p class="text-xs">Kondisi Brg : BARU</p>
                            <p class="text-xs">Negara : CHINA (CN)</p>
                        </div>
                        <div class="pl-2 py-1" style="border-right: 1px solid black;">
                            <p class="text-xs">- RCEP (3)</p>
                            <p class="text-xs">- SURAT PERSETUJUAN</p>
                            <p class="text-xs">MUAT BPOM (4)</p>
                        </div>
                        <div class="pl-2 py-1" style="border-right: 1px solid black; ">
                            <div style="display: grid; grid-template-columns: 50% 50%;">
                                @if(isset($inboundDetail->details['bm']))   
                                    <p class="text-xs">BM {{ $inboundDetail->details['bm'] ?? ''}} {{ $inboundDetail->details['bm_type'] == 1 ? '%' : ''}}</p>
                                    <p class="text-xs">{{$inboundDetail->details['bm_tax_value'] ?? ''  . '%' }} {{ $Taxtype[$key]['bm_tax_type']  ?? '' }}</p> 
                                @endif
                            </div>
                            <div style="display: grid; grid-template-columns: 50% 50%;">
                                @if(isset($inboundDetail->details['bm']))   
                                    <p class="text-xs">BMT {{ $inboundDetail->details['bmt'] ?? ''}} {{ $inboundDetail->details['bmt_type'] == 1 ? '%' : ''}}</p>
                                    <p class="text-xs">{{$inboundDetail->details['bmt_tax_value'] ?? ''  . '%' }} {{ $Taxtype[$key]['bmt_tax_type']  ?? '' }}</p> 
                                @endif
                            </div>
                            <div style="display: grid; grid-template-columns: 50% 50%;">
                                @if(isset($inboundDetail->details['pph']))
                                <p class="text-xs">PPH {{ $inboundDetail->details['pph'] ?? ''  . '%'}}, {{$inboundDetail->details['pph_tax_value'] ?? ''}} {{ $Taxtype[$key]['pph_tax_type']  ?? '' }}</p>
                                @endif   
                            </div>
                            <div style="display: grid; grid-template-columns: 50% 50%;">
                                @if(isset($inboundDetail->details['ppn']))
                                <p class="text-xs">PPN {{ $inboundDetail->details['ppn'] ?? ''  . '%'}}, {{$inboundDetail->details['ppn_tax_value'] ?? ''}} {{ $Taxtype[$key]['ppn_tax_type']  ?? '' }}</p>
                                @endif 
                            </div>
                        </div>
                        <div class="pl-2 py-1" style="border-right: 1px solid black;">
                            <div style="display: flex; flex-direction: row;">
                                <p class="text-xs">-</p>
                                <p class="text-xs">
                                {{ $inboundDetail->quantity }} <br>
                                {{ $inboundDetail->good->uom->name }} ( {{ $inboundDetail->good->uom->code }})
                                </p>
                            </div>
                            <p class="text-xs"></p>
                            <div style="display: flex; flex-direction: row;">
                                <p class="text-xs">-</p>
                                <p class="text-xs">
                                {{$inboundDetail->nett_weight ?? '' }} <br>
                                Netto
                                </p>
                            </div>
                        </div>
                        
                    </div>
                    @endforeach
                    <!-- end data tengah 4 -->

            </div>              
            <!-- page 2 -->
            <div class="page-2 hvs-a4">
                <!-- judul -->
                <div class="text-md text-center" style="margin-bottom: 2px;">
                    <p>
                        LEMBAR LANJUTAN DOKUMEN DAN PEMENUHAN PERSYARATAN/FASILITAS 
                    </p> 
                    <p>
                        PEMBERITAHUAN IMPOR BARANG (PIB)<span style="float: right">BC 2.0</span>
                    </p> 
                </div>
                <!-- header -->
                <div class="w-100 border " style="border-bottom: none; padding-bottom: 5px;">
                    <table class="no-spacing-border w-100 px-2">
                        <tr>
                            <td style="min-width: 100px;">
                                <p class="text-sm">Kantor Pabean</p>
                            </td>
                            <td style="min-width: 200px;">
                                <p class="text-sm">: {{ $inbound->inboundKppbcPengawas->masterKppbc->description ?? ''  }}</p>
                            </td>
                            <td style="text-align: center;" colspan="2">
                                <p class="border text-sm" style="width: 90px;border-top: none;">{{ $inbound->inboundKppbcPengawas->masterKppbc->code ?? ''  }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="min-width: 100px;">
                                <p class="text-sm" >Nomor Pangajuan</p>
                            </td>
                            <td style="min-width: 200px;">
                                <p class="text-sm">: {{ $inbound->request_number ?? ''}}</p>
                            </td>
                            <td style="min-width: 100px;">
                                <p class="text-sm" style="min-width: 100px;">Tanggal Pengajuan</p>
                            </td>
                            <td style="min-width: 200px;">
                                <p class="text-sm">: {{ $inbound->details['tanggal_pendaftaran'] ?? null }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="min-width: 100px;">
                                <p class="text-sm" >Nomor</p>
                            </td>
                            <td style="min-width: 200px;">
                                <p class="text-sm">: {{ $inbound->request_number ?? ''}}</p>
                            </td>
                            <td style="min-width: 100px;">
                                <p class="text-sm">Tanggal</p>
                            </td>
                            <td style="min-width: 200px;">
                                <p class="text-sm">: {{ $inbound->details['tanggal_pendaftaran'] ?? null }}</p>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- end header  -->
                <!-- content -->
                <div class="border w-100" style="border-bottom: none;border-top: none;">
                    <table class="table-collapse w-100">
                        <thead>
                            <tr>
                                <td class="text-xs text-center text-fam" style="padding: 3px 0;">No</td>
                                <td class="text-xs text-center text-fam">Kode Dokumen</td>
                                <td class="text-xs text-center text-fam">Nama Dokumen</td>
                                <td class="text-xs text-center text-fam">Nomor dan Tanggal Dokumen</td>
                                <td class="text-xs text-center text-fam">Dilampirkan</td>
                            </tr>
                        </thead>
                        <tbody>
                        @if(isset($inbound->inboundDocuments))
                        @foreach($inbound->inboundDocuments as $key=>$inboundDocument)
                            @if($inboundDocument->masterDocument->code <> '65')
                            <tr>
                                <td class="text-xs text-center text-fam py-3">{{ $loop->iteration }}</td>
                                <td class="text-xs text-center text-fam"> {{ $inboundDocument->masterDocument->code }}</td>
                                <td class="text-xs text-fam" style="padding: 0 6px;"> {{ $inboundDocument->masterDocument->name }}</td>
                                <td class="text-xs text-fam" style="padding: 3px 6px;">
                                    <p>No.  {{ $inboundDocument->details['nomor_dokumen'] }}</p>
                                    <p>{{ $inboundDocument->details['date'] }}</p>
                                </td>
                                <td class="text-xs text-center text-fam">YA/TIDAK</td>
                            </tr>
                            @endif  
                        @endforeach    
                        @endif   
                        </tbody>
                    </table>
                </div>
                <!-- end content  -->
                <!-- ttd -->
                <div class="w-100">
                    <div style="padding: 10px 20px; display: flex; justify-content: end;">
                        <div style="width: 200px;">
                            <p class="text-sm text-center w-100">
                                 {{ $inbound->city->city }} <br>
                                 {{ date('d F Y', strtotime($inbound->details['pabean_tanggal'])) }}
                            </p>
                            <br>
                            <p class="text-sm text-center w-100">
                              {{ $inbound->details['pabean_pemberitahu'] }}, {{ $inbound->details['pabean_jabatan'] }}
                            </p>
                        </div>
                    </div>
                    <hr>
                </div>
                <!-- end ttd -->

            </div>
            <!-- end page 2 -->
        </div>
    </body>
</html>