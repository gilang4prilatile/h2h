<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
#loading-overlay {
    display: none; /* Awalnya disembunyikan */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.8); /* Warna latar belakang semi transparan */
    z-index: 9999; /* Agar muncul di atas semua elemen lain */
    justify-content: center;
    align-items: center;
}

.spinner-border {
    width: 3rem;
    height: 3rem;
    border-width: .3rem;
}

</style>
@extends("layouts.main")
@section('content')
    <div id="loading-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.8); z-index: 9999;">
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <div class="toolbar" id="kt_toolbar"> 
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack"> 
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">PIB BC 20</h1>
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="javascript::void();" class="text-muted text-hover-primary">Form</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="javascript::void();" class="text-muted text-hover-primary">Add</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Data</li>
                </ul>
            </div>
            <div class="text-center">
                <a href="javascript:history.back()" id="" class="btn btn-light btn-sm me-3">back</a>
                <button type="button" id="submit-button" class="btn btn-primary btn-sm ">
                    <span class="indicator-label">save</span>
                </button>
            </div>
        </div>
    </div>
    <!--begin::Content--> 
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container">
                <!--begin::Card-->
                
                <div class="card "> 
                    <div class="card-header card-header-stretch">
                        <div class="d-flex overflow-auto h-55px">
                            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap" id="nav-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary me-6 active" id="nav-header-tab" data-toggle="tab" href="#nav-header" role="tab" aria-controls="nav-header" aria-selected="true">Header</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary me-6" id="nav-entitas-tab" data-toggle="tab" href="#nav-entitas" role="tab" aria-controls="nav-entitas" aria-selected="false">Entitas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary me-6" id="nav-dokumen-tab" data-toggle="tab" href="#nav-dokumen" role="tab" aria-controls="nav-dokumen" aria-selected="false">Dokumen</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary me-6" id="nav-pengangkut-tab" name="nav-pengangkut-tab" data-toggle="tab" href="#nav-pengangkut" role="tab" aria-controls="nav-pengangkut" aria-selected="false">Pengangkut</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary me-6" id="nav-petikemas-tab" name="nav-petikemas-tab" data-toggle="tab" href="#nav-petikemas" role="tab" aria-controls="nav-petikemas" aria-selected="false">Peti Kemas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary me-6" id="nav-transaksi-tab" data-toggle="tab" href="#nav-transaksi" role="tab" aria-controls="nav-transaksi" aria-selected="false">Transaksi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary me-6" id="nav-barang-tab" data-toggle="tab" href="#nav-barang" role="tab" aria-controls="nav-barang" aria-selected="false">Barang</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary me-6" id="nav-pungutan-tab" data-toggle="tab" href="#nav-pungutan" role="tab" aria-controls="nav-pungutan" aria-selected="false">Pungutan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary me-6" id="nav-pernyataan-tab" data-toggle="tab" href="#nav-pernyataan" role="tab" aria-controls="nav-pernyataan" aria-selected="false">Pernyataan</a>
                                </li>
                            </ul>
                        </div>
                    </div> 
                    {{-- {!! Form::model($model,["id" => "form"]) !!} --}}
                    <div class="card-body">
                        {{ Form::open(['url' => $mainUrl . '/create', 'method' => 'POST', 'id' => 'create-form', 'enctype' => 'multipart/form-data']) }}
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-header" role="tabpanel" aria-labelledby="nav-header-tab">
                                <div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey;">
                                    <div class="col-md-12">
                                        <label class="form-label required">Barang Berwujud</label>
                                        {!! Form::select('intangible_status', $JenisBarangTidakBerwujud, null, ['class' => 'form-select', 'required' => true, 'id' => 'intangible_status',  'data-control' => 'select2']) !!}
                                        @if($errors->has('intangible_status'))
                                            <span class="error text-danger">{{ $errors->first('intangible_status') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div  class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey;  margin-top:10px; ">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label class="form-label required">Nomor Pengajuan</label>
                                            {!! Form::text('request_number', $nomorPengajuan, ['class' => 'form-control ', 'required' => true, 'placeholder' => 'Input No Pengajuan' , 'id' => 'request_number','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                            <span class="error text-danger" id="error-nomor-pengajuan"></span>
                                            @if($errors->has('request_number'))
                                                <span class="error text-danger">{{ $errors->first('request_number') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label required">Nomor Pendaftaran</label>
                                            {!! Form::text('details[nomor_pendaftaran]', $nomorPengajuan, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input No Pendaftaran' , 'id' => 'nomor_pendaftaran','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                            <span class="error text-danger" id="error-nomor-pendaftaran"></span>
                                            @if($errors->has('details[nomor_pendaftaran]'))
                                                <span class="error text-danger">{{ $errors->first('details[nomor_pendaftaran]') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label required">Tanggal Pendaftaran</label>
                                            {!! Form::text('details[tanggal_pendaftaran]', date('d-m-Y'), ['class' => 'form-control datepicker', 'required' => true, 'placeholder' => 'Pilih Tanggal']) !!}
                                            @if($errors->has('details[tanggal_pendaftaran]'))
                                                <span class="error text-danger">{{ $errors->first('details[tanggal_pendaftaran]') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="form-group row"> 
                                        <div class="col-md-4" style="margin-top:10px;">
                                            <label class="form-label ">Pelabuhan Tujuan</label>
                                            {!! Form::select('destination_port_id', [], null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id' => 'destination_port_id']) !!}
                                            @if($errors->has('destination_port_id'))
                                                <span class="error text-danger">{{ $errors->first('destination_port_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-4" style="margin-top:10px;">
                                            <label class="form-label required">Kantor Pabean </label>
                                            {!! Form::select('kppbc_pengawas_id', $kppbcSelectBox, null, ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2', 'id' => 'kppbc_pengawas_id']) !!}
                                            @if($errors->has('kppbc_pengawas_id'))
                                                <span class="error text-danger">{{ $errors->first('kppbc_pengawas_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4" style="margin-top:10px;">
                                            <label class="form-label required">Jenis PIB</label>
                                            <select  class="form-control" name="pib_type_id" id="pib_type_id" data-control="select2">
                                                <option value="" disabled selected>--Select--</option>
                                                <option value="1">1 - BIASA</option>
                                                <option value="2">2 - BERKALA</option>
                                            </select>
                                            @if($errors->has('pib_type_id'))
                                                <span class="error text-danger">{{ $errors->first('pib_type_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-4" style="margin-top:10px;">
                                            <label class="form-label required">Jenis Import</label>
                                            {!! Form::select('import_type_id', $masterImportType, null, ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                                            @if($errors->has('import_type_id'))
                                                <span class="error text-danger">{{ $errors->first('import_type_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-4" style="margin-top:10px;">
                                            <label class="form-label required">Cara Bayar</label>
                                            {!! Form::select('payment_type_id', $masterPaymentType, null, ['class' => 'form-select', 'required' => true, 'data-control' => 'select2']) !!}
                                            @if($errors->has('payment_type_id'))
                                                <span class="error text-danger">{{ $errors->first('payment_type_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>   
                            <div  class="tab-pane fade" id="nav-entitas" role="tabpanel" aria-labelledby="nav-entitas-tab">
                                    <h3>ENTITAS</h3>
                                    <div class="form-group row">
                                        <div class="col-md-4 bg-transparent border-dashed border-1  rounded p-3" style="margin-bottom:10px;">
                                            <h2 class="fw-bolder mt-4"> <label class="form-label "><b>Importir</b></label></h2>
                                                {!! Form::select('importir_id', $importirSelectBox, $user_customer ?? '', ['class' => 'form-select',   'data-control' => 'select2', 'placeholder' => '-- Input --','id'=>'importir_id']) !!}
                                                @if($errors->has('importir_id'))
                                                    <span class="error text-danger">{{ $errors->first('importir_id') }}</span>
                                                @endif
                                                <br>
                                                <br>
                                                <div class="form-group row" id="importir_input" name="importir_input">
                                                    <div class="col-md-12"> 
                                                        {!! Form::select('importir_tipe_identitas', $jenisIdentitas, $user_customer ?? '', ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => 'Jenis','id'=>'importir_indentitas_type']) !!}
                                                    </div>
                                                    <div class="col-md-12"> 
                                                        {!! Form::text('importir_nomor_identitas',null, ['class' => 'form-control', 'id' => 'importir_indentitas_nomor', 'placeholder' => 'No Indentitas','oninput' => 'this.value = this.value.toUpperCase()', 'maxlength' => '25']) !!}
                                                    </div>
                                                    <div class="col-md-12"> 
                                                        {!! Form::text('importir_nama',null, ['class' => 'form-control', 'id' => 'importir_nama', 'placeholder' => 'Nama Importir','oninput' => 'this.value = this.value.toUpperCase()', 'maxlength' => '100']) !!}
                                                    </div>
                                                    <div class="col-md-12"> 
                                                        {!! Form::textarea('importir_alamat', null, ['class' => 'form-control','placeholder' => 'Alamat', 'id' => 'importir_alamat','oninput' => 'this.value = this.value.toUpperCase()', 'style' => 'height: 10px;']) !!}
                                                    </div>
                                                    <div class="col-md-4"> 
                                                        {!! Form::select('importir_tipe_api', $jenisApi, '', ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => 'API/NIB','id'=>'importir_tipe_api']) !!}
                                                    </div>
                                                    <div class="col-md-8"> 
                                                        {!! Form::text('importir_api_nib_nomor',null, ['class' => 'form-control', 'placeholder' => 'Nomor API/NIB','oninput' => 'this.value = this.value.toUpperCase()', 'maxlength' => '25']) !!}
                                                    </div>
                                                    <div class="col-md-12"> 
                                                        {!! Form::select('importir_status', $statusImportir, '', ['class' => 'form-select',  'data-control' => 'select2', 'placeholder' => 'Status','id'=>'importir_status']) !!}
                                                    </div>
                                                </div>
                                                <div  class="card p-1 d-none " style="margin-top: 10px" id="importir_info" name="importir_info">
                                                    <table  class=" table align-middle  table-row-dashed table-row-gray-400 fs-8 dataTable no-footer text-gray-600" role="grid" aria-describedby="table_info">
                                                        <tbody >
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Tipe Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='importir_tipe_identitas'>Pilih Importir</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Nomor Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='importir_nomor_identitas'>Pilih Importir</div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>No Izin : &nbsp;</div><div class=" " readonly ='readonly'  id ='importir_nomor_izin'>Pilih Importir</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Alamat : &nbsp;</div><div class=" " readonly ='readonly'  id ='importir_alamatv'>Pilih Importir</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Negara : &nbsp;</div><div class=" " readonly ='readonly'  id ='importir_country'>Pilih Importir</div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                        </div>

                                        <div class="col-md-4 bg-transparent border-dashed border-1 rounded p-3" style="margin-bottom:10px;">
                                            <h2 class="fw-bolder mt-4"> 
                                                <label class="form-label ">
                                                    <b>Pemilik Barang</b>
                                                    <a href="javascript:void(0);" id="btn-salin-importir-pemilik" class="btn btn-sm btn-light-primary">Salin importir</a>
                                                </label>
                                            </h2>
                                                {!! Form::select('pemilik_barang_id', $pemilikBarangSelectBox, $user_customer ?? '', ['class' => 'form-select',  'data-control' => 'select2', 'placeholder' => '-- Input --', 'id'=>'pemilik_barang_id']) !!}
                                                @if($errors->has('pemilik_barang_id'))
                                                    <span class="error text-danger">{{ $errors->first('pemilik_barang_id') }}</span>
                                                @endif
                                                <br>
                                                <br>
                                                <div class="form-group row" id="pemilik_barang_input" name="pemilik_barang_input">
                                                    <div class="col-md-12"> 
                                                        {!! Form::select('pemilik_tipe_identitas', $jenisIdentitas, $user_customer ?? '', ['class' => 'form-select',  'data-control' => 'select2', 'placeholder' => 'Jenis','id'=>'pemilik_indentitas_type']) !!}
                                                    </div>
                                                    <div class="col-md-12"> 
                                                        {!! Form::text('pemilik_nomor_identitas',null, ['class' => 'form-control','id'=>'pemilik_indentitas_nomor', 'placeholder' => 'No Indentitas','oninput' => 'this.value = this.value.toUpperCase()', 'maxlength' => '25']) !!}
                                                    </div>
                                                    <div class="col-md-12"> 
                                                        {!! Form::text('pemilik_nama',null, ['class' => 'form-control','id'=>'pemilik_nama', 'placeholder' => 'Nama Pemilik','oninput' => 'this.value = this.value.toUpperCase()', 'maxlength' => '100']) !!}
                                                    </div>
                                                    <div class="col-md-12">
                                                        {!! Form::textarea('pemilik_alamat', null, ['class' => 'form-control', 'placeholder' => 'Alamat','id' => 'pemilik_alamat', 'style' => 'height: 10px;','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                                    </div>
                                                </div>
                                                
                                                <div class="card p-1" style="margin-top: 10px; display:none;" id="pemilik_barang_info" name="pemilik_barang_info">
                                                    <table  class=" table align-middle  table-row-dashed table-row-gray-400 fs-8 dataTable no-footer text-gray-600" role="grid" aria-describedby="table_info">
                                                        <tbody >
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Tipe Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='tipe_identitas_pemilik_barang'>Pilih Pemilik Barang</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Nomor Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='nomor_identitas_pemilik_barang'>Pilih Pemilik</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Nama : &nbsp;</div><div class=" " readonly ='readonly'  id ='nama_pemilik_barang'>Pemilik Barang</div>
                                                                </td>
                                                            </tr> 
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Alamat : &nbsp;</div><div class=" " readonly ='readonly'  id ='alamat_pemilik_barang'>Pilih Pemilik Barang</div>
                                                                </td>
                                                            </tr> 
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Negara : &nbsp;</div><div class=" " readonly ='readonly'  id ='negara_pemilik_barang'>Pilih Pemilik Barang</div>
                                                                </td>
                                                            </tr>
                                                           
                                                        </tbody>
                                                    </table> 
                                                </div>
                                        </div>
                                        <div class="col-md-4 bg-transparent border-dashed border-1  rounded p-3" style="margin-bottom:10px;">
                                          <h2 class="fw-bolder mt-4"> 
                                                <label class="form-label ">
                                                    <b>NPWP Pemusatan</b>
                                                    <a href="javascript:void(0);" id="btn-salin-importir-pemusatan" class="btn btn-sm  btn-light-primary">Salin importir</a>
                                                </label>
                                            </h2>
                                                {!! Form::select('pemusatan_barang_id', $pemusatanSelectBox, $user_customer ?? '', ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Input --','id'=>'pemusatan_barang_id']) !!}
                                                @if($errors->has('pemusatan_barang_id'))
                                                    <span class="error text-danger">{{ $errors->first('pemusatan_barang_id') }}</span>
                                                @endif
                                                <br>
                                                <br>
                                                <div class="form-group row" id="pemusatan_input" name="pemusatan_input">
                                                    <div class="col-md-12"> 
                                                        {!! Form::select('pemusatan_tipe_identitas', $jenisIdentitas, $user_customer ?? '', ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => 'Jenis Identitas','id'=>'pemusatan_indentitas_type']) !!}
                                                    </div> <br>
                                                    <div class="col-md-12"> 
                                                        {!! Form::text('pemusatan_nomor_identitas',null, ['class' => 'form-control', 'placeholder' => 'No Identitas', 'id' => 'pemusatan_indentitas_nomor','oninput' => 'this.value = this.value.toUpperCase()', 'maxlength' => '25']) !!}
                                                    </div> <br>
                                                    <div class="col-md-12"> 
                                                        {!! Form::text('pemusatan_nama',null, ['class' => 'form-control', 'placeholder' => 'Nama Pemusatan', 'id' => 'pemusatan_nama','oninput' => 'this.value = this.value.toUpperCase()', 'maxlength' => '100']) !!}
                                                    </div> <br>
                                                    <div class="col-md-12"> 
                                                        {!! Form::textarea('pemusatan_alamat', null, ['class' => 'form-control', 'placeholder' => 'Alamat', 'id' => 'pemusatan_alamat', 'style' => 'height: 10px;','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                                    </div>
                                                </div>
                                                <div  class="card p-1" style="margin-top: 10px ; display:none;" id="pemusatan_info" name="pemusatan_info">
                                                    <table  class=" table align-middle  table-row-dashed table-row-gray-400 fs-8 dataTable no-footer text-gray-600" role="grid" aria-describedby="table_info">
                                                        <tbody >
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Tipe Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='pemusatan_tipe_identitas'>Pilih pemusatan</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Nomor Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='pemusatan_nomor_identitas'>Pilih pemusatan</div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>No Izin : &nbsp;</div><div class=" " readonly ='readonly'  id ='pemusatan_nomor_izin'>Pilih pemusatan</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Alamat : &nbsp;</div><div class=" " readonly ='readonly'  id ='pemusatan_alamatv'>Pilih pemusatan</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Negara : &nbsp;</div><div class=" " readonly ='readonly'  id ='pemusatan_country'>Pilih pemusatan</div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                        </div>   
                                        <div class="col-md-4 bg-transparent border-dashed border-1  rounded p-3" style="margin-bottom:10px;">
                                            <h2 class="fw-bolder mt-4"> 
                                                <label class="form-label ">
                                                    <b>Pengirim Barang</b>
                                                </label>
                                            </h2>
                                                {!! Form::select('pengirim_barang_id', $pengirimBarangSelectBox, $user_customer ?? '', ['class' => 'form-select',   'data-control' => 'select2', 'placeholder' => '-- Input --', 'id'=>'pengirim_barang_id']) !!}
                                                @if($errors->has('pengirim_barang_id'))
                                                    <span class="error text-danger">{{ $errors->first('pengirim_barang_id') }}</span>
                                                @endif
                                                <br>
                                                <br>
                                                <div class="form-group row" id="pengirim_barang_input"> 
                                                    <div class="col-md-12"> 
                                                        {!! Form::text('pengirim_nama',null, ['class' => 'form-control', 'placeholder' => 'Nama','oninput' => 'this.value = this.value.toUpperCase()', 'maxlength' => '100', 'id' => 'pengirim_nama']) !!}
                                                    </div>
                                                    <div class="col-md-12"> 
                                                        {!! Form::textarea('pengirim_alamat', null, ['class' => 'form-control', 'placeholder' => 'Alamat', 'id' => 'pengirim_alamat', 'style' => 'height: 10px;','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                                    </div>
                                                    <div class="col-md-12"> 
                                                        {!! Form::select('pengirim_negara', $countryid, '', ['class' => 'form-select','data-control' => 'select2', 'placeholder' => 'Negara','id'=>'pengirim_negara']) !!}
                                                    </div>
                                                </div>
                                                <div class="card p-1 d-none" style="margin-top: 10px" id="pengirim_barang_info">
                                                    <table  class=" table align-middle  table-row-dashed table-row-gray-400 fs-8 dataTable no-footer text-gray-600" role="grid" aria-describedby="table_info">
                                                        <tbody >
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Tipe Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='tipe_identitas_pengirim_barang'>Pilih Pengirim Barang</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Nomor Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='nomor_identitas_pengirim_barang'>Pilih Pengirim</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Negara : &nbsp;</div><div class=" " readonly ='readonly'  id ='negara_pengirim_barang'>Pilih Pengirim Barang</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Alamat : &nbsp;</div><div class=" " readonly ='readonly'  id ='alamat_pengirim_barang'>Pilih Pengirim Barang</div>
                                                                </td>
                                                            </tr> 
                                                        </tbody>
                                                    </table> 
                                                </div>
                                        </div> 
                                             
                                        <div class="col-md-4 bg-transparent border-dashed border-1  rounded p-3" style="margin-bottom:10px;">
                                            <h2 class="fw-bolder mt-4"> 
                                                <label class="form-label ">
                                                    <b>Penjual Barang</b>
                                                    <a href="javascript:void(0);" id="btn-salin-pengirim-penjual" class="btn btn-sm btn-light-primary" style="top:10px;">Salin Pengirim</a>
                                                </label>
                                            </h2> 
                                            {!! Form::select('penjual_barang_id', $penjualBarangSelectBox, $user_customer ?? '', ['class' => 'form-select',  'data-control' => 'select2', 'placeholder' => '-- Input --', 'id'=>'penjual_barang_id']) !!}
                                            @if($errors->has('penjual_barang_id'))
                                                <span class="error text-danger">{{ $errors->first('penjual_barang_id') }}</span>
                                            @endif
                                            <br>
                                            <br>
                                            <div class="form-group row" id="penjual_barang_input" name="penjual_barang_input"> 
                                                <div class="col-md-12"> 
                                                    {!! Form::text('penjual_nama',null, ['class' => 'form-control', 'placeholder' => 'Nama Penjual','id' => 'penjual_nama','oninput' => 'this.value = this.value.toUpperCase()', 'maxlength' => '100']) !!}
                                                </div>
                                                <div class="col-md-12"> 
                                                    {!! Form::textarea('penjual_alamat', null, ['class' => 'form-control', 'placeholder' => 'Alamat','id' => 'penjual_alamat', 'style' => 'height: 10px;','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                                </div>
                                                <div class="col-md-12"> 
                                                    {!! Form::select('penjual_negara', $countryid, '', ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => 'Pilih','id'=>'penjual_negara']) !!}
                                                </div>
                                            </div>
                                            <div class="card p-1" style="margin-top: 10px; display:none;" id="penjual_barang_info" name="penjual_barang_info">
                                                <table  class=" table align-middle  table-row-dashed table-row-gray-400 fs-8 dataTable no-footer text-gray-600" role="grid" aria-describedby="table_info">
                                                    <tbody >
                                                        <tr>
                                                            <td class="d-flex p-1">
                                                                <div>Tipe Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='tipe_identitas_penjual_barang'>Pilih Penjual Barang</div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="d-flex p-1">
                                                                <div>Nomor Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='nomor_identitas_penjual_barang'>Pilih Penjual</div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="d-flex p-1">
                                                                <div>Negara : &nbsp;</div><div class=" " readonly ='readonly'  id ='negara_penjual_barang'>Pilih Penjual Barang</div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="d-flex p-1">
                                                                <div>Alamat : &nbsp;</div><div class=" " readonly ='readonly'  id ='alamat_penjual_barang'>Pilih Penjual Barang</div>
                                                            </td>
                                                        </tr>  
                                                    </tbody>
                                                </table> 
                                            </div>
                                        </div>

                                        <div class="col-md-4 bg-transparent border-dashed border-1  rounded p-3" style="margin-bottom:10px;">
                                            <h2 class="fw-bolder mt-4">  <label class="form-label "><b>PPJK - {{$user_customer}}</b></label></h2> 
                                                {!! Form::select('ppjk_id', $ppjkSelectBox, $user_customer ?? '', ['class' => 'form-select',  'data-control' => 'select2', 'placeholder' => '-- Input --', 'id'=>'ppjk_id']) !!}
                                                @if($errors->has('ppjk_id'))
                                                    <span class="error text-danger">{{ $errors->first('ppjk_id') }}</span>
                                                @endif
                                                <div class="card p-1 d-none" style="margin-top: 10px" id="ppjk_info">
                                                    <table  class=" table align-middle  table-row-dashed table-row-gray-400 fs-8 dataTable no-footer text-gray-600" role="grid" aria-describedby="table_info">
                                                        <tbody >
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Tipe Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='ppjk_tipe_identitas'>Pilih PPJK</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Nomor Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='ppjk_nomor_identitas'>Pilih PPJK</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Alamat : &nbsp;</div><div class=" " readonly ='readonly'  id ='ppjk_alamat'>Pilih PPJK</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Nomor PPJK : &nbsp;</div><div class=" " readonly ='readonly'  id ='ppjk_no'>Pilih PPJK</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Tanggal PPJK: &nbsp;</div><div class=" " readonly ='readonly'  id ='ppjk_tanggal'>Pilih PPJK</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex p-1">
                                                                    <div>Negara : &nbsp;</div><div class=" " readonly ='readonly'  id ='ppjk_negara'>Pilih PPJK</div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div> 
                                        </div>
                                    </div> 
                            </div>
                            <div class="tab-pane fade" id="nav-dokumen" role="tabpanel" aria-labelledby="nav-dokumen-tab">
                                <div class="d-flex d-none" id='opsi-lartas'> 
                                    <p class="dok-status-lartas" readonly='readonly' id='dok-status_lartas'></p>
                                </div>
                                <div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey;">
                                    @include('air.components.add.documents')
                                </div>           
                            </div>
                            <div class="tab-pane fade" id="nav-pengangkut" role="tabpanel" aria-labelledby="nav-pengangkut-tab">
                                <div  class="form-group row">
                                    <div class="form-group row" style="margin-top:10px;margin-left: 0px">
                                        <div class="col">
                                            <div class=" bg-transparent border-dashed border-1 p-3 row rounded" style="border-color:lightgrey ">
                                                <div class="container-fluid d-flex flex-stack"> 
                                                    <h2 class="fw-bolder mt-4">BC 1.1</h2>
                                                    <div class="text-center">
                                                        <a href="javascript:void(0);" id="btn-tarik-bc-satu-satu" class="btn btn-sm btn-light-danger text-right">
                                                            <i class="la la-retweet"></i>
                                                            Tarik BC11
                                                        </a>
                                                    </div>
                                                </div>
                                                <br> <p>Bisa tarik setelah input dokumen B/L, pastikan no hawb dan tanggal benar.</p>
                                                <br>
                                                <div class="col-md-4">
                                                    <label class="form-label">Nomor Tutup PU</label>
                                                    {!! Form::select('details[nomor_tutup_pu]', $TutupPu, null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --']) !!}
                                                    @if($errors->has('details[nomor_tutup_pu]'))
                                                        <span class="error text-danger">{{ $errors->first('details[nomor_tutup_pu]') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-4">
                                                        <label class="form-label">No Dokumen</label>
                                                        {!! Form::text('no_dokumen_bc',null, ['class' => 'form-control', 'id' => 'no_dokumen_bc', 'placeholder' => 'Input No Dokumen','oninput' => 'this.value = this.value.toUpperCase()', 'maxlength' => '6']) !!}
                                                        @if($errors->has('no_dokumen_bc'))
                                                            <span class="error text-danger">{{ $errors->first('no_dokumen_bc') }}</span>
                                                        @endif
                                                </div>
                                                <div class="col-md-4" style="display:none;">
                                                    <label class="form-label">Dokumen</label>
                                                    {!! Form::file('dokumen_bc', ['class' => 'form-control', 'placeholder' => 'File']) !!}
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Tanggal</label>
                                                    {!! Form::text('tanggal_bc', null, ['class' => 'form-control datepicker', 'id' => 'tanggal_bc', 'placeholder' => 'Pilih Tanggal']) !!}
                                                    @if($errors->has('tanggal_bc'))
                                                        <span class="error text-danger">{{ $errors->first('tanggal_bc') }}</span>
                                                    @endif
                                                </div> 
                                                <div class="col-md-4" style="margin-top:10px;">
                                                    <label class="form-label">No Pos Dokumen</label>
                                                    {!! Form::text('no_pos_dokumen_bc',null, ['class' => 'form-control', 'id' => 'no_pos_dokumen_bc','oninput' => 'this.value = this.value.toUpperCase()', 'maxlength' => '4']) !!}
                                                    @if($errors->has('no_pos_dokumen_bc'))
                                                        <span class="error text-danger">{{ $errors->first('no_pos_dokumen_bc') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-4" style="margin-top:10px;" >
                                                    <label class="form-label">Nomor Subpos Dokumen</label>
                                                    {!! Form::text('no_sub_pos_dokumen_bc',null, ['class' => 'form-control', 'id' => 'no_sub_pos_dokumen_bc','oninput' => 'this.value = this.value.toUpperCase()', 'maxlength' => '4']) !!}
                                                    @if($errors->has('no_sub_pos_dokumen_bc'))
                                                        <span class="error text-danger">{{ $errors->first('no_sub_pos_dokumen_bc') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-4" style="margin-top:10px;">
                                                    <label class="form-label">Nomor Subsubpos Dokumen</label>
                                                    {!! Form::text('no_sub_sub_pos_dokumen_bc',null, ['class' => 'form-control', 'id' => 'no_sub_sub_pos_dokumen_bc','oninput' => 'this.value = this.value.toUpperCase()', 'maxlength' => '4']) !!}
                                                    @if($errors->has('no_sub_sub_pos_dokumen_bc'))
                                                        <span class="error text-danger">{{ $errors->first('no_sub_sub_pos_dokumen_bc') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div> 
                                <div name="div_intangible_status" id="div_intangible_status"> 
                                    @include('air.pib.add.partials.transport') 
                                </div>  
                            </div>
                            <div class="tab-pane fade" id="nav-petikemas" role="tabpanel" aria-labelledby="nav-petikemas-tab">
                                <div name="div_intangible_statuspk" id="div_intangible_statuspk">                                             
                                    <div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                                        @include('air.components.add.kemasan')
                                    </div>
                                    <div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                                        @include('air.components.add.peti_kemas')
                                    </div>
                                </div> 
                            </div>
                            <div class="tab-pane fade" id="nav-transaksi" role="tabpanel" aria-labelledby="nav-transaksi-tab">
                                <div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                                    <h2 class="fw-bolder mt-6">Transaksi</h2>
                                    <div class="form-group row">
                                        <div class="col-md-4 bg-transparent border-dashed border-1  rounded p-3" style="margin-bottom:10px;">
                                            <h2 class="fw-bolder mt-4"> <label class="form-label "><b>Harga</b></label></h2>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label class="form-label required">Valuta</label>
                                                    {!! Form::select('valas_id', $valas, null, ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'id' => 'valas_id',  'data-control' => 'select2']) !!}
                                                    @if($errors->has('valas_id'))
                                                        <span class="error text-danger">{{ $errors->first('valas_id') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label">NDPBM</label>
                                                    <div class="spinner-border spinner-border-sm text-primary me-3 d-none" role="status" id="loading-spinner">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                    {!! Form::number('details[ndpbm]', 0, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input', 'id' => 'ndpbm', 'step' => '0.01']) !!}
                                                    @if($errors->has('details[ndpbm]'))
                                                        <span class="error text-danger">{{ $errors->first('details[ndpbm]') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label">Jenis Transaksi</label>
                                                    {!! Form::select('details[jenis_transaksi_id]', $TradeTransactionTypes, null, ['class' => 'form-select', 'placeholder' => '-- Select --', 'id' => 'jenis_transaksi_id',  'data-control' => 'select2']) !!}
                                                    @if($errors->has('details[jenis_transaksi_id]'))
                                                        <span class="error text-danger">{{ $errors->first('details[jenis_transaksi_id]') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label required">Incoterm</label>
                                                    {!! Form::select('details[hincoterm_id]', $masterIncoterms, null, ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --' , 'id' => 'hincoterm_id']) !!}                                                    
                                                    @if($errors->has('hincoterm_id'))
                                                        <span class="error text-danger">{{ $errors->first('hincoterm_id') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-12 flex-container">
                                                    <label class="form-label">Harga Barang</label>
                                                    <label id="lblfob" class="text-muted-right"></label>
                                                </div>
                                                <div class="col-md-12"> 
                                                    {!! Form::text('details[fob]', 0, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input', 'id' => 'fob', 'maxlength' => '18', 'min' => '0', 'oninput' => "this.value = this.value.replace(/[^0-9.]/g, ''); if(this.value < 0){this.value='0'}"]) !!}
                                                    @if($errors->has('details[fob]'))
                                                        <span class="error text-danger">{{ $errors->first('details[fob]') }}</span>
                                                    @endif
                                                </div> 
                                                <div class="col-md-12 flex-container">
                                                    <label class="form-label">Nilai Pabean</label>
                                                    <label id="lblcifrp" class="text-muted-right"></label>
                                                </div>
                                                <div class="col-md-12"> 
                                                    {!! Form::number('details[cif_rp]', 0, ['class' => 'form-control bg-secondary', 'step' => 'any' ,'readonly' => 'readonly','required' => true, 'placeholder' => 'Input', 'id' => 'cif_rp']) !!}
                                                    @if($errors->has('details[cif_rp]'))
                                                        <span class="error text-danger">{{ $errors->first('details[cif_rp]') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 bg-transparent border-dashed border-1  rounded p-3" style="margin-bottom:10px;">
                                            <h2 class="fw-bolder mt-4"> <label class="form-label "><b>Harga Lainnya</b></label></h2>
                                            <div class="form-group row">
                                                <div class="col-md-12 flex-container">
                                                    <label class="form-label">Biaya Penambah</label>
                                                    <label id="lblbiaya_penambah" class="text-muted-right"></label>
                                                </div>
                                                <div class="col-md-12"> 
                                                    {!! Form::number('details[biaya_penambah]', 0, ['class' => 'form-control', 'step' => 'any', 'placeholder' => 'Input', 'id' => 'biaya_penambah']) !!}
                                                    @if($errors->has('details[biaya_penambah]'))
                                                        <span class="error text-danger">{{ $errors->first('details[biaya_penambah]') }}</span>
                                                    @endif
                                                </div> 
                                                <div class="col-md-12 flex-container">
                                                    <label class="form-label">Biaya Pengurang</label>
                                                    <label id="lblbiaya_pengurang" class="text-muted-right"></label>
                                                </div>
                                                <div class="col-md-12"> 
                                                    {!! Form::number('details[biaya_pengurang]', 0, ['class' => 'form-control', 'step' => 'any','placeholder' => 'Input', 'id' => 'biaya_pengurang']) !!}
                                                    @if($errors->has('details[biaya_pengurang]'))
                                                        <span class="error text-danger">{{ $errors->first('details[biaya_pengurang]') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-12 flex-container">
                                                    <label class="form-label">Biaya Freight</label>
                                                    <label id="lblbiaya_freight" class="text-muted-right"></label>
                                                </div>
                                                <div class="col-md-12"> 
                                                    {!! Form::number('details[freight]', 0, ['class' => 'form-control', 'placeholder' => 'Input', 'id' => 'freight',  'maxlength' => '18', 'min' => '0','step' => 'any' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                                    if(this.value<0){this.value='0'}" ]) !!}
                                                    @if($errors->has('details[freight]'))
                                                        <span class="error text-danger">{{ $errors->first('details[freight]') }}</span>
                                                    @endif
                                                </div>
                                         
                                                <div class="col-md-12">
                                                    <label class="form-label">Asuransi</label>
                                                    <select  class="form-control" name="details[type_asuransi]" id="type_asuransi" data-control="select2">
                                                        <option value="" disabled selected>--Select--</option>
                                                        <option value="0">DALAM NEGERI</option>
                                                        <option value="1">LUAR NEGERI</option>
                                                    </select>
                                                    @if($errors->has('details[type_asuransi]'))
                                                        <span class="error text-danger">{{ $errors->first('details[type_asuransi]') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-12 flex-container">
                                                    <label class="form-label">Biaya Asuransi</label>
                                                    <label id="lblbiaya_asuransi" class="text-muted-right"></label>
                                                </div>
                                                <div class="col-md-12"> 
                                                    {!! Form::number('details[asuransi]', 0, ['class' => 'form-control', 'placeholder' => 'Input', 'id' => 'asuransi',  'maxlength' => '18', 'min' => '0', 'step' => 'any' ,  'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                                    if(this.value<0){this.value='0'}" ]) !!}
                                                    @if($errors->has('details[asuransi]'))
                                                        <span class="error text-danger">{{ $errors->first('details[asuransi]') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-12 flex-container">
                                                    <label class="form-label">Voluntary Declaration</label>
                                                    <label id="lblbiaya_voluntari" class="text-muted-right"></label>
                                                </div>
                                                <div class="col-md-12">                                                    
                                                    {!! Form::number('details[voluntary_declaration]', 0, ['class' => 'form-control', 'step' => 'any' , 'placeholder' => 'Input', 'id' => 'voluntary_declaration']) !!}
                                                    @if($errors->has('details[voluntary_declaration]'))
                                                        <span class="error text-danger">{{ $errors->first('details[voluntary_declaration]') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 bg-transparent border-dashed border-1 rounded p-3" style="margin-bottom:10px;" name="div_intangible_status_weight" id="div_intangible_status_weight">
                                            <h2 class="fw-bolder mt-4"> <label class="form-label "><b>Berat Kotor (KGM)</b></label></h2>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label class="form-label">Bruto</label>
                                                    {!! Form::number('details[berat_kotor]', 0, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input', 'id' => 'berat_kotor', 'step' => 'any' , 'maxlength' => '18', 'min' => '0', 'onblur' => "formatToFourDecimals(this)" ]) !!}
                                                    @if($errors->has('details[berat_kotor]'))
                                                        <span class="error text-danger">{{ $errors->first('details[berat_kotor]') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label">Berat Bersih (KGM)</label>
                                                    {!! Form::number('details[berat_bersih]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'berat_bersih' , 'step' => 'any' ,  'maxlength' => '18', 'min' => '0', 'readonly', 'onblur' => "formatToFourDecimals(this)" ]) !!}
                                                    @if($errors->has('details[berat_bersih]'))
                                                        <span class="error text-danger">{{ $errors->first('details[berat_bersih]') }}</span>
                                                    @endif
                                                </div> 
                                            </div>       
                                        </div>
 
                                        <div class="form-group row" style="margin-top:10px;">  
                                            {{-- <div class="col-md-4">
                                                <label class="form-label">Harga Detail</label>
                                                {!! Form::number('details[harga_detil]', null, ['class' => 'form-control','readonly' => 'readonly', 'required' => true, 'placeholder' => 'Input', 'id' => 'harga_detil',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                                if(this.value<0){this.value='0'}" ]) !!}
                                                @if($errors->has('details[harga_detil]'))
                                                    <span class="error text-danger">{{ $errors->first('details[harga_detil]') }}</span>
                                                @endif
                                            </div> --}}
                                        </div>  
                                    </div> 
                                </div>  
                            </div>
                            <div class="tab-pane fade" id="nav-barang" role="tabpanel" aria-labelledby="nav-barang-tab">
                                <div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey;">
                                    <div class="form-group row" >
                                        <div class="col-md-12">
                                            <h2 class="fw-bolder mt-4">Barang</h2>
                                            @if($errors->has('list_barang'))
                                                <span class="error text-danger">{{ $errors->first('list_barang') }}</span>
                                            @endif
                                            <div class="form-group row">
                                                <div class="form-group mt-5">
                                                    <a href="javascript:void(0);" id="btn-tambah-barang" data-bs-toggle="modal" data-bs-target="#add-modal" class="btn btn-light-primary">
                                                        <i class="la la-plus"></i>Add
                                                    </a>
                                                    <a href="{{ asset('/') }}template/pib-template-barang.xlsx" id="btn-download-template-barang" class="btn btn-light-success">
                                                        <i class="la la-upload"></i>Download Template
                                                    </a> 
                                                    <a href="javascript:void(0);" id="btn-upload-barang" data-bs-toggle="modal" data-bs-target="#upload-modal" class="btn btn-light-danger">
                                                        <i class="la la-upload"></i>Mass Upload
                                                    </a>  
                                                </div>
                                            </div>
                                        
                                            @include('air.components.add.goods_table')
                                                {!! Form::hidden('list_barang', null, ['id' => 'list_barang']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="tab-pane fade" id="nav-pungutan" role="tabpanel" aria-labelledby="nav-pungutan-tab">      
                                @include('air.pib.add.partials.pungutan')
                            </div>
                            <div class="tab-pane fade" id="nav-pernyataan" role="tabpanel" aria-labelledby="nav-pernyataan-tab">  
                                <div class=" bg-light-primary border-dashed border-1  rounded p-3" style="border-color:lightgrey;">
                                        <p>
                                            Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal yang diberitahukan dalam
                                            pemberitahuan pabean ini
                                        </p> 
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label class="form-label required">Kota</label>
                                            {!! Form::select('city_id', $citySelectBox, $user_kota ?? '', ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                                            @if($errors->has('city_id'))
                                                <span class="error text-danger">{{ $errors->first('city_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label required">Tanggal</label>
                                            {!! Form::text('details[pabean_tanggal]', $tanggalHariIni, ['class' => 'form-control datepicker', 'required' => true, 'placeholder' => 'input Tanggal']) !!}
                                            @if($errors->has('details[pabean_tanggal]'))
                                                <span class="error text-danger">{{ $errors->first('details[pabean_tanggal]') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label required">Pemberitahu</label>
                                            {!! Form::text('details[pabean_pemberitahu]',  $user->warehouse->notifier ?? '', ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input Pemberi Tahu','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                            @if($errors->has('details[pabean_pemberitahu]'))
                                                <span class="error text-danger">{{ $errors->first('details[pabean_pemberitahu]') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label required">Jabatan</label>
                                            {!! Form::text('details[pabean_jabatan]', $user->warehouse->position ?? '', ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input Jabatan','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                            @if($errors->has('details[pabean_jabatan]'))
                                                <span class="error text-danger">{{ $errors->first('details[pabean_jabatan]') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>   
                        </div>  
                        {!! Form::close() !!}
                        @include('air.components.add.add_modal', ['bc' => 'BC20'])
                        @include('air.components.popup.upload_modal', ['bc' => '20','id_inbound' => '', 'type' => 'add'])
                    </div>
                    {{-- {!! Form::close() !!} --}}
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
        var selectedGoods = [];
        var selectedGood = {};
        const refreshGoodsInfo = () => {
            $('#list_barang').val(JSON.stringify(selectedGoods));
            let noSeri = 1;
            let totalVolume = 0;
            let totalBeratBersih = 0;
            let totalBeratKotor  = 0;
            let totalFob         = 0;
            let totalAsuransi    = 0;
            let totalNilaiCif    = 0;
            let totalFreight     = 0;
            let totalHargaBarang = 0;
            let totalBiayaPenambahDiskon = 0; 
            let totalHargaSatuan = 0; 
            

            // News
            let totalBiayaPenambah = 0;
            let totalBiayaPengurang = 0;
            let totalCifRP = 0;

            let bmDibayarkan = 0;
            let bmDitangguhkan = 0;
            let bmDibebaskan = 0;
            let bmTidakDipungut = 0;

            let bmtDibayarkan = 0;
            let bmtDitangguhkan = 0;
            let bmtDibebaskan = 0;
            let bmtTidakDipungut = 0;
            
            let pphDibayarkan = 0;
            let pphDitangguhkan = 0;
            let pphDibebaskan = 0;
            let pphTidakDipungut = 0;

            let ppnDibayarkan = 0;
            let ppnDitangguhkan = 0;
            let ppnDibebaskan = 0;
            let ppnTidakDipungut = 0;

            let ppnbmDibayarkan = 0;
            let ppnbmDitangguhkan = 0;
            let ppnbmDibebaskan = 0;
            let ppnbmTidakDipungut = 0;

            function formatCurrency(value) { 
                value = parseFloat(value).toFixed(2);
 
                let parts = value.toString().split(".");
 
                parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
 
                return parts.join(",");
            }

            selectedGoods.forEach((item) => {
                // totalBeratKotor += parseFloat(item.nett_weight);
                ///totalNilaiCif += parseFloat(item.details.nilai_cif);
                item['no_seri'] = noSeri++;

                totalVolume               += parseFloat(item.volume);
                totalBeratBersih          += parseFloat(item.nett_weight);
                totalHargaBarang          += parseFloat(item.details.harga_barang); 
                totalBiayaPenambahDiskon  += parseFloat(item.details.biaya_penambah_diskon); 
                totalFob                  += parseFloat(item.details.fob); //Harga Barang Total
                totalHargaSatuan          += parseFloat(item.details.harga_satuan); 
                totalFreight              += parseFloat(item.details.freight);
                totalAsuransi             += parseFloat(item.details.asuransi);
                totalCifRP                += parseFloat(item.details.cif_rp); //Nilai Pabean HARUS RP

                let bm = 0;
                let bmRaw = 0;
                if (item.details.bm_type == "1") { //Advolorum
                    bmRaw   += parseFloat(item.details.cif_rp) * parseFloat(item.details.bm) / 100
                    bm      = parseFloat(item.details.cif_rp) * parseFloat(item.details.bm) / 100 * (parseFloat(item.details.bm_tax_value) / 100);
                } else {
                    bmRaw   += parseFloat(item.details.bm) * parseFloat(item.quantity)
                    bm      = parseFloat(item.details.bm) * parseFloat(item.quantity) * (parseFloat(item.details.bm_tax_value) / 100);
                }

                if (item.details.bm_tax_type == "1") { //Dibayarkan
                    bmDibayarkan += bm
                } else if (item.details.bm_tax_type == "3") { //Ditangguhkan
                    bmDitangguhkan += bm    
                } else if (item.details.bm_tax_type == "5") { //Dibebaskan
                    bmDibebaskan += bm
                } else if (item.details.bm_tax_type == "6") { //Tidak Dipungut
                    bmTidakDipungut += bm
                }

                let bmt = 0;
                let bmtRaw = 0;
                if (item.details.bmt_type == "1") { //Advolorum
                    bmtRaw += parseFloat(item.details.cif_rp) * parseFloat(item.details.bmt) / 100
                    bmt = parseFloat(item.details.cif_rp) * parseFloat(item.details.bmt) / 100 * (parseFloat(item.details.bmt_tax_value) / 100);
                } else {
                    bmtRaw += parseFloat(item.details.bmt) * parseFloat(item.quantity)
                    bmt = parseFloat(item.details.bmt) * parseFloat(item.quantity) * (parseFloat(item.details.bmt_tax_value) / 100);
                }

                if (item.details.bmt_tax_type == "1") { //Dibayarkan
                    bmtDibayarkan += bmt
                } else if (item.details.bmt_tax_type == "3") { //Ditangguhkan
                    bmtDitangguhkan += bmt      
                } else if (item.details.bmt_tax_type == "5") { //Dibebaskan
                    bmtDibebaskan += bmt
                } else if (item.details.bmt_tax_type == "6") { //Tidak Dipungut
                    bmtTidakDipungut += bmt
                }

                const pph = (parseFloat(item.details.cif_rp) + bmRaw) * parseFloat(item.details.pph) / 100 * (parseFloat(item.details.pph_tax_value) / 100);
                // const pph = (parseFloat(item.details.cif_rp) + bm) * parseFloat(item.details.pph) / 100 * (parseFloat(item.details.pph_tax_value) / 100);
                console.log(parseFloat(item.details.pph));

                if (item.details.pph_tax_type == "1") { //Dibayarkan
                    pphDibayarkan += pph;
                } else if (item.details.pph_tax_type == "3") { //Ditangguhkan
                    pphDitangguhkan += pph;    
                } else if (item.details.pph_tax_type == "5") { //Dibebaskan
                    pphDibebaskan += pph;
                } else if (item.details.pph_tax_type == "6") { //Tidak Dipungut
                    pphTidakDipungut += pph;
                }

                const ppn = (parseFloat(item.details.cif_rp) + bmRaw) * parseFloat(item.details.ppn) / 100 * (parseFloat(item.details.ppn_tax_value) / 100);
                
                // const ppn = ((parseFloat(item.details.cif_rp) + bm) * parseFloat(item.details.ppn) / 100 ) * (parseFloat(item.details.ppn_tax_value) / 100);

                if (item.details.ppn_tax_type == "1") { //Dibayarkan
                    ppnDibayarkan += ppn;
                } else if (item.details.ppn_tax_type == "3") { //Ditangguhkan
                    ppnDitangguhkan += ppn;
                } else if (item.details.ppn_tax_type == "5") { //Dibebaskan
                    ppnDibebaskan += ppn;                    
                } else if (item.details.ppn_tax_type == "6") { //Tidak Dipungut
                    ppnTidakDipungut += ppn;
                }

                const ppnbm = (parseFloat(item.details.cif_rp) + bmRaw) * parseFloat(item.details.ppnbm) / 100 * (parseFloat(item.details.ppnbm_tax_value) / 100);
                if (item.details.ppnbm_tax_type == "1") { //Dibayarkan
                    ppnbmDibayarkan += ppnbm;
                } else if (item.details.ppnbm_tax_type == "3") { //Ditangguhkan
                    ppnbmDitangguhkan += ppnbm;    
                } else if (item.details.ppnbm_tax_type == "5") { //Dibebaskan
                    ppnbmDibebaskan += ppnbm;
                } else if (item.details.ppnbm_tax_type == "6") { //Tidak Dipungut
                    ppnbmTidakDipungut += ppnbm;
                }
            });
            $('#total_volume').val(totalVolume)
            $('#berat_bersih').val(totalBeratBersih)
            // $('#berat_kotor').val(totalBeratKotor)
            //$('#nilai_cif').val(totalNilaiCif)
       

            $('#bm_dibayarkan').val(bmDibayarkan)
            $('#bm_ditangguhkan').val(bmDitangguhkan)
            $('#bm_dibebaskan').val(bmDibebaskan)
            $('#bm_tidak_dipungut').val(bmTidakDipungut)

            $('#bmt_dibayarkan').val(bmtDibayarkan)
            $('#bmt_ditangguhkan').val(bmtDitangguhkan)
            $('#bmt_dibebaskan').val(bmtDibebaskan)
            $('#bmt_tidak_dipungut').val(bmtTidakDipungut)

            $('#pph_dibayarkan').val(pphDibayarkan)
            $('#pph_ditangguhkan').val(pphDitangguhkan)
            $('#pph_dibebaskan').val(pphDibebaskan)
            $('#pph_tidak_dipungut').val(pphTidakDipungut)

            $('#ppn_dibayarkan').val(ppnDibayarkan)
            $('#ppn_ditangguhkan').val(ppnDitangguhkan)
            $('#ppn_dibebaskan').val(ppnDibebaskan)
            $('#ppn_tidak_dipungut').val(ppnTidakDipungut)

            $('#ppnbm_dibayarkan').val(ppnbmDibayarkan)
            $('#ppnbm_ditangguhkan').val(ppnbmDitangguhkan)
            $('#ppnbm_dibebaskan').val(ppnbmDibebaskan)
            $('#ppnbm_tidak_dipungut').val(ppnbmTidakDipungut)

            const totalDibayarkan = bmDibayarkan + bmtDibayarkan + pphDibayarkan + ppnDibayarkan + ppnbmDibayarkan;
            const totalDitangguhkan = bmDitangguhkan + bmtDitangguhkan + pphDitangguhkan + ppnDitangguhkan + ppnbmDitangguhkan;
            const totalDibebaskan = bmDibebaskan + bmtDibebaskan + pphDibebaskan + ppnDibebaskan + ppnbmDibebaskan;
            const totalTidakDipungut = bmTidakDipungut + bmtTidakDipungut + pphTidakDipungut + ppnTidakDipungut + ppnbmTidakDipungut;

            $('#total_dibayarkan').val(totalDibayarkan)
            $('#total_ditangguhkan').val(totalDitangguhkan)
            $('#total_dibebaskan').val(totalDibebaskan)
            $('#total_tidak_dipungut').val(totalTidakDipungut)

            $('#table').DataTable().clear().rows.add(selectedGoods).draw()
        } 
      
        $(document).ready(function() {

                $(".datepicker").flatpickr({
                    dateFormat: 'd-m-Y',  
                    defaultDate: '{{ date('d-m-Y') }}' 
                });

                let ndpbm           = 0;
                let fob             = 0;
                let biaya_penambah  = 0;
                let biaya_pengurang = 0;
                let freight         = 0;
                let nilai_asuransi         = 0;
                let voluntary_declaration   = 0;

                let discount         = 0;
                let diskon         = 0;
                let detailCifRP         = 0;
                let totalCifRP         = 0;

                let harga_total_barang_by_kurs = 0;

                ndpbm                   = $('#ndpbm');
                fob                     = $('#fob');
                biaya_penambah          = $('#biaya_penambah');
                biaya_pengurang         = $('#biaya_pengurang');
                freight                 = $('#freight');
                nilai_asuransi          = $('#asuransi');
                voluntary_declaration   = $('#voluntary_declaration');
    

                function countHargaTranskasi(){
  
                    harga_total_barang_by_kurs  = (Number(fob.val()) + Number(freight.val()) + Number(biaya_penambah.val()) + Number(nilai_asuransi.val()) + Number(voluntary_declaration.val())) - Number(biaya_pengurang.val());
                    totalCifRP                  = (harga_total_barang_by_kurs * Number(ndpbm.val())).toFixed(4);

                    $('#cif_rp').val(totalCifRP);  
                    document.getElementById('lblcifrp').innerText = formatNumber(totalCifRP);
                    //detailCifRP.val(totalCifRP); 

                }


                $('#kppbc_pengawas_id').on('change', function(){
                    $.ajax({
                        method  : 'GET',
                        url     : `{{url('/')}}/master-data/tps/ajax/${$(this).val()}`,
                        success : function(result){
                            $('#master_tps_id').html("")
                            const resultData = [{id: "", text: "-- Select --"}].concat(result.data)
                            $('#master_tps_id').select2({data: resultData})
                        },
                        error   : function(err){
                            console.log(err);
                        }
                    })

                });
                ndpbm.on('keyup', function(){
                    countHargaTranskasi();
                });

                fob.on('keyup', function(){
                    countHargaTranskasi();
                });

                biaya_penambah.on('keyup', function(){
                    countHargaTranskasi();
                });

                biaya_pengurang.on('keyup', function(){
                    countHargaTranskasi();
                });

                freight.on('keyup', function(){
                    countHargaTranskasi();
                });

                nilai_asuransi.on('keyup', function(){
                    countHargaTranskasi();
                });

                voluntary_declaration.on('keyup', function(){
                    countHargaTranskasi();
                });

                $('#submit-button').click(function(event) {
                    let form = $('#create-form')[0];
 
                    if (form.checkValidity() === false) { 
                        event.preventDefault();
                        event.stopPropagation();
 
                        let invalidElement = $(form).find(':invalid').first();
                        let invalidTabPane = invalidElement.closest('.tab-pane');
 
                        if (invalidTabPane.length) {
                            let tabId = invalidTabPane.attr('id');
                            $('a[data-toggle="tab"]').removeClass('active');
                            $('a[href="#' + tabId + '"]').tab('show');
                        } 
                        form.reportValidity();
                    } else {
                        
                        $('#create-form').submit();
                    }
                });
            
            $('#destination_port_id, #loading_port_id, #transit_port_id, #unloading_port_id').select2({
                ajax : {
                    url : "{{url('/')}}/master-data/port/search",
                    dataType : "json",
                    data : function(params){
                        var query = {
                            search : params.term
                        }

                        return query;   
                    },
                    processResults : function(data){
                        return {
                            results : data
                        }
                    }
                },
                cache : true,
                placeholder : "Search for port",
                minimumInputLength : 2

            });

            $('#nav-tab a[href="#nav-header"]').tab('show')  
            $('#nav-tab a').on('click', function (e) {
                e.preventDefault()
                $(this).tab('show')
            })
            $('#intangible_status').change(function () {
                if ($('#intangible_status').val() == '0') {
                    $('#div_intangible_status').show();
                    $('#div_intangible_statuspk').show();
                    $('#div_intangible_status_weight').show();
                    $('#nav-pengangkut-tab').show();
                    $('#nav-petikemas-tab').show();
                    /*dimatikansementara
                    $('#country_id').attr('required', 'required');
                    $('#master_tps_id').attr('required', 'required');
                    $('#transportation_id').attr('required', 'required');
                    $('#vehicle_number').attr('required', 'required');
                    */
                }
                else {
                    $('#div_intangible_status').hide();
                    $('#div_intangible_statuspk').hide();
                    $('#div_intangible_status_weight').hide();
                    $('#nav-pengangkut-tab').hide();
                    $('#nav-petikemas-tab').hide();
                    $('#country_id').removeAttr('required');
                    $('#master_tps_id').removeAttr('required');
                    $('#transportation_id').removeAttr('required');
                    $('#vehicle_number').removeAttr('required');
                }
            });
 
           $('#btn-salin-importir-pemilik').on('click', function() {
                // Mengecek apakah importir_id memiliki nilai yang dipilih dari select box
                // var importirSelected = $('#importir_id').val();var importirIdIsSelected = $('#importir_id').find(":selected").val() !== "";
                var importirSelected = $('#importir_id').val();
                
                if (importirSelected) { 
                    // Scenario ketika data diambil dari database 
                    $('#pemilik_barang_input').addClass('d-none');
                    $('#pemilik_barang_input').hide();
                    $('#pemilik_barang_info').removeClass('d-none');
                    $('#pemilik_barang_info').show(); 
                    $('#pemilik_barang_info').show(); 
                    // Menyalin data dari elemen 'importir_info'
                    $('#pemilik_barang_id').val($('#importir_id').val()).change();
                    $('#tipe_identitas_pemilik_barang').text($('#importir_tipe_identitas').text());
                    $('#nama_pemilik_barang').text($('#importir_nama').text());
                    $('#nomor_identitas_pemilik_barang').text($('#importir_nomor_identitas').text());
                    $('#alamat_pemilik_barang').text($('#importir_alamatv').text());
                    $('#negara_pemilik_barang').text($('#importir_country').text());
                    

                } else {
                    $('#pemilik_barang_info2').hide(); 
                    $('#pemilik_barang_id').val($('#importir_id').val()).change();
                    // Scenario ketika input form 'importir' diisi secara manual
                    $('#pemilik_barang_input').removeClass('d-none');
                    $('#pemilik_barang_input').show();
                    $('#pemilik_barang_info').addClass('d-none');
                    $('#pemilik_barang_info').hide();

                    // Menyalin data dari input form 'importir'
                    $('#pemilik_indentitas_type').val($('#importir_indentitas_type').val()).trigger('change'); // Pastikan Select2 di-update
                    $('#pemilik_nama').val($('#importir_nama').val()); 
                    $('#pemilik_indentitas_nomor').val($('#importir_indentitas_nomor').val());
                    $('#pemilik_alamat').val($('#importir_alamat').val());
                }
            });

            $('#btn-salin-importir-pemusatan').on('click', function() { 
                var importirSelected = $('#importir_id').val();
                
                if (importirSelected) { 
                    // Scenario ketika data diambil dari database 
                    $('#pemusatan_input').addClass('d-none');
                    $('#pemusatan_input').hide();
                    $('#pemusatan_info').removeClass('d-none'); 
                    $('#pemusatan_info').show();  
                    $('#pemusatan_barang_id').val($('#importir_id').val()).change();
                    $('#tipe_identitas_pemusatan').text($('#importir_tipe_identitas').text());
                    $('#nama_pemusatan').text($('#importir_nama').text());
                    $('#pemusatan_nomor_identitas').text($('#importir_nomor_identitas').text());
                    $('#pemusatan_alamatv').text($('#importir_alamatv').text());
                    $('#pemusatan_country').text($('#importir_country').text());
                    

                } else {
                    $('#pemusatan_info2').hide(); 
                    $('#pemusatan_barang_id').val($('#importir_id').val()).change(); 
                    $('#pemusatan_input').removeClass('d-none');
                    $('#pemusatan_input').show();
                    $('#pemusatan_info').addClass('d-none');
                    $('#pemusatan_info').hide();

                    // Menyalin data dari input form 'importir'
                    $('#pemusatan_indentitas_type').val($('#importir_indentitas_type').val()).trigger('change'); // Pastikan Select2 di-update
                    $('#pemusatan_nama').val($('#importir_nama').val()); 
                    $('#pemusatan_indentitas_nomor').val($('#importir_indentitas_nomor').val());
                    $('#pemusatan_alamat').val($('#importir_alamat').val());
                }
            });

            $('#btn-salin-pengirim-penjual').on('click', function() { 
                var pengirimSelected = $('#pengirim_barang_id').val();
                
                if (pengirimSelected) { 
                    // Scenario ketika data diambil dari database 
                    $('#penjual_barang_input').addClass('d-none');
                    $('#penjual_barang_input').hide();
                    $('#penjual_barang_info').removeClass('d-none'); 
                    $('#penjual_barang_info').show();  
                    $('#penjual_barang_id').val($('#pengirim_barang_id').val()).change();
                    $('#tipe_identitas_penjual_barang').text($('#tipe_identitas_pengirim_barang').text()); 
                    $('#nomor_identitas_penjual_barang').text($('#nomor_identitas_pengirim_barang').text());
                    $('#alamat_penjual_barang').text($('#alamat_pengirim_barang').text());
                    $('#negara_penjual_barang').text($('#negara_pengirim_barang').text());
                     
                } else { 
                    $('#penjual_barang_id').val($('#pengirim_barang_id').val()).change();
                    // Scenario ketika input form 'importir' diisi secara manual
                    $('#penjual_barang_input').removeClass('d-none');
                    $('#penjual_barang_input').show();
                    $('#penjual_barang_info').addClass('d-none');
                    $('#penjual_barang_info').hide();  
                    $('#penjual_nama').val($('#pengirim_nama').val());  
                    $('#penjual_alamat').val($('#pengirim_alamat').val());
                    $('#penjual_negara').val($('#pengirim_negara').val()).change();

                }
            });
  
            $('#create-form').submit(function(e){
                if (selectedGoods.length == 0) {
                    e.preventDefault();
                    Swal.fire('Error', 'Goods is required', 'error')
                }
                
                var bruto   = $('#berat_kotor').val();
                var netto   = $('#berat_bersih').val();
                var partial = $('#partial').val();

                var transportation_id   = $('#transportation_id').val();
                var vehicle_number      = $('#vehicle_number').val();
                var country_id          = $('#country_id').val();
                var master_tps_id       = $('#master_tps_id').val(); 

                
             
                if ($('#intangible_status').val() == '0') {
                    if(transportation_id == ""){
                        e.preventDefault();
                        Swal.fire('Error', `Cara Pengangkutan is required`, "error")
                    }

                    if(vehicle_number == ""){
                        e.preventDefault();
                        Swal.fire('Error', `Voy/Flight is required`, "error")
                    }
                    
                    if(country_id == ""){
                        e.preventDefault();
                        Swal.fire('Error', `Bendera is required`, "error")
                    }

                    if(master_tps_id == ""){
                        e.preventDefault();
                        Swal.fire('Error', `Tempat Penimbunan is required`, "error")
                    } 
        
                    if(parseFloat(bruto) < parseFloat(netto) 
                    || parseFloat(bruto) == 0){
                        e.preventDefault();
                        Swal.fire('Error', `Netto must not be more than Bruto`, "error")
                    }
               

                
                    //let valueRepeaterPetiKemas  = $('#inbound_peti_kemas').repeaterVal().inbound_peti_kemas;
                    let valueRepeaterKemasan    = $('#inbound_kemasan').repeaterVal().inbound_kemasan;

                }else{
                    $('#country_id').removeAttr('required');
                    $('#master_tps_id').removeAttr('required');
                    $('#transportation_id').removeAttr('required');
                    $('#vehicle_number').removeAttr('required'); 
                    $('#transport_lines_id').removeAttr('required');
                    $('#estimated_arrival_date').removeAttr('required');
                    $('#master_tps_id').removeAttr('required'); 
                    
                }
                let valueRepeater = $('#inbound_documents').repeaterVal().inbound_documents;
                let canSubmitInvoice = false, canSubmitBl = false, canSubmitAwb = false;
                let manyInvoice = 0, manyBl = 0, manyAwb = 0;

                $.each(valueRepeater, (i, vi) => {
                    let docId = parseInt(vi.document_id);
                    if (docId === 5) { canSubmitInvoice = true; manyInvoice++; }
                    else if (docId === 107) { canSubmitBl = true; manyBl++; }
                    //else if (docId === 108) { canSubmitAwb = true; manyAwb++; }
                });

                let missingDocs = [];
                if (!canSubmitInvoice) missingDocs.push("Invoice");
                if ($('#intangible_status').val() == '0') {
                   // if (!canSubmitBl) missingDocs.push("B/L");
                }
                //if (!canSubmitAwb) missingDocs.push("AWB");

                if (missingDocs.length > 0) {
                    e.preventDefault();
                    Swal.fire('Error', `${missingDocs.join(', ')} is required`, 'error');
                    return; // Stop further execution
                }

                if (manyBl > 1 || manyAwb > 1) {
                //if (manyInvoice > 1 || manyBl > 1 || manyAwb > 1) {    
                    e.preventDefault();
                    let multipleDocs = [];
                    //if (manyInvoice > 1) multipleDocs.push("Invoice"); 
                    //if (manyBl > 1) multipleDocs.push("B/L");
                   // if (manyAwb > 1) multipleDocs.push("AWB");

                    Swal.fire('Error', `${multipleDocs.join(' and ')} can only be one`, 'error');
                } 
            })
            
            let importirID = $('#importir_id');
            let penjualID = $('#penjual_barang_id');
            let pengirimID = $('#pengirim_barang_id');
            let pemilikID = $('#pemilik_barang_id');
            let pemusaatnID = $('#pemusatan_barang_id');
            let ppjkID = $('#ppjk_id');

            if(importirID.val() != ''){
                importirID.trigger("change");
            }

            if(penjualID.val() != ''){
                penjualID.trigger("change");
            }
            
            if(pengirimID.val() != ''){
                pengirimID.trigger("change");
            }

            if(pemilikID.val() != ''){
                pemilikID.trigger("change");
            }
            
            if(ppjkID.val() != ''){
                ppjkID.trigger("change");
            }
            if(pemusaatnID.val() != ''){
                pemusaatnID.trigger("change");
            }
        })

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

        function formatToFourDecimals(input) { 
            if (input.value) {
                input.value = parseFloat(input.value).toFixed(4);
            }
        }

        function ajaxValidatin(whereData, type){

            $.ajax({
                type: "GET",
                url: `/inbound/validation-${type}-number/${whereData}/3`,
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

        $('#destination_port_id').on('change', function(){
            $('input[name="destination_port_id_clone"]').val($(this).find('option:checked').text());
            var selectedPortId = $(this).val();
            $.ajax({
                type: "GET",
                url: `{{url('/')}}/master-data/port/master-kppbc/${selectedPortId}`,
                success: function(res) {
                    var result = JSON.parse(res);
                    if(result != null){
                        console.log('Result Code:', result.code);
 
                        $('#kppbc_pengawas_id option').each(function() {
                            var optionText = $(this).text();  

                            console.log('Comparing:', result.code, 'with option:', optionText);
                            
                            if (optionText.startsWith(result.code)) {
                                $('#kppbc_pengawas_id').val($(this).val()).trigger('change'); 
                                return false;  
                            }
                        });
                    } else {
                        $('#kppbc_pengawas_id').val('');
                    }
                },
                error: function(res) {
                    $('#kppbc_pengawas_id').val('');
                    Swal.fire("Error!", res.responseJSON.message, "error");
                }
            });
        });
 

        $('#pemilik_barang_id').on('change', function() {
            $('#negara_pemilik_barang').val("");
            $('#alamat_pemilik_barang').val("");
            $('#tipe_identitas_pemilik_barang').val("");
            $('#nomor_identitas_pemilik_barang').val("");
            if(this.value == ""){ 
                $('#pemilik_barang_input').show(); 
                $('#pemilik_barang_info').hide(); 
            }else{ 
                $('#pemilik_barang_input').hide(); 
                $('#pemilik_barang_info').show();
            }
            var value_pemilik_barang_id = this.value;
            if(value_pemilik_barang_id != ""){

                $.ajax({
                    type: "GET",
                    url: '{{url('/')}}/master-data/profile/detail/'+value_pemilik_barang_id,
                    success: function(res) {
                        // res = JSON.stringify(res);
                        // res = JSON.parse(res);
                        $('#negara_pemilik_barang').html(res['name_country']);
                        $('#alamat_pemilik_barang').html(res['address']);
                        $('#tipe_identitas_pemilik_barang').html(res['tipe_identitas']);
                        $('#nomor_identitas_pemilik_barang').html(res['nomor_identitas']);
                    },
                    error: function(res) {
                        console.log(res.responseJSON.message);
                    }
                })

            }
        });

        $('#penjual_barang_id').on('change', function() {
            $('#negara_penjual_barang').val("");
            $('#alamat_penjual_barang').val("");
            $('#tipe_identitas_penjual_barang').val("");
            $('#nomor_identitas_penjual_barang').val("");
            if(this.value == ""){
                $('#penjual_barang_info').hide();
                $('#penjual_barang_input').show();
            }else{
                $('#penjual_barang_info').show();
                $('#penjual_barang_input').hide();
            }
            var value_penjual_barang_id = this.value;
            if(value_penjual_barang_id != ""){

                $.ajax({
                    type: "GET",
                    url: '{{url('/')}}/master-data/profile/detail/'+value_penjual_barang_id,
                    success: function(res) {
                        // res = JSON.stringify(res);
                        // res = JSON.parse(res);
                        $('#negara_penjual_barang').html(res['name_country']);
                        $('#alamat_penjual_barang').html(res['address']);
                        $('#tipe_identitas_penjual_barang').html(res['tipe_identitas']);
                        $('#nomor_identitas_penjual_barang').html(res['nomor_identitas']);
                    },
                    error: function(res) {
                        console.log(res.responseJSON.message);
                    }
                })

            }
        });

        $('#pengirim_barang_id').on('change', function() {
            $('#negara_pengirim_barang').val("");
            $('#alamat_pengirim_barang').val("");
            $('#tipe_identitas_pengirim_barang').val("");
            $('#nomor_identitas_pengirim_barang').val("");
            if(this.value == ""){
                $('#pengirim_barang_info').addClass("d-none");
                $('#pengirim_barang_input').removeClass("d-none");
            }else{
                $('#pengirim_barang_info').removeClass("d-none");
                $('#pengirim_barang_input').addClass("d-none");
            }
            var value_pengirim_barang_id = this.value;
            if(value_pengirim_barang_id != ""){

                $.ajax({
                    type: "GET",
                    url: '{{url('/')}}/master-data/profile/detail/'+value_pengirim_barang_id,
                    success: function(res) {
                        // res = JSON.stringify(res);
                        // res = JSON.parse(res);
                        $('#negara_pengirim_barang').html(res['name_country']);
                        $('#alamat_pengirim_barang').html(res['address']);
                        $('#tipe_identitas_pengirim_barang').html(res['tipe_identitas']);
                        $('#nomor_identitas_pengirim_barang').html(res['nomor_identitas']);
                    },
                    error: function(res) {
                        console.log(res.responseJSON.message);
                    }
                })

            }
        });
        

        $('#importir_id').on('change', function() {
            $('#importir_tipe_identitas').val("");
            $('#importir_nomor_identitas').val("");
            $('#importir_nomor_izin').val("");
            $('#importir_alamatv').val("");
            $('#importir_country').val("");
            if(this.value == ""){
                $('#importir_info').addClass("d-none");
                $('#importir_input').removeClass("d-none");
            }else{
                $('#importir_info').removeClass("d-none");
                $('#importir_input').addClass("d-none");
            }
            var value_id = this.value;
            if(value_id != ""){
                $.ajax({
                    type: "GET",
                    url: '{{url('/')}}/master-data/profile/detail/'+value_id,
                    success: function(res) {
                        $('#importir_tipe_identitas').html(res['tipe_identitas']);
                        $('#importir_nomor_identitas').html(res['nomor_identitas']);
                        $('#importir_nomor_izin').html(res['nomor_izin']);
                        $('#importir_alamatv').html(res['address']);
                        $('#importir_country').html(res['name_country']);
                    },
                    error: function(res) {
                        console.log(res.responseJSON.message);
                    }
                })

            }
        });

        $('#pemusatan_barang_id').on('change', function() {
            $('#pemusatan_tipe_identitas').val("");
            $('#pemusatan_nomor_identitas').val("");
            $('#pemusatan_nomor_izin').val("");
            $('#pemusatan_alamatv').val("");
            $('#pemusatan_country').val("");
            if(this.value == ""){
                $('#pemusatan_info').addClass("d-none");
                $('#pemusatan_input').removeClass("d-none");
            }else{
                $('#pemusatan_info').removeClass("d-none");
                $('#pemusatan_input').addClass("d-none");
            }
            var value_id = this.value;
            if(value_id != ""){
                $.ajax({
                    type: "GET",
                    url: '{{url('/')}}/master-data/profile/detail/'+value_id,
                    success: function(res) {
                        $('#pemusatan_tipe_identitas').html(res['tipe_identitas']);
                        $('#pemusatan_nomor_identitas').html(res['nomor_identitas']);
                        $('#pemusatan_nomor_izin').html(res['nomor_izin']);
                        $('#pemusatan_alamatv').html(res['address']);
                        $('#pemusatan_country').html(res['name_country']);
                    },
                    error: function(res) {
                        console.log(res.responseJSON.message);
                    }
                })

            }
        });		
        $('#ppjk_id').on('change', function() {
            $('#ppjk_npwp').val("");
            $('#ppjk_alamat').val("");
            $('#ppjk_no').val("");
            $('#ppjk_tanggal').val("");
            $('#ppjk_negara').val("");
            $('#ppjk_tipe_identitas').val("");
            $('#ppjk_nomor_identitas').val("");
            if(this.value == ""){
                $('#ppjk_info').addClass("d-none");
            }else{
                $('#ppjk_info').removeClass("d-none");
            }
            var value_ppjk_id = this.value;
            if(value_ppjk_id != ""){
                $.ajax({
                    type: "GET",
                    url: '{{url('/')}}/master-data/profile/detail/'+value_ppjk_id,
                    success: function(res) {
                        $('#ppjk_npwp').html(res['tipe_identitas']);
                        $('#ppjk_alamat').html(res['address']);
                        $('#ppjk_no').html(res['nomor_ppjk']);
                        $('#ppjk_tanggal').html(res['tanggal_ppjk']);
                        $('#ppjk_negara').html(res['name_country']);
                        $('#ppjk_tipe_identitas').html(res['tipe_identitas']);
                        $('#ppjk_nomor_identitas').html(res['nomor_identitas']);
                    },
                    error: function(res) {
                        console.log(res.responseJSON.message);
                    }
                })

            }
        }); 

        $('#valas_id').on('change', function() {
            $('#ndpbm').val("");
            var value_id = this.value;
            if (value_id != "") {
                $('#loading-spinner').removeClass("d-none");
                $.ajax({
                    type: "GET",
                    url: '{{url('/')}}/air/pib/kurs/' + value_id,
                    success: function(res) {
                        if (res.status === 'Success') {
                            var nilaiKurs = parseFloat(res.data[0].nilaiKurs).toFixed(4);
                            $('#ndpbm').val(nilaiKurs);
                            console.log('Tanggal Awal Berlaku: ' + res.data[0].tglAwalBerlaku);
                            console.log('Tanggal Akhir Berlaku: ' + res.data[0].tglAkhirBerlaku);
                        } else {
                            $('#ndpbm').val(res.error);
                        }
                    },
                    error: function(res) {
                        Swal.fire("Error!", res.responseJSON.message, "error");
                    },
                    complete: function() {
                        $('#loading-spinner').addClass("d-none");  
                    }
                });
            }
        }); 

        $('#btn-tarik-bc-satu-satu').on('click', function() { 
            
            var transportation_id = $('#transportation_id').val();
            let ketDoc = "";
            let documentIdToFetch = "";
        
            if (transportation_id === '1') {
                documentIdToFetch = 107;
                ketDoc = "Dokumen B/L tidak ditemukan atau belum tersedia di Portal Pengguna Jasa";
            } else if (transportation_id === '7') {
                documentIdToFetch = 108;
                ketDoc = "Dokumen AWB tidak ditemukan atau belum tersedia di Portal Pengguna Jasa";
            }else{
                documentIdToFetch = "";
                ketDoc = "Dokumen AWB / BL tidak ditemukan atau belum tersedia di Portal Pengguna Jasa";
            } 
        
            // Mengambil elemen repeater yang sesuai dengan documentIdToFetch
            let documentElement = $(`#inbound_documents [data-repeater-item]`).filter(function() {
                let documentId = $(this).find('select[name$="[document_id]"]').val();
                console.log("Found document ID:", documentId);
                return documentId ; 
                //return documentId == documentIdToFetch; 
            });
        
            console.log("Document element found:", documentElement);
            console.log("Document total:", documentElement.length);
        
            // Jika elemen dokumen tidak ditemukan
            if (documentElement.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: ketDoc,
                });
                return;
            }
        
            // Mengambil nomor dokumen dan tanggal dokumen
            let nomorDokumen = documentElement.find('input[name$="[nomor_dokumen]"]').val(); 
            let tanggalDokumen = documentElement.find('input[name$="[date]"]').val();
            let kodeKantor = $('#kppbc_pengawas_id option:selected').text().split(" - ")[0].trim();
            let namaImportir = $('#importir_nama').val();
        
            console.log("Parameters:", { nomorDokumen, tanggalDokumen, kodeKantor, namaImportir });
        
            // Validasi apakah semua field terisi
            if (!nomorDokumen || !tanggalDokumen || !kodeKantor || !namaImportir) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Pastikan semua field telah terisi dengan benar.',
                });
                return;
            }
        
            // Lakukan AJAX call jika semua field sudah benar
            $.ajax({
                type: "GET",
                url: `{{url('/')}}/air/pib/bc-satu-satu/${documentIdToFetch}`,
                data: {
                    nomor_dokumen: nomorDokumen,
                    tanggal_dokumen: tanggalDokumen,
                    kodeKantor: kodeKantor,
                    namaImportir: namaImportir
                },
                success: function(res) {
                    console.log("AJAX success response:", res);
        
                    if (res.status === 'Success') { 
                        const data = res.data;
                        const noPos = data.noPos;
        
                        function formatDate(dateStr) {
                            const parts = dateStr.split("-");
                            return `${parts[2]}-${parts[1]}-${parts[0]}`; // Mengubah urutan menjadi yyyy-mm-dd
                        }
        
                        $('#no_pos_dokumen_bc').val(noPos.substring(0, 4)).trigger('change');
                        $('#no_sub_pos_dokumen_bc').val(noPos.substring(4, 8)).trigger('change');
                        $('#no_sub_sub_pos_dokumen_bc').val(noPos.substring(8, 12)).trigger('change');
                        $('#no_dokumen_bc').val(data.noBc11).trigger('change');
                        $('#tanggal_bc').val(formatDate(data.tglBc11)).trigger('change');
                        $('#estimated_arrival_date').val(formatDate(data.tglTiba)).trigger('change');
                        $('#vehicle_number').val(data.noVoyage).trigger('change');
                        
                        $('#country_id').val(data.bendera).trigger('change');
                        $('#transportation_id').val(data.caraPengangkutan).trigger('change');
                        $('#loading_port_id').val(data.pelAsal).trigger('change');
                        $('#unloading_port_id').val(data.pelBongkar).trigger('change');
                        $('#transit_port_id').val(data.pelTransit).trigger('change');
                        $('#master_tps_id').val(data.kodeGudang).trigger('change');
        
                        Swal.fire("Success!", "Data berhasil diambil dari API.", "success");
                    } else {
                        Swal.fire("Error!", res.error, "error");
                    }
                },
                error: function(res) {
                    console.log("AJAX error response:", res);
                    Swal.fire("Error!", res.responseJSON.message, "error");
                },
                complete: function() {
                    console.log("AJAX request completed");
                    $('#loading-spinner').addClass("d-none");
                }
            });
        });
        

        document.getElementById('biaya_penambah').addEventListener('input', function(e) {
            let value = parseFloat(e.target.value) || 0; 
            document.getElementById('lblbiaya_penambah').innerText = formatNumber(value);
        });
        document.getElementById('biaya_pengurang').addEventListener('input', function(e) {
            let value = parseFloat(e.target.value) || 0; 
            document.getElementById('lblbiaya_pengurang').innerText = formatNumber(value);
        });
        document.getElementById('freight').addEventListener('input', function(e) {
            let value = parseFloat(e.target.value) || 0; 
            document.getElementById('lblbiaya_freight').innerText = formatNumber(value);
        });
        document.getElementById('asuransi').addEventListener('input', function(e) {
            let value = parseFloat(e.target.value) || 0; 
            document.getElementById('lblbiaya_asuransi').innerText = formatNumber(value);
        });
        document.getElementById('voluntary_declaration').addEventListener('input', function(e) {
            let value = parseFloat(e.target.value) || 0; 
            document.getElementById('lblbiaya_voluntari').innerText = formatNumber(value);
        });
        document.getElementById('fob').addEventListener('input', function(e) {
            let value = parseFloat(e.target.value) || 0; 
            document.getElementById('lblfob').innerText = formatNumber(value);
        });
        
    </script>
@endpush
