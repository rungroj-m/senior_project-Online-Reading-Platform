@extends('app')

@section('content')

	<h1>{{$content->name}}</h1>
	<hr/>
	{!! Form::open(['method' => 'PATCH','route' =>  ['books.{book}.content.update',$content->bookKey,$content->chapter]])!!}
	<div class="form-group">
	{!! Form::label('name','Name:') !!}
	{!! Form::text('name',$content->name,['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
	{!! Form::label('content','Content:') !!}
	{!! Form::textarea('content',$content->content,['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
	{!! Form::label('chapter','Chapter:') !!}
	{!! Form::text('chapter',$content->chapter,['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
	{!! Form::label('type','Type:') !!}
	{!! Form::text('type',$content->type,['class'=>'form-control']) !!}
	</div>
	<div class="form-group">
	{!! Form::submit('Add new content',['class' => 'btn btn-primary form-control']) !!}
	</div>
	{!! Form::close() !!}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
@stop
