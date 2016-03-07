@extends('app')

<style>
	.container {
		text-align: center;
		vertical-align: middle;
		margin-top: 130px;
	}
</style>

@section('content')
<body>
	<!-- <div class="container">
		<div class="content">
			<div class="title">
				<span class="glyphicon glyphicon-book"></span>
				READI
			</div>
			<div class="quote">Read. Create. In one place.
				<a href="/books" role="button" class="btn btn-default"><div class="quote">Go to Creator's Hub</div></a>
			</div>
		</div>
	</div> -->

	<div class="container">
		<div class="col-md-6">
			<div class="title">
				READI
				<img src="images/home_book.jpg" height="200" width="200">
			</div>
		</div>
		<div class="col-md-6">
			<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Login</button>

								<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
							</div>
						</div>
					</form>
		</div>
	</div>
</body>
@endsection