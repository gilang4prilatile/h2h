@extends("layouts.main")
@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">HS Code</h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="javascript::void();" class="text-muted text-hover-primary">Master Data</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ $mainUrl }}" class="text-muted text-hover-primary">HS Code</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            {{ request()->segment(3) == 'create' ? 'Create' : 'Edit' }}
                        </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container">
                <!--begin::Card-->
                <div class="card">
                    <div class="py-10">
                        {!! Form::model($model, ['id' => 'form']) !!}
                        <div class="p-10">
                            <div class="mb-10">
                                <label class="form-label required">Tipe</label>
                                {!! Form::select('type', $types, null, ['class' => 'form-select', 'id' => 'type', 'data-control' => 'select2',"required"=>"true"]) !!}
                            </div>
                            @include('master-data.hscode.partials.parent_form')
                            <div class="row mb-10">
                                <label class="form-label required">Code</label>
                                <div class="col-md-6">
                                    {!! Form::text('code', null, ['class' => 'form-control',"required"=>"true"]) !!}
                                </div>
                            </div>
                            <div class="mb-10">
                                <label class="form-label">Description ID</label>
                                {!! Form::text('details[description_id]', null, ['class' => 'form-control',"required"=>"true"]) !!}
                            </div>
                            <div class="mb-10">
                                <label class="form-label">Description Eng</label>
                                {!! Form::text('details[description_eng]', null, ['class' => 'form-control',"required"=>"true"]) !!}
                            </div>
                            <div class="mb-10">
                                {!! Form::submit(request()->segment(3) == 'create' ? 'Save' : 'Edit', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
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
    {!! JsValidator::formRequest('App\Http\Requests\StoreHsCodeRequest', '#form') !!}
    <script>
        const model = @json($model);
        $(document).ready(function() {
            $('div.sub-pos-asean-form *').hide()
            const select2EditMode = (model) => {
                let selectedBag = null;
                let selectedBab = null;
                let selectedPos = null;
                let selectedSubPos = null;
                let selectedSubPosAsean = null;
                if (model.type == "bab") {
                    selectedBag = model.hs_code;
                }

                if (model.type == "pos") {
                    selectedBag = model.hs_code.hs_code;
                    selectedBab = model.hs_code;
                }

                if (model.type == "sub-pos") {
                    selectedBag = model.hs_code.hs_code.hs_code;
                    selectedBab = model.hs_code.hs_code;
                    selectedPos = model.hs_code;
                }

                if (model.type == "sub-pos-asean") {
                    selectedBag = model.hs_code.hs_code.hs_code.hs_code;
                    selectedBab = model.hs_code.hs_code.hs_code;
                    selectedPos = model.hs_code.hs_code;
                    selectedSubPos = model.hs_code;
                }

                if (selectedBag != null) {
                    const option = new Option(`BAGIAN ${selectedBag.code} - ${selectedBag.details.description_id}`, selectedBag.id, false, true)
                    $('#bag-options').append(option).trigger('change')
                }

                if (selectedBab != null) {
                    const option = new Option(`BAB ${selectedBab.code} - ${selectedBab.details.description_id}`, selectedBab.id, false, true)
                    $('#bab-options').append(option).trigger('change')
                }

                if (selectedPos != null) {
                    const option = new Option(`${selectedPos.code} - ${selectedPos.details.description_id}`, selectedPos.id, false, true)
                    $('#pos-options').append(option).trigger('change')
                }

                if (selectedSubPos != null) {
                    const option = new Option(`${selectedPos.code} - ${selectedPos.details.description_id}`, selectedPos.id, false, true)
                    $('#sub-pos-options').append(option).trigger('change')
                }
            }

            const showFormByType = (type) => {
                $('.parent-forms').find(":input").val('').trigger('change')
                if (!model.id) {
                    @if($tipe_form=="create")
                    $('.sub-pos-asean-form').find(":input").val('').trigger('change')
                    @endif
                }
                $('div.parent-forms *').hide()
                $('div.parent-forms *').attr('disabled')
                $('div.sub-pos-form').hide()
                $('div.sub-pos-asean-form *').hide()
                $('div.sub-pos-asean-form *').attr('disabled')

                if (type == "bab" || type == "pos" || type == "sub-pos" || type == "sub-pos-asean") {
                    @if($tipe_form=="create")
                    $('.sub-pos-asean-form').find(":input").val('').trigger('change')
                    @endif
                    $('div.bag-form').show()
                    $('div.bag-form *').show()
                    $('div.bag-form *').removeAttr('disabled')
                }


                if (type == "pos" || type == "sub-pos" || type == "sub-pos-asean") {
                    $('div.bab-form').show()
                    $('div.bab-form *').show()
                    $('div.bab-form *').removeAttr('disabled')
                }

                if (type == "sub-pos" || type == "sub-pos-asean") {
                    $('div.pos-form').show()
                    $('div.pos-form *').show()
                    $('div.pos-form *').removeAttr('disabled')
                }

                if (type == "sub-pos-asean") {
                    $('div.sub-pos-form').show()
                    $('div.sub-pos-form *').show()
                    $('div.sub-pos-form *').removeAttr('disabled')
                    $('div.sub-pos-asean-form').show()
                    $('div.sub-pos-asean-form *').show()
                    $('div.sub-pos-asean-form *').removeAttr('disabled')
                }

            }

            if (model.type) {
                showFormByType(model.type)
                select2EditMode(model)
            }

            $('#type').on('change', function(e) {
                const selectedType = $('#type').val()
                showFormByType(selectedType)
            })
            @if($tipe_form=="edit")
            $('#type').attr("disabled", true);
            $('form').bind('submit', function () {
                $('#type').attr("disabled", false);
              });
            @endif
        })
    </script>
@endpush
