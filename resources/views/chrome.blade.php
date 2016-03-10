<!DOCTYPE html>
<html lang="en" ng-app>
<head>
	<style>
		.content {
			text-align: center;
			display: inline-block;
		}
		.container {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}
		.title {
			font-size: 96px;
			margin-bottom: 40px;
		}
		.quote {
			font-size: 24px;
		}
		.word-wrap {
			word-wrap: break-word;
		}
		.content-text {
			white-space: pre-wrap;
		}
		.home-background {
			background-size: cover;
			background-image: url('/images/home_book.jpg');
		}
		.transparent-white{
			background-color: rgba(255,255,255,0.9);
		}
		.home-left {
			background-color: rgba(255,255,255,0.9);
			height: 300;
		}
		.home-right {
			background-color: rgba(0,0,0,0.7);
			color: white;
			height: 300;
		}
		.carousel-image{
			width: auto;
			height: 250px;
			max-height: 250px;
		}
		.carousel-caption{
			text-align: left;
		}
		.top-button{
			text-align: right;
		}
	</style>

	<title>READI Writer's Hub</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

 	<link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- <link href="{{ asset('/css/app.css') }}" rel="stylesheet"> -->
	<link href="{{ asset('/css/app_template.css') }}" rel="stylesheet">

	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/templates.js') }}"></script>

</head>
</html>
