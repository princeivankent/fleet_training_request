<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Prince Ivan Kent Tiburcio">
    <link rel="shortcut icon" type="image/x-icon" href="{{{ url('public/favicon.ico') }}}">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ config('app.name', 'Laravel') }}</title>
	<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
</head>
<body>
	<div id="app"></div>
	<script src="http://localhost:8080/js/app.js"></script>
	{{-- <script src="{{ url('public/js/app.js') }}"></script> --}}
</body>
</html>