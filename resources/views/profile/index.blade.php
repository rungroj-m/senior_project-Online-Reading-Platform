@extends('app')

@section('content')
<div class="main-container">
	<header>
		<h1 class="inline"><span class="first-letter">P</span>ROFILE</h1>
		<h3 class="inline"> // {{$user->username}}</h3>
	</header><br/>
	<div class="row">
		<div class="col-md-2 col-md-offset-1 thumbnail">
			@if($user->image == null)
			<div class="thumbnail content user-image">
				<h3>NO IMAGE</h3>
			</div><br/>
			@else
			<div class="thumbnail content user-image">
				<img src="{{$user->image}}">
			</div><br/>
			@endif
		</div>
		<div class="col-md-9">
			<div>
				<div class="user-profile"><b class="inline">Username: </b> {{$user->username}}</div>
				<div class="user-profile"><b class="inline">Email: </b> //HIDDEN//</div>
				<div class="user-profile"><b class="inline">Joined: </b> {{$user->created_at}}</div>
				<div class="user-profile"><b class="inline">Permission Level: </b> {{$user->userLevel}}</div>
			</div>
		</div>
	</div>
</div>
@stop