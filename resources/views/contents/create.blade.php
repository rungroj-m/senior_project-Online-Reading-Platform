@extends('app')

@section('content')


<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="header">
			<h1>NEW <span class="first-letter">C</span>HAPTER</h1><h4>{{$book->name}}</h4>
		</div>
		@if($book->isComic())
			<form method="POST" action="/books/{{$book->id}}/content" enctype="multipart/form-data">
		@else
			{!! Form::open(['url' => URL::to("/books/$book->id/content"),'files' => true]) !!}
		@endif
		<div class="error"><font color="red">{{ $errors->first() }}</font></div>
		<div class="form-group col-md-8">
			{!! Form::label('name','Title:',['class'=>'h3']) !!}
			<p>Name this chapter</p>
			{!! Form::text('name',null,['class'=>'form-control']) !!}
		</div>
		<div class="form-group col-md-4">
			{!! Form::label('chapter','Chapter:',['class'=>'h3']) !!}
			<p>Number of this chapter</p>
			{!! Form::text('chapter',null,['class'=>'form-control']) !!}
			<p>Privacy</p>
			{!! Form::select('private', ['0' => 'Unlocked','1' => 'Locked'], null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			@if($book->isComic())
				{!! Form::label('images', 'Choose images') !!}
				{!! Form::file('images[]', array('multiple'=>true)) !!}
			@else
				{!! Form::label('content','Content:',['class'=>'h3']) !!}
				<p>Content of your chapter</p>
				{!! Form::textarea('content',null,['class'=>'form-control']) !!}

				{!! Form::label('upload', 'Upload Docx file') !!}
				{!! Form::file('upload') !!}
			@endif
		</div>
		<div class="form-group" align="right">
			{!! Form::submit('Add Chapter',['class' => 'btn btn-success']) !!}
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		{!! Form::close() !!}
	</div>
</div>

@stop
