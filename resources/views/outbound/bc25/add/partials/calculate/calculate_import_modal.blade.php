<!--begin::Modal - New Target-->
<div class="modal fade" id="calculate-import-modal" aria-hidden="true">
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
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
                                <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
                                <rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1" />
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
                <form id="add-form-calculate-import" action="#">
                    {{-- {!! Form::hidden('auth_token', $authToken ?? '', ['id' => 'auth_token']) !!} --}}
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Outbound Detail</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    {!! Form::hidden('id', null, ['class' => 'form-control', 'readonly' => true]) !!}
                    {!! Form::hidden('inbound_detail_id', null, ['class' => 'form-control', 'readonly' => true]) !!}
                    {!! Form::hidden('good_conversion_id', null, ['class' => 'form-control', 'readonly' => true]) !!}
                    <div class="form-group row" style="margin-top:10px;">
                        <div class="col-md-4">
                            <label class="form-label required">Kode Barang</label>
                            {!! Form::text('details[kode_barang]', null, ['class' => 'form-control bg-secondary', 'id' => 'dkode_barang_import', 'readonly' => true]) !!}
                        </div>
                        <div class="col-md-4">
                            <label class="form-label required">Nama Barang</label>
                            {!! Form::text('name', null, ['class' => 'form-control bg-secondary', 'id' => 'dname_import', 'readonly' => true]) !!}
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Spesifikasi Lain</label>
                            {!! Form::text('details[spesifikasi_lain]', null, ['class' => 'form-control bg-secondary', 'id' => 'dspesifikasi_lain_import', 'readonly' => true]) !!}
                        </div>
                    </div>

                    <div class="form-group row" style="margin-top:10px;">
                        <div class="col-md-4">
                            <label class="form-label">Merek</label>
                            {!! Form::text('details[merk]', null, ['class' => 'form-control bg-secondary', 'id' => 'dmerk_import', 'readonly' => true]) !!}
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tipe</label>
                            {!! Form::text('details[type]', null, ['class' => 'form-control bg-secondary', 'id' => 'dtype_import', 'readonly' => true]) !!}
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Ukuran</label>
                            {!! Form::text('details[ukuran]', null, ['class' => 'form-control bg-secondary', 'id' => 'dukuran_import', 'readonly' => true]) !!}
                        </div>
                    </div>
                    <div class="form-group row" style="margin-top: 10px;">
                        <label class="form-label">HS Code</label>
                        {!! Form::select('hs_code_id', $hsCodes, null, ['class' => 'form-select hs-code-options-import', 'id' => 'hscode_id_import', 'data-control' => 'select2']) !!}
                    </div>
                    <div class="form-group row" style="margin-top:10px;">
                        <div class="col-md-12">
                            <label class="form-label">Uraian Barang</label>
                            {!! Form::textarea('details[uraian]', null, ['class' => 'form-control bg-secondary', 'id' => 'duraian_import', 'readonly' => true]) !!}
                        </div>
                    </div>

                    {{-- B1 --}}

                    <h3 class="mb-3" style="margin-top: 10px;">SATUAN, BERAT, DAN HARGA</h3>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="form-label required">Jumlah Satuan</label>
                            {!! Form::number('quantity', 0, ['class' => 'form-control bg-secondary', 'id' => 'dquantity_import', 'required' => true, 'step' => 'any' , 'maxlength' => '18', 'min' => '0', 'required', 'readonly' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                            if(this.value<0){this.value='0'}"]) !!} </div>
                                <div class="col-md-4">
                                    <label class="form-label required">Jenis Satuan</label>
                                    {!! Form::select('uom_id', $uoms, null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id' => 'duom_id_import', 'required' => true]) !!}
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">Netto</label>
                                    {!! Form::number('nett_weight', 0, ['class' => 'form-control', 'id' => 'dnett_weight_import', 'maxlength' => '18', 'min' => '0', 'step' => 'any' , 'required' => true , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                    if(this.value<0){this.value='0'}"]) !!} </div>
                                </div>

                                <div class="form-group row" style="margin-top: 10px;">
                                    <div class="col-md-6">
                                        <label class="form-label required">Volume</label>
                                        {!! Form::number('volume', 0, ['class' => 'form-control', 'id' => 'dvolume_import', 'maxlength' => '18', 'min' => '0' , 'step' => 'any' , 'required' => true, 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                        if(this.value<0){this.value='0'}"]) !!} </div>
                                            {{-- <div class="col-md-4">
                        <label class="form-label required">Bruto</label>
                        {!! Form::number('details[bruto]', 0, ['class' => 'form-control', 'id' => 'dbruto_import',  'maxlength' => '18', 'step' => 'any', 'min' => '0','required' => true, 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                        if(this.value<0){this.value='0'}"]) !!}
                    </div> --}}
                                            <div class="col-md-6">
                                                <label class="form-label required">Nilai CIF</label>
                                                {!! Form::number('details[nilai_cif]', 0, ['class' => 'form-control', 'id' => 'dnilai_cif_import', 'required' => true, 'maxlength' => '18', 'step' => 'any', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                                if(this.value<0){this.value='0'}"]) !!} </div>
                                            </div>
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <div class="col-md-12">
                                                    <label class="form-label required">CIF Rp</label>
                                                    {!! Form::number('details[cif_rp]', 0, ['class' => 'form-control bg-secondary', 'id' => 'dcif_rp_import', 'maxlength' => '18', 'min' => '0', 'step' => 'any', 'required' => true, 'readonly' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                                                    if(this.value<0){this.value='0'}"]) !!} </div>
                                                </div>
                                                {{-- B1 --}}
                                                @include("outbound.bc25.add.partials.calculate.calculate_tarif_fasilitas", ['from' => 'import'])

                                                <!--begin::Actions-->
                                                <div class="text-center" style="margin-top:20px;">
                                                    <button type="button" id="button_cancel_modal_tambah_barang_import" class="btn btn-light me-3">Cancel</button>
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
            $.each(array, function() {
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
                        Object.assign(json[parentName], {
                            [nestedName]: this.value || ""
                        })

                    }
                }
            });
            return json;
        }

        var ndpbm = $("input[name='details[ndpbm]']")
        var detailCifRP = $('#dcif_rp_import');
        var detailNilaiCif = $('#dnilai_cif_import');
        var bmType = $('#bm_type');

        bmType.on('change', function() {
            if ($(this).val() == 2) {
                $('#bm_type_percen').hide();
                $('#bm').attr('maxlength', 10);
            } else {
                $('#bm_type_percen').show();
                $('#bm').attr('maxlength', 3);
            }
        });

        ndpbm.on('change', function() {
            countHargaIf();
        });

        detailNilaiCif.on('keyup', function() {

            countHargaIf();

        });

        function countHargaIf() {
            totalNilaiCif = Number(ndpbm.val()) * Number(detailNilaiCif.val());
            detailCifRP.val(totalNilaiCif);
        }

        $('#button_cancel_modal_tambah_barang_import').click(function() {
            $('#add-form-calculate-import').trigger('reset')
            $('#add-form-calculate-import select').trigger('change')
            $('#calculate-import-modal').modal('hide')
        });

        $('#add-form-calculate-import').submit(function(e) {
            e.preventDefault();
            let jsonObject = convertFormToJSON($('#add-form-calculate-import'))
            // let good = goodOptions.find(function(v) { return v.id == jsonObject.good_id })

            // PPNBM 
            var ppnbm = $('#ppnbm').val();
            var ppnbmType = $('#ppnbm_tax_type').val();
            var ppnbmValue = $('#ppnbm_tax_value').val();

            // PPH 
            var pph = $('#pph').val();
            var pphType = $('#pph_tax_type').val();
            var pphValue = $('#pph_tax_value').val();

            if (ppnbm != 0 && ppnbmType != '' && ppnbmValue != 0 ||
                ppnbm == 0 && ppnbmType == '' && ppnbmValue == 0) {} else {
                Swal.fire('Error', `Please fill all form on PPNBM`, "error")
                return
            }

            if (pph != 0 && pphType != '' && pphValue != 0 ||
                pph == 0 && pphType == '' && pphValue == 0) {} else {
                Swal.fire('Error', `Please fill all form on PPH`, "error")
                return
            }

            let checkPungutan = checkPungutanValue();
            if (!checkPungutan) {
                return
            }

            var nilaiCif = $('#dnilai_cif_import').val();
            var cifRP = $('#dcif_rp_import').val();
            var hsCode = $('#hscode_id_import').val();

            if (nilaiCif == 0) {
                Swal.fire('Error', `Nilai Cif Cannot Null`, "error")
                return
            }

            if (cifRP == 0) {
                Swal.fire('Error', `Cif RP Cannot Null`, "error")
                return
            }


            if (hsCode == '') {
                Swal.fire('Error', `HS Code Cannot Null`, "error")
                return
            }

            $.each(selectedImportGoods, (i, vi) => {
                if (vi.inbound_detail_id == jsonObject.inbound_detail_id && vi.good_conversion_id == jsonObject.good_conversion_id) {
                    var obj = Object.assign(vi.details, jsonObject.details);
                    vi.hs_code_id = jsonObject.hs_code_id;
                    vi.details = obj;
                    vi.volume = jsonObject.volume;
                    vi.nett_weight = jsonObject.nett_weight;

                }
            });
            refreshImportGoodsInfo()
            refreshGoodsBahanBakuInfo()
            $('#add-form-calculate-import').trigger('reset')
            $('#add-form-calculate-import select').trigger('change')
            $('#nav-tab a[href="#nav-import"]').click() // Select tab by name
            $('#calculate-import-modal').modal('hide')
        })

        $('.hs-code-options-import').on('select2:select', function(e) {
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

        $('#calculate-import-modal').on('hide.bs.modal', function(e) {
            $('#add-form-calculate-import').trigger('reset')
            $('#add-form-calculate-import select').trigger('change')
            selectedImportGood = {}
        })

        $('#calculate-import-modal').on('show.bs.modal', function(e) {
            disabledFields(selectedImportGood.id != undefined);
            if (selectedImportGood.id != undefined) {
                autoFillDetail(selectedImportGood, selectedImportGood.details)
            }
        })

        const autoFillDetail = (good, details) => {
            FormDataJson.fromJson($('#add-form-calculate-import'), good)
            $('#duom_id_import').val(good.uom_id).trigger('change');
            $('#quantity').val(good.quantity)
            $('#hscode_id_import').val(good.hs_code_id).trigger('change')
            $('#dnilai_cif_import').val(good.inbound.details.nilai_cif).trigger('change');
        }

        const disabledFields = (isDisable) => {
            if (!isDisable) {
                $('#add-form-calculate-import').trigger('reset')
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
            var ppn = $('#ppn_import').val();
            var ppnValue = $('#ppn_tax_value_import').val();

            // PPNBM 
            var ppnbm = $('#ppnbm').val();
            var ppnbmValue = $('#ppnbm_tax_value').val();

            // PPH 
            var pph = $('#pph').val();
            var pphValue = $('#pph_tax_value').val();

            if (bm > 100 && bmType == 1 || bmValue > 100) {
                Swal.fire('Error', `BM cannot bigger than 100% !`, "error")
                return false;
            }

            if (ppn > 100 || ppnValue > 100) {
                Swal.fire('Error', `PPN cannot bigger than 100% !`, "error")
                return false;
            }

            if (ppnbm > 100 || ppnbmValue > 100) {
                Swal.fire('Error', `PPNBM cannot bigger than 100% !`, "error")
                return false;
            }

            if (pph > 100 || pphValue > 100) {
                Swal.fire('Error', `PPH cannot bigger than 100% !`, "error")
                return false;
            }

            return true;
        }

    });
</script>
@endpush