@extends('app')

@section('content')

	<h1>New contentInfo</h1>
	<hr/>
	{!! Form::open(['url' => 'books']) !!}
	<div class="form-group">
		{!! Form::label('name','Name:') !!}
		{!! Form::text('name',null,['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('description','Description:') !!}
		{!! Form::textarea('description',null,['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('userRating','UserRating:') !!}
		{!! Form::text('userRating',null,['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('criticRating','CriticRating:') !!}
		{!! Form::text('criticRating',null,['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('category','Category:') !!}
		{!! Form::textarea('category',null,['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::submit('Add new content',['class' => 'btn btn-primary form-control']) !!}
	</div>
	{!! Form::close() !!}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
@stop
