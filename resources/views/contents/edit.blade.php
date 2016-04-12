@extends('app')

@section('content')

<div>
	<div class="col-md-10 col-md-offset-1">
		<h1>Edit {{$content->name}}</h1>
		<hr/>

		@if($book->isComic())
			{!! Form::open(['method' => 'PATCH','route' =>  ['comics.{book}.content.update',$content->book_id,$content->chapter],'files'=> true])!!}
		@else
			{!! Form::open(['method' => 'PATCH','route' =>  ['books.{book}.content.update',$content->book_id,$content->chapter]])!!}
		@endif
		<div class="form-group">
		{!! Form::label('chapter','Chapter:') !!}
		{!! Form::text('chapter',$content->chapter,['class'=>'form-control']) !!}
		</div>
		<div class="form-group">
		{!! Form::label('name','Name:') !!}
		{!! Form::text('name',$content->name,['class'=>'form-control']) !!}
		</div>

		<div class="form-group">
			@if($book->isComic())
				{!! Form::label('images', 'Choose images') !!}
				{!! Form::file('images[]', array('multiple'=>true)) !!}
			@else
				{!! Form::label('content','Content:') !!}
				{!! Form::textarea('content',$content->content,['class'=>'form-control']) !!}
			@endif
		</div>


		<div class="form-group">
		{!! Form::submit('Edit Chapter',['class' => 'btn btn-default']) !!}
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		{!! Form::close() !!}
	</div>
</div>

@stop
