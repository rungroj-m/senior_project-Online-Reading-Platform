@extends('app')

@section('content')

<body class="home-background">
	<div>
		<div class="content">
			<div class="col-md-5 col-md-offset-1 home-left">
				<div class="title">
					<span class="first-letter">R</span>EADI
				</div>
				<h2>I don't have a slogan yet, so anything would do here.</h2>
			</div>
			<div class="col-md-5 home-right">
				<form class="form-vertical" role="form" method="POST" action="{{ url('/login') }}">
					<h1><span class="first-letter">W</span>elcome!</h1>
					<p>Login to start reading, become a creator, or <a href="register">register</a> to be part of our community</p><br/>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<div class="col-md-10 col-md-offset-1">
							<input placeholder="E-mail" type="email" class="form-control" name="email" value="{{ old('email') }}">
							<input placeholder="Password" type="password" class="form-control" name="password"><br/>
							<button type="submit" class="form-control btn btn-success">Login</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
</body>
@endsection