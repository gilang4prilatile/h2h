@extends("layouts.main")
@section('content')
    @include("components.toolbar", ['parentMenuName' => 'Outbound', 'menuName' => 'BC25'])
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container">
                @if($outbound->partial == 1)  
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
                            <span>Silahkan Input partial barang di selesaikan agar outbound {{ $outbound->request_number }} Selesai ! </span>
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
                    <div class="card-header card-header-stretch mt-8">
                        <h3 class="card-title">Detail BC25</h3>
                        <div class="card-toolbar">
                            <span style="margin-top:10px; ">
                            @if($canDone) 
                                     <button type="button" id="btn-sppd" class="btn btn-light-primary ">
                                        <i class="fas fa-thumbs-up"></i>SPPD 
                                     </button> 
                             @else 
                                     <a href="{{ $mainUrl . '/pdf/' . $outbound->id }}" type="button" id="btn-done" class="btn btn-light-danger ">
                                     <i class="fas fa-file-pdf"></i>Export PDF
                                     </a> 
                             @endif
                             <a href="/inbound/bc-25" id="" class="btn btn-light me-3"><i class="fas fa-chevron-left"></i> Back</a>
                             </span> 
                        </div> 
                    </div>
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

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-detil" role="tabpanel" aria-labelledby="nav-detil-tab">
                            <div class="card-body">
                                <div class="form-group">
                                    
                                    <div class=" bg-light-grey border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label class="form-label required">Nomor Pengajuan</label>
                                                <p>{{$outbound->request_number}}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label required">Nomor Pendaftaran</label>
                                                <p>{{$outbound->details['nomor_pendaftaran'] ?: null}}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label required">Tanggal Pendaftaran</label>
                                                <p>{{@$outbound->details['tanggal_pendaftaran'] ?: null,}}</p>
                                            </div>
                                        </div>
                                        <div class="form-group row" style="margin-top:10px;">
                                            <div class="col-md-4">
                                                <label class="form-label required">Kantor Pabean</label>
                                                <p>{{$outbound->outboundKppbc->masterKppbc->description}}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label required">Jenis TPB</label>
                                                <p>{{$outbound->outboundJenisTpb->masterJenisTpb->name}}</p>
                                            </div>
                                        </div>
                                        <div class="form-group row" style="margin-top:10px;">
                                            <div class="col-md-4">
                                                <div  class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey ">
                                                    <label class="form-label required " >Pengusaha TPB</label>
                                                    {!! Form::select('tpb_id', $tpbSelectBox, $outbound->outboundTpb->profile_id ?? '', ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id' => 'tpb_id','disabled' => 'true']) !!}
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
                                                    {!! Form::select('pemilik_barang_id', $pemilikBarangSelectBox, $outbound->outboundPemilikBarang->profile_id ?? '', [ 'class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --' ,'id'=>'pemilik_barang_id','disabled' => 'true']) !!}
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
                                                    {!! Form::select('penerima_barang_id', $penerimaBarangSelectBox, $outbound->outboundPenerimaBarang->profile_id ?? '', [ 'class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --' ,'id'=>'penerima_barang_id','disabled' => 'true']) !!}
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
                                    </div>
    
                                    @include('outbound.bc25.detail.partials.transport')

                                    <div class="form-group row" style="margin-top:10px;">
                                        <h2 class="fw-bolder mt-4">Transaksi</h2>
                                        <div class="form-group row border-dashed border-1 rounded p-3" style="border-color:lightgrey;margin-top: 10px;">
                                            <div class="col-md-12" style="background-color: lightblue;padding:5px; ">
                                                <label class="form-label required">Tipe Perhitungan</label>
                                                {!! Form::select('details[type_calculate]', [0 => 'Perhitungan Korversi', 1 => 'Perhitungan Bahan Baku'], @$outbound->details["type_calculate"] ?: 0   , ['class' => 'form-select',  'placeholder' => '-- Select --', 'id' => 'type-calculate' , 'data-control' => 'select2', 'disabled']) !!}
                                            </div>
                                        </div>    
                                        <div class="form-group row" style="margin-top:10px;">
                                            <div class="col-md-6">
                                                <label class="form-label required">Valuta</label>
                                                <p>{{ $outbound->outboundValas->masterValas->name }} </p>
                                            </div>
            
                                            <div class="col-md-6">
                                                <label class="form-label required">NDPBM</label>
                                                <p>{{ @$outbound->details["ndpbm"] }}</p>
                                            </div>
        
                                        </div>

                                        <div class="form-group row" style="margin-top:10px;">
                                            <div class="col-md-6">
                                                <label class="form-label required">Nilai Cif</label>
                                                <p>{{ @$outbound->details["nilai_cif"] }}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label required">Cif RP</label>
                                                <p>{{ @$outbound->details["cif_rp"] }}</p>
                                            </div>
                                        </div>

                                        <div class="form-group row" style="margin-top:10px;">
                                            <div class="col-md-12">
                                                <label class="form-label required">Harga Penyerahan</label>
                                                <p>{{ @$outbound->details["harga_penyerahan"] }}</p>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group row" style="margin-top:10px;">
                                        <h2 class="fw-bolder mt-4">Peti Kemas</h2>
                                        <div class="col-md-3">
                                            <label class="form-label required">Nomor</label>
                                            <p>{{$outbound->details['nomor_peti_kemas'] ?? '' }}  </p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label required">Ukuran</label>
                                            <p>{{$outbound->ukuranPetiKemas->name ?? '' }} </p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label required">Jenis</label>
                                            <p>{{$outbound->details['jenis_peti_kemas'] ?? '' }} </p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label required">Tipe</label>
                                            <p>{{$outbound->typePetiKemas->name ?? '' }} </p>
                                        </div>
                                    </div>

                                    <div class=" bg-light-grey border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                                        @include('outbound.components.detail.documents_table')
                                    </div>
                                    <div class=" bg-light-grey border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                                    <div class="form-group row" style="margin-top:10px;">
                                        <div class="col-md-12">
                                            <h2 class="fw-bolder mt-4">Barang</h2>
                                            @include('outbound.components.detail.goods_table')
                                        </div>
                                    </div>
                                    <hr class="mt-8">
                                    <div class="form-group row" style="margin-top:10px;">
                                        <div class="col-md-3">
                                            <label class="form-label ">Jenis Kedatangan barang</label>
                                            @if($outbound->partial == 1)
                                                <p>Pengiriman Partial</p>
                                            @else
                                                <p>Tidak Partial</p>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Volume (m3)</label>
                                            <p>{{$outbound->details["volume"] ?: 0}}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Berat Kotor (Kg)</label>
                                            <p>{{$outbound->details["berat_kotor"] ?: 0}}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Berat Bersih (Kg)</label>
                                            <p>{{$outbound->details["berat_bersih"] ?: 0}}</p>
                                        </div>
                                    </div>
                                    @include('outbound.bc25.detail.partials.pungutan')
    
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
                                                    <p>{{@$outbound->city->city ?? ''}}</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label required">Tanggal</label>
                                                    <p>{{@$outbound->details['pabean_tanggal'] ?: null}}</p>
                                                </div>
    
                                                <div class="col-md-3">
                                                    <label class="form-label required">Pemberitahu</label>
                                                    <p>{{$outbound->details['pabean_pemberitahu'] ?: null}}</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label required">Jabatan</label>
                                                    <p>{{@$outbound->details['pabean_jabatan'] ?: null}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div  class="tab-pane fade" id="nav-import" role="tabpanel" aria-labelledby="nav-import-tab">
                            @include("outbound.bc25.detail.partials.material_import")
                        </div>
                        <div class="tab-pane fade" id="nav-local" role="tabpanel" aria-labelledby="nav-local-tab">
                            @include("outbound.bc25.detail.partials.material_local")
                        </div>  
                    </div>
                    {{-- {!! Form::close() !!} --}}
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
        let outbound = @json($outbound);
        let outboundDetails = outbound.outbound_details;
        let outboundDocuments = outbound.outbound_documents;
        let inventoryOutboundDetails = outbound.inventory_outbound_detail;
        var selectedGoods = outboundDetails;
        var selectedImportGoods = [];
        var selectedLocalGoods  = [];

        $(document).ready(function(){

            $('#nav-tab a[href="#nav-detil"]').tab('show') // Select tab by name
            $('#nav-tab a').on('click', function (e) {
                e.preventDefault()
                $(this).tab('show')
            })

            changeTipeCalculate();

            $('#type-calculate').on('change', function(){
                changeTipeCalculate();
            });

            function changeTipeCalculate(){
                
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

                    $('#nav-import-tab').addClass('disabled');
                    $('#nav-local-tab').addClass('disabled');

                }else {

                    $("#tarif-fasilitas-conversion div").remove();
                    $("#satuan-berat-harga-conversion div").remove();
                    $('#nav-import-tab').removeClass('disabled');
                    $('#nav-local-tab').removeClass('disabled');
                }
                
            }

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
                        window.location.href = `{{ $mainUrl . '/done/' . $outbound->id }}`;
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
            console.log(this.value);
            var value_tpb_id = this.value;
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
                    Swal.fire("Error!", res.responseJSON.message, "error");
                }
            })
        });
        $('#pemilik_barang_id').on('change', function() {
            $('#tipe_identitas_pemilik_barang').val("");
            $('#nomor_identitas_pemilik_barang').val("");
            $('#negara_pemilik_barang').val("");
            $('#alamat_pemilik_barang').val("");
            $('#warehouse_pemilik_barang').val("");
            var value_pemilik_barang_id = this.value;
            console.log(this.value);
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
                    Swal.fire("Error!", res.responseJSON.message, "error");
                }
            })
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
            var value_pemilik_barang_id = this.value;
            console.log(this.value);
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
                    Swal.fire("Error!", res.responseJSON.message, "error");
                }
            })
        });

        $('#penerima_barang_id').trigger('change');
        $('#pemilik_barang_id').trigger('change');
        $('#tpb_id').trigger('change');
    </script>
@endpush
