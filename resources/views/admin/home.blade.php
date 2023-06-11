@extends('admin.layouts.master')
@section('meta_tags')
        <title>laravelhelper.xyz | Dashboard</title>
        <meta charset="utf-8"><!-- html5 version of http-equiv="Content-Type"... -->
@endsection
@section('css')
<style>
.wrapper{
  width:70%;
}
@media(max-width:992px){
 .wrapper{
  width:100%;
} 
}
.panel-heading {
  padding: 0;
	border:0;
}
.panel-title>a, .panel-title>a:active{
	display:block;
	padding:15px;
  color:#555;
  font-size:16px;
  font-weight:bold;
	text-transform:uppercase;
	letter-spacing:1px;
  word-spacing:3px;
	text-decoration:none;
}
.pcard-heading  a:before {
   font-family: 'fontawesome';
   content: "\f067";
   float: right;
}
.pcard-heading.active a:before {
  font-family: 'fontawesome';
   content: "\f068";
   float: right;
} 
</style>
@endsection
@section('content')
    <div class="container-fluid" style="padding:0px;">
         <div class="card shadow" style="border-radius:0px;padding:3px;background-color:#ffffff;color:#212529 ;padding:10px;">
               <div class="row">
                   <div class="col-md-8">
                                <h4 style="background:#fff">{{Auth::user()->getRoleNames()->first()}} Dashboard</h4>
                    </div>
                    <div class="col-md-4">
                         <p class="float-right" style="color:#212529;font-weight:600">Home / <span style="color:#6c757d">Dashboard</span> </p>
                    </div>
                </div>
          </div>
      </div>
          <!-- end row -->

      <div class="container-fluid">
          <h4 class="alert-heading">Welcome {{Auth::user()->name}}!</h4>
      </div>
     <div class="container-fluid" style="min-height:100vh">
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          </div>  
          <div class="card">
            <div class="card-header pcard-heading active">
              <h5 class="success-heading">venue Details <a class="float-right" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              </a></h5>
            </div>

            <div id="collapseOne" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingOne">
            <div class="card-body">
          <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card-box shadow noradius noborder bg-default">
                        <i class="fas fa-music float-right text-white" aria-hidden="true"></i>
                        <h6 class="text-white text-uppercase m-b-20">No of radios</h6>
                        <h1 class="m-b-20 text-white counter">{{$countprop}}</h1>
                    </div>
                </div>

                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card-box shadow noradius noborder bg-warning">
                        <i class="fas fa-envelope float-right text-white" aria-hidden="true"></i>
                        <h6 class="text-white text-uppercase m-b-20">Drafts</h6>
                        <h1 class="m-b-20 text-white counter">{{$countpro}}</h1>
                    </div>
                </div>

                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card-box shadow noradius noborder bg-info">
                        <i class="fas fa-paper-plane float-right text-white" aria-hidden="true"></i>
                        <h6 class="text-white text-uppercase m-b-20">Requested</h6>
                        <h1 class="m-b-20 text-white counter">{{$countrequest}}</h1>
                    </div>
                </div>

                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card-box shadow noradius noborder bg-danger">
                        <i class="fa fa-thumbs-down float-right text-white" aria-hidden="true"></i>
                        <h6 class="text-white text-uppercase m-b-20">Denied</h6>
                        <h1 class="m-b-20 text-white counter">{{$countdeny}}</h1>
                    </div>
                </div>
          </div>
          <!-- end row -->
          <div class="row">
              <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                  <div class="card-box shadow noradius noborder bg-default">
                      <i class="fa fa-thumbs-up float-right text-white" aria-hidden="true"></i>
                      <h6 class="text-white text-uppercase m-b-20">Accepted</h6>
                      <h1 class="m-b-20 text-white counter">{{$countproa}}</h1>
                  </div>
              </div>
          </div>
          </div>
          </div>
          </div>
          @if (Auth::user()->isAdmin())
                    <!-- end row -->
                    <div class="card mt-2">
            <div class="card-header pcard-heading active">
              <h5 class="success-heading">Users Details <a class="float-right" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
              </a></h5>
            </div>

            <div id="collapseTwo" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingTwo">
            <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card-box shadow noradius noborder bg-default">
                        <i class="fa fa-users float-right text-white" aria-hidden="true"></i>
                        <h6 class="text-white text-uppercase m-b-20">No of users</h6>
                        <h1 class="m-b-20 text-white counter">{{$usercount}}</h1>
                    </div>
                </div>

                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card-box shadow noradius noborder bg-warning">
                        <i class="fa fa-user float-right text-white" aria-hidden="true"></i>
                        <h6 class="text-white text-uppercase m-b-20">Active</h6>
                        <h1 class="m-b-20 text-white counter">{{$actusercount}}</h1>
                    </div>
                </div>

                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card-box shadow noradius noborder bg-info">
                        <i class="fa fa-times float-right text-white" aria-hidden="true"></i>
                        <h6 class="text-white text-uppercase m-b-20">Suspended</h6>
                        <h1 class="m-b-20 text-white counter">{{$suspenduserscount}}</h1>
                    </div>
                </div>
          </div>
            </div>
          </div>
          </div>
          
           
          <div class="row">
            <div class="col-md-12 col-lg-6">
                 <div class="card mt-2">
                      <div class="card-header pcard-heading active">
                        <h5 class="success-heading">Visitors and page views on last 7 days <a class="float-right" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                        </a></h5>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingThree">
                          <div class="card-body">
                            <canvas id="Varman" width="400" height="400"></canvas>
                          </div>
                      </div>
                 </div>
            </div>
            <div class="col-md-12 col-lg-6">
              <div class="card mt-2">
                      <div class="card-header pcard-heading active">
                        <h5 class="success-heading">Browser usage on last 7 days <a class="float-right" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                        </a></h5>
                      </div>
                      <div id="collapseFour" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingFour">
                          <div class="card-body">
                               <canvas id="browsers" width="400" height="400"></canvas>
                          </div>
                      </div>
                 </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 col-lg-6">
                 <div class="card mt-2">
                      <div class="card-header pcard-heading active">
                        <h5 class="success-heading">User types on last 7 days <a class="float-right" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                        </a></h5>
                      </div>
                      <div id="collapseFive" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingFive">
                          <div class="card-body">
                          <canvas id="visitors" width="400" height="400"></canvas>
                          </div>
                      </div>
                 </div>
            </div>
            <div class="col-md-12 col-lg-6">
              <div class="card mt-2">
                      <div class="card-header pcard-heading active">
                        <h5 class="success-heading">User types on last 7 days <a class="float-right" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                        </a></h5>
                      </div>
                      <div id="collapseSix" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingSix">
                          <div class="card-body">
                          <canvas id="usertypes" width="400" height="400"></canvas>
                          </div>
                      </div>
                 </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-12">
                 <div class="card mt-2">
                      <div class="card-header pcard-heading active">
                        <h5 class="success-heading">Visitors on last 7 days geo wise <a class="float-right" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                        </a></h5>
                      </div>
                      <div id="collapseSeven" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingSeven">
                          <div class="card-body">
                          <div id="regions_div" style="width: 100%; height: 600px;"></div>
                          </div>
                      </div>
                 </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
                 <div class="card mt-2 mb-2">
                      <div class="card-header pcard-heading active">
                        <h5 class="success-heading">Top most visited pages on last 7 days <a class="float-right" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
                        </a></h5>
                      </div>
                      <div id="collapseEight" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingEight">
                          <div class="card-body">
                          <table class="table table-striped table-bordered table-responsive">
                         <thead class="thead-light">
                           <tr>
                             <th scope="col" width="5%">#</th>
                             <th scope="col" width="90%">Page title</th>
                             <th scope="col" width="10%">Page views</th>
                           </tr>
                         </thead>
                         <tbody>
                           @foreach ($pages as $key => $some)
                           <tr>
                             <th scope="row">{{ $key }}</th>
                             <th scope="row"> <a target="_blank" href="{{ asset($some['url']) }}">{{asset($some['url'])}}</a> </th>
                             <th scope="row">{{$some['pageViews']}}</th>
                           </tr>
                           @endforeach
                         </tbody>
                       </table>
                          </div>
                      </div>
                 </div>
            </div>
          </div>
          @endif
      </div>
    <!-- END container-fluid -->
