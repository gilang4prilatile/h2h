@extends("layouts.main")
@push('css')
<style>
    input { 
        text-transform: uppercase;
    }
</style>
@endpush
@section('content')
    @include("components.toolbar", ['parentMenuName' => 'Outbound', 'menuName' => 'BC41'])
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container">
                <!--begin::Card-->
                <div class="card ">
                    <div class="card-header card-header-stretch">
                        <h3 class="card-title">Input BC41</h3>
                        <div class="card-toolbar">
                        </div>
                    </div>
                    {{-- {!! Form::model($model,["id" => "form"]) !!} --}}
                    <div class="card-body">
                        {{ Form::open(['url' => $mainUrl . '/create', 'method' => 'POST', 'id' => 'create-form', 'enctype' => 'multipart/form-data']) }}
                        <div class="form-group">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class="form-label required">Nomor Pengajuan</label>
                                    {!! Form::text('request_number', null, ['class' => 'form-control ', 'required' => true, 'placeholder' => 'Input No Pengajuan', 'id' => 'request_number','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                    <span class="error text-danger" id="error-nomor-pengajuan"></span>
                                    @if($errors->has('request_number'))
                                        <span class="error text-danger">{{ $errors->first('request_number') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">Nomor Pendaftaran</label>
                                    {!! Form::text('details[nomor_pendaftaran]', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input No Pendaftaran', 'id' => 'nomor_pendaftaran','oninput' => 'this.value = this.value.toUpperCase()']) !!}
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
                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-4">
                                    <label class="form-label required">Kantor Pabean</label>
                                    {!! Form::select('kppbc_id', $kppbcSelectBox, null, ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                                    @if($errors->has('kppbc_id'))
                                        <span class="error text-danger">{{ $errors->first('kppbc_id') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label required">Jenis TPB</label>
                                    {!! Form::select('jenis_tpb_id', $jenisTpbSelectBox, null, ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --']) !!}
                                    @if($errors->has('jenis_tpb_id'))
                                        <span class="error text-danger">{{ $errors->first('jenis_tpb_id') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">Tujuan Pengiriman</label>
                                    {!! Form::select('tujuan_pengiriman_id', $tujuanPengirimanSelectBox, null, ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --']) !!}
                                    @if($errors->has('tujuan_pengiriman_id'))
                                        <span class="error text-danger">{{ $errors->first('tujuan_pengiriman_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-6">
                                    <div  class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey ">
                                        <label class="form-label required">Pengusaha TPB</label>
                                        {!! Form::select('tpb_id', $tpbSelectBox, $user_customer ?? '', ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id' => 'tpb_id']) !!}
                                        @if($errors->has('tpb_id'))
                                            <span class="error text-danger">{{ $errors->first('tpb_id') }}</span>
                                        @endif
                                        <div class="card p-1 d-none " style="margin-top: 10px" id="tpb_info">
                                            <table  class=" table align-middle  table-row-dashed table-row-gray-400 fs-8 dataTable no-footer text-gray-600" role="grid" aria-describedby="table_info">
                                                <tbody >
                                                    <tr>
                                                        <td class="d-flex p-1">
                                                            <div>Tipe Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='tipe_identitas_tpb'>Pilih pengusaha TPB</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="d-flex p-1 ">
                                                            <div>Nomor Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='nomor_identitas_tpb'>Pilih pengusaha TPB</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="d-flex p-1">
                                                            <div>Negara : &nbsp;</div><div class=" " readonly ='readonly'  id ='negara_pengusaha_tpb'>Pilih pengusaha TPB</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="d-flex p-1">
                                                            <div>Alamat : &nbsp;</div><div class=" " readonly ='readonly'  id ='alamat_pengusaha_tpb'>Pilih pengusaha TPB</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="d-flex p-1">
                                                            <div>No Izin: &nbsp;</div><div class=" " readonly ='readonly'  id ='no_izin_tpb'>Pilih pengusaha TPB</div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey ">
                                        <label class="form-label required">Pengirim Barang</label>
                                        {!! Form::select('pengirim_barang_id', $pengirimBarangSelectBox, $user_customer ?? '', [ 'class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --' ,'id'=>'pengirim_barang_id']) !!}
                                        @if($errors->has('pengirim_barang_id'))
                                            <span class="error text-danger">{{ $errors->first('pengirim_barang_id') }}</span>
                                        @endif
                                        <div class="card  p-1  d-none" style="margin-top: 10px" id="pengirim_barang_info">
                                            <table  class=" table align-middle  table-row-dashed table-row-gray-400 fs-8 dataTable no-footer text-gray-600" role="grid" aria-describedby="table_info">
                                                <tbody>
                                                    <tr>
                                                        <td class="d-flex p-1">
                                                            <div>Tipe Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='tipe_identitas_pengirim_barang'>Pilih pengirim barang</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="d-flex p-1">
                                                            <div>Nomor Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='nomor_identitas_pengirim_barang'>Pilih pengirim barang</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="d-flex p-1">
                                                            <div>Country : &nbsp;</div><div class=" " readonly ='readonly'  id ='negara_pengirim_barang'>Pilih pengirim barang</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="d-flex p-1">
                                                            <div>Address : &nbsp;</div><div class=" " readonly ='readonly'  id ='alamat_pengirim_barang'>Pilih pengirim barang</div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table> 
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                            <h2 class="fw-bolder mt-4">Pengangkutan</h2>
                            <div class="form-group row" style="margin-top:10px;">
                              

                                <div class="col-md-4">
                                    <label class="form-label required">Jenis Sarana Pengangkutan Darat</label>
                                    {!! Form::select('transportation_id', $transportations, null, ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --']) !!}
                                    @if($errors->has('transportation_id'))
                                        <span class="error text-danger">{{ $errors->first('transportation_id') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label required">Nomor Polisi</label>
                                    {!! Form::text('vehicle_number', null, ['class' => 'form-control', 'required' => true, 'maxlength' => 20 , 'oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                    @if($errors->has('vehicle_number'))
                                        <span class="error text-danger">{{ $errors->first('vehicle_number') }}</span>
                                    @endif
                                </div>
                            
                                <div class="col-md-4">
                                         <label class="form-label required">Jenis Pengeluaran Barang</label>
                                            <select class="form-control" name="partial" id="partial" data-control="select2">
                                                <option value="" disabled selected>--Select--</option>
                                                <option value="1">Pengiriman Partial</option>
                                                <option value="0">Tidak Partial</option>
                                            </select>
                                        @if($errors->has('partial'))
                                            <span class="error text-danger">{{ $errors->first('partial') }}</span>
                                        @endif
                                </div>
                            </div>

                           
                            </div> 
                            @include('outbound.components.add.documents')

                            <div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                                <h2 class="fw-bolder mt-4">Detail Barang</h2>
                                <div class="form-group row" style="margin-top:10px;">
                                    <div class="col-md-12">
                                        
                                        @if($errors->has('list_barang'))
                                            <span class="error text-danger">{{ $errors->first('list_barang') }}</span>
                                        @endif
                                        <div class="form-group row">
                                            <div class="form-group mt-5">
                                                <a href="javascript:void(0);" id="btn-tambah-barang" data-bs-toggle="modal" data-bs-target="#add-modal" class="btn btn-light-primary">
                                                    <i class="la la-plus"></i>Add
                                                </a>
                                            </div>
                                        </div>
                                        @include('outbound.components.add.goods_table')
                                    </div>
                                </div>

                                <div class="form-group row" style="margin-top:10px;">
                                    <div class="col-md-3">
                                    <label class="form-label required">Harga Penyerahan</label>
                                    {!! Form::number('details[harga_penyerahan]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input Harga Penyerahan', 'maxlength' => '18', 'min' => '0', 'id' => 'harga_penyerahan' ,  'step' => 'any' , 'readonly' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                                     if(this.value<0){this.value='0'}" ]) !!}
                                    @if($errors->has('details[harga_penyerahan]'))
                                        <span class="error text-danger">{{ $errors->first('details[harga_penyerahan]') }}</span>
                                    @endif
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Volume (m3)</label>
                                        {!! Form::number('details[volume]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'total_volume' , 'step' => 'any' ,  'maxlength' => '18', 'min' => '0', 'readonly' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                                        if(this.value<0){this.value='0'}" ]) !!}
                                        @if($errors->has('details[volume]'))
                                            <span class="error text-danger">{{ $errors->first('details[volume]') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Berat Kotor (Kg)</label>
                                        {!! Form::number('details[berat_kotor]', 0, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input', 'id' => 'berat_kotor' , 'maxlength' => '18', 'min' => '0'  , 'step' => 'any' ,  'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                                        if(this.value<0){this.value='0'}" ]) !!}
                                        @if($errors->has('details[berat_kotor]'))
                                            <span class="error text-danger">{{ $errors->first('details[berat_kotor]') }}</span>
                                        @endif
                                    </div> 
                                    <div class="col-md-3">
                                        <label class="form-label">Berat Bersih (Kg)</label>
                                        {!! Form::number('details[berat_bersih]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'berat_bersih', 'step' => 'any' , 'readonly']) !!}
                                        @if($errors->has('details[berat_bersih]'))
                                            <span class="error text-danger">{{ $errors->first('details[berat_bersih]') }}</span>
                                        @endif
                                    </div>
                                </div>
                           

                            {!! Form::hidden('list_barang', null, ['id' => 'list_barang']) !!}
                            </div>
                            <div class=" bg-light-primary border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
                                    <p>
                                        Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal yang diberitahukan dalam
                                        pemberitahuan pabean ini
                                    </p> 
                                <div class="form-group">
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label class="form-label required">Kota</label>
                                            {!! Form::select('city_id', $citySelectBox, $user_kota ?? '', ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                                            @if($errors->has('city_id'))
                                                <span class="error text-danger">{{ $errors->first('city_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label required">Tanggal</label>
                                            {!! Form::text('details[pabean_tanggal]', null, ['class' => 'form-control datepicker', 'required' => true, 'placeholder' => 'input Tanggal']) !!}
                                            @if($errors->has('details[pabean_tanggal]'))
                                                <span class="error text-danger">{{ $errors->first('details[pabean_tanggal]') }}</span>
                                            @endif
                                        </div>
                                    
                                        <div class="col-md-3">
                                            <label class="form-label required">Pemberitahu</label>
                                            {!! Form::text('details[pabean_pemberitahu]', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input Pemberi Tahu','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                            @if($errors->has('details[pabean_pemberitahu]'))
                                                <span class="error text-danger">{{ $errors->first('details[pabean_pemberitahu]') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label required">Jabatan</label>
                                            {!! Form::text('details[pabean_jabatan]', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input Jabatan','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                            @if($errors->has('details[pabean_jabatan]'))
                                                <span class="error text-danger">{{ $errors->first('details[pabean_jabatan]') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--begin::Actions-->
                            <div class="text-center" style="margin-top:20px;">
                            <a href="javascript:history.back()" id="" class="btn btn-light me-3">Cancel</a>
                                <button type="submit" id="" class="btn btn-primary">
                                    <span class="indicator-label">Submit</span>
                                </button>
                            </div>
                            <!--end::Actions-->
                        </div>
                        {!! Form::close() !!}
                        @include('outbound.components.add.add_modal')
                        @include('outbound.components.detail.detail_modal', ['bc' => 'BC41'])
                    </div>
                    {{-- {!! Form::close() !!} --}}
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"
        integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
@endpush

@push('js')
    <script>
        var selectedGoods   = [];
        var selectedGood    = {};
        var nettWeight      = 0;
        var volume          = 0;
        const refreshGoodsInfo = () => {
            $('#list_barang').val(JSON.stringify(selectedGoods));
            let totalVolume = selectedGoods.reduce(function(total, v) {
                return parseFloat(total) + parseFloat(v.volume)
            }, 0)
            let totalBeratBersih = selectedGoods.reduce(function(total, v) {
                return parseFloat(total) + parseFloat(v.nett_weight)
            }, 0)
            // let totalBeratKotor = selectedGoods.reduce(function(total, v) {
            //     return parseFloat(total) + parseFloat(v.details.bruto)
            // }, 0)
            let totalHargaPenyerahan = selectedGoods.reduce(function(total, v){
                return parseFloat(total) + parseFloat(v.details.harga_penyerahan)
            }, 0)
            $('#harga_penyerahan').val(totalHargaPenyerahan)
            $('#total_volume').val(totalVolume)
            $('#berat_bersih').val(totalBeratBersih)
            // $('#berat_kotor').val(totalBeratKotor)
            $('#table').DataTable().clear().rows.add(selectedGoods).draw()
        }

        function float(equation, precision = 9) {
            return Math.floor(equation * (10 ** precision)) / (10 ** precision);
        }

        $(document).ready(function() {

            // $('#quantity').on('keyup', function(){

            //     var totalNettWeight = nettWeight * $(this).val();
            //     var totalVolume     = volume * $(this).val();

            //     $('#nett_weight').val(float(totalNettWeight));
            //     $('#volume').val(float(totalVolume));

            // });

            $('#create-form').submit(function(e){
                if (selectedGoods.length == 0) {
                    e.preventDefault();
                    Swal.fire('Error', 'Goods is required', 'error')
                }

                var beratBersih = $('#berat_bersih').val();
                var beratKotor = $('#berat_kotor').val();
                var partial = $('#partial').val();

                if(Number(beratBersih) > Number(beratKotor)){
                    e.preventDefault();
                    Swal.fire('Error', `Netto must not be more than Bruto`, "error")
                }else if(parseFloat(beratKotor) == 0){
                    e.preventDefault();
                    Swal.fire('Error', `Bruto must be filled in`, "error")
                }

                if(partial == null){
                    e.preventDefault();
                    Swal.fire('Error', `Partial must be filled `, "error")
                }

            })
 
            let tpbID = $('#tpb_id');
            let pengirimBarangID = $('#pengirim_barang_id');
 
            if(tpbID.val() != ''){
                tpbID.trigger("change");
            }
   
            if(pengirimBarangID.val() != ''){
                pengirimBarangID.trigger("change");
            }


        })

        var errorNomorPengajuan = $('#error-nomor-pengajuan');
        var errorNomorPendaftaran = $('#error-nomor-pendaftaran');

        $('#request_number').on('focusout', function(){

            var requestNumber =  $(this).val();
            var result = ajaxValidatin(requestNumber, 'request');

        });

        $('#nomor_pendaftaran').on('focusout', function(){

            var registerNumber =  $(this).val();
            var result = ajaxValidatin(registerNumber, 'register');

        });

        function ajaxValidatin(whereData, type){

            $.ajax({
                type: "GET",
                url: `/outbound/validation-${type}-number/${whereData}/2`,
                success: function(res) {
                    printMessageValidation(res.find_data, type);
                },
                error: function(res) {
                    console.log(res);
                }
            })


        }

        function printMessageValidation(result, type){

            console.log(result);
            var message = result ? `Nomor ${type} Suda Ada` : ``;

            if(type == 'request'){
                errorNomorPengajuan.html(message);
            }else {
                errorNomorPendaftaran.html(message);
            }

        }

        $('#btnSubmitAdd').on('click', function(){

            errorNomorPengajuan.html('');
            errorNomorPendaftaran.html('');

        });

        $('#pengirim_barang_id').on('change', function() {
            $('#tipe_identitas_pengirim_barang').val("");
            $('#nomor_identitas_pengirim_barang').val("");
            $('#negara_pengirim_barang').val("");
            $('#alamat_pengirim_barang').val("");
            $('#warehouse_tpb').val("");
            if(this.value == ""){
                $('#pengirim_barang_info').addClass("d-none");
            }else{
                $('#pengirim_barang_info').removeClass("d-none");
            }

            var value_pengirim_barang_id = this.value;
            if(value_pengirim_barang_id != ""){
                $.ajax({
                    type: "GET",
                    url: '{{url('/')}}/master-data/profile/detail/'+value_pengirim_barang_id,
                    success: function(res) {
                        $('#tipe_identitas_pengirim_barang').html(res['details'].tipe_identitas);
                        $('#nomor_identitas_pengirim_barang').html(res['details'].nomor_identitas);
                        $('#negara_pengirim_barang').html(res['name_country']);
                        $('#alamat_pengirim_barang').html(res['address']);
                        $('#warehouse_tpb').html(res['name_warehouse']);

                    },
                    error: function(res) {
                        console.log(res.responseJSON.message);
                    }
                })
            }
           
        });

        $('#tpb_id').on('change', function() {
            $('#tipe_identitas_tpb').val("");
            $('#nomor_identitas_tpb').val("");
            $('#negara_pengusaha_tpb').val("");
            $('#alamat_pengusaha_tpb').val("");
            $('#warehouse_tpb').val("");
            $('#no_izin_tpb').val("");

            if(this.value == ""){
                $('#tpb_info').addClass("d-none");
            }else{
                $('#tpb_info').removeClass("d-none");
            }
            var value_tpb_id = this.value;
            if(value_tpb_id != ""){

                $.ajax({
                type: "GET",
                url: '{{url('/')}}/master-data/profile/detail/'+value_tpb_id,
                success: function(res) {
                    $('#tipe_identitas_tpb').html(res['details'].tipe_identitas);
                    $('#nomor_identitas_tpb').html(res['details'].nomor_identitas);
                    $('#negara_pengusaha_tpb').html(res['name_country']);
                    $('#alamat_pengusaha_tpb').html(res['address']);
                    $('#warehouse_tpb').html(res['name_warehouse']);

                    $('#no_izin_tpb').html(res['details'].nomor_izin);
                },
                error: function(res) {
                    console.log(res.responseJSON.message);
                }
            })

            }
        });

        
        var tanpa_rupiah = document.getElementById('detail-harga-penyerahan');
        tanpa_rupiah.addEventListener('keyup', function(e)
        {
             document.getElementById("s-harga-penyerahan").innerHTML = formatRupiah(this.value);
        });

    </script>
@endpush
