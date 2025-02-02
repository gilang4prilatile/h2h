<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="{{ asset('/') }}../../../">
		<title>H2H Ceisa 4.0</title>
		<meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta charset="utf-8" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Keenthemes | Metronic" />
		<link rel="canonical" href="//preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="{{ asset('/') }}assets/media/logos/favicon.ico" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="{{ asset('/') }}assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/') }}assets/plugins/custom/vis-timeline/vis-timeline.bundle.css" rel="stylesheet" type="text/css" /> 
		<!--end::Page Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{ asset('/') }}assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/') }}assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		
        @stack("css")
        <style>
            .help-block
            {
                color:red;
            }

			a.disabled {
				pointer-events: none;
				cursor: default;
				background: #dedede ;
			}
			#kt_aside_toggle {
				display: block;
				opacity: 1;
				position: absolute;
				top: 20px;
				left: 215px; /* Adjust as needed */
				z-index: 1000;
				background-color: transparent;
				border: none;
				padding: 8px; /* Adjust size */
				border-radius: 50%; /* Makes the button circular */
				cursor: pointer;
				transition: background-color 0.3s, transform 0.3s;
			}

			#kt_aside_toggle:hover {
				background-color: rgba(255, 255, 255, 0.2);
				transform: scale(1.1);
			}
			
			.flex-container {
				display: flex;
				justify-content: space-between;  
				align-items: center;  
			}

			.text-muted-right {
				font-style: italic;
				color: #7D7D7D;  
			}


        </style>
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
			<div id="kt_aside" class="aside aside-dark aside-hoverable" 
            data-kt-drawer="true" 
            data-kt-drawer-name="aside" 
            data-kt-drawer-activate="{default: true, lg: false}" 
            data-kt-drawer-overlay="true" 
            data-kt-drawer-width="{default:'200px', '300px': '250px'}" 
            data-kt-drawer-direction="start" 
            data-kt-drawer-toggle="#kt_aside_toggle">
            
            <!--begin::Brand-->
            <div class="aside-logo flex-column-auto" id="kt_aside_logo">
                <!--begin::Logo-->
                <a href="{{ asset('/') }}dashboard">
                    <h1 style="color: white">
                        <span class="svg-icon svg-icon-info svg-icon-3x">
                            <!-- SVG Icon Here -->
                        </span> H2H Ceisa 4.0
                    </h1>
                </a>
                <!--end::Logo-->
                <!--begin::Aside toggler-->
                <div id="kt_aside_toggle" 
     class="btn btn-icon w-auto px-0 btn-active-color-danger aside-toggle" 
     data-kt-toggle="true" 
     data-kt-toggle-state="active" 
     data-kt-toggle-target="body" 
     data-kt-toggle-name="aside-minimize">
    <i class="bi bi-chevron-left" style="font-size: 20px; color: white;"></i> <!-- Adjust size and color -->
