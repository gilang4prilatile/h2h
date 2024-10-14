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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Warehouse</h1>
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
                            <a href="{{ $mainUrl }}" class="text-muted text-hover-primary">Warehouse</a>
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
                                <label class="form-label required">Code</label>
                                {!! Form::text('code', null, ['class' => 'form-control' , "id" => "code"]) !!}
                            </div>
                            <div class="mb-10">
                                <label class="form-label required">Name</label>
                                {!! Form::text('name', null, ['class' => 'form-control' , "id" => "name"]) !!}
                            </div>
                            <div class="mb-10">
                                <label class="form-label required">City</label>
                                {!! Form::select('city', $city, null, ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                            </div>
                            <div class="mb-10">
                                <label class="form-label required">Address</label>
                                {!! Form::text('address', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="mb-10">
                                <label class="form-label required">Notifier</label>
                                {!! Form::text('notifier', null, ['class' => 'form-control' , "id" => "notifier",'oninput' => 'this.value = this.value.toUpperCase()', 'maxlength' => '100']) !!}
                            </div>
                            <div class="mb-10">
                                <label class="form-label required">Position</label>
                                {!! Form::text('position', null, ['class' => 'form-control' , "id" => "position",'oninput' => 'this.value = this.value.toUpperCase()', 'maxlength' => '100']) !!}
                            </div>
                            <div class="mb-10">
                                <label class="form-label required">Division</label>
                                {!! Form::select('division', ['air' => 'air','ocean' => 'ocean'], null, ['class' => 'form-control', 'id' => 'division', 'placeholder' => 'Select Division']) !!}
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
<script>
    $(document).ready(function () {
        $("#name").on('input' , function(){
            this.value = this.value.toUpperCase();
        });

        $("#code").on('input' , function(){
            this.value = this.value.toUpperCase();
        });
    });
</script>
    {!! JsValidator::formRequest('App\Http\Requests\MasterData\WarehouseRequest', '#form') !!}
@endpush
