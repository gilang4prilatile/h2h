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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Transportation</h1>
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
                            <a href="{{ $mainUrl }}" class="text-muted text-hover-primary">Transportation</a>
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
                                {!! Form::text('code', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="mb-10">
                                <label class="form-label required">Name</label>
                                {!! Form::text('name', null, ['class' => 'form-control' , "id" => "name"]) !!}
                            </div>
                            <div class="form-group row mt-5">
                                <div class="col-md-6 mb-10">
                                    <label class="form-label required">Transport Line</label>
                                    {!! Form::select('transport_line_id', $transportLine, null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --']) !!}
                                </div>
                                <div class="col-md-6 mb-10">
                                    <label class="form-label">Country</label>
                                    {!! Form::select('country_id', $country, null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --']) !!}
                                </div>
                            </div>
                            <div class="mb-10">
                                <label class="form-label">Description</label>
                                {!! Form::text('description', null, ['class' => 'form-control']) !!}
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
    {!! JsValidator::formRequest('App\Http\Requests\MasterData\TransportationRequest', '#form') !!}
@endpush
