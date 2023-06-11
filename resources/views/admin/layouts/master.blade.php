<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	@yield('meta_tags')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	@yield('head')
	<!-- Favicon -->
	@if($theme)
	<link rel="shortcut icon" href="{{asset($theme->logo)}}">
	@endif
	<!-- Bootstrap CSS -->
	<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
	<!-- Font Awesome CSS -->
	<link href="{{asset('assets/fontawesome-latest/css/all.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
	<!-- Custom CSS -->
	<link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />
	<!-- BEGIN CSS for this page -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" />
	<!-- END CSS for this page -->
	<!-- BEGIN CSS for this page -->
	<link rel="stylesheet" href="{{asset('/assets/plugins/select2/css/select2.min.css')}}">
	<link rel="stylesheet" href="{{asset('/assets/plugins/select2/css/select2bs4.min.css')}}">
	<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.5.0/css/bootstrap4-toggle.min.css" rel="stylesheet">
	<link href="{{asset('assets/plugins/toastr/toastr.css')}}" rel="stylesheet" type="text/css" />
	<style>
		.parsley-error {
			border-color: #ff5d48 !important;
		}

		.parsley-errors-list.filled {
			display: block;
		}

		.parsley-errors-list {
			display: none;
			margin: 0;
			padding: 0;
		}

		.parsley-errors-list>li {
			font-size: 12px;
			list-style: none;
			color: #ff5d48;
			margin-top: 5px;
		}

		.form-section {
			padding-left: 15px;
			border-left: 2px solid #FF851B;
			display: none;
		}

		.form-section.current {
			display: inherit;
		}
	</style>
	<style media="screen">
		.modal-open {
			overflow: inherit;
		}

		.cfx {
			background-color: #4980b5;
		}
	</style>
	<!-- END CSS for this page -->

	<style media="screen">
		@-webkit-keyframes fadeIn {
			0% {
				opacity: 0;
			}

			100% {
				opacity: 1;
			}
		}

		@keyframes fadeIn {
			0% {
				opacity: 0;
			}

			100% {
				opacity: 1;
			}
		}

		.fadeIn {
			-webkit-animation-duration: 3s;
			animation-duration: 3s;
			-webkit-animation-fill-mode: both;
			animation-fill-mode: both;
			-webkit-animation-name: fadeIn;
			animation-name: fadeIn;
		}
	</style>

	<style media="screen">
		@-webkit-keyframes sharmila {
			0% {
				opacity: 0;
			}

			100% {
				opacity: 1;
			}
		}

		@keyframes sharmila {
			0% {
				opacity: 0;
			}

			100% {
				opacity: 1;
			}
		}

		.sharmila {
			-webkit-animation-duration: 10s;
			animation-duration: 10s;
			-webkit-animation-fill-mode: both;
			animation-fill-mode: both;
			-webkit-animation-name: fadeIn;
			animation-name: fadeIn;
		}

		/* Start  sidebar*/

		#wrapper {
			overflow-x: hidden;
		}

		#sidebar-wrapper {
			-webkit-transition: margin .50s ease-out;
			-moz-transition: margin .50s ease-out;
			-o-transition: margin .50s ease-out;
			transition: margin .50s ease-out;
		}

		#page-content-wrapper {
			-webkit-transition: margin .50s ease-out;
			-moz-transition: margin .50s ease-out;
			-o-transition: margin .50s ease-out;
			transition: margin .50s ease-out;
		}

		[class^='select2'] {
			border-radius: 0px !important;
		}
	</style>
	<style>
		/* Extra small devices (portrait phones, less than 576px) */
		@media (max-width: 575.98px) {
			#sidebar-wrapper {
				margin-left: -256px;
			}

			#sidebar-wrapper .sidebar-heading {
				padding: 0.875rem 1.25rem;
				font-size: 1.2rem;
			}

			#sidebar-wrapper .list-group {
				width: 254px;
			}

			#navbar {
				margin-left: 0px;
			}

			#page-content-wrapper {
				min-width: 100vw;
				margin-top: 54px;
				margin-left: 0px;
				padding:0px;
			}

			#wrapper.toggled #sidebar-wrapper {
				margin-left: 0px;
			}

			#wrapper.toggled #page-content-wrapper {
				margin-left: 256px;
			}

			#navbar.toggled {
				margin-left: 256px !important;
			}
		}

		/* Small devices (landscape phones, less than 768px) */
		@media (max-width: 767.98px) {
			#sidebar-wrapper {
				margin-left: -256px;
			}

			#sidebar-wrapper .sidebar-heading {
				padding: 0.875rem 1.25rem;
				font-size: 1.2rem;
			}

			#sidebar-wrapper .list-group {
				width: 254px;
			}

			#navbar {
				margin-left: 0px;
			}

			#page-content-wrapper {
				min-width: 100vw;
				margin-top: 54px;
				margin-left: 0px;
				padding:0px;
			}

			#wrapper.toggled #sidebar-wrapper {
				margin-left: 0px;
			}

			#wrapper.toggled #page-content-wrapper {
				margin-left: 256px;
			}

			#navbar.toggled {
				margin-left: 256px !important;
			}
		}

		/* Medium devices (tablets, less than 992px) */
		@media (max-width: 991.98px) {
			#sidebar-wrapper {
				margin-left: -256px;
			}

			#sidebar-wrapper .sidebar-heading {
				padding: 0.875rem 1.25rem;
				font-size: 1.2rem;
			}

			#sidebar-wrapper .list-group {
				width: 254px;
			}

			#navbar {
				margin-left: 0px;
			}

			#page-content-wrapper {
				min-width: 100vw;
				margin-top: 54px;
				margin-left: 0px;
				padding:0px;
			}

			#wrapper.toggled #sidebar-wrapper {
				margin-left: 0px;
			}

			#wrapper.toggled #page-content-wrapper {
				margin-left: 256px;
			}

			#navbar.toggled {
				margin-left: 256px !important;
			}
		}

		/* Large devices (desktops, less than 1200px) */
		@media (max-width: 1199.98px) {
			#sidebar-wrapper {
				margin-left: -256px;
			}

			#sidebar-wrapper .sidebar-heading {
				padding: 0.875rem 1.25rem;
				font-size: 1.2rem;
			}

			#sidebar-wrapper .list-group {
				width: 254px;
			}

			#navbar {
				margin-left: 0px;
			}

			#page-content-wrapper {
				min-width: 100vw;
				margin-top: 54px;
				margin-left: 0px;
				padding:0px;
			}

			#wrapper.toggled #sidebar-wrapper {
				margin-left: 0px;
			}

			#wrapper.toggled #page-content-wrapper {
				margin-left: 256px;
			}

			#navbar.toggled {
				margin-left: 256px !important;
			}
		}


		/* Large devices (desktops, greater than 1200px) */
		@media (min-width: 1199.98px) {
			#sidebar-wrapper {
				margin-left: 0px;
			}

			#sidebar-wrapper .sidebar-heading {
				padding: 0.875rem 1.25rem;
				font-size: 1.2rem;
			}

			#sidebar-wrapper .list-group {
				width: 254px;
			}

			#navbar {
				margin-left: 268px;
			}

			#page-content-wrapper {
				min-width: 0;
				width: 100%;
				margin-top: 66px;
				margin-left: 268px;
				padding:0px;
			}

			#wrapper.toggled #sidebar-wrapper {
				margin-left: -268px;
			}

			#wrapper.toggled #page-content-wrapper {
				margin-left: 0px;
			}

			#navbar.toggled {
				margin-left: 0px !important;
			}
		}
	</style>
	@yield('stylesheets')
	@yield('css')

	<!-- Scripts -->
	<script>
		window.Laravel = <?php echo json_encode([
								'csrfToken' => csrf_token(),
							]); ?>
	</script>

	<!-- This makes the current user's id available in javascript -->
	@if(!auth()->guest())
	<script>
		window.Laravel.userId = <?php echo auth()->user()->id; ?>
	</script>
	@endif
