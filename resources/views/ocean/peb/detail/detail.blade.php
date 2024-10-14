@extends("layouts.main")
@section('content')
    @include("components.toolbar", ['parentMenuName' => 'Inbound', 'menuName' => 'BC23'])
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container">
                @if($inbound->partial == 1 && $inbound->status_id == $idDone)  
                    <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10"  >
                        <!--begin::Icon-->
                        <!--begin::Svg Icon | path: icons/duotone/Interface/Comment.svg-->
                        <span class="svg-icon svg-icon-2hx svg-icon-danger me-4 mb-5 mb-sm-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.25" fill-rule="evenodd" clip-rule="evenodd" d="M5.69477 2.48932C4.00472 2.74648 2.66565 3.98488 2.37546 5.66957C2.17321 6.84372 2 8.33525 2 10C2 11.6647 2.17321 13.1563 2.37546 14.3304C2.62456 15.7766 3.64656 16.8939 5 17.344V20.7476C5 21.5219 5.84211 22.0024 6.50873 21.6085L12.6241 17.9949C14.8384 17.9586 16.8238 17.7361 18.3052 17.5107C19.9953 17.2535 21.3344 16.0151 21.6245 14.3304C21.8268 13.1563 22 11.6647 22 10C22 8.33525 21.8268 6.84372 21.6245 5.66957C21.3344 3.98488 19.9953 2.74648 18.3052 2.48932C16.6859 2.24293 14.4644 2 12 2C9.53559 2 7.31411 2.24293 5.69477 2.48932Z" fill="#191213"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7 7C6.44772 7 6 7.44772 6 8C6 8.55228 6.44772 9 7 9H17C17.5523 9 18 8.55228 18 8C18 7.44772 17.5523 7 17 7H7ZM7 11C6.44772 11 6 11.4477 6 12C6 12.5523 6.44772 13 7 13H11C11.5523 13 12 12.5523 12 12C12 11.4477 11.5523 11 11 11H7Z" fill="#121319"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <!--end::Icon-->
                        <!--begin::Content-->
                        <div class="d-flex flex-column pe-0 pe-sm-10">
                            <h5 class="mb-1">Info Partial</h5>
                            <span>Silahkan Input partial barang di selesaikan agar inbound {{ $inbound->request_number }} ini masuk ke inventory ! </span>
                        </div>
                        <!--end::Content-->
                        <!--begin::Close-->
                        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                            <i class="bi bi-x fs-1 text-danger"></i>
                        </button>
                        <!--end::Close-->
                    </div> 
                @endif
                <!--begin::Card-->
                <div class="card ">
                    <div class="card-header card-header-stretch">
                        <h3 class="card-title">Detail BC23, Nomor Pengajuan : {{$inbound->request_number}}</h3>
                        <div class="card-toolbar">
                        <span style="margin-top:10px; ">
                                @if($canDone) 
                                        <button type="button" id="btn-sppd" class="btn btn-light-primary ">
                                            <i class="fas fa-thumbs-up"></i>SPPD 
                                        </button> 
                                @else 
                                        <a href="{{ $mainUrl . '/pdf/' . $inbound->id }}" type="button" id="btn-done" class="btn btn-light-danger ">
                                        <i class="fas fa-file-pdf"></i>Export PDF
                                        </a> 
                                @endif
                                <a href="/inbound/bc-23" id="" class="btn btn-light me-3"><i class="fas fa-chevron-left"></i> Back</a>
                             </span> 
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                             
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
                            <div class=" bg-transparent border-dashed border-1 p-3 row rounded" style="border-color:lightgrey ">
                                <h2 class="fw-bolder mt-4">BC 1.1</h2>
                                                                <div class="form-group row" style="margin-top:10px;margin-left: 0px">
                                    <div class="col">
                                        <div class=" bg-transparent border-dashed border-1 p-3 row rounded" style="border-color:lightgrey ">
                                            <div class="col-md-4" style="margin-top:10px;">
                                                <label class="form-label">No Pos Dokumen BC 1.1</label>
                                                <p>{{ $dokubc11->nomor_dokumen  ?? '' }}</p>

                                            </div>
                                            <div class="col-md-4">
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
                            <div class="form-group row" style="margin-top:10px;">
                                    <div class="col-md-4">
                                        <label class="form-label required">Kantor Pabean Bongkar</label>
                                        <p>{{$inbound->inboundKppbcBongkar->masterKppbc->description}}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label required">Kantor Pabean Pengawas</label>
                                        <p> {{$inbound->inboundKppbcPengawas->masterKppbc->description}}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label required">Jenis TPB</label>
                                        <p> {{$inbound->inboundJenisTpb->masterJenisTpb->name }}</p>
                                    </div>
                            </div>
                            <div  class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey;margin-top:10px; ">
                                <div class="form-group row" >

                                    <div class="col-md-4" style="margin-bottom:10px;">
                                        <h2 class="fw-bolder mt-4"> <label class="form-label required">Importir</label></h2>


                                        {!! Form::select('importir_id', $importirSelectBox, $inbound->inboundImportir->profile_id ?? '', ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --','id'=>'importir_id','disabled' => 'true']) !!}
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
                                        <h2 class="fw-bolder mt-4"><label class="form-label required">Pemasok Barang</label></h2>


                                        {!! Form::select('pemasok_barang_id', $pemasokBarangSelectBox, $inbound->inboundPemasokBarang->profile_id ?? '', ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id'=>'pemasok_barang_id','disabled' => 'true']) !!}
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

                                    <div class="col-md-4">
                                        <h2 class="fw-bolder mt-4"> <label class="form-label required">Pemilik Barang</label></h2>


                                        {!! Form::select('pemilik_barang_id', $pemilikBarangSelectBox, $inbound->inboundPemilikBarang->profile_id ?? '', ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id'=>'pemilik_barang_id','disabled' => 'true']) !!}
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


                                        {!! Form::select('ppjk_id', $ppjkSelectBox, $inbound->inboundPpjk->profile_id ?? '', ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id'=>'ppjk_id','disabled' => 'true']) !!}
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
                                </div>
                            </div>
                            @include('inbound.bc23.detail.partials.transport')
                            <div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                                <h2 class="fw-bolder mt-4">Transaksi</h2>
                                <div class="form-group row" style="margin-top:10px;">
                                    <div class="col-md-4">
                                        <label class="form-label required">Valuta</label>
                                        <p>{{ $inbound->inboundValas->masterValas->name }} </p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">NDPBM</label>
                                        <p>{{@$inbound->details['ndpbm'] ?? 0}} </p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">FOB / Harga Detil</label>
                                        <p>{{@$inbound->details['fob'] ?? 0}} </p>
                                    </div>
                                </div>

                                <div class="form-group row" style="margin-top:10px;">
                            
                                    <div class="col-md-4">
                                        <label class="form-label">Freight</label>
                                        <p>{{@$inbound->details['freight'] ?? 0}} </p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Asuransi LN/DN</label>
                                        <p>{{@$inbound->details['asuransi'] ?? 0 }} </p>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Nilai CIF</label>
                                        <p>{{@$inbound->details['nilai_cif'] ?? 0}} </p>
                                    </div>
                                </div>

                                <div class="form-group row" style="margin-top:10px;">
                            
                                    <div class="col-md-4">
                                        <label class="form-label">CIF RP</label>
                                        <p>{{@$inbound->details['cif_rp'] ?? 0}} </p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Biaya Penambah</label>
                                        <p>{{@$inbound->details['biaya_penambah'] ?? 0}} </p>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Biaya Pengurang</label>
                                        <p>{{@$inbound->details['biaya_pengurang'] ?? 0}} </p>
                                    </div>
                                </div>
                            </div>

                            <div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                                <div class="form-group row" style="margin-top:10px;">
                                    <h2 class="fw-bolder mt-4">Peti Kemas</h2>
                                    <div class="col-md-3">
                                        <label class="form-label required">Nomor</label>
                                        <p>{{$inbound->details['nomor_peti_kemas'] ?? '' }}  </p>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label required">Ukuran</label>
                                        <p>{{$inbound->ukuranPetiKemas->name ?? '' }} </p>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label required">Jenis</label>
                                        <p>{{$inbound->details['jenis_peti_kemas'] ?? '' }} </p>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label required">Tipe</label>
                                        <p>{{$inbound->typePetiKemas->name ?? '' }} </p>
                                    </div>
                                </div>
                            </div>
                            <div class=" bg-light-grey border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                            @include('inbound.components.detail.documents_table')
                            </div>
                            <div class=" bg-light-grey border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-12">
                                    <h2 class="fw-bolder mt-4">Barang</h2>
                                    @include('inbound.components.detail.goods_table')
                                </div>
                                <hr class="mt-8">
                                <div class="col-md-3">
                                    <label class="form-label">Bruto</label>
                                    <p>{{@$inbound->details['berat_kotor'] ?: null}} </p>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Netto</label>
                                    <p>{{@$inbound->details['berat_bersih'] ?: null}}</p>
                                </div>
                            </div>

                            @include('inbound.bc23.detail.partials.pungutan')

                            {!! Form::hidden('list_barang', null, ['id' => 'list_barang']) !!}
                            </div>
                            <div class=" bg-light-primary border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                                <p>
                                    Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal yang diberitahukan dalam
                                    pemberitahuan pabean ini
                                </p>
                                <div class="form-group">
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label class="form-label required">Tempat</label>
                                            <p>{{@$inbound->city->city ?? ''}} </p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label required">Tanggal</label>
                                            <p>{{@$inbound->details['pabean_tanggal'] ?: null}}</p>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label required">Pemberitahu</label>
                                            <p>{{$inbound->details['pabean_pemberitahu'] ?: null}}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label required">Jabatan</label>
                                            <p>{{@$inbound->details['pabean_jabatan'] ?: null}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('inbound.components.detail.detail_modal', ['bc' => 'BC23'])
                    {{-- {!! Form::close() !!} --}}
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    {{-- </div> --}}
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
        $(document).ready(function() {
        })

        $('#pemilik_barang_id').on('change', function() {
            $('#negara_pemilik_barang').val("");
            $('#alamat_pemilik_barang').val("");
            $('#tipe_identitas_pemilik_barang').val("");
            $('#nomor_identitas_pemilik_barang').val("");
            var value_pemilik_barang_id = this.value;
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
                    Swal.fire("Error!", res.responseJSON.message, "error");
                }
            })
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
                    Swal.fire("Error!", res.responseJSON.message, "error");
                }
            })
        });

        $('#importir_id').on('change', function() {
            $('#importir_tipe_identitas').val("");
            $('#importir_nomor_identitas').val("");
            $('#importir_nomor_izin').val("");
            $('#importir_alamat').val("");
            $('#importir_country').val("");
            var value_id = this.value;
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
                    Swal.fire("Error!", res.responseJSON.message, "error");
                }
            })
        });

        $('#btn-sppd').on('click', function(e){
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Kamu tidak akan dapat mengembalikan datanya lagi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya, SPPD!',
                cancelButtonText : 'Batal',
                }).then((result) => {
                    if(result.isConfirmed){
                        window.location.href = `{{ $mainUrl . '/done/' . $inbound->id }}`;
                    }
            })

        });

        $('#ppjk_id').on('change', function() {
            $('#ppjk_npwp').val("");
            $('#ppjk_alamat').val("");
            $('#ppjk_no').val("");
            $('#ppjk_tanggal').val("");
            $('#ppjk_negara').val("");
            $('#ppjk_tipe_identitas').val("");
            $('#ppjk_nomor_identitas').val("");
            var value_ppjk_id = this.value;
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
                    Swal.fire("Error!", res.responseJSON.message, "error");
                }
            })
        });

        $('#ppjk_id').trigger("change");
        $('#importir_id').trigger("change");
        $('#pemilik_barang_id').trigger("change");
        $('#pemasok_barang_id').trigger("change");
    </script>
@endpush
