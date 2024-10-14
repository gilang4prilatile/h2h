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
                {!! Form::number('detail_imports[nilai_cif]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'nilai_cif_import',  'maxlength' => '18', 'min' => '0', 'step' => 'any' , 'readonly', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!}
                @if($errors->has('detail_imports[nilai_cif]'))
                    <span class="error text-danger">{{ $errors->first('detail_imports[nilai_cif]') }}</span>
                @endif
            </div>
            <div class="col-md-4">
                <label class="form-label">NDPBM</label>
                {!! Form::number('detail_imports[ndpbm]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'ndpbm_import',  'maxlength' => '18', 'min' => '0', 'step' => 'any' , 'readonly', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!}
                @if($errors->has('detail_imports[nilai_cif]'))
                    <span class="error text-danger">{{ $errors->first('detail_imports[nilai_cif]') }}</span>
                @endif
            </div>
            <div class="col-md-4">
                <label class="form-label">CIF RP</label>
                {!! Form::number('detail_imports[cif_rp]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'cif_rp_import',  'maxlength' => '18', 'min' => '0', 'step' => 'any' , 'readonly' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!}
                @if($errors->has('detail_imports[cif_rp]'))
                    <span class="error text-danger">{{ $errors->first('detail_imports[cif_rp]') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row" style="margin-top: 20px;">
            <div class="col-md-4">
                <label class="form-label">Netto</label>
                {!! Form::number('detail_imports[nett_weight]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'nett_weight_import',  'maxlength' => '18', 'min' => '0', 'step' => 'any', 'readonly', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!}
                @if($errors->has('detail_imports[nett_weight]'))
                    <span class="error text-danger">{{ $errors->first('detail_imports[nett_weight]') }}</span>
                @endif
            </div>
            <div class="col-md-4">
                <label class="form-label">Bruto</label>
                {!! Form::number('detail_imports[bruto]', 0, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input', 'id' => 'berat_kotor_import',  'maxlength' => '18', 'min' => '0', 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!}
                @if($errors->has('detail_imports[bruto]'))
                    <span class="error text-danger">{{ $errors->first('detail_imports[bruto]') }}</span>
                @endif
            </div>
            <div class="col-md-4">
                <label class="form-label">Volume</label>
                {!! Form::number('detail_imports[volume]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'volume_import',  'maxlength' => '18', 'min' => '0', 'readonly', 'step' => 'any' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
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
            @include("outbound.bc25.add.partials.calculate.calculate_pungutan")
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
                    name: 'bc'
                },
                {
                    data: 'request_number',
                    name: 'request_number'
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
                    data: 'inbound_detail_id',
                    name: 'inbound_detail_id',
                    defaultContent: "",
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
                                    '<button type="button" class="btn btn-primary btn-sm" onclick="calculateRawGoodImport('+row.inbound_detail_id+', ' + row.good_conversion_id + ')">Hitung</button>'+
                                '</div>'
                            );
                        }

                        return '';
                    }
                },
                
            ]
        });

        $('#nav-tab a').on('click', function(){

            var status = $(this).data('status');

            if(status == 'import'){

                reloadMaterialImport();

                calculateRawGoodImport = (inboundDetailID, goodConversionID) => {
                    let good = selectedImportGoods.find(function (val) {return val.inbound_detail_id == inboundDetailID && val.good_conversion_id == goodConversionID})
                    selectedImportGood = good;
                    $('#calculate-import-modal').modal('show')
                }



            }
        })

        function reloadMaterialImport()
        {

            var conversionGoodImports = [];
            var searchDiff = [];
            $.each(selectedImportGoods, (x, vx) => {
                if(vx.details.nilai_cif != "" || vx.details.cif_rp != ""){
                    conversionGoodImports[x] = vx;
                }
            });
        
            selectedImportGoods  = [];
                
            $('#table-raw-material-import').DataTable().clear();

            $.each(selectedGoods, (i, vl) => {
                const token = "{{ csrf_token() }}"                   
                var data = {
                    'good_id' : vl.good_id,
                    'quantity' : vl.quantity
                };

                $.ajax({
                    type: "POST",
                    url: `/master-data/good-conversions/raw-good-conversion`,
                    headers: {'X-CSRF-TOKEN': token},
                    data : data,
                    success: function(res) {

                        var dataGoods = res.data.filter(function(val) { return val.bc != 'BC40' })
                        $.each(dataGoods, (x, vx) => {
                        
                            if(x == 0){
                                $('#table-raw-material-import').DataTable().row.add({
                                    'id' : '',
                                    'kode_barang' :  `Konversi : [${dataGoods[0].good_conversion}]`,
                                    'name' : '',
                                    'details.jenis_barang' : '',
                                    'bc' : '',
                                    'request_number' : '',
                                    'quantity' : '',
                                    'inbound_detail_id' : ''
                                }).draw();
                            }

                            
                            $.each(conversionGoodImports, (l,  vl) => {

                                if(vl.inbound_detail_id == vx.inbound_detail_id && vl.good_conversion_id == vx.good_conversion_id){
                                    var obj = Object.assign(vx.details,vl.details);
                                    vx.details = obj;
                                    vx.nett_weight = vl.nett_weight;
                                    vx.volume = vl.volume;
                                    vx.hs_code_id = vl.hs_code_id;
                                }

                            })
                            
                            $('#table-raw-material-import').DataTable().row.add(vx).draw();
                            
                            selectedImportGoods.push(vx);
                        });
                    
                    },
                    error: function(res) {
                        console.log(res);
                    }
                })

            });

        }

    })
</script>
@endpush