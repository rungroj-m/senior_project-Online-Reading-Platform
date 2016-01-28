@extends('app')

@section('content')

<div  class="container content-bg">
	<div class="row">
		<div class="col-md-2">
		</div>

		<div class="col-md-8 content-body">
			<h1 align="center">{{ $book-> name }}</h1><br/>
			<h3>Chapter {{ $content_chap->chapter }}</h3><br/>
			<h4>{{ $content_chap->name }}</h1>
			<hr>
			<p class="content-text">{{ $content_chap->content }}</p>
		</div>

		<div class="col-md-2">
			<div class="btn-group-vertical" align="center">
				{!! Form::open([
					'method' => 'GET',
					'route' => ['books.{book}.content.edit',$id,$content_chap->chapter]
				]) !!}
				{!! Form::submit('Edit', ['class' => 'btn btn-default']) !!}
				{!! Form::close() !!}
				{!! Form::open([
					'method' => 'DELETE',
					'route' => ['books.{book}.content.destroy', $id, $content_chap->chapter]
				]) !!}
				{!! Form::submit('Delete', ['class' => 'btn btn-default']) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@stop