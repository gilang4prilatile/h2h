<!--begin::Modal - New Target-->
<div class="modal fade" id="add-modal" aria-hidden="true"> 
    <div class="modal-dialog modal-dialog-centered mw-lg-1000px"> 
        <div class="modal-content rounded"> 
            <div class="modal-header pb-0 border-0 justify-content-end"> 
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal"> 
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
                </div> 
            </div> 
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15"> 
                <form id="add-form" action="#">
                @csrf  
                <h1 class="mb-3 ">Detail Barang</h1> 
                <div class="form-group row"> 
                    <div class="col-md-6">
                        <div  class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey;">   
                        <h3 class="mb-3" style="margin-top: 10px; text-align: center;">BARANG</h3>
                            <hr class="mt-6 mb-6">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="form-label">Pilih Barang (Kosongi bila ingin membuat barang baru)</label>
                                    {!! Form::select('good_id', [], null, ['class' => 'form-select good-options', 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id' => 'good_id']) !!}
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-6">
                                    <label class="form-label">Kode Barang</label>
                                    {!! Form::text('details[kode_barang]', null, ['class' => 'form-control', 'id' => 'kode_barang']) !!}
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Barang</label>
                                    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
                                </div>
                                
                            </div>
                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-6">
                                    <label class="form-label">Spf Lain</label>
                                    {!! Form::text('details[spesifikasi_lain]', null, ['class' => 'form-control', 'id' => 'spesifikasi_lain']) !!}
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Merek</label>
                                    {!! Form::text('details[merk]', null, ['class' => 'form-control', 'id' => 'merk']) !!}
                                </div>
                            </div>    

                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-6">
                                    <label class="form-label">Tipe</label>
                                    {!! Form::text('details[type]', null, ['class' => 'form-control', 'id' => 'type']) !!}
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Ukuran</label>
                                    {!! Form::text('details[ukuran]', null, ['class' => 'form-control', 'id' => 'ukuran']) !!}
                                </div>
                            </div> 

                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-12">
                                    <label class="form-label">Uraian Barang</label>
                                    {!! Form::textarea('details[uraian]', null, ['class' => 'form-control', 'style' => 'min-height: 20px;', 'id' => 'uraian']) !!}
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-12">
                                    <label class="form-label">Pilih Dokumen, <i>relasi dengan barang ini</i></label>
                                    {!! Form::select('good_documents[]', [], null, ['class' => 'form-select', 'id' => 'good-document-options', 'multiple' => true,  'data-control' => 'select2']) !!}
                                </div>
                            </div>    
                            <div class="form-group row" style="margin-top:10px;">    
                                <div class="col-md-12">
                                    <div class="d-flex">
                                        <label class="form-label me-3">HS Code</label>
                                        <div class="spinner-border spinner-border-sm text-primary me-3 d-none" role="status" id="loading-spinner-barang">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div> 
                                    {!! Form::select('hs_code_id', $hsCodes, null, ['class' => 'form-select hs-code-options', 'id' => 'hscode_id', 'data-control' => 'select2' , $bc == 'BC23' ? 'required' : '']) !!}
                                </div> 
                            </div>
                            <div class="form-group row" style="margin-top:10px;">  
                            </div>
                               
                            @if($bc == "BC20")
                            <div class="form-group row" style="margin-top: 10px;"> 
                                    <div class="col-md-4">
                                        <label class="form-label">Status Lartas:</label>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input id="lartas" name="lartas" class="form-check-input" type="checkbox" value="1" onchange="handleLartasChange()"/>
                                            <label class="form-check-label" for="lartas"></label>
                                        </div>
                                    </div> 
                                    <div class="col-md-2"> 
                                        <div id="opsi-lartas" style="display: none;" class="d-flex">
                                            <label class="status-lartas ms-2 text-muted" readonly='readonly' id='status_lartas'></label>
                                            <i class="fas fa-exclamation-circle me-1" id="status_icon" style="color:red;"></i>
                                        </div> 
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="form-label required">Netto</label>
                                        {!! Form::number('nett_weight', 0, ['class' => 'form-control', 'id' => 'nett_weight', 'step' => 'any', 'required' => true, 'maxlength' => '18', 'min' => '0', 'onblur' => "formatToFourDecimals(this)" ]) !!}
                                    </div>  
                                  
                                    {{-- <div class="col-md-6">
                                        <label class="form-label required">Volume</label>
                                        {!! Form::number('volume', 0, ['class' => 'form-control', 'id' => 'volume', 'required' => true, 'step' => 'any', 'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                        if(this.value<0){this.value='0'}" ]) !!}
                                    </div>
                                    <div class="col-md-4" style="display:none;">
                                        <label class="form-label required">Bruto</label>
                                        {!! Form::number('details[bruto]', 0, ['class' => 'form-control', 'id' => 'bruto', 'step' => 'any' ,  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                        if(this.value<0){this.value='0'}" ]) !!}
                                    </div> --}} 
                                </div>

                                <div class="form-group row" style="margin-top: 10px;">
                                    <div class="col-md-6" id="kondisi_barang" name="kondisi_barang">
                                        <label class="form-label">Kondisi Barang</label>
                                        {!! Form::select('details[item_condition]', $kondisiBarang, null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --' , 'id' => 'item_condition']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Negara</label>
                                        {!! Form::select('details[item_country]', $country, null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --' , 'id' => 'item_country']) !!}
                                    </div>
                                </div>
                            @endif       
                        </div>
                    </div>  
                    <div class="col-md-6"> 
                        <div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey;">   
                            @include("air.components.add.add_modal_partials.satuan_berat_harga")
                        </div>
                    </div>  
                </div>  
                @if($bc == 'BC30') 
                    @include("air.components.add.add_modal_partials.entitas_barang")
                @endif
                @if($bc == 'BC20') 
                    <div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey;">                      
                    @include("air.components.add.add_modal_partials.jenis_transaksi")
                    </div>
                @endif
                @if($bc == 'BC20') 
                    @include("air.components.add.add_modal_partials.tarif_fasilitas")
                    
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
        var selectedHsCode = {};
        var bc = '{{ $bc }}';

        function formatToFourDecimals(input) {
            // Format ketika input kehilangan fokus (blur)
            if (input.value) {
                input.value = parseFloat(input.value).toFixed(4);
            }
        }

        function handleLartasChange() {
                const isChecked = $('#lartas').is(':checked');

                if (isChecked) {
                    // If checked, show "YA" status and green checkmark
                    $('#opsi-lartas').css('display', 'flex');
                    $('#status_icon').removeClass('fa-exclamation-circle').addClass('fa-check-circle');
                    $('#status_icon').css('color', 'green');
                    $('#status_lartas').html("YA");
                } else {
                    // If unchecked, show "TIDAK" status and red cross
                    $('#opsi-lartas').css('display', 'flex'); // Keep it visible if unchecked
                    $('#status_icon').removeClass('fa-check-circle').addClass('fa-times-circle');
                    $('#status_icon').css('color', 'red');
                    $('#status_lartas').html("TIDAK");
                }
            }

        $(document).ready(function() { 
            $('#lartas').change(function() {
                handleLartasChange();
            });
 
            handleLartasChange();
            $.fn.modal.Constructor.prototype._enforceFocus = function() {};
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

            var incotermId              = $('#incoterm_id');
            var detailNilaiCif          = $('#detail-nilai-cif');
            var detailQuantity          = $('#detail-quantity');
            var detailAmount            = $('#detail-amount');
            var detailFreight           = $('#detail-freight');
            var goodId                  = $('#good_id');
            var detailCifRP             = $('#detail-cif-rp');
          
            var biaya_penambah          = $('#biaya_penambah');
            var biaya_pengurang         = $('#biaya_pengurang');
            var HeaderAsuransi          = $('#asuransi');
            var HeaderFreight           = $('#freight');
            var HeaderHargaTotal        = $('#fob');
            var ndpbm                   = $('#ndpbm');
            var detailFob               = $('#detail-fob');
            var typeAsuransi            = $('#type-asuransi');
            var detailAsuransi          = $('#detail-asuransi'); 
            
            // var detailHargaDetil        = $('#detail-harga-detil');
            var detailBiayaPenambahDiskon = $('#detail-biaya-penambah-diskon'); 
            //var labelHargaBarang        = $('#label-harga-barang');
            var detailHargaSatuan       = $('#detail-harga-satuan');
            var bmType                  = $('#bm_type');

            bmType.on('change', function(){
                if($(this).val() == 2){
                    $('#bm_type_percen').hide();
                    $('#bm').attr('maxlength', 10);
                }else {
                    $('#bm_type_percen').show();
                    $('#bm').attr('maxlength', 3);
                }
            });

            goodId.on('change', function(){
                countHargaIf();
            });

            incotermId.on('change', function(){

                if($(this).val() != 1){
                    typeAsuransi.removeAttr('disabled');
                }else {
                    typeAsuransi.attr('disabled', 'disabled');
                    detailAsuransi.addClass('bg-secondary');
                }

                countHargaIf();
            });

            detailQuantity.on('keyup', function(){
                countHargaIf();
            });

            detailAmount.on('keyup', function(){
                countHargaIf();
                 document.getElementById("s-biaya-harga-barang").innerHTML = formatRupiah(this.value); 
            });

            detailFreight.on('keyup', function(){
                countHargaIf();
            });

            detailAsuransi.on('keyup', function(){
                countHargaIf();
                 document.getElementById("s-biaya-asuransi").innerHTML = formatRupiah(this.value);
            });

            detailBiayaPenambahDiskon.on('keyup', function(){
                countHargaIf();
                 document.getElementById("s-biaya-penambah-diskon").innerHTML = formatRupiah(this.value);
            });

          

            typeAsuransi.on('change', function(){

                var typeID = $(this).val();
                if(typeID == 0){
                    detailAsuransi.val(0);
                    detailAsuransi.attr('readonly', 'readonly');
                    detailAsuransi.addClass('bg-secondary');
                }else {
                    detailAsuransi.val(0);
                    detailAsuransi.removeAttr('readonly', 'readonly');
                    detailAsuransi.removeClass('bg-secondary');
                }
                countHargaIf();
            });

            detailAsuransi.on('keyup', function(){
                countHargaIf();
            });

            function countHargaIf() {

                let biaya_pengurang_val = Number(biaya_pengurang.val());
                let biaya_penambah_val = Number(biaya_penambah.val());

                if (biaya_pengurang_val > 0 && biaya_pengurang_val < biaya_penambah_val) {
                    discount = biaya_penambah_val - biaya_pengurang_val;
                } else {
                    discount = biaya_pengurang_val * -1;
                }

                var totalDetailBagiHeader   = (Number(detailAmount.val()) / Number(HeaderHargaTotal.val())) * 100;
                var totalDetailDiscount     = discount == 0 ? 0 : (totalDetailBagiHeader / 100) * discount;
                var totalFob                = (Number(detailAmount.val()) + totalDetailDiscount);
                var totalFreight            = HeaderFreight.val() == 0 ? 0 : (totalDetailBagiHeader / 100) * Number(HeaderFreight.val());
                var totalAsuransi           = HeaderAsuransi.val() == 0 ? 0 : (totalDetailBagiHeader / 100) * Number(HeaderAsuransi.val());
                var totalNilaiCif           = totalFob + totalFreight + totalAsuransi;
                var totalCifRP              = totalNilaiCif * Number(ndpbm.val());
                var totalHargaSatuan        = totalFob / Number(detailQuantity.val());

                console.log("detailAmount:", detailAmount.val());
                console.log("HeaderNilaiCif:", HeaderHargaTotal.val());
                console.log("totalDetailDiscount:", totalDetailDiscount);
                console.log("discount:", discount);
                console.log("biaya_penambah_val:", biaya_penambah_val);
                console.log("biaya_pengurang_val:", biaya_pengurang_val);
                console.log("HeaderAsuransi:", HeaderAsuransi.val()); 
                console.log("HeaderFreight:", HeaderFreight.val()); 
                console.log("totalDetailBagiHeader:", totalDetailBagiHeader); 

                // Format nilai ke dua angka di belakang koma
                totalDetailDiscount = totalDetailDiscount.toFixed(2);
                totalFob            = totalFob.toFixed(2);
                totalFreight        = totalFreight.toFixed(2);
                totalAsuransi       = totalAsuransi.toFixed(2);
                totalNilaiCif       = totalNilaiCif.toFixed(2);
                totalCifRP          = totalCifRP.toFixed(2);
                totalHargaSatuan    = totalHargaSatuan.toFixed(2); 

                detailHargaSatuan.val(totalHargaSatuan);
                detailNilaiCif.val(totalNilaiCif);
                detailFob.val(totalFob);
                detailAsuransi.val(totalAsuransi);
                detailCifRP.val(totalCifRP);
                detailBiayaPenambahDiskon.val(totalDetailDiscount);
                detailFreight.val(totalFreight);
            }

            $('#button_cancel_modal_tambah_barang').click(function () {
                $('#add-form').trigger('reset')
                $('#add-form select').trigger('change')
                $('#add-modal').modal('hide')
            });

            $('#add-form').submit(function(e){
                e.preventDefault();

                // PPNBM 
                var ppnbm = $('#ppnbm').val();
                var ppnbmType = $('#ppnbm_tax_type').val();
                var ppnbmValue = $('#ppnbm_tax_value').val();

                // PPH 
                var pph = $('#pph').val();
                var pphType = $('#pph_tax_type').val();
                var pphValue = $('#pph_tax_value').val();

                //var hargaPenyerahan = $('#detail-harga-penyerahan').val();

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
                
               // if(hargaPenyerahan == 0){
                   // Swal.fire('Error', `Please fill all form on Harga Penyerahan`, "error")
                   // return
               // }

                let checkPungutan = checkPungutanValue();

                if(!checkPungutan){
                    return
                }

                let jsonObject = convertFormToJSON($('#add-form'))
                console.log("SAVE");
                console.log(jsonObject);
                // jsonObject.good_id = Object.keys(selectedGood).length !== 0 
                //                     && jsonObject.good_id == "" ? selectedGood.good_id : jsonObject.good_id;

                jsonObject.good_documents = $("#good-document-options").val()
                if(Object.keys(selectedGood).length === 0){
                    if (jsonObject.good_id == "") {
                        $.ajax({
                            type: "POST",
                            url: 'master-data/goods/create-ajax',
                            headers: {'X-CSRF-TOKEN': jsonObject._token},
                            data: jsonObject,
                            success: function(res) {

                                // Untuk create barang tanpa kode & nama
                                jsonObject['good_id'] = res.id;
                                jsonObject['name'] = res.name;
                                jsonObject['kode_barang'] = res.kode_barang;
                                jsonObject['details']['kode_barang'] = res.kode_barang;

                                selectedGoods.push(jsonObject)
                                refreshGoodsInfo()
                                $('#add-form').trigger('reset')
                                $('#add-form select').trigger('change')
                                $('#add-modal').modal('hide')
                            },
                            error: function(res) {
                                Swal.fire("Error!", res.responseJSON.message, "error");
                            }
                        })
                        return
                    }
                }
                
                if(Object.keys(selectedGood).length !== 0){

                    if(selectedGood.good_id != undefined 
                    && selectedGood.good_id != ''){
                        selectedGoods = selectedGoods.filter(function(val) { return val.good_id != selectedGood.good_id })
                    }else {
                        selectedGoods = selectedGoods.filter(function(val) { return val.no_seri != selectedGood.no_seri })
                    }

                }

                selectedGoods.push(jsonObject)
                refreshGoodsInfo()

                if(jsonObject.details['entitas_barang_id'] != undefined){
                    $.each(banyakPemilikBarang, function(i, vl) {
                        if(jsonObject.details['entitas_barang_id'] == vl.pemilik_id){
                            if(vl.good_facility != undefined){
                                goodFacility = vl.good_facility;
                                goodFacility.push(jsonObject.good_id);
                                vl.good_facility = goodFacility;
                            }else {
                                vl.good_facility = [jsonObject.good_id];
                            }
                        }
                    });
                }

                // PEB check bruto and netto
                var detailBrutoPEB = $('#detail-bruto').val();
                var detailNettoPEB = $('#detail-netto').val();

                if(detailBrutoPEB != undefined 
                && detailNettoPEB != undefined){
                    if(parseFloat(detailBrutoPEB) < parseFloat(detailNettoPEB)){
                        $('.alert-bruto-netto-good').show();
                        $('#submit-button').attr('disabled', true);
                    }else {
                        $('.alert-bruto-netto-good').hide();
                        $('#submit-button').removeAttr('disabled');
                    }


                }

                $('#add-form').trigger('reset')
                $('#add-form select').trigger('change')
                $('#add-modal').modal('hide')
            })

            const loadGoodOptions = (good) => {

                $('#good_id').select2({
                    ajax : {
                        url : "{{url('/')}}/master-data/goods/raw-good-search",
                        dataType : "json",
                        data : function(params){
                            var query = {
                                search : params.term
                            }

                            return query;   
                        },
                        processResults : function(data){
                            return {
                                results : data
                            }
                        }
                    },
                    cache : true,
                    placeholder : "Search for goods",
                    minimumInputLength : 2

                });

                if(good != undefined){
                    var optionGood = new Option(`[${good.details.kode_barang}] ${good.name}`, good.good_id, true, true);
                    $('#good_id').append(optionGood).trigger("change");
                }else {
                    var optionGood = new Option(``, '', true, true);
                    $('#good_id').append(optionGood).trigger("change");
                }


            }


            $('#good_id').on('change', function() {
                var id = $(this).val();
                disabledFields(id != "")
                if(id != "" || id != undefined)
                    $.ajax({
                        type: "GET",
                        url: `{{url('/')}}/master-data/goods/detail-raw-good/${id}`,
                        success: function(res) {
                            var result = JSON.parse(res);
                            if(result.status == 'success')
                                autoFillDetail(result.good, result.good.details)
                        },
                        failed : function(err){
                            console.log(err);
                        }
                    })
                // console.log(e.params);
                // disabledFields(e.params.data.id != "")
                // let good = goodOptions.find(function(v) { return v.id == e.params.data.id })
                // if (good.id != "") {
                //     autoFillDetail(good, good.details)
                // }
            })

           /* $('.hs-code-options').on('select2:select', function(e) {
                // TODO: should check if bc is 23 or not
                $.ajax({
                    type: "GET",
                    url: '{{url('/')}}/master-data/hscode/' + e.params.data.id + '/ajax',
                    success: function(res) {
                        $('#bm').val(res.details.bm ?? 0)
                        $('#pph').val(res.details.pph_api ?? 0) // use pph api for imported goods
                        $('#ppnbm').val(res.details.ppnbm ?? 0)
                    },
                })
            })*/

            $('#add-modal').on('hide.bs.modal', function(e) {
                $('#add-form').trigger('reset')
                $('#add-form select').trigger('change')
                selectedGood = {}
            })

            $('#add-modal').on('show.bs.modal', function(e) {

                if ($('#intangible_status').val() == '1') {
                    $('#div_kemasan').hide();
                    $('#dareah_asal_barang').hide();
                    $('#netto').hide();
                    $('#kondisi_barang').hide();
                    $('#nett_weight').removeAttr('required');
                    $('#details[bruto]').removeAttr('required');
                    $('#package_id').removeAttr('required');
                    
                     
                }else{
                    $('#div_kemasan').show();
                    $('#dareah_asal_barang').show();
                    $('#netto').show();
                    $('#kondisi_barang').show(); 
                }

                $('#entitas_barang').hide();
                
                $('#select-detail-place-of-origin-bc30').hide();

                // if($('#hincoterm_id').val() == "" || $('#hincoterm_id').val() == null){
                //     $('#add-form').trigger('reset')
                //     $('#add-form select').trigger('change')
                //     Swal.fire({
                //         icon: 'error',
                //         title: 'Error!',
                //         text: 'Silahkan isi dulu data incoterm di tab transaksi',
                //     }).then(() => {
                //         $('#add-modal').modal('hide');
                //     });
                // }

                $('#incoterm_id').val($('#hincoterm_id').val()).change();
                $('#incoterm_id').attr('disabled', 'disabled');

                let documents = [];
                let inboundDocumentsElement = $('#inbound_documents');
                 
                if (inboundDocumentsElement.length > 0) {
                    let inboundDocumentsText = inboundDocumentsElement[0].innerText;
 
                    if (inboundDocumentsText.length >= 10 && typeof inboundDocumentsElement.repeaterVal === 'function') {
                        try {
                            let repeaterData = inboundDocumentsElement.repeaterVal();
 
                            if (repeaterData && Array.isArray(repeaterData.inbound_documents)) {
                                documents = repeaterData.inbound_documents;
                            }
                        } catch (error) {
                            console.error("Error accessing repeaterVal:", error);
                        }
                    }
                }

                // if (documents.length === 0) {
                //     console.log("No documents found, triggering reset and hiding modal.");
                //     $('#add-form').trigger('reset');
                //     $('#add-form select').trigger('change');
                //     Swal.fire({
                //         icon: 'error',
                //         title: 'Error!',
                //         text: 'Silahkan isi dulu data dokumen di tab dokumen',
                //     }).then(() => {
                //         $('#add-modal').modal('hide');
                //     });
                // } else {
                //     console.log("Documents found, proceeding.");
                // }
                

                let data = documents.map((v, i, array) => {
                    return {id: i, text: `${v.nomor_dokumen} ${v.date}`}
                })
                $('#good-document-options').html("");
                $('#good-document-options').select2({data})
                loadGoodOptions(selectedGood.good_id != undefined && selectedGood.good_id != '' ? selectedGood : undefined);
                // Check Edit 
                if (Object.keys(selectedGood).length !== 0
                && bc == 'BC30') {

                    const resultEntitasBarang = [{pemilik_id: "", pemilik_nama: "-- Select --"}].concat(banyakPemilikBarang)
                    const mapOptions = resultEntitasBarang.map(v => ({id: v.pemilik_id, text: v.pemilik_nama}));
                    $('#entitas_barang_id').html("")
                    $('#entitas_barang_id').select2({data: mapOptions})
                    var disabledEntitasBarang = false;
                    $.each(banyakPemilikBarang, function(i, vl1){
                        if(selectedGood.details['entitas_barang_id'] != undefined 
                        && selectedGood.details['entitas_barang_id'] != ""){
                            if(vl1.pemilik_id == selectedGood.details['entitas_barang_id']){
                                $('#entitas_barang_id').val(vl1.pemilik_id).trigger('change');
                                disabledEntitasBarang = true;
                            }
                        }
                    });

                    $('#entitas_barang_id').attr('disabled', disabledEntitasBarang);
                    $('#entitas_barang').show();
                } 
                
                if(Object.keys(selectedGood).length !== 0) {
                    autoFillDetail(selectedGood, selectedGood.details);
                }

                
            })

            


            function getTarifHs(value_id) {
                $.ajax({
                    type: "GET",
                    url: '{{url('/')}}/air/pib/tarifhs/' + value_id,
                    success: function(res) { 
                        if (res.lartas.length > 0) { 
                        // Show the element with the note
                            $('#opsi-lartas').css('display', 'flex');
                            
                            $('#status_icon').removeClass('fa-exclamation-circle').addClass('fa-check-circle');
                            $('#status_icon').css('color', 'green');
                             
                            $('#lartas').prop('checked', true);
                             
                            $('#status_lartas').html("YA");
                        } else { 
                            // Hide the element
                            $('#opsi-lartas').css('display', 'none');
                             
                            $('#status_icon').removeClass('fa-check-circle').addClass('fa-times-circle');
                            $('#status_icon').css('color', 'red');
                             
                            $('#lartas').prop('checked', false);
                             
                            $('#status_lartas').html("TIDAK");
                        }

                        if (res.DokumenFasilitas.length > 0) {
                            Swal.fire({
                                title: "Alert!",
                                html: "<strong>Ooops! Barang Anda terkena lartas. Jangan lupa fasilitas di bawah ini dan ada dokumen tambahan yang harus diunggah di tab dokumen:</strong><br><br>" + res.DokumenFasilitas.join("<br>"),
                                icon: "info",
                                width: '600px'  
                            });

                            $('#note_laert').val("Ooops! Barang Anda terkena lartas. Jangan lupa");
                        }

                        $('#bm').val(res.tarifMap['BM']);
                        $('#ppn').val(res.tarifMap['PPN']);
                        $('#pph').val(res.tarifMap['PPH']);
                        $('#ppnbm').val(res.tarifMap['PPNBM']);
                    },
                    error: function(res) {
                        Swal.fire("Error!", res.responseJSON.message, "error");
                    },
                    complete: function() {
                        $('#loading-spinner-barang').addClass("d-none");
                    }
                });
            } 

            const autoFillDetail = (good, details) => {

                if(Object.keys(selectedGood).length !== 0){
                    good = {...good, ...selectedGood};
                }

                delete good.amount;
                delete good.details.fob_unit;
                FormDataJson.fromJson($('#add-form'), good)                
                $('#type-asuransi').val(good.details.type_asuransi).trigger('change');
                $('#detail-asuransi').val(good.details.asuransi ?? 0);
                $('#good-document-options').val(good.good_documents).trigger('change');
              
               // $('#incoterm_id').val(good.details.incoterm_id).trigger('change')
                // $('#kode_barang').val(details.kode_barang)
                // $('#name').val(good.name)
                // $('#spesifikasi_lain').val(details.spesifikasi_lain)
                // $('#merk').val(details.merk)
                // $('#type').val(details.type)
                // $('#ukuran').val(details.ukuran)
                // $('#uraian').val(details.uraian)
                // $('#quantity').val(good.quantity)
                // $('#amount').val(good.amount)
                $('#uom_id').val(good.uom_id)
                $('#uom_id').trigger('change')
                $('#nett_weight').val(formatDecimal(good.nett_weight))
                // $('#package_id').val
                //
                if(good.hs_code_id != undefined){
                    $('#hscode_id').val(good.hs_code_id).trigger('change');
                }

                // const packageDetails = good.package_details
                // if (packageDetails != undefined) {
                //     $('#merk_kemasan').val(packageDetails.merk)
                //     $('#jumlah').val(packageDetails.jumlah)
                // }

                // SELECT ON BC 2.0
                $('#cukai_jenis_satuan').val(good.details.cukai_jenis_satuan).trigger('change');
                $('#cukai_jenis_satuan_kemasan').val(good.details.cukai_jenis_satuan_kemasan).trigger('change');
                $('#cukai_jenis_tarif').val(good.details.cukai_jenis_tarif).trigger('change');
                $('#item_condition').val(good.details.item_condition).trigger('change');
                $('#item_country').val(good.details.item_country).trigger('change');

                // SELECT ON BC 3.0
                $('#detail-fob-bc30').val(good.details.fob).trigger('change');
                $('#detail-volume-bc30').val(good.details.volume);
                $('#detail-place-of-origin-bc30').val(good.details.item_place_of_origin).trigger('change');
                $('#detail-country-bc30').val(good.details.item_country).trigger('change');
                $('#uom-id-bc30').val(good.details.uom_id).trigger('change');
                $('#package_id').val(good.package_id).trigger('change');

            }

            $('#hscode_id').select2({
                tags: true,
                placeholder: "-- Select --",
                allowClear: true,
                createTag: function(params) {
                    return {
                        id: params.term,
                        text: params.term,
                        newOption: true
                    };
                },
                templateResult: function(data) {
                    var $result = $("<span></span>");
                    $result.text(data.text);
                    if (data.newOption) {
                        $result.append(" <em>(new)</em>");
                    }
                    return $result;
                }
            }).on('select2:select', function(e) {
                var value_id = e.params.data.id.trim(); 
                console.log("Selected HS Code:", value_id);  

                if (value_id !== "") {
                    $('#loading-spinner-barang').removeClass("d-none");
 
                    var optionExists = false;
                    $('#hscode_id option').each(function() {
                        if ($(this).val() === value_id && !$(this).data('select2-tag')) {
                            optionExists = true;
                            return false; 
                        }
                    });

                    if (optionExists) { 
                        console.log("HS Code ada di master data:", value_id);  
                        getTarifHs(value_id);
                    } else {
                        console.log("HS Code tidak ada di master data dan akan di insert:", value_id);
                        
                        $.ajax({
                            type: "GET",
                            url: '{{url('/')}}/air/pib/tarifhs/' + value_id,
                            success: function(res) { 
                                if (res.tarifMap) { 
                                    var jsonObject = {
                                        _token: '{{ csrf_token() }}',
                                        code: value_id,
                                        bm: res.tarifMap['BM'] || null,
                                        ppn: res.tarifMap['PPN'] || null,
                                        pph: res.tarifMap['PPH'] || null,
                                        ppnbm: res.tarifMap['PPNBM'] || null,
                                        status_lantas: '0',
                                        description_id: 'Lain-lain',
                                        description_eng: 'Other'
                                    }; 
                                    $.ajax({
                                        type: "POST",
                                        url: '{{url('/')}}/master-data/hscode/create-ajax',
                                        headers: {'X-CSRF-TOKEN': jsonObject._token},
                                        data: jsonObject,
                                        success: function(res) {
                                    
                                            getTarifHs(value_id);
                                        },
                                        error: function(res) {
                                            Swal.fire("Error!", res.responseJSON.message, "error");
                                            $('#loading-spinner-barang').addClass("d-none");
                                        }
                                    });
                                } else {
                                    Swal.fire("Error!", "Tarif data tidak ditemukan untuk kode HS ini.", "error");
                                    $('#loading-spinner-barang').addClass("d-none");
                                }
                            },
                            error: function(res) {
                                Swal.fire("Error!", res.responseJSON.message, "error");
                                $('#loading-spinner-barang').addClass("d-none");
                            }
                        });
                    }

                } else { 
                    Swal.fire("Error!", "Kode HS tidak boleh kosong.", "error");
                }
            });

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

            // START CALCULATION BC30

            $('#detail-quantity-bc30').on('keyup', function(){
                var hargaFOBBC30 = $('#detail-fob-bc30').val();
                if(hargaFOBBC30 != 0 || hargaFOBBC30 != ''){
                    var calculate = (hargaFOBBC30 / $(this).val());
                    $('#detail-fob-unit-bc30').val(calculate);
                }
            });

            $('#detail-fob-bc30').on('keyup , change', function(){
                var hargaQuantity = $('#detail-quantity-bc30').val();
                if(hargaQuantity != 0 || hargaQuantity != ''){
                    var calculate = ($(this).val() / hargaQuantity);
                    $('#detail-fob-unit-bc30').val(calculate);
                }
            });

            // END CALCULATION BC30

        });


    //var tanpa_rupiah = document.getElementById('detail-harga-penyerahan');
    //tanpa_rupiah.addEventListener('keyup', function(e)
    //{
       //  document.getElementById("s-harga-penyerahan").innerHTML = formatRupiah(this.value);
   // });

    /* Fungsi */
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    $('#detail-country-bc30').on('change', function(){
        if($(this).val() == 'ID' 
        || $(this).val() == 1){
            $('#select-detail-place-of-origin-bc30').show();
            $('#input-detail-place-of-origin-bc30').hide();
        }else {
            $('#select-detail-place-of-origin-bc30').hide();
            $('#input-detail-place-of-origin-bc30').show();
        }
    });

    document.getElementById('fob').addEventListener('input', function(e) {
        let value = parseFloat(e.target.value) || 0; 
        document.getElementById('lblfob').innerText = formatNumber(value);
    });
    
    document.getElementById('show_cukai').addEventListener('change', function() {
        var cukaiDetails         = document.getElementById('cukai_1'); 
        if (this.checked) {
            cukaiDetails.style.display = 'block'; 
        } else {
            cukaiDetails.style.display = 'none'; 
        }
    });

    // Validation Tarif & Fasilitas


    </script>
@endpush
