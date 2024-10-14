@extends("layouts.main")
@section('content')
    @include("components.toolbar", ['parentMenuName' => 'FTZ0102', 'menuName' => 'FTZ Export To Outside Pabean'])
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container">
                <!--begin::Card-->
                <div class="card ">
                    <div class="card-header card-header-stretch">
                        <h3 class="card-title">Detail FTZ0102, Nomor Pengajuan : {{$inbound->request_number}}</h3>
                        <div class="card-toolbar">
                        <span style="margin-top:10px; ">
                                @if($canDone) 
                                        <button type="button" id="btn-sppd" class="btn btn-light-primary ">
                                            <i class="fas fa-thumbs-up"></i>Kirim Doc
                                        </button> 
                                @else 
                                        <a href="{{ $mainUrl . '/pdf/' . $inbound->id }}" type="button" id="btn-done" class="btn btn-light-danger ">
                                        <i class="fas fa-file-pdf"></i>Export PDF
                                        </a> 
                                @endif
                                <a href="/air/pib" id="" class="btn btn-light me-3"><i class="fas fa-chevron-left"></i> Back</a>
                             </span> 
                        </div>
                    </div>
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
                                    <a class="nav-link text-active-primary me-6" id="nav-pengangkut-tab" data-toggle="tab" href="#nav-pengangkut" role="tab" aria-controls="nav-pengangkut" aria-selected="false">Pengangkut</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary me-6" id="nav-petikemas-tab" data-toggle="tab" href="#nav-petikemas" role="tab" aria-controls="nav-petikemas" aria-selected="false">Peti Kemas</a>
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
                    <div class="card-body">

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-header" role="tabpanel" aria-labelledby="nav-header-tab">
                             
                                <div class="form-group row" style="margin-top:10px;">
                                    <div class="col-md-4">
                                        <label class="form-label required">Nomor Pengajuan</label>
                                        <p>{{$inbound->request_number}}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label required">Nomor Pendaftaran</label>
                                        <p>{{@$inbound->details['nomor_pendaftaran'] ?: null}}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label required">Tanggal Pendaftaran</label>
                                        <p>{{@$inbound->details['tanggal_pendaftaran'] ?: null}} </p>
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-md-4" style="margin-top:10px;">
                                        <label class="form-label required">Kantor Pabean Pengawas</label>
                                        {!! Form::select('kppbc_pengawas_id', $kppbcSelectBox, $inbound->inboundKppbcPengawas->kppbc_id, ['class' => 'form-select bg-secondary', 'disabled' => true, 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                                        @if($errors->has('kppbc_pengawas_id'))
                                            <span class="error text-danger">{{ $errors->first('kppbc_pengawas_id') }}</span>
                                        @endif
                                    </div>
                     
                

                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4" style="margin-top:10px;">
                                        <label class="form-label required">Jenis PIB</label>
                                        <select  class="form-control bg-secondary" name="pib_type_id" id="pib_type_id" disabled data-control="select2">
                                            <option value="" disabled selected>--Select--</option>
                                            <option value="1" {{ isset($inbound->pib_type_id) && $inbound->pib_type_id == "1" ? 'selected' : '' }}>Biasa</option>
                                            <option value="2" {{ isset($inbound->pib_type_id) && $inbound->pib_type_id == "2" ? 'selected' : '' }}>Berkala</option>
                                        </select>
                                        @if($errors->has('pib_type_id'))
                                            <span class="error text-danger">{{ $errors->first('pib_type_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4" style="margin-top:10px;">
                                        <label class="form-label required">Jenis Import</label>
                                        {!! Form::select('import_type_id', $masterImportType, $inbound->import_type_id ?? '', ['class' => 'form-select bg-secondary', 'disabled' => true,'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2','id'=>'import_type_id']) !!}
                                        @if($errors->has('import_type_id'))
                                            <span class="error text-danger">{{ $errors->first('import_type_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4" style="margin-top:10px;">
                                        <label class="form-label required">Cara Bayar</label>
                                        {!! Form::select('payment_type_id', $masterPaymentType, $inbound->payment_type_id ?? '', ['class' => 'form-select bg-secondary', 'disabled' => true, 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --','id'=>'payment_type_id']) !!}
                                        @if($errors->has('payment_type_id'))
                                            <span class="error text-danger">{{ $errors->first('payment_type_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-entitas" role="tabpanel" aria-labelledby="nav-entitas-tab">
                                <div  class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey;margin-top:10px; ">
                                    <div class="form-group row" >

                                        <div class="col-md-4" style="margin-bottom:10px;">
                                            <h2 class="fw-bolder mt-4"> <label class="form-label required">Importir</label></h2>
                                            {!! Form::select('importir_id', $importirSelectBox, $inbound->inboundImportir->profile_id ?? '', ['class' => 'form-select bg-secondary', 'disabled' => true, 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --','id'=>'importir_id']) !!}
                                            @if($errors->has('importir_id'))
                                                <span class="error text-danger">{{ $errors->first('importir_id') }}</span>
                                            @endif
                                            <div  class="card p-1 " style="margin-top: 10px" id="importir_info">
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

                                        <div class="col-md-4">
                                            <h2 class="fw-bolder mt-4"> <label class="form-label required">Pemilik Barang</label></h2>
                                            {!! Form::select('pemilik_barang_id', $pemilikBarangSelectBox, $inbound->inboundPemilikBarang->profile_id ?? '', ['class' => 'form-select bg-secondary', 'disabled' => true, 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id'=>'pemilik_barang_id']) !!}
                                            @if($errors->has('pemilik_barang_id'))
                                                <span class="error text-danger">{{ $errors->first('pemilik_barang_id') }}</span>
                                            @endif
                                            <div class="card p-1 " style="margin-top: 10px" id="pemilik_barang_info">
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

                                        <div class="col-md-4">
                                            <h2 class="fw-bolder mt-4"><label class="form-label required">PPJK</label></h2>

                                            {!! Form::select('ppjk_id', $ppjkSelectBox, $inbound->inboundPpjk->profile_id ?? '', ['class' => 'form-select bg-secondary', 'disabled' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id'=>'ppjk_id']) !!}
                                            @if($errors->has('ppjk_id'))
                                                <span class="error text-danger">{{ $errors->first('ppjk_id') }}</span>
                                            @endif
                                            <div class="card p-1 " style="margin-top: 10px" id="ppjk_info">
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

                                        <div class="col-md-4">
                                            <h2 class="fw-bolder mt-4"> <label class="form-label required">Penjual Barang</label></h2>
                                            {!! Form::select('penjual_barang_id', $penjualBarangSelectBox, $inbound->inboundPenjualBarang->profile_id ?? '', ['class' => 'form-select bg-secondary', 'disabled' => true, 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id'=>'penjual_barang_id']) !!}
                                            @if($errors->has('penjual_barang_id'))
                                                <span class="error text-danger">{{ $errors->first('penjual_barang_id') }}</span>
                                            @endif
                                            <div class="card p-1 " style="margin-top: 10px" id="penjual_barang_info">
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

                                        <div class="col-md-4">
                                            <h2 class="fw-bolder mt-4"> <label class="form-label required">Pengirim Barang</label></h2>
                                            {!! Form::select('pengirim_barang_id', $pengirimBarangSelectBox, $inbound->inboundPengirimBarang->profile_id ?? '', ['class' => 'form-select bg-secondary', 'disabled' => true,'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id'=>'pengirim_barang_id']) !!}
                                            @if($errors->has('pengirim_barang_id'))
                                                <span class="error text-danger">{{ $errors->first('pengirim_barang_id') }}</span>
                                            @endif
                                            <div class="card p-1 " style="margin-top: 10px" id="pengirim_barang_info">
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
                                        <div class="col-md-4" style="margin-bottom:10px;">
                                            <h2 class="fw-bolder mt-4"> <label class="form-label required">Pemusatan</label></h2>
                                                {!! Form::select('pemusatan_barang_id', $pemusatanSelectBox, $inbound->inboundPemusatanBarang->profile_id ?? '', ['class' => 'form-select bg-secondary', 'disabled' => true, 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id'=>'pemusatan_barang_id']) !!}
                                                @if($errors->has('pemusatan_barang_id'))
                                                    <span class="error text-danger">{{ $errors->first('pemusatan_barang_id') }}</span>
                                                @endif
                                                <div  class="card p-1 d-none " style="margin-top: 10px" id="pemusatan_info">
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
                                                                    <div>Alamat : &nbsp;</div><div class=" " readonly ='readonly'  id ='pemusatan_alamat'>Pilih pemusatan</div>
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
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-dokumen" role="tabpanel" aria-labelledby="nav-dokumen-tab">
                                <div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey;">                            
                                    @include('ftz.components.detail.documents_table')
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-pengangkut" role="tabpanel" aria-labelledby="nav-pengangkut-tab">
                                <div  class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey;margin-top:10px; ">
                                    <h2 class="fw-bolder mt-4">BC 1.1</h2>
                                    <div class="form-group row" style="margin-top:10px;margin-left: 0px">
                                        <div class="col">
                                            <div class=" bg-transparent border-dashed border-1 p-3 row rounded" style="border-color:lightgrey ">
                                                <div class="col-md-4" style="margin-top:10px;">
                                                    <label class="form-label required">Nomor Tutup PU</label>
                                                    {!! Form::select('details[nomor_tutup_pu]', $TutupPu, @$inbound->details['nomor_tutup_pu'] ?: null, ['class' => 'form-select', 'data-control' => 'select2 bg-secondary', 'disabled' => true, 'placeholder' => '-- Select --']) !!}
                                                    @if($errors->has('details[nomor_tutup_pu]'))
                                                        <span class="error text-danger">{{ $errors->first('details[nomor_tutup_pu]') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-4" style="margin-top:10px;">
                                                    <label class="form-label">No Pos Dokumen BC 1.1</label>
                                                    <p>{{ $dokubc11->nomor_dokumen  ?? '' }}</p> 
                                                </div>
                                                <div class="col-md-4" style="display:none;">
                                                    <label class="form-label">Dokumen BC 1.1</label>
                                                    <div id='file' class="btn-group ">
                                                        <span class="mt-2" style="margin-right:14px;">{{ $bc11files->name ?? '' }}</span>
                                                        @if ($bc11files != null)
                                                        <button onclick="window.open('{{ $bc11files->path ?? '' }} ', '_blank')" class="btn_link btn btn-sm btn-light-success " download="" >
                                                            <i class="la la-file"></i>
                                                        </button>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Tanggal</label>
                                                    <p>{{ $dokubc11->date  ?? '' }}</p>
                                                </div>

                                                <div class="col-md-4" style="margin-top:10px;">
                                                    <label class="form-label">No Pos Dokumen BC 1.1</label>
                                                    <p>{{ $dokubc11->nomor_pos_dokumen  ?? '' }}</p>
                                                </div>
                                                <div class="col-md-4" style="margin-top:10px;" >
                                                    <label class="form-label">Nomor Subpos Dokumen BC 1.1</label>
                                                    <p>{{ $dokubc11->nomor_sub_pos_dokumen  ?? '' }}</p>
                                                </div>
                                                <div class="col-md-4" style="margin-top:10px;">
                                                    <label class="form-label">Nomor Subsubpos Dokumen BC 1.1</label>
                                                    <p>{{ $dokubc11->nomor_sub_sub_pos_dokumen  ?? '' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                    @include('ftz.pib.detail.partials.transport')   
                            </div> 
                            <div class="tab-pane fade" id="nav-petikemas" role="tabpanel" aria-labelledby="nav-petikemas-tab">
                                <div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                                    @include('ftz.components.detail.kemasan')
                                </div>
                                <div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                                    @include('ftz.components.detail.peti_kemas')
                                </div>  
                            </div>
                            <div class="tab-pane fade" id="nav-transaksi" role="tabpanel" aria-labelledby="nav-transaksi-tab">
                                <div class=" bg-transparent border-dashed border-1 p-3 row rounded" style="border-color:lightgrey; margin-top:10px;">
                                    <h2 class="fw-bolder mt-4">Transaksi</h2>
                                    <div class="col-md-4 bg-transparent border-dashed border-1  rounded p-3" style="margin-bottom:10px;">
                                        <h2 class="fw-bolder mt-4"> <label class="form-label "><b>Harga</b></label></h2>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label class="form-label required">Valuta</label>
                                                {!! Form::select('valas_id', $valas, $inbound->inboundValas->valas_id, ['class' => 'form-select bg-secondary', 'readonly' => 'readonly', 'required' => true, 'placeholder' => '-- Select --', 'id' => 'valas_id',  'data-control' => 'select2']) !!}
                                                @if($errors->has('valas_id'))
                                                    <span class="error text-danger">{{ $errors->first('valas_id') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">NDPBM</label>
                                                {!! Form::number('details[ndpbm]', @$inbound->details['ndpbm'] ?: 0, ['class' => 'form-control bg-secondary', 'readonly' => 'readonly','required' => true, 'placeholder' => 'Input', 'id' => 'ndpbm']) !!}
                                                @if($errors->has('details[ndpbm]'))
                                                    <span class="error text-danger">{{ $errors->first('details[ndpbm]') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Jenis Transaksi</label>
                                                {!! Form::select('details[jenis_transaksi_id]', $TradeTransactionTypes, @$inbound->details['jenis_transaksi_id'], ['class' => 'form-select bg-secondary', 'placeholder' => '-- Select --', 'id' => 'jenis_transaksi_id',  'data-control' => 'select2']) !!}
                                                @if($errors->has('details[jenis_transaksi_id]'))
                                                    <span class="error text-danger">{{ $errors->first('details[jenis_transaksi_id]') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label required">Incoterm</label>
                                                {!! Form::select('details[hincoterm_id]', $masterIncoterms, @$inbound->details['hincoterm_id'], ['class' => 'form-select bg-secondary', 'readonly' => 'readonly','required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --' , 'id' => 'hincoterm_id']) !!}                                                    
                                                @if($errors->has('hincoterm_id'))
                                                    <span class="error text-danger">{{ $errors->first('hincoterm_id') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Harga Barang</label>
                                                {!! Form::number('details[fob]', @$inbound->details['fob'] ?: 0, ['class' => 'form-control bg-secondary', 'readonly' => 'readonly','required' => true, 'placeholder' => 'Input', 'id' => 'fob',  'maxlength' => '18', 'min' => '0', 'readonly' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                                if(this.value<0){this.value='0'}" ]) !!}
                                                @if($errors->has('details[fob]'))
                                                    <span class="error text-danger">{{ $errors->first('details[fob]') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Nilai Barang</label>
                                                {!! Form::number('details[nilai_cif]', @$inbound->details['nilai_cif'] ?: 0, ['class' => 'form-control bg-secondary', 'readonly' => 'readonly', 'required' => true, 'placeholder' => 'Input', 'id' => 'nilai_cif',  'maxlength' => '18', 'min' => '0' , 'step' => 'any' , 'readonly', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                                if(this.value<0){this.value='0'}" ]) !!}
                                                @if($errors->has('details[nilai_cif]'))
                                                    <span class="error text-danger">{{ $errors->first('details[nilai_cif]') }}</span>
                                                @endif
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-md-4 bg-transparent border-dashed border-1  rounded p-3" style="margin-bottom:10px;">
                                        <h2 class="fw-bolder mt-4"> <label class="form-label "><b>Harga Lainnya</b></label></h2>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label class="form-label">Biaya Penambah</label>
                                                {!! Form::number('details[biaya_penambah]', @$inbound->details['biaya_penambah'] ?: 0, ['class' => 'form-control bg-secondary', 'step' => 'any', 'readonly' => 'readonly','required' => true, 'placeholder' => 'Input', 'id' => 'biaya_penambah']) !!}
                                                @if($errors->has('details[biaya_penambah]'))
                                                    <span class="error text-danger">{{ $errors->first('details[biaya_penambah]') }}</span>
                                                @endif
                                            </div>

                                            <div class="col-md-12">
                                                <label class="form-label">Biaya Pengurang</label>
                                                {!! Form::number('details[biaya_pengurang]', @$inbound->details['biaya_pengurang'] ?: 0, ['class' => 'form-control bg-secondary', 'step' => 'any', 'readonly' => 'readonly','required' => true, 'placeholder' => 'Input', 'id' => 'biaya_pengurang']) !!}
                                                @if($errors->has('details[biaya_pengurang]'))
                                                    <span class="error text-danger">{{ $errors->first('details[biaya_pengurang]') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Freight</label>
                                                {!! Form::number('details[freight]', @$inbound->details['freight'] ?: 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'freight',  'maxlength' => '18', 'min' => '0', 'readonly', 'step' => 'any' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                                if(this.value<0){this.value='0'}" ]) !!}
                                                @if($errors->has('details[freight]'))
                                                    <span class="error text-danger">{{ $errors->first('details[freight]') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Asuransi</label> 
                                                <select  class="form-control bg-secondary" name="details[asuransi]" id="details[asuransi]" data-control="select2">
                                                    <option value="" disabled selected>--Select--</option>
                                                    <option value="1" {{ $inbound->details['asuransi'] == "0" ? 'selected' : '' }}>Dalam Negeri</option>
                                                    <option value="2" {{ $inbound->details['asuransi'] == "1" ? 'selected' : '' }}>Luar Negeri</option>
                                                </select>
                                                @if($errors->has('details[type_asuransi]'))
                                                    <span class="error text-danger">{{ $errors->first('details[type_asuransi]') }}</span>
                                                @endif 
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Nilai Asuransi</label>
                                                {!! Form::number('details[asuransi]', @$inbound->details['asuransi'] ?: 0, ['class' => 'form-control bg-secondary','readonly' => 'readonly', 'required' => true, 'placeholder' => 'Input', 'id' => 'asuransi',  'maxlength' => '18', 'min' => '0', 'step' => 'any' , 'readonly', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                                if(this.value<0){this.value='0'}" ]) !!}
                                                @if($errors->has('details[asuransi]'))
                                                    <span class="error text-danger">{{ $errors->first('details[asuransi]') }}</span>
                                                @endif
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <label class="form-label">Voluntary Declaration</label>
                                                {!! Form::number('details[voluntary_declaration]', @$inbound->details['voluntary_declaration'] ?: 0, ['class' => 'form-control bg-secondary', 'step' => 'any' ,'readonly' => 'readonly','required' => true, 'placeholder' => 'Input', 'id' => 'voluntary_declaration']) !!}
                                                @if($errors->has('details[voluntary_declaration]'))
                                                    <span class="error text-danger">{{ $errors->first('details[voluntary_declaration]') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 bg-transparent border-dashed border-1  rounded p-3" style="margin-bottom:10px;" >
                                        <h2 class="fw-bolder mt-4"> <label class="form-label "><b>Berat</b></label></h2>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label class="form-label">Bruto</label>
                                                {!! Form::number('details[berat_kotor]', @$inbound->details['berat_kotor'] ?: 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'berat_kotor', 'step' => 'any' , 'maxlength' => '18', 'min' => '0' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                                if(this.value<0){this.value='0'}" ]) !!}
                                                @if($errors->has('details[berat_kotor]'))
                                                    <span class="error text-danger">{{ $errors->first('details[berat_kotor]') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Netto</label>
                                                {!! Form::number('details[berat_bersih]', @$inbound->details['berat_bersih'] ?: 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'berat_bersih' , 'step' => 'any' ,  'maxlength' => '18', 'min' => '0', 'readonly', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                                if(this.value<0){this.value='0'}" ]) !!}
                                                @if($errors->has('details[berat_bersih]'))
                                                    <span class="error text-danger">{{ $errors->first('details[berat_bersih]') }}</span>
                                                @endif
                                            </div> 
                                        </div>       
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-barang" role="tabpanel" aria-labelledby="nav-barang-tab">
                                <h2 class="fw-bolder mt-4">Barang</h2>
                                <div class="form-group row" style="margin-top:10px;">
                                     <a href="javascript:void(0);" id="btn-download-barang" data-bs-toggle="modal" data-bs-target="#upload-modal" class="btn btn-light-success">
                                        <i class="la la-upload"></i>Download Barang
                                    </a> 
                                    <div class="col-md-12"> 
                                        @include('inbound.components.detail.goods_table')
                                    </div>
                                    {!! Form::hidden('list_barang', null, ['id' => 'list_barang']) !!}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-pungutan" role="tabpanel" aria-labelledby="nav-pungutan-tab">
                                <div class=" bg-transparent border-dashed border-1 p-3 row rounded" style="border-color:lightgrey; margin-top:10px;">
                                    @include('ftz.ftz0101.detail.partials.pungutan') 
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-pernyataan" role="tabpanel" aria-labelledby="nav-pernyataan-tab">
                                <div class=" bg-light-primary border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                                        <p>
                                            Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal yang diberitahukan dalam
                                            pemberitahuan pabean ini
                                        </p>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label class="form-label required">Tempat</label>
                                            {!! Form::select('city_id', $citySelectBox,$inbound->city_id ?? '', ['class' => 'form-select bg-secondary', 'disabled' => true,  'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                                            @if($errors->has('city_id'))
                                                <span class="error text-danger">{{ $errors->first('city_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label required">Tanggal</label>
                                            {!! Form::text('details[pabean_tanggal]', @$inbound->details['pabean_tanggal'] ?: null, ['class' => 'form-control datepicker bg-secondary', 'disabled' => true,  'required' => true, 'placeholder' => 'input Tanggal']) !!}
                                            @if($errors->has('details[pabean_tanggal]'))
                                                <span class="error text-danger">{{ $errors->first('details[pabean_tanggal]') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label required">Pemberitahu</label>
                                            {!! Form::text('details[pabean_pemberitahu]', @$inbound->details['pabean_pemberitahu'] ?: null, ['class' => 'form-control bg-secondary', 'disabled' => true,  'required' => true, 'placeholder' => 'Input Pemberi Tahu','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                            @if($errors->has('details[pabean_pemberitahu]'))
                                                <span class="error text-danger">{{ $errors->first('details[pabean_pemberitahu]') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label required">Jabatan</label>
                                            {!! Form::text('details[pabean_jabatan]', @$inbound->details['pabean_jabatan'] ?: null, ['class' => 'form-control bg-secondary', 'disabled' => true,  'required' => true, 'placeholder' => 'Input Jabatan','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                            @if($errors->has('details[pabean_jabatan]'))
                                                <span class="error text-danger">{{ $errors->first('details[pabean_jabatan]') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('ftz.components.edit.edit_modal', ['bc' => 'FTZ0101'])
                        </div>   
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
        const inbound = @json($inbound);
        var inboundDetails = inbound.inbound_details;
        const inboundDocuments = inbound.inbound_documents;
        console.log(inboundDocuments);
        var selectedInboundDetail = {};
        const refreshGoodsInfo = () => {
            $('#list_barang').val(JSON.stringify(inboundDetails));
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

            inboundDetails.forEach((item) => {
                totalVolume += parseFloat(item.volume);
                totalBeratBersih += parseFloat(item.nett_weight);
                // totalBeratKotor += parseFloat(item.nett_weight);
                totalFob += parseFloat(item.details.fob);
                totalNilaiCif += parseFloat(item.details.nilai_cif);
                totalFreight += parseFloat(item.details.freight);

                // News
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

            $('#table').DataTable().clear().rows.add(inboundDetails).draw()

            return true;
        }

       
        $(document).ready(function() {

            

            $('#nav-tab a[href="#nav-header"]').tab('show') // Select tab by name
            $('#nav-tab a').on('click', function (e) {
                e.preventDefault()
                $(this).tab('show')
            })
            $('#create-form').submit(function(e){
                if (inboundDetails.length == 0) {
                    e.preventDefault();
                    Swal.fire('Error', 'Goods is required', 'error')
                }
                
                var bruto = $('#berat_kotor').val();
                var netto = $('#berat_bersih').val(); 

                if(parseFloat(bruto) < parseFloat(netto)
                || parseFloat(bruto) == 0){
                    e.preventDefault();
                    Swal.fire('Error', `Netto must not be more than Bruto`, "error")
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
                    Swal.fire('Error', 'Faktur Pajak is required', 'error');
                }

                if(manyFakturPajak > 1){
                    e.preventDefault();
                    Swal.fire('Error', 'Faktur Pajak can just one', 'error')
                }

            })
        })

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

        $('#penjual_barang_id').on('change', function() {
            $('#negara_penjual_barang').val("");
            $('#alamat_penjual_barang').val("");
            $('#tipe_identitas_penjual_barang').val("");
            $('#nomor_identitas_penjual_barang').val("");
            if(this.value == ""){
                $('#penjual_barang_info').addClass("d-none");
            }else{
                $('#penjual_barang_info').removeClass("d-none");
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
            }else{
                $('#pengirim_barang_info').removeClass("d-none");
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

        $('#pemusatan_barang_id').on('change', function() {
            $('#pemusatan_tipe_identitas').val("");
            $('#pemusatan_nomor_identitas').val("");
            $('#pemusatan_nomor_izin').val("");
            $('#pemusatan_alamat').val("");
            $('#pemusatan_country').val("");
            if(this.value == ""){
                $('#pemusatan_info').addClass("d-none");
            }else{
                $('#pemusatan_info').removeClass("d-none");
            }
            var pemusatan_id = this.value;
            if(pemusatan_id != ""){
                $.ajax({
                    type: "GET",
                    url: '{{url('/')}}/master-data/profile/detail/'+pemusatan_id,
                    success: function(res) {
                        $('#pemusatan_tipe_identitas').html(res['tipe_identitas']);
                        $('#pemusatan_nomor_identitas').html(res['nomor_identitas']);
                        $('#pemusatan_nomor_izin').html(res['nomor_izin']);
                        $('#pemusatan_alamat').html(res['address']);
                        $('#pemusatan_country').html(res['name_country']);
                    },
                    error: function(res) {
                        console.log(res.responseJSON.message);
                    }
                })

            }
        });

        $('#ppjk_id').trigger("change");
        $('#importir_id').trigger("change");
        $('#pemilik_barang_id').trigger("change");
        $('#penjual_barang_id').trigger("change");
        $('#pengirim_barang_id').trigger("change");
        $('#pemusatan_barang_id').trigger("change");

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


    </script>
@endpush