@endsection
@section('js')
<script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable(
          {!! json_encode($result) !!},
        );

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
    </script>  

  <script>
	// barChart
	var ctx1 = document.getElementById("visitors").getContext('2d');
	var barChart = new Chart(ctx1, {
		type: 'bar',
		data: {
			labels: {!! json_encode($dates->map(function($date) { return $date->format('d/m/y'); })) !!},
			datasets: [{
				label: 'Visitors',
				data: {!! json_encode($visitors) !!},
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)',
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)'
				],
				borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)',
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
				],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
		}
	});

  // comboBarLineChart
	var ctx2 = document.getElementById("Varman").getContext('2d');
	var comboBarLineChart = new Chart(ctx2, {
		type: 'bar',
		data: {
			labels: {!! json_encode($dates->map(function($date) { return $date->format('d/m/y'); })) !!},
			datasets: [{
					type: 'line',
					label: 'Visitors',
					borderColor: '#484c4f',
					borderWidth: 3,
					fill: false,
					data: {!! json_encode($visitors) !!},
				}, {
					type: 'line',
					label: 'Page Views',
          borderColor: '#FF6B8A',
					borderWidth: 3,
          fill: false,
					data: {!! json_encode($pageViews) !!},
				}],
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
		}
	});


	// pieChart
	var ctx3 = document.getElementById("browsers").getContext('2d');
	var pieChart = new Chart(ctx3, {
		type: 'pie',
		data: {
				datasets: [{
					data: {!! json_encode($sessions) !!},
					backgroundColor: [
						'rgba(255,99,132,1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)',
						'rgba(153, 102, 255, 1)',
						'rgba(255, 159, 64, 1)'
					],
					label: 'Dataset 1'
				}],
				labels: {!! json_encode($browser) !!},
			},
			options: {
				responsive: true
			}

	});

	// doughnutChart
	var ctx4 = document.getElementById("usertypes").getContext('2d');
	var doughnutChart = new Chart(ctx4, {
		type: 'doughnut',
		data: {
				datasets: [{
					data: {!! json_encode($sessions1) !!},
					backgroundColor: [
						'rgba(255,99,132,1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)',
						'rgba(153, 102, 255, 1)',
						'rgba(255, 159, 64, 1)'
					],
					label: 'Dataset 1'
				}],
				labels: {!! json_encode($type) !!},
			},
			options: {
				responsive: true
			}

	});

	// radarChart
	var ctx5 = document.getElementById("browser").getContext('2d');
	var doughnutChart = new Chart(ctx5, {
		type: 'radar',
		data: {
				labels: [["Eating", "Dinner"], ["Drinking", "Water"], "Sleeping", ["Designing", "Graphics"], "Coding", "Running"],
				datasets: [{
					label: "My First dataset",
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					borderColor: 'rgba(255,99,132,1)',
					pointBackgroundColor: 'red',
					data: [12, 19, 13, 11, 19, 17]
				}, {
					label: "My Second dataset",
					backgroundColor: 'rgba(250, 80, 112, 0.3)',
					borderColor: 'rgba(54, 162, 235, 1)',
					pointBackgroundColor: 'blue',
					data: [15, 12, 14, 15, 9, 11]
				},]
			},
			options: {
				responsive: true
			}

	});

	// polarAreaChart
	var ctx6 = document.getElementById("Raj").getContext('2d');
	var doughnutChart = new Chart(ctx6, {
		type: 'polarArea',
		data: {
			labels: ["Red","Green","Yellow","Grey","Blue"],
			datasets: [{
				label: "My First Dataset",
				data: [11,16,7,3,14],
				backgroundColor: ["rgb(255, 99, 132)","rgb(75, 192, 192)","rgb(255, 205, 86)","rgb(201, 203, 207)","rgb(54, 162, 235)"]
				}]
		}

	});

  $('.panel-collapse').on('show.bs.collapse', function () {
    $(this).siblings('.pcard-heading').addClass('active');
  });

  $('.panel-collapse').on('hide.bs.collapse', function () {
    $(this).siblings('.pcard-heading').removeClass('active');
  });
	</script>
@endsection
