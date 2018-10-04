<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Prince Ivan Kent Tiburcio">
    <link rel="shortcut icon" type="image/x-icon" href="{{{ url('public/favicon.ico') }}}">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Scripts -->
	<script src="{{ url('public/js/client.js') }}"></script>

	<!-- Fonts -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

	<!-- Styles -->
	<link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
	<link rel="stylesheet" href="{{ url('public/css/styles.css') }}">

	@stack('styles')
</head>
<body>
	<v-app id="app" v-cloak>
		<v-toolbar 
		class="header"
		app fixed clipped-left>
			<v-toolbar-title>
				<img src="{{ url('public/images/isuzu-logo-compressor.png') }}" alt="image not found" style="height: 35px;">
			</v-toolbar-title>
			<v-spacer></v-spacer>
			<v-toolbar-items>
				<v-btn flat color="white">Request for Training</v-btn>
			</v-toolbar-items>
		</v-toolbar>
		
		<v-content dark>
			<v-container>
				@yield('content')
			</v-container>
		</v-content>

		<v-footer class="footer" app fixed>
			<span>&copy; 2017</span>
		</v-footer>
	</v-app>

	<script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script>

	@stack('scripts')
</body>
</html>
