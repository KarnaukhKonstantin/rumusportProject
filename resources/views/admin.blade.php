<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	@if (auth()->check())
    <meta name="user" content="{{ json_encode(Auth::user()) }}">
  @endif

	<!-- Favicon -->
	<link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">

	<title>@yield('title', config('app.name'))</title>

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Muli:100,200,300,400,500,600,700" rel="stylesheet">
	<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>

	<!-- CSS -->
	<link href="{{ mix('css/admin.css') }}" rel="stylesheet">

</head>
<body>

	<div class="container-fluid" id="app" v-cloak>

		<admin-header></admin-header>

		<main class="row">
			<div class="col-2">
				<admin-sidebar></admin-sidebar>
			</div>
			<div class="col-10">
				<router-view categories_list="{{ $categories }}" tags_list="{{ $tags }}"></router-view>
			</div>
		</main>
		
	</div>

	<!-- JavaScript -->
	<script src="{{ mix('js/admin.js') }}"></script>
</body>
</html>
