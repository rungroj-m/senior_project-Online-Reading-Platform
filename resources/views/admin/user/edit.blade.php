@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
		<h1>Edit {{$user->username}}</h1>
		<hr/>
		{!! Form::open(['method' => 'PUT','route' => ['admin-edit-user', $user->id]]) !!}
			<div class="form-group">
				{!! Form::label('Username','Username:') !!}
				{!! Form::text('username',$user->username,['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('email','email:') !!}
				{!! Form::text('email',$user->email,['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label">User Level</label>
				{!! Form::select('userLevel', ['2' => 'Admin','1' => 'Critic', '0' => 'Standard'],$user->userLevel, ['class' => 'form-control']) !!}
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label">Allow to create Comic</label>
				{!! Form::select('imageLevel', ['1' => 'Allow', '0' => 'Not Allow'],$user->imageLevel, ['class' => 'form-control']) !!}
			</div>

			{{--{{HTML::image(URL::to('/'.$user->image))}}--}}
		<div class="form-group">
			{!! Form::submit('Edit',['class' => 'btn btn-default']) !!}
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		{!! Form::close() !!}
		</div>
	</div>
</div>

@stop
