@extends("layouts.main")
@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        @include("components.toolbar", ['parentMenuName' => 'Outbound', 'menuName' => 'BC27'])
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
                                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                                    data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                    <!--begin::Svg Icon | path: icons/duotone/Text/Filter.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z"
                                                    fill="#000000" />
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->Filter
                                </button>
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Separator-->
                                    <!--begin::Content-->
                                    {!! Form::open(['id' => 'form']) !!}
                                    <div class="px-7 py-5" data-kt-user-table-filter="form">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-bold">No Pengajuan</label>
                                            {!! Form::text('nomor_pengajuan', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-bold">No Pendaftaran</label>
                                            {!! Form::text('nomor_pendaftaran', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary fw-bold px-6"
                                                data-kt-menu-dismiss="true" data-kt-user-table-filter="filter"
                                                id="filter">Apply</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    {!! Form::close() !!}
                                    <!--end::Content-->
                                </div>
                                @can('create outbound bc-27')
<x-link-add-new />
@endcan
                                <!--end::Menu 1-->
                                <!--end::Filter-->
                                <!--begin::Add user-->
                                <!-- @can(getUrlAction('create')) -->

                                <!-- @endcan -->
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
                                    <th class="min-w-125px">Nomor Pengajuan</th>
                                    <th class="min-w-125px">Nomor Pendaftaran</th>
                                    <th class="min-w-125px">Tanggal Dibuat</th>
                                    <th class="min-w-125px">Dibuat Oleh</th>
                                    <th class="text-end min-w-100px">Action</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="text-gray-600 fw-bold">

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
        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ $mainUrl }}/data",
                data: function(d) {
                    d.form = $('#form').serialize();
                }
            },
            columns: [
                {
                    data: 'request_number',
                    name: 'request_number',
                },
                {
                    data: 'details.nomor_pendaftaran',
                    name: 'details.nomor_pendaftaran',
                    defaultContent: '',
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    render: (d) => new Date(d).toLocaleString()
                },
                {
                    data: 'created_by.name',
                    name: 'created_by.name'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    className : "text-end",
                    'ordering': false,
                    'width': '20%',
                },
            ]
        });

        $("#filter").on("click", function() {
            table.draw();
        });
    });
</script>
@endpush
