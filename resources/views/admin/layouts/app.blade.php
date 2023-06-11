<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset($theme->logo)}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('meta_tags')

    <!-- Styles -->
    <link href="{{asset("assets/font-awesome/css/font-awesome.min.css")}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Switchery css -->
		<link href="{{asset("assets/plugins/switchery/switchery.min.css")}}" rel="stylesheet" />

		<!-- Bootstrap CSS -->
		<link href="{{asset("assets/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />

		<!-- Font Awesome CSS -->
		<link href="{{asset("assets/font-awesome/css/font-awesome.min.css")}}" rel="stylesheet" type="text/css" />

		<!-- Custom CSS -->
		<link href="{{asset("assets/css/style.css")}}" rel="stylesheet" type="text/css" />

		<link href="{{asset("assets/plugins/sweetalert/sweetalert.css")}}" rel="stylesheet" type="text/css" />

		<!-- BEGIN CSS for this page -->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
		<!-- END CSS for this page -->
		<!-- BEGIN CSS for this page -->
		<link rel="stylesheet" href="{{asset('/select2/dist/css/select2.min.css')}}">

		<link href="{{asset("assets/plugins/jodit-3.2.46/build/jodit.min.css")}}" rel="stylesheet" type="text/css" />

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
		.parsley-errors-list > li {
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
    .btn-google-plus{
      background: #dd4b39;
    }
		</style>
</head>
<body style="padding:0px;">
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" style="background-color:rgb(179, 215, 254);height:125px;">
                <a href="{{route('homepage')}}"><img src="{{asset($theme->logo)}}" alt="" style="height:100px;width:175px;"></a>
        </nav>



        @yield('content')

    </div>

    <script src="{{asset('assets/js/modernizr.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/moment.min.js')}}"></script>

    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

    <script src="{{asset('assets/js/detect.js')}}"></script>
    <script src="{{asset('assets/js/fastclick.js')}}"></script>
    <script src="{{asset('assets/js/jquery.blockUI.js')}}"></script>
    <script src="{{asset('assets/js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset("assets/plugins/switchery/switchery.min.js")}}"></script>
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>




    <!-- BEGIN Java Script for this page -->
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

    	<!-- Counter-Up-->
    	<script src="{{asset('assets/plugins/waypoints/lib/jquery.waypoints.min.js')}}"></script>
    	<script src="{{asset('assets/plugins/counterup/jquery.counterup.min.js')}}"></script>

    	<!-- BEGIN CSS for this page -->
    		<link href="{{asset("assets/plugins/jquery.filer/css/jquery.filer.css")}}" rel="stylesheet" />
    		<link href="{{asset("assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css")}}" rel="stylesheet" />
    		<!-- END CSS for this page -->

    		<!-- BEGIN Java Script for this page -->
    		<script src="{{asset("assets/plugins/jquery.filer/js/jquery.filer.min.js")}}"></script>
    		<script src="{{asset("assets/plugins/parsleyjs/parsley.min.js")}}"></script>

    		<script src="{{asset("assets/plugins/sweetalert/sweetalert.js")}}"></script>

    		<script src="{{asset("assets/plugins/Country-picker/js/countrypicker.min.js")}}"></script>

    		<script src="{{asset("assets/plugins/jodit-3.2.46/build/jodit.min.js")}}"></script>

        <script src="{{asset("assets/plugins/blockui/BlockUI.js")}}"></script>

    		<script src="{{asset("ajaxcrud.js")}}"></script>

        @yield('js')
    		@yield('scripts')
    		<script>
           $('#form').parsley();
        </script>
    <!-- END Java Script for this page -->


    	<script>
    		$(document).ready(function() {
    			// data-tables
    			$('#myTable').DataTable();
          autoFill: true
    			// counter-up
    			$('.counter').counterUp({
    				delay: 10,
    				time: 600
    			});
    		} );
    	</script>

      <script type="text/javascript">
          $('textarea').each(function () {
              var editor = new Jodit(this, {
                  "autofocus": false,
                  "language": "en",
                  "enter": "P",
                  "buttons": ",,,,,,,,,ul,ol,|,font,fontsize,|,image,video,table,link,|,align,undo,redo,\n,",
                  "limitWords": true | 100,
		           //   "limitChars": true | 40,
              });
              editor.events.on('afterInsertImage', function (image) {
                  image.style = "max-height:150px;";
              })
          });
          </script>
</body>
</html>
