@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
		<h1>Edit Your Notification Preference</h1>
		<hr/>
		{!! Form::open(['method' => 'PUT','url' => [url('profile/preference')]]) !!}
			<div class="form-group">
				{!! Form::label('email','Email Notification:') !!}
				{!! Form::checkbox('email_noti', 1, $preference->email_noti) !!}
			</div>

			<div class="form-group">
				{!! Form::label('facebook','Facebook Notification:') !!}
				{!! Form::checkbox('facebook_noti', 1, $preference->facebook_noti) !!}
			</div>
		<div class="form-group">
			{!! Form::submit('Update',['class' => 'btn btn-default']) !!}
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		{!! Form::close() !!}
		</div>
	</div>
</div>

@stop
