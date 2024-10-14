<div class="card">
    <div class="card-body">
        <div class="form-group row">
            <div class="col-md-4">
                <label class="form-label required">Nomor Pengajuan</label>
                {!! Form::text('request_number', null, ['class' => 'form-control ', 'required' => true, 'placeholder' => 'Input No Pengajuan', 'id' => 'request_number']) !!}
                <span class="error text-danger" id="error-nomor-pengajuan"></span>
                @if($errors->has('request_number'))
                <span class="error text-danger">{{ $errors->first('request_number') }}</span>
                @endif
            </div>
            <div class="col-md-4">
                <label class="form-label required">Nomor Pendaftaran</label>
                {!! Form::text('details[nomor_pendaftaran]', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input No Pendaftaran', 'id' => 'nomor_pendaftaran']) !!}
                <span class="error text-danger" id="error-nomor-pendaftaran"></span>
                @if($errors->has('details[nomor_pendaftaran]'))
                <span class="error text-danger">{{ $errors->first('details[nomor_pendaftaran]') }}</span>
                @endif
            </div>
            <div class="col-md-4">
                <label class="form-label required">Tanggal Pendaftaran</label>
                {!! Form::text('details[tanggal_pendaftaran]', 0, ['class' => 'form-control datepicker', 'required' => true, 'placeholder' => 'Pilih Tanggal']) !!}
                @if($errors->has('details[tanggal_pendaftaran]'))
                <span class="error text-danger">{{ $errors->first('details[tanggal_pendaftaran]') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row" style="margin-top: 20px;">
            <h2 class="fw-bolder mt-4">Transaksi</h2>
            <div class="col-md-6">
                <label class="form-label">Harga Perolehan</label>
                {!! Form::number('detail_locals[harga_perolehan]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'harga_perolehan_local', 'maxlength' => '18', 'min' => '0', 'step' => 'any', 'readonly', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!} @if($errors->has('detail_locals[harga_perolehan]'))
                    <span class="error text-danger">{{ $errors->first('detail_locals[harga_perolehan]') }}</span>
                    @endif
            </div>
            <div class="col-md-6">
                <label class="form-label">Harga Penyerahan</label>
                {!! Form::number('detail_locals[harga_penyerahan]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'harga_penyerahan_local', 'maxlength' => '18', 'min' => '0', 'readonly', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!} @if($errors->has('detail_locals[harga_penyerahan]'))
                    <span class="error text-danger">{{ $errors->first('detail_locals[harga_penyerahan]') }}</span>
                    @endif
            </div>
        </div>
        <div class="form-group row" style="margin-top: 20px;">
            <div class="col-md-4">
                <label class="form-label">Netto</label>
                {!! Form::number('detail_locals[nett_weight]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'nett_weight_local', 'maxlength' => '18', 'min' => '0', 'step' => 'any' , 'readonly', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!} @if($errors->has('detail_locals[nett_weight]'))
                    <span class="error text-danger">{{ $errors->first('detail_locals[nett_weight]') }}</span>
                    @endif
            </div>
            <div class="col-md-4">
                <label class="form-label">Bruto</label>
                {!! Form::number('detail_locals[bruto]', 0, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input', 'id' => 'berat_kotor_local', 'maxlength' => '18', 'min' => '0', 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!} @if($errors->has('detail_locals[bruto]'))
                    <span class="error text-danger">{{ $errors->first('detail_locals[bruto]') }}</span>
                    @endif
            </div>
            <div class="col-md-4">
                <label class="form-label">Volume</label>
                {!! Form::number('detail_locals[volume]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'volume_local', 'maxlength' => '18', 'min' => '0', 'readonly' , 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!} @if($errors->has('detail_locals[volume]'))
                    <span class="error text-danger">{{ $errors->first('detail_locals[volume]') }}</span>
                    @endif
            </div>
        </div>
        <div class="raw-good-local">
            <div style="margin-top:40px;">
                <div class="d-flex justify-content-between">
                    <h2 class="fw-bolder mt-4 mr-auto">Data Bahan Konversi</h2>
                    <button class="btn btn-light-primary float-right" type="button" id="btn-set-pph">Set PPH</button>
                </div>
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="table-raw-material-local">
                    <thead>
                        <tr>
                            <th class="no-sort">Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>Asal Barang</th>
                            <th>Qty digunakan</th>
                            <th>Nomer Request</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pungutan">

            <h2 class="fw-bolder mt-4">Pungutan</h2>
            <div class="border-dashed border-1 rounded p-3 d-flex flex-column " style="border-color: lightgrey">
                <div class="form-group row border-dashed border-0 border-bottom-1 " style="color: lightgrey; padding-bottom: 40px">
                    <div class="col-md-2"></div>
                    <div class="col-md-3 border-dashed border-0 border-right-1">
                        <label class="form-label">Ditangguhkan (Rp)</label>
                    </div>
                    <div class="col-md-3 border-dashed border-0 border-right-1">
                        <label class="form-label">Dibebaskan (Rp)</label>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tidak Dipungut (Rp)</label>
                    </div>
                </div>

                <div class="form-group row " style="color: lightgrey; padding-bottom: 10px">
                    <div class="col-md-2 my-auto">
                        <span class="h5">PPN</span>
                    </div>
                    <div class="col-md-3 border-dashed border-0 border-right-1">
                        {!! Form::number('detail_locals[ppn_ditangguhkan]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'ppn_ditangguhkan_local', 'maxlength' => '18', 'min' => '0', 'step' => 'any' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                        if(this.value<0){this.value='0'}", 'readonly'=> 'readonly' ]) !!}
                            @if($errors->has('detail_locals[ppn_ditangguhkan]'))
                            <span class="error text-danger">{{ $errors->first('detail_locals[ppn_ditangguhkan]') }}</span>
                            @endif
                    </div>

                    <div class="col-md-3 border-dashed border-0 border-right-1">
                        {!! Form::number('detail_locals[ppn_dibebaskan]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'ppn_dibebaskan_local', 'maxlength' => '18', 'min' => '0', 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                        if(this.value<0){this.value='0'}", 'readonly'=> 'readonly' ]) !!}
                            @if($errors->has('detail_locals[ppn_dibebaskan]'))
                            <span class="error text-danger">{{ $errors->first('detail_locals[ppn_dibebaskan]') }}</span>
                            @endif
                    </div>
                    <div class="col-md-3">
                        {!! Form::number('detail_locals[ppn_tidak_dipungut]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'ppn_tidak_dipungut_local', 'maxlength' => '18', 'min' => '0', 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                        if(this.value<0){this.value='0'}", 'readonly'=> 'readonly' ]) !!}
                            @if($errors->has('detail_locals[ppn_tidak_dipungut]'))
                            <span class="error text-danger">{{ $errors->first('detail_locals[ppn_tidak_dipungut]') }}</span>
                            @endif
                    </div>
                </div>
                <div class="form-group row " style="color: lightgrey; padding-bottom: 10px">
                    <div class="col-md-2 my-auto">
                        <span class="h5">Total</span>
                    </div>
                    <div class="col-md-3 border-dashed border-0 border-right-1">
                        {!! Form::number('detail_locals[total_ditangguhkan]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'total_ditangguhkan_local', 'maxlength' => '18', 'min' => '0', 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                        if(this.value<0){this.value='0'}", 'readonly'=> 'readonly' ]) !!}
                            @if($errors->has('detail_locals[total_ditangguhkan]'))
                            <span class="error text-danger">{{ $errors->first('detail_locals[total_ditangguhkan]') }}</span>
                            @endif
                    </div>

                    <div class="col-md-3 border-dashed border-0 border-0-1">
                        {!! Form::number('detail_locals[total_dibebaskan]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'total_dibebaskan_local', 'maxlength' => '18', 'min' => '0', 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                        if(this.value<0){this.value='0'}", 'readonly'=> 'readonly' ]) !!}
                            @if($errors->has('detail_locals[total_dibebaskan]'))
                            <span class="error text-danger">{{ $errors->first('detail_locals[total_dibebaskan]') }}</span>
                            @endif
                    </div>
                    <div class="col-md-3 ">
                        {!! Form::number('detail_locals[total_tidak_dipungut]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'total_tidak_dipungut_local', 'maxlength' => '18', 'min' => '0', 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                        if(this.value<0){this.value='0'}", 'readonly'=> 'readonly' ]) !!}
                            @if($errors->has('detail_locals[total_tidak_dipungut]'))
                            <span class="error text-danger">{{ $errors->first('detail_locals[total_tidak_dipungut]') }}</span>
                            @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--begin::Modal - New Target-->
    <div class="modal fade" id="set-pph-modal" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-lg-700px">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
                                    <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
                                    <rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1" />
                                </g>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15 mt-5">
                    <div class="form-group row">
                        <div class="col-md-2 mt-2">
                            <label class="form-label">PPN:</label>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-5">
                                {!! Form::number('ppn_all', 11, ['class' => 'form-control bg-secondary', 'required' => true, 'id' => 'ppn_all', 'step' => 'any', 'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                if(this.value<0){this.value='0'}", 'readonly'=> 'readonly']) !!}
                                    <span class="input-group-text" id="">%</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            {!! Form::select('ppn_tax_type_all', $taxTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'ppn_tax_type_all']) !!}
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-5">
                                {!! Form::number('ppn_tax_value_all', 0, ['class' => 'form-control', 'required' => true, 'id' => 'ppn_tax_value_all', 'step' => 'any', 'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                if(this.value<0){this.value='0'}"]) !!} <span class="input-group-text" id="">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mt-5">
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-sm btn-primary" id="btn-submit-set-ppn" type="button">Submit</button>
                        </div>

                    </div>
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - New Target-->


</div>
@push('js')
<script>
    $(document).ready(function() {
        function float(equation, precision = 9) {
            return Math.floor(equation * (10 ** precision)) / (10 ** precision);
        }

        var rawGoods = [];
        var table = $('#table-raw-material-local').DataTable({
            data: rawGoods,
            ordering: false,
            columns: [{
                    data: 'kode_barang',
                    name: 'kode_barang',
                    defaultContent: "",
                },
                {
                    data: 'name',
                    name: 'name',
                    defaultContent: "",
                },
                {
                    data: 'details.jenis_barang',
                    name: 'details.jenis_barang',
                    defaultContent: "",
                },
                {
                    data: 'bc',
                    name: 'bc',
                    defaultContent: "",

                },
                {
                    data: 'quantity',
                    name: 'quantity',
                    defaultContent: "",
                    render: function(data, type, meta) {
                        if (data != "") {
                            return float(data);
                        }
                    }
                },
                {
                    data: 'request_number',
                    name: 'request_number',
                    defaultContent: "",
                },
                {
                    data: 'id',
                    name: 'id',
                    defaultContent: "",
                },
                {
                    data: 'inbound_detail_id',
                    name: 'inbound_detail_id',
                    defaultContent: "",
                }

            ],
            columnDefs: [{
                    targets: 6,
                    render: (data, type, row, meta) => {

                        if (data != '') {
                            if (row.details.harga_penyerahan != undefined) {
                                return `<span class="badge badge-success p-2">Sudah dihitung</span>`;
                            }

                            return `<span class="badge badge-warning p-2">Belum dihitung</span>`;

                        }

                        return '';
                    }
                },
                {
                    targets: 7,
                    render: (data, type, row, meta) => {

                        if (data != '') {
                            return (
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-primary btn-sm" onclick="calculateRawGoodLocal(' + row.inbound_detail_id + ', ' + row.good_conversion_id + ')">Hitung</button>' +
                                '</div>'
                            );
                        }

                        return '';
                    }
                }
            ]
        });

        $('#nav-tab a').on('click', function() {
            var status = $(this).data('status');
            if (status == 'local') {

                var conversionGoodLocals = [];
                var searchDiff = [];
                $.each(selectedLocalGoods, (x, vx) => {
                    if (vx.details.harga_perolehan != "" || vx.details.harga_penyerahan != "" || vx.details.bm_type != "" || vx.details.bm != "" || vx.details.bm_tax_type != "" || vx.details.bm_tax_value != "") {
                        conversionGoodLocals[x] = vx;
                    }
                });

                selectedLocalGoods = [];

                $('#table-raw-material-local').DataTable().clear();

                $.each(selectedGoods, (i, vl) => {
                    const token = "{{ csrf_token() }}"
                    var data = {
                        'good_id': vl.good_id,
                        'quantity': vl.quantity
                    };

                    $.ajax({
                        type: "POST",
                        url: `/master-data/good-conversions/raw-good-conversion`,
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        data: data,
                        success: function(res) {

                            var dataGoods = res.data.filter(function(val) {
                                return val.bc != 'BC23'
                            })
                            $.each(dataGoods, (x, vx) => {

                                if (x == 0) {
                                    $('#table-raw-material-local').DataTable().row.add({
                                        'id': '',
                                        'kode_barang': `Konversi : [${dataGoods[0].good_conversion}]`,
                                        'name': '',
                                        'details.jenis_barang': '',
                                        'bc': '',
                                        'request_number': '',
                                        'quantity': '',
                                        'inbound_detail_id': ''
                                    }).draw();
                                }

                                $.each(conversionGoodLocals, (l, vl) => {

                                    if (vl.inbound_detail_id == vx.inbound_detail_id && vl.good_conversion_id == vx.good_conversion_id) {
                                        var obj = Object.assign(vx.details, vl.details);
                                        vx.details = obj;
                                        vx.nett_weight = vl.nett_weight;
                                        vx.volume = vl.volume;

                                    }
                                })


                                $('#table-raw-material-local').DataTable().row.add(vx).draw();

                                selectedLocalGoods.push(vx);
                            });

                        },
                        error: function(res) {
                            console.log(res);
                        }
                    })

                });
                calculateRawGoodLocal = (inboundDetailID, goodConversionID) => {
                    let good = selectedLocalGoods.find(function(val) {
                        return val.inbound_detail_id == inboundDetailID && val.good_conversion_id == goodConversionID
                    })
                    selectedLocalGood = good;
                    $('#calculate-local-modal').modal('show')
                }

            }
        })

        $('#btn-set-pph').on('click', function() {


            if (ppnAll != 0 &&
                ppnTaxTypeAll != 0 &&
                ppnTaxValueAll != 0) {
                $('#ppn_all').val(ppnAll);
                $('#ppn_tax_type_all').val(ppnTaxTypeAll);
                $('ppn_tax_value_all').val(ppnTaxValueAll);
            }


            $('#set-pph-modal').modal('show');


        });

        $('#btn-submit-set-ppn').on('click', function() {

            ppnAll = $('#ppn_all').val();
            ppnTaxTypeAll = $('#ppn_tax_type_all').val();
            ppnTaxValueAll = $('#ppn_tax_value_all').val();
            console.log("CLICK");
            $.each(selectedLocalGoods, (i, vi) => {

                var hargaPenyerahanCalculate = ((vi.inbound.details.harga_penyerahan / vi.inbound_detail.quantity) * vi.quantity);

                vi.details.ppn = ppnAll;
                vi.details.ppn_tax_type = ppnTaxTypeAll;
                vi.details.ppn_tax_value = ppnTaxValueAll;
                vi.details.harga_perolehan = hargaPenyerahanCalculate;
                vi.details.harga_penyerahan = hargaPenyerahanCalculate;

                vi.volume = vi.quantity;
                vi.nett_weight = vi.quantity;

            });


            refreshLocalGoodsInfo()
            refreshGoodsBahanBakuInfo()
            $('#nav-tab a[href="#nav-local"]').click() // Select tab by name
            $('#set-pph-modal').modal('hide');

        });



    })
</script>
@endpush