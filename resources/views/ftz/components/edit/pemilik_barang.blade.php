<!--begin::Modal - New Target-->
<div class="modal fade" id="pemilik-barang-modal" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-lg-600px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                fill="#000000">
                                <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
                                <rect fill="#000000" opacity="0.5"
                                    transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                    x="0" y="7" width="16" height="2" rx="1" />
                            </g>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">

                <form action="#" id="add-form-pemilik-barang">
                    @csrf
                    <h2 class="fw-bolder mt-4"> 
                        <label class="form-label ">
                            Pemilik Barang
                        </label>
                    </h2>
                    {!! Form::hidden('inbound_id', $inbound->id, []) !!}
                    {!! Form::text('no_seri', null, ['class' => 'form-control number bg-secondary', 'required' => true,'oninput' => 'this.value = this.value.toUpperCase()', 'id' => 'pemilik_no_seri', 'readonly' => 'readonly']) !!}
                    {!! Form::select('pemilik_id', $pemilikBarangSelectBox, $user_customer ?? '', ['class' => 'form-select mt-3', 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id'=>'pemilik_id']) !!}
                    @if($errors->has('pemilik_id'))
                        <span class="error text-danger">{{ $errors->first('pemilik_id') }}</span>
                    @endif
                    <!-- <div class="form-group row" id="pemilik_input">
                        <div class="col-md-4 "> 
                            {!! Form::select('pemilik_tipe_identitas', $jenisIdentitas, $user_customer ?? '', ['class' => 'form-select mt-3', 'data-control' => 'select2', 'placeholder' => 'Jenis Identitas','id'=>'pemilik_tipe_identitas']) !!}
                        </div> <br>
                        <div class="col-md-8"> 
                            {!! Form::text('pemilik_nomor_identitas',null, ['class' => 'form-control mt-3', 'placeholder' => 'No Identitas','oninput' => 'this.value = this.value.toUpperCase()', 'maxlength' => '15', 'id' => 'pemilik_nomor_identitas']) !!}
                        </div> <br>
                        <div class="col-md-12"> 
                            {!! Form::text('pemilik_nama',null, ['class' => 'form-control mt-2', 'placeholder' => 'Nama pemilik','oninput' => 'this.value = this.value.toUpperCase()',  'id' => 'pemilik_nama']) !!}
                        </div> <br>
                        <div class="col-md-12"> 
                            {!! Form::textarea('pemilik_alamat', null, ['class' => 'form-control mt-3', 'placeholder' => 'Alamat', 'id' => 'pemilik_alamat', 'rows' => '4' ]) !!}
                        </div>
                    </div> -->
                    <div class="card p-1 d-none" style="margin-top: 10px" id="pemilik_info">
                        <table  class=" table align-middle  table-row-dashed table-row-gray fs-8 dataTable no-footer text-gray-600" role="grid" aria-describedby="table_info">
                            <tbody >
                                <tr>
                                    <td class="d-flex p-1">
                                        <div>Tipe Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='tipe_identitas_pemilik'>Pilih Pemilik Barang</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="d-flex p-1">
                                        <div>Nomor Identitas : &nbsp;</div><div class=" " readonly ='readonly'  id ='nomor_identitas_pemilik'>Pilih Pemilik</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="d-flex p-1">
                                        <div>Nama : &nbsp;</div><div class=" " readonly ='readonly'  id ='nama_pemilik'>Pilih Pemilik Barang</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="d-flex p-1">
                                        <div>Alamat : &nbsp;</div><div class=" " readonly ='readonly'  id ='alamat_pemilik'>Pilih Pemilik Barang</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                    <!--begin::Actions-->
                    <div class="text-center" style="margin-top:20px;">
                        <button type="reset" id="btn_cancel_modal_tambah_pemilik" class="btn btn-light me-3">Cancel</button>
                        <button type="submit" id="button_tambah_pemilik" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
                        </button>
                    </div>

                </form>

                <!--end::Actions-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - New Target-->
@push('js')
<script src="https://cdn.jsdelivr.net/npm/form-data-json-convert/dist/form-data-json.min.js"></script>
@endpush

@push('js')

<script>

    $(document).ready(function(){

        function convertFormToJSON(form) {
            const array = $(form).serializeArray(); // Encodes the set of form elements as an array of names and values.
            const json = {};
            $.each(array, function () {
                const isArray = this.name.includes('[]');
                if (isArray) {
                    const name = this.name.replace('[]', '');
                    if (!json[name]) {
                        json[name] = [];
                    }
                    json[name].push(this.value);
                } else {
                    const nestedName = this.name.substring(this.name.indexOf("[") + 1, this.name.lastIndexOf("]"))
                    if (nestedName.length == 0) {
                        json[this.name] = this.value || "";
                    } else {
                        const parentName = this.name.substring(0, this.name.indexOf("["))
                        json[parentName] = json[parentName] || {};
                        Object.assign(json[parentName], {[nestedName]: this.value || ""})

                    }
                }
            });
            return json;
        }

        $('#pemilik_id').on('change', function() {
            $('#nama_pemilik').html("");
            $('#alamat_pemilik').val("");
            $('#tipe_identitas_pemilik').val("");
            $('#nomor_identitas_pemilik').val("");
            if(this.value == ""){
                $('#pemilik_info').addClass("d-none");
                $('#pemilik_input').removeClass("d-none");
            }else{
                $('#pemilik_info').removeClass("d-none");
                $('#pemilik_input').addClass("d-none");
            }
            var value_pemilik_id = this.value;

            if(value_pemilik_id != ""){

                $.ajax({
                    type: "GET",
                    url: '{{url('/')}}/master-data/profile/detail/'+value_pemilik_id,
                    success: function(res) { 
                        $('#nama_pemilik').html(res['name']);
                        $('#alamat_pemilik').html(res['address']);
                        $('#tipe_identitas_pemilik').html(res['tipe_identitas']);
                        $('#nomor_identitas_pemilik').html(res['nomor_identitas']);
                    },
                    error: function(res) {
                        console.log(res.responseJSON.message);
                    }
                })

            }
        });

        let pemilikID   = $('#pemilik_id');
        if(pemilikID.val() != ''){
            pemilikID.trigger("change");
        }

        $('#btn_cancel_modal_tambah_pemilik').click(function () {
            
            pemilikBarang = {};

            $('#add-form-pemilik-barang').trigger('reset')
            $('#add-form-pemilik-barang select').trigger('change')
            $('#pemilik-barang-modal').modal('hide')
        });

        $('#add-modal').on('hide.bs.modal', function(e) {
            
            $('#add-form-pemilik-barang').trigger('reset')
            $('#add-form-pemilik-barang select').trigger('change')

            pemilikBarang = {};
        })

        $('#add-form-pemilik-barang').submit(function(e){
            e.preventDefault();
            let jsonObject = convertFormToJSON($(this));
            $.ajax({
                type: "POST",
                url: `{{url('/')}}/inbound-profile/store`,
                headers: {'X-CSRF-TOKEN': jsonObject._token},
                data: jsonObject,
                success: function(res) {
                    if(res != null){
                        jsonObject['id'] = res['pemilik']['id'];
                        jsonObject['pemilik_id'] = res['pemilik']['pemilik_id'];
                        jsonObject['pemilik_tipe_identitas'] = res['pemilik']['tipe_identitas'];
                        jsonObject['pemilik_nomor_identitas'] = res['pemilik']['nomor_identitas'];
                        jsonObject['pemilik_nama'] = res['pemilik']['name'];
                        jsonObject['pemilik_alamat'] = res['pemilik']['address'];
                        if(jsonObject.pemilik_id != null){
                            banyakPemilikBarang = banyakPemilikBarang.filter(function(val) { return val.pemilik_id != jsonObject.pemilik_id })
                        }

                        banyakPemilikBarang.push(jsonObject);
                        refreshPemilikBarang();

                    }

                    
                },
                error: function(res) {
                    console.log(res.responseJSON.message);
                }
            })

            $('#add-form-pemilik-barang').trigger('reset')
            $('#add-form-pemilik-barang select').trigger('change')
            $('#pemilik-barang-modal').modal('hide')
        });

        $('#pemilik-barang-modal').on('show.bs.modal', function(e) {

            // Get data
            $.ajax({
                type: "GET",
                url: '{{url('/')}}/master-data/profile/data-profile/pemilik-barang',
                async : false,
                success: function(res) {
                    var res = JSON.parse(res);
                    const result = [{id: "", name: "-- Select --"}].concat(res)
                    const mapOptions = result.map(v => ({id: v.id, text: v.name}));
                    var options = [];

                    // Check existing data of array
                    if(pemilikBarang == undefined)
                    {
                        $.each(mapOptions, function(i1, vl1){
                            var isFound = false;
                            $.each(banyakPemilikBarang, function(i2, vl2){
                                if(vl1.id == vl2.pemilik_id){
                                    isFound = true;
                                }
                            });

                            if(!isFound){
                                options.push(vl1);
                            }

                        });   
                    }

                    $('#pemilik_id').html("")
                    $('#pemilik_id').select2({data : pemilikBarang == undefined ? options : mapOptions});
                },
                error: function(res) {
                    Swal.fire("Error!", res.responseJSON.message, "error");
                }
            });

            if(Object.keys(pemilikBarang).length !== 0){ // Edit
                if(pemilikBarang.pemilik_id != ""){
                    $('#pemilik_no_seri').val(pemilikBarang.no_seri);
                    $('#pemilik_id').val(pemilikBarang.pemilik_id).trigger('change');
                }else {
                    $('#pemilik_id').val('').trigger('change');
                    $('#pemilik_no_seri').val(pemilikBarang.no_seri);
                    $('#pemilik_tipe_identitas').val(pemilikBarang.pemilik_tipe_identitas).trigger('change');
                    $('#pemilik_nomor_identitas').val(pemilikBarang.pemilik_nomor_identitas);
                    $('#pemilik_nama').val(pemilikBarang.pemilik_nama);
                    $('#pemilik_alamat').val(pemilikBarang.pemilik_alamat);
                }

                const mapOptions = inboundDetails.map(v => ({id: v.good_id, text: v.name}));
                $('#good_facility').html("")
                $('#good_facility').select2({data: mapOptions})
                $('#good_facility').val(pemilikBarang.good_facility).trigger('change');

                $('#good_facility_select').show();


            }else { // Create
                $('#pemilik_no_seri').val(parseInt(banyakPemilikBarang.length + 1));
                $('#good_facility_select').hide();
            }
        });

    })

</script>

@endpush