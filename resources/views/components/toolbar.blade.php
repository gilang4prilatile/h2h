<!--begin::Toolbar-->
<div class="toolbar" id="kt_toolbar"> 
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack"> 
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
            data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
            class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
           
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ $menuName }}</h1>
            <span class="h-20px border-gray-200 border-start mx-4"></span>
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <li class="breadcrumb-item text-muted">
                    <a href="javascript::void();" class="text-muted text-hover-primary">{{ $parentMenuName }}</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="{{ $mainUrl }}" class="text-muted text-hover-primary">{{ $menuName }}</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Index</li>
            </ul>
        </div>
    </div>
</div>