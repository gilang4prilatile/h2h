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
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <!--begin::Title-->
                    <h1 class="mb-3">Inbound Detail</h1>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                <div class="form-group row">
                    <div class="col-md-6">
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
                    <div class="col-md-4">
                        <label class="form-label">Jenis Barang</label>
                        {!! Form::select('details[jenis_barang]', $jenisBarang, null, ['class' => 'form-select', 'placeholder' => '-- Select --', 'data-control' => 'select2', 'id' => 'jenis_barang']) !!}
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Pilih Dokumen</label>
                        {!! Form::select('good_documents[]', [], null, ['class' => 'form-select', 'id' => 'good-document-options', 'multiple' => true,  'data-control' => 'select2']) !!}
                    </div>
                    <div class="col-md-4">
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
{{--                </div>--}}

                <div class="form-group row" style="margin-top:10px;">
                    <div class="col-md-12">
                        <label class="form-label">Uraian Barang</label>
                        {!! Form::textarea('details[uraian]', null, ['class' => 'form-control', 'id' => 'uraian']) !!}
                    </div>
                </div>
                @include("inbound.components.add.add_modal_partials.satuan_berat_harga")
                @include("inbound.components.add.add_modal_partials.kemasan")
                @if($bc == "BC23")
                    @include("inbound.components.add.add_modal_partials.tarif_fasilitas")
                    <div class="form-group row" style="margin-top:10px;">
                        <div class="col-md-4">
                            <label class="form-label">Kena Pajak</label>
                            {!! Form::select('details[kena_pajak]', [ 'Pembelian BKP' => 'Pembelian BKP' , 'Penerima Jasa BKP' => 'Penerima Jasa BKP' ] , null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --' , 'id' => 'kena_pajak']) !!}
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Rate Preference</label>
                            {!! Form::select('details[rate_preference]', $ratePreferences, null, ['class' => 'form-select', 'data-control' => 'select2' ,'placeholder' => '-- Select --' , 'id' => 'detail-rate-preference']) !!}
                        </div>
                        <div class="col-md-4">
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
        var selectedHsCode = {};
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

            var incotermId              = $('#incoterm_id');
            var detailNilaiCif          = $('#detail-nilai-cif');
            var detailQuantity          = $('#detail-quantity');
            var detailAmount            = $('#detail-amount');
            var detailFreight           = $('#detail-freight');
            var goodId                  = $('#good_id');
            var detailCifRP             = $('#detail-cif-rp');
            var ndpbm                   = $('#ndpbm');
            var detailFob               = $('#detail-fob');
            var typeAsuransi            = $('#type-asuransi');
            var detailAsuransi          = $('#detail-asuransi');
            // var detailHargaDetil        = $('#detail-harga-detil');
            var detailBiayaPenambah     = $('#detail-biaya-penambah');
            var detailBiayaPengurang    = $('#detail-biaya-pengurang');
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

            detailBiayaPenambah.on('keyup', function(){
                countHargaIf();
                 document.getElementById("s-biaya-penambah").innerHTML = formatRupiah(this.value);
            });

            detailBiayaPengurang.on('keyup', function(){
                countHargaIf();
                 document.getElementById("s-biaya-pengurang").innerHTML = formatRupiah(this.value);
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


                var totalFob            = (Number(detailAmount.val()) + Number(detailBiayaPenambah.val())) - Number(detailBiayaPengurang.val());
                // var totalHargaDetil = ((Number(detailFob) + Number(detailBiayaPenambah)) - Number(detailBiayaPengurang))
                var totalNilaiCif       = totalFob + ( incotermId.val() == 3 ? ( Number(detailAsuransi.val()) + Number(detailFreight.val()) ) : 0 );
                var totalCifRP          = totalNilaiCif * Number(ndpbm.val());
                var totalHargaSatuan    = 0;

                if(incotermId.val() == 3){
                    totalHargaSatuan    =  ( totalFob / Number(detailQuantity.val()) );
                    detailFob.val(totalFob);
                }else if(incotermId.val() == 1){
                    totalHargaSatuan    = ( totalNilaiCif / Number(detailQuantity.val()));
                    detailFob.val(0);
                    detailFreight.val(0);
                }

                detailNilaiCif.val(totalNilaiCif);
                detailHargaSatuan.val(totalHargaSatuan);
                detailCifRP.val(totalCifRP);

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

                let jsonObject = convertFormToJSON($('#add-form'))
                jsonObject.good_documents = $("#good-document-options").val()
                if (jsonObject.good_id == "") {
                    $.ajax({
                        type: "POST",
                        url: 'master-data/goods/create-ajax',
                        headers: {'X-CSRF-TOKEN': jsonObject._token},
                        data: jsonObject,
                        success: function(res) {
                            jsonObject.good_id = res.id
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
                    url: '{{url('/')}}/master-data/goods/raw-goods',
                    success: function(res) {
                        const result = [{id: "", code_name: "-- Select --"}].concat(res)
                        goodOptions = result;
                        // this code will filter the goods those already selected
                        const mapOptions = result.map(v => ({id: v.id, text: v.code_name}));
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
                    autoFillDetail(good, good.details)
                }
            })

            $('.hs-code-options').on('select2:select', function(e) {
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
            })

            $('#add-modal').on('hide.bs.modal', function(e) {
                $('#add-form').trigger('reset')
                $('#add-form select').trigger('change')
                selectedGood = {}
            })

            $('#add-modal').on('show.bs.modal', function(e) {
                // 10 is number of text "add" button
                let documents = $('#inbound_documents')[0].innerText.length < 10 ? [] : $('#inbound_documents').repeaterVal().inbound_documents;
                console.log(documents);
                let data = documents.map((v, i, array) => {
                    return {id: i, text: `${v.nomor_dokumen} ${v.date}`}
                })
                $('#good-document-options').html("");
                // $('#good-document-options').select2("val", null, true);
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
                            console.log(res);
                        },
                        error: function(res) {
                            Swal.fire("Error!", res.responseJSON.message, "error");
                        }
                    })
                }

            });

            const autoFillDetail = (good, details) => {
                delete good.amount;
                FormDataJson.fromJson($('#add-form'), good)
                $('#jenis_barang').val(good.details.jenis_barang);
                $('#jenis_barang').trigger('change');
                $('#type-asuransi').val(good.details.type_asuransi).trigger('change');
                $('#detail-asuransi').val(good.details.asuransi ?? 0);
                $('#kena_pajak').val(good.details.kena_pajak).trigger('change');
                $('#good-document-options').val(good.good_documents).trigger('change');
                $('#fasilitas').val(good.details.fasilitas).trigger('change');
                $('#incoterm_id').val(good.details.incoterm_id).trigger('change')
                $('#detail-rate-preference').val(good.details.rate_preference).trigger('change')

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
                $('#volume').val(formatDecimal(good.volume))
                // $('#package_id').val
                //
                $('#hscode_id').val(good.hs_code_id)
                $('#hscode_id').trigger('change')

                // const packageDetails = good.package_details
                // if (packageDetails != undefined) {
                //     $('#merk_kemasan').val(packageDetails.merk)
                //     $('#jumlah').val(packageDetails.jumlah)
                // }

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
                $('#jenis_barang').prop('disabled', isDisable)
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


    var tanpa_rupiah = document.getElementById('detail-harga-penyerahan');
    tanpa_rupiah.addEventListener('keyup', function(e)
    {
         document.getElementById("s-harga-penyerahan").innerHTML = formatRupiah(this.value);
    });

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

    // Validation Tarif & Fasilitas


    </script>
@endpush
