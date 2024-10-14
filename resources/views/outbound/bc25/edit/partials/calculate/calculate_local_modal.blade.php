<!--begin::Modal - New Target-->
<div class="modal fade" id="calculate-local-modal" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-lg-1000px">
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
                <!--begin:Form-->
                <form id="add-form-calculate-local" action="#">
                {{-- {!! Form::hidden('auth_token', $authToken ?? '', ['id' => 'auth_token']) !!} --}}
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <!--begin::Title-->
                    <h1 class="mb-3">Outbound Detail</h1>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                {!! Form::hidden('id', null, ['class' => 'form-control', 'id' => 'did_barang_local', 'readonly' => true]) !!}
                {!! Form::hidden('inbound_detail_id', null, ['class' => 'form-control', 'readonly' => true]) !!}
                {!! Form::hidden('good_conversion_id', null, ['class' => 'form-control', 'readonly' => true]) !!}
                <div class="form-group row" style="margin-top:10px;">
                    <div class="col-md-4">
                        <label class="form-label required">Kode Barang</label>
                        {!! Form::text('details[kode_barang]', null, ['class' => 'form-control bg-secondary', 'id' => 'dkode_barang_local', 'readonly' => true]) !!}
                    </div>
                    <div class="col-md-4">
                        <label class="form-label required">Nama Barang</label>
                        {!! Form::text('name', null, ['class' => 'form-control bg-secondary', 'id' => 'dname_local', 'readonly' => true]) !!}
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Spesifikasi Lain</label>
                        {!! Form::text('details[spesifikasi_lain]', null, ['class' => 'form-control bg-secondary', 'id' => 'dspesifikasi_lain_local', 'readonly' => true]) !!}
                    </div>
                </div>

                <div class="form-group row" style="margin-top:10px;">
                    <div class="col-md-4">
                        <label class="form-label">Merek</label>
                        {!! Form::text('details[merk]', null, ['class' => 'form-control bg-secondary', 'id' => 'dmerk_local', 'readonly' => true]) !!}
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tipe</label>
                        {!! Form::text('details[type]', null, ['class' => 'form-control bg-secondary', 'id' => 'dtype_local', 'readonly' => true]) !!}
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ukuran</label>
                        {!! Form::text('details[ukuran]', null, ['class' => 'form-control bg-secondary', 'id' => 'dukuran_local', 'readonly' => true]) !!}
                    </div>
                </div>
                <div class="form-group row" style="margin-top:10px;">
                    <div class="col-md-12">
                        <label class="form-label">Uraian Barang</label>
                        {!! Form::textarea('details[uraian]', null, ['class' => 'form-control bg-secondary', 'id' => 'duraian_local', 'readonly' => true]) !!}
                    </div>
                </div>

                {{-- B1 --}}

                <h3 class="mb-3" style="margin-top: 10px;">SATUAN, BERAT, DAN HARGA</h3>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="form-label required">Jumlah Satuan</label>
                        {!! Form::number('quantity', 0, ['class' => 'form-control bg-secondary', 'id' => 'dquantity_local', 'required' => true,  'step' => 'any' , 'maxlength' => '18', 'min' => '0', 'required', 'readonly' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                        if(this.value<0){this.value='0'}"]) !!}
                    </div>
                    <div class="col-md-6">
                        <label class="form-label required">Jenis Satuan</label>
                        {!! Form::select('uom_id', $uoms, null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id' => 'duom_id_local','step' => 'any', 'required' => true]) !!}
                    </div>
                </div>

                <div class="form-group row" style="margin-top: 10px;">
                    <div class="col-md-6">
                        <label class="form-label required">Netto</label>
                        {!! Form::number('nett_weight', 0, ['class' => 'form-control', 'id' => 'dnett_weight_local', 'required' => true, 'step' => 'any', 'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                        if(this.value<0){this.value='0'}"]) !!}
                    </div>
                    <div class="col-md-6">
                        <label class="form-label required">Volume</label>
                        {!! Form::number('volume', 0, ['class' => 'form-control', 'id' => 'dvolume_local', 'required' => true, 'step' => 'any', 'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                        if(this.value<0){this.value='0'}"]) !!}
                    </div>
                    {{-- <div class="col-md-4">
                        <label class="form-label required">Bruto</label>
                        {!! Form::number('details[bruto]', 0, ['class' => 'form-control', 'id' => 'dbruto_local', 'required' => true, 'step' => 'any', 'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                        if(this.value<0){this.value='0'}"]) !!}
                    </div> --}}
                </div>
                <div class="form-group row" style="margin-top: 10px;">
                    <div class="col-md-6">
                        <label class="form-label required">Harga Perolehan</label>
                        {!! Form::number('details[harga_perolehan]', 0, ['class' => 'form-control', 'id' => 'dharga_perolehan_local','step' => 'any', 'required' => true,  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                        if(this.value<0){this.value='0'}"]) !!}
                    </div>
                    <div class="col-md-6">
                        <label class="form-label required">Harga Penyerahan</label>
                        {!! Form::number('details[harga_penyerahan]', 0, ['class' => 'form-control', 'id' => 'dharga_penyerahan_local', 'step' => 'any','required' => true,  'maxlength' => '18', 'min' => '0' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                        if(this.value<0){this.value='0'}"]) !!}
                    </div>
                </div>
                {{-- B1 --}}
                @include("outbound.bc25.edit.partials.calculate.calculate_tarif_fasilitas", ['from' => 'local'])

                <!--begin::Actions-->
                <div class="text-center" style="margin-top:20px;">
                    <button type="button" id="button_cancel_modal_tambah_barang_local" class="btn btn-light me-3">Cancel</button>
                    <button type="submit" id="button_tambah_barang" class="btn btn-primary">
                        <span class="indicator-label">Submit</span>
                    </button>
                </div>
                <!--end::Actions-->
            </form>
                <!--end:Form-->
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
        var goodOptions = [];
        $(document).ready(function() {
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
            $('#button_cancel_modal_tambah_barang_local').click(function () {
                $('#calculate-local-modal').modal('hide')
            });

            $('#add-form-calculate-local').submit(function(e){

                e.preventDefault();
                let jsonObject = convertFormToJSON($('#add-form-calculate-local'))
                let good = goodOptions.find(function(v) { return v.id == jsonObject.good_id })

                var beratBersih = $('#dnett_weight_local').val();
                var beratKotor = $('#dbruto_local').val();

                if(Number(beratBersih) > Number(beratKotor)){
                    Swal.fire('Error', `Netto must not be more than Bruto`, "error")
                    return
                }

                let checkPungutan = checkPungutanValue();

                if(!checkPungutan){
                    return
                }

                var hargaPenyerahan = $('#dharga_penyerahan_local').val();
                if(hargaPenyerahan == 0){
                    Swal.fire('Error', "Harga Penyerahan Cannot 0", "error")
                    return
                }

                $.each(selectedLocalGoods, (i, vi) => {

                    if(vi.inbound_detail_id == jsonObject.inbound_detail_id && vi.good_conversion_id == jsonObject.good_conversion_id){
                        var obj = Object.assign(vi.details, jsonObject.details);
                        vi.details = obj;
                        vi.volume = jsonObject.volume;
                        vi.nett_weight = jsonObject.nett_weight;
                    }

                });

                const token = "{{ csrf_token() }}"   
                let url = 'outbound-detail-raw-goods'
                let method = 'POST'
                if (selectedLocalGood.id) {
                    url += '/' + selectedLocalGood.id
                    method = 'PUT'
                    selectedLocalGoods = selectedLocalGoods.filter(function(val) { return val.id != selectedLocalGood.id })
                }
         
                selectedLocalGoods.push(jsonObject)

                refreshLocalGoodsInfo()
                refreshGoodsBahanBakuInfo()
                
                let jsonObjectOutbound = convertFormToJSON($('#create-form'))

                $.each(selectedGoods, (i, vi) => {

                    if(vi.good_id == jsonObject.good_conversion_id){
                        jsonObject.outbound_detail_id = vi.id;
                        jsonObject.outbound_id = vi.outbound_id;
                        jsonObject.good_id = vi.good_id;
                        jsonObject.kode_barang = jsonObject.details.kode_barang;
                        jsonObject.bc_form_id = selectedLocalGood.bc_form_id;
                    }

                });
        
                var dataUpload = {  
                    'outboundDetailRawGood' : jsonObject,
                    'outbound' : jsonObjectOutbound
                };

                $.ajax({
                    type: method,
                    url: url,
                    data: dataUpload,
                    headers: {'X-CSRF-TOKEN': token},
                    success: function(res) {

                        if(res.status == 'success'){

                            selectedLocalGoods.pop();
                            jsonObject.id = res.id;
                            selectedLocalGoods.push(jsonObject)
                            refreshLocalGoodsInfo()
                            refreshGoodsBahanBakuInfo()
                            $('#nav-tab a[href="#nav-local"]').click() // Select tab by name
                            $('#calculate-local-modal').modal('hide')
                            Swal.fire('Success', `Success to Add or Update Good !`, 'Success')

                        }else {

                            Swal.fire('Error', 'Failed to Add or Update Good !', 'error')

                        }

                    }
                })

                $('#add-form-calculate-local').trigger('reset')
                $('#add-form-calculate-local select').trigger('change')
            })


            $('#calculate-local-modal').on('hide.bs.modal', function(e) {
                $('#add-form-calculate-local').trigger('reset')
                $('#add-form-calculate-local select').trigger('change')
                selectedLocalGood= {}
            })

            $('#calculate-local-modal').on('show.bs.modal', function(e) {
                disabledFields(selectedLocalGood.id != undefined);
                if (selectedLocalGood.id != undefined) {
                    autoFillDetail(selectedLocalGood, selectedLocalGood.details)
                }
            })

            const autoFillDetail = (good, details) => {
                FormDataJson.fromJson($('#add-form-calculate-local'), good)
                $('#duom_id_local').val(good.uom_id).trigger('change');
                $('#quantity').val(good.quantity)
                console.log(good);
            }

            const disabledFields = (isDisable) => {
                if (!isDisable) {
                    $('#add-form-calculate-local').trigger('reset')
                }
                $('#kode_barang').prop('readonly', isDisable)
                $('#name').prop('readonly', isDisable)
                $('#spesifikasi_lain').prop('readonly', isDisable)
                $('#merk').prop('readonly', isDisable)
                $('#type').prop('readonly', isDisable)
                $('#ukuran').prop('readonly', isDisable)
                $('#uraian').prop('readonly', isDisable)
                $('#uom_id').prop('readonly', isDisable)
            }

            const checkPungutanValue = () => {

                // PPN 
                var ppn = $('#ppn_local').val();
                var ppnValue = $('#ppn_tax_value_local').val();

                if(ppn > 100 || ppnValue > 100){
                    Swal.fire('Error', `PPN cannot bigger than 100% !`, "error")
                    return false;
                }

                return true;
            }

        });
    </script>
@endpush
