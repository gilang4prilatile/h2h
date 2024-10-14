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
                        <a href="{{ url("dashboard") }}" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Index</li>
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
            <!--begin::Post-->
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <!--begin::Container-->
                <div id="kt_content_container" class="container">
                    <!--begin::Navbar-->
                    <div class="card mb-5 mb-xxl-8">
                        <div class="card-body pt-9 pb-0">
                            <!--begin::Details-->
                            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                                <!--begin: Pic-->
                                <div class="me-7 mb-4">
                                    <div class="symbol symbol-100px symbol-lg-150px symbol-fixed position-relative">
                                        <img src="assets/media/logos/logo-dashboard.jpg" alt="image" />
                                    </div>
                                </div>
                                <!--end::Pic-->
                                <!--begin::Info-->
                                <div class="flex-grow-1">
                                    <!--begin::Title-->
                                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                        <!--begin::User-->
                                        <div class="d-flex flex-column">
                                            <!--begin::Name-->
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="text-gray-900 fs-2 fw-bolder me-1">{{ $user->warehouse()->first()->name ?? '' }}</span>
                                            </div>
                                            <!--end::Name-->
                                            <!--begin::Info-->
                                            <div class="d-flex flex-wrap fw-bold fs-8 mb-4 pe-2">
                                                <span class="d-flex align-items-center text-gray-400 me-5 mb-2">{{ $user->warehouse()->first()->address ?? '' }}</span>
                                            </div>
                                            <!--end::Info-->
                                            
                                        </div>
                                        <!--end::User-->
                                        <!--begin::Actions-->
                                        {{-- <div class="d-flex my-4">
                                            <!--begin::Menu-->
                                            <div class="me-0">
                                                <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                                    <i class="bi bi-three-dots fs-3"></i>
                                                </button>
                                                <!--begin::Menu 3-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
                                                    <!--begin::Heading-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Payments</div>
                                                    </div>
                                                    <!--end::Heading-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Create Invoice</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link flex-stack px-3">Create Payment
                                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference"></i></a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Generate Bill</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start" data-kt-menu-flip="center, top">
                                                        <a href="#" class="menu-link px-3">
                                                            <span class="menu-title">Subscription</span>
                                                            <span class="menu-arrow"></span>
                                                        </a>
                                                        <!--begin::Menu sub-->
                                                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Plans</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Billing</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Statements</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu separator-->
                                                            <div class="separator my-2"></div>
                                                            <!--end::Menu separator-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <div class="menu-content px-3">
                                                                    <!--begin::Switch-->
                                                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                                                        <!--begin::Input-->
                                                                        <input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications" />
                                                                        <!--end::Input-->
                                                                        <!--end::Label-->
                                                                        <span class="form-check-label text-muted fs-6">Recuring</span>
                                                                        <!--end::Label-->
                                                                    </label>
                                                                    <!--end::Switch-->
                                                                </div>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu sub-->
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3 my-1">
                                                        <a href="#" class="menu-link px-3">Settings</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu 3-->
                                            </div>
                                            <!--end::Menu-->
                                        </div> --}}
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Stats-->
                                    <div class="d-flex flex-wrap flex-stack">
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-column flex-grow-1 pe-8">
                                            <!--begin::Stats-->
                                            <div class="d-flex flex-wrap">
                                                <!--begin::Stat-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-40px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Number-->
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{ $totalGoodInventories }}" >0</div>
                                                    </div>
                                                    <!--end::Number-->
                                                    <!--begin::Label-->
                                                    <div class="fw-bold fs-6 text-gray-400">Total Goods</div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Stat-->
                                                <!--begin::Stat-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-40px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Number-->
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{ $totalQuantityInventories }}" >0</div>
                                                    </div>
                                                    <!--end::Number-->
                                                    <!--begin::Label-->
                                                    <div class="fw-bold fs-6 text-gray-400">Total Stock of Goods</div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Stat-->
                                                <!--begin::Stat-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-40px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Number-->
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{ $totalOutboundInventories }}" >0</div>
                                                    </div>
                                                    <!--end::Number-->
                                                    <!--begin::Label-->
                                                    <div class="fw-bold fs-6 text-gray-400">Total Outbounds of Goods</div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Stat-->
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Details-->
                            <!--begin::Navs-->
                            <div class="d-flex overflow-auto h-55px">
                                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                                    <!--begin::Nav item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary me-6" href="/dashboard/inbound">Inbound</a>
                                    </li>
                                    <!--end::Nav item-->
                                    <!--begin::Nav item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary me-6 active" href="/dashboard/inventory">Inventory</a>
                                    </li>
                                    <!--end::Nav item-->
                                    <!--begin::Nav item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary me-6" href="/dashboard/outbound">Outbound</a>
                                    </li>
                                    <!--end::Nav item-->
                                </ul>
                            </div>
                            <!--begin::Navs-->
                        </div>
                    </div>
                    <!--end::Navbar-->

                    <!--begin::Row-->
                    <div class="row g-5 g-xxl-8 mt-4">
                        <!--begin::Col-->
                        <div class="col-xl-12">
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="d-flex flex-row justify-content-between mt-4">
                                        <div>
                                            <h1>Inventory Goods <span id="good-name"></span></h1>
                                        </div>
                                        <!--begin::Actions-->
                                        <div class="d-flex align-items-center py-1">
                                            <!--begin::Wrapper-->
                                            <div class="me-4">
                                                <!--begin::Menu-->
                                                <a href="#" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                                <!--begin::Svg Icon | path: icons/duotone/Text/Filter.svg-->
                                                <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z" fill="#000000" />
                                                        </g>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->Filter</a>
                                                <!--begin::Menu 1-->
                                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true">
                                                    <!--begin::Header-->
                                                    <div class="px-7 py-5">
                                                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                                    </div>
                                                    <!--end::Header-->
                                                    <!--begin::Menu separator-->
                                                    <div class="separator border-gray-200"></div>
                                                    <!--end::Menu separator-->
                                                    <!--begin::Form-->
                                                    <div class="px-7 py-5">
                                                        <!--begin::Input group-->
                                                        <div class="mb-10">
                                                            <!--begin::Label-->
                                                            <label class="form-label fw-bold">Goods:</label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <div>
                                                                <select id="good_id" class="form-select" data-kt-select2="true" data-allow-clear="true">
                                                                    @foreach($inventoryGoods as $inventoryGood)
                                                                        <option value="{{ $inventoryGood->id }}">{{ $inventoryGood->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <!--end::Input-->
                                                        </div>
                                                        <!--end::Input group-->
                                                                 <!--begin::Input group-->
                                                                 <div class="mb-10">
                                                            <!--begin::Label-->
                                                            <label class="form-label fw-bold">Goods:</label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <div>
                                                                <select id="year" class="form-select" id="choose-date-chart-1" data-kt-select2="true"  data-allow-clear="true">
                                                                    <option value="2022">2022</option>
                                                                    <option value="2023">2023</option>
                                                                    <option value="2024">2024</option>
                                                                    <option value="2025">2025</option>
                                                                </select>
                                                            </div>
                                                            <!--end::Input-->
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Actions-->
                                                        <div class="d-flex justify-content-end">
                                                            <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                                            <button type="submit" id="bth-search" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                                        </div>
                                                        <!--end::Actions-->
                                                    </div>
                                                    <!--end::Form-->
                                                </div>
                                                <!--end::Menu 1-->
                                                <!--end::Menu-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--begin::Chart-->
                                    <div id="inventory_chart_1" class="mt-8" style="height: 350px"></div>
                                    <!--end::Chart-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->

                       <!--begin::Row-->
                       <div class="row g-5 g-xxl-8 mt-4">
                        <!--begin::Col-->
                        <div class="col-xl-12">
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="d-flex flex-row justify-content-between mt-4">
                                        <div>
                                            <h1>Inventory Conversion Goods <span id="good-conversion-name"></span></h1>
                                        </div>
                                        <!--begin::Actions-->
                                        <div class="d-flex align-items-center py-1">
                                            <!--begin::Wrapper-->
                                            <div class="me-4">
                                                <!--begin::Menu-->
                                                <a href="#" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                                <!--begin::Svg Icon | path: icons/duotone/Text/Filter.svg-->
                                                <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z" fill="#000000" />
                                                        </g>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->Filter</a>
                                                <!--begin::Menu 1-->
                                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true">
                                                    <!--begin::Header-->
                                                    <div class="px-7 py-5">
                                                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                                    </div>
                                                    <!--end::Header-->
                                                    <!--begin::Menu separator-->
                                                    <div class="separator border-gray-200"></div>
                                                    <!--end::Menu separator-->
                                                    <!--begin::Form-->
                                                    <div class="px-7 py-5">
                                                        <!--begin::Input group-->
                                                        <div class="mb-10">
                                                            <!--begin::Label-->
                                                            <label class="form-label fw-bold">Goods:</label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <div>
                                                                <select id="good_conversion_id" class="form-select" data-kt-select2="true" data-allow-clear="true">
                                                                    @foreach($inventoryConversionGoods as $inventoryConversionGood)
                                                                        <option value="{{ $inventoryConversionGood->id }}">{{ $inventoryConversionGood->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <!--end::Input-->
                                                        </div>
                                                        <!--end::Input group-->
                                                                 <!--begin::Input group-->
                                                                 <div class="mb-10">
                                                            <!--begin::Label-->
                                                            <label class="form-label fw-bold">Goods:</label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <div>
                                                                <select id="year-conversion" class="form-select" id="choose-date-chart-2" data-kt-select2="true"  data-allow-clear="true">
                                                                    <option value="2022">2022</option>
                                                                    <option value="2023">2023</option>
                                                                    <option value="2024">2024</option>
                                                                    <option value="2025">2025</option>
                                                                </select>
                                                            </div>
                                                            <!--end::Input-->
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Actions-->
                                                        <div class="d-flex justify-content-end">
                                                            <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                                            <button type="submit" id="bth-search-conversion" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                                        </div>
                                                        <!--end::Actions-->
                                                    </div>
                                                    <!--end::Form-->
                                                </div>
                                                <!--end::Menu 1-->
                                                <!--end::Menu-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--begin::Chart-->
                                    <div id="inventory_chart_2" class="mt-8" style="height: 350px"></div>
                                    <!--end::Chart-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->


                </div>
                <!--end::Container-->
            </div>
            <!--end::Post-->
        
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
@endsection					

@push('js')

<script>
    $(document).ready(function(){

        function initChartInventory1()
        {
            var perMonthDataInventories = [];
            var goods = @json($inventoryGoods);
            var currentTime = new Date()
            const strDates = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jul', 'Jun', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const colors = ['#fff100', '#ff8c00', '#e81123', '#ec008c', '#68217a', '#00188f', '#00bcf2' , '#00b294' , '#009e49', '#bad80a']

            var element = document.getElementById("inventory_chart_1");

            var height = parseInt(KTUtil.css(element, 'height'));
            var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
            var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
            var baseColor = KTUtil.getCssVariableValue('--bs-info');
            var lightColor = KTUtil.getCssVariableValue('--bs-light-info');

            if (!element) {
                return;
            }
        
            var options = {
                    series: perMonthDataInventories,
                    chart: {
                    height: 350,
                    type: 'line',
                    stacked: false
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: [1, 1, 4]
                },
                xaxis: {
                    categories: strDates,
                },
                yaxis: [
                    {
                        axisTicks: {
                            show: true,
                        },
                        axisBorder: {
                            show: true,
                            color: '#008FFB'
                        },
                        labels: {
                            style: {
                            colors: '#008FFB',
                        }
                        },
                        title: {
                            text: "Stock Inventories",
                            style: {
                                color: '#008FFB',
                            }
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    {
                        seriesName: 'Income',
                        opposite: true,
                        axisTicks: {
                            show: true,
                        },
                        axisBorder: {
                            show: true,
                            color: '#00E396'
                        },
                        labels: {
                            style: {
                            colors: '#00E396',
                        }
                    },
                    title: {
                        text: "Remaining Stock Inventories",
                        style: {
                            color: '#00E396',
                        }
                    },
                    },
                    {
                        seriesName: 'Revenue',
                        opposite: true,
                        axisTicks: {
                            show: true,
                        },
                        axisBorder: {
                            show: true,
                            color: '#FEB019'
                        },
                        labels: {
                        style: {
                            colors: '#FEB019',
                        },
                        },
                        title: {
                            text: "Total Outbound of Inventory",
                            style: {
                                color: '#FEB019',
                            }
                        }
                    },
                ],
                tooltip: {
                    fixed: {
                        enabled: true,
                        position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
                        offsetY: 30,
                        offsetX: 60
                    },
                },
                legend: {
                    horizontalAlign: 'left',
                    offsetX: 40
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();

            let getDataChart1Ajax = (year, goodID, isFirst) => {

                $.each(goods, (i, vi) => {
                    if(vi.id == goodID){
                        $('#good-name').html(vi.name);
                    }
                });

                $.ajax({
                    url : `/dashboard/data-inventory-goods-chart-ajax/${year}/${goodID}`,
                    method : 'GET',
                    success : function(res){ 
                        chart.updateSeries(res.perMonthDataInventories);         
                    },
                    error : function(e){
                        console.log(e.toString());
                    }
                })

            };

            let goodID = $('#good_id').val();

            getDataChart1Ajax(currentTime.getFullYear(), goodID, true);

            $('#bth-search').on('click', function(){

                let goodID  = $('#good_id').val();
                let year    = $('#year').val();            
                getDataChart1Ajax(year, goodID, false);

            });
        }

        function initChartInventory2()
        {
            var perMonthDataInventoryConversions = [];
            var goods = @json($inventoryConversionGoods);
            var currentTime = new Date()
            const strDates = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jul', 'Jun', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const colors = ['#fff100', '#ff8c00', '#e81123', '#ec008c', '#68217a', '#00188f', '#00bcf2' , '#00b294' , '#009e49', '#bad80a']

            var element = document.getElementById("inventory_chart_2");

            var height = parseInt(KTUtil.css(element, 'height'));
            var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
            var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
            var baseColor = KTUtil.getCssVariableValue('--bs-info');
            var lightColor = KTUtil.getCssVariableValue('--bs-light-info');

            if (!element) {
                return;
            }
        
            var options = {
                    series: perMonthDataInventoryConversions,
                    chart: {
                    height: 350,
                    type: 'line',
                    stacked: false
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: [1, 1, 4]
                },
                xaxis: {
                    categories: strDates,
                },
                yaxis: [
                    {
                        axisTicks: {
                            show: true,
                        },
                        axisBorder: {
                            show: true,
                            color: '#008FFB'
                        },
                        labels: {
                            style: {
                            colors: '#008FFB',
                        }
                        },
                        title: {
                            text: "Stock Conversions",
                            style: {
                                color: '#008FFB',
                            }
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    {
                        seriesName: 'Income',
                        opposite: true,
                        axisTicks: {
                            show: true,
                        },
                        axisBorder: {
                            show: true,
                            color: '#00E396'
                        },
                        labels: {
                            style: {
                            colors: '#00E396',
                        }
                    },
                    title: {
                        text: "Remaining Stock Conversions",
                        style: {
                            color: '#00E396',
                        }
                    },
                    },
                    {
                        seriesName: 'Revenue',
                        opposite: true,
                        axisTicks: {
                            show: true,
                        },
                        axisBorder: {
                            show: true,
                            color: '#FEB019'
                        },
                        labels: {
                        style: {
                            colors: '#FEB019',
                        },
                        },
                        title: {
                            text: "Total Outbound of Conversion",
                            style: {
                                color: '#FEB019',
                            }
                        }
                    },
                ],
                tooltip: {
                    fixed: {
                        enabled: true,
                        position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
                        offsetY: 30,
                        offsetX: 60
                    },
                },
                legend: {
                    horizontalAlign: 'left',
                    offsetX: 40
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();

            let getDataChart2Ajax = (year, goodID, isFirst) => {

                $.each(goods, (i, vi) => {
                    if(vi.id == goodID){
                        $('#good-conversion-name').html(vi.name);
                    }
                });

                $.ajax({
                    url : `/dashboard/data-inventory-conversion-goods-chart-ajax/${year}/${goodID}`,
                    method : 'GET',
                    success : function(res){ 
                        chart.updateSeries(res.perMonthDataInventoryConversions);    
                        console.log(res);
                    },
                    error : function(e){
                        console.log(e.toString());
                    }
                })

            };

            let goodID = $('#good_conversion_id').val();

            getDataChart2Ajax(currentTime.getFullYear(), goodID, true);

            $('#bth-search-conversion').on('click', function(){

                let goodID  = $('#good_conversion_id').val();
                let year    = $('#year-conversion').val();            
                getDataChart2Ajax(year, goodID, false);

            });
        }

        initChartInventory1();
        initChartInventory2();
    })

</script>

@endpush