@extends("layouts.auth")
@section("content")
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url({{ asset('assets/media/illustrations/development-hd.png') }})">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
            <a href="{{url('/')}}" class="mb-12">
                <h1>BC INVENTORY SYSTEM - DEV_11</h1>
            </a>
            <!--end::Logo-->
            <!--begin::Wrapper-->
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!--begin::Form-->
                {!! Form::open(["class" => "form w-100","id" => "form"]) !!}
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">Sign In</h1>
                        <!--end::Title-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                        {!! Form::text("email",null,["class" => "form-control form-control-lg form-control-solid"]) !!}
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack mb-2">
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Input-->
                        {!! Form::password("password",["class" => "form-control form-control-lg form-control-solid"]) !!}
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <!--begin::Submit button-->
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                            <span class="indicator-label">Masuk</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Submit button-->
                    </div>
                    <!--end::Actions-->
                {!! Form::close() !!}
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
@endsection

@push("js")
{!! JsValidator::formRequest('App\Http\Requests\Auth\LoginRequest','#form') !!}
@if(session()->has("info"))
    <script>
        $(document).ready(function(){
            Swal.fire({
                title: 'Info',
                text: '{{ session()->get("info") }}',
                icon: 'info'
            });
        });
    </script>
@endif
@endpush