@extends('app')

@section('content')
<body>
	<div class="col-md-10 col-md-offset-1">
	<div class="pull-right">
		{!! Form::open([
			'method' => 'GET',
			'route' => ['books.edit', $book->id]
		]) !!}
		{!! Form::submit('Edit This Book', ['class' => 'btn btn-default']) !!}
		{!! Form::close() !!}
		{!! Form::open([
			'method' => 'DELETE',
			'route' => ['books.destroy', $book->id]
		]) !!}
		{!! Form::submit('Delete This Book', ['class' => 'btn btn-default']) !!}
		{!! Form::close() !!}
		{!! Form::open([
			'method' => 'GET',
			'route' => ['subscribe', $book->id]
		]) !!}
		{!! Form::submit('Subscribe', ['class' => 'btn btn-default']) !!}
		{!! Form::close() !!}
		{!! Form::open([
			'method' => 'GET',
			'route' => ['unsubscribe', $book->id]
		]) !!}
		{!! Form::submit('Unsubscribe', ['class' => 'btn btn-default']) !!}
		{!! Form::close() !!}
		{{--<a href="{{ route('books.create') }}" class="btn btn-primary">Create new Book</a>--}}
	</div>
		<div class="col-md-3">
			<br/>
			<div class="thumbnail content">
				<h1>SAMPLE PICTURE</h1>
				<h3>THIS IS MAGIC</h3>
				<h1>IT WILL ALSO BE A PICTURE OF THE BOOK</h1>
				<h5>WITH AUTHOR NAME</h5>
			</div>
		</div>
		<div class="col-md-6">
			<h1>{{$book->name}}</h1>
			<br/>
			{!! $book->description !!}
		</div>
		<div class="col-md-1">
		</div>
	</div>
	<div class="col-md-10 col-md-offset-1 content-table">
		<div>
			<div class="col-md-8">
				<div class="pull-right" style="padding-top: 10px">
					{!! Form::open(['method' => 'GET','route' => ['books.{book}.content.create', $id]]) !!}
					{!! Form::submit('New Chapter', ['class' => 'btn btn-success']) !!}
					{!! Form::close() !!}
				</div>
				<h2 class="pull-left"><span class="first-letter">C</span>HAPTERS</h2><br/>
				<table class="table" style="width:100%">
					<tbody>
						@foreach($contents as $c)
							<tr>
								<td><h5>{{$c->chapter}}</h5></td>
								<td><h4><a href="/books/{{$id}}/content/{{$c->chapter}}">{{$c->name}}</a></h4>
								Last Updated: {{$c->updated_at}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<h3><span class="first-letter">C</span>OMMENTS</h3><br/>
				<div class="thumbnail">
					<div class="caption">
						<p>This is kinda cool, and also really good</p>
						<div style="text-align: right">
							<p>- Guest A</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
@stop
