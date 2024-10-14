@extends("layouts.main")
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Goods</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="javascript::void();" class="text-muted text-hover-primary">Master Data</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ url('master-data/goods') }}" class="text-muted text-hover-primary">Goods</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Create</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    @if($errors->any())
    {!! implode('', $errors->all('<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-left: 20px;margin-right: 20px">
        <strong>:message</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>')) !!}
    @endif

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body pt-0" style="margin-top: 20px">
                    <!--begin:Form-->
                    <form action="{{url('master-data/goods/create')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label required">Code</label>
                                <input type="text" class="form-control " name="kode_barang" value="{{old('kode_barang')}}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label required">Name</label>
                                <input type="text" class="form-control " name="name" value="{{old('name')}}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label required">UOM</label>
                                <select name="uom_id" class="form-select detail-inputs form-control-solid " id="uom_id" required>
                                    @foreach($data_uom as $row)
                                    <option value="{{$row->id}}" {{ old('uom_id') == $row->id ? "selected" : "" }}>{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row" style="margin-top: 20px;">
                            {{-- <div class="col-md-3">
                        <label class="form-label required">Asal Barang</label>
                        {!! Form::select('asal_barang', $asalBarang, null, ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                    </div>
                    <div class="col-md-3">
                        <label class="form-label required">Amount</label>
                        <input type="number" class="form-control " name="amount" value="{{old('amount')}}" required>
                        </div> --}}
                        <div class="col-md-4">
                            <label class="form-label required">Jenis Barang</label>
                            {!! Form::select('jenis_barang', $jenisBarang, null, ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                        </div>
                        <div class="col-md-4">
                            <label class="form-label required">Nett Weight</label>
                            <div class="input-group mb-5">
                                <input type="number" class="form-control " step="any" name="nett_weight" value="{{old('nett_weight')}}" required>
                                <span class="input-group-text" id="">Kg</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label required">Volume</label>
                            <div class="input-group mb-5">
                                <input type="number" class="form-control " step="any" name="volume" value="{{old('volume')}}" required>
                                <span class="input-group-text" id="">m3</span>
                            </div>
                        </div>
                </div>
                <div class="form-group row mt-3">
                    <div class="col-md-4">
                        <label class="form-label required">Merk</label>
                        <input type="text" class="form-control " name="merk" value="{{old('merk')}}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label required">Tipe</label>
                        <input type="text" class="form-control " name="type" value="{{old('type')}}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label required">Ukuran</label>
                        <input type="text" class="form-control " name="ukuran" value="{{old('ukuran')}}" required>
                    </div>
                </div>
                <div class="form-group row mt-3">
                    <div class="col-md-6">
                        <label class="form-label required">Spesifikasi Lain</label>
                        <input type="text" class="form-control " name="spesifikasi_lain" value="{{old('spesifikasi_lain')}}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label required">Uraian barang</label>
                        <input type="text" class="form-control  " name="uraian" value="{{old('uraian')}}" required>
                    </div>
                </div>

                <!--begin::Actions-->
                <div class="text-center mt-10">
                    <button type="submit" class="btn btn-primary" style="width: 25%">Submit</button>
                </div>
                <!--end::Actions-->
                <!--end:Form-->
                </form>
            </div>
            <!--end::Card body-->
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

@push('js')
<script>
    $(document).ready(function() {

        // Initial Select2
        $('#uom_id').select2();

    });
</script>
@endpush