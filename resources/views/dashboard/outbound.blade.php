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
                                                        <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{ $outboundsOpen }}" >0</div>
                                                    </div>
                                                    <!--end::Number-->
                                                    <!--begin::Label-->
                                                    <div class="fw-bold fs-6 text-gray-400">Outbound Open</div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Stat-->
                                                <!--begin::Stat-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-40px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Number-->
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{ $outboundsClose }}" >0</div>
                                                    </div>
                                                    <!--end::Number-->
                                                    <!--begin::Label-->
                                                    <div class="fw-bold fs-6 text-gray-400">Outbound Close</div>
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
                                        <a class="nav-link text-active-primary me-6" href="/dashboard/inventory">Inventory</a>
                                    </li>
                                    <!--end::Nav item-->
                                    <!--begin::Nav item-->
                                    <li class="nav-item">
                                        <a class="nav-link text-active-primary me-6 active" href="/dashboard/outbound">Outbound</a>
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
                                            <h1>Outbound BC</h1>
                                        </div>
                                         <!--begin::Input-->
                                         <div>
                                            <select class="form-select form-select-solid" id="choose-date-chart-1" data-kt-select2="true">
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                            </select>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--begin::Chart-->
                                    <div id="inbound_chart_1" class="mt-4" style="height: 350px"></div>
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
                                            <h1>Outbound QTY</h1>
                                        </div>
                                         <!--begin::Input-->
                                         <div class="">
                                            <select class="form-select form-select-solid" id="choose-date-chart-2" data-kt-select2="true">
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                            </select>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--begin::Chart-->
                                    <div id="inbound_chart_2" class="mt-4"  style="height: 350px"></div>
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
                                            <h1>TOP 10 Goods Outbound</h1>
                                        </div>
                                         <!--begin::Input-->
                                         <div>
                                            <select class="form-select form-select-solid" id="choose-date-chart-3" data-kt-select2="true">
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                            </select>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--begin::Chart-->
                                    <div id="inbound_chart_3" class="mt-4" style="height: 350px"></div>
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

        var currentTime = new Date()
        const strDates = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jul', 'Jun', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const colors = ['#fff100', '#ff8c00', '#e81123', '#ec008c', '#68217a', '#00188f', '#00bcf2' , '#00b294' , '#009e49', '#bad80a']

        function initChartOutbound1() {

            var element = document.getElementById("inbound_chart_1");

            var height = parseInt(KTUtil.css(element, 'height'));
            var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
            var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
            var baseColor = KTUtil.getCssVariableValue('--bs-info');
            var lightColor = KTUtil.getCssVariableValue('--bs-light-info');

            if (!element) {
                return;
            }
            var options = {
                series: [{
                    name: 'Open',
                    data: []
                },
                {
                    name: 'Close',
                    data: []
                }],
                chart: {
                    fontFamily: 'inherit',
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {

                },
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: 'solid',
                    opacity: 1
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 3,
                    colors: ['#ff8c00','#009e49']
                },
                xaxis: {
                    categories: strDates,
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    },
                    crosshairs: {
                        position: 'front',
                        stroke: {
                            color: baseColor,
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: {
                        enabled: true,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function (val) {
                            return "#" + val + " Task"
                        }
                    }
                },
                colors: [lightColor],
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                markers: {
                    strokeColor: baseColor,
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();

            let getDataChart1Ajax = (year) => {

                $.ajax({
                    url : `/dashboard/data-outbound-chart-ajax/${year}`,
                    method : 'GET',
                    success : function(res){

                        let perMonthOutboundDone = $.each(res.perMonthOutboundDone, (i, vi) => {return vi});
                        let perMonthOutboundDraft = $.each(res.perMonthOutboundDraft, (i, vi) => {return vi});                
                        chart.updateSeries([
                            {
                                name : 'Open',
                                data : perMonthOutboundDraft
                            },
                            {
                                name : 'Close',
                                data : perMonthOutboundDone
                            }
                        ]);      

                    },
                    error : function(e){
                        console.log(e.toString());
                    }
                })

            };

            $('#choose-date-chart-1').on('change', function(){
                getDataChart1Ajax($(this).val());
            });
            $('#choose-date-chart-1').val(currentTime.getFullYear()).change();

        }

        function initChartOutbound2() {
            var element = document.getElementById("inbound_chart_2");

            var height = parseInt(KTUtil.css(element, 'height'));
            var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
            var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
            var baseColor = KTUtil.getCssVariableValue('--bs-primary');
            var secondaryColor = KTUtil.getCssVariableValue('--bs-gray-300');

            if (!element) {
                return;
            }

            var options = {
                series: [{
                    name: 'BC41',
                    data: []
                }, {
                    name: 'BC25',
                    data: []
                }],
                chart: {
                    fontFamily: 'inherit',
                    type: 'bar',
                    height: height,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: ['30%'],
                        endingShape: 'rounded'
                    },
                },
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: strDates,
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                fill: {
                    opacity: 1
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function (val) {
                            return "#" + val + " Inbounds"
                        }
                    }
                },
                colors: [baseColor, secondaryColor],
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();   
            
            let getDataChart2Ajax = (year) => {

                $.ajax({
                    url : `/dashboard/data-outbound-quantity-chart-ajax/${year}`,
                    method : 'GET',
                    success : function(res){

                        perMonthBC41 = $.each(res.perMonthBC41, (i, vi) => {return vi});
                        perMonthBC25 = $.each(res.perMonthBC25, (i, vi) => {return vi});                
                        chart.updateSeries([
                            {
                                name : 'BC41',
                                data : perMonthBC41
                            },
                            {
                                name : 'BC25',
                                data : perMonthBC25
                            }
                        ]);    

                    },
                    error : function(e){
                        console.log(e);
                    }
                })

            };

            $('#choose-date-chart-2').on('change', function(){
                getDataChart2Ajax($(this).val());
            });
            $('#choose-date-chart-2').val(currentTime.getFullYear()).change();
        }
        
        function initChartOutbound3() {

            var element = document.getElementById("inbound_chart_3");

            var height = parseInt(KTUtil.css(element, 'height'));
            var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
            var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
            var baseColor = KTUtil.getCssVariableValue('--bs-info');
            var lightColor = KTUtil.getCssVariableValue('--bs-light-info');

            if (!element) {
                return;
            }
            var options = {
                series: [],
                chart: {
                    fontFamily: 'inherit',
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {

                },
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: 'solid',
                    opacity: 1
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 3,
                    colors: colors
                },
                xaxis: {
                    categories: strDates,
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    },
                    crosshairs: {
                        position: 'front',
                        stroke: {
                            color: baseColor,
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: {
                        enabled: true,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function (val) {
                            return "#" + val + " QTY"
                        }
                    }
                },
                colors: [lightColor],
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                markers: {
                    strokeColor: baseColor,
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
                
            let getDataChart3Ajax = (year) => {

                $.ajax({
                    url : `/dashboard/data-outbound-top-goods-chart-ajax/${year}`,
                    method : 'GET',
                    success : function(res){

                        let perMonthDataGoods = $.each(res.perMonthDataGoods, (i, vi) => {return vi});
                        chart.updateSeries(perMonthDataGoods); 

                    },
                    error : function(e){
                        console.log(e);
                    }
                })

            };

            $('#choose-date-chart-3').on('change', function(){
                getDataChart3Ajax($(this).val());
            });
            
            $('#choose-date-chart-3').val(currentTime.getFullYear()).change();

        }

        initChartOutbound1();
        initChartOutbound2();
        initChartOutbound3();

    })

</script>

@endpush