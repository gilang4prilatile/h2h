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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Client</h1>
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
                            <a href="{{ $mainUrl }}" class="text-muted text-hover-primary">Client</a>
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
                                <label class="form-label required">Tipe Client</label>
                                {!! Form::select('types[]', $types, null, ['class' => 'form-select', 'id' => 'types', 'multiple' => true, 'data-control' => 'select2']) !!}
                            </div>
                            <div class="row mb-10">
                                <label class="form-label required">Identitas</label>
                                <div class="col-md-6">
                                    {!! Form::select('details[tipe_identitas]', $tipe_identitas, null, ['class' => 'form-select', 'placeholder' => '-- Select --', 'id' => 'type_identitas']) !!}
                                </div>
                                <div class="col-md-6">
                                    {!! Form::number('details[nomor_identitas]', null, ['class' => 'form-control', 'id' => 'nomor_identitas']) !!}
                                    <span class="text-lowercase text-danger" id="error-nomor-identitas"></span>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-10">
                                        <label class="form-label required">Nama</label>
                                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required">Negara</label>
                                    {!! Form::select('country_id', $countries, null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --']) !!}
                                </div>

                            </div>

                            <div class="mb-10">
                                <label class="form-label required">Alamat</label>
                                {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
                            </div>
                            <div id="replace">
                            </div>
                            <div class="mb-10">
                                {!! Form::submit(request()->segment(3) == 'create' ? 'Save' : 'Edit', ['class' => 'btn btn-primary', 'id' => 'btnSubmit']) !!}
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
    {!! JsValidator::formRequest('App\Http\Requests\StoreProfileRequest', '#form') !!}
@endpush
@push('js')
    <script>

        var dataModel = @Json($model);
        var dataDetails = @Json($model->details);

        $(document).ready(function() {
          
            var types = $('#types').val();  
            var isValidation = true;
            var callUrls = [];

            renderForm(types);

            $('#types').on('change', function(e) {
                var selectedTypes = $('#types').val();
                renderForm(selectedTypes);
            })

            $('#nomor_identitas').on('keyup', function(){

                var lengthVal = $(this).val().length;
                var typeIndentitas = $('#type_identitas').val();
                const lengthMap = {
                    'npwp-12-digit': 12,
                    'npwp-10-digit': 10,
                    'paspor': 8,
                    'ktp': 16,
                    'lainnya': 8,
                    'npwp-15-digit': 15,
                    'npwp-16-digit': 16
                };

                // var lengthTrue = typeIndentitas === 3 ? 16 : typeIndentitas === 0 ? 12 : 15;           
                var lengthTrue = lengthMap[typeIndentitas] || 0;

                console.log(typeIndentitas);
                

                // If LAINNYA
                if(typeIndentitas === 'lainnya' || typeIndentitas === 'paspor'){
                    if(lengthVal < 8 ){
                        $('#error-nomor-identitas').html(`Panjang Karakter minimal 8 ` );
                        isValidation = false;
                    }else if(lengthVal > 16){
                        $('#error-nomor-identitas').html(`Panjang Karakter maksimal 16 ` );
                        isValidation = false;
                    }else{

                        $('#error-nomor-identitas').html('');
                        isValidation = true;
                    }
                }else if(lengthVal == lengthTrue || lengthVal == 0){

                    $('#error-nomor-identitas').html('');
                    isValidation = true;

                }else if(lengthVal > lengthTrue || lengthVal < lengthTrue) {

                    $('#error-nomor-identitas').html('Panjang Karakter Harus ' + lengthTrue);
                    isValidation = false
                } 

            });

            $('#btnSubmit').on('click', function(){

                if(!isValidation){
                    $('#nomor_identitas').val('');
                    $('#error-nomor-identitas').html('');
                }

            });

    
            function renderForm(types)
            {
                let formUrls = [];

                types.forEach(function(v) {
                    if (
                            ((v == "importir"  || v == "exportir")  && v !=  "penerima-barang")
                            || 
                            (v == "penerima-barang" && (v != "importir" || v != "exportir"))
                        ) {
                        formUrls.push("master-data/profile/form/api")
                    }

                    if (
                           ((v == "importir" || v == "exportir") &&  v != 'tpb')
                            || 
                            (v == "tpb" && (v != 'importir' || v != 'exportir' ))
                        ) {
                        formUrls.push("master-data/profile/form/nomor-izin")
                    }

                    if (v == "pemasok-barang") {
                        // formUrls.push("master-data/profile/form/country")
                    }

                    if (v == "penerima-barang") {
                        formUrls.push("master-data/profile/form/niper")
                    }

                    if (v == "ppjk") {
                        formUrls.push("master-data/profile/form/ppjk")
                    }

                    if (v == "user") {
                        formUrls.push("master-data/profile/form/warehouse")
                    }
                })

                const uniqueFormUrls = [...new Set(formUrls)]
                $("#replace").empty();
                $.each(uniqueFormUrls, (x,v) => {
             
                    $.ajax({
                        type: 'GET',
                        url : v,
                        success : function (data) {
                            $("#replace").append(data);
                            $(".datepicker").flatpickr();                            
                        
                            if(dataDetails != null){
                                var keys = Object.keys(dataDetails);
                                $.each(keys, (i , vl) => {
                                    $(`#${vl}`).val(dataDetails[vl]);
                                });
                                if(dataModel['warehouse_id'] != null){

                                    $('#warehouse_id').val(dataModel['warehouse_id']);

                                }

                            }


                        }
                    });

                })



            }

        })
    </script>
@endpush
