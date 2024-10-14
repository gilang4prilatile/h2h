<!--begin::Modal - New Target-->
<div class="modal fade" id="add-modal" aria-hidden="true">
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
                <form id="add-form" action="#">
                {{-- {!! Form::hidden('auth_token', $authToken ?? '', ['id' => 'auth_token']) !!} --}}
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <!--begin::Title-->
                    <h1 class="mb-3">Outbound Detail</h1>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="form-label required">Pilih Barang</label>
                        {!! Form::select('good_id', [], null, ['class' => 'form-select good-options', 'data-control' => 'select2', 'required' => true, 'placeholder' => '-- Select --']) !!}
                    </div>
                </div>
                <div class="form-group row" style="margin-top:10px;">
                    <div class="col-md-4">
                        <label class="form-label required">Kode Barang</label>
                        {!! Form::text('details[kode_barang]', null, ['class' => 'form-control', 'id' => 'kode_barang', 'readonly' => true]) !!}
                    </div>
                    <div class="col-md-4">
                        <label class="form-label required">Nama Barang</label>
                        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'readonly' => true]) !!}
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Spesifikasi Lain</label>
                        {!! Form::text('details[spesifikasi_lain]', null, ['class' => 'form-control', 'id' => 'spesifikasi_lain', 'readonly' => true]) !!}
                    </div>
                </div>

                <div class="form-group row" style="margin-top:10px;">
                    <div class="col-md-4">
                        <label class="form-label">Merek</label>
                        {!! Form::text('details[merk]', null, ['class' => 'form-control', 'id' => 'merk', 'readonly' => true]) !!}
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tipe</label>
                        {!! Form::text('details[type]', null, ['class' => 'form-control', 'id' => 'type', 'readonly' => true]) !!}
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ukuran</label>
                        {!! Form::text('details[ukuran]', null, ['class' => 'form-control', 'id' => 'ukuran', 'readonly' => true]) !!}
                    </div>
                </div>

                <div class="form-group row" style="margin-top:10px;">
                    <div class="col-md-6">
                        <label class="form-label">Pilih Dokumen</label>
                        {!! Form::select('good_documents[]', [], null, ['class' => 'form-select', 'id' => 'good-document-options', 'multiple' => true, 'required' => true, 'data-control' => 'select2']) !!}
                    </div>
{{--                    <div class="col-md-6">--}}
{{--                        <label class="form-label">HS Code</label>--}}
{{--                        {!! Form::select('hs_code_id', $hsCodes, null, ['class' => 'form-select hs-code-options', 'id' => 'hscode_id', 'data-control' => 'select2','required' => true]) !!}--}}
{{--                    </div>--}}
                    <div class="col-md-6">
                        <div class="d-flex">
                            <label class="form-label me-3">HS Code </label>
                            <div class="d-flex d-none" id='opsi-lartas'>
                                <p>Lartas : &nbsp;</p>
                                <p class=" " readonly ='readonly'  id ='status_lartas'>Pilih deHS code</p>
                            </div>

                        </div>

                        {!! Form::select('hs_code_id', $hsCodes, null, ['class' => 'form-select hs-code-options', 'id' => 'hscode_id', 'data-control' => 'select2' , $bc == 'BC23' ? 'required' : '']) !!}
                    </div>
{{--                    <div class="col-md-6">--}}
{{--                        <div  class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px;">--}}

{{--                            <h2 class="fw-bolder "> <label class="form-label required">HS Code</label></h2>--}}
{{--                            {!! Form::select('hs_code_id', $hsCodes, null, ['class' => 'form-select hs-code-options', 'id' => 'hscode_id', 'data-control' => 'select2','required' => true]) !!}--}}
{{--                            <div class="card p-1" style="margin-top: 10px" id="pemilik_barang_info">--}}
{{--                                <table  class=" table align-middle  table-row-dashed table-row-gray-400 fs-8 dataTable no-footer text-gray-600" role="grid" aria-describedby="table_info">--}}
{{--                                    <tbody >--}}
{{--                                    <tr>--}}
{{--                                        <td class="d-flex p-1">--}}
{{--                                            <div>Status Lartas : &nbsp;</div><div class=" " readonly ='readonly'  id ='status_lartas'>Pilih HS code</div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>

                <div class="form-group row" style="margin-top:10px;">
                    <div class="col-md-12">
                        <label class="form-label">Uraian Barang</label>
                        {!! Form::textarea('details[uraian]', null, ['class' => 'form-control', 'id' => 'uraian', 'readonly' => true]) !!}
                    </div>
                </div>
                @include("outbound.components.add.add_modal_partials.satuan_berat_harga")
                @include("outbound.components.add.add_modal_partials.kemasan")
                @if($bc == "BC25")
                    <div id="tarif-fasilitas-conversion"></div>
                    <div class="form-group row mt-8">
                        <div class="col-md-6">
                            <label class="form-label">Rate Preference</label>
                            {!! Form::select('details[rate_preference]', $ratePreferences, null, ['class' => 'form-select', 'data-control' => 'select2' , 'placeholder' => '-- Select --' ,'id' => 'detail-rate-preference']) !!}
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Fasilitas</label>
                            {!! Form::select('details[fasilitas]', $fasilitas , null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --' , 'id' => 'fasilitas']) !!}
                        </div>
                    </div>
                @endif


                <!--begin::Actions-->
                <div class="text-center" style="margin-top:20px;">
                    <button type="reset" id="button_cancel_modal_tambah_barang" class="btn btn-light me-3">Cancel</button>
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

            function float(equation, precision = 9) {
                return Math.floor(equation * (10 ** precision)) / (10 ** precision);
            }

            $('#button_cancel_modal_tambah_barang').click(function () {
                $('#add-form').trigger('reset')
                $('#add-form select').trigger('change')
                $('#add-modal').modal('hide')
            });

            $('#add-form').submit(function(e){
                e.preventDefault();
                let jsonObject = convertFormToJSON($('#add-form'))
                let good = goodOptions.find(function(v) { return v.id == jsonObject.good_id })

                let typeCalculate = $('#type-calculate').val();

                if(typeCalculate == 0 || typeCalculate == undefined){

                    var nettWeight = $('#nett_weight').val();
                    var volume = $('#volume').val();

                    var hargaPenyerahan = $('#detail-harga-penyerahan').val();

                   if(typeCalculate == 0){

                        // PPNBM 
                        var ppnbm = $('#ppnbm').val();
                        var ppnbmType = $('#ppnbm_tax_type').val();
                        var ppnbmValue = $('#ppnbm_tax_value').val();

                        // PPH 
                        var pph = $('#pph').val();
                        var pphType = $('#pph_tax_type').val();
                        var pphValue = $('#pph_tax_value').val();

                        if(ppnbm != 0 && ppnbmType != '' && ppnbmValue != 0 || 
                            ppnbm == 0 && ppnbmType == '' && ppnbmValue == 0){     
                        }else {
                            Swal.fire('Error', `Please fill all form on PPNBM`, "error")
                            return 
                        }

                        if(pph != 0 && pphType != '' && pphValue != 0 || 
                            pph == 0 && pphType == '' && pphValue == 0){
                        }else {
                            Swal.fire('Error', `Please fill all form on PPH`, "error")
                            return
                        }

                        let checkPungutan = checkPungutanValue();

                        if(!checkPungutan){
                            return
                        }

                   }

                    if(hargaPenyerahan == 0){
                        Swal.fire('Error', `Please fill all form on Harga Penyerahan`, "error")
                        return
                    }

                    if(nettWeight == 0 || volume == 0){
                        Swal.fire('Error', `Please fill all form on Netto & Volume`, "error")
                        return 
                    }


                }


                if (jsonObject.quantity > good.quantity) {
                    Swal.fire('Error', `Good's quantity insufficient! (max: ${good.quantity})`, "error")
                    return
                }

                if (selectedGood.good_id != undefined) {
                    selectedGoods = selectedGoods.filter(function(val) { return val.good_id != selectedGood.good_id })
                }

                selectedGoods.push(jsonObject)
                refreshGoodsInfo()

                $('#add-form').trigger('reset')
                $('#add-form select').trigger('change')
                $('#add-modal').modal('hide')
            })


            const loadGoodOptions = (id) => {
                $.ajax({
                    type: "GET",
                    url: 'inventory/eligible-goods/{{$bc}}',
                    success: function(res) {

                        let resFilter = res.filter(item => item.quantity != 0);
                        
                        const result = [{id: "", kode_barang : "--" , name: "Select", bc_form: "--"}].concat(resFilter)
                        goodOptions = result;
                        // this code will filter the goods those already selected
                        const mapOptions = result.map(v =>  ({id: v.id, text: `${v.kode_barang} - ${v.name} - ${v.bc_form ? '--' : 'Conversion'}`}))
                        let options = mapOptions.filter(option => selectedGoods.every(good => good.good_id != option.id))
                  
                        if (id != "") {
                            const editOption = mapOptions.find(option => option.id == id)
                            options.push(editOption)
                        }
                        $('.good-options').html("")
                        $('.good-options').select2({data: options})

                        if (id != "") {
                            $('.good-options').val(id).trigger('change')
                        }
                    },
                    error: function(res) {
                        Swal.fire("Error!", res.responseJSON.message, "error");
                    }
                })
            }

            $('.good-options').on('select2:select', function(e) {
                disabledFields(e.params.data.id != "")
                let good = goodOptions.find(function(v) { return v.id == e.params.data.id })              
                if (good.id != "") {
                    good.volume = '0';
                    good.nett_weight = '0';
                    autoFillDetail(good, good.details)
                }

            })

            $('.hs-code-options').on('select2:select', function(e) {
                // TODO: should check if bc is 25 or not
                $.ajax({
                    type: "GET",
                    url: 'master-data/hscode/' + e.params.data.id + '/ajax',
                    success: function(res) {
                        $('#bm').val(res.details.bm ?? 0)
                        $('#pph').val(res.details.pph_api ?? 0) // use pph api for imported goods
                        // $('#ppn').val(res.details.ppn)
                        $('#ppnbm').val(res.details.ppnbm ?? 0)
                    },
                })
            })

            $('#add-modal').on('hide.bs.modal', function(e) {
                $('#add-form').trigger('reset')
                $('#add-form select').trigger('change')
                selectedGood = {}
            })

            $('#add-modal').on('show.bs.modal', function(e) {
                // 10 is number of text "add" button
                $('#add-modal').focus();
                $('.good-options').focus();
                let documents = $('#outbound_documents')[0].innerText.length < 10 ? [] : $('#outbound_documents').repeaterVal().outbound_documents
                let data = documents.map((v, i, array) => {
                    return {id: i, text: `${v.nomor_dokumen} ${v.date}`}
                })
                $('#good-document-options').html("");
                $('#good-document-options').select2({data})
                disabledFields(selectedGood.good_id != undefined);
                loadGoodOptions(selectedGood.good_id || "");
                if (selectedGood.good_id != undefined) {
                    autoFillDetail(selectedGood, selectedGood.details)
                }
            })


            $('#hscode_id').on('change', function() {
                $('#status_lartas').val("");
                if(this.value == ""){
                    $('#opsi-lartas').addClass("d-none");

                }else{
                    $('#opsi-lartas').removeClass("d-none");

                    var value_hscode = this.value;
                    $.ajax({
                        type: "GET",
                        url: '{{url('/')}}/master-data/goods/detail/'+value_hscode,
                        success: function(res) {
                            $('#status_lartas').html(res['status_lantas']);
                        },
                        error: function(res) {
                            Swal.fire("Error!", res.responseJSON.message, "error");
                        }
                    })
                }

            });


            const autoFillDetail = (good, details) => {
                FormDataJson.fromJson($('#add-form'), good)
                $('#good-document-options').val(good.good_documents).trigger('change');
                $('#uom_id').val(good.uom_id).trigger('change');
                $('#hscode_id').val(good.hs_code_id).trigger('change')
                $('#detail-rate-preference').val(good.details.rate_preference).trigger('change')
                $('#fasilitas').val(good.details.fasilitas).trigger('change')

                // let nettWeightFirst = good.nett_weight * good.quantity;
                // let volumeFirst = good.volume * good.quantity;
                
                // nettWeight  = good.nett_weight;
                // volume      = good.volume;

                // $('#nett_weight').val(0);
                // $('#volume').val(0);

            }

            const disabledFields = (isDisable) => {
                if (!isDisable) {
                    $('#add-form').trigger('reset')
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

                // BM 
                var bmType = $('#bm_type').val();
                var bm = $('#bm').val();
                var bmValue = $('#bm_tax_value').val();

                // PPN 
                var ppn = $('#ppn').val();
                var ppnValue = $('#ppn_tax_value').val();

                // PPNBM 
                var ppnbm = $('#ppnbm').val();
                var ppnbmValue = $('#ppnbm_tax_value').val();

                // PPH 
                var pph = $('#pph').val();
                var pphValue = $('#pph_tax_value').val();

                if(bm > 100 && bmType == 1 || bmValue > 100){
                    Swal.fire('Error', `BM cannot bigger than 100% !`, "error")
                    return false;
                }

                if(ppn > 100 || ppnValue > 100){
                    Swal.fire('Error', `PPN cannot bigger than 100% !`, "error")
                    return false;
                }

                if(ppnbm > 100 || ppnbmValue > 100){
                    Swal.fire('Error', `PPNBM cannot bigger than 100% !`, "error")
                    return false;
                }

                if(pph > 100 || pphValue > 100){
                    Swal.fire('Error', `PPHValue cannot bigger than 100% !`, "error")
                    return false;
                }

                return true;
            }

        });
    </script>
@endpush
