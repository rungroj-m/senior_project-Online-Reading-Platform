@extends('app')

@section('content')

<div>
	<div class="col-md-10 col-md-offset-1">
	<h1 class="inline"><span class="first-letter">E</span>DIT</h1>
	<h4 class="inline">{{$book->name}}</h4>
	<hr/>
	@if($book->isComic())
		{!! Form::open(['method' => 'PUT','route' => ['comics.update', $book->id],'files'=> true]) !!}
	@else
		{!! Form::open(['method' => 'PUT','route' => ['books.update', $book->id],'files'=> true]) !!}
	@endif
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
	<div class="form-group col-md-4">
		{!! Form::label('image', 'Cover Image', ['class'=>'h3']) !!}
		<p>Cover of this book</p>
		{!! Form::file('image', ['class'=>'content']) !!}
	</div>
	<div class="form-group">
		{!! Form::submit('Edit',['class' => 'btn btn-default']) !!}
	</div>
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	{!! Form::close() !!}
	</div>
</div>


@stop