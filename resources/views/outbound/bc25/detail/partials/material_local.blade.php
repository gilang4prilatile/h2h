<div class="card">
    <div class="card-body">
        <div class=" bg-light-grey border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
            <div class="form-group row">
                <div class="col-md-4">
                    <label class="form-label required">Nomor Pengajuan</label>
                    <p>{{ $outbound->request_number }}</p>
                </div>
                <div class="col-md-4">
                    <label class="form-label required">Nomor Pendaftaran</label>
                    <p>{{ $outbound->details['nomor_pendaftaran'] }}</p>
                </div>
                <div class="col-md-4">
                    <label class="form-label required">Tanggal Pendaftaran</label>
                    <p>{{ $outbound->details['tanggal_pendaftaran'] }}</p>
                </div>
            </div>
        </div>
        <div class="form-group row" style="margin-top: 20px;">
            <h2 class="fw-bolder mt-4">Transaksi</h2>
            <div class="col-md-6">
                <label class="form-label">Harga Perolehan</label>
                <p>{{ $outbound->detail_locals['harga_perolehan'] }}</p>
            </div>
            <div class="col-md-6">
                <label class="form-label">Harga Penyerahan</label>
                <p>{{ $outbound->detail_locals['harga_penyerahan'] }}</p>
            </div>
        </div>
        <div class="form-group row" style="margin-top: 20px;">
            <div class="col-md-4">
                <label class="form-label">Netto</label>
                <p>{{ $outbound->detail_locals['nett_weight'] }}</p>
            </div>
            <div class="col-md-4">
                <label class="form-label">Bruto</label>
                <p>{{ $outbound->detail_locals['bruto'] }}</p>
            </div>
            <div class="col-md-4">
                <label class="form-label">Volume</label>
                <p>{{ $outbound->detail_locals['volume'] }}</p>
            </div>
        </div>
        <div class="raw-good-local">
            <div style="margin-top:40px;">
                <h2 class="fw-bolder mt-4">Data Bahan Konversi</h2>
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="table-raw-material-local">
                    <thead>
                        <tr>
                            <th class="no-sort">Kode Barang</th>
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

            <h2 class="fw-bolder mt-4">Pungutan</h2>
            <div class="border-dashed border-1 rounded p-3 d-flex flex-column " style="border-color: lightgrey">
                <div class="form-group row border-dashed border-0 border-bottom-1 " style="color: lightgrey; padding-bottom: 10px">
                    <div class="col-md-2"></div>
                    <div class="col-md-3 border-dashed border-0 border-right-1" >
                        <label class="form-label" >Ditangguhkan (Rp)</label>
                    </div>
                    <div class="col-md-3 border-dashed border-0 border-right-1">
                        <label class="form-label   " >Dibebaskan (Rp)</label>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tidak Dipungut (Rp)</label>
                    </div>
                </div>

                <div class="form-group row border-dashed border-0 border-bottom-1" style="margin-top:10px;padding-bottom:10px;color: lightgrey">
                    <div class="col-md-2 my-auto">
                        <span class="h5">PPN</span>
                    </div>
                    <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
                        <span class="form-text">{{@$outbound->detail_locals['ppn_ditangguhkan'] ?? 0 }}</span>
                    </div>
            
                    <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
                        <span class="form-text">{{@$outbound->detail_locals['ppn_dibebaskan'] ?? 0 }}</span>
                    </div>
                    <div class="col-md-3 my-auto">
                        <span class="form-text">{{@$outbound->detail_locals['ppn_tidak_dipungut'] ?? 0 }}</span>
                    </div>
                </div>
                <div class="form-group row "style="color: lightgrey; padding-bottom: 10px">
                    <div class="col-md-2 my-auto">
                        <span class="h5">Total</span>
                    </div>
                    <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
                        <span class="form-text">{{@$outbound->detail_locals['total_ditangguhkan'] ?? 0 }}</span>
                    </div>
            
                    <div class="col-md-3 border-dashed border-0 border-right-1 my-auto">
                        <span class="form-text">{{@$outbound->detail_locals['total_dibebaskan'] ?? 0 }}</span>
                    </div>
                    <div class="col-md-3 my-auto">
                        <span class="form-text">{{@$outbound->detail_locals['total_tidak_dipungut'] ?? 0 }}</span>
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
                    data: 'request_number',
                    name: 'request_number',
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

            }
        })

    })
</script>
@endpush