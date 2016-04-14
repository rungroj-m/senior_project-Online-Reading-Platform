@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
		<h1>Edit {{$user->username}}</h1>
		<hr/>
		{!! Form::open(['method' => 'PUT','route' => ['admin-edit-user', $user->id]]) !!}
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
				<label class="col-md-4 control-label">User Level</label>
				<div class="col-md-6">
					<input type="radio" name="userLevel" value="0"> Standard<br>
					<input type="radio" name="userLevel" value="1"> Critic<br>
					<input type="radio" name="userLevel" value="2"> Admin<br>
				</div>
			</div>

			<br><br><br><br>

			<div class="form-group">
				<label class="col-md-4 control-label">Allow to create Comic</label>
				<div class="col-md-6">
					<input type="radio" name="imageLevel" value="0"> Not Allow<br>
					<input type="radio" name="imageLevel" value="1"> Allow
				</div>
			</div>

			{{$user->image}}
			<img src="{{ asset('images/'.$user->image) }}" />

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