</head>

<body style="padding-bottom:0px !important" class="fadeIn">

	<div id="main" class="universal-raj">
		@include('admin.inc.header')
		<div class="d-flex" id="wrapper" style="padding:0px !important;">
			@include('admin.inc.sidebar')
			<div class="" id="page-content-wrapper" style="background-color: #E7F1FC;">
				@yield('content')
				@include('admin.inc.footer')
			</div>
		</div>
	</div>
	<!-- END main -->




	<style media="screen">
		.vraj {
			border-left: 2px solid #383737;
		}

		.vraj:hover {
			background-color: #111111;
			border-left: 2px solid #fff;
		}

		.ho {
			border-left: 2px solid #fff;
			background-color: #111111;
		}

		.fa-stack[data-count]:after {
			position: absolute;
			right: 0%;
			top: 1%;
			content: attr(data-count);
			font-size: 50%;
			padding: .3em;
			border-radius: 999px;
			line-height: .75em;
			color: white;
			background: rgba(255, 0, 0, .85);
			text-align: center;
			min-width: 2em;
			font-weight: bold;
		}

		.fa-stack[data-count=""]:after {
			position: absolute;
			right: 0%;
			top: 1%;
			content: attr(data-count);
			font-size: 50%;
			padding: .3em;
			border-radius: 999px;
			line-height: .75em;
			color: white;
			background: rgba(255, 0, 0, .85);
			text-align: center;
			min-width: 2em;
			font-weight: bold;
			display: none;
		}
	</style>

	<style>
		.vraj[aria-expanded="true"]:after {
			transform: rotate(180deg);
		}


		/*for the animation*/
		.dropdown-toggle:after {
			transition: 0.5s;
		}
	</style>

	<style media="screen">
		.vraj[aria-expanded="false"] .ravis:before {
			content: "\f138";
		}

		.vraj[aria-expanded="true"] .ravis::after {
			content: "\f13a";
		}
	</style>


	<script src="{{asset('assets/js/modernizr.min.js')}}"></script>
	<script src="{{asset('assets/js/jquery.min.js')}}"></script>
	<script src="{{asset('assets/js/moment.min.js')}}"></script>
	<script src="{{asset('assets/js/popper.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/js/jquery.nicescroll.js')}}"></script>
	<!-- BEGIN Java Script for this page -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
	<!-- Counter-Up-->
	<script src="{{asset('assets/plugins/counterup/jquery.counterup.min.js')}}"></script>
	<!-- BEGIN Java Script for this page -->
	<script src="{{asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.5.0/js/bootstrap4-toggle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.16.2/standard-all/ckeditor.js"></script>
	<script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>
	<script src="{{asset('assets/plugins/infinite_scroll/jscroll.min.js')}}" charset="utf-8"></script>
	<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}" charset="utf-8"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.15/lodash.min.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<style>
		.error {
			color: red;
		}
	</style>
	<script type="text/javascript">
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
			$("#navbar").toggleClass("toggled");
		});
	</script>
	@yield('js')
	@yield('vs')
	@yield('scripts')
	@include('admin.inc.toastr')
	@include('admin.inc.delete')
	<script>
		$(document).ready(function() {
			// counter-up
			$('.counter').counterUp({
				delay: 10,
				time: 600
			});
		});
	</script>
	<script>
		var popupSize = {
			width: 780,
			height: 550
		};

		$(document).on('click', '.social-buttons > a', function(e) {

			var
				verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
				horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);

			var popup = window.open($(this).prop('href'), 'social',
				'width=' + popupSize.width + ',height=' + popupSize.height +
				',left=' + verticalPos + ',top=' + horisontalPos +
				',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

			if (popup) {
				popup.focus();
				e.preventDefault();
			}

		});
	</script>

	<script type="text/javascript">
		$('.edittag').select2();
	</script>

    @include('admin.inc.notification')

	<script type="text/javascript">
		$(document).ready(function() {
			$('body').show();
		});
	</script>
</body>

</html>