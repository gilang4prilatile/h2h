@extends("layouts.main")
@section('content')
    @include("components.toolbar", ['parentMenuName' => 'Outbound', 'menuName' => 'BC41'])
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
                    <div class="card-header card-header-stretch">
                        <h3 class="card-title">Detail BC41</h3>
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
                             <a href="/inbound/bc-41" id="" class="btn btn-light me-3"><i class="fas fa-chevron-left"></i> Back</a>
                             </span> 
                        </div> 
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                             
                            <div class=" bg-light-grey border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label class="form-label required">Nomor Pengajuan</label>
                                        <p>{{ $outbound->request_number }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label required">Nomor Pendaftaran</label>
                                        <p>{{ $outbound->details['nomor_pendaftaran'] }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label required">Tanggal Pendaftaran</label>
                                        <p>{{ $outbound->details['tanggal_pendaftaran'] }}</p>
                                    </div>

                                  
                                </div>
                            </div>
                            <div class=" bg-light-grey border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                                <div class="form-group row" >
                                    <div class="col-md-4">
                                        <label class="form-label required">Kantor Pabean</label>
                                        <p>{{ $outbound->outboundKppbc->masterKppbc->description }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label required">Jenis TPB</label>
                                        <p>{{ $outbound->outboundJenisTpb->masterJenisTpb->name }}</p>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label required">Tujuan Pengiriman</label>
                                        <p>{{ $outbound->outboundTujuanPengiriman->masterTujuanPengiriman->name }}</p>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-6">
                                    <div  class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey ">
                                        <label class="form-label required " >Pengusaha TPB</label>
                                        {!! Form::select('tpb_id', $tpbSelectBox, $outbound->outboundTpb->profile_id ?? '', ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id' => 'tpb_id','disabled' => 'true']) !!}
                                        @if($errors->has('tpb_id'))
                                            <span class="error text-danger">{{ $errors->first('tpb_id') }}</span>
                                        @endif
                                        <div class="card p-1  " style="margin-top: 10px" id="tpb_info">
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

                                <div class="col-md-6 ">
                                    <div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey ">
                                        <label class="form-label required">Pengirim Barang</label>
                                        {!! Form::select('pengirim_barang_id', $pengirimBarangSelectBox, $outbound->outboundPengirimBarang->profile_id ?? '', [ 'class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --' ,'id'=>'pengirim_barang_id','disabled' => 'true']) !!}
                                        @if($errors->has('pengirim_barang_id'))
                                            <span class="error text-danger">{{ $errors->first('pengirim_barang_id') }}</span>
                                        @endif
                                        <div class="card  p-1 " style="margin-top: 10px" id="pengirim_barang_info">
                                            <table  class=" table align-middle  table-row-dashed table-row-gray-400 fs-8 dataTable no-footer text-gray-600" role="grid" aria-describedby="table_info">
                                                <tbody>
                                                <tr>
                                                    <td class="d-flex p-1">
                                                        <div>Tipe Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='tipe_identitas_pengirim_barang'>Pilih pengirim barang</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="d-flex p-1">
                                                        <div>Nomor Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='nomor_identitas_pengirim_barang'>Pilih pengirim barang</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="d-flex p-1">
                                                        <div>Country : &nbsp;</div><div class=" " readonly ='readonly'  id ='negara_pengirim_barang'>Pilih pengirim barang</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="d-flex p-1">
                                                        <div>Address : &nbsp;</div><div class=" " readonly ='readonly'  id ='alamat_pengirim_barang'>Pilih pengirim barang</div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" bg-light-grey border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                                <div class="form-group row" >
                                    <h2 class="fw-bolder mt-4">Pengangkutan</h2>

                                    <div class="col-md-4">
                                        <label class="form-label required">Jenis Sarana Pengangkutan Darat</label>
                                        <p>{{ $outbound->outboundTransportation->transportation->name }}</p>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label required">Nomor Polisi</label>
                                        <p>{{ $outbound->outboundTransportation->vehicle_number }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label ">Jenis Kedatangan barang</label>
                                        @if($outbound->partial == 1)
                                            <p>Pengiriman Partial</p>
                                        @else
                                            <p>Tidak Partial</p>
                                        @endif
                                    </div>
                              
                                </div>
                            </div>


                            <div class=" bg-light-grey border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                                <div class="form-group row" >
                                    <div class="col-md-12">
                                        <h2 class="fw-bolder mt-4">Dokumen</h2>
                                        @include('outbound.components.detail.documents_table')
                                    </div>
                                </div>
                            </div>
                            <div class=" bg-light-grey border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                                <div class="form-group row" >
                                    <div class="col-md-12">
                                        <h2 class="fw-bolder mt-4">Barang</h2>
                                        @include('outbound.components.detail.goods_table')
                                    </div>
                                    <hr class="mt-8">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label required">Harga Penyerahan</label>
                                            <p>{{ $outbound->details['harga_penyerahan'] }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Volume (m3)</label>
                                            <p>{{ $outbound->details['volume'] }}</p>
                                        </div>
    
                                        <div class="col-md-3">
                                            <label class="form-label">Berat Kotor (Kg)</label>
                                            <p>{{ $outbound->details['berat_kotor'] }}</p>
                                        </div>
    
                                        <div class="col-md-3">
                                            <label class="form-label">Berat Bersih (Kg)</label>
                                            <p>{{ $outbound->details['berat_bersih'] }}</p>
                                        </div>
                                    </div>
                                </div>
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
                                            <p>{{ $outbound->city->city ?? ''}}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label required">Tanggal</label>
                                            <p>{{ $outbound->details['pabean_tanggal'] }}</p>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label required">Pemberitahu</label>
                                            <p>{{ $outbound->details['pabean_pemberitahu'] }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label required">Jabatan</label>
                                            <p>{{ $outbound->details['pabean_jabatan'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- {!! Form::close() !!} --}}
                    @include('outbound.components.detail.detail_modal', ['bc' => 'BC41'])
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
        const outbound = @json($outbound);
        const outboundDetails = outbound.outbound_details;
        const outboundDocuments = outbound.outbound_documents;
        const outboundPackages = outbound.outbound_packages;
        const inventoryOutboundDetails = outbound.inventory_outbound_detail;

        $('#pengirim_barang_id').on('change', function() {
            $('#tipe_identitas_pengirim_barang').val("");
            $('#nomor_identitas_pengirim_barang').val("");
            $('#negara_pengirim_barang').val("");
            $('#alamat_pengirim_barang').val("");
            $('#warehouse_tpb').val("");
            var value_pengirim_barang_id = this.value;
            console.log(this.value);
            $.ajax({
                type: "GET",
                url: '{{url('/')}}/master-data/profile/detail/'+value_pengirim_barang_id,
                success: function(res) {
                    $('#tipe_identitas_pengirim_barang').html(res['details'].tipe_identitas);
                    $('#nomor_identitas_pengirim_barang').html(res['details'].nomor_identitas);
                    $('#negara_pengirim_barang').html(res['name_country']);
                    $('#alamat_pengirim_barang').html(res['address']);
                    $('#warehouse_tpb').html(res['name_warehouse']);




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

        $('#tpb_id').trigger('change');
        $('#pengirim_barang_id').trigger('change');
    </script>
@endpush
