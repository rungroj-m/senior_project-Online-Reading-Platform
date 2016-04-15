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
	<div class="form-group col-md-6">
		<label class="h3" for="tags">Tags</label><br/>
		<p>Select or add tags to this book</p>
		<div>
			<input type="checkbox" name="checkbox[]" value="Fantasy"> <span class="badge">Fantasy</span>
			<input type="checkbox" name="checkbox[]" value="Sci-Fi"> <span class="badge">Sci-Fi</span>
			<input type="checkbox" name="checkbox[]" value="Comedy"> <span class="badge">Comedy</span>
			<input type="checkbox" name="checkbox[]" value="Action"> <span class="badge">Action</span>
			<input type="checkbox" name="checkbox[]" value="Drama"> <span class="badge">Drama</span>
			<input type="checkbox" name="checkbox[]" value="MMO"> <span class="badge">MMO</span><br/>
			<input type="checkbox" name="checkbox[]" value="Male-Protagonist"> <span class="badge">Male-Protagonist</span>
			<input type="checkbox" name="checkbox[]" value="Female-Protagonist"> <span class="badge">Female-Protagonist</span><br/>
			<input type="checkbox" ng-model="checked" ng-init="checked=false"> <span class="badge">Other...</span>
			<div ng-if="checked">
				<br/>
				<p>Add custom tags, separated by a whitespace</p>
				<input class="form-control" type="text" name="tags">
			</div>
		</div>
	</div>
		<div class="form-group">
			<br/>
			<div align="right">
				<button type="submit" class="btn btn-success">Submit</button>
			</div>
		</div>
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	{!! Form::close() !!}
	</div>
</div>


@stop