</div>
                <!--end::Aside toggler-->
            </div>
            <!--end::Brand-->
            
            <!--begin::Aside menu-->
            <div class="aside-menu flex-column-fluid">
                <!--begin::Aside Menu-->
                <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" 
                    data-kt-scroll="true" 
                    data-kt-scroll-activate="{default: false, lg: true}" 
                    data-kt-scroll-height="auto" 
                    data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" 
                    data-kt-scroll-wrappers="#kt_aside_menu" 
                    data-kt-scroll-offset="0">
                    
                    @include("layouts.partials.menu")
                </div>
                <!--end::Aside Menu-->
            </div>
            <!--end::Aside menu-->
        </div>
        <!--end::Aside-->

				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" style="" class="header align-items-stretch">
						<!--begin::Container-->
						<div class="container-fluid d-flex align-items-stretch justify-content-between">
							<!--begin::Aside mobile toggle-->
							<div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
								<div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
									<!--begin::Svg Icon | path: icons/duotone/Text/Menu.svg-->
									<span class="svg-icon svg-icon-2x mt-1">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5" />
												<path d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L18.5,10 C19.3284271,10 20,10.6715729 20,11.5 C20,12.3284271 19.3284271,13 18.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z" fill="#000000" opacity="0.3" />
											</g>
										</svg>
									</span>
									<!--end::Svg Icon-->
								</div>
							</div>
							<!--end::Aside mobile toggle-->
							<!--begin::Mobile logo-->
							<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
								<a href="{{ asset('/') }}../../demo1/dist/index.html" class="d-lg-none">
									<img alt="Logo" src="{{ asset('/') }}assets/media/logos/logo-3.svg" class="h-30px" />
								</a>
							</div>
							<!--end::Mobile logo-->
							<!--begin::Wrapper-->
							<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
								<!--begin::Navbar-->
								<div class="d-flex align-items-stretch" id="kt_header_nav">
									<!--begin::Menu wrapper-->
									<div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
										&nbsp;
									</div>
									<!--end::Menu wrapper-->
								</div>
								<!--end::Navbar-->
								<!--begin::Topbar-->
								<div class="d-flex align-items-stretch flex-shrink-0">
									<!--begin::Toolbar wrapper-->
									<div class="d-flex align-items-stretch flex-shrink-0">
										<!--begin::User-->
										<div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
											<!--begin::Menu wrapper-->
											<div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
												<img src="{{ Avatar::create($__user->name)->toBase64() }}" alt="metronic" />
											</div>
											<!--begin::Menu-->
											<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-300px" data-kt-menu="true">
												<!--begin::Menu item-->
												<div class="menu-item px-3">
													<div class="menu-content d-flex align-items-center px-3">
														<!--begin::Avatar-->
														<div class="symbol symbol-50px me-5">
															<img alt="Logo" src="{{ Avatar::create($__user->name)->toBase64() }}" />
														</div>
														<!--end::Avatar-->
														<!--begin::Username-->
														<div class="d-flex flex-column">
															<div class="fw-bolder d-flex align-items-center fs-5">{{ $__user->name }}
															<span class="fw-bolder fs-8 px-2 py-1 ms-2">&nbsp;</span></div>
															{{-- <div href="{{ asset('/') }}#" class="fw-bold text-muted text-hover-primary fs-7">{{ $__user->email }}</div>--}}
															{{-- <div href="{{ asset('/') }}#" class="fw-bold text-muted text-hover-primary fs-7"><i class="fas fa-warehouse fs-5"></i> {{ $__user->warehouse->name ?? '' }}</div>--}}
														</div>
														<!--end::Username-->
													</div>
												</div>
												<!--end::Menu item-->
												<!--begin::Menu item-->
												{{-- <div class="menu-item px-5 my-1"> --}}
												{{-- 	<a href="{{ asset('/') }}../../demo1/dist/account/settings.html" class="menu-link px-5">Account Settings</a> --}}
												{{-- </div> --}}
												<!--end::Menu item-->
												<!--begin::Menu item-->
												<div class="menu-item px-5">
													<a    class="menu-link px-5">
														<span class="menu-text">{{ $__user->email }}</span>
														 
													</a>
												</div>
												<div class="menu-item px-5">
													<a   class="menu-link px-5">
														<span class="menu-text"><i class="fas fa-warehouse fs-5"></i> {{ $__user->warehouse->name ?? '' }}</span>
														 
													</a>
												</div>
												
												<!--end::Menu item-->
												<!--begin::Menu separator-->
												<div class="separator my-2"></div>
												<!--end::Menu separator-->
												<div class="menu-item px-5">
													<a href="{{ url('logout') }}" class="menu-link px-5">Logout</a>
												</div>
											</div>
											<!--end::Menu-->
											<!--end::Menu wrapper-->
										</div>
										<!--end::User -->
										<!--begin::Heaeder menu toggle-->
										<div class="d-flex align-items-center d-lg-none ms-2 me-n3" title="Show header menu">
											<div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_header_menu_mobile_toggle">
												<!--begin::Svg Icon | path: icons/duotone/Text/Toggle-Right.svg-->
												<span class="svg-icon svg-icon-1">
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<path fill-rule="evenodd" clip-rule="evenodd" d="M22 11.5C22 12.3284 21.3284 13 20.5 13H3.5C2.6716 13 2 12.3284 2 11.5C2 10.6716 2.6716 10 3.5 10H20.5C21.3284 10 22 10.6716 22 11.5Z" fill="black" />
															<path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M14.5 20C15.3284 20 16 19.3284 16 18.5C16 17.6716 15.3284 17 14.5 17H3.5C2.6716 17 2 17.6716 2 18.5C2 19.3284 2.6716 20 3.5 20H14.5ZM8.5 6C9.3284 6 10 5.32843 10 4.5C10 3.67157 9.3284 3 8.5 3H3.5C2.6716 3 2 3.67157 2 4.5C2 5.32843 2.6716 6 3.5 6H8.5Z" fill="black" />
														</g>
													</svg>
												</span>
												<!--end::Svg Icon-->
											</div>
										</div>
										<!--end::Heaeder menu toggle-->
									</div>
									<!--end::Toolbar wrapper-->
								</div>
								<!--end::Topbar-->
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Header-->
