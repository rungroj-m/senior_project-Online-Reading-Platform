@extends('app')

@section('content')

<body class="main-container home-background">
	<div class="row">
		<div class="container col-md-10">
			<div class="col-md-6 home-left">
				<div class="title">
					<span class="first-letter">R</span>EADI
				</div>
				<h2>Reading Scrublords PJSalt Kappa FailFish.</h2>
			</div>
			<div class="col-md-6 home-right">
				<form class="form-vertical" role="form" method="POST" action="{{ url('/login') }}">
					<h1><span class="first-letter">W</span>elcome!</h1>
					<p>Login to start reading, become a creator, or <a href="register">register</a> to be part of our community</p><br/>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<div>
							<input placeholder="E-mail" type="email" class="form-control" name="email" value="{{ old('email') }}">
							<input placeholder="Password" type="password" class="form-control" name="password"><br/>
							<button type="submit" class="form-control btn btn-success">Login</button>
						</div><br/>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
@endsection