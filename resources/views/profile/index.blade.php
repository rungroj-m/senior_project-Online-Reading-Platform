@extends('app')

@section('content')
<div class="main-container">
	<header>
		<h3 class="inline"><span class="first-letter">P</span>ROFILE</h3>
		<h3 class="inline"><span class="first-letter">D</span>ASHBAORD</h3>
	</header><br/>
	<div class="row">
		<div class="col-md-3">
			<div class="thumbnail content">
				@if($user->image == null)
				<div class="thumbnail content user-image">
					<h3>NO IMAGE</h3>
				</div>
				@else
				<div class="thumbnail content user-image">
					<img src="{{$user->image}}">
				</div>
				@endif
				<div class="content">
					<button class="btn btn-success" data-toggle="modal" data-target="#myModal">Upload Avatar</button>
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<div>
				<div class="user-profile">
					<span class="glyphicon glyphicon-user"></span>
					<b class="inline">Username: </b> {{$user->username}}
				</div>
				<div class="user-profile">
					<span class="glyphicon glyphicon-hourglass"></span>
					<b class="inline">Member Since: </b> {{$user->created_at}}
				</div>
				<div class="user-profile">
					<span class="glyphicon glyphicon-lock"></span>
					<b class="inline">Permission Level: </b> {{$user->userLevel}}
				</div>
				<div class="user-profile">
					<span class="glyphicon glyphicon-book"></span>
					<b class="inline">Books Published: </b> {{$user->books->count()}}
				</div>
			</div>
		</div>
		<div class="col-md-10">
			<ul class="nav nav-tabs">
				<li class="active">
					<a data-toggle="tab" href="#notification"><h4><span class="first-letter">N</span>OTIFICATIONS</h4></a>
				</li>
				<li>
					<a data-toggle="tab" href="#subscription"><h4><span class="first-letter">S</span>UBSCRIPTIONS</h4></a>
				</li>
			</ul>
			<!-- Tab Content -->
			<div class="tab-content">
				<div id="notification" class="tab-pane fade in active">
					<h3>HOME</h3>
					<p>Some content.</p>
				</div>
				<div id="subscription" class="tab-pane fade">
					<h3>Menu 1</h3>
					<p>Some content in menu 1.</p>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

<!-- UPLOAD AVATAR MODAL -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Upload Avatar</h4>
			</div>
			<div class="modal-body">
				{!! Form::label('image', 'Select Avatar', ['class'=>'h3']) !!}
				{!! Form::file('image', ['class'=>'content']) !!}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default inline" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success inline">Upload</button>
			</div>
		</div>
	</div>
</div>