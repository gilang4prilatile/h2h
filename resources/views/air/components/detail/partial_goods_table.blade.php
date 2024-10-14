@extends("layouts.main")
@section('content')
@include("components.toolbar", ['parentMenuName' => 'Inbound', 'menuName' => $toolbar])
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <!--begin::Card-->
            <div class="card ">
                <div class="card-header card-header-stretch">
                    <h3 class="card-title">Detail Partial</h3>
                    <div class="card-toolbar mt-5">
                        <div class="float-right">
                            <a href="{{ $mainUrl.'/detail/'.$id }}" id="" class="btn btn-sm btn-light me-3 mb-5"><i class="fas fa-chevron-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                 
                    <div class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">Kode Barang &nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp; {{ $goods->kode_barang }}</div>
                    <div class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">Nama Barang &nbsp;&nbsp;: &nbsp;&nbsp; {{ $goods->name }}</div>
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="table">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">Kode Barang</th>
                                <th class="min-w-125px">Tanggal</th>
                                <th class="min-w-125px">Qty</th>
                                <th class="min-w-125px">Status</th>
                                <th class="min-w-125px">Keterangan</th>
                                <th class="min-w-125px">Action</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-bold">
                            @foreach ($datapartial as $datapartial)
                            
                                <tr>
                                    <td>{{ $datapartial->Sku_Barang }}</td>
                                    <td>{{ date('Y-m-d H:i', strtotime($datapartial->tanggal)) }}</td>
                                    <td>{{ floatVal($datapartial->Qty) }}</td>
                                    <td>
                                        @if($datapartial->status == 0)
                                            <span class="badge badge-light-warning">Siap SPPD</span>
                                        @elseif($datapartial->status == 1)
                                            <span class="badge badge-light-success">Sudah SPPD</span>
                                        @else
                                            <span class="badge badge-light-danger">Kondisi Lain</span>
                                        @endif
                                    </td>
                                    <td>{{ $datapartial->keterangan }}</td>
                                    <td>
                                        <button type="button" onclick="sppdAction({{ $datapartial->id }},'{{ $datapartial->Sku_Barang }}')" class="btn btn-sm btn-light-primary delete-button fas fa-thumbs-up {{ $datapartial->status == 0 ? '' : 'disabled' }}"> SPPD</button>
                                        <a href="inbound/bc-40/detail/partial/{{ $datapartial->id }}/{{ $datapartial->Sku_Barang }}/delete" class="btn btn-sm btn-light-danger delete-button fas fa-trash-alt {{ $datapartial->status != 1 ? '' : 'disabled' }}"> Delete</a>
                                    </td>
                                </tr>
                            
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table> 
                    <form method="POST" action="inbound/bc-40/detail/partial/{{ $id }}/{{ $sku }}/create">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mt-5">
                                    <label class="form-label required">Jumlah Partial</label>
                                    <input type="number" class="form-control" id="jumlah" name="jumlah_partial" placeholder="Input Jumlah Partial" step="any" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-5">
                                    <label class="form-label required">Tanggal Partial</label>
                                    <input type="text" class="form-control form-control-solid" id="kt_datepicker" name="tanggal_partial" placeholder="Pilih Tanggal" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-5">
                                    <label class="form-label required">Status</label>
                                    <select name="status" id="status" class="form-select" data-control="select2"  required>
                                        <option value="0">Siap SPPD</option>
                                        <option value="2">Kondisi Lain</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-5" id="container-keterangan" >
                            <label class="form-label required" for="keterangan required">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" cols="10" rows="5" placeholder="Keterangan Partial"></textarea>
                        </div>
                        <button type="submit" id="submit" class="btn btn-sm btn-primary mt-5">Submit</button>
                    </form>
                </div>
                {{-- {!! Form::close() !!} --}}
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>

@endsection

@push('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"
        integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    <script>


        function sppdAction(id, skuBarang)
        {
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
                        window.location.href = `inbound/bc-40/detail/partial/${id}/${skuBarang}/sppd`;
                    }
            })

        }

        $('#status').on('change', function(){

            if($(this).val() == 2){

                $('#container-keterangan').show();

            }else {
                $('#container-keterangan').hide();
            }

        });

        $('#status').trigger('change');
       
        $("#kt_datepicker").flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });
        
    </script>
@endpush
