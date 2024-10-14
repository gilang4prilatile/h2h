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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Good Conversions</h1>
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
                        <a href="{{ url('master-data/good-conversions') }}" class="text-muted text-hover-primary">Good Conversions</a>
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
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body pt-0" style="margin-top: 20px">
                    <!--begin:Form-->
                    <form action="{{url('master-data/good-conversions/create')}}" method="post" id="form-good-conversions">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="form-label required">Code</label>
                                <input type="text" class="form-control " name="details[kode_barang]" value="{{old('details[kode_barang]')}}" required>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label required">Name</label>
                                <input type="text" class="form-control " name="name" value="{{old('name')}}" required>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label required">UOM</label>
                                <select name="uom_id" id="uom_id" class="form-select  detail-inputs form-control-solid" required>
                                    @foreach($data_uom as $row)
                                    <option value="{{$row->id}}" {{old('uom_id')==$row->id?"selected":""}}>{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label required">Uraian barang</label>
                                <input type="text" class="form-control " name="details[uraian]" value="{{old('details[uraian]')}}" required>
                            </div>
                        </div>
                        <div class="form-group row" style="margin-top: 20px;">
                            {{-- <div class="col-md-4">
                        <label class="form-label required">Amount</label>
                        <input type="number" class="form-control " name="amount"  step="any" value="{{old('amount')}}" required>
                        </div> --}}
                        <div class="col-md-4">
                            <label class="form-label required">Nett Weight</label>
                            <div class="input-group mb-5">
                                <input type="number" class="form-control " name="nett_weight" step="any" value="{{old('nett_weight')}}" required>
                                <span class="input-group-text" id="">Kg</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label required">Volume</label>
                            <div class="input-group mb-5">
                                <input type="number" class="form-control " name="volume" step="any" value="{{old('volume')}}" required>
                                <span class="input-group-text" id="">m3</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label required">Merk</label>
                            <input type="text" class="form-control " name="details[merk]" value="{{old('details[merk]')}}" required>
                        </div>
                </div>
                <div class="form-group row mt-3">
                    <div class="col-md-4">
                        <label class="form-label required">Tipe</label>
                        <input type="text" class="form-control " name="details[type]" value="{{old('details[type]')}}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label required">Ukuran</label>
                        <input type="text" class="form-control " name="details[ukuran]" value="{{old('details[ukuran]')}}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label required">Spesifikasi Lain</label>
                        <input type="text" class="form-control " name="details[spesifikasi_lain]" value="{{old('details[spesifikasi_lain]')}}" required>
                    </div>
                </div>
                <hr class="mt-8">
                <div class="row mt-3">
                    <div class="col">
                        <div class="form-group row mt-3">
                            <div class="col-md-12">
                                <h3 class="fw-bolder mt-4">
                                    List Goods *
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#pilih-produk-modal">Add Goods</button>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="padding-right: 20px;padding-left: 20px">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="list-goods">
                        <thead>
                            <tr>
                                <th class="w-200px">Kode Goods</th>
                                <th class="w-200px">Name Goods</th>
                                <th class="w-200px">Qty</th>
                                <th class="w-200px">Satuan</th>
                                <th class="w-100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
@include('master-data.good-conversions.popup-goods')
@endsection

@push('js')
<script>
    $(document).ready(function() {

        var table = $('#table').DataTable();
        $('#uom_id').select2();

        $("#filter").on("click", function() {
            table.draw();
        });

        if (table2 = document.querySelector("#table-prod")) {

            (that2 = $(table2).DataTable({
                info: false,
                order: [],
                autoWidth: true,
                paging: false,
                // pageLength: 4,
                scrollY: 300,
                scrollX: true,
                columnDefs: [{
                        orderable: false,
                        targets: 2
                    },
                    {
                        orderable: false,
                        targets: 1
                    },
                    {
                        orderable: false,
                        targets: 0
                    }
                ]
            })).on("draw", function() {});

            document.querySelector('[data-kt-customer-table-filter="cari-produk"]').addEventListener("keyup", function(e) {
                that2.search(e.target.value).draw();
            });
        }

        $('#form-good-conversions').submit(function(e) {
            // let quantityConversions = $(`input[name='quantity[]']`);
            // let canSubmit = true;
            // $.each(quantityConversions, (i, vi) => {
            //     console.log(parseFloat(vi.value));
            //     if(parseFloat(vi.value) < 0.00001 ){
            //         canSubmit = false;
            //     }
            // });
            // if(!canSubmit){
            //     e.preventDefault();
            //     Swal.fire('Error', `Quantity Good Conversion Cannot 0 !`, "error");
            //     return;
            // }


        })


        $("#pilih-produk-modal").on('shown.bs.modal', function(e) {

            $('#search-input').val("");

            that2.search("");
            that2.draw();

            // var checkboxs = $("#table-prod tbody input[type=checkbox]:checked");
            // document.getElementById('select_count').innerHTML = checkboxs.length;
            reflesh_data_model();
        });
    });

    var arrData = [];
    var arrDataSementara = [];
    var clickedSelect = 0;

    function select_product(id, kode, name, uom, isChecked) {

        if (!isChecked) {

            for (var l = 0; l < arrDataSementara.length; l++) {
                if (arrDataSementara[l]['id'] == id) {
                    arrDataSementara.splice(l, 1);
                    break;
                } else {
                    arrDataSementara.push({
                        'id': id,
                        'kode': kode,
                        'name': name,
                        'uom': uom
                    });
                    break;
                }
            }

            if (arrDataSementara.length == 0)
                arrDataSementara.push({
                    'id': id,
                    'kode': kode,
                    'name': name,
                    'uom': uom
                });

        } else if (isChecked) {
            arrDataSementara.push({
                'id': id,
                'kode': kode,
                'name': name,
                'uom': uom
            });
        }

        if (arrDataSementara.length == 0)
            document.getElementById('check_all').checked = false

        // var checkboxs = $("#table-prod tbody input[type=checkbox]:checked");
        // document.getElementById('select_count').innerHTML = checkboxs.length;


    }

    function select_all(isChecked) {

        var checkboxs = $("#table-prod tbody input[type=checkbox]");
        if (isChecked) {
            for (var i = 0; i < checkboxs.length; i++) {
                if (checkboxs[i].checked != true) {
                    checkboxs[i].click()
                }
            }
        } else {
            for (var i = 0; i < checkboxs.length; i++) {
                if (checkboxs[i].checked != false) {
                    checkboxs[i].click()
                }
            }
        }

        // document.getElementById('select_count').innerHTML = arrData.length;

    }

    function confirm_select() {

        $('#list-goods').find('tbody').find('tr').remove();

        var thereExits = false;
        for (var e = 0; e < arrDataSementara.length; e++) {

            if (arrData.length > 0)
                for (var d = 0; d < arrData.length; d++) {

                    if (arrData[d]['id'] === arrDataSementara[e]['id']) {
                        arrData.splice(d, 1);
                        thereExits = true;
                        break;
                    }

                }


            if (!thereExits)
                arrData.push(arrDataSementara[e]);

            thereExits = false;
        }


        for (var i = 0; i < arrData.length; i++) {

            var html = '<tr id="row-' + i + '">';
            html += '<td>' + arrData[i]['kode'] + ' <input type="hidden" name="kode[]" value="' + arrData[i]['kode'] + '"></td>';
            html += '<td>' + arrData[i]['name'] + ' <input type="hidden" name="good_conversion_id[]" value="' + arrData[i]['id'] + '"></td>';
            html += '<td><input type="number" class="form-control " name="quantity[]" value="0" min="0" step="any" required></td>';
            html += '<td>' + JSON.parse(arrData[i]['uom'])['name'] + '</td>';
            html += '<td><button type="button" class="btn btn-sm btn-danger text-center" onclick="delete_product(\'' + i + '\',\'' + arrData[i]['id'] + '\')"><i class="fas fa-trash"></i></a></td>';
            html += '</tr>';
            $('#list-goods').find('tbody').append(html);

        }
        arrDataSementara = [];
        reflesh_data_model();
        $('#pilih-produk-modal').modal('hide');
    }

    function delete_product(i, id) {

        $("#row-" + i).remove();

        for (var x = 0; x < arrData.length; x++) {

            if (arrData[x]['id'] == id) {
                arrData.splice(x, 1);
            }

        }

        reflesh_data_model();

        // document.getElementById('select_count').innerHTML = arrData.length;

    }

    function close_modal() {

        reflesh_data_model();
        arrDataSementara = [];
        // document.getElementById('select_count').innerHTML = arrData.length;
        $('#pilih-produk-modal').modal('hide');

    }

    function reflesh_data_model() {
        var checkboxs = $("#table-prod tbody input[type=checkbox]");

        for (var i = 0; i < checkboxs.length; i++) {

            if (arrData.length == 0)
                checkboxs[i].checked = false;

            for (var z = 0; z < arrData.length; z++) {

                if (checkboxs[i].value == arrData[z]['id']) {
                    checkboxs[i].checked = true;
                    break;
                } else {
                    checkboxs[i].checked = false;
                }

            }

        }
    }
</script>
@endpush