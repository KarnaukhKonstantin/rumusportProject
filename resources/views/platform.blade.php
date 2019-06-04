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

</head>
<body class="">

	<div class="wrapper d-flex flex-column justify-content-between align-items-between" id="app" v-cloak>

		<!-- header -->
		<platform-header></platform-header>
		
		{{-- content --}}
		<div class="row">
			<div class="col-md-2">
				<article-post></article-post>
			</div>
			<div class="col-md-8">
				<main class="content container-fluid">
					<router-view></router-view>
				</main>
			</div>
			<div class="col-md-2">
				<categories-list></categories-list>
			</div>
		</div>
		
		
		<!-- modals -->
		<login-modal locallanguage="{{ app()->getLocale() }}"></login-modal>
		<register-modal locallanguage="{{ app()->getLocale() }}"></register-modal>
		<!-- footer -->
		<platform-footer></platform-footer>

	</div>

	<!-- JavaScript -->
	<script src="{{ mix('js/platform.js') }}"></script>
</body>
</html>
