@extends('app')

@section('content')

	<h1>{{$book->name}}</h1>
	<hr/>
	{!! Form::open(['method' => 'PUT','route' => ['books.update', $book->bookKey]]) !!}
	{{--{!! Form::open(array('action' => array('BookController@update', $book->bookKey,'_method' => 'PUT'))) !!}--}}
	{{--{!! Form::open(['method' => 'PATCH','route' => ['books.update',$book->contentKey]])!!}--}}
	<div class="form-group">
		{!! Form::label('name','Name:') !!}
		{!! Form::text('name',$book->name,['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('description','Description:') !!}
		{!! Form::textarea('description',$book->description,['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::submit('Edit',['class' => 'btn btn-default']) !!}
	</div>
	{!! Form::close() !!}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

@stop