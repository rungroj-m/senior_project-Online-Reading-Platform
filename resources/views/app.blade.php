@extends('chrome')

@section('app')

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				@if(Auth::guest())
					<a class="navbar-brand" href="{{ url('/') }}"><span class="first-letter">R</span>EADI</a>
				@else
					<a class="navbar-brand" href="{{ url('/index') }}"><span class="first-letter">R</span>EADI</a>
				@endif
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-left">
					<li><a href="{{ url('/index') }}"><span class="first-navbar-letter">F</span>EED</a></li>
					<li><a href="{{ url('/books') }}"><span class="first-navbar-letter">N</span>OVEL</a></li>
					<li><a href="{{ url('/comics') }}"><span class="first-navbar-letter">C</span>OMIC</a></li>
				</ul>
				<form class="navbar-form navbar-left" role="search" method="GET" action="/books/search">
					<div class="input-group">
						<input type="text" class="form-control" name="request" placeholder="Search">
						<div class="input-group-btn">
							<button class="btn btn-success form-control">Go</button>
						</div>
					</div>
				</form>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<div>
								@if (Auth::guest())
									Guest 
								@else
									{{$user->username}} 
								@endif
								<span class="glyphicon glyphicon-user"></span>
								<span class="caret"></span>
							</div>
						</a>
						<ul class="dropdown-menu">
						@if (Auth::guest())
							<li><a href="{{ url('/login') }}">Login</a></li>
							<li><a href="{{ url('/register') }}">Register</a></li>
						@else
							<li><a href="/profile">Profile Dashboard</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="{{ url('/logout') }}">Logout</a></li>
						@endif
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="main-container">
		@yield('content')
	</div>


@stop