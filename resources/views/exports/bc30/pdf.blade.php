<?php
    use App\Models\MasterPlaceOfOrigin;
    use App\Models\Country;
    use App\Models\MasterUom;
    use App\Models\MasterEntrepreneurStatus;
?>

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
                padding-right: 1px;
                padding-left: 1px;
            }
            .px-2{
                padding-right: 2px;
                padding-left: 2px;
            }
            .px-3{
                padding-right: 3px;
                padding-left: 3px;
            }
            .py-1{
                padding-bottom: 1px;
                padding-top: 1px;
            }
            .py-2{
                padding-bottom: 2px;
                padding-top: 2px;
            }
            .py-3{
                padding-bottom: 3px;
                padding-top: 3px;
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

            .text-start {
                text-align: left;
            }

            .text-center {
                text-align: center;
            }

            .text-lg {
                font-size: 22px;
            }

            .text-md {
                font-size: 12px;
            }

            .text-xs {
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
                page-break-after: always;
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

            .table-collapse.collapse-2 td{
                border-bottom: none;
                border-top: none;
            }
            .table-collapse td, 
            .table-collapse th{
                padding: 0 2px;
            }
            .table-collapse th{
                text-align: center;
            }
            .vertical-text{
                writing-mode: vertical-rl;
                text-orientation: mixed;
                transform: rotate(180deg);
            }
            .td-khusus-1 {
                font-family: Arial, Helvetica, sans-serif;
                vertical-align: top;
                font-size: 9px;
                line-height: 10px;
                padding:3px 0;
            }
            .title-1 {
                font-size: 9px;
                padding: 4px 6px;
            }

            @media print {
                .page-break {
                    page-break-after: always;
                }
                
                .watermark1 {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%) rotate(90deg);
                    font-size: 10em;
                    color: rgba(0, 0, 0, 0.1);
                    z-index: -1;
                    pointer-events: none;
                    white-space: nowrap;
                    text-align: center;
                    opacity: 0.7;
                }

                .watermark2 {
                    position: absolute;
                    margin-top: 60%;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%) rotate(90deg);
                    font-size: 10em;
                    color: rgba(0, 0, 0, 0.1);
                    z-index: -1;
                    pointer-events: none;
                    white-space: nowrap;
                    text-align: center;
                    opacity: 0.7;
                }

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
        <div class="container" id="container">
            <!-- page 1 -->
            <div class="hvs-a4" id="page1" style="position: relative;">
                <div class="watermark1">- DRAF</div>
                <!-- judul -->
                <div class="text-md text-center border w-100" style="border-bottom: none; display: flex;" >
                    <p class="py-3" style="min-width: 80px;border-right: 1px solid black;">
                        BC 3.0
                    </p>
                    <p class="py-3 w-100 text-center">
                        PEMBERITAHUAN EXPORT BARANG (PEB)
                    </p> 
                </div>
                <!-- data awal -->
                <div class="w-100 border" style="display: flex; flex-direction: row;">
                    <p style="min-height: 70px;border-left: 1px solid black;" class="vertical-text text-center text-md px-2">
                        HEADER
                    </p>
                    <div class="w-100" style="display: grid; grid-template-columns: 55% 45%;">
                        <div class="w-100">
                            
                            <table class="px-2 py-2 w-100">
                                <!-- nomor Pengajuan -->
                                <tr>
                                    <td style="min-width: 100px;padding: 2px 0">
                                        <p class="text-xs" style="width: max-content">Nomor Pengajuan</p>
                                    </td>
                                    <td>
                                        <p class="text-xs" style="margin: 0 8px 0 15px;">:</p>
                                    </td>
                                    <td>
                                        <p class="text-xs">{{ str_replace("-","", $inbound->request_number) ?? ''}}</p>
                                    </td>
                                </tr>
                                <!-- kantor pabean -->
                                <tr >
                                    <td style="min-width: 100px;padding: 2px 0" colspan="3">
                                        <p class="text-xs">A. KANTOR PABEAN</p>
                                    </td>
                                </tr>
                                <!-- kantor pabean 1 -->
                                <tr >
                                    <td style="min-width: 100px;padding: 2px 0">
                                        <p class="text-xs" style="text-indent: 10px;width: max-content;">1. Kantor Pabean Pemuatan</p>
                                    </td>
                                    <td>
                                        <p class="text-xs" style="margin: 0 8px 0 15px;">:</p>
                                    </td>
                                    <td style="width: 100%;">
                                        <p class="text-xs" style="width: max-content;">{{ $inbound->inboundKppbcAsal->masterKppbc->description ?? '' }}</p>
                                    </td>
                                </tr>
                                <!-- kantor pabean 2 -->
                                <tr >
                                    <td style="min-width: 100px;padding: 2px 0">
                                        <p class="text-xs" style="text-indent: 10px;width: max-content">2. Kantor Pabean Ekspor</p>
                                    </td>
                                    <td>
                                        <p class="text-xs" style="margin: 0 8px 0 15px;">:</p>
                                    </td>
                                    <td>
                                        <p class="text-xs" style="width: max-content;">{{ $inbound->inboundKppbcAsal->masterKppbc->description ?? '' }}</p>
                                    </td>
                                </tr>
                                <!-- jenis ekspor -->
                                <tr >.
                                    <td style="min-width: 100px;padding: 2px 0">
                                        <p class="text-xs" style="width: max-content">B. JENIS EKSPOR</p>
                                    </td>
                                    <td>
                                        <p class="text-xs" style="margin: 0 8px 0 15px;">:</p>
                                    </td>
                                    <td>
                                        <p class="text-xs" style="width: max-content;">{{ $inbound->inboundExportType->name ?? '' }}</p>
                                    </td>
                                </tr>
                                <!-- Kategori ekspor -->
                                <tr >
                                    <td style="min-width: 100px;padding: 2px 0">
                                        <p class="text-xs" style="width: max-content">C. KATEGORI EKSPOR</p>
                                    </td>
                                    <td>
                                        <p class="text-xs" style="margin: 0 8px 0 15px;">:</p>
                                    </td>
                                    <td>
                                        <p class="text-xs" style="width: max-content;">{{ $inbound->inboundExportCategory->name ?? '' }}</p>
                                    </td>
                                </tr>
                                <!-- CARA PERDAGANGAN -->
                                <tr >
                                    <td style="min-width: 100px;padding: 2px 0">
                                        <p class="text-xs" style="width: max-content">D. CARA PERDAGANGAN</p>
                                    </td>
                                    <td>
                                        <p class="text-xs" style="margin: 0 8px 0 15px;">:</p>
                                    </td>
                                    <td>
                                        <p class="text-xs" style="width: max-content;">{{ $inbound->inboundTradeType->name ?? '' }}</p>
                                    </td>
                                </tr>
                                <!-- CARA PEMBAYARAN -->
                                <tr >
                                    <td style="min-width: 100px;padding: 2px 0">
                                        <p class="text-xs" style="width: max-content">E. CARA PEMBAYARAN</p>
                                    </td>
                                    <td>
                                        <p class="text-xs" style="margin: 0 8px 0 15px;">:</p>
                                    </td>
                                    <td>
                                        <p class="text-xs" style="width: max-content;">{{ $inbound->inboundPaymentType->name ?? '' }}</p>
                                    </td>
                                </tr>
                                

                                <!-- end -->
                                
                            </table>
                        </div>
                        <div class="w-100" style="display: flex; flex-direction: column;">
                            <!-- halaman ke -->
                            <p class="text-xs" style="text-align: right; padding: 5px 30px;">Halaman ke-1 dari 1</p>
                            
                            <!-- content sendiri bagian H -->
                            <div class="h-100 w-100" style="display: flex;align-items: end;">
                                <table class="px-2 py-2 w-100 border" style="height: min-content; border-bottom: none;border-right: none;">
                                    <!-- kolom khusus -->
                                    <tr >
                                        <td style="min-width: 100px;padding: 2px 0" colspan="3">
                                            <p class="text-xs">H. KOLOM KHUSUS BEA DAN CUKAI</p>
                                        </td>
                                    </tr>
                                    <!-- kolom khusus 1 a -->
                                    <tr >
                                        <td style="min-width: 100px;padding: 2px 0">
                                            <p class="text-xs" style="text-indent: 10px;width: max-content;">1. Nomor Pendaftaran</p>
                                        </td>
                                        <td>
                                            <p class="text-xs" style="margin: 0 8px 0 15px;">:</p>
                                        </td>
                                        <td style="width: 100%;">
                                            <p class="text-xs" style="width: max-content;">{{ $inbound->details['nomor_pendaftaran'] ?? null }}</p>
                                        </td>
                                    </tr>
                                    <!-- kolom khusus 1 b -->
                                    <tr >
                                        <td style="min-width: 100px;padding: 2px 0">
                                            <p class="text-xs" style="text-indent: 18px;width: max-content">Tanggal</p>
                                        </td>
                                        <td>
                                            <p class="text-xs" style="margin: 0 8px 0 15px;">:</p>
                                        </td>
                                        <td>
                                            <p class="text-xs" style="width: max-content;">{{ $inbound->details['tanggal_pendaftaran'] ?? null }}</p>
                                        </td>
                                    </tr>

                                    <tr >
                                        <td style="min-width: 100px;padding: 2px 0">
                                            <p class="text-xs" style="text-indent: 10px;width: max-content;">2. Nomor BC 1.1</p>
                                        </td>
                                        <td>
                                            <p class="text-xs" style="margin: 0 8px 0 15px;">:</p>
                                        </td>
                                        <td style="width: 100%;">
                                            <p class="text-xs" style="width: max-content;"></p>
                                        </td>
                                    </tr>
                                    <!-- kolom khusus 1 b -->
                                    <tr >
                                        <td style="min-width: 100px;padding: 2px 0">
                                            <p class="text-xs" style="text-indent: 18px;width: max-content">Tanggal</p>
                                        </td>
                                        <td>
                                            <p class="text-xs" style="margin: 0 8px 0 15px;">:</p>
                                        </td>
                                        <td>
                                            <p class="text-xs" style="width: max-content;"></p>
                                        </td>
                                    </tr>
                                    <!-- kolom khusus 1 b -->
                                    <tr >
                                        <td style="min-width: 100px;padding: 2px 0">
                                            <p class="text-xs" style="text-indent: 18px;width: max-content">Pos/Sub Pos</p>
                                        </td>
                                        <td>
                                            <p class="text-xs" style="margin: 0 8px 0 15px;">:</p>
                                        </td>
                                        <td>
                                            <p class="text-xs" style="width: max-content;"></p>
                                        </td>
                                    </tr>  
                                    <!-- end --> 

                                    <!-- kolom khusus 2 a -->
                                    @foreach($inbound->inboundDocuments as $inboundDocument)
                                    @if($inboundDocument->document_id == 104 )
                                    <tr >
                                        <td style="min-width: 100px;padding: 2px 0">
                                            <p class="text-xs" style="text-indent: 10px;width: max-content;">2. Nomor BC 1.1</p>
                                        </td>
                                        <td>
                                            <p class="text-xs" style="margin: 0 8px 0 15px;">:</p>
                                        </td>
                                        <td style="width: 100%;">
                                            <p class="text-xs" style="width: max-content;"> {{ $inboundDocument->details['nomor_dokumen'] ?? '' }} </p>
                                        </td>
                                    </tr>
                                    <!-- kolom khusus 1 b -->
                                    <tr >
                                        <td style="min-width: 100px;padding: 2px 0">
                                            <p class="text-xs" style="text-indent: 18px;width: max-content">Tanggal</p>
                                        </td>
                                        <td>
                                            <p class="text-xs" style="margin: 0 8px 0 15px;">:</p>
                                        </td>
                                        <td>
                                            <p class="text-xs" style="width: max-content;">{{ $inboundDocument->details['date'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                    <!-- kolom khusus 1 b -->
                                    <tr >
                                        <td style="min-width: 100px;padding: 2px 0">
                                            <p class="text-xs" style="text-indent: 18px;width: max-content">Pos/Sub Pos</p>
                                        </td>
                                        <td>
                                            <p class="text-xs" style="margin: 0 8px 0 15px;">:</p>
                                        </td>
                                        <td>
                                            <p class="text-xs" style="width: max-content;">{{ $inboundDocument->details['nomor_pos_dokumen'] ?? '' }}/ {{ $inboundDocument->details['nomor_sub_pos_dokumen'] ?? '' }}</p>
                                        </td>
                                    </tr>  
                                    <!-- end --> 
                                    @endif
                                    @endforeach 
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- data awal end -->
                
                <!-- bagian F -->
                <div class="w-100 border" style="display: flex;flex-direction: row;">
                    <p style="min-height: 150px;border-left: 1px solid black;" class="vertical-text text-center text-md px-2">
                        F. DATA PERDAGANGAN
                    </p>

                    <!-- CONTENT -->
                    <div class="w-100">
                        <!-- bagian 1 -->
                        <div class="w-100 " style="display: grid; grid-template-columns: 33% 33% 34%;min-height: 100px;">
                            <!-- EKSPORTIR -->
                            <div style="border-right: 1px solid black; border-bottom: 1px solid black; display: flex; flex-direction: column;">
                                <p class="title-1" style="border-bottom: 1px solid black;">EKSPORTIR</p>
                                <!-- isi -->
                                <table class="h-100 px-2">
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 60px;">1. Identitas</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" >{{ $inbound->inboundExportir->profile->details['nomor_identitas'] ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 60px;">2. Nama</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" style=" height: 50%;">:  {{ $inbound->inboundExportir->profile->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 60px;">3. Alamat</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" style=" height: 50%;"> {{ $inbound->inboundExportir->profile->address ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 60px;">4. Status</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" > {{ isset($inbound->inboundExportir->profile->details['status_pengusaha']) ? MasterEntrepreneurStatus::find($inbound->inboundExportir->profile->details['status_pengusaha'])->name : '' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- end eksportir  -->

                            <!-- pemilik barang  -->
                            <div style="border-right: 1px solid black; border-bottom: 1px solid black; display: flex; flex-direction: column">
                                <p class="title-1" style="border-bottom: 1px solid black;">PEMILIK BARANG</p>
                                <!-- isi -->
                                <table class="h-100 px-2">
                                <tr>
                                        <td class="td-khusus-1" style=" width: 60px;">5. Identitas</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" >{{ $inbound->inboundPemilikBarang->profile->details['nomor_identitas'] ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 60px;">6. Nama</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" style=" height: 50%;">:  {{ $inbound->inboundPemilikBarang->profile->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 60px;">7. Alamat</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" style=" height: 50%;"> {{ $inbound->inboundPemilikBarang->profile->address ?? '' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- end pemilik barang  -->


                            <!-- penerima  -->
                            <div style=" border-bottom: 1px solid black; display: flex; flex-direction: column;">
                                <p class="title-1" style="border-bottom: 1px solid black;">PENERIMA</p>
                                <!-- isi -->
                                <table class="h-100 px-2">
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 60px;">11. Nama</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" style=" height: 50%;">{{ $inbound->inboundPenerimaBarang->profile->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 60px;">12. Alamat</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" style=" height: 50%;">{{ $inbound->inboundPenerimaBarang->profile->address ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 60px;">13. Negara</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" >{{ $inbound->inboundPenerimaBarang->profile->country->name ?? '' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- end penerima  -->

                        </div>
                        <!-- bagian 2 -->
                        <div class="w-100 " style="display: grid; grid-template-columns: 50% 50% ; min-height: 75px;">

                            <!-- PPJK -->
                            <div style="border-right: 1px solid black; border-bottom: 1px solid black; display: flex; flex-direction: column;">
                                <p class="title-1" style="border-bottom: 1px solid black;">PPJK</p>
                                <!-- isi -->
                                <table class="h-100 px-2">
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 60px;">8. NPWP</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" > {{ $inbound->inboundPpjk->profile->details['nomor_identitas'] ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 60px;">9. Nama</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" style="height: 50%;">{{ $inbound->inboundPpjk->profile->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 60px;">10. Alamat</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" style="height: 50%;"> {{ $inbound->inboundPpjk->profile->address ?? '' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- end ppjk  -->

                            <!-- pembeli  -->
                            <div style=" border-bottom: 1px solid black; display: flex; flex-direction: column;">
                                <p class="title-1" style="border-bottom: 1px solid black;">PEMBELI</p>
                                <!-- isi -->
                                <table class="h-100 px-2">
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 60px;">14. Nama</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" style="height: 40%;">{{ $inbound->inboundPembeliBarang->profile->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 60px;">15. Alamat</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" style=" height: 60%;">{{ $inbound->inboundPembeliBarang->profile->address ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 60px;">16. Negara</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" >{{ $inbound->inboundPembeliBarang->profile->country->name ?? '' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- end pembeli  -->
                        </div>
                        <!-- end bagian 2 -->


                        <!-- bagian 3 -->
                        <div class="w-100 " style="display: grid; grid-template-columns: 50% 50%;">

                            <!-- DATA PENGANGKUTAN  -->
                            <div style="border-right: 1px solid black; border-bottom: 1px solid black; display: flex; flex-direction: column;">
                                <p class="title-1" style="border-bottom: 1px solid black;">DATA PENGANGKUTAN</p>
                                <!-- isi -->

                                @foreach($inbound->inboundTransportation as $inboundTransportation)
                                    <table>
                                        <tr>
                                            <td class="td-khusus-1" style=" width: 140px;">17. Cara Pengangkutan</td>
                                            <td class="td-khusus-1" >:</td>
                                            <td class="td-khusus-1" >{{$inboundTransportation->transportation->transportLine->name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td class="td-khusus-1" style=" width: 140px;">18. Nama & Bendera Sarana</td>
                                            <td class="td-khusus-1" >&nbsp; :</td>
                                            <td class="td-khusus-1" style="min-height: 25px;">{{$inboundTransportation->country_code ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td class="td-khusus-1" style=" width: 140px; text-indent: 15px;" colspan="3">{{$inboundTransportation->name ?? ''}}</td>
                                            <!-- <td class="td-khusus-1" >:</td>
                                            <td class="td-khusus-1" style=" height: 50%;">aaaaaaaaaaaaaa aaa</td> -->
                                        </tr>
                                        <tr>
                                            <td class="td-khusus-1" style=" width: 140px;">19.No. Pengangkutan</td>
                                            <td class="td-khusus-1" >:</td>
                                            <td class="td-khusus-1" style=" height: 50%;">{{$inboundTransportation->vehicle_number}}</td>
                                        </tr>
                                        <tr>
                                            <td class="td-khusus-1" style=" width: 140px;">20. Tanggal Perkiraan Ekspor</td>
                                            <td class="td-khusus-1" >:</td>
                                            <td class="td-khusus-1" style=" height: 50%;">{{ date('d-m-Y', strtotime($inbound->details['estimation_export_date'])) }}</td>
                                        </tr>
                                    </table>

                                @endforeach
                            </div>
                            <!-- end data pengakutan  -->

                            <!-- DATA PELABUHAN/TEMPAT MUAT EKSPOR  -->
                            <div style=" border-bottom: 1px solid black; display: flex; flex-direction: column;">
                                <p class="title-1" style="border-bottom: 1px solid black;">DATA PELABUHAN/TEMPAT MUAT EKSPOR</p>
                                <!-- isi -->
                                <table >
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 140px;">21. Pelabuhan Muat Asal</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" style=" height: 50%;"> {{ $loadingport->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 140px;">22. Pelabuhan Muat Export</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" style=" height: 50%;">{{ $exportPort->name ?? '' }}<</td>
                                    </tr>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 140px;">23. Tempat Penimbun</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" >  {{ $inbound->inboundTPS->masterTPS->code_warehouse   ?? '' }}, {{ $inbound->inboundTPS->masterTPS->name   ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 140px;">24. Tempat Bongkar</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" >{{ $unloadingPort->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 140px;">25. Pelabuhan Tujuan</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" >{{ $destinationPort->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 140px;">26. Negara Tujuan ekspor</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" >{{ $inbound->details['export_country_id'] ?? '' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- end DATA PELABUHAN/TEMPAT MUAT EKSPOR  -->
                        </div>
                        <!-- end bagian 3 -->

                        <!-- bagian 4 -->
                        <div class="w-100" style="display: grid;grid-template-columns: 50% 50%;">
                            <!-- dokumen perlengkapan  -->
                            <div style="border-right: 1px solid black;">
                                <p class="title-1" style="border-bottom: 1px solid black;"> DOKUMEN PERLENGKAPAN PABEAN</p>

                                <!-- content  -->
                                <div class="w-100 px-2" style="display: flex; flex-direction: column;">
                                    @foreach($inbound->inboundDocuments as $key=>$inboundDocument)
                                    @if(in_array($inboundDocument->document_id, [5, 1, 12]))
                                        <div style="display: flex; flex-direction: row;">
                                            <p class="text-xs py-2" style="min-width: 130px;">{{ (27 + $key) }}. No & Tgl {{ in_array($inboundDocument->document_id, [1, 12]) ? 'Packing List' : 'Invoice' }} &nbsp;</p>
                                            <p class="text-xs py-2" style="min-width: 150px;">: No. {{ $inboundDocument->details['nomor_dokumen'] }}</p>
                                            <p class="text-xs py-2">tgl. {{ date('d-m-Y', strtotime($inboundDocument->details['date'])) }}</p>
                                        </div>
                                    @endif 
                                    @endforeach
                                    <!-- nomor 29 -->
                                    <div style="display: flex; flex-direction: row;">
                                        <p class="text-xs py-2" style="min-width: 160px;">29. Jenis, No & Tgl Dok. Lainnya&nbsp;</p>
                                        <p class="text-xs py-2">: -</p>
                                    </div>
                                    <!-- nomor 28 -->
                                    <div style="display: flex; flex-direction: row;">
                                        <p class="text-xs py-2" style="min-width: 160px;text-indent: 15px;">Kantor Bea Cukai Pendaftaran&nbsp;</p>
                                        <p class="text-xs py-2">: KPU SOEKARNO-HATTA</p>
                                    </div>
                                </div>
                                <!-- end content  -->
                            </div>
                            <!-- end dokumen perlengkapan  -->

                            
                            <div>
                                <!-- data pemeriksaan -->
                                <p class="title-1" style="border-bottom: 1px solid black;"> DATA TEMPAT PEMERIKSAAN</p>

                                <!-- content  -->
                                <div class="px-2" style="display: flex; flex-direction: column;">
                                    <!-- nomor 30 -->
                                    <div style="display: flex; flex-direction: row;">
                                        <p class="text-xs py-2" style="min-width: 160px;">30. Lokasi Pemeriksaan &nbsp;</p>
                                        <p class="text-xs py-2">: {{ $inbound->inboundTPS->masterTPS->code_warehouse   ?? '' }}, {{ $inbound->inboundTPS->masterTPS->name   ?? '' }}</p>
                                    </div>
                                    <!-- nomor 31 -->
                                    <div style="display: flex; flex-direction: row;">
                                        <p class="text-xs py-2" style="min-width: 160px;">31. Kantor Pabean Pemeriksaan &nbsp;</p>
                                        <p class="text-xs py-2">: {{ $kppbcPeriksa->description ?? '' }}</p>
                                    </div>
                                </div>
                                <!-- end content  -->
                                <!-- end data pemeriksaan  -->


                                <!-- data penyerahan  -->
                                <p class="title-1" style="border-bottom: 1px solid black; border-top: 1px solid black;"> DATA  PENYERAHAN</p>

                                <!-- content  -->
                                <div class="px-2" style="display: flex; flex-direction: column;">
                                    <!-- nomor 32 -->
                                    <div style="display: flex; flex-direction: row;">
                                        <p class="text-xs py-2" style="min-width: 160px;">32. Cara Penyerahan Barang&nbsp;</p>
                                        <p class="text-xs py-2">: FOB</p>
                                    </div>
                                </div>
                                <!-- end content  -->
                                <!-- end data penyerahan  -->
                            </div>
                        </div>
                        <!-- end bagian 4 -->

                        <!-- judul DATA TRANSAKSI EKSPOR -->
                        <div class="w-100" style="border-top: 1px solid black; border-bottom: 1px solid black;">
                            <p class="title-1">DATA TRANSAKSI EKSPOR</p>
                        </div>
                        <!-- judul end -->

                        <!-- bagian 5 -->
                        <div class="w-100 " style="display: grid; grid-template-columns: 50% 50%;">

                            <!-- DATA transaksi ekspor 1 -->
                            <div style="border-right: 1px solid black; border-bottom: 1px solid black; display: flex; flex-direction: column;">
                                <!-- isi -->
                                <table>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 140px;">33. Bank Devisa Hasil Ekspor</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" >TRANSAKSI_TUNAI</td>
                                    </tr>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 140px;">34. Jenis Valuta</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" >{{ $inbound->inboundValas->masterValas->name   ?? '' }} ({{ $inbound->inboundValas->masterValas->code   ?? '' }})</td>
                                    </tr>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 140px;">35. Nilai Ekspor</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" >271,750.00</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- end data transaksi ekspor 1  -->

                            <!-- DATA transaksi ekspor 2  -->
                            <div style=" border-bottom: 1px solid black; display: flex; flex-direction: column;">
                                <!-- isi -->
                                <table >
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 140px;">36. Freight</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" >{{ $inbound->details['freight'] ?? '0.00' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 140px;">37. Asuransi (LN/DN)</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" >{{ $inbound->details['asuransi'] ?? '0.00' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 140px;">38. Nilai Maklon (Jika Ada)</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" >0</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- end DATA transaksi ekspor 2  -->
                        </div>
                        <!-- end bagian 5 -->


                        <!-- bagian 6 -->
                        <div class="w-100 " style="display: grid; grid-template-columns: 50% 50%;;">

                            <!-- DATA PETI KEMAS  -->
                            <div style="border-right: 1px solid black; border-bottom: 1px solid black; display: flex; flex-direction: column;">
                                <p class="title-1" style="border-bottom: 1px solid black;">DATA PETI KEMAS</p>
                                <!-- isi -->
                                <table>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 180px;">39. Jumlah Peti Kemas</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" >{{count($inbound->inboundPetiKemas)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 180px;">40. No, Ukuran & Status Peti Kemas</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" >
                                            @if(isset($inbound->inboundPetiKemas))
                                            @foreach($inbound->inboundPetiKemas as $key=>$inboundPetiKemas)
                                                {{ $inboundPetiKemas->details['nomor_peti_kemas'] ?? '' }}, {{ $inboundPetiKemas->details['ukuran_peti_kemas_id'] ?? '' }} dan {{ $inboundPetiKemas->masterTypePetiKemas->name ?? '' }}
                                            @endforeach
                                            @endif                                                 
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!-- end data peti kemas  -->

                            <!-- DATA KEMASAN  -->
                            <div style=" border-bottom: 1px solid black; display: flex; flex-direction: column;">
                                <p class="title-1" style="border-bottom: 1px solid black;">DATA KEMASAN</p>
                                <!-- isi -->
                                <table >
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 180px;">41. Jenis,Jumlah dan Merek Kemasan</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" >
                                            @if(isset($inbound->inboundPackaging))
                                                @foreach($inbound->inboundPackaging as $key=>$inboundPackaging)
                                                    <p class="text-xs">{{ $inboundPackaging->masterPackage->name ?? '' }}, {{ $inboundPackaging->details['jumlah_kemasan'] ?? '' }} dan {{ $inboundPackaging->details['merek'] ?? '' }}</p>
                                                @endforeach 
                                            @endif
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 140px; text-indent: 15px;" colspan="3">{{count($inbound->inboundPackaging)}}</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- end DATA KEMASAN  -->
                        </div>
                        <!-- end bagian 6 -->

                        <!-- judul DATA BARANG EKSPOR -->
                        <div class="w-100" style="border-bottom: 1px solid black;">
                            <p class="title-1">DATA BARANG EKSPOR</p>
                        </div>
                        <!-- judul end -->

                        <!-- bagian 7 -->
                        <div class="w-100 " style="display: grid; grid-template-columns: 50% 50%;">

                            <!-- nomor 42-->
                            <div style="border-right: 1px solid black;display: flex; flex-direction: column;">
                                <!-- isi -->
                                <table>
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 140px;">42. Berat Kotor (kg)</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" >{{ $inbound->details['bruto'] ?? '' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- end nomor 42 -->

                            <!-- nomor 43  -->
                            <div style="display: flex; flex-direction: column;">
                                <!-- isi -->
                                <table >
                                    <tr>
                                        <td class="td-khusus-1" style=" width: 140px;">43. Berat Bersih (kg)</td>
                                        <td class="td-khusus-1" >:</td>
                                        <td class="td-khusus-1" >{{ $inbound->details['netto'] ?? '' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- end nomor 43  -->
                        </div>
                        <!-- end bagian 7 -->

                        <!-- bagian 8 -->
                        <!-- sub title  -->
                        <div class="w-100" style="display: grid; grid-template-columns: 4% 32% 12% 13% 13% 13% 13%; border-top: 1px solid black; min-height: 55px;">
                            <div class="py-2" style="border-right: 1px solid black;">
                                <p class="px-2 text-xs text-center">44. No.</p>
                            </div>
                            <div class="py-2" style="border-right: 1px solid black;">
                                <p class="px-2 text-xs">45. Pos Tarif/HS, uraian jumlah dan jenis barang secara lengkap, merk, tipe, ukuran, spesifikasi lain dan kode barang</p>
                            </div>
                            <div class="py-2" style="border-right: 1px solid black;">
                                <p class="px-2 text-xs">46. Perizinan Ekspor</p>
                            </div>
                            <div class="py-2" style="border-right: 1px solid black;">
                                <p class="px-2 text-xs">47. HE barang dan Tarif BK pada tgl pendaftaran</p>
                            </div>
                            <div class="py-2" style="border-right: 1px solid black;">
                                <p class="px-2 text-xs">48. Jumlah & jenis sat., berat bersih (kg), volume (m3)</p>
                            </div>
                            <div class="py-2" style="border-right: 1px solid black;">
                                <p class="px-2 text-xs">49. Negara Asal Barang</p>
                                <p class="px-2 text-xs">50. Daerah Asal Barang</p>
                            </div>
                            <div class="py-2">
                                <p class="px-2 text-xs">51. Jumlah Nilai FOB</p>
                            </div>
                        </div>
                        <!-- end subtitle -->

                        <!-- isi  -->
                        <div class="border w-100" style="margin-top: 4px; ">
                            <div class="" style="padding: 32px 8px 48px 8px; display: flex; flex-direction: column;">
                                <p class="text-xs" align="center">---------------------------------------- {{ count($inbound->inboundDetails) }} Jenis barang. Lihat lembar lanjutan ----------------------------------------</p>
                            </div>
                        </div>
                        <!-- end isi  -->
                        <!-- end bagian 8 -->

                        <!-- bagian 9 -->
                        <div class="w-100" style="display: grid; grid-template-columns: 50% 50%; border-top: 1px solid black;">
                            <div class="px-2 py-2" style="display: flex; flex-direction: column;border-right: 1px solid black;">
                                <div style="display: flex; flex-direction: row;">
                                    <p class="text-xs py-2" style="min-width: 150px;">52. Nilai Tukar Mata Uang</p>
                                    <p class="text-xs py-2">:</p>
                                    <p class="text-xs py-2"> Rp {{ number_format($inbound->details['ndpbm'],2,',','.') }}</p>
                                </div>
                            </div>
                            <div class="py-2" style="display: flex; flex-direction: column;">
                                <p class="title-1 px-2" style="min-width: 150px; border-bottom: 1px solid black;">DATA PENERIMAAN NEGARA</p>
                                <div class="px-2 py-2" style="display: flex; flex-direction: row;">
                                    <p class="text-xs" style="min-width: 150px;">53. Nilai Bea Keluar</p>
                                    <p class="text-xs">: &nbsp;</p>
                                    <p class="text-xs">Rp. 0</p>
                                </div>
                                <div class="px-2 py-2" style="display: flex; flex-direction: row;">
                                    <p class="text-xs" style="min-width: 150px;">54. PPh Pasal 22 Ekspor</p>
                                    <p class="text-xs">: &nbsp;</p>
                                    <p class="text-xs">Rp. 0</p>
                                </div>
                                <div class="px-2 py-2" style="display: flex; flex-direction: row;">
                                    <p class="text-xs" style="min-width: 150px;">55. Pungutan Sawitg</p>
                                    <p class="text-xs">: &nbsp;</p>
                                    <p class="text-xs">Rp. 0</p>
                                </div>
                            </div>
                        </div>
                        <!-- end bagian 9 -->

                    </div>
                    <!-- content end -->
                </div>
                <!-- end bagian F -->

                <!-- tanda tangan ekportir -->
                <div class="border w-100" style="margin-top: 4px; ">
                    <div class="" style="padding: 6px 8px; display: flex; flex-direction: column;">
                        <div class="w-100" style="margin-bottom: 6px;">
                            <p class="text-xs">G. TANDA TANGAN EKPORTIR / PPJK</p>
                            <p class="text-xs">Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal yang diberitahukan dalam Pemberitahuan Ekspor Barang ini, serta bersedia dikenakan sanksi sesuai dengan ketentuan di bidang kepabeanan apabila terdapat kesalahan.</p>
                        </div>
                        <div class="w-100" style="display: flex;flex-direction: row-reverse;">
                            <div style="display: column; padding: 0px 20px;">
                                <p class="text-xs text-center">
                                {{ $inbound->city->city }}, {{ date('d F Y', strtotime($inbound->details['pabean_tanggal'])) }} <br>
                                    Eksportir/PPJK
                                </p>
                                <br>
                                <p class="text-xs text-center">
                                {{ $inbound->details['pabean_pemberitahu'] }}, {{ $inbound->details['pabean_jabatan'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- tanda tangan ekportir end -->
            </div>
            <div class="page-break"></div>
            <!-- end page 1 --> 

            <!-- page 2 -->
            <div class="hvs-a4" id="page2" style="position: relative;">
                <div class="watermark2">- DRAF</div>
                <!-- judul -->
                <div class="text-md text-center border py-3 w-100" style="padding-bottom: 10px; border-bottom: none;position: relative;">
                    <p>
                        LEMBAR LANJUTAN DATA BARANG EKSPOR<br>
                        PEMBERITAHUAN EKSPOR BARANG (PEB) 
                    </p> 
                    <span class="text-xs" style="position: absolute;bottom:0;right:3%;">Halaman ke-2 dari 2</span>
                </div>
                <!-- header -->
                <div class="w-100 border " style="border-bottom: none; padding-bottom: 5px;">
                    <table class="no-spacing-border w-100 px-2">
                        <tr>
                            <td colspan="2"><!--kosong--></td>
                            <td style="text-align: center;">
                                <p class="border text-xs" style="width: 90px;border-top: none;">{{ $inbound->inboundKppbcAsal->masterKppbc->code ?? '' }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="min-width: 100px;">
                                <p class="text-xs" >1. Kantor Pabean</p>
                            </td>
                            <td style="min-width: 200px;">
                                <p class="text-xs">: {{ $inbound->inboundKppbcAsal->masterKppbc->description ?? '' }}</p>
                            </td>
                            <td><!--kosong--></td>
                        </tr>
                        <tr>
                            <td style="min-width: 100px;">
                                <p class="text-xs" >2. Nomor Pengajuan</p>
                            </td>
                            <td style="min-width: 200px;">
                                <p class="text-xs">: {{ str_replace("-","", $inbound->request_number) ?? ''}}</p>
                            </td>
                            <td><!--kosong--></td>
                        </tr>

                    </table>
                </div>
                <!-- end header  -->
                <!-- content -->
                <div class="border w-100" style=" border-top: none;">
                    <table class="table-collapse collapse-2 w-100">
                        <thead>
                            <tr>
                                <th class="td-khusus-1 text-fam text-start" style="padding: 6px 0; width: 5%;">
                                    <p>44</p>
                                    <p>No.</p>
                                </th>
                                <th class="td-khusus-1 text-fam text-start" style="padding: 6px 0; width: 25%;">45. Pos Tarif/HS, uraian jumlah dan <br>
                                jenis barang secara lengkap, merk, tipe, <br>
                                ukuran, spesifikasi lain dan kode barang</th>
                                <th class="td-khusus-1 text-fam text-start" style="padding: 6px 0; width: 15%;">46. Perizinan Ekspor</th>
                                <th class="td-khusus-1 text-fam text-start" style="padding: 6px 0; width: 10%;">46. a. Pemilik Barang <br>
                                    - NPWP <br>
                                    - Nama <br>
                                    - Alama</th>
                                <th class="td-khusus-1 text-fam text-start" style="padding: 6px 0; width: 10%;">47. HE barang <br>
                                    dan Tarif BK <br>
                                    pada tgl <br>
                                    pendaftaran</th>
                                <th class="td-khusus-1 text-fam text-start" style="padding: 6px 0; width: 10%;">48. Jumlah & jenis <br>
                                    sat., berat bersih <br>
                                    (kg), volume (m3) </th>
                                <th class="td-khusus-1 text-fam text-start" style="padding: 6px 0; width: 15%;">49. Negara Asal <br>
                                    Barang <br>
                                    50. Daerah Asal <br>
                                    Barang </th>
                                <th class="td-khusus-1 text-fam text-start" style="padding: 6px 0; width: 10%;">50. Jumlah Nilai <br>
                                    FOB</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inbound->inboundDetails as $key=>$inboundDetail)
                                <tr >
                                    <td style="vertical-align: top;padding-top:6px;">{{ $key + 1 }}</td>
                                    <td style="vertical-align: top;padding-top:6px;">
                                        <p class="text-xs">- {{ $inboundDetail->hsCode->code ?? ''}}</p>
                                        <p class="text-xs">- {{ $inboundDetail->details['uraian'] ?? ''}} , tipe: {{ $inboundDetail->details['type'] ?? '-' }} , Ukuran: {{ $inboundDetail->details['ukuran'] ?? '-' }} , Spesifikasi lain: {{ $inboundDetail->details['spesifikasi_lain'] ?? '-' }} , Kemasan: {{ $inboundDetail->package_details['jumlah'] ?? '' }}  {{ $inboundDetail->package->code ?? '' }}</p>
                                        <p class="text-xs">- Kode Barang: {{ $inboundDetail->details['kode_barang'] ?? '-' }}</p>
                                    </td>
                                    <td></td>
                                    <td style="vertical-align: top;padding-top:6px;">
                                        @foreach($inbound->inbound_pemilik_barang as $inboundPemilikBarang)
                                            <p class="text-xs">- {{ $inboundPemilikBarang['pemilik_nomor_identitas'] }}</p>
                                            <p class="text-xs">- {{ $inboundPemilikBarang['pemilik_nama'] }}</p>
                                            <p class="text-xs">- {{ $inboundPemilikBarang['pemilik_alamat'] }}</p>
                                            <br>
                                        @endforeach
                                    </td>
                                    <td style="vertical-align: top;padding-top:6px;">
                                        <p class="text-xs">HE:0</p>
                                        <p class="text-xs">BK:0</p>
                                    </td>
                                    <td style="vertical-align: top;padding-top:6px;">
                                        <p class="text-xs">- {{ intval($inboundDetail->quantity) ?? 0 }} 
                                            <?php $masterUom = MasterUom::find($inboundDetail->details['uom_id']);  ?>
                                            {{ $masterUom->name ?? '' }} <br> ( {{ $masterUom->code ?? '' }} )
                                        </p>
                                        <p class="text-xs">- {{ $inboundDetail->details['netto'] ?? 0 }} Kg</p>
                                        <p class="text-xs">- {{ $inboundDetail->details['volume'] ?? 0 }} m3</p>
                                    </td>
                                    <td style="vertical-align: top;padding-top:6px;">
                                        <p class="text-xs">- {{ Country::where('code',$inboundDetail->details['item_country'])->first()->name }} ({{ $inboundDetail->details['item_country'] }})</p>
                                        <p class="text-xs">- {{ isset($inboundDetail->details['item_place_of_origin']) ? MasterPlaceOfOrigin::where('code',$inboundDetail->details['item_place_of_origin'])->first()->name : '' }} <br> ({{ $inboundDetail->details['item_place_of_origin'] ?? '' }})</p>
                                    </td>
                                    <td class="text-xs" align="right" style="vertical-align: top;padding-top:6px;">{{ $inboundDetail->details['fob'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end content  -->
                <!-- ttd -->
                <div class="w-100 border" style="border-top: none;">
                    <div style="padding: 10px 20px; display: flex; justify-content: end;">
                        <div style="width: 200px;">
                            <p class="text-xs text-center w-100">
                            {{ $inbound->city->city }} ,  {{ date('d F Y', strtotime($inbound->details['pabean_tanggal'])) }} <br>
                                Eksportir/PPJK
                            </p>
                            <br>
                            <p class="text-xs text-center w-100">
                            {{ $inbound->details['pabean_pemberitahu'] }}, {{ $inbound->details['pabean_jabatan'] }}
                            </p>
                        </div>
                    </div>
                </div>
                <!-- end ttd -->

            </div>
            <div class="page-break"></div>
            <!-- end page 2 -->

            <!-- page 3 -->
            <div class="hvs-a4" id="page3">
                <!-- judul -->
                <div class="text-md text-center border py-3 w-100" style="padding-bottom: 10px; border-bottom: none;">
                    <p>
                        LEMBAR LANJUTAN DOKUMEN PELENGKAP PABEAN<br>
                        PEMBERITAHUAN EKSPOR BARANG (PEB) 
                    </p> 
                </div>
                <!-- header -->
                <div class="w-100 border " style="border-bottom: none; padding-bottom: 5px;">
                    <table class="no-spacing-border w-100 px-2">
                        <tr>
                            <td colspan="2"><!--kosong--></td>
                            <td style="text-align: center;">
                                <p class="border text-xs" style="width: 90px;border-top: none;">{{ $inbound->inboundKppbcAsal->masterKppbc->code ?? '' }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="min-width: 100px;">
                                <p class="text-xs" >1. Kantor Pabean</p>
                            </td>
                            <td style="min-width: 200px;">
                                <p class="text-xs">: {{ $inbound->inboundKppbcAsal->masterKppbc->description ?? '' }}</p>
                            </td>
                            <td><!--kosong--></td>
                        </tr>
                        <tr>
                            <td style="min-width: 100px;">
                                <p class="text-xs" >2. Nomor Pengajuan</p>
                            </td>
                            <td style="min-width: 200px;">
                                <p class="text-xs">: {{ str_replace("-","", $inbound->request_number) ?? ''}}</p>
                            </td>
                            <td><!--kosong--></td>
                        </tr>

                    </table>
                </div>
                <!-- end header  -->
                <!-- content -->
                <div class="border w-100" style=" border-top: none;">
                    <table class="table-collapse collapse-2 w-100">
                        <thead>
                            <tr>
                                <th class="td-khusus-1 text-fam text-center" style="padding: 6px 0; width: 5%;">No</th>
                                <th class="td-khusus-1 text-fam text-center" style="padding: 6px 0; width: 33%;">Jenis Dokumen</th>
                                <th class="td-khusus-1 text-fam text-center" style="padding: 6px 0; width: 33%;">Nomor Dokumen</th>
                                <th class="td-khusus-1 text-fam text-center" style="padding: 6px 0; width: 14%;">Tanggal</th>
                                <th class="td-khusus-1 text-fam text-center" style="padding: 6px 0; width: 15%;">Kantor Pendaftaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($inbound->inboundDocuments))
                            @foreach($inbound->inboundDocuments as $key=>$inboundDocument)
                            <tr>
                                <td style="padding: 6px 6px;" class="td-khusus-1 text-center"   >{{ ($key + 1) }}</td>
                                <td style="padding: 6px 6px;" class="td-khusus-1"               >{{ $inboundDocument->masterDocument->code }}, {{ $inboundDocument->masterDocument->name }}</td>
                                <td style="padding: 6px 6px;" class="td-khusus-1"               >{{ $inboundDocument->details['nomor_dokumen'] }}</td>
                                <td style="padding: 6px 6px;" class="td-khusus-1 text-center"   >{{ $inboundDocument->details['date'] }}</td>
                                <td style="padding: 6px 6px;" class="td-khusus-1"               >{{ $inbound->inboundKppbcPengawas->masterKppbc->description ?? '' }}</td>
                            </tr>
                            @endforeach    
                            @endif  
                        </tbody>
                    </table>
                </div>
                <!-- end content  -->
                <!-- ttd -->
                <div class="w-100 border" style="border-top: none;">
                    <div style="padding: 10px 20px; display: flex; justify-content: end;">
                        <div style="width: 200px;">
                            <p class="text-xs text-center w-100">
                            {{ $inbound->city->city }} ,  {{ date('d F Y', strtotime($inbound->details['pabean_tanggal'])) }} <br>
                                Eksportir/PPJK
                            </p>
                            <br>
                            <p class="text-xs text-center w-100">
                            {{ $inbound->details['pabean_pemberitahu'] }}, {{ $inbound->details['pabean_jabatan'] }}
                            </p>
                        </div>
                    </div>
                </div>
                <!-- end ttd -->

            </div>
            <!-- end page 3 -->
        </div>
    </body>
</html>