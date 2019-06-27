<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="api" content="{{ env('API_VERSION') }}">

	<!-- Favicon -->
	<link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<title>@yield('title', config('app.name'))</title>

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Quicksand:100,300,400,500,600,700,800" rel="stylesheet">
	<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>

	<!-- CSS -->
	<link href="{{ mix('css/platform.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="v-infinite-scroll/dist/v-infinite-scroll.css"></link>
	<script src="v-infinite-scroll/dist/v-infinite-scroll.js"></script>

</head>

<body class="body-platform">

	<div class="wrapper d-flex flex-column justify-content-between align-items-between" id="app" v-cloak>

		<!-- header -->
		
		
		{{-- content --}}
		<div class="row">
			<!-- <div class="col-md-2">
				<article-post></article-post>
			</div> -->
			<div class="col-md-1">
				<platform-header-left></platform-header-left>
				<!-- <platform-header></platform-header> -->
			</div>
			<div class="col-md-11">
				<main class="content container-fluid">
					<router-view categories_list="{{ $categories }}" tags_list="{{ $tags }}"></router-view>
				</main>
			</div>
			<!-- <div class="col-md-2">
				<categories-list></categories-list>
			</div> -->
		</div>

		<!-- footer -->
		<!-- <platform-footer></platform-footer> -->

	</div>

	<!-- JavaScript -->
	<script src="{{ mix('js/platform.js') }}"></script>
	<script type="text/javascript" src="js/tagcanvas.js"></script>
	<script src="//d3js.org/d3.v3.min.js"></script>
</body>
</html>
