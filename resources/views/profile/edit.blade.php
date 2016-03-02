@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
		<h1>Edit {{$user->username}}</h1>
		<hr/>
		{!! Form::open(['method' => 'PUT','route' => ['profile']]) !!}
		{{--{!! Form::open(array('action' => array('BookController@update', $book->bookKey,'_method' => 'PUT'))) !!}--}}
		{{--{!! Form::open(['method' => 'PATCH','route' => ['books.update',$book->contentKey]])!!}--}}
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