<div class="card">
    <div class="card-body">
        <div class=" bg-light-grey border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
            <div class="form-group row">
                <div class="col-md-4">
                    <label class="form-label required">Nomor Pengajuan</label>
                    <p>{{$outbound->request_number}}</p>
                </div>
                <div class="col-md-4">
                    <label class="form-label required">Nomor Pendaftaran</label>
                    <p>{{$outbound->details['nomor_pendaftaran']}}</p>
                </div>
                <div class="col-md-4">
                    <label class="form-label required">Tanggal Pendaftaran</label>
                    <p>{{$outbound->details['tanggal_pendaftaran']}}</p>
                </div>
            </div>
        </div>
        <div class="form-group row" style="margin-top: 20px;">
            <h2 class="fw-bolder mt-4">Transaksi</h2>
            <div class="col-md-4">
                <label class="form-label required">Nilai Cif</label>
                <p>{{$outbound->detail_imports['nilai_cif']}}</p>
            </div>
            <div class="col-md-4">
                <label class="form-label required">NDPBM</label>
                <p>{{$outbound->detail_imports['ndpbm']}}</p>
            </div>
            <div class="col-md-4">
                <label class="form-label required">Cif RP</label>
                <p>{{$outbound->detail_imports['cif_rp']}}</p>
            </div>
        </div>
        <div class="form-group row" style="margin-top: 20px;">
            <div class="col-md-4">
                <label class="form-label required">Netto</label>
                <p>{{$outbound->detail_imports['nett_weight']}}
            </div>
            <div class="col-md-4">
                <label class="form-label required">Bruto</label>
                <p>{{$outbound->detail_imports['bruto']}}
            </div>
            <div class="col-md-4">
                <label class="form-label required">Volume</label>
                <p>{{$outbound->detail_imports['volume']}}
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
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pungutan">
            @include("outbound.bc25.detail.partials.calculate.calculate_pungutan")
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


                }
            })

    })
</script>
@endpush