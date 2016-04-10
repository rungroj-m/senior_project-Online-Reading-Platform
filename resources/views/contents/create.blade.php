@extends('app')

@section('content')


<div>
	<div class="col-md-10 col-md-offset-1">
		<h1 class="inline">NEW <span class="first-letter">C</span>HAPTER</h1>
		<h4 class="inline">{{$book->name}}</h4>
		@if($book->isComic())
			<form method="POST" action="/books/{{$book->id}}/content" enctype="multipart/form-data">
		@else
			{!! Form::open(['url' => URL::to("/books/$book->id/content")]) !!}
		@endif

		<div class="form-group">
			{!! Form::label('name','Name:') !!}
			{!! Form::text('name',null,['class'=>'form-control']) !!}
		</div>
		<div class="form-group">

			@if($book->isComic())
				{!! Form::label('images', 'Choose images') !!}
				{!! Form::file('images[]', array('multiple'=>true)) !!}
			@else
				{!! Form::label('content','Content:') !!}
				{!! Form::textarea('content',null,['class'=>'form-control']) !!}
			@endif
		</div>
		<div class="error"><font color="red">{{ $errors->first() }}</font></div>
		<div class="form-group">
			{!! Form::label('chapter','Chapter:') !!}
			{!! Form::text('chapter',null,['class'=>'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::submit('Add Chapter',['class' => 'btn btn-default']) !!}
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		{!! Form::close() !!}
	</div>
</div>

@stop
