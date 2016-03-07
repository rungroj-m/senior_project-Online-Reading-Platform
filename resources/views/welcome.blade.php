@extends('app')

<style>
	.container {
		
		vertical-align: middle;
		margin-top: 150px;
	}
	.home-left {
		background-color: rgba(255,255,255,0.5);
		height: 300;
	}
	.home-right {
		background-color: rgba(0,0,0,0.7);
		color: white;
		height: 300;
	}
</style>

@section('content')
<body class="home-background">
	<div>
		<div class="container">
			<div class="col-md-5 col-md-offset-1 home-left">
				<div class="title">
					Readi
				</div>
				<h1>I don't have a slogan yet, so anything would do here.</h1>
			</div>
			<div class="col-md-4 home-right">
				<h2>Welcome</h2>
				<p>Login to start reading and creating, or <a href="register">register</a> to be part of us</p>
				<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<div class="col-md-10 col-md-offset-1">
							<input placeholder="E-mail" type="email" class="form-control" name="email" value="{{ old('email') }}">
							<input placeholder="Password" type="password" class="form-control" name="password">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-10 col-md-offset-1">
							<button type="submit" class="form-control btn btn-default">Login</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
</body>
@endsection