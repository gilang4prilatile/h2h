@extends("layouts.main")
@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        @include("components.toolbar", ['parentMenuName' => 'BC20', 'menuName' => 'Pib'])
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
                                <a class="btn btn-light-primary me-3" href="{{ $mainUrl }}/export">
                                    Export
                                </a>
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-500px w-lg-1000px ms-20 overflow-auto h-300px"  data-kt-menu="true">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                    </div>
                                    
                                    <div class="separator border-gray-200"></div>
                                    
                                    {!! Form::open(['id' => 'form', 'method' => 'POST' , 'enctype' =>"multipart/form-data"]) !!}
                                        @csrf
                                        <div class="px-7 py-5 row" data-kt-user-table-filter="form">
                                            <div class="form-group row">
                                                <div class="col-md-3">  
                                                    <label class="form-label fs-6 fw-bold">No Aju</label>
                                                    {!! Form::text('request_number', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
                                                </div>  
                                                <div class="col-md-3"> 
                                                    <label class="form-label fs-6 fw-bold">Status</label>
                                                    {!! Form::select('status', selectStatusBC20(), null, ['class' => 'form-select']) !!}
                                                </div>
                                                <div class="col-md-3"> 
                                                    <label class="form-label fs-6 fw-bold">Status Berwujud</label>
                                                    {!! Form::select('intangible_status', $jenisBarangTidakBerwujud, null, ['class' => 'form-select', 'placeholder' => '-- Select --']) !!}
                                                </div>
                                                <div class="col-md-3">  
                                                    <label class="form-label fs-6 fw-bold">PPJK</label>
                                                    {!! Form::text('ppjk', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
                                                </div>   
                                                
                                            </div> 
                                            <div class="form-group row"> 
                                                <div class="col-md-3">  
                                                    <label class="form-label fs-6 fw-bold">PEMILIK</label>
                                                    {!! Form::text('pemilik', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
                                                </div>  
                                                <div class="col-md-3">  
                                                    <label class="form-label fs-6 fw-bold">PEMUSATAN</label>
                                                    {!! Form::text('pemusatan', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
                                                </div>   
                                                <div class="col-md-3">  
                                                    <label class="form-label fs-6 fw-bold">PENGIRIM</label>
                                                    {!! Form::text('pengirim', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
                                                </div>   
                                                <div class="col-md-3">  
                                                    <label class="form-label fs-6 fw-bold">IMPORTIR</label>
                                                    {!! Form::text('importir', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
                                                </div>   
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-3">  
                                                    <label class="form-label fs-6 fw-bold">PENJUAL</label>
                                                    {!! Form::text('penjual', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
                                                </div>  
                                                <div class="col-md-3">  
                                                    <label class="form-label fs-6 fw-bold">Tanggal Buat From</label><br>
                                                    {!! Form::date('tanggal_pendaftaran_1', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
                                                </div>  
                                                <div class="col-md-3"> 
                                                    <label class="form-label fs-6 fw-bold">Sampai</label><br>
                                                    {!! Form::date('tanggal_pendaftaran_2', null, ['class' => 'form-control form-control-lg form-control-solid']) !!}
                                                </div>  
                                            </div> 
                                            <div class="d-flex justify-content-end ">
                                                <button type="button" class="btn btn-primary fw-bold px-6"
                                                        data-kt-menu-dismiss="true" data-kt-user-table-filter="filter"
                                                        id="filter">Apply
                                                </button>
                                            </div>
                                            <!--end::Actions-->
                                        </div>
                                {!! Form::close() !!}
                                    <!--end::Content-->
                                </div>
                                @can('create air pib')
                                <x-link-add-new />
                                @endcan
                                <div class="d-flex justify-content-between w-full"> &nbsp;
                                    <div>
                                        <a href="javascript:void(0);" style="${draft_bc};margin-right:10px;" id="btn-send-draf" data-type="draff" class="btn btn-light-primary">
                                            <i class="la la-send"></i>
                                            <span>Send to CEISA</span>
                                        </a>
                                        <button style="${send_bc}" id="btn-send-running" data-type="running" class="btn btn-light-success" disabled="true">
                                            <i class="la la-send"></i>
                                            <span>Running CEISA</span>
                                        </button>
                                    </div>
                                    <a href="javascript:void(0);" onclick="javascript:tarikRespone(2);" id="btn-status" data-bs-toggle="modal" data-bs-target="#statusPopup" class="btn btn-icon btn-light-warning" style="margin-left:10px;margin-right:10px;"><i class="la la-refresh fs-2"></i></a>                                
                                    <a href="javascript:void(0);" id="btn-upload-pib" data-bs-toggle="modal" data-bs-target="#upload-pib-modal" title="Upload Excel PIB"  class="btn btn-light-danger">                                    
                                        <i class="fas fa-file-excel fs-2"></i>
                                        Mass Upload
                                        <i class="la la-upload"></i>
                                    </a>  
                                    
                                </div>
                               
                            </div> 
                        </div> 
                        <div class="pt-5 min-w-300px">
                            {!! Form::text('request_number_outside', null, ['class' => 'form-control form-control-sm min-w-150px', 'placeholder' => 'Cari No Pengajuan', 'id' => 'request_number_outside']) !!}
                        </div>
                    </div> 
                    <div class="card-body pt-0"> 
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="table"> 
                            <thead> 
                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-50px">
                                        <input type="checkbox" class="form-check-input" id="checked_all"/>
                                    </th>
                                    <th class="min-w-50px">Status</th>
                                    <th class="min-w-150px">No Pengajuan</th> 
                                    <th class="min-w-50px">Berwujud</th> 
                                    <th class="min-w-150px">KPPBC Pengawas</th>
                                    <th class="min-w-150px">PPJK</th>
                                    <th class="min-w-150px">Importir</th>
                                    <th class="min-w-150px">Pemilik Barang</th>
                                    <th class="min-w-150px">Pemusatan Barang</th>
                                    <th class="min-w-150px">Pengirim Barang</th>
                                    <th class="min-w-150px">Penjual Barang</th>
                                    <th class="min-w-50px">Total Dokumen</th>
                                    <th class="min-w-50px">Total Barang</th>
                                    <th class="min-w-50px">Qty Barang</th>
                                    <th class="min-w-150px">Tanggal Dibuat</th>
                                    <th class="min-w-100px">User Buat</th> 
                                    <th class="min-w-300px">Actions</th>
                                    <th class="min-w-50px">Status Bc</th>
                                </tr> 
                            </thead> 
                            <tbody class="text-gray-600 fw-bold">

                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                        @include('air.components.popup.status')
                        @include('air.components.popup.upload_format_bc_modal', ['bc' => '20','id_inbound' => '', 'type' => 'add'])
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            function float(equation, precision = 9) {
                return Math.floor(equation * (10 ** precision)) / (10 ** precision);
            } 
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
                        data:'id','render' : function(data,type,row){
                            return `<input type="checkbox" class="form-check-input" value="${row.id}"/>`;
                        },
                        name:'id'
                    }, 
                    {
                        data:'status_id','render' : function(data,type,row){
                            var warna    ="";
                            var textname ="";
                            if(row.status_id === 11 ){
                                textname = "DRAFT LOCAL"; 
                                warna    ="warning";
                            }else if(row.status_id === 12 ){
                                textname = "SEND TO CEISA";    
                                warna    ="primary";
                            }else{
                                textname = 'RUNNING CEISA';
                                warna    ="success";
                            } 
                            return '<a href="javascript:void(0);" id="btn-status" class="btn btn-'+warna+' btn-sm">'+textname+'</a>';
                        },
                        name:'status_id'
                    },
                    {
                        data: 'request_number',
                        name: 'request_number',
                    },
                    {
                        data: 'intangible_status',
                        name: 'intangible_status',
                    },
                    {
                        data: 'kppbc_pengawas',
                        name: 'kppbc_pengawas'
                    },
                    {
                        data: 'ppjk',
                        name: 'ppjk'
                    },
                    {
                        data: 'importir',
                        name: 'importir'
                    },
                    {
                        data: 'pemilik_barang',
                        name: 'pemilik_barang'
                    },
                    {
                        data: 'pemusatan_barang',
                        name: 'pemusatan_barang'
                    },
                    {
                        data: 'pengirim_barang',
                        name: 'pengirim_barang'
                    },
                    {
                        data: 'penjual_barang',
                        name: 'penjual_barang'
                    },
                    {
                        
                        data:'dokumen',
                        name:'jumlah_dokumen',
                        orderable: 'false'

                    },
                    {
                        data:'jumlah_barang',
                        name:'Qty barang',
                        orderable: 'false'

                    },
                    {
                        data:'barang',
                        name:'jumlah_baranag',
                        orderable: 'false',
                        render : function(data, type, meta){
                            return float(data);

                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: (d) => new Date(d).toLocaleString()
                    },
                    {
                        data: 'createdBy',
                        name: 'createdBy'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        className : "text-end",
                        'ordering': false,
                        'width': '20%',
                    },
                    {
                        data: 'status_action', 
                        render: function(data, type, row) {
                            // Pastikan row.request_number di-escape secara benar 
                            var draft_bc = "";
                            var send_bc  = "";

                            if(row.status_id === 11){
                                draft_bc = "";
                                send_bc  = "display:none;";
                            } else if(row.status_id === 12){
                                draft_bc = "display:none;";
                                send_bc  = "";
                            } else {
                                draft_bc = "";
                                send_bc  = "";
                            }
                            return `
                                <a href="javascript:void(0);" onclick="javascript:openStatusPopup('${row.request_number}');" id="btn-status" data-bs-toggle="modal" data-bs-target="#statusPopup" class="btn btn-light-primary"><i class="la la-building"></i>status</a>
                                <a style="display:none;" href="javascript:void(0);" style="${draft_bc}" onclick="confirmSend('${row.id}', '0');" id="btn-status" class="btn btn-light-warning"><i class="la la-send"></i>Send Draft</a>
                                <a style="display:none;" href="javascript:void(0);" style="${send_bc}" onclick="confirmSend('${row.id}', '1');" id="btn-status" class="btn btn-light-danger"><i class="la la-send"></i>Send SPPB</a>
                            `;
                        },
                        name: 'status_action'
                    },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        render: (data, type, row, meta) => {
                            return `<a href="{{ $mainUrl }}/detail/${row.id}">${row.request_number}</a>`;
                        }
                    },
                    {
                        orderable: false,
                        targets: 0,
                    },
                ]
            });

            $("#filter").on("click", function() {
                table.draw();
            });

            $('#request_number_outside').on('keyup', function(){
                table.column(1).search($(this).val()).draw();
            });

            $('#checked_all').on('click', function(){
                var rows = table.rows().nodes();
                $('input[type="checkbox"]', rows).prop('checked', !isSelected);
                isSelected = !isSelected;
            });

            $('#btn-send-draf , #btn-send-running').on('click', function(){
                var rows = table.rows().nodes();
                if($('input[type="checkbox"]:checked', rows).length == 0){
                    Swal.fire({
                        title: 'Info!',
                        text: "no data selected !",
                        icon: 'warning',
                        showCancelButton: true,
                        showConfirmButton : false,
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Close'
                    });
                }else {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you want to proceed with sending?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, send it!',
                        cancelButtonText: 'No, cancel!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var type = $(this).data('type');
                            sendAll(type);
                        }
                    });
                }

            });

            function sendAll(type)
            {
                var rows = table.rows().nodes();
                var inboundIds = [];
                var checked = $('input[type="checkbox"]:checked', rows).each(function(i, val){
                    inboundIds.push(val.value);
                });

                // Menampilkan loading indicator
                $('#statusPopup .modal-body').html('<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>');
                $('#statusPopup').modal('show');

                $.ajax({
                    type    : 'POST',
                    url     : '{{ $mainUrl }}/send',
                    data    : {
                        inbound_id  : inboundIds,
                        status      : type == "draff" ? 0 : 1,
                        _token      : `{{ csrf_token() }}` 
                    },
                    success : function(res){

                        if(res != null){
                            message = "";
                            res.forEach((vl, i) => {
                                console.log(vl);
                                status = vl.status == 'success' 
                                                    ? `<span class="badge badge-success">Success</span>` 
                                                    : `<span class="badge badge-danger px-5">Failed</span>`; 
                                message += `
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div style="margin-right:10px;">
                                            ${status}
                                        </div>
                                        <div>
                                            <b>NO AJU</b> &nbsp;&nbsp;&nbsp;: ${vl.no_aju}<br><b>MESSAGE</b> : ${vl.message}    
                                        </div>
                                    </div>
                                `;
                            });
                            $('#statusPopup .modal-body').html(message);
                        }

                    },
                    failed : function(err){

                    }
                })

            }
        });

        function confirmSend(id, status) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to proceed with sending?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, send it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    send(id, status);
                }
            });
        }


        function openStatusPopup(nomorAju) {
            var url = '{{ $mainUrl }}/status/' + nomorAju;
            
            // Menampilkan loading indicator
            $('#statusPopup .modal-body').html('<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>');
            $('#statusPopup').modal('show');

            $.get(url, function(response) {
                if(response.status == "Success") {
                    var html = '<table class="table"><thead><tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0"><th>Nomor Aju</th><th>Waktu Status</th><th>Keterangan</th><th>Kode Dokumen</th></tr></thead><tbody>';
                    //response.dataStatus.forEach(function(status) { 
                    response.data.forEach(function(status) { 
                        html += '<tr><td class="min-w-150px">' + status.nomorAju + '</td><td class="min-w-50px">' + status.waktuStatus + '</td><td class="min-w-150px">' + status.keterangan + '</td><td class="min-w-50px">' + status.kodeDokumen + '</td></tr>';
                    });
                    html += '</tbody></table>';
                    $('#statusPopup .modal-body').html(html);
                } else {
                    $('#statusPopup .modal-body').html('<p>Data tidak tersedia</p>');
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.error('Gagal mengambil data:', textStatus, errorThrown);
                $('#statusPopup .modal-body').html('<p>Gagal mengambil data.</p>');
            });
        }

        function send(id, status) { 
            var url = '{{ $mainUrl }}/send/' + id + '/' + status;
            var token = '{{ csrf_token() }}'; // Mendapatkan token CSRF

            // Menampilkan loading indicator
            $('#statusPopup .modal-body').html('<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>');
            $('#statusPopup').modal('show');

            $.post(url, { _token: token }, function(response) {
                if(response.status == "Success") {
                    $('#statusPopup .modal-body').html(response.message);
                } else {
                    $('#statusPopup .modal-body').html('<p>Data gagal di dikirim</p>');
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.error('Gagal mengambil data:', textStatus, errorThrown);
                $('#statusPopup .modal-body').html('<p>Gagal mengambil data.</p>');
            });
        }

        function tarikRespone(nomorAju = "00003001344420231127000113") {
            var url = '{{ $mainUrl }}/status/' + nomorAju;
            
            // Menampilkan loading indicator
            $('#statusPopup .modal-body').html('<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>');
            $('#statusPopup').modal('show');

            $.get(url, function(response) {
                if(response.status == "Success") {
                    var html = '<table class="table"><thead><tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0"><th>Nomor Aju</th><th>Waktu Status</th><th>Keterangan</th><th>Kode Dokumen</th></tr></thead><tbody>';
                    response.dataStatus.forEach(function(status) { 
                        html += '<tr><td class="min-w-150px">' + status.nomorAju + '</td><td class="min-w-50px">' + status.waktuStatus + '</td><td class="min-w-150px">' + status.keterangan + '</td><td class="min-w-50px">' + status.kodeDokumen + '</td></tr>';
                    });
                    html += '</tbody></table>';
                    $('#statusPopup .modal-body').html(html);
                } else {
                    $('#statusPopup .modal-body').html('<p>Data tidak tersedia</p>');
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.error('Gagal mengambil data:', textStatus, errorThrown);
                $('#statusPopup .modal-body').html('<p>Gagal mengambil data.</p>');
            });
        }

       
    </script>
@endpush
