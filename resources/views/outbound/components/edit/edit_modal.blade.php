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
                @csrf
                {{-- {!! Form::hidden('auth_token', $authToken ?? '', ['id' => 'auth_token']) !!} --}}
                {!! Form::hidden('outbound_id', $outbound->id) !!}
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <!--begin::Title-->
                    <h1 class="mb-3">Outbound Detail</h1>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="form-label">Pilih Barang</label>
                        {!! Form::select('good_id', [], null, ['class' => 'form-select good-options', 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id' => 'good_id']) !!}
                    </div>
                </div>
                <div class="form-group row" style="margin-top:10px;">
                    <div class="col-md-4">
                        <label class="form-label required">Kode Barang</label>
                        {!! Form::text('details[kode_barang]', null, ['class' => 'form-control', 'id' => 'kode_barang', 'required' => true]) !!}
                    </div>
                    <div class="col-md-4">
                        <label class="form-label required">Nama Barang</label>
                        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required' => true]) !!}
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Spesifikasi Lain</label>
                        {!! Form::text('details[spesifikasi_lain]', null, ['class' => 'form-control', 'id' => 'spesifikasi_lain']) !!}
                    </div>
                </div>

                <div class="form-group row" style="margin-top:10px;">
                    <div class="col-md-4">
                        <label class="form-label">Merk</label>
                        {!! Form::text('details[merk]', null, ['class' => 'form-control', 'id' => 'merk']) !!}
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Type</label>
                        {!! Form::text('details[type]', null, ['class' => 'form-control', 'id' => 'type']) !!}
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ukuran</label>
                        {!! Form::text('details[ukuran]', null, ['class' => 'form-control', 'id' => 'ukuran']) !!}
                    </div>
                </div>

                <div class="form-group row" style="margin-top:10px;">
                    <div class="col-md-6">
                        <label class="form-label">Pilih Dokumen</label>
                        {!! Form::select('good_documents[]', [], null, ['class' => 'form-select', 'id' => 'good-document-options', 'multiple' => true, 'data-control' => 'select2', 'required' => true]) !!}
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <label class="form-label me-3 ">HS Code  </label>
                            <div class="d-flex d-none"  id='opsi-lartas'>
                                <p>Lartas : &nbsp;</p>
                                <p class=" " readonly ='readonly'  id ='status_lartas'>Pilih HS code</p>
                            </div>
                        </div>

                        {!! Form::select('hs_code_id', $hsCodes, null, ['class' => 'form-select hs-code-options', 'id' => 'hscode_id', 'data-control' => 'select2','required' => true]) !!}
                    </div>
{{--                    <div class="col-md-4">--}}
{{--                        <div  class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px;">--}}

{{--                            <h2 class="fw-bolder "> <label class="form-label required">HS Code</label></h2>--}}
{{--                          --}}
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
                        <label class="form-label">Uraian</label>
                        {!! Form::textarea('details[uraian]', null, ['class' => 'form-control', 'id' => 'uraian']) !!}
                    </div>
                </div>

                @include("outbound.components.edit.edit_modal_partials.satuan_berat_harga")
                @include("outbound.components.edit.edit_modal_partials.kemasan")
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
                    <button type="button" id="button_cancel_modal_tambah_barang_edit" class="btn btn-light me-3">Cancel</button>
                    <button type="submit" id="button_tambah_barang_edit" class="btn btn-primary">
                        <div class="spinner-border text-light" role="status" id="loading_button_tambah_barang" style="display: none;">
                        </div>
                        <span class="indicator-label" id="text_button_tambah_barang">Submit</span>
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
        var autoFillDetail = null;
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

            var ndpbm = $('#ndpbm');
            var detailCifRP = $('#detail-cif-rp');
            var detailNilaiCif = $('#detail-nilai-cif');

            ndpbm.on('change', function(){

                countHargaIf();

            });

            detailNilaiCif.on('keyup', function(){

                countHargaIf();

            });


            function countHargaIf()
            {
                totalNilaiCif   = Number(ndpbm.val()) * Number(detailNilaiCif.val());
                detailCifRP.val(totalNilaiCif);
            }

            $('#button_cancel_modal_tambah_barang_edit').click(function () {
                $('#add-modal').modal('hide')
            });

            $('#add-form').submit(function(e){
                e.preventDefault();
                
                let typeCalculate = $('#type-calculate').val();
                let jsonObject = convertFormToJSON($('#add-form'));

                if(typeCalculate == 0 || typeCalculate == undefined){

                    var nettWeight = $('#nett_weight').val();
                    var volume = $('#volume').val();

                    if({{ $bc == "BC25" }})
                    {
                        var beratKotor = $('#total_berat_kotor').val();
                    }
                    else
                    {
                        var beratKotor = $('#berat_kotor').val();
                    }

                    var hargaPenyerahan = $('#detail-harga-penyerahan').val();

                    if(typeCalculate == 0){

                        // PPNBM 
                        var ppnbm = jsonObject.details.ppnbm;
                        var ppnbmType = jsonObject.details.ppnbm_tax_type;
                        var ppnbmValue = jsonObject.details.ppnbm_tax_value;

                        // PPH 
                        var pph = jsonObject.details.pph;
                        var pphType = jsonObject.details.pph_tax_type;
                        var pphValue = jsonObject.details.pph_tax_value;

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


                    }

                    let checkPungutan = checkPungutanValue();

                    if(!checkPungutan){
                        return
                    }

                    if(hargaPenyerahan == 0){
                        Swal.fire('Error', `Please fill all form on Harga Penyerahan`, "error")
                        return
                    }

                                    
                    if(nettWeight == 0 || volume == 0){
                        Swal.fire('Error', `Please fill all form on Netto & Volume`, "error")
                        return 
                    }

                    if(Number(nettWeight) > Number(beratKotor)){
                        Swal.fire('Error', `Netto must not be more than Bruto`, "error")
                        return
                    }

                }

                $('#button_tambah_barang_edit').attr('type', 'button');
                $('#button_tambah_barang_edit').attr("disabled", true);
                $('#loading_button_tambah_barang').show();
                $('#text_button_tambah_barang').hide();

                let good = goodOptions.find(function(v) { return v.id == jsonObject.good_id });
                if(selectedOutboundDetail.id){
                    if (parseInt(jsonObject.quantity) > parseInt(good.quantity) && parseInt(good.quantity) != 0) {
                        Swal.fire('Error', `Good's quantity insufficient! (max: ${good.quantity + selectedOutboundDetail.quantity})`, "error")
                        return
                    }
                }else {
                    if (parseInt(jsonObject.quantity) > parseInt(good.quantity)) {
                        Swal.fire('Error', `Good's quantity insufficient! (max: ${good.quantity})`, "error")
                        return
                    }
                }

                let url = 'outbound-details'
                let method = 'POST'
                if (selectedOutboundDetail.id) {
                    url += '/' + selectedOutboundDetail.id
                    method = 'PUT'
                    selectedGoods = selectedGoods.filter(function(val) { return val.id != selectedOutboundDetail.id })
                }

                // Set Perhitungan
                selectedGoods.push(jsonObject)
                refreshGoodsInfo()

                let jsonObjectOutbound = convertFormToJSON($('#create-form'))


                var dataUpload = {
                    'outboundDetail' : jsonObject,
                    'outbound'       : jsonObjectOutbound
                };

                $.ajax({
                    type: method,
                    url: url,
                    data: dataUpload,
                    headers: {'X-CSRF-TOKEN': jsonObject._token},
                    success: function(res) {

                        if(res.status == 'success'){
                            selectedGoods.pop();
                            jsonObject.id = res.id;
                            jsonObject.good = { // for outboundDetails object
                                name: jsonObject.name,
                                uom_id: jsonObject.uom_id
                            }
                            selectedGoods.push(jsonObject)
                            refreshGoodsInfo()

                            $('#add-modal').modal('hide')
                            Swal.fire('Success', `Success to Add or Update Good !`, 'Success')
                            $('#button_tambah_barang_edit').attr('type', 'submit');
                            $('#button_tambah_barang_edit').attr("disabled", false);
                            $('#loading_button_tambah_barang').hide();
                            $('#text_button_tambah_barang').show();
                        }else {

                            Swal.fire('Error', 'Failed to Add or Update Good !', 'error')

                        }

                    }
                })

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
            $('.good-options').on('select2:select', function(e) {
                let good = goodOptions.find(function(v) { return v.id == e.params.data.id })
                good.good_id = good.id
              
                $('#jenis_barang').val(good.details.jenis_barang).change()
                $('#uom_id').val(good.uom_id).change()
                
                FormDataJson.fromJson($('#add-form'), good)
            })

            $('.hs-code-options').on('select2:select', function(e) {
                $.ajax({
                    type: "GET",
                    url: 'master-data/hscode/' + e.params.data.id + '/ajax',
                    success: function(res) {
                        $('#bm').val(res.details.bm)
                        $('#pph').val(res.details.pph_api)
                        // $('#ppn').val(res.details.ppn)
                        $('#ppnbm').val(res.details.ppnbm)
                    },
                })
            })

            $('#add-modal').on('hide.bs.modal', function(e) {
                $('#add-form').trigger('reset')
                $('#add-form select').trigger('change')
                $('#good-document-options').html("");
                selectedOutboundDetail = {}
            })

            $('#add-modal').on('show.bs.modal', function(e) {
                $('#add-modal').focus();
                $('.good-options').focus();
                let data = $('#outbound_documents').repeaterVal().outbound_documents.map(function (v, i){
                    if(v.outbound_document_id == ''){
                        return;
                    }
                    return {id: i, text: `${v.nomor_dokumen} ${v.date}`} ;
                })


                $('#good-document-options').html("");
                $('#good-document-options').select2({data})

                disabledFields(selectedOutboundDetail.id != undefined);
                loadGoodOptions(selectedOutboundDetail.id || "");
            })

            const loadGoodOptions = (id) => {

                $.ajax({
                    type: "GET",
                    url: 'inventory/eligible-goods/{{$bc}}',
                    success: function(res) {

                        let resFilter = res.filter(item => item.quantity != 0);

                        const result = [{id: "", name: "-- Select --"}].concat(resFilter)
                        goodOptions = result;
                        // this code will filter the goods those already selected
                        const mapOptions = result.map(v => ({id: v.id, text: v.name}));
                        // let options = mapOptions.filter(option => outboundDetails.every(good => good.good_id != option.id))
                        let options = $.each(mapOptions, (i, vi) => { return vi });
                        if (JSON.stringify(selectedOutboundDetail) != '{}') {
                            const editOption = mapOptions.find(option => option.id == selectedOutboundDetail.good.id)
                            options.push(editOption)
                        }
                        $('.good-options').html("")
                        $('.good-options').select2({data: options})
                        if (JSON.stringify(selectedOutboundDetail) != '{}') {
                            $('.good-options').val(selectedOutboundDetail.good_id).trigger('change')
                            $('#detail-rate-preference').val(selectedOutboundDetail.details.rate_preference).trigger('change')
                            $('#hscode_id').val(selectedOutboundDetail.hs_code_id).trigger('change')
                            $('#fasilitas').val(selectedOutboundDetail.details.fasilitas).trigger('change')
                            // nettWeight  = selectedOutboundDetail.nett_weight;
                            // volume      = selectedOutboundDetail.volume;

                            // let nettWeightFirst = selectedOutboundDetail.nett_weight * selectedOutboundDetail.quantity;
                            // let volumeFirst = selectedOutboundDetail.volume * selectedOutboundDetail.quantity;
                          
                            $('#quantity').val(float(selectedOutboundDetail.quantity));
                            $('#nett_weight').val(float(selectedOutboundDetail.nett_weight));
                            $('#volume').val(float(selectedOutboundDetail.volume));

                        }
                    },
                    error: function(res) {
                        Swal.fire("Error!", res.responseJSON.message, "error");
                    }
                })
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
                $('#hscode_id').prop('readonly', isDisable)
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
