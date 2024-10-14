@extends("layouts.main")
@push('css')
<style>
    input { 
        text-transform: uppercase;
    }
</style>
@endpush
@section('content')
    @include("components.toolbar", ['parentMenuName' => 'Outbound', 'menuName' => 'BC25'])
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container">
                <!--begin::Card-->
                <div class="card ">
                    <div class="card-header card-header-stretch">
                        <div class="card-toolbar mt-6">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                  <a class="nav-item nav-link active" id="nav-detil-tab" data-status="detil" data-toggle="tab" href="#nav-detil" role="tab" aria-controls="nav-detil" aria-selected="true">Data Detil Barang </a>
                                  <a class="nav-item nav-link disabled" id="nav-import-tab"  data-status="import" data-toggle="tab" href="#nav-import" role="tab" aria-controls="nav-import" aria-selected="false">Penggunaan Bahan Baku Import</a>
                                  <a class="nav-item nav-link disabled" id="nav-local-tab"  data-status="local" data-toggle="tab" href="#nav-local" role="tab" aria-controls="nav-local" aria-selected="false">Penggunaan Bahan Baku Lokal</a>
                                </div>
                            </nav>
                        </div>
                    </div>

                    {{ Form::open(['url' => $mainUrl . '/update/' . $outbound->id, 'method' => 'POST', 'id' => 'create-form', 'enctype' => 'multipart/form-data']) }}
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-detil" role="tabpanel" aria-labelledby="nav-detil-tab">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label class="form-label required">Nomor Pengajuan</label>
                                                {!! Form::text('request_number', $outbound->request_number, ['class' => 'form-control ', 'required' => true, 'placeholder' => 'Input No Pengajuan', 'id' => 'request_number','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                                <span class="error text-danger" id="error-nomor-pengajuan"></span>
                                                @if($errors->has('request_number'))
                                                    <span class="error text-danger">{{ $errors->first('request_number') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label required">Nomor Pendaftaran</label>
                                                {!! Form::text('details[nomor_pendaftaran]', @$outbound->details['nomor_pendaftaran'] ?: null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input No Pendaftaran', 'id' => 'nomor_pendaftaran','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                                <span class="error text-danger" id="error-nomor-pendaftaran"></span>
                                                @if($errors->has('details[nomor_pendaftaran]'))
                                                    <span class="error text-danger">{{ $errors->first('details[nomor_pendaftaran]') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label required">Tanggal Pendaftaran</label>
                                                {!! Form::text('details[tanggal_pendaftaran]', @$outbound->details['tanggal_pendaftaran'] ?: null, ['class' => 'form-control datepicker', 'id' => 'tanggal_pendaftaran' , 'required' => true, 'placeholder' => 'Pilih Tanggal']) !!}
                                                @if($errors->has('details[tanggal_pendaftaran]'))
                                                    <span class="error text-danger">{{ $errors->first('details[tanggal_pendaftaran]') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row" style="margin-top:10px;">
                                            <div class="col-md-4">
                                                <label class="form-label required">Kantor Pabean</label>
                                                {!! Form::select('kppbc_id', $kppbcSelectBox, $outbound->outboundKppbc->kppbc_id, ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                                                @if($errors->has('kppbc_id'))
                                                    <span class="error text-danger">{{ $errors->first('kppbc_id') }}</span>
                                                @endif
                                            </div>
            
                                            <div class="col-md-4">
                                                <label class="form-label required">Jenis TPB</label>
                                                {!! Form::select('jenis_tpb_id', $jenisTpbSelectBox, $outbound->outboundJenisTpb->jenis_tpb_id, ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --']) !!}
                                                @if($errors->has('jenis_tpb_id'))
                                                    <span class="error text-danger">{{ $errors->first('jenis_tpb_id') }}</span>
                                                @endif
                                            </div>
            
                                        </div>
                                        <div class="form-group row" style="margin-top:10px;">
                                            <div class="col-md-4">
                                                <div  class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey ">
                                                    <label class="form-label required " >Pengusaha TPB</label>
                                                    {!! Form::select('tpb_id', $tpbSelectBox, $outbound->outboundTpb->profile_id ?? '', ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id' => 'tpb_id']) !!}
                                                    @if($errors->has('tpb_id'))
                                                        <span class="error text-danger">{{ $errors->first('tpb_id') }}</span>
                                                    @endif
                                                    <div class="card p-1 " style="margin-top: 10px" id="tpb_info">
                                                        <table  class=" table align-middle  table-row-dashed table-row-gray-400 fs-8 dataTable no-footer text-gray-600" role="grid" aria-describedby="table_info">
                                                            <tbody >
                                                            <tr >
                                                                <td  class="d-flex p-1">
                                                                    <div>Tipe Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='tipe_identitas_tpb'>Pilih pengusaha TPB</div>
                                                                </td>
                                                            </tr>
                                                            <tr >
                                                                <td  class="d-flex p-1">
                                                                    <div>Nomor Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='nomor_identitas_tpb'>Pilih pengusaha TPB</div>
                                                                </td>
                                                            </tr >
                                                            <tr >
                                                                <td  class="d-flex p-1">
                                                                    <div>Negara : &nbsp;</div><div class=" " readonly ='readonly'  id ='negara_pengusaha_tpb'>Pilih pengusaha TPB</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Alamat : &nbsp;</div><div class=" " readonly ='readonly'  id ='alamat_pengusaha_tpb'>Pilih pengusaha TPB</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>No Izin: &nbsp;</div><div class=" " readonly ='readonly'  id ='no_izin_tpb'>Pilih pengusaha TPB</div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey ">
                                                    <label class="form-label required">pemilik Barang</label>
                                                    {!! Form::select('pemilik_barang_id', $pemilikBarangSelectBox, $outbound->outboundPemilikBarang->profile_id ?? '', [ 'class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --' ,'id'=>'pemilik_barang_id']) !!}
                                                    @if($errors->has('pemilik_barang_id'))
                                                        <span class="error text-danger">{{ $errors->first('pemilik_barang_id') }}</span>
                                                    @endif
                                                    <div class="card  p-1" style="margin-top: 10px" id="pemilik_barang_info">
                                                        <table  class=" table align-middle  table-row-dashed table-row-gray-400 fs-8 dataTable no-footer text-gray-600" role="grid" aria-describedby="table_info">
                                                            <tbody>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Tipe Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='tipe_identitas_pemilik_barang'>Pilih pemilik barang</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Nomor Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='nomor_identitas_pemilik_barang'>Pilih pemilik barang</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Country : &nbsp;</div><div class=" " readonly ='readonly'  id ='negara_pemilik_barang'>Pilih pemilik barang</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Address : &nbsp;</div><div class=" " readonly ='readonly'  id ='alamat_pemilik_barang'>Pilih pemilik barang</div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div  class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey ">
                                                    <label class="form-label required">Penerima Barang</label>
                                                    {!! Form::select('penerima_barang_id', $penerimaBarangSelectBox, $outbound->outboundPenerimaBarang->profile_id ?? '', [ 'class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --' ,'id'=>'penerima_barang_id']) !!}
                                                    @if($errors->has('penerima_barang_id'))
                                                        <span class="error text-danger">{{ $errors->first('penerima_barang_id') }}</span>
                                                    @endif
                                                    <div class="card  p-1 " style="margin-top: 10px" id="penerima_barang_info">
                                                        <table  class=" table align-middle  table-row-dashed table-row-gray-400 fs-8 dataTable no-footer text-gray-600" role="grid" aria-describedby="table_info">
                                                            <tbody>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Tipe Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='tipe_identitas_penerima_barang'>Pilih penerima barang</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Nomor Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='nomor_identitas_penerima_barang'>Pilih penerima barang</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Country : &nbsp;</div><div class=" " readonly ='readonly'  id ='negara_penerima_barang'>Pilih penerima barang</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Address : &nbsp;</div><div class=" " readonly ='readonly'  id ='alamat_penerima_barang'>Pilih penerima barang</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
            
                                                                <td class="d-flex p-1">
                                                                    <div>Tipe API : &nbsp;</div><div class=" " readonly ='readonly'  id ='jenis_api_penerima_barang'>Pilih penerima barang</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Nomor API : &nbsp;</div><div class=" " readonly ='readonly'  id ='nomor_api_penerima_barang'>Pilih penerima barang</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>NIPER  : &nbsp;</div><div class=" " readonly ='readonly'  id ='niper_penerima_barang'>Pilih penerima barang</div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        </div>
            
                                        @include('outbound.bc25.edit.partials.transport')
                                        <div class="form-group row" style="margin-top:10px;">
                                            <h2 class="fw-bolder mt-4">Transaksi</h2>
                                            <div class="form-group row border-dashed border-1 rounded p-3" style="border-color:lightgrey;margin-top: 10px;">
                                                <div class="col-md-12" style="background-color: lightblue;padding:5px; ">
                                                    <label class="form-label required">Tipe Perhitungan</label>
                                                    {!! Form::select('details[type_calculate]', [0 => 'Perhitungan Konversi', 1 => 'Perhitungan Bahan Baku'], @$outbound->details["type_calculate"] ?: 0 , ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'id' => 'type-calculate' , 'data-control' => 'select2']) !!}
                                                    @if($errors->has('details[type_calculate]'))
                                                        <span class="error text-danger">{{ $errors->first('details[type_calculate]') }}</span>
                                                    @endif
                                                </div>
                                            </div>    
                                            <div class="form-group row" style="margin-top:10px;">
                                                <div class="col-md-6">
                                                    <label class="form-label required">Valuta</label>
                                                    {!! Form::select('valas_id', $valas, $outbound->outboundValas->valas_id, ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'id' => 'valas_id' , 'data-control' => 'select2']) !!}
                                                    @if($errors->has('valas_id'))
                                                        <span class="error text-danger">{{ $errors->first('valas_id') }}</span>
                                                    @endif
                                                </div>
                
                                                <div class="col-md-6">
                                                    <label class="form-label">NDPBM</label>
                                                    {!! Form::number('details[ndpbm]', @$outbound->details["ndpbm"] ?: 0, ['class' => 'form-control bg-secondary', 'readonly' => 'readonly' , 'required' => true, 'placeholder' => 'Input', 'id' => 'ndpbm']) !!}
                                                    @if($errors->has('details[ndpbm]'))
                                                        <span class="error text-danger">{{ $errors->first('details[fob]') }}</span>
                                                    @endif
                                                </div>
            
                                            </div>

                                            <div class="form-group row" style="margin-top:10px;">
                                                <div class="col-md-6">
                                                    <label class="form-label">Nilai CIF</label>
                                                    {!! Form::number('details[nilai_cif]', @$outbound->details["nilai_cif"] ?: 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'nilai_cif', 'readonly']) !!}
                                                    @if($errors->has('details[nilai_cif]'))
                                                        <span class="error text-danger">{{ $errors->first('details[nilai_cif]') }}</span>
                                                    @endif
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Cif RP</label>
                                                    {!! Form::number('details[cif_rp]',  @$outbound->details["cif_rp"] ?: 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'cif_rp',  'maxlength' => '18', 'min' => '0', 'readonly' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                                    if(this.value<0){this.value='0'}"]) !!}
                                                    @if($errors->has('details[cif_rp]'))
                                                        <span class="error text-danger">{{ $errors->first('details[cif_rp]') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row" style="margin-top:10px;">
                                                <div class="col-md-12">
                                                    <label class="form-label">Harga Penyerahan</label>
                                                    {!! Form::number('details[harga_penyerahan]', @$outbound->details["harga_penyerahan"] ?: 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'harga_penyerahan', 'readonly']) !!}
                                                    @if($errors->has('details[harga_penyerahan]'))
                                                        <span class="error text-danger">{{ $errors->first('details[harga_penyerahan]') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
            
                                        <div class="form-group row" style="margin-top:10px;">
                                            <h2 class="fw-bolder mt-4">Peti Kemas</h2>
                                            <div class="col-md-3">
                                                <label class="form-label required">Nomor</label>
                                                {!! Form::text('details[nomor_peti_kemas]',  @$outbound->details['nomor_peti_kemas'] ?: null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input', 'id' => 'nomor_peti_kemas','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                                @if($errors->has('details[nomor_peti_kemas]'))
                                                    <span class="error text-danger">{{ $errors->first('details[nomor_peti_kemas]') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label required">Ukuran</label>
                                                {!! Form::select('details[ukuran_peti_kemas_id]', $masterUkuranPetiKemas, @$outbound->details['ukuran_peti_kemas_id'] ?: null, ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                                                @if($errors->has('details[ukuran_peti_kemas_id]'))
                                                    <span class="error text-danger">{{ $errors->first('details[ukuran_peti_kemas_id]') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label required">Jenis</label>
                                                {!! Form::select('details[jenis_peti_kemas]', ['4 - EMPTY' => '4 - EMPTY' , '7 - LCL' => '7 - LCL' , '8 - FCL' => '8 - FCL'],  @$outbound->details['jenis_peti_kemas'] ?: null, ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                                                @if($errors->has('details[jenis_peti_kemas]'))
                                                    <span class="error text-danger">{{ $errors->first('details[jenis_peti_kemas]') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label required">Tipe</label>
                                                {!! Form::select('details[type_peti_kemas_id]', $masterTypePetiKemas, @$outbound->details['type_peti_kemas_id'] ?: null, ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2', 'id' => 'type_peti_kemas_id']) !!}
                                                @if($errors->has('details[type_peti_kemas_id]'))
                                                    <span class="error text-danger">{{ $errors->first('details[type_peti_kemas_id]') }}</span>
                                                @endif
                                            </div>
                                        </div>
            
                                        @include('outbound.components.edit.documents')
                                        <div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                                            <h2 class="fw-bolder mt-4">Detail Barang</h2>
                                            <div class="form-group row" style="margin-top:10px;">
                                                <div class="col-md-12">
                                                    
                                                    @if($errors->has('list_barang'))
                                                        <span class="error text-danger">{{ $errors->first('list_barang') }}</span>
                                                    @endif
                                                    <div class="form-group row">
                                                        <div class="form-group mt-5">
                                                            <a href="javascript:void(0);" id="btn-tambah-barang" data-bs-toggle="modal" data-bs-target="#add-modal" class="btn btn-light-primary">
                                                                <i class="la la-plus"></i>Add
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @include('outbound.components.edit.goods_table')
                                                </div>
                                            </div>
                
                                            <div class="form-group row" style="margin-top:10px;">
                                                <div class="col-md-3">
                                                    <label class="form-label required">Jenis Pengeluaran Barang</label>
                                                        <select id="partialku" class="form-control" name="partial" id="partial" data-control="select2">
                                                            <option value="" disabled selected>--Select--</option>
                                                            <option value="1">Pengiriman Partial</option>
                                                            <option value="0">Tidak Partial</option>
                                                        </select>
                                                    @if($errors->has('partial'))
                                                        <span class="error text-danger">{{ $errors->first('partial') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Volume (m3)</label>
                                                    {!! Form::number('details[volume]', @$outbound->details["volume"] ?: 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'total_volume', 'readonly' => 'readonly', 'step' => 'any']) !!}
                                                    @if($errors->has('details[volume]'))
                                                        <span class="error text-danger">{{ $errors->first('details[volume]') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Berat Kotor (Kg)</label>
                                                    {!! Form::number('details[berat_kotor]', @$outbound->details["berat_kotor"] ?: 0, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input' , 'id' => 'total_berat_kotor', 'step' => 'any']) !!}
                                                    @if($errors->has('details[berat_kotor]'))
                                                        <span class="error text-danger">{{ $errors->first('details[berat_kotor]') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Berat Bersih (Kg)</label>
                                                    {!! Form::number('details[berat_bersih]', @$outbound->details["berat_bersih"] ?: 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input' , 'readonly' , 'id' => 'total_berat_bersih', 'step' => 'any']) !!}
                                                    @if($errors->has('details[berat_bersih]'))
                                                        <span class="error text-danger">{{ $errors->first('details[berat_bersih]') }}</span>
                                                    @endif
                                                </div>
                                            
                                            </div>
                                        </div>
            
                                        @include('outbound.bc25.edit.partials.pungutan')
            
                                        {!! Form::hidden('list_barang', null, ['id' => 'list_barang']) !!}
                                        <div class=" bg-light-primary border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                                                <p>
                                                    Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal yang diberitahukan dalam
                                                    pemberitahuan pabean ini
                                                </p>  
            
                                            <div class="form-group">
                                                <div class="form-group row">
                                                    <div class="col-md-3">
                                                        <label class="form-label required">Tempat</label>
                                                        <label class="form-label required">Kota</label>
                                                        {!! Form::select('city_id', $citySelectBox,$outbound->city_id ?? '' ?? '', ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                                                        @if($errors->has('city_id'))
                                                            <span class="error text-danger">{{ $errors->first('city_id') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label required">Tanggal</label>
                                                        {!! Form::text('details[pabean_tanggal]', @$outbound->details['pabean_tanggal'] ?: null, ['class' => 'form-control datepicker', 'required' => true, 'placeholder' => 'input Tanggal','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                                        @if($errors->has('details[pabean_tanggal]'))
                                                            <span class="error text-danger">{{ $errors->first('details[pabean_tanggal]') }}</span>
                                                        @endif
                                                    </div> 
                                                    <div class="col-md-3">
                                                        <label class="form-label required">Pemberitahu</label>
                                                        {!! Form::text('details[pabean_pemberitahu]', @$outbound->details['pabean_pemberitahu'] ?: null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input Pemberi Tahu','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                                        @if($errors->has('details[pabean_pemberitahu]'))
                                                            <span class="error text-danger">{{ $errors->first('details[pabean_pemberitahu]') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label required">Jabatan</label>
                                                        {!! Form::text('details[pabean_jabatan]', @$outbound->details['pabean_jabatan'] ?: null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input Jabatan','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                                        @if($errors->has('details[pabean_jabatan]'))
                                                            <span class="error text-danger">{{ $errors->first('details[pabean_jabatan]') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--begin::Actions-->
                                        <div class="text-center" style="margin-top:20px;">
                                            <a href="javascript:history.back()" id="" class="btn btn-light me-3">Cancel</a>
                                            <button type="submit" id="" class="btn btn-primary">
                                                <span class="indicator-label">Submit</span>
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>               
                                </div>
                            </div>
                            <div  class="tab-pane fade" id="nav-import" role="tabpanel" aria-labelledby="nav-import-tab">
                                @include("outbound.bc25.edit.partials.material_import")
                            </div>
                            <div class="tab-pane fade" id="nav-local" role="tabpanel" aria-labelledby="nav-local-tab">
                                @include("outbound.bc25.edit.partials.material_local")
                            </div>  
                        </div>
                    {!! Form::close() !!}

                    @include("outbound.bc25.edit.partials.calculate.calculate_import_modal")
                    @include("outbound.bc25.edit.partials.calculate.calculate_local_modal")
                    @include('outbound.components.edit.edit_modal', ['bc' => 'BC25'])
                    @include('outbound.components.detail.detail_modal', ['bc' => 'BC25'])
                  

                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
@endsection

@push('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"
        integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
@endpush

@push('js')
    <script>
        
        const outbound                  = @json($outbound);
        var outboundDetails             = outbound.outbound_details;
        var selectedOutboundDetail      = {};
        var selectedGoods               = outboundDetails ;
        var inventoryOutboundDetails    = outbound.inventory_outbound_detail;
        var nettWeight                  = 0;
        var volume                      = 0;

        const refreshGoodsInfo = () => {
            $('#list_barang').val(JSON.stringify(selectedGoods));
            let totalVolume = 0;
            let totalBeratBersih = 0;
            let totalBeratKotor = 0;

            let bmDitangguhkan = 0;
            let bmDibebaskan = 0;
            let bmTidakDipungut = 0;
            let pphDitangguhkan = 0;
            let pphDibebaskan = 0;
            let pphTidakDipungut = 0;
            let ppnDitangguhkan = 0;
            let ppnDibebaskan = 0;
            let ppnTidakDipungut = 0;
            let ppnbmDitangguhkan = 0;
            let ppnbmDibebaskan = 0;
            let ppnbmTidakDipungut = 0;

            let totalCifRp = 0;
            let totalNilaiCif = 0;
            let totalHargaPenyerahan = 0;

            let typeCalculate = $('#type-calculate').val();

            if(typeCalculate == 0){
                   
                selectedGoods.forEach((item) => {
                    totalVolume += parseFloat(item.volume);
                    totalBeratBersih += parseFloat(item.nett_weight);
                    // totalBeratKotor += parseFloat(item.details.bruto);
                    totalNilaiCif += parseFloat(item.details.nilai_cif);
                    totalCifRp += parseFloat(item.details.cif_rp);
                    totalHargaPenyerahan += parseFloat(item.details.harga_penyerahan);

                    let bm = 0;
                    let bmRaw = 0;
                    if (item.details.bm_type == "1") { //Advolorum
                        bmRaw += parseFloat(item.details.cif_rp) * parseFloat(item.details.bm) / 100
                        bm = parseFloat(item.details.cif_rp) * parseFloat(item.details.bm) / 100 * (parseFloat(item.details.bm_tax_value) / 100);
                    } else {
                        bmRaw += parseFloat(item.details.bm) * parseFloat(item.quantity)
                        bm = parseFloat(item.details.bm) * parseFloat(item.quantity) * (parseFloat(item.details.bm_tax_value) / 100);
                    }

                    if (item.details.bm_tax_type == "1") { //Ditangguhkan
                        bmDitangguhkan += bm
                    } else if (item.details.bm_tax_type == "5") { //Dibebaskan
                        bmDibebaskan += bm
                    } else if (item.details.bm_tax_type == "6") { //Tidak Dipungut
                        bmTidakDipungut += bm
                    }

                    const pph = (parseFloat(item.details.cif_rp) + bmRaw) * parseFloat(item.details.pph) / 100 * (parseFloat(item.details.pph_tax_value) / 100);
                    if (item.details.pph_tax_type == "1") { //Ditangguhkan
                        pphDitangguhkan += pph;
                    } else if (item.details.pph_tax_type == "5") { //Dibebaskan
                        pphDibebaskan += pph;
                    } else if (item.details.pph_tax_type == "6") { //Tidak Dipungut
                        pphTidakDipungut += pph;
                    }

                    const ppn = (parseFloat(item.details.cif_rp) + bmRaw) * parseFloat(item.details.ppn) / 100 * (parseFloat(item.details.ppn_tax_value) / 100);
                    if (item.details.ppn_tax_type == "1") { //Ditangguhkan
                        ppnDitangguhkan += ppn;
                    } else if (item.details.ppn_tax_type == "5") { //Dibebaskan
                        ppnDibebaskan += ppn;
                    } else if (item.details.ppn_tax_type == "6") { //Tidak Dipungut
                        ppnTidakDipungut += ppn;
                    }

                    const ppnbm = (parseFloat(item.details.cif_rp) + bmRaw) * parseFloat(item.details.ppnbm) / 100 * (parseFloat(item.details.ppnbm_tax_value) / 100);
                    if (item.details.ppnbm_tax_type == "1") { //Ditangguhkan
                        ppnbmDitangguhkan += ppnbm;
                    } else if (item.details.ppnbm_tax_type == "5") { //Dibebaskan
                        ppnbmDibebaskan += ppnbm;
                    } else if (item.details.ppnbm_tax_type == "6") { //Tidak Dipungut
                        ppnbmTidakDipungut += ppnbm;
                    }
                });

                $('#harga_penyerahan').val(totalHargaPenyerahan)
                $('#cif_rp').val(totalCifRp)
                $('#nilai_cif').val(totalNilaiCif)

                $('#bm_ditangguhkan').val(bmDitangguhkan)
                $('#bm_dibebaskan').val(bmDibebaskan)
                $('#bm_tidak_dipungut').val(bmTidakDipungut)
                $('#pph_ditangguhkan').val(pphDitangguhkan)
                $('#pph_dibebaskan').val(pphDibebaskan)
                $('#pph_tidak_dipungut').val(pphTidakDipungut)
                $('#ppn_ditangguhkan').val(ppnDitangguhkan)
                $('#ppn_dibebaskan').val(ppnDibebaskan)
                $('#ppn_tidak_dipungut').val(ppnTidakDipungut)
                $('#ppnbm_ditangguhkan').val(ppnbmDitangguhkan)
                $('#ppnbm_dibebaskan').val(ppnbmDibebaskan)
                $('#ppnbm_tidak_dipungut').val(ppnbmTidakDipungut)

                const totalDitangguhkan = bmDitangguhkan + pphDitangguhkan + ppnDitangguhkan + ppnbmDitangguhkan;
                const totalDibebaskan = bmDibebaskan + pphDibebaskan + ppnDibebaskan + ppnbmDibebaskan;
                const totalTidakDipungut = bmTidakDipungut + pphTidakDipungut + ppnTidakDipungut + ppnbmTidakDipungut;
                $('#total_ditangguhkan').val(totalDitangguhkan)
                $('#total_dibebaskan').val(totalDibebaskan)
                $('#total_tidak_dipungut').val(totalTidakDipungut)

            }


            $('#total_volume').val(totalVolume)
            $('#total_berat_bersih').val(totalBeratBersih)
            // $('#total_berat_kotor').val(totalBeratKotor)
   

            $('#table').DataTable().clear().rows.add(selectedGoods).draw()
        }

        var rawGoods = [];
        $.each(outboundDetails, (i , vi) => {
            $.each(vi.outbound_detail_raw_goods, (x, vx) => {
                rawGoods.push(vx);
            });
        });

        const refreshGoodsBahanBakuInfo = () => {

            var dataAllGoods = [];

            $.each(selectedGoods, (x, vx) => {

                var rawGood = [];
                
                $.each(selectedImportGoods, (z, vz) => {

                    if(vx.good_id == vz.good_conversion_id){
                        rawGood.push(vz);
                    }
                });

                $.each(selectedLocalGoods, (z, vz) => {

                    if(vx.good_id == vz.good_conversion_id){
                        rawGood.push(vz);
                    }
                });

                vx.rawGoods = rawGood;
                dataAllGoods.push(vx);
            });


            $('#list_barang').val(JSON.stringify(dataAllGoods));
            let totalVolume = 0;
            let totalBeratBersih = 0;
            let totalBeratKotor = 0;
            let totalharga_penyerahan = 0;

            let bmDitangguhkan = 0;
            let bmDibebaskan = 0;
            let bmTidakDipungut = 0;
            let pphDitangguhkan = 0;
            let pphDibebaskan = 0;
            let pphTidakDipungut = 0;
            let ppnDitangguhkan = 0;
            let ppnDibebaskan = 0;
            let ppnTidakDipungut = 0;
            let ppnbmDitangguhkan = 0;
            let ppnbmDibebaskan = 0;
            let ppnbmTidakDipungut = 0;

            let totalCifRp = 0;
            let totalNilaiCif = 0;

            var volumeLocal = $('#volume_local').val();
            var volumeImport = $('#volume_import').val();

            var beratBersihLocal = $('#nett_weight_local').val();
            var beratBersihImport = $('#nett_weight_import').val();

            var beratKotorLocal = $('#berat_kotor_local').val();
            var beratKotorImport = $('#berat_kotor_import').val();

            var cifRpImport = $('#cif_rp_import').val();
            var nilaiCifImport = $('#nilai_cif_import').val();

            totalVolume = parseFloat(volumeLocal) + parseFloat(volumeImport);
            totalBeratBersih = parseFloat(beratBersihLocal) + parseFloat(beratBersihImport);
            // totalBeratKotor = parseFloat(beratKotorLocal) + parseFloat(beratKotorImport);

            totalCifRp = parseFloat(cifRpImport);
            totalNilaiCif = parseFloat(nilaiCifImport);

            bmDitangguhkanImport = $('#bm_ditangguhkan_import').val();
            bmDibebaskanImport = $('#bm_dibebaskan_import').val();
            bmTidakDipungutImport = $('#bm_tidak_dipungut_import').val();

            bmDitangguhkan = parseFloat(bmDitangguhkanImport);
            bmDibebaskan = parseFloat(bmDibebaskanImport);
            bmTidakDipungut = parseFloat(bmTidakDipungutImport);

            pphDitangguhkanImport = $('#pph_ditangguhkan_import').val();
            pphDibebaskanImport = $('#pph_dibebaskan_import').val();
            pphTidakDipungutImport = $('#pph_tidak_dipungut_import').val();

            pphDitangguhkan = parseFloat(pphDitangguhkanImport);
            pphDibebaskan = parseFloat(pphDibebaskanImport);
            pphTidakDipungut = parseFloat(pphTidakDipungutImport);

            ppnDitangguhkanImport = $('#ppn_ditangguhkan_import').val();
            ppnDibebaskanImport = $('#ppn_dibebaskan_import').val();
            ppnTidakDipungutImport = $('#ppn_tidak_dipungut_import').val();

            ppnDitangguhkanLocal = $('#ppn_ditangguhkan_local').val();
            ppnDibebaskanLocal = $('#ppn_dibebaskan_local').val();
            ppnTidakDipungutLocal = $('#ppn_tidak_dipungut_local').val();

            ppnDitangguhkan = parseFloat(ppnDitangguhkanImport) + parseFloat(ppnDitangguhkanLocal);
            ppnDibebaskan = parseFloat(ppnDibebaskanImport) + parseFloat(ppnDibebaskanLocal);
            ppnTidakDipungut = parseFloat(ppnTidakDipungutImport) + parseFloat(ppnTidakDipungutLocal);

            ppnbmDitangguhkanImport = $('#ppnbm_ditangguhkan_import').val();
            ppnbmDibebaskanImport = $('#ppnbm_dibebaskan_import').val();
            ppnbmTidakDipungutImport = $('#ppnbm_tidak_dipungut_import').val();

            ppnbmDitangguhkan = parseFloat(ppnbmDitangguhkanImport);
            ppnbmDibebaskan = parseFloat(ppnbmDibebaskanImport);
            ppnbmTidakDipungut = parseFloat(ppnbmTidakDipungutImport);


            $('#total_volume').val(totalVolume)
            $('#total_berat_bersih').val(totalBeratBersih)
            // $('#total_berat_kotor').val(totalBeratKotor)
            $('#cif_rp').val(totalCifRp)
            $('#nilai_cif').val(totalNilaiCif)

            $('#bm_ditangguhkan').val(bmDitangguhkan)
            $('#bm_dibebaskan').val(bmDibebaskan)
            $('#bm_tidak_dipungut').val(bmTidakDipungut)
            $('#pph_ditangguhkan').val(pphDitangguhkan)
            $('#pph_dibebaskan').val(pphDibebaskan)
            $('#pph_tidak_dipungut').val(pphTidakDipungut)
            $('#ppn_ditangguhkan').val(ppnDitangguhkan)
            $('#ppn_dibebaskan').val(ppnDibebaskan)
            $('#ppn_tidak_dipungut').val(ppnTidakDipungut)
            $('#ppnbm_ditangguhkan').val(ppnbmDitangguhkan)
            $('#ppnbm_dibebaskan').val(ppnbmDibebaskan)
            $('#ppnbm_tidak_dipungut').val(ppnbmTidakDipungut)

            const totalDitangguhkan = bmDitangguhkan + pphDitangguhkan + ppnDitangguhkan + ppnbmDitangguhkan;
            const totalDibebaskan = bmDibebaskan + pphDibebaskan + ppnDibebaskan + ppnbmDibebaskan;
            const totalTidakDipungut = bmTidakDipungut + pphTidakDipungut + ppnTidakDipungut + ppnbmTidakDipungut;
            $('#total_ditangguhkan').val(totalDitangguhkan)
            $('#total_dibebaskan').val(totalDibebaskan)
            $('#total_tidak_dipungut').val(totalTidakDipungut)


        }

        // Local
        var selectedLocalGoods = rawGoods.filter(function(val) { return val.bc_form_id != 3 });
        var selectedLocalGood = {};
    
        const refreshLocalGoodsInfo = () => {
            $('#list_barang_local').val(JSON.stringify(selectedLocalGoods));
            let totalVolume = 0;
            let totalBeratBersih = 0;
            // let totalBeratKotor = 0;
            let totalHargaPerolehan = 0;
            let totalHargaPenyerahan = 0;

            let totalPpnBayar = 0;
            let totalPpnFasilitas = 0;

            let ppnDitangguhkan = 0;
            let ppnDibebaskan = 0;
            let ppnTidakDipungut = 0;

            selectedLocalGoods.forEach((item) => {
                totalVolume += parseFloat(item.volume);
                totalBeratBersih += parseFloat(item.nett_weight);
                // totalBeratKotor += item.details.bruto != undefined ? parseFloat(item.details.bruto) : 0;
                totalHargaPerolehan += item.details.harga_perolehan != undefined ? parseFloat(item.details.harga_perolehan) : 0;
                totalHargaPenyerahan += item.details.harga_penyerahan != undefined ? parseFloat(item.details.harga_penyerahan) : 0;

                // let bm = 0;
                // let bmRaw = 0;
        
                // const ppn = (parseFloat(item.details.cif_rp) + bmRaw) * parseFloat(item.details.ppn) / 100 * (parseFloat(item.details.ppn_tax_value) / 100);
                const ppn = ( parseFloat(item.details.harga_penyerahan) * parseFloat(item.details.ppn) / 100 * (parseFloat(item.details.ppn_tax_value) / 100));
                if (item.details.ppn_tax_type == "1") { //Ditangguhkan
                    ppnDitangguhkan += ppn;
                } else if (item.details.ppn_tax_type == "5") { //Dibebaskan
                    ppnDibebaskan += ppn;
                } else if (item.details.ppn_tax_type == "6") { //Tidak Dipungut
                    ppnTidakDipungut += ppn;
                }

                
            });


            $('#volume_local').val(totalVolume)
            $('#nett_weight_local').val(totalBeratBersih)
            // $('#berat_kotor_local').val(totalBeratKotor)
            $('#harga_perolehan_local').val(totalHargaPerolehan)
            $('#harga_penyerahan_local').val(totalHargaPenyerahan)

            $('#ppn_ditangguhkan_local').val(ppnDitangguhkan)
            $('#ppn_dibebaskan_local').val(ppnDibebaskan)
            $('#ppn_tidak_dipungut_local').val(ppnTidakDipungut)

            const totalDitangguhkan = ppnDitangguhkan ;
            const totalDibebaskan = ppnDibebaskan ;
            const totalTidakDipungut = ppnTidakDipungut;
            $('#total_ditangguhkan_local').val(totalDitangguhkan)
            $('#total_dibebaskan_local').val(totalDibebaskan)
            $('#total_tidak_dipungut_local').val(totalTidakDipungut)

            // $('#table').DataTable().clear().rows.add(selectedGoods).draw()
        }
        

        // Import
        var selectedImportGoods = rawGoods.filter(function(val) { return val.bc_form_id != 1 });;
        var selectedImportGood = {};
        console.log(selectedImportGoods);
        const refreshImportGoodsInfo = () => {
            $('#list_barang_import').val(JSON.stringify(selectedImportGoods));
            let totalVolume = 0;
            let totalBeratBersih = 0;
            // let totalBeratKotor = 0;
            let totalharga_penyerahan = 0;

            let bmDitangguhkan = 0;
            let bmDibebaskan = 0;
            let bmTidakDipungut = 0;
            let pphDitangguhkan = 0;
            let pphDibebaskan = 0;
            let pphTidakDipungut = 0;
            let ppnDitangguhkan = 0;
            let ppnDibebaskan = 0;
            let ppnTidakDipungut = 0;
            let ppnbmDitangguhkan = 0;
            let ppnbmDibebaskan = 0;
            let ppnbmTidakDipungut = 0;

            let totalCifRp = 0;
            let totalNilaiCif = 0;

            selectedImportGoods.forEach((item) => {

                totalVolume += parseFloat(item.volume);
                totalBeratBersih += parseFloat(item.nett_weight);
                // totalBeratKotor += parseFloat(item.details.bruto);
                totalNilaiCif += parseFloat(item.details.nilai_cif);
                totalCifRp += parseFloat(item.details.cif_rp);

                let bm = 0;
                let bmRaw = 0;
                if (item.details.bm_type == "1") { //Advolorum
                    bmRaw += parseFloat(item.details.cif_rp) * parseFloat(item.details.bm) / 100
                    bm = parseFloat(item.details.cif_rp) * parseFloat(item.details.bm) / 100 * (parseFloat(item.details.bm_tax_value) / 100);
                } else {
                    bmRaw += parseFloat(item.details.bm) * parseFloat(item.quantity)
                    bm = parseFloat(item.details.bm) * parseFloat(item.quantity) * (parseFloat(item.details.bm_tax_value) / 100);
                }

                if (item.details.bm_tax_type == "1") { //Ditangguhkan
                    bmDitangguhkan += bm
                } else if (item.details.bm_tax_type == "5") { //Dibebaskan
                    bmDibebaskan += bm
                } else if (item.details.bm_tax_type == "6") { //Tidak Dipungut
                    bmTidakDipungut += bm
                }

                const pph = (parseFloat(item.details.cif_rp) + bmRaw) * parseFloat(item.details.pph) / 100 * (parseFloat(item.details.pph_tax_value) / 100);
                if (item.details.pph_tax_type == "1") { //Ditangguhkan
                    pphDitangguhkan += pph;
                } else if (item.details.pph_tax_type == "5") { //Dibebaskan
                    pphDibebaskan += pph;
                } else if (item.details.pph_tax_type == "6") { //Tidak Dipungut
                    pphTidakDipungut += pph;
                }

                const ppn = (parseFloat(item.details.cif_rp) + bmRaw) * parseFloat(item.details.ppn) / 100 * (parseFloat(item.details.ppn_tax_value) / 100);
                if (item.details.ppn_tax_type == "1") { //Ditangguhkan
                    ppnDitangguhkan += ppn;
                } else if (item.details.ppn_tax_type == "5") { //Dibebaskan
                    ppnDibebaskan += ppn;
                } else if (item.details.ppn_tax_type == "6") { //Tidak Dipungut
                    ppnTidakDipungut += ppn;
                }

                const ppnbm = (parseFloat(item.details.cif_rp) + bmRaw) * parseFloat(item.details.ppnbm) / 100 * (parseFloat(item.details.ppnbm_tax_value) / 100);
                if (item.details.ppnbm_tax_type == "1") { //Ditangguhkan
                    ppnbmDitangguhkan += ppnbm;
                } else if (item.details.ppnbm_tax_type == "5") { //Dibebaskan
                    ppnbmDibebaskan += ppnbm;
                } else if (item.details.ppnbm_tax_type == "6") { //Tidak Dipungut
                    ppnbmTidakDipungut += ppnbm;
                }
            });
            $('#volume_import').val(totalVolume)
            $('#nett_weight_import').val(totalBeratBersih)
            // $('#berat_kotor_import').val(totalBeratKotor)
            $('#cif_rp_import').val(totalCifRp)
            $('#nilai_cif_import').val(totalNilaiCif)

            $('#bm_ditangguhkan_import').val(bmDitangguhkan)
            $('#bm_dibebaskan_import').val(bmDibebaskan)
            $('#bm_tidak_dipungut_import').val(bmTidakDipungut)
            $('#pph_ditangguhkan_import').val(pphDitangguhkan)
            $('#pph_dibebaskan_import').val(pphDibebaskan)
            $('#pph_tidak_dipungut_import').val(pphTidakDipungut)
            $('#ppn_ditangguhkan_import').val(ppnDitangguhkan)
            $('#ppn_dibebaskan_import').val(ppnDibebaskan)
            $('#ppn_tidak_dipungut_import').val(ppnTidakDipungut)
            $('#ppnbm_ditangguhkan_import').val(ppnbmDitangguhkan)
            $('#ppnbm_dibebaskan_import').val(ppnbmDibebaskan)
            $('#ppnbm_tidak_dipungut_import').val(ppnbmTidakDipungut)

            const totalDitangguhkan = bmDitangguhkan + pphDitangguhkan + ppnDitangguhkan + ppnbmDitangguhkan;
            const totalDibebaskan = bmDibebaskan + pphDibebaskan + ppnDibebaskan + ppnbmDibebaskan;
            const totalTidakDipungut = bmTidakDipungut + pphTidakDipungut + ppnTidakDipungut + ppnbmTidakDipungut;
            $('#total_ditangguhkan_import').val(totalDitangguhkan)
            $('#total_dibebaskan_import').val(totalDibebaskan)
            $('#total_tidak_dipungut_import').val(totalTidakDipungut)

            // $('#table').DataTable().clear().rows.add(selectedGoods).draw()
        }

        function float(equation, precision = 9) {
            return Math.floor(equation * (10 ** precision)) / (10 ** precision);
        }

        $(document).ready(function() {

            $('#quantity').on('keyup', function(){

                var totalNettWeight = nettWeight * $(this).val();
                var totalVolume     = volume * $(this).val();

                $('#nett_weight').val(float(totalNettWeight));
                $('#volume').val(float(totalVolume));

            });

            $('#berat_kotor_import').on('keyup', function(){

                $('#total_berat_kotor').val(parseFloat($(this).val()) + parseFloat($('#berat_kotor_local').val()));

            });

            $('#berat_kotor_local').on('keyup', function(){

                $('#total_berat_kotor').val(parseFloat($(this).val()) + parseFloat($('#berat_kotor_import').val()));

            });

            $('#create-form').submit(function(e){
                if (outboundDetails.length == 0) {
                    e.preventDefault();
                    Swal.fire('Error', 'Goods is required', 'error')
                }

                var bruto = $('#total_berat_kotor').val();
                var netto = $('#total_berat_bersih').val();
                var partial = $('#partialku').val();

                if(Number(netto) > Number(bruto)){
                    e.preventDefault();
                    Swal.fire('Error', `Netto must not be more than Bruto`, "error")
                }else if(parseFloat(bruto) == 0){
                    e.preventDefault();
                    Swal.fire('Error', `Bruto must be filled in`, "error")
                }

                if(partial == null){
                    e.preventDefault();
                    Swal.fire('Error', `Partial must be filled `, "error")
                }

                var typeCalculate = $('#type-calculate').val();
                if(typeCalculate != 0){

                    var canSubmit = true;
                    $.each(selectedImportGoods, (i, vi) => {

                        if(vi.details.cif_rp == undefined || vi.details.nilai_cif == undefined){
                            canSubmit = false;
                        }

                    });

                    $.each(selectedLocalGoods, (i, vi) => {

                        if(vi.details.harga_penyerahan == undefined){
                            canSubmit = false;
                        }

                    });

                    if(!canSubmit || selectedImportGoods.length === 0){
                        e.preventDefault();
                        Swal.fire('Error', 'Please Check Calculate of Goods !', 'error')
                    }

                    var brutoLocal = $('#berat_kotor_local').val();
                    var brutoImport = $('#berat_kotor_import').val();

                    var totalBrutoLocalImport = parseFloat(brutoLocal) + parseFloat(brutoImport);
                    var totalBruto = parseFloat($('#total_berat_kotor').val());
                    if(totalBrutoLocalImport != totalBruto){
                        e.preventDefault();
                        Swal.fire('Error', 'Total Bruto not same as ( local + import )', 'error')
                    }

                }

                

            })
  
            $('#nav-tab a[href="#nav-detil"]').tab('show') // Select tab by name
            $('#nav-tab a').on('click', function (e) {
                e.preventDefault()
                $(this).tab('show')
            })
            
            changeTipeCalculate(true);

            $('#type-calculate').on('change', function(){
                changeTipeCalculate(false);
            });

            function changeTipeCalculate(isFirts){
                
                var typeCalculate = $('#type-calculate').val();
             
                if(typeCalculate == 0){
                    const formUrls = [
                        'outbound/bc-25/form/tarif-fasilitas',
                        'outbound/bc-25/form/satuan-berat-harga'
                    ];

                    $.each(formUrls, (i , vi) => {
                        $.ajax({
                            type: 'GET',
                            url : vi,
                            success : function (data) {
                                if(i == 0){
                                    $("#tarif-fasilitas-conversion").append(data);
                                }else {
                                    $("#satuan-berat-harga-conversion").append(data);
                                }
                            }
                        });
                    });

                    if(!isFirts)
                        refreshGoodsInfo();

                    $('#nav-import-tab').addClass('disabled');
                    $('#nav-local-tab').addClass('disabled');
                    $('.harga-penyerahan-container').show();
                    $('.netto-volume-bruto-container').show();
                    $('#jumlah-satuan-container').removeClass('col-md-6');
                    $('#jumlah-satuan-container').addClass('col-md-4');
                    $('#jenis-satuan-container').removeClass('col-md-6');
                    $('#jenis-satuan-container').addClass('col-md-4');

                }else {

                    refreshGoodsBahanBakuInfo();

                    $("#tarif-fasilitas-conversion div").remove();
                    $("#satuan-berat-harga-conversion div").remove();
                    $('#nav-import-tab').removeClass('disabled');
                    $('#nav-local-tab').removeClass('disabled');
                    $('.harga-penyerahan-container').hide();
                    $('.netto-volume-bruto-container').hide();
                    $('#jumlah-satuan-container').removeClass('col-md-4');
                    $('#jumlah-satuan-container').addClass('col-md-6');
                    $('#jenis-satuan-container').removeClass('col-md-4');
                    $('#jenis-satuan-container').addClass('col-md-6');
                }
            }
            
            $("[name='request_number']").val($('#request_number').val());
            $("[name='details[nomor_pendaftaran]']").val($('#nomor_pendaftaran').val());
            $("[name='details[tanggal_pendaftaran]']").val($('#tanggal_pendaftaran').val());


        })
        
    
        $('#request_number').on('change',function(){
            $("[name='request_number']").val($(this).val());
        });

        $('#nomor_pendaftaran').on('change',function(){
            $("[name='details[nomor_pendaftaran]']").val($(this).val());
        });

        $('#tanggal_pendaftaran').on('change',function(){
            $("[name='details[tanggal_pendaftaran]']").val($(this).val());
        });

        $('#valas_id').on('change', function(){
            $('#ndpbm').val("");
            var value_id = this.value;
            if(value_id != "")
                $.ajax({
                    type: "GET",
                    url: '{{url('/')}}/master-data/valas/detail/'+value_id,
                    success: function(res) {
                        $('#ndpbm').val(res['nominal']);
                    },
                    error: function(res) {
                        console.log(res.responseJSON.message);
                    }
                })

        });
        $('#tpb_id').on('change', function() {
            $('#tipe_identitas_tpb').val("");
            $('#nomor_identitas_tpb').val("");
            $('#negara_pengusaha_tpb').val("");
            $('#alamat_pengusaha_tpb').val("");
            $('#warehouse_tpb').val("");
            $('#no_izin_tpb').val("");
            if(this.value == ""){
                $('#tpb_info').addClass("d-none");
            }else{
                $('#tpb_info').removeClass("d-none");
            }
            var value_tpb_id = this.value;
            if(value_tpb_id != ""){

                $.ajax({
                    type: "GET",
                    url: '{{url('/')}}/master-data/profile/detail/'+value_tpb_id,
                    success: function(res) {
                        $('#tipe_identitas_tpb').html(res['details'].tipe_identitas);
                        $('#nomor_identitas_tpb').html(res['details'].nomor_identitas);
                        $('#negara_pengusaha_tpb').html(res['name_country']);
                        $('#alamat_pengusaha_tpb').html(res['address']);
                        $('#warehouse_tpb').html(res['name_warehouse']);
                        $('#no_izin_tpb').html(res['details'].nomor_izin);
                    },
                    error: function(res) {
                        console.log(res.responseJSON.message);
                    }
                })

            }
        });
        $('#pemilik_barang_id').on('change', function() {
            $('#tipe_identitas_pemilik_barang').val("");
            $('#nomor_identitas_pemilik_barang').val("");
            $('#negara_pemilik_barang').val("");
            $('#alamat_pemilik_barang').val("");
            $('#warehouse_pemilik_barang').val("");
            if(this.value == ""){
                $('#pemilik_barang_info').addClass("d-none");
            }else{
                $('#pemilik_barang_info').removeClass("d-none");
            }
            var value_pemilik_barang_id = this.value;
            if(value_pemilik_barang_id != ""){

                $.ajax({
                    type: "GET",
                    url: '{{url('/')}}/master-data/profile/detail/'+value_pemilik_barang_id,
                    success: function(res) {
                        $('#tipe_identitas_pemilik_barang').html(res['details'].tipe_identitas);
                        $('#nomor_identitas_pemilik_barang').html(res['details'].nomor_identitas);
                        $('#negara_pemilik_barang').html(res['name_country']);
                        $('#alamat_pemilik_barang').html(res['address']);
                        $('#warehouse_pemilik_barang').html(res['name_warehouse']);
                    },
                    error: function(res) {
                        console.log(res.responseJSON.message);
                    }
                })

            }
        });
        $('#penerima_barang_id').on('change', function() {
            $('#tipe_identitas_penerima_barang').val("");
            $('#nomor_identitas_penerima_barang').val("");
            $('#negara_penerima_barang').val("");
            $('#alamat_penerima_barang').val("");
            $('#warehouse_penerima_barang').val("");
            $('#jenis_api_penerima_barang').val("");
            $('#nomor_api_penerima_barang').val("");
            $('#niper_penerima_barang').val("");
            if(this.value == ""){
                $('#penerima_barang_info').addClass("d-none");
            }else{
                $('#penerima_barang_info').removeClass("d-none");
            }
            var value_pemilik_barang_id = this.value;
            if(value_pemilik_barang_id != ""){

                $.ajax({
                    type: "GET",
                    url: '{{url('/')}}/master-data/profile/detail/'+value_pemilik_barang_id,
                    success: function(res) {
                        $('#tipe_identitas_penerima_barang').html(res['details'].tipe_identitas);
                        $('#nomor_identitas_penerima_barang').html(res['details'].nomor_identitas);
                        $('#negara_penerima_barang').html(res['name_country']);
                        $('#alamat_penerima_barang').html(res['address']);
                        $('#warehouse_penerima_barang').html(res['name_warehouse']);
                        $('#jenis_api_penerima_barang').html(res['details'].tipe_api);
                        $('#nomor_api_penerima_barang').html(res['details'].nomor_api);
                        $('#niper_penerima_barang').html(res['details'].niper);
                    },
                    error: function(res) {
                        console.log(res.responseJSON.message);
                    }
                })

            }
        });

        $('#penerima_barang_id').trigger('change');
        $('#pemilik_barang_id').trigger('change');
        $('#tpb_barang_id').trigger('change');

        let partial_num = {{ $outbound->partial }};

        if(partial_num == 2){
            $('#partialku').val(1).change()
            $('#partialku').prop('disabled', true)
        }else{
            $('#partialku').val(partial_num).change()
        }

        if({{ $partial }} == 0){
            $('#partialku').prop('disabled', false)
        }
        else{
            $('#partialku').prop('disabled', true)
        }

        var errorNomorPengajuan = $('#error-nomor-pengajuan');
        var errorNomorPendaftaran = $('#error-nomor-pendaftaran');

        $('#request_number').on('focusout', function(){

            var requestNumber =  $(this).val();
            var result = ajaxValidatin(requestNumber, 'request');

        });

        $('#nomor_pendaftaran').on('focusout', function(){

            var registerNumber =  $(this).val();
            var result = ajaxValidatin(registerNumber, 'register');

        });

        function ajaxValidatin(whereData, type){

            $.ajax({
                type: "GET",
                url: `/outbound/validation-${type}-number/${whereData}/4`,
                success: function(res) {
                    printMessageValidation(res.find_data, type);
                },
                error: function(res) {
                    console.log(res);
                }
            })


        }

        function printMessageValidation(result, type){

            console.log(result);
            var message = result ? `Nomor ${type} Suda Ada` : ``;

            if(type == 'request'){
                errorNomorPengajuan.html(message);
            }else {
                errorNomorPendaftaran.html(message);
            }

        }

        $('#btnSubmitAdd').on('click', function(){

            errorNomorPengajuan.html('');
            errorNomorPendaftaran.html('');

        });
    </script>
@endpush
