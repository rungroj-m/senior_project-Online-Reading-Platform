@extends('chrome')

<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/') }}">READI</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/books') }}">Novel</a></li>
					<li><a href="{{ url('/books') }}">Comic</a></li>
					<li><a href="{{ url('/books') }}">Feed</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						@if (Auth::guest())
							Hello, guest! 
						@else
							Hello, user! 
						@endif
							<span class="glyphicon glyphicon-user"></span>
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
						@if (Auth::guest())
							<li><a href="{{ url('/login') }}">Login</a></li>
							<li><a href="{{ url('/register') }}">Register</a></li>
						@else
							<li><a href="#">Profile</a></li>
						@endif
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')
	
</body>