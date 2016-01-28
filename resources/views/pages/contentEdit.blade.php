@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h1>{{$content->name}}</h1>
			<hr/>
			{!! Form::open(['method' => 'PATCH','route' =>  ['books.{book}.content.update',$content->bookKey,$content->chapter]])!!}
			<div class="form-group">
			{!! Form::label('chapter','Chapter:') !!}
			{!! Form::text('chapter',$content->chapter,['class'=>'form-control']) !!}
			</div>
			<div class="form-group">
			{!! Form::label('name','Name:') !!}
			{!! Form::text('name',$content->name,['class'=>'form-control']) !!}
			</div>
			<div class="form-group">
			{!! Form::label('content','Content:') !!}
			{!! Form::textarea('content',$content->content,['class'=>'form-control']) !!}
			</div>
			<div class="form-group">
			{!! Form::submit('Edit Chapter',['class' => 'btn btn-default']) !!}
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop
