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
                <div class="form-group row" style="margin-top:10px;">
                    <div class="col-md-4">
                        <label class="form-label required">Kode Barang</label>
                        {!! Form::text('details[kode_barang]', null, ['class' => 'form-control', 'id' => 'kode_barang', 'required' => true, 'disabled' => true]) !!}
                    </div>
                    <div class="col-md-4">
                        <label class="form-label required">Nama Barang</label>
                        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required' => true, 'disabled' => true]) !!}
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Spf Lain</label>
                        {!! Form::text('details[spesifikasi_lain]', null, ['class' => 'form-control', 'id' => 'spesifikasi_lain', 'disabled' => true]) !!}
                    </div>
                </div>

                <div class="form-group row" style="margin-top:10px;">
                    <div class="col-md-4">
                        <label class="form-label">Merek</label>
                        {!! Form::text('details[merk]', null, ['class' => 'form-control', 'id' => 'merk', 'disabled' => true]) !!}
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tipe</label>
                        {!! Form::text('details[type]', null, ['class' => 'form-control', 'id' => 'type', 'disabled' => true]) !!}
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ukuran</label>
                        {!! Form::text('details[ukuran]', null, ['class' => 'form-control', 'id' => 'ukuran', 'disabled' => true]) !!}
                    </div>
                </div>

                <div class="form-group row" style="margin-top:10px;">
                    <div class="col-md-4">
                        <label class="form-label">Jenis Barang</label>
                        {!! Form::select('details[jenis_barang]', $jenisBarang, null, ['class' => 'form-select', 'placeholder' => '-- Select --', 'data-control' => 'select2', 'id' => 'jenis_barang', 'disabled' => true]) !!}
                    </div>
                    {{-- <div class="col-md-4">
                        <label class="form-label">Pilih Dokumen</label>
                        {!! Form::select('good_documents[]', [], null, ['class' => 'form-select', 'id' => 'good-document-options', 'multiple' => true, 'data-control' => 'select2', 'required' => true]) !!}
                    </div> --}}
                    <div class="col-md-4">
                        <div class="d-flex">
                            <label class="form-label me-3">HS Code  </label>
                            <div class="d-flex d-none" id='opsi-lartas'>
                                <p>Lartas : &nbsp;</p>
                                <p class=" " readonly ='readonly'  id ='status_lartas'>Pilih HS code</p>
                            </div>

                        </div>

                        {!! Form::select('hs_code_id', $hsCodes, null, ['class' => 'form-select hs-code-options', 'id' => 'hscode_id', 'data-control' => 'select2' , $bc == 'BC23' ? 'required' : '', 'disabled' => true]) !!}
                    </div>
{{--                    <div class="col-md-4">--}}
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
                        {!! Form::text('details[uraian]', null, ['class' => 'form-control', 'id' => 'uraian', 'disabled' => true]) !!}
                    </div>
                </div>
                @include("inbound.components.detail.detail_modal_partials.satuan_berat_harga")
                @include("inbound.components.detail.detail_modal_partials.kemasan")
                @if($bc == "BC23")
                    @include("inbound.components.detail.detail_modal_partials.tarif_fasilitas")
                    <div class="form-group row" style="margin-top:10px;">
                        <div class="col-md-4">
                            <label class="form-label">Kena Pajak</label>
                            {!! Form::select('details[kena_pajak]', [ 'Pembelian BKP' => 'Pembelian BKP' , 'Penerima Jasa BKP' => 'Penerima Jasa BKP' ] , null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --' , 'id' => 'kena_pajak', 'disabled' => true]) !!}
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Rate Preference</label>
                            {!! Form::select('details[rate_preference]', $ratePreferences,null, ['class' => 'form-select', 'data-control' => 'select2', 'id' => 'detail-rate-preference', 'disabled' => true]) !!}
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fasilitas</label>
                            {!! Form::select('details[fasilitas]', $fasilitas , $inbound->inboundDetails[0]->details['fasilitas'] ?? '', ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --' , 'id' => 'fasilitas', 'disabled' => true]) !!}
                        </div>
                    </div>

                @endif

                <div style="margin-top:10px;">
                    <h3>Dokumen</h3>
                        <div class="col-md-12" id="good-document">
                        </div>
                </div>

                <!--begin::Actions-->
                <div class="text-center" style="margin-top:20px;">
                    <button type="reset" id="button_cancel_modal_tambah_barang" class="btn btn-light me-3">< Back</button>
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


            goodId.on('change', function(){
                // countHargaIf();
            });

            incotermId.on('change', function(){
                // countHargaIf();
            });

            detailQuantity.on('keyup', function(){
                // countHargaIf();
            });

            detailAmount.on('keyup', function(){
                // countHargaIf();
                 document.getElementById("s-biaya-harga-barang").innerHTML = formatRupiah(this.value); 
            });

            detailFreight.on('keyup', function(){
                // countHargaIf();
            });

            detailAsuransi.on('keyup', function(){
                // countHargaIf();
                 document.getElementById("s-biaya-asuransi").innerHTML = formatRupiah(this.value);
            });

            detailBiayaPenambah.on('keyup', function(){
                // countHargaIf();
                 document.getElementById("s-biaya-penambah").innerHTML = formatRupiah(this.value);
            });

            detailBiayaPengurang.on('keyup', function(){
                // countHargaIf();
                 document.getElementById("s-biaya-pengurang").innerHTML = formatRupiah(this.value);
            });
            
            typeAsuransi.on('change', function(){

                var typeID = $(this).val();
                if(typeID == 0){
                    detailAsuransi.val(0);
                    detailAsuransi.attr('readonly', 'readonly');
                }else {
                    detailAsuransi.val(0);
                    detailAsuransi.removeAttr('readonly', 'readonly');
                }
                // countHargaIf();
            });

            detailAsuransi.on('keyup', function(){
                // countHargaIf();
            });

            function countHargaIf(){

                console.log(detailQuantity.val());

                var totalFob            = (Number(detailAmount.val()) + Number(detailBiayaPenambah.val())) - Number(detailBiayaPengurang.val());
                // var totalHargaDetil = ((Number(detailFob) + Number(detailBiayaPenambah)) - Number(detailBiayaPengurang))
                var totalNilaiCif       = totalFob + ( incotermId.val() == 2 ? ( Number(detailAsuransi.val()) + Number(detailFreight.val()) ) : 0 );
                var totalCifRP          = totalNilaiCif * Number(ndpbm.val());
                var totalHargaSatuan    = 0;

                if(incotermId.val() == 2){
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
                $('#add-modal').modal('hide')
            });

            $('#add-form').submit(function(e){

                e.preventDefault();
                let jsonObject = convertFormToJSON($('#add-form'))
                var beratBersih = $('#nett_weight').val();
                var beratKotor = $('#bruto').val();

                if(Number(beratBersih) > Number(beratKotor)){
                    Swal.fire('Error', `Netto must not be more than Bruto`, "error")
                    return
                }
                
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
                        console.log(dataUpload);
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
                        }else {
                            Swal.fire('Error', 'Failed to Add or Update Good !', 'error')
                        }
                    }
                })
            }
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
                FormDataJson.fromJson($('#add-form'), good)
                $('#jenis_barang').val(good.details.jenis_barang).change()
                $('#uom_id').val(good.uom_id).change()
                $('#nett_weight').val(formatDecimal(selectedInboundDetail.nett_weight))
                $('#volume').val(formatDecimal(selectedInboundDetail.volume))
            })

            $('.hs-code-options').on('select2:select', function(e) {
                $.ajax({
                    type: "GET",
                    url: '{{url('/')}}/master-data/hscode/' + e.params.data.id + '/ajax',
                    success: function(res) {
                        $('#bm').val(res.details.bm)
                        $('#pph').val(res.details.pph_api)
                        $('#ppn').val(res.details.ppn)
                        $('#ppnbm').val(res.details.ppnbm)
                    },
                })
            })

            $('#add-modal').on('hide.bs.modal', function(e) {
                $('#add-form').trigger('reset')
                $('#add-form select').trigger('change')
                selectedInboundDetail = {}
            })

            $('#add-modal').on('show.bs.modal', function(e) {
            //     let data = $('#table-documents').repeaterVal().inbound_documents.map((v, i, array) => {
            //         return {text: '${v.nomor_dokumen} ${v.date}'}
            //     })
            //     console.log(inboundDetails);
            //     $('#good-document-options').html("");
            //     $('#good-document-options').text({data})

                disabledFields(selectedInboundDetail.id != undefined);
                loadGoodOptions(selectedInboundDetail.id || "");
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
                        let options = mapOptions.filter(option => inboundDetails.every(good => good.good_id != option.id))

                        if (JSON.stringify(selectedInboundDetail) != '{}') {
                            const editOption = mapOptions.find(option => option.id == selectedInboundDetail.good.id)
                            options.push(editOption)
                        }
                        $('.good-options').html("")
                        $('.good-options').select2({data: options})
                        console.log(selectedInboundDetail);
                        if (JSON.stringify(selectedInboundDetail) != '{}') {
                            $('#jenis_barang').val(selectedInboundDetail.good.details.jenis_barang).trigger('change')
                            $('#uom_id').val(selectedInboundDetail.good.uom_id).trigger('change')
                            $('.good-options').val(selectedInboundDetail.good_id).trigger('change')
                            $('#type-asuransi').val(selectedInboundDetail.details.type_asuransi).trigger('change')
                            $('#detail-asuransi').val(selectedInboundDetail.details.asuransi)
                            $('#incoterm_id').val(selectedInboundDetail.details.incoterm_id).trigger('change')
                            $('#kena_pajak').val(selectedInboundDetail.details.kena_pajak).trigger('change')
                            $('#detail-rate-preference').val(selectedInboundDetail.details.rate_preference).trigger('change')
                            $('#fasilitas').val(selectedInboundDetail.details.fasilitas).trigger('change')
                        }
                    },
                    error: function(res) {
                        Swal.fire("Error!", res.responseJSON.message, "error");
                    }
                })
            }

            $('.buttonbuatklik').click(function(){
                $.ajax({
                    type: "GET",
                    url: '{{url('/')}}/master-data/document/documentbyid/'+selectedInboundDetail.id,
                    success: function(res) {
                        
                        var html = `<div class="row">`

                        $.each(res,(i,val) => {
                                html += `<span class="col-2 text-uppercase">${val.name}</span>
                                <span class="col-2">${val.details.nomor_dokumen}</span>
                                <span class="col-2">${val.details.date}</span>
                                <span class="col-6"></span>`
                        })
                        html += '</div>'

                        $('#good-document').html(html)

                    },
                    error: function(res) {
                        Swal.fire("Error!", res.responseJSON.message, "error");
                    }
                })
            })
            

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
        });

        
        var tanpa_rupiah = document.getElementById('detail-harga-penyerahan');
        tanpa_rupiah.addEventListener('keyup', function(e)
        {
             document.getElementById("s-harga-penyerahan").innerHTML = formatRupiah(this.value);
        });

        
        
        

    </script>
@endpush
