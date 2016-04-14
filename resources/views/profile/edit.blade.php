@extends('app')

@section('content')
<div>
	<div class="row">
		<div class="col-md-6">
		<h1>Update {{$user->username}} Information</h1>
		<hr/>
		{!! Form::open(['method' => 'PUT','route' => ['profile']]) !!}
			<div class="form-group">
				{!! Form::label('Firstname','Firstname:') !!}
				{!! Form::text('firstName',$user->firstName,['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('Lastname','Lastname:') !!}
				{!! Form::text('lastName',$user->lastName,['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('email','email:') !!}
				{!! Form::text('email',$user->email,['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('email','Email Notification:') !!}
				{!! Form::checkbox('email_noti', 1, $user->email_noti) !!}
			</div>

			<div class="form-group">
				{!! Form::label('facebook','Facebook Notification:') !!}
				{!! Form::checkbox('facebook_noti', 1, $user->facebook_noti) !!}
			</div>

			{{$user->image}}
			<img src="{{ asset('images/'.$user->image) }}" />

			{{--{{HTML::image(URL::to('/'.$user->image))}}--}}
		<div class="form-group">
			{!! Form::submit('Update',['class' => 'btn btn-default']) !!}
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		{!! Form::close() !!}
		</div>
	</div>
</div>

@stop
