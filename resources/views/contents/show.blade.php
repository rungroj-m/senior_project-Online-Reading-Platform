@extends('app')

@section('content')


<div>
	<div class="col-md-8 col-md-offset-2 content-body">
		<h1 align="center">{{ $book-> name }}</h1><br/>
		<h3 align="center">Chapter {{ $content_chap->chapter }}</h3><br/>
		<h4 align="center">{{ $content_chap->name }}</h1>
		<hr>

			@if($book->isComic())
				<p class="content-text">
					<?php $i = 1 ?>
					@foreach($content_images as $content)
						<img src="/images/{{$content}}" style="height: 300px; width: 100%">
						{{$i}}<?php $i++ ?>
					@endforeach
				</p>
			@else
				<p class="content-text">{!! $content_chap->content !!}</p>
			@endif

	</div>

	<div class="col-md-2">
		<div class="btn-group-vertical">
			{!! Form::open([
				'method' => 'GET',
				'route' => ['books.{book}.content.edit',$id,$content_chap->chapter]
			]) !!}
			{!! Form::submit('Edit Chapter', ['class' => 'btn btn-default']) !!}
			{!! Form::close() !!}
			{!! Form::open([
				'method' => 'DELETE',
				'route' => ['books.{book}.content.destroy', $id, $content_chap->chapter]
			]) !!}
			{!! Form::submit('Delete Chapter', ['class' => 'btn btn-default']) !!}
			{!! Form::close() !!}
		</div>
	</div>
</div>


@stop