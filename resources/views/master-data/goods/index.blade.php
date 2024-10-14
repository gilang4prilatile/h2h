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
                    <li class="breadcrumb-item text-muted">Index</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <!--begin::Filter-->
                            <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                <!--begin::Svg Icon | path: icons/duotone/Text/Filter.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z" fill="#000000" />
                                        </g>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->Filter
                            </button>
                            <div class="menu menu-sub menu-sub-dropdown w-400px w-md-500px ms-20" data-kt-menu="true">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Separator-->
                                <!--begin::Content-->
                                <form action="master-data/goods/filter" method="GET">
                                    @csrf
                                    <div class="px-7 py-5 row" data-kt-user-table-filter="form">
                                        <!--begin::Input group-->
                                        <div class="col-12 col-md-6">
                                            <div class="mb-10">
                                                <label class="form-label fs-6 fw-bold">Code</label>
                                                {!! Form::text('kode_barang', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
                                            </div>

                                            <div class="mb-10">
                                                <label class="form-label fs-6 fw-bold">Nama</label>
                                                {!! Form::text('name', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="mb-10">
                                                <label class="form-label fs-6 fw-bold">Merk</label>
                                                {!! Form::text('merk', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
                                            </div>

                                            <div class="mb-10">
                                                <label class="form-label fs-6 fw-bold">Asal Barang</label>
                                                {!! Form::select('asal_barang', $asal_barang, null, ['class' => 'form-select', 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="mb-10">
                                                <label class="form-label fs-6 fw-bold">Jenis Barang</label>
                                                {!! Form::select('jenis_barang', $jenis_barang, null, ['class' => 'form-select', 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary fw-bold px-6" data-kt-menu-dismiss="true" data-kt-user-table-filter="filter" id="filter">Apply</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                </form>
                                <!--end::Content-->
                            </div>
                            <!--end::Menu 1-->
                            <!--end::Filter-->
                            <!--begin::Add user-->
                            @can('create master-data goods')
                            <a href="{{url('master-data/goods/create')}}" type="button" class="btn btn-primary sm">
                                <!--begin::Svg Icon | path: icons/duotone/Navigation/Plus.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1" />
                                        <rect fill="#000000" opacity="0.5" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)" x="4" y="11" width="16" height="2" rx="1" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->Add
                            </a>
                            @endcan
                            <!--end::Add user-->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="table">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">No</th>
                                <th class="min-w-125px">Kode Barang</th>
                                <th class="min-w-200px">Name</th>
                                <th class="min-w-50px">Nett Weight</th>
                                <th class="min-w-50px">Volume</th>
                                <th class="min-w-125px">Jenis Barang</th>
                                <th class="text-center min-w-100px">Actions</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-bold">
                            @foreach($data_dk as $index=> $row)
                            <tr>
                                <td>{{$index + 1 ?? '' }}</td>
                                <td>{{$row->details['kode_barang'] ?? '' }}</td>
                                <td>{{$row->name ?? '' }}</td>
                                <td>{{ round($row->nett_weight, 2) ?? ''}}</td>
                                <td>{{ round($row->volume, 2) ?? ''}}</td>
                                <td>{{$row->details['jenis_barang'] ?? ''}}</td>
                                <td>
                                    @can('edit master-data goods')
                                    <a href="{{url('master-data/goods/update')}}/{{$row->id}}" type="button" class="btn btn-light-warning btn-sm fas fa-edit fs-4">
                                    </a>
                                    @endcan
                                    @can('delete master-data goods')
                                    <button type="button" onclick="deleteData('{{url('master-data/goods/delete')}}/{{$row->id}}')" class="btn btn-light-danger btn-sm fas fa-trash-alt fs-4">
                                    </button>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
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
<script>
    $(document).ready(function() {
        var table = $('#table').DataTable();

        $("#filter").on("click", function() {
            table.draw();
        });
    });
</script>
@endpush