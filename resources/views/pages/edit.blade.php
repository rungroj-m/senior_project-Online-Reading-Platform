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
		{!! Form::label('userRating','UserRating:') !!}
		{!! Form::text('userRating',$book->userRating,['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('criticRating','CriticRating:') !!}
		{!! Form::text('criticRating',$book->criticRating,['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('category','Category:') !!}
		{!! Form::textarea('category',$book->category,['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::submit('Add new content',['class' => 'btn btn-primary form-control']) !!}
	</div>
	{!! Form::close() !!}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
@stop
