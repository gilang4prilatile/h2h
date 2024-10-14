<!--begin::Menu-->
<div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">
    <div class="menu-item {{$moduleNav=="dashboard" ? 'show' : ''}}">
        <a class="menu-link" href="{{url('dashboard')}}">
            <span class="menu-icon">
                <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </span>
            <span class="menu-title">Dashboards</span>
        </a>
    </div>
    @canany(['view master-data country',
    'view master-data uom',
    'view master-data kppbc',
    'view master-data profile',
    'view master-data tujuan-pengiriman',
    'view master-data jenis-tpb',
    'view master-data package',
    'view master-data document',
    'view master-data tps',
    'view master-data warehouse',
    'view master-data ukuran-peti-kemas',
    'view master-data type-peti-kemas',
    'view master-data valas',
    'view master-data goods',
    'view master-data incoterms',
    'view master-data hscode',
    'view master-data rate-preference',
    'view master-data port',
    'view master-data fasilitas',
    'view master-data type-goods',
    'view master-data origin-of-goods',
    'view master-data intitutional-permission',
    'view master-data export-method',
    'view master-data type-of-guarantee',
    'view master-data import-method',
    'view master-data bank',
    'view master-data good-category',
    'view master-data expenditure-destination',
    'view master-data export-category',
    'view master-data special-specification',
    'view master-data transport-line',
    'view master-data master-status',
    'view master-data transportations',
    'view master-data entrepreneur-status',
    'view master-data place-of-origin',
    'view master-data trade-method'
    ])
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{$moduleNav=="country" || $moduleNav=="uom" || $moduleNav=="kppbc" || $moduleNav=="tpb" || $moduleNav=="pengirimbarang" || $moduleNav=="tujuanpengiriman" || $moduleNav=="jenistpb" || $moduleNav=="package" || $moduleNav=="document" || $moduleNav=="warehouse" || $moduleNav=="identitas" || $moduleNav=="api" || $moduleNav=="valas" || $moduleNav=="importir" || $moduleNav=="ppjk" || $moduleNav=="client" || $moduleNav=="goods" || $moduleNav=="typegoods" || $moduleNav=="incoterms" || $moduleNav=="rate-preference" || $moduleNav=="hscode" || $moduleNav=="type-peti-kemas" || $moduleNav=="ukuran-peti-kemas" || $moduleNav=="port" || $moduleNav=="tps" || $moduleNav=="fasilitas" || $moduleNav=="originofgoods" || $moduleNav=="institutionalpermission" || $moduleNav=="exportmethod" || $moduleNav=="typeofguarantee" || $moduleNav=="importmethod" || $moduleNav=="bank" || $moduleNav=="goodcategory" || $moduleNav=="expendituredestination" || $moduleNav=="exportcategory" || $moduleNav=="specialspecification" || $moduleNav=="transportline" || $moduleNav=="masterstatus" || $moduleNav=="transportation" || $moduleNav=="entrepreneurstatus" || $moduleNav=="placeoforigin" || $moduleNav=="trademethod" ? 'show' : ''}}">
        <span class="menu-link">
            <span class="menu-icon">
                <i class="fas fa-database fs-5"></i>
            </span>
            <span class="menu-title">Master Data</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">

            @canany([
                'view master-data ftz-good-of-origin',
                'view master-data expenditure-goals',
                'view master-data ftz-income-purpose'
            ])
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion 
            {{
            $moduleNav=="ftzorigingoods" || 
            $moduleNav=="expendituregoals" || 
            $moduleNav=="incomepurpose" ? 'show' : ''}}">
                <span class="menu-link">
                    <span class="menu-icon"> 
                        <i class="fas fa-plane fa-plane fs-5"></i>
                    </span>
                    <span class="menu-title">FTZ</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    @can('view master-data ftz-origin-of-goods')
                    <div class="menu-item {{$moduleNav=="ftzorigingoods" ? 'here' : ''}}">
                        <a class="menu-link" href="{{url('master-data/ftz/origin-of-goods')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Origin Of Goods</span>
                        </a>
                    </div>
                    @endcan
        
                    @can('view master-data expenditure-goals')
                    <div class="menu-item {{$moduleNav=="expendituregoals" ? 'here' : ''}}">
                        <a class="menu-link" href="{{url('master-data/ftz/expenditure-goals')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Expnditure Goals</span>
                        </a>
                    </div>
                    @endcan 

                    @can('view master-data ftz-income-purpose')
                    <div class="menu-item {{$moduleNav=="incomepurpose" ? 'here' : ''}}">
                        <a class="menu-link" href="{{url('master-data/ftz/income-purpose')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Income Purpose</span>
                        </a>
                    </div>
                    @endcan 
                </div>
            </div>
            @endcanany


            @can('view master-data country')
            <div class="menu-item {{$moduleNav=="country" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/country')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Country</span>
                </a>
            </div>
            @endcan

            @can('view master-data uom')
            <div class="menu-item {{$moduleNav=="uom" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/uom')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">UOM</span>
                </a>
            </div>
            @endcan

            @can('view master-data kppbc')
            <div class="menu-item {{$moduleNav=="kppbc" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/kppbc')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">KPPBC</span>
                </a>
            </div>
            @endcan

            @can('view master-data profile')
            <div class="menu-item {{$moduleNav=="client" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/profile')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Client</span>
                </a>
            </div>
            @endcan

            @can('view master-data tujuan-pengiriman')
            <div class="menu-item {{$moduleNav=="tujuanpengiriman" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/tujuan-pengiriman')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Tujuan Pengiriman</span>
                </a>
            </div>
            @endcan

            @can('view master-data jenis-tpb')
            <div class="menu-item {{$moduleNav=="jenistpb" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/jenis-tpb')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Jenis TPB</span>
                </a>
            </div>
            @endcan

            @can('view master-data package')
            <div class="menu-item {{$moduleNav=="package" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/package')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Package</span>
                </a>
            </div>
            @endcan

            @can('view master-data document')
            <div class="menu-item {{$moduleNav=="document" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/document')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Document</span>
                </a>
            </div>
            @endcan

            @can('view master-data tps')
            <div class="menu-item {{$moduleNav=="tps" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/tps')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">TPS</span>
                </a>
            </div>
            @endcan

            @can('view master-data warehouse')
            <div class="menu-item {{$moduleNav=="warehouse" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/warehouse')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Warehouse</span>
                </a>
            </div>
            @endcan

            @can('view master-data ukuran-peti-kemas')
            <div class="menu-item {{$moduleNav=="ukuran-peti-kemas" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/ukuran-peti-kemas')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Ukuran Peti Kemas</span>
                </a>
            </div>
            @endcan

            @can('view master-data type-peti-kemas')
            <div class="menu-item {{$moduleNav=="type-peti-kemas" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/type-peti-kemas')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Type Peti Kemas</span>
                </a>
            </div>
            @endcan

            @can('view master-data valas')
            <div class="menu-item {{$moduleNav=="valas" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/valas')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Valas</span>
                </a>
            </div>
            @endcan

            @can('view master-data goods')
            <div class="menu-item {{$moduleNav=="goods" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/goods')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Goods</span>
                </a>
            </div>
            @endcan

            @can('view master-data type-goods')
            <div class="menu-item {{$moduleNav=="typegoods" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/type-goods')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Type Goods</span>
                </a>
            </div>
            @endcan

            @can('view master-data incoterms')
            <div class="menu-item {{$moduleNav=="incoterms" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/incoterms')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Incoterms</span>
                </a>
            </div>
            @endcan

            @can('view master-data hscode')
            <div class="menu-item {{$moduleNav=="hscode" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/hscode')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">HS Code</span>
                </a>
            </div>
            @endcan


            @can('view master-data rate-preference')
            <div class="menu-item {{$moduleNav=="rate-preference" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/rate-preference')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Rate Preference</span>
                </a>
            </div>
            @endcan

            @can('view master-data port')
            <div class="menu-item {{$moduleNav=="port" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/port')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Port</span>
                </a>
            </div>
            @endcan

            @can('view master-data fasilitas')
            <div class="menu-item {{$moduleNav=="fasilitas" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/fasilitas')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Fasilitas</span>
                </a>
            </div>
            @endcan

            @can('view master-data origin-of-goods')
            <div class="menu-item {{$moduleNav=="origin-of-goods" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/origin-of-goods')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Origin Of Goods</span>
                </a>
            </div>
            @endcan

            @can('view master-data institutional-permission')
            <div class="menu-item {{$moduleNav=="institutional-permission" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/institutional-permission')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Institutional Permission</span>
                </a>
            </div>
            @endcan

            @can('view master-data export-method')
            <div class="menu-item {{$moduleNav=="export-method" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/export-method')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Export Method</span>
                </a>
            </div>
            @endcan

            @can('view master-data type-of-guarantee')
            <div class="menu-item {{$moduleNav=="type-of-guarantee" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/type-of-guarantee')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Type Of Guarantee</span>
                </a>
            </div>
            @endcan

            @can('view master-data import-method')
            <div class="menu-item {{$moduleNav=="import-method" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/import-method')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Import Method</span>
                </a>
            </div>
            @endcan

            @can('view master-data bank')
            <div class="menu-item {{$moduleNav=="bank" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/bank')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Bank</span>
                </a>
            </div>
            @endcan

            @can('view master-data good-category')
            <div class="menu-item {{$moduleNav=="good-category" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/good-category')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Good Category</span>
                </a>
            </div>
            @endcan

            @can('view master-data expenditure-destination')
            <div class="menu-item {{$moduleNav=="expenditure-destination" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/expenditure-destination')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Expenditure Destination</span>
                </a>
            </div>
            @endcan

            @can('view master-data export-category')
            <div class="menu-item {{$moduleNav=="export-category" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/export-category')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Export Category</span>
                </a>
            </div>
            @endcan

            @can('view master-data special-specification')
            <div class="menu-item {{$moduleNav=="special-specification" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/special-specification')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Import Method</span>
                </a>
            </div>
            @endcan

            @can('view master-data transport-line')
            <div class="menu-item {{$moduleNav=="transport-line" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/transport-line')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Transport Line</span>
                </a>
            </div>
            @endcan

            @can('view master-data master-status')
            <div class="menu-item {{$moduleNav=="master-status" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/master-status')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Master Status</span>
                </a>
            </div>
            @endcan

            @can('view master-data transportations')
            <div class="menu-item {{$moduleNav=="transportations" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/transportations')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Transportations</span>
                </a>
            </div>
            @endcan

            @can('view master-data entrepreneur-status')
            <div class="menu-item {{$moduleNav=="entrepreneur-status" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/entrepreneur-status')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Entrepreneur Status</span>
                </a>
            </div>
            @endcan

            @can('view master-data place-of-origin')
            <div class="menu-item {{$moduleNav=="place-of-origin" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/place-of-origin')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Place Of Origin</span>
                </a>
            </div>
            @endcan

            @can('view master-data trade-method')
            <div class="menu-item {{$moduleNav=="trade-method" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/trade-method')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Trade Method</span>
                </a>
            </div>
            @endcan
        </div>
    </div>
    @endcanany
    @canany(['view ocean pib', 'view ocean peb'])
    <div data-kt-menu-trigger="click" style="display:none;" class="menu-item menu-accordion {{$moduleNav=="inboundbc40" || $moduleNav=="inboundbc23" || $moduleNav=="inboundbc27" ? 'show' : ''}}">
        <span class="menu-link">
            <span class="menu-icon">
                {{-- <i class="fas fa-ship fs-2"></i> --}}
                <i class="fas fa-ship fs-5"></i>
            </span>
            <span class="menu-title">OCEAN</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">
            @can('view ocean pib')
            <div class="menu-item {{$moduleNav=="inboundbc40" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('inbound/bc-40')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">PIB</span>
                </a>
            </div>
            @endcan

            @can('view ocean peb')
            <div class="menu-item {{$moduleNav=="inboundbc23" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('inbound/bc-23')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">PEB</span>
                </a>
            </div>
            @endcan 
        </div>
    </div>
    @endcanany
    @canany(['view air pib', 'view air peb'])
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{$moduleNav=="airpib" || $moduleNav=="airpeb" ? 'show' : ''}}">
        <span class="menu-link">
            <span class="menu-icon"> 
                <i class="fas fa-plane fa-plane fs-5"></i>
            </span>
            <span class="menu-title">Pemberitauan</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">
            @can('view air pib')
            <div class="menu-item {{$moduleNav=="airpib" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('air/pib')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">PIB</span>
                </a>
            </div>
            @endcan

            @can('view air peb')
            <div class="menu-item {{$moduleNav=="airpeb" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('air/peb')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">PEB</span>
                </a>
            </div>
            @endcan 
        </div>
    </div>
    @endcanany
    @canany(['view inbound bc-40', 'view inbound bc-23'])
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{$moduleNav=="inboundbc40" || $moduleNav=="inboundbc23" || $moduleNav=="inboundbc27" ? 'show' : ''}}">
        <span class="menu-link">
            <span class="menu-icon">
                {{-- <i class="fas fa-cubes fs-2"></i> --}}
                <i class="fas fa-truck-loading fs-5"></i>
            </span>
            <span class="menu-title">Inbound</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">
            @can('view inbound bc-40')
            <div class="menu-item {{$moduleNav=="inboundbc40" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('inbound/bc-40')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">BC 40</span>
                </a>
            </div>
            @endcan

            @can('view inbound bc-23')
            <div class="menu-item {{$moduleNav=="inboundbc23" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('inbound/bc-23')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">BC 23</span>
                </a>
            </div>
            @endcan

            {{-- @can('view inbound bc-27') --}}
            {{-- <div class="menu-item {{$moduleNav=="inboundbc27" ? 'here' : ''}}"> --}}
            {{-- <a class="menu-link" href="{{url('inbound/bc-27')}}"> --}}
            {{-- <span class="menu-bullet"> --}}
            {{-- <span class="bullet bullet-dot"></span> --}}
            {{-- </span> --}}
            {{-- <span class="menu-title">BC 27</span> --}}
            {{-- </a> --}}
            {{-- </div> --}}
            {{-- @endcan --}}
        </div>
    </div>
    @endcanany

    @canany(['view outbound bc-41', 'view outbound bc-25'])
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{$moduleNav=="inventory" || $moduleNav=="inventory-out" ? 'show' : ''}}">
        <span class="menu-link">
            <span class="menu-icon">
                <i class="fas fa-truck fs-5"></i>
            </span>
            <span class="menu-title">Inventory</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">
            @can('view inventory')
            <div class="menu-item {{$moduleNav=="inventory" ? 'show' : ''}}">
                <a class="menu-link" href="{{url('inventory')}}">
                    <span class="menu-icon">
                        <i class="fas fa-warehouse fs-5"></i>
                    </span>
                    <span class="menu-title">Inventory</span>
                </a>
            </div>
            @endcan

            @can('view inventoryout')
            <div class="menu-item {{$moduleNav=="inventory-out" ? 'show' : ''}}">
                <a class="menu-link" href="{{url('inventory-out')}}">
                    <span class="menu-icon">
                        <i class="fas fa-warehouse fs-5"></i>
                    </span>
                    <span class="menu-title">Inventory Out</span>
                </a>
            </div>
            @endcan

        </div>
    </div>
    @endcanany
    @canany(['view outbound bc-41', 'view outbound bc-25'])
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{$moduleNav=="outboundbc41" || $moduleNav=="outboundbc25" || $moduleNav=="outboundbc27" ? 'show' : ''}}">
        <span class="menu-link">
            <span class="menu-icon">
                <i class="fas fa-truck fs-5"></i>
            </span>
            <span class="menu-title">Outbound</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">
            @can('view outbound bc-41')
            <div class="menu-item {{$moduleNav=="outboundbc41" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('outbound/bc-41')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">BC 41</span>
                </a>
            </div>
            @endcan

            @can('view outbound bc-25')
            <div class="menu-item {{$moduleNav=="outboundbc25" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('outbound/bc-25')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">BC 25</span>
                </a>
            </div>
            @endcan

            {{-- @can('view outbound bc-27') --}}
            {{-- <div class="menu-item {{$moduleNav=="outboundbc27" ? 'here' : ''}}"> --}}
            {{-- <a class="menu-link" href="{{url('outbound/bc-27')}}"> --}}
            {{-- <span class="menu-bullet"> --}}
            {{-- <span class="bullet bullet-dot"></span> --}}
            {{-- </span> --}}
            {{-- <span class="menu-title">BC 27</span> --}}
            {{-- </a> --}}
            {{-- </div> --}}
            {{-- @endcan --}}
        </div>
    </div>
    @endcanany

    @canany(['view master-data good-conversion', 'view inventory-conversion' , 'view inventory-conversion-out'])
    <div data-kt-menu-trigger="click" style="display:none;" class="menu-item menu-accordion {{$moduleNav=="good-conversions" || $moduleNav=="inventory-conversion" || $moduleNav=="inventory-conversion-out"? 'show' : ''}}">
        <span class="menu-link">
            <span class="menu-icon">
                <i class="fas fa-warehouse fs-5"></i>
            </span>
            <span class="menu-title">Good Conversion</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">
            @can('view master-data good-conversion')
            <div class="menu-item {{$moduleNav=="good-conversions" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('master-data/good-conversions')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Master Data</span>
                </a>
            </div>
            @endcan

            @can('view inventory-conversion')
            <div class="menu-item {{$moduleNav=="inventory-conversion" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('inventory-conversion')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Restok</span>
                </a>
            </div>
            @endcan

            @can('view inventory-conversion-out')
            <div class="menu-item {{$moduleNav=="inventory-conversion-out" ? 'show' : ''}}">
                <a class="menu-link" href="{{url('inventory-conversion-out')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Restock Out</span>
                </a>
            </div>
            @endcan
        </div>
    </div>
    @endcanany

    @canany(['view user-administration user', 'view user-administration role'])
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{$moduleNav=="user" || $moduleNav=="role" ? 'show' : ''}}">
        <span class="menu-link">
            <span class="menu-icon">
                <i class="fas fa-user fs-5"></i>
            </span>
            <span class="menu-title">User Administration</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">
            @can('view user-administration user')
            <div class="menu-item {{$moduleNav=="user" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('user-administration/user')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">User</span>
                </a>
            </div>
            @endcan

            @can('view user-administration role')
            <div class="menu-item {{$moduleNav=="role" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('user-administration/role')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Role</span>
                </a>
            </div>
            @endcan
        </div>
    </div>
    @endcanany
</div>
<!--end::Menu-->