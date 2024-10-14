@extends("layouts.main")
@section('content')
    @include("components.toolbar", ['parentMenuName' => 'Inbound', 'menuName' => 'BC23'])
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container">
                <!--begin::Card-->
                <div class="card ">
                    <div class="card-header card-header-stretch">
                        <h3 class="card-title">Input BC23</h3>
                        <div class="card-toolbar">
                        </div>
                    </div>
                    {{-- {!! Form::model($model,["id" => "form"]) !!} --}}
                    <div class="card-body">
                        {{ Form::open(['url' => $mainUrl . '/create', 'method' => 'POST', 'id' => 'create-form', 'enctype' => 'multipart/form-data']) }}
                        <div class="form-group">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class="form-label required">Nomor Pengajuan</label>
                                    {!! Form::text('request_number', null, ['class' => 'form-control ', 'required' => true, 'placeholder' => 'Input No Pengajuan' , 'id' => 'request_number','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                    <span class="error text-danger" id="error-nomor-pengajuan"></span>
                                    @if($errors->has('request_number'))
                                        <span class="error text-danger">{{ $errors->first('request_number') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">Nomor Pendaftaran</label>
                                    {!! Form::text('details[nomor_pendaftaran]', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input No Pendaftaran' , 'id' => 'nomor_pendaftaran','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                    <span class="error text-danger" id="error-nomor-pendaftaran"></span>
                                    @if($errors->has('details[nomor_pendaftaran]'))
                                        <span class="error text-danger">{{ $errors->first('details[nomor_pendaftaran]') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">Tanggal Pendaftaran</label>
                                    {!! Form::text('details[tanggal_pendaftaran]', null, ['class' => 'form-control datepicker', 'required' => true, 'placeholder' => 'Pilih Tanggal']) !!}
                                    @if($errors->has('details[tanggal_pendaftaran]'))
                                        <span class="error text-danger">{{ $errors->first('details[tanggal_pendaftaran]') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4" style="margin-top:10px;">
                                    <label class="form-label required">Kantor Pabean Bongkar</label>
                                    {!! Form::select('kppbc_bongkar_id', $kppbcSelectBox, null, ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                                    @if($errors->has('kppbc_bongkar_id'))
                                        <span class="error text-danger">{{ $errors->first('kppbc_bongkar_id') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-4" style="margin-top:10px;">
                                    <label class="form-label required">Kantor Pabean Pengawas</label>
                                    {!! Form::select('kppbc_pengawas_id', $kppbcSelectBox, null, ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                                    @if($errors->has('kppbc_pengawas_id'))
                                        <span class="error text-danger">{{ $errors->first('kppbc_pengawas_id') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-4" style="margin-top:10px;">
                                    <label class="form-label required">Jenis TPB</label>
                                    {!! Form::select('jenis_tpb_id', $jenisTpbSelectBox, null, ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --']) !!}
                                    @if($errors->has('jenis_tpb_id'))
                                        <span class="error text-danger">{{ $errors->first('jenis_tpb_id') }}</span>
                                    @endif
                                </div>
                                <div class="form-group row" style="margin-top:10px;margin-left: 0px">
                                    <div class="col">
                                        <div class=" bg-transparent border-dashed border-1 p-3 row rounded" style="border-color:lightgrey ">
                                        <h2 class="fw-bolder mt-4">BC 1.1</h2>
                                            <div class="col-md-4">
                                                    <label class="form-label">No Dokumen</label>
                                                    {!! Form::text('no_dokumen_bc',null, ['class' => 'form-control', 'placeholder' => 'Input No Dokumen','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                                    @if($errors->has('no_dokumen_bc'))
                                                        <span class="error text-danger">{{ $errors->first('no_dokumen_bc') }}</span>
                                                    @endif
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Dokumen</label>
                                                {!! Form::file('dokumen_bc', ['class' => 'form-control', 'placeholder' => 'File']) !!}
                                                @if($errors->has('dokumen_bc'))
                                                    <span class="error text-danger">{{ $errors->first('dokumen_bc') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Tanggal</label>
                                                {!! Form::text('tanggal_bc', null, ['class' => 'form-control datepicker', 'placeholder' => 'Pilih Tanggal']) !!}
                                                @if($errors->has('tanggal_bc'))
                                                    <span class="error text-danger">{{ $errors->first('tanggal_bc') }}</span>
                                                @endif
                                            </div>

                                            <div class="col-md-4" style="margin-top:10px;">
                                                <label class="form-label">No Pos Dokumen</label>
                                                {!! Form::text('no_pos_dokumen_bc',null, ['class' => 'form-control','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                                @if($errors->has('no_pos_dokumen_bc'))
                                                    <span class="error text-danger">{{ $errors->first('no_pos_dokumen_bc') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-4" style="margin-top:10px;" >
                                                <label class="form-label">Nomor Subpos Dokumen</label>
                                                {!! Form::text('no_sub_pos_dokumen_bc',null, ['class' => 'form-control','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                                @if($errors->has('no_sub_pos_dokumen_bc'))
                                                    <span class="error text-danger">{{ $errors->first('no_sub_pos_dokumen_bc') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-4" style="margin-top:10px;">
                                                <label class="form-label">Nomor Subsubpos Dokumen</label>
                                                {!! Form::text('no_sub_sub_pos_dokumen_bc',null, ['class' => 'form-control','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                                @if($errors->has('no_sub_sub_pos_dokumen_bc'))
                                                    <span class="error text-danger">{{ $errors->first('no_sub_sub_pos_dokumen_bc') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div  class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px;">
                            <div class="form-group row">
                                <div class="col-md-3" style="margin-bottom:10px;">
                                    <h2 class="fw-bolder mt-4"> <label class="form-label required">Importir</label></h2>
                                        {!! Form::select('importir_id', $importirSelectBox, $user_customer ?? '', ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --','id'=>'importir_id']) !!}
                                        @if($errors->has('importir_id'))
                                            <span class="error text-danger">{{ $errors->first('importir_id') }}</span>
                                        @endif
                                        <div  class="card p-1 d-none " style="margin-top: 10px" id="importir_info">
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
                                                            <div>Alamat : &nbsp;</div><div class=" " readonly ='readonly'  id ='importir_alamat'>Pilih Importir</div>
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

                                <div class="col-md-3">
                                    <h2 class="fw-bolder mt-4"> <label class="form-label required">Pemasok Barang</label></h2>
                                        {!! Form::select('pemasok_barang_id', $pemasokBarangSelectBox, $user_customer ?? '', ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id'=>'pemasok_barang_id']) !!}
                                        @if($errors->has('pemasok_barang_id'))
                                            <span class="error text-danger">{{ $errors->first('pemasok_barang_id') }}</span>
                                        @endif
                                        <div class="card p-1 d-none" style="margin-top: 10px" id="pemasok_barang_info">
                                            <table  class=" table align-middle  table-row-dashed table-row-gray-400 fs-8 dataTable no-footer text-gray-600" role="grid" aria-describedby="table_info">
                                                <tbody >
                                                    <tr>
                                                        <td class="d-flex p-1">
                                                            <div>Tipe Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='tipe_identitas_pemasok_barang'>Pilih Pemasok Barang</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="d-flex p-1">
                                                            <div>Nomor Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='nomor_identitas_pemasok_barang'>Pilih Pemasok</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="d-flex p-1">
                                                            <div>Negara : &nbsp;</div><div class=" " readonly ='readonly'  id ='negara_pemasok_barang'>Pilih Pemasok Barang</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="d-flex p-1">
                                                            <div>Alamat : &nbsp;</div><div class=" " readonly ='readonly'  id ='alamat_pemasok_barang'>Pilih Pemasok Barang</div>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>

                                        </div>

                                </div>

                                <div class="col-md-3">
                                    <h2 class="fw-bolder mt-4"> <label class="form-label required">Pemilik Barang</label></h2>
                                        {!! Form::select('pemilik_barang_id', $pemilikBarangSelectBox, $user_customer ?? '', ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id'=>'pemilik_barang_id']) !!}
                                        @if($errors->has('pemilik_barang_id'))
                                            <span class="error text-danger">{{ $errors->first('pemilik_barang_id') }}</span>
                                        @endif
                                        <div class="card p-1 d-none" style="margin-top: 10px" id="pemilik_barang_info">
                                            <table  class=" table align-middle  table-row-dashed table-row-gray-400 fs-8 dataTable no-footer text-gray-600" role="grid" aria-describedby="table_info">
                                                <tbody >
                                                    <tr>
                                                        <td class="d-flex p-1">
                                                            <div>Tipe Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='tipe_identitas_pemilik_barang'>Pilih Pemilik Barang</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="d-flex p-1">
                                                            <div>Nomor Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='nomor_identitas_pemilik_barang'>Pilih Importir</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="d-flex p-1">
                                                            <div>Negara : &nbsp;</div><div class=" " readonly ='readonly'  id ='negara_pemilik_barang'>Pilih Pemilik Barang</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="d-flex p-1">
                                                            <div>Alamat : &nbsp;</div><div class=" " readonly ='readonly'  id ='alamat_pemilik_barang'>Pilih Pemilik Barang</div>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>

                                        </div>
                                </div>

                                <div class="col-md-3">
                                    <h2 class="fw-bolder mt-4">  <label class="form-label required">PPJK</label></h2>
                                        {!! Form::select('ppjk_id', $ppjkSelectBox, null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id'=>'ppjk_id']) !!}
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

                            @include('inbound.bc23.add.partials.transport')
                            

                            <div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                            <h2 class="fw-bolder mt-4">Peti Kemas</h2>
                            <div class="form-group row" style="margin-top:10px;">

                                <div class="col-md-3">
                                    <label class="form-label required">Nomor</label>
                                    {!! Form::text('details[nomor_peti_kemas]', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input', 'id' => 'nomor_peti_kemas','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                    @if($errors->has('details[nomor_peti_kemas]'))
                                        <span class="error text-danger">{{ $errors->first('details[nomor_peti_kemas]') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label required">Ukuran</label>
                                    {!! Form::select('details[ukuran_peti_kemas_id]', $masterUkuranPetiKemas, null, ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                                    @if($errors->has('details[ukuran_peti_kemas_id]'))
                                        <span class="error text-danger">{{ $errors->first('details[ukuran_peti_kemas_id]') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label required">Jenis</label>
                                    {!! Form::select('details[jenis_peti_kemas]', ['4 - EMPTY' => '4 - EMPTY' , '7 - LCL' => '7 - LCL' , '8 - FCL' => '8 - FCL'], null, ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                                    @if($errors->has('details[jenis_peti_kemas]'))
                                        <span class="error text-danger">{{ $errors->first('details[jenis_peti_kemas]') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label required">Tipe</label>
                                    {!! Form::select('details[type_peti_kemas_id]', $masterTypePetiKemas, null, ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2', 'id' => 'type_peti_kemas_id']) !!}
                                    @if($errors->has('details[type_peti_kemas_id]'))
                                        <span class="error text-danger">{{ $errors->first('details[type_peti_kemas_id]') }}</span>
                                    @endif
                                </div>
                            </div>
                            </div>
                            @include('inbound.components.add.documents')

                            <div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                                <h2 class="fw-bolder mt-6">Transaksi</h2>
                                <div class="form-group row" style="margin-top:10px;">
                                    <div class="col-md-4">
                                        <label class="form-label required">Valuta</label>
                                        {!! Form::select('valas_id', $valas, null, ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'id' => 'valas_id',  'data-control' => 'select2']) !!}
                                        @if($errors->has('valas_id'))
                                            <span class="error text-danger">{{ $errors->first('valas_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">NDPBM</label>
                                        {!! Form::number('details[ndpbm]', 0, ['class' => 'form-control bg-secondary', 'readonly' => 'readonly','required' => true, 'placeholder' => 'Input', 'id' => 'ndpbm']) !!}
                                        @if($errors->has('details[ndpbm]'))
                                            <span class="error text-danger">{{ $errors->first('details[ndpbm]') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Nilai Ekspor</label>
                                        {!! Form::number('details[fob]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'fob',  'maxlength' => '18', 'min' => '0', 'readonly' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                        if(this.value<0){this.value='0'}" ]) !!}
                                        @if($errors->has('details[fob]'))
                                            <span class="error text-danger">{{ $errors->first('details[fob]') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top:10px;">
                                    <div class="col-md-4">
                                        <label class="form-label">Freight</label>
                                        {!! Form::number('details[freight]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'freight',  'maxlength' => '18', 'min' => '0', 'readonly', 'step' => 'any' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                        if(this.value<0){this.value='0'}" ]) !!}
                                        @if($errors->has('details[freight]'))
                                            <span class="error text-danger">{{ $errors->first('details[freight]') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Asuransi LN/DN</label>
                                        {!! Form::number('details[asuransi]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'asuransi',  'maxlength' => '18', 'min' => '0', 'step' => 'any' , 'readonly', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                        if(this.value<0){this.value='0'}" ]) !!}
                                        @if($errors->has('details[asuransi]'))
                                            <span class="error text-danger">{{ $errors->first('details[asuransi]') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Nilai CIF</label>
                                        {!! Form::number('details[nilai_cif]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'nilai_cif',  'maxlength' => '18', 'min' => '0' , 'step' => 'any' , 'readonly', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                        if(this.value<0){this.value='0'}" ]) !!}
                                        @if($errors->has('details[nilai_cif]'))
                                            <span class="error text-danger">{{ $errors->first('details[nilai_cif]') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top:10px;">

                                    <div class="col-md-4">
                                        <label class="form-label">CIF RP</label>
                                        {!! Form::number('details[cif_rp]', 0, ['class' => 'form-control bg-secondary', 'step' => 'any' ,'readonly' => 'readonly','required' => true, 'placeholder' => 'Input', 'id' => 'cif_rp']) !!}
                                        @if($errors->has('details[cif_rp]'))
                                            <span class="error text-danger">{{ $errors->first('details[cif_rp]') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Biaya Penambah</label>
                                        {!! Form::number('details[biaya_penambah]', 0, ['class' => 'form-control bg-secondary', 'step' => 'any', 'readonly' => 'readonly','required' => true, 'placeholder' => 'Input', 'id' => 'biaya_penambah']) !!}
                                        @if($errors->has('details[biaya_penambah]'))
                                            <span class="error text-danger">{{ $errors->first('details[biaya_penambah]') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Biaya Pengurang</label>
                                        {!! Form::number('details[biaya_pengurang]', 0, ['class' => 'form-control bg-secondary', 'step' => 'any', 'readonly' => 'readonly','required' => true, 'placeholder' => 'Input', 'id' => 'biaya_pengurang']) !!}
                                        @if($errors->has('details[biaya_pengurang]'))
                                            <span class="error text-danger">{{ $errors->first('details[biaya_pengurang]') }}</span>
                                        @endif
                                    </div>

                                    {{-- <div class="col-md-4">
                                        <label class="form-label">Harga Detail</label>
                                        {!! Form::number('details[harga_detil]', null, ['class' => 'form-control','readonly' => 'readonly', 'required' => true, 'placeholder' => 'Input', 'id' => 'harga_detil',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                        if(this.value<0){this.value='0'}" ]) !!}
                                        @if($errors->has('details[harga_detil]'))
                                            <span class="error text-danger">{{ $errors->first('details[harga_detil]') }}</span>
                                        @endif
                                    </div> --}}
                                </div>
                            
                                <div class="form-group row" style="margin-top:10px;">
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
                                            </div>
                                        </div>
                                        @include('inbound.components.add.goods_table')
                                    </div>
                                </div>

                                <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-4">
                                        <label class="form-label required">Jenis Kedatangan barang</label>
                                            <select class="form-control" name="partial" data-control="select2" id="partial">
                                                <option value="" disabled selected>--Select--</option>
                                                <option value="1">Pengiriman Partial</option>
                                                <option value="0">Tidak Partial</option>
                                            </select>
                                        @if($errors->has('partial'))
                                            <span class="error text-danger">{{ $errors->first('partial') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Bruto</label>
                                        {!! Form::number('details[berat_kotor]', 0, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input', 'id' => 'berat_kotor', 'step' => 'any' , 'maxlength' => '18', 'min' => '0' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                        if(this.value<0){this.value='0'}" ]) !!}
                                        @if($errors->has('details[berat_kotor]'))
                                            <span class="error text-danger">{{ $errors->first('details[berat_kotor]') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Netto</label>
                                        {!! Form::number('details[berat_bersih]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'berat_bersih' , 'step' => 'any' ,  'maxlength' => '18', 'min' => '0', 'readonly', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                        if(this.value<0){this.value='0'}" ]) !!}
                                        @if($errors->has('details[berat_bersih]'))
                                            <span class="error text-danger">{{ $errors->first('details[berat_bersih]') }}</span>
                                        @endif
                                    </div>

                                </div>

                                @include('inbound.bc23.add.partials.pungutan')
                            </div>
                                {!! Form::hidden('list_barang', null, ['id' => 'list_barang']) !!}

                            <div class=" bg-light-primary border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
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
                                        {!! Form::text('details[pabean_tanggal]', null, ['class' => 'form-control datepicker', 'required' => true, 'placeholder' => 'input Tanggal']) !!}
                                        @if($errors->has('details[pabean_tanggal]'))
                                            <span class="error text-danger">{{ $errors->first('details[pabean_tanggal]') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label required">Pemberitahu</label>
                                        {!! Form::text('details[pabean_pemberitahu]', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input Pemberi Tahu','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                        @if($errors->has('details[pabean_pemberitahu]'))
                                            <span class="error text-danger">{{ $errors->first('details[pabean_pemberitahu]') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label required">Jabatan</label>
                                        {!! Form::text('details[pabean_jabatan]', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input Jabatan','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                        @if($errors->has('details[pabean_jabatan]'))
                                            <span class="error text-danger">{{ $errors->first('details[pabean_jabatan]') }}</span>
                                        @endif
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
                        {!! Form::close() !!}
                        @include('inbound.components.add.add_modal', ['bc' => 'BC23'])
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
            let totalVolume = 0;
            let totalBeratBersih = 0;
            let totalBeratKotor = 0;
            let totalFob = 0;
            let totalAsuransi = 0;
            let totalNilaiCif = 0;
            let totalFreight = 0;

            // News
            let totalBiayaPenambah = 0;
            let totalBiayaPengurang = 0;
            let totalCifRP = 0;

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

            console.log(selectedGoods);

            selectedGoods.forEach((item) => {

                totalVolume += parseFloat(item.volume);
                totalBeratBersih += parseFloat(item.nett_weight);
                // totalBeratKotor += parseFloat(item.nett_weight);
                totalFob += parseFloat(item.details.fob);
                totalNilaiCif += parseFloat(item.details.nilai_cif);
                totalFreight += parseFloat(item.details.freight);

                totalBiayaPenambah += parseFloat(item.details.biaya_penambah);
                totalBiayaPengurang += parseFloat(item.details.biaya_pengurang);
                totalAsuransi += parseFloat(item.details.asuransi);
                totalCifRP += parseFloat(item.details.cif_rp);

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
                // const pph = (parseFloat(item.details.cif_rp) + bm) * parseFloat(item.details.pph) / 100 * (parseFloat(item.details.pph_tax_value) / 100);
                console.log(parseFloat(item.details.pph));

                if (item.details.pph_tax_type == "1") { //Ditangguhkan
                    pphDitangguhkan += pph;
                } else if (item.details.pph_tax_type == "5") { //Dibebaskan
                    pphDibebaskan += pph;
                } else if (item.details.pph_tax_type == "6") { //Tidak Dipungut
                    pphTidakDipungut += pph;
                }

                const ppn = (parseFloat(item.details.cif_rp) + bmRaw) * parseFloat(item.details.ppn) / 100 * (parseFloat(item.details.ppn_tax_value) / 100);
                
                // const ppn = ((parseFloat(item.details.cif_rp) + bm) * parseFloat(item.details.ppn) / 100 ) * (parseFloat(item.details.ppn_tax_value) / 100);

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
            $('#total_volume').val(totalVolume)
            $('#berat_bersih').val(totalBeratBersih)
            // $('#berat_kotor').val(totalBeratKotor)
            $('#nilai_cif').val(totalNilaiCif)
            $('#freight').val(totalFreight)
            $('#fob').val(totalFob)
            $('#asuransi').val(totalAsuransi)

            // News
            $('#biaya_penambah').val(totalBiayaPenambah)
            $('#biaya_pengurang').val(totalBiayaPengurang)
            $('#cif_rp').val(totalCifRP)

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

            $('#table').DataTable().clear().rows.add(selectedGoods).draw()
        }
        $(document).ready(function() {
            $('#create-form').submit(function(e){
                if (selectedGoods.length == 0) {
                    e.preventDefault();
                    Swal.fire('Error', 'Goods is required', 'error')
                }
                
                var bruto = $('#berat_kotor').val();
                var netto = $('#berat_bersih').val();
                var partial = $('#partial').val();

                if(parseFloat(bruto) < parseFloat(netto) 
                || parseFloat(bruto) == 0){
                    e.preventDefault();
                    Swal.fire('Error', `Netto must not be more than Bruto`, "error")
                }

                if(partial == null){
                    e.preventDefault();
                    Swal.fire('Error', `Partial must be filled `, "error")
                }

                let valueRepeater = $('#inbound_documents').repeaterVal().inbound_documents;
                let canSubmited = true;
                let manyFakturPajak = 0;
                $.each(valueRepeater, (i, vi) => {
                    if(vi.document_id == 3){
                        canSubmited = true;
                        manyFakturPajak += 1;
                    }
                })

                if(!canSubmited){
                    e.preventDefault();
                    Swal.fire('Error', 'Faktur Pajak is required', 'error')
                }

                if(manyFakturPajak > 1){
                    e.preventDefault();
                    Swal.fire('Error', 'Faktur Pajak can just one', 'error')
                }
                
            })
            
            let importirID = $('#importir_id');
            let pemasokID = $('#pemasok_barang_id');
            let pemilikID = $('#pemilik_barang_id');
            let ppjkID = $('#ppjk_id');

            if(importirID.val() != ''){
                importirID.trigger("change");
            }

            if(pemasokID.val() != ''){
                pemasokID.trigger("change");
            }
            
            if(pemilikID.val() != ''){
                pemilikID.trigger("change");
            }
            
            if(ppjkID.val() != ''){
                ppjkID.trigger("change");
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

        $('#pemilik_barang_id').on('change', function() {
            $('#negara_pemilik_barang').val("");
            $('#alamat_pemilik_barang').val("");
            $('#tipe_identitas_pemilik_barang').val("");
            $('#nomor_identitas_pemilik_barang').val("");
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

        $('#pemasok_barang_id').on('change', function() {
            $('#negara_pemasok_barang').val("");
            $('#alamat_pemasok_barang').val("");
            $('#tipe_identitas_pemasok_barang').val("");
            $('#nomor_identitas_pemasok_barang').val("");
            if(this.value == ""){
                $('#pemasok_barang_info').addClass("d-none");
            }else{
                $('#pemasok_barang_info').removeClass("d-none");
            }
            var value_pemasok_barang_id = this.value;
            if(value_pemasok_barang_id != ""){
                $.ajax({
                    type: "GET",
                    url: '{{url('/')}}/master-data/profile/detail/'+value_pemasok_barang_id,
                    success: function(res) {
                        // res = JSON.stringify(res);
                        // res = JSON.parse(res);
                        $('#negara_pemasok_barang').html(res['name_country']);
                        $('#alamat_pemasok_barang').html(res['address']);
                        $('#tipe_identitas_pemasok_barang').html(res['tipe_identitas']);
                        $('#nomor_identitas_pemasok_barang').html(res['nomor_identitas']);



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
            $('#importir_alamat').val("");
            $('#importir_country').val("");
            if(this.value == ""){
                $('#importir_info').addClass("d-none");
            }else{
                $('#importir_info').removeClass("d-none");
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
                        $('#importir_alamat').html(res['address']);
                        $('#importir_country').html(res['name_country']);
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
                        Swal.fire("Error!", res.responseJSON.message, "error");
                    }
                })

        });

    </script>
@endpush
