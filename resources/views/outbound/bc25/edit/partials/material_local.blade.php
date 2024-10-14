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
                {!! Form::number('detail_locals[harga_perolehan]', @$outbound->detail_locals['harga_perolehan'] ?: 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'step' => 'any' , 'id' => 'harga_perolehan_local',  'maxlength' => '18', 'min' => '0', 'readonly', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!}
                @if($errors->has('detail_locals[harga_perolehan]'))
                    <span class="error text-danger">{{ $errors->first('detail_locals[harga_perolehan]') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label class="form-label">Harga Penyerahan</label>
                {!! Form::number('detail_locals[harga_penyerahan]', @$outbound->detail_locals['harga_penyerahan'] ?: 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'step' => 'any', 'id' => 'harga_penyerahan_local',  'maxlength' => '18', 'min' => '0', 'readonly', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!}
                @if($errors->has('detail_locals[harga_penyerahan]'))
                    <span class="error text-danger">{{ $errors->first('detail_locals[harga_penyerahan]') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row" style="margin-top: 20px;">
            <div class="col-md-4">
                <label class="form-label">Netto</label>
                {!! Form::number('detail_locals[nett_weight]', @$outbound->detail_locals['nett_weight'] ?: 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'nett_weight_local', 'step' => 'any',  'maxlength' => '18', 'min' => '0', 'readonly', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!}
                @if($errors->has('detail_locals[nett_weight]'))
                    <span class="error text-danger">{{ $errors->first('detail_locals[nett_weight]') }}</span>
                @endif
            </div>
            <div class="col-md-4">
                <label class="form-label">Bruto</label>
                {!! Form::number('detail_locals[bruto]', @$outbound->detail_locals['bruto'] ?: 0, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input', 'id' => 'berat_kotor_local', 'step' => 'any',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!}
                @if($errors->has('detail_locals[bruto]'))
                    <span class="error text-danger">{{ $errors->first('detail_locals[bruto]') }}</span>
                @endif
            </div>
            <div class="col-md-4">
                <label class="form-label">Volume</label>
                {!! Form::number('detail_locals[volume]', @$outbound->detail_locals['volume'] ?: 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'volume_local', 'step' => 'any',  'maxlength' => '18', 'min' => '0', 'readonly' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!}
                @if($errors->has('detail_locals[volume]'))
                    <span class="error text-danger">{{ $errors->first('detail_locals[volume]') }}</span>
                @endif
            </div>
        </div>
        <div class="raw-good-import">
            <div style="margin-top:40px;">
                <h2 class="fw-bolder mt-4">Data Bahan Konversi</h2>
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
                    <div class="col-md-3 border-dashed border-0 border-right-1" >
                        <label class="form-label" >Ditangguhkan (Rp)</label>
                    </div>
                    <div class="col-md-3 border-dashed border-0 border-right-1">
                        <label class="form-label" >Dibebaskan (Rp)</label>
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
                        {!! Form::number('detail_locals[ppn_ditangguhkan]', @$outbound->detail_locals['ppn_ditangguhkan'] ?: 0, ['class' => 'form-control bg-secondary', 'step' => 'any', 'required' => true, 'placeholder' => 'Input', 'id' => 'ppn_ditangguhkan_local',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                        if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
                        @if($errors->has('detail_locals[ppn_ditangguhkan]'))
                            <span class="error text-danger">{{ $errors->first('detail_locals[ppn_ditangguhkan]') }}</span>
                        @endif
                    </div>

                    <div class="col-md-3 border-dashed border-0 border-right-1">
                        {!! Form::number('detail_locals[ppn_dibebaskan]', @$outbound->detail_locals['ppn_dibebaskan'] ?: 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'step' => 'any', 'id' => 'ppn_dibebaskan_local',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                        if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
                        @if($errors->has('detail_locals[ppn_dibebaskan]'))
                            <span class="error text-danger">{{ $errors->first('detail_locals[ppn_dibebaskan]') }}</span>
                        @endif
                    </div>
                    <div class="col-md-3">
                        {!! Form::number('detail_locals[ppn_tidak_dipungut]', @$outbound->detail_locals['ppn_tidak_dipungut'] ?: 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'step' => 'any', 'id' => 'ppn_tidak_dipungut_local',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                        if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
                        @if($errors->has('detail_locals[ppn_tidak_dipungut]'))
                            <span class="error text-danger">{{ $errors->first('detail_locals[ppn_tidak_dipungut]') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row "style="color: lightgrey; padding-bottom: 10px">
                    <div class="col-md-2 my-auto">
                        <span class="h5">Total</span>
                    </div>
                    <div class="col-md-3 border-dashed border-0 border-right-1">
                        {!! Form::number('detail_locals[total_ditangguhkan]', @$outbound->detail_locals['total_ditangguhkan'] ?: 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'step' => 'any', 'id' => 'total_ditangguhkan_local',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                        if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
                        @if($errors->has('detail_locals[total_ditangguhkan]'))
                            <span class="error text-danger">{{ $errors->first('detail_locals[total_ditangguhkan]') }}</span>
                        @endif
                    </div>

                    <div class="col-md-3 border-dashed border-0 border-0-1">
                        {!! Form::number('detail_locals[total_dibebaskan]', @$outbound->detail_locals['total_dibebaskan'] ?: 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'step' => 'any', 'id' => 'total_dibebaskan_local',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                        if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
                        @if($errors->has('detail_locals[total_dibebaskan]'))
                            <span class="error text-danger">{{ $errors->first('detail_locals[total_dibebaskan]') }}</span>
                        @endif
                    </div>
                    <div class="col-md-3 ">
                        {!! Form::number('detail_locals[total_tidak_dipungut]', @$outbound->detail_locals['total_tidak_dipungut'] ?: 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'step' => 'any', 'id' => 'total_tidak_dipungut_local',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                        if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
                        @if($errors->has('detail_locals[total_tidak_dipungut]'))
                            <span class="error text-danger">{{ $errors->first('detail_locals[total_tidak_dipungut]') }}</span>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>


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
            columns: [
                {
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
                    data : 'quantity',
                    name : 'quantity',
                    defaultContent: "",
                    render : function(data, type, meta){
                        if(data != ""){
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
                    data: 'good_id',
                    name: 'good_id',
                    defaultContent: "",
                }
                  
            ],
            columnDefs : [
                {
                    targets : 6,
                    render : (data, type, row, meta ) => {
                      
                        if(data != ''){
                            if(row.details.harga_penyerahan != undefined){
                                return `<span class="badge badge-success p-2">Sudah dihitung</span>`;
                            }

                            return `<span class="badge badge-warning p-2">Belum dihitung</span>`;

                        }

                        return '';
                    }
                },
                {
                    targets : 7,
                    render : (data, type, row, meta ) => {
                        
                        if(data != ''){
                            return (
                                '<div class="btn-group">' +
                                    '<button type="button" class="btn btn-primary btn-sm" onclick="calculateRawgGoodLocal('+row.inbound_detail_id+', ' + row.good_conversion_id + ')">Hitung</button>'+
                                '</div>'
                            );
                        }

                        return '';
                    }
                }
            ]
        });

        $('#nav-tab a').on('click', function(){
            var status = $(this).data('status');
            if(status == 'local'){

                var conversionGoods = selectedGoods;
                var searchDiff = [];
     
                $.each(selectedGoods, (x, vx) => {

                    $.each(selectedLocalGoods, (i , vi) => {

                        if(vx.good_id == vi.good_conversion_id){
                            searchDiff.push(vi);
                        }

                    })

                });
                

                if(searchDiff.length > 0 && selectedLocalGoods.length != 0 || selectedLocalGoods.length == 0){

                    // selectedLocalGoods  = [];
                    
                    $('#table-raw-material-local').DataTable().clear();

                    $.each(conversionGoods, (i, vl) => {
                        const token = "{{ csrf_token() }}"                   
                        var data = {
                            'outbound_id' : vl.outbound_id ,
                            'good_id' : vl.good_id,
                            'quantity' : vl.quantity
                        };

                        $.ajax({
                            type: "POST",
                            url: `/master-data/good-conversions/raw-good-conversion`,
                            headers: {'X-CSRF-TOKEN': token},
                            data : data,
                            success: function(res) {
                             
                                var dataGoods = [];
                                $.each(res.data, (s, vs) => {

                                    if(vs.bc == 'BC40'){

                                        $.each(selectedLocalGoods, (b, vb) => {

                                            if(vb.good_conversion_id == vs.good_id && vb.inbound_detail_id == vs.inbound_detail_id ){
                                                var obj = Object.assign(vs.details, vb.details);
                                                vs.details = obj;
                                            }

                                        });

                                        dataGoods.push(vs);

                                    }

                                });
                     

                                $.each(dataGoods, (x, vx) => {
                                
                                    if(x == 0){
                                        $('#table-raw-material-local').DataTable().row.add({
                                            'id' : '',
                                            'good_id' : '',
                                            'kode_barang' :  `Konversi : [${dataGoods[0].good_conversion}]`,
                                            'name' : '',
                                            'details.jenis_barang' : '',
                                            'bc' : '',
                                            'request_number' : '',
                                            'quantity' : ''
                                        }).draw(false);
                                    }

                                    $('#table-raw-material-local').DataTable().row.add(vx).draw(false);
                                    selectedLocalGoods.push(vx);
                                    console.log(selectedLocalGoods);

                                });
                            
                            },
                            error: function(res) {
                                console.log(res);
                            }
                        })

                    });

                }
                calculateRawgGoodLocal = (inboundDetailID, goodConversionID) => {
                    let good = selectedLocalGoods.find(function (val) {return val.inbound_detail_id == inboundDetailID && val.good_conversion_id == goodConversionID})
                    selectedLocalGood = good;
   
                    $('#calculate-local-modal').modal('show');
                    // $('#calculate-local-modal').modal('show')
                }



            }
        })

    })
</script>
@endpush