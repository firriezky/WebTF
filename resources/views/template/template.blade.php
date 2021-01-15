<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Tahfidz</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{asset('atlantis/examples')}}/assets/img/icon.ico" type="image/x-icon" />


	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->

	<!--   Core JS Files   -->
	<script src="{{asset('atlantis/examples')}}/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="{{asset('atlantis/examples')}}/assets/js/core/popper.min.js"></script>
	<script src="{{asset('atlantis/examples')}}/assets/js/core/bootstrap.min.js"></script>

	{{-- Toastr  --}}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
		integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
		crossorigin="anonymous" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
		integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
		crossorigin="anonymous"></script>


	<link rel="stylesheet" type="text/css"
		href="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.3/r-2.2.7/sb-1.0.1/sp-1.2.2/datatables.min.css" />


	<!-- jQuery UI -->
	<script src="{{asset('atlantis/examples')}}/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="{{asset('atlantis/examples')}}/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js">
	</script>

	<!-- jQuery Scrollbar -->
	<script src="{{asset('atlantis/examples')}}/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

	<!-- Bootstrap Tagsinput -->
	<script src="{{asset('atlantis/examples')}}/assets/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js">
	</script>

	<!-- Datatables Styling -->
	<link rel="stylesheet" type="text/css"
		href="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.3/r-2.2.7/sc-2.0.3/sb-1.0.1/sp-1.2.2/datatables.css" />

	<!-- DataAOS script -->
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

	<!-- Fonts and icons -->
	<script src="{{asset('atlantis/examples')}}/assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{asset('atlantis/examples')}}/assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});

	
	</script>

	@yield('head-section')

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{asset('atlantis/examples')}}/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{asset('atlantis/examples')}}/assets/css/atlantis.min.css">

	<!-- CSS DATA AOS -->
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	{{-- <link rel="stylesheet" href="{{asset('atlantis/examples')}}/assets/css/demo.css"> --}}
</head>

<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">

				<a href="{{url('/')}}" class="logo">
					<p class="navbar-brand text-white">Tahfidz</p>
					{{-- <img src="{{asset('atlantis/examples')}}/assets/img/logo.svg" alt="navbar brand"
					class="navbar-brand"> --}}
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
					data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			@include('template.nav_bar')

			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		@include('template.side-bar')
		<!-- End Sidebar -->


		<div class="main-panel">
			<div class="content">
				@yield('breadcumb')
				@yield('main')
			</div>
		</div>

	</div>

	</div>




	<!-- Chart JS -->
	<script src="{{asset('atlantis/examples')}}/assets/js/plugin/chart.js/chart.min.js"></script>

	<!-- jQuery Sparkline -->
	<script src="{{asset('atlantis/examples')}}/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

	<!-- Chart Circle -->
	<script src="{{asset('atlantis/examples')}}/assets/js/plugin/chart-circle/circles.min.js"></script>

	<!-- Datatables -->


	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript"
		src="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.3/r-2.2.7/sb-1.0.1/sp-1.2.2/datatables.min.js">
	</script>


	<!-- Bootstrap Notify -->
	<script src="{{asset('atlantis/examples')}}/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

	<!-- jQuery Vector Maps -->
	<script src="{{asset('atlantis/examples')}}/assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="{{asset('atlantis/examples')}}/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

	<!-- Sweet Alert -->
	<script src="{{asset('atlantis/examples')}}/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Atlantis JS -->
	<script src="{{asset('atlantis/examples')}}/assets/js/atlantis.min.js"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	{{-- <script src="{{asset('atlantis/examples')}}/assets/js/setting-demo.js"></script> --}}
	{{-- <script src="{{asset('atlantis/examples')}}/assets/js/demo.js"></script> --}}




	@yield('script')
	<script>
		var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

		var mytotalIncomeChart = new Chart(totalIncomeChart, {
			type: 'bar',
			data: {
				labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
				datasets : [{
					label: "Total Income",
					backgroundColor: '#ff9e27',
					borderColor: 'rgb(23, 125, 255)',
					data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
				}],
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					display: false,
				},
				scales: {
					yAxes: [{
						ticks: {
							display: false //this will remove only the label
						},
						gridLines : {
							drawBorder: false,
							display : false
						}
					}],
					xAxes : [ {
						gridLines : {
							drawBorder: false,
							display : false
						}
					}]
				},
			}
		});

		$('#lineChart').sparkline([105,103,123,100,95,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#ffa534',
			fillColor: 'rgba(255, 165, 52, .14)'
		});
	</script>

	<script>
		AOS.init();
	</script>
</body>

</html>