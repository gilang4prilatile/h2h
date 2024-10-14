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
            <span class="menu-title">Dashboard</span>
        </a>
    </div>

    @include('components.master-menu', [
            'menuTitle' => 'Master Data',
            'menuIcon' => '<i class="fas fa-database fs-5"></i>',
            'subMenu' => [
                [
                    'menu-title' => 'FTZ',
                    'subMenuIcon' => '<i class="fas fa-plane fa-plane fs-5"></i>',
                    'innerSubMenu' => true,
                    'innerSubMenus' =>  [
                        [
                            'canany' => 'view master-data ftz-good-of-origin',
                            'class' => 'ftzorigingoods',
                            'url' => url('master-data/ftz-origin-of-goods'),
                            'title' => 'Origin Of Goods'
                        ],
                        [
                            'canany' => 'view master-data expenditure-goals',
                            'class' => 'expendituregoals',
                            'url' => url('master-data/ftz-expenditure-goals'),
                            'title' => 'Expenditure Goals'
                        ],
                        [
                            'canany' => 'view master-data income-purpose',
                            'class' => 'incomepurpose',
                            'url' => url('master-data/ftz-income-purpose'),
                            'title' => 'Income Purpose'
                        ],
                    ],
                ],
                [
                    'innerSubMenu' => false,
                    'innerSubMenus' => [
                        [
                            'canany' => 'view master-data country',
                            'class' => 'country',
                            'url' => url('master-data/country'),
                            'title' => 'Country',
                        ],
                        [
                            'canany' => 'view master-data uom',
                            'class' => 'uom',
                            'url' => url('master-data/uom'),
                            'title' => 'UOM',
                        ],
                        [
                            'canany' => 'view master-data kppbc',
                            'class' => 'kppbc',
                            'url' => url('master-data/kppbc'),
                            'title' => 'KPPBC',
                        ],
                        [
                            'canany' => 'view master-data profile',
                            'class' => 'client',
                            'url' => url('master-data/profile'),
                            'title' => 'Client',
                        ],
                        [
                            'canany' => 'view master-data tujuan-pengiriman',
                            'class' => 'tujuanpengiriman',
                            'url' => url('master-data/tujuan-pengiriman'),
                            'title' => 'Tujuan Pengiriman',
                        ],
                        [
                            'canany' => 'view master-data jenis-tpb',
                            'class' => 'jenistpb',
                            'url' => url('master-data/jenis-tpb'),
                            'title' => 'TPB',
                        ],
                        [
                            'canany' => 'view master-data package',
                            'class' => 'package',
                            'url' => url('master-data/package'),
                            'title' => 'Package',
                        ],
                        [
                            'canany' => 'view master-data document',
                            'class' => 'document',
                            'url' => url('master-data/document'),
                            'title' => 'Document',
                        ],
                        [
                            'canany' => 'view master-data tps',
                            'class' => 'tps',
                            'url' => url('master-data/tps'),
                            'title' => 'TPS',
                        ],
                        [
                            'canany' => 'view master-data warehouse',
                            'class' => 'warehouse',
                            'url' => url('master-data/warehouse'),
                            'title' => 'Warehouse',
                        ],
                        [
                            'canany' => 'view master-data ukuran-peti-kemas',
                            'class' => 'ukuran-peti-kemas',
                            'url' => url('master-data/ukuran-peti-kemas'),
                            'title' => 'Ukuran Peti Kemas',
                        ],
                        [
                            'canany' => 'view master-data type-peti-kemas',
                            'class' => 'type-peti-kemas',
                            'url' => url('master-data/type-peti-kemas'),
                            'title' => 'Type Peti Kemas',
                        ],
                        [
                            'canany' => 'view master-data valas',
                            'class' => 'valas',
                            'url' => url('master-data/valas'),
                            'title' => 'Valas',
                        ],
                        [
                            'canany' => 'view master-data goods',
                            'class' => 'goods',
                            'url' => url('master-data/goods'),
                            'title' => 'Goods',
                        ],
                        [
                            'canany' => 'view master-data type-goods',
                            'class' => 'type-goods',
                            'url' => url('master-data/type-goods'),
                            'title' => 'Type Goods',
                        ],
                        [
                            'canany' => 'view master-data incoterms',
                            'class' => 'incoterms',
                            'url' => url('master-data/incoterms'),
                            'title' => 'Incoterms',
                        ],
                        [
                            'canany' => 'view master-data hscode',
                            'class' => 'hscode',
                            'url' => url('master-data/hscode'),
                            'title' => 'HS Code',
                        ],
                        [
                            'canany' => 'view master-data rate-preference',
                            'class' => 'rate-preference',
                            'url' => url('master-data/rate-preference'),
                            'title' => 'Rate Preference',
                        ],
                        [
                            'canany' => 'view master-data port',
                            'class' => 'port',
                            'url' => url('master-data/port'),
                            'title' => 'Port',
                        ],
                        [
                            'canany' => 'view master-data fasilitas',
                            'class' => 'fasilitas',
                            'url' => url('master-data/fasilitas'),
                            'title' => 'Fasilitas',
                        ],
                        [
                            'canany' => 'view master-data origin-of-goods',
                            'class' => 'origingoods',
                            'url' => url('master-data/origin-of-goods'),
                            'title' => 'Origin Of Goods',
                        ],
                        [
                            'canany' => 'view master-data institutional-permission',
                            'class' => 'institutionalpermission',
                            'url' => url('master-data/institutional-permission'),
                            'title' => 'Institutional Permission',
                        ],
                        [
                            'canany' => 'view master-data export-method',
                            'class' => 'exportmethod',
                            'url' => url('master-data/export-method'),
                            'title' => 'Export Method',
                        ],
                        [
                            'canany' => 'view master-data type-of-guarantee',
                            'class' => 'typeofguarantee',
                            'url' => url('master-data/type-of-guarantee'),
                            'title' => 'Type Of Guarantee',
                        ],
                        [
                            'canany' => 'view master-data import-method',
                            'class' => 'importmethod',
                            'url' => url('master-data/import-method'),
                            'title' => 'Import Method',
                        ],
                        [
                            'canany' => 'view master-data bank',
                            'class' => 'bank',
                            'url' => url('master-data/bank'),
                            'title' => 'Bank',
                        ],
                        [
                            'canany' => 'view master-data good-category',
                            'class' => 'goodcategory',
                            'url' => url('master-data/good-category'),
                            'title' => 'Good Category',
                        ],
                        [
                            'canany' => 'view master-data expenditure-destination',
                            'class' => 'expendituredestination',
                            'url' => url('master-data/expenditure-destination'),
                            'title' => 'Expenditure Destination',
                        ],
                        [
                            'canany' => 'view master-data export-category',
                            'class' => 'exportcategory',
                            'url' => url('master-data/export-category'),
                            'title' => 'Export Category',
                        ],
                        [
                            'canany' => 'view master-data transport-line',
                            'class' => 'transportline',
                            'url' => url('master-data/transport-line'),
                            'title' => 'Transport Line',
                        ],
                        [
                            'canany' => 'view master-data master-status',
                            'class' => 'masterstatus',
                            'url' => url('master-data/master-status'),
                            'title' => 'Master Status',
                        ],
                        [
                            'canany' => 'view master-data transportations',
                            'class' => 'transportations',
                            'url' => url('master-data/transportations'),
                            'title' => 'Transportations',
                        ],
                        [
                            'canany' => 'view master-data entrepreneur-status',
                            'class' => 'entrepreneurstatus',
                            'url' => url('master-data/entrepreneur-status'),
                            'title' => 'Entrepreneur Status',
                        ],
                        [
                            'canany' => 'view master-data place-of-origin',
                            'class' => 'placeoforigin',
                            'url' => url('master-data/place-of-origin'),
                            'title' => 'Place Of Origin',
                        ],
                        [
                            'canany' => 'view master-data trade-method',
                            'class' => 'trademethod',
                            'url' => url('master-data/trade-method'),
                            'title' => 'Trade Method',
                        ],
                        [
                            'canany' => 'view master-data payment-method',
                            'class' => 'paymentmethod',
                            'url' => url('master-data/payment-method'),
                            'title' => 'Payment Method',
                        ],
                        [
                            'canany' => 'view master-data special-specification',
                            'class' => 'specialspecification',
                            'url' => url('master-data/special-specification'),
                            'title' => 'Special Specification',
                        ],
                    ],
                ],
            ],
        ]
    )

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
    @canany(['view ftz import-from-outside-pabean', 'view ftz export-to-outside-pabean'])
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{$moduleNav=="ftz0101" || $moduleNav=="ftz0102" ? 'show' : ''}}">
        <span class="menu-link">
            <span class="menu-icon"> 
                <i class="fas fa-ship fa-ship fs-5"></i>
            </span>
            <span class="menu-title">FTZ</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">
            @can('view ftz import-from-outside-pabean')
            <div class="menu-item {{$moduleNav=="ftz0101" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('ftz/ftz0101')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">FTZ01 Import</span>
                </a>
            </div>
            @endcan

            @can('view ftz export-to-outside-pabean')
            <div class="menu-item {{$moduleNav=="ftz0102" ? 'here' : ''}}">
                <a class="menu-link" href="{{url('ftz/ftz0102')}}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">FTZ01 Export</span>
                </a>
            </div>
            @endcan 
        </div>
    </div>
    @endcanany
    @canany(['view outbound bc-41', 'view outbound bc-25','view inbound bc-40', 'view inbound bc-23','view master-data good-conversion', 'view inventory-conversion' , 'view inventory-conversion-out'])
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{$moduleNav=="inboundbc40" || $moduleNav=="inboundbc23" || $moduleNav=="inboundbc27"|| $moduleNav=="inboundbc40"|| $moduleNav=="inboundbc25"||$moduleNav=="inventory" || $moduleNav=="inventory-out"||$moduleNav=="good-conversions" || $moduleNav=="inventory-conversion" || $moduleNav=="inventory-conversion-out" ? 'show' : ''}}">
    <span class="menu-link">
        <span class="menu-icon"> 
            <i class="fas fa-building fa-building fs-5"></i>
        </span>
        <span class="menu-title">TPB</span>
        <span class="menu-arrow"></span>
    </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">
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