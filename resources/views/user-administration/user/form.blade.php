@extends("layouts.main")
@section("content")
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Dashboard</h1>
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
                        <a href="{{ $mainUrl }}" class="text-muted text-hover-primary">User</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        {{ request()->segment(3) == 'create' ? 'Create': 'Edit' }}
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
                    {!! Form::model($model,["id" => "form"]) !!}
                        <div class="p-10">
                            <div class="mb-10">
                                <label class="form-label">Email</label>
                                {!! Form::text('email',null,["class" => "form-control"]) !!}
                                @if($errors->has('email'))
                                    <span class="error text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="mb-10">
                                <label class="form-label">Name</label>
                                {!! Form::text('name',null,["class" => "form-control"]) !!}
                                @if($errors->has('name'))
                                    <span class="error text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="mb-10">
                                <label class="form-label">Warehouse</label>
                                {!! Form::select('warehouse_id',$warehouses,null,["class" => "form-control", "placeholder" => "-- Select --", "data-control" => "select2"  , $canChangeClientOrRole ? '' : 'disabled']) !!}
                                @if($errors->has('warehouse_id'))
                                    <span class="error text-danger">{{ $errors->first('warehouse_id') }}</span>
                                @endif
                            </div>
                            <div class="mb-10">
                                <label class="form-label">Client</label>
                                {!! Form::select('profile_id',$profiles,null,["class" => "form-control", "data-control" => "select2", "placeholder" => "-- Select --","required"=>"true" , $canChangeClientOrRole ? '' : 'disabled' ]) !!}
                                @if($errors->has('profile_id'))
                                    <span class="error text-danger">{{ $errors->first('profile_id') }}</span>
                                @endif
                            </div>
                            <div class="mb-10">
                                <label class="form-label">Role</label>
                                {!! Form::select('role_id',$roles,null,["class" => "form-control"  ]) !!}
                                @if($errors->has('role_id'))
                                    <span class="error text-danger">{{ $errors->first('role_id') }}</span>
                                @endif
                            </div>

                            @if (request()->segment(3) != 'create')
                            <hr>
                            <div class="mb-10">
                                <input class="form-check-input" name="switch_password" type="checkbox" value="switch" checked="checked">
                                <label class="form-label">New Password</label>
                            </div>

                            @endif
                            
                            <div class="mb-10">
                                <label class="form-label">Password</label>
                                {!! Form::password('password',["class" => "form-control"]) !!}
                                @if($errors->has('password'))
                                    <span class="error text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="mb-10">
                                <label class="form-label">Verify Password</label>
                                {!! Form::password('verify_password',["class" => "form-control"]) !!}
                                @if($errors->has('verify_password'))
                                    <span class="error text-danger">{{ $errors->first('verify_password') }}</span>
                                @endif
                            </div>
                            <div class="mb-10">
                                {!! Form::submit(request()->segment(3) == 'create' ? 'Save': 'Edit', ["class" => "btn btn-primary"]) !!}
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
        var bool_display = false;
        $("input[type='checkbox']:checked").on('change', function(){
            if(bool_display === false){
                $("input[name='password']").prop('disabled' , true);
                $("input[name='verify_password']").prop('disabled' , true);
                $("input[name='password']").val('');
                $("input[name='verify_password']").val('');
                bool_display = true;
            }else{        
                $("input[name='password']").prop('disabled' , false);
                $("input[name='verify_password']").prop('disabled' , false);
                bool_display = false;
            }
            
        });
    });
</script>
    
@endpush