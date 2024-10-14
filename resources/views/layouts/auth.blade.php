
<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../">
		<title>STORE2GO - LOGIN</title>
		<link rel="shortcut icon" href="{{url('assets')}}/media/logos/favicon.ico" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{url('assets')}}/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{url('assets')}}/css/style.bundle.css" rel="stylesheet" type="text/css" />
        <style>
            .help-block
            {
                color:red;
            }
        </style>
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
		@yield("content")
		<!--end::Main-->
		<!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{url('assets')}}/plugins/global/plugins.bundle.js"></script>
		<script src="{{url('assets')}}/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="{{url('assets')}}/js/custom/authentication/sign-in/general.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
        @stack("js")
        <!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>
