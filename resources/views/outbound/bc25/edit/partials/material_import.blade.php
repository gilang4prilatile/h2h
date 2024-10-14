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
                {!! Form::text('details[tanggal_pendaftaran]', null, ['class' => 'form-control datepicker', 'required' => true, 'placeholder' => 'Pilih Tanggal']) !!}
                @if($errors->has('details[tanggal_pendaftaran]'))
                    <span class="error text-danger">{{ $errors->first('details[tanggal_pendaftaran]') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row" style="margin-top: 20px;">
            <h2 class="fw-bolder mt-4">Transaksi</h2>
            <div class="col-md-4">
                <label class="form-label">Nilai CIF</label>
                {!! Form::number('detail_imports[nilai_cif]', @$outbound->detail_imports['nilai_cif'] ?: 0, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input', 'id' => 'nilai_cif_import',  'maxlength' => '18', 'min' => '0', 'readonly', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!}
                @if($errors->has('detail_imports[nilai_cif]'))
                    <span class="error text-danger">{{ $errors->first('detail_imports[nilai_cif]') }}</span>
                @endif
            </div>
            <div class="col-md-4">
                <label class="form-label">NDPBM</label>
                {!! Form::number('detail_imports[ndpbm]', @$outbound->details['ndpbm'] ?: 0, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input', 'id' => 'ndpbm_import',  'maxlength' => '18', 'min' => '0', 'readonly', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!}
                @if($errors->has('detail_imports[ndpbm]'))
                    <span class="error text-danger">{{ $errors->first('detail_imports[ndpbm]') }}</span>
                @endif
            </div>
            <div class="col-md-4">
                <label class="form-label">CIF RP</label>
                {!! Form::number('detail_imports[cif_rp]', @$outbound->detail_imports['cif_rp'] ?: 0, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input', 'id' => 'cif_rp_import',  'maxlength' => '18', 'min' => '0', 'readonly' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!}
                @if($errors->has('detail_imports[cif_rp]'))
                    <span class="error text-danger">{{ $errors->first('detail_imports[cif_rp]') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row" style="margin-top: 20px;">
            <div class="col-md-4">
                <label class="form-label">Netto</label>
                {!! Form::number('detail_imports[nett_weight]', @$outbound->detail_imports['nett_weight'] ?: 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'nett_weight_import',  'maxlength' => '18', 'min' => '0', 'readonly', 'step' => 'any' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!}
                @if($errors->has('detail_imports[nett_weight]'))
                    <span class="error text-danger">{{ $errors->first('detail_imports[nett_weight]') }}</span>
                @endif
            </div>
            <div class="col-md-4">
                <label class="form-label">Bruto</label>
                {!! Form::number('detail_imports[bruto]', @$outbound->detail_imports['bruto'] ?: 0, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input', 'id' => 'berat_kotor_import',  'maxlength' => '18', 'min' => '0', 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!}
                @if($errors->has('detail_imports[bruto]'))
                    <span class="error text-danger">{{ $errors->first('detail_imports[bruto]') }}</span>
                @endif
            </div>
            <div class="col-md-4">
                <label class="form-label">Volume</label>
                {!! Form::number('detail_imports[volume]', @$outbound->detail_imports['volume'] ?: 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'volume_import',  'maxlength' => '18', 'min' => '0', 'step' => 'any', 'readonly' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!}
                @if($errors->has('detail_imports[volume]'))
                    <span class="error text-danger">{{ $errors->first('detail_imports[volume]') }}</span>
                @endif
            </div>
        </div>
        <div class="raw-good-import">
            <div style="margin-top:40px;">
                <h2 class="fw-bolder mt-4">Data Bahan Konversi</h2>
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="table-raw-material-import">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>Asal Barang</th>
                            <th>Nomer Request</th>
                            <th>Qty digunakan</th>
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
            @include("outbound.bc25.edit.partials.calculate.calculate_pungutan")
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
        var table = $('#table-raw-material-import').DataTable({
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
                    efaultContent: "",
                },
                {
                    data: 'request_number',
                    name: 'request_number',
                    efaultContent: "",
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
                    data: 'id',
                    name : 'id',
                    defaultContent : "",
                },
                {
                    data: 'good_id',
                    name: 'good_id',
                    efaultContent: "",
                }   
            ],
            columnDefs : [
                {
                    targets : 6,
                    render : (data, type, row, meta ) => {
                      
                        if(data != ''){
                            if(row.details.nilai_cif != undefined 
                            && row.details.cif_rp != undefined){
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
                                    '<button type="button" class="btn btn-primary btn-sm" onclick="calculateRawgGoodImport('+row.inbound_detail_id+', ' + row.good_conversion_id + ')">Hitung</button>'+
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
            if(status == 'import'){

                var conversionGoods = selectedGoods;
                var searchDiff = [];
                $.each(selectedGoods, (x, vx) => {

                    $.each(selectedImportGoods, (i , vi) => {

                        if(vx.good_id == vi.good_conversion_id){
                            searchDiff.push(vi);
                        }

                    })

                });
                if(searchDiff.length > 0 && selectedImportGoods.length != 0 || selectedImportGoods.length == 0){
                    
                    // selectedImportGoods  = [];
                    $('#table-raw-material-import').DataTable().clear();

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

                                    if(vs.bc == 'BC23'){

                                        $.each(selectedImportGoods, (b, vb) => {

                                            if(vb.good_conversion_id == vs.good_id && vb.inbound_detail_id == vs.inbound_detail_id ){
                                                var obj = Object.assign(vs.details, vb.details);
                                                vs.details = obj;
                                            }

                                        });

                                        dataGoods.push(vs);

                                    }

                                });
                                console.log("DATA")
                                console.log(dataGoods);
                                $.each(dataGoods, (x, vx) => {
                                
                                    if(x == 0){
                                        $('#table-raw-material-import').DataTable().row.add({
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

                                    $('#table-raw-material-import').DataTable().row.add(vx).draw()
                                    selectedImportGoods.push(vx);

                                });

                            
                            },
                            error: function(res) {
                                console.log(res);
                            }
                        })

                    });

                }
                calculateRawgGoodImport = (inboundDetailID, goodConversionID) => {
                    let good = selectedImportGoods.find(function (val) {return val.inbound_detail_id == inboundDetailID && val.good_conversion_id == goodConversionID})
                    selectedImportGood = good;
                    $('#calculate-import-modal').modal('show')
                }

            }
        })

    })
</script>
@endpush