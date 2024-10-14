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
                <!-- {{-- {!! Form::hidden('auth_token', $authToken ?? '', ['id' => 'auth_token']) !!} --}} -->
                {!! Form::hidden('inbound_id', $inbound->id) !!}
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <!--begin::Title-->
                    <h1 class="mb-3">Inbound Detail</h1>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="form-label">Pilih Barang (Kosongi bila ingin membuat barang baru)</label>
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
                        <label class="form-label">Spf Lain</label>
                        {!! Form::text('details[spesifikasi_lain]', null, ['class' => 'form-control', 'id' => 'spesifikasi_lain']) !!}
                    </div>
                </div>

                <div class="form-group row" style="margin-top:10px;">
                    <div class="col-md-4">
                        <label class="form-label">Merek</label>
                        {!! Form::text('details[merk]', null, ['class' => 'form-control', 'id' => 'merk']) !!}
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tipe</label>
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
                        {!! Form::select('good_documents[]', [], null, ['class' => 'form-select', 'id' => 'good-document-options', 'multiple' => true, 'data-control' => 'select2']) !!}
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex">
                            <label class="form-label me-3">HS Code  </label>
                            <div class="d-flex d-none" id='opsi-lartas'>
                                <p>Lartas : &nbsp;</p>
                                <p class=" " readonly ='readonly'  id ='status_lartas'>Pilih HS code</p>
                            </div>

                        </div>

                        {!! Form::select('hs_code_id', $hsCodes, null, ['class' => 'form-select hs-code-options', 'id' => 'hscode_id', 'data-control' => 'select2' , $bc == 'BC23' ? 'required' : '']) !!}
                    </div>
                </div>

                <div class="form-group row" style="margin-top:10px;">
                    <div class="col-md-12">
                        <label class="form-label">Uraian Barang {{$bc}}</label>
                        {!! Form::textarea('details[uraian]', null, ['class' => 'form-control', 'id' => 'uraian']) !!}
                    </div>
                </div>
                @include("air.components.edit.edit_modal_partials.satuan_berat_harga")
                <div id="div_kemasan" name="div_kemasan">
                @include("air.components.edit.edit_modal_partials.kemasan")
                </div>
                @if($bc == '20')
                    @include("air.components.edit.edit_modal_partials.tarif_fasilitas")
                @endif
                @if($bc == 'BC20') 
                    @include("air.components.edit.add_modal_partials.jenis_transaksi")
                @endif
                <!--begin::Actions-->
                <div class="text-center" style="margin-top:20px;">
                    <button type="button" id="button_cancel_modal_tambah_barang" class="btn btn-light me-3">Cancel</button>
                    <button type="submit" id="button_tambah_barang"  class="btn btn-primary">
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
        $(document).ready(function() {
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
            var detailBiayaPenambah     = $('#detail-biaya-penambah');
            var detailBiayaPengurang    = $('#detail-biaya-pengurang');
            var detailBiayaPenambahDiskon = $('#detail-biaya-penambah-diskon'); 
            var labelHargaBarang        = $('#label-harga-barang');
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

            function countHargaIf(){
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

               // if(incotermId.val() == 3){
                    //totalHargaSatuan    =  ( totalFob / Number(detailQuantity.val()) );
                   // detailFob.val(totalFob);
                //}else if(incotermId.val() == 1){
                    //totalHargaSatuan    = ( totalNilaiCif / Number(detailQuantity.val()));
                   // detailFob.val(0);
                   // detailFreight.val(0);
               // }

                dtotalDetailDiscount = totalDetailDiscount.toFixed(2);
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
                $('#add-modal').modal('hide')
            });

            $('#add-form').submit(function(e){

                e.preventDefault();
                let jsonObject = convertFormToJSON($('#add-form'))
                
                var nettWeight = $('#nett_weight').val();
                var volume = $('#volume').val();
                var beratKotor = $('#berat_kotor').val();

                 // PPNBM 
                var ppnbm = $('#ppnbm').val();
                var ppnbmType = $('#ppnbm_tax_type').val();
                var ppnbmValue = $('#ppnbm_tax_value').val();

                // PPH 
                var pph = $('#pph').val();
                var pphType = $('#pph_tax_type').val();
                var pphValue = $('#pph_tax_value').val();

                var hargaPenyerahan = $('#detail-harga-penyerahan').val();

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
                
                if(hargaPenyerahan == 0){
                    Swal.fire('Error', `Please fill all form on Harga Penyerahan`, "error")
                    return
                }

                let checkPungutan = checkPungutanValue();

                if(!checkPungutan){
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

                $('#button_tambah_barang').attr('type', 'button');
                $('#button_tambah_barang').attr('disabled', true);
                $('#loading_button_tambah_barang').show();
                $('#text_button_tambah_barang').hide();
                
                jsonObject.good_documents = $("#good-document-options").val()

                if (jsonObject.good_id == "") {
                    $.ajax({
                        type: "POST",
                        headers: {'X-CSRF-TOKEN': jsonObject._token},
                        url: '{{url('/')}}/master-data/goods/create-ajax',
                        data: jsonObject,
                        success: function(res) {
                            jsonObject.good_id = res.id
                            upsertInboundDetail(jsonObject, jsonObject._token)
                        },
                        error: function(res) {
                            Swal.fire("Error!", res.responseJSON.message, "error");
                        }
                    })

                    return
                }
                upsertInboundDetail(jsonObject, jsonObject._token);
            })

            const upsertInboundDetail =  (jsonObject , token) => {

                let url = 'inbound-details'
                let method = 'POST'
                if (selectedInboundDetail.good_id) {
                    url += '/' + selectedInboundDetail.id
                    method = 'PUT'
                    inboundDetails = inboundDetails.filter(function(val) { return val.id != selectedInboundDetail.id })
                }

                // Set Perhitungan
                inboundDetails.push(jsonObject)
                refreshGoodsInfo()

                let jsonObjectInbound = convertFormToJSON($('#create-form'))

                var dataUpload = {
                    'inboundDetail' : jsonObject,
                    'inbound'       : jsonObjectInbound
                };

                $.ajax({
                    type: method,
                    url: url,
                    headers: {'X-CSRF-TOKEN': token},
                    data: dataUpload,
                    success: function(res) {
                        console.log(res);
                        if(res.status == 'success'){
                            inboundDetails.pop();
                            jsonObject.id = res.id;
                            jsonObject.good = { // for inboundDetails object
                                name: jsonObject.name,
                                uom_id: jsonObject.uom_id
                            }
                            inboundDetails.push(jsonObject)
                            refreshGoodsInfo()

                            // update Inbound
                            $('#add-modal').modal('hide')
                            Swal.fire('Success', `Success to Add or Update Good !`, 'Success')
                            $('#button_tambah_barang').attr('type', 'submit');
                            $('#button_tambah_barang').removeAttr('disabled');
                            $('#loading_button_tambah_barang').hide();
                            $('#text_button_tambah_barang').show();
                        }else {
                            Swal.fire('Error', 'Failed to Add or Update Good !', 'error')
                        }
                    }
                })
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

            function getTarifHs(value_id) {
                $.ajax({
                    type: "GET",
                    url: '{{url('/')}}/air/pib/tarifhs/' + value_id,
                    success: function(res) { 
                        if (res.lartas.length > 0) {
                            $('#status_lartas').html(res.lartas[0]['lartas']);
                            $('#opsi-lartas').removeClass("d-none");
                        } else {
                            $('#status_lartas').html("tidak ada lartas");
                            $('#opsi-lartas').addClass("d-none");
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

                if(Object.keys(selectedInboundDetail).length !== 0){
                    good = {...good, ...selectedInboundDetail};
                }

                delete good.amount;
                FormDataJson.fromJson($('#add-form'), good)                
                $('#type-asuransi').val(good.details.type_asuransi).trigger('change');
                $('#detail-asuransi').val(good.details.asuransi ?? 0);
                if(good.good_documents != undefined){
                    $('#good-document-options').val(good.good_documents).trigger('change');
                }
              
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
         
                $('#hscode_id').val(good.hs_code.code)
                $('#hscode_id').trigger('change')

                // const packageDetails = good.package_details
                // if (packageDetails != undefined) {
                //     $('#merk_kemasan').val(packageDetails.merk)
                //     $('#jumlah').val(packageDetails.jumlah)
                // }

                // SELECT ON BC 3.0
                $('#detail-place-of-origin-bc30').val(good.details.item_place_of_origin).trigger('change');
                $('#detail-country-bc30').val(good.details.item_country).trigger('change');
                $('#uom-id-bc30').val(good.details.uom_id).trigger('change');
                $('#package_id').val(good.package_id).trigger('change');

            }

            // $('.good-options').on('select2:select', function(e) {
            //     let good = goodOptions.find(function(v) { return v.id == e.params.data.id })
            //     good.good_id = good.id
            //     FormDataJson.fromJson($('#add-form'), good)
            //     $('#jenis_barang').val(good.details.jenis_barang).change()
            //     $('#uom_id').val(good.uom_id).change()
            //     $('#nett_weight').val(formatDecimal(good.nett_weight))
            //     $('#volume').val(formatDecimal(good.volume))
            // })
            

           /* $('.hs-code-options').on('select2:select', function(e) {
                $.ajax({
                    type: "GET",
                    url: '{{url('/')}}/master-data/hscode/' + e.params.data.id + '/ajax',
                    success: function(res) {
                        $('#bm').val(res.details.bm)
                        $('#pph').val(res.details.pph_api)
                        // $('#ppn').val(res.details.ppn)
                        $('#ppnbm').val(res.details.ppnbm)
                    },
                })
            })*/

            $('#add-modal').on('hide.bs.modal', function(e) {
                $('#add-form').trigger('reset')
                $('#add-form select').trigger('change')
                selectedInboundDetail = {}
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
                if($('#hincoterm_id').val() == "" || $('#hincoterm_id').val() == null){
                    $('#add-form').trigger('reset')
                    $('#add-form select').trigger('change')
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Silahkan isi dulu data dokumen',
                    }).then(() => {
                        $('#add-modal').modal('hide');
                    });
                }
                $('#incoterm_id').val($('#hincoterm_id').val()).change();
                $('#incoterm_id').attr('disabled', 'disabled');
                
                let data = $('#inbound_documents').repeaterVal().inbound_documents.map(function (v, i){
                    console.log(v);
                    if(v.inbound_document_id == ''){
                        return;
                    }
                    return {id: i, text: `${v.nomor_dokumen} ${v.date}`} ;
                })
            
                console.log(inboundDetails);
                $('#good-document-options').html("");
                $('#good-document-options').select2({data})
                if(selectedInboundDetail.id != undefined){
                    // Set GoodDocument
                    $.ajax({
                        type    : 'GET',
                        url     : `/inbound-details/data-detail-document/${selectedInboundDetail.id}`,
                        success: function(res) {
                            var goodDocumentOptions = [];
                            $.each(res.inboundDocuments, (i , vl) => {
                                goodDocumentOptions.push((vl.seri_document - 1));
                            });

                            $('#good-document-options').val(goodDocumentOptions).trigger('change')
                        }
                    })
                }
                // loadGoodOptions(selectedInboundDetail.id || "");
                loadGoodOptions(selectedInboundDetail.id != undefined ? selectedInboundDetail.good : undefined);
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
                    var optionGood = new Option(`[${good.details.kode_barang}] ${good.name}`, good.id, true, true);
                    $('#good_id').append(optionGood).trigger("change");
                }else {
                    var optionGood = new Option(`-- select --`, "", true, true);
                    $('#good_id').append(optionGood).trigger("change");
                }

                // $.ajax({
                //     type: "GET",
                //     url: '{{url('/')}}/master-data/goods/raw-goods',
                //     success: function(res) {
                //         const result = [{id: "", code_name: "-- Select --"}].concat(res)
                //         goodOptions = result;

                //         // this code will filter the goods those already selected
                //         const mapOptions = result.map(v => ({id: v.id, text: v.code_name}));
                //         let options = mapOptions.filter(option => inboundDetails.every(good => good.good_id != option.id))

                //         if (JSON.stringify(selectedInboundDetail) != '{}') {
                //             const editOption = mapOptions.find(option => option.id == selectedInboundDetail.good.id)
                //             options.push(editOption)
                //         }
                //         $('.good-options').html("")
                //         $('.good-options').select2({data: options})
                //         if (JSON.stringify(selectedInboundDetail) != '{}') {
                          
                //             $('#jenis_barang').val(selectedInboundDetail.good.details.jenis_barang).trigger('change')
                //             $('#uom_id').val(selectedInboundDetail.good.uom_id).trigger('change')
                //             $('.good-options').val(selectedInboundDetail.good_id).trigger('change')
                //             $('#type-asuransi').val(selectedInboundDetail.details.type_asuransi).trigger('change')
                //             var asuransi = selectedInboundDetail.details.asuransi;
                //             var biayaPengurang = selectedInboundDetail.details.biaya_pengurang;
                //             if(asuransi == undefined || asuransi == ''){
                //                 asuransi = 0;
                //             }
                //             if(biayaPengurang == undefined || biayaPengurang == ''){
                //                 biayaPengurang = 0;
                //             }
                //             $('#detail-asuransi').val(asuransi)
                //             $('#detail-biaya-pengurang').val(biayaPengurang)
                //             $('#incoterm_id').val(selectedInboundDetail.details.incoterm_id).trigger('change')
                //             $('#kena_pajak').val(selectedInboundDetail.details.kena_pajak).trigger('change')
                //             $('#detail-rate-preference').val(selectedInboundDetail.details.rate_preference).trigger('change')
                //             $('#fasilitas').val(selectedInboundDetail.details.fasilitas).trigger('change')
                //             $('#item_condition').val(selectedInboundDetail.details.item_condition).trigger('change')
                //             $('#item_country').val(selectedInboundDetail.details.item_country).trigger('change')
                //             $('#item_place_of_origin').val(selectedInboundDetail.details.item_place_of_origin).trigger('change')
                //         }
                //     },
                //     error: function(res) {
                //         Swal.fire("Error!", res.responseJSON.message, "error");
                //     }
                // })
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
                $('#jenis_barang').prop('disabled', isDisable)
            }

            $('#good_id').on('change', function() {
                var id = $(this).val();
                disabledFields(id != "")
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

                // let good = goodOptions.find(function(v) { return v.id == e.params.data.id })
                // good.good_id = good.id
                // FormDataJson.fromJson($('#add-form'), good)
                // $('#jenis_barang').val(good.details.jenis_barang).change()
                // $('#uom_id').val(good.uom_id).change()
                // $('#nett_weight').val(formatDecimal(good.nett_weight))
                // $('#volume').val(formatDecimal(good.volume))
            })


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

        $('#detail-country-bc30').on('change', function(){
            if($(this).val() == 'ID'){
                $('#select-detail-place-of-origin-bc30').show();
                $('#input-detail-place-of-origin-bc30').hide();
            }else {
                $('#select-detail-place-of-origin-bc30').hide();
                $('#input-detail-place-of-origin-bc30').show();
            }
        });
        
       /* var tanpa_rupiah = document.getElementById('detail-harga-penyerahan');
        tanpa_rupiah.addEventListener('keyup', function(e)
        {
             document.getElementById("s-harga-penyerahan").innerHTML = formatRupiah(this.value);
        });*/

        
        
        

    </script>
@endpush
