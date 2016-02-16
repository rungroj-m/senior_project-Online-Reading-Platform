@extends('app')

@section('content')
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div>
				<h1 align="center">{{$book->name}}</h1>
				<hr>
				<p class="content-text">{{$book->description}}</p>
				<hr>
			</div>

			<!-- <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingOne">
						<h4 class="panel-title">
							<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								Chapter 0
							</a>
						</h4>
					</div>
				</div>
			</div> -->
			<!-- <div class="btn-group">
				<button class="btn btn-default">Test1</button>
				<button class="btn btn-default">Test2</button>
			</div> -->
			<div align="right">
				{!! Form::open([
					'method' => 'GET',
					'route' => ['books.edit', $book->bookKey]
				]) !!}
				{!! Form::submit('Edit This Book', ['class' => 'btn btn-default']) !!}
				{!! Form::close() !!}
				{!! Form::open([
					'method' => 'DELETE',
					'route' => ['books.destroy', $book->bookKey]
				]) !!}
				{!! Form::submit('Delete This Book', ['class' => 'btn btn-default']) !!}
				{!! Form::close() !!}
			</div>
			<table class="table table" style="width:100%" align="center">
				<tbody>
					@foreach($contents as $c)
						<tr>
							<td>Chapter {{$c->chapter}}</td>
							<td><a href="/books/{{$id}}/content/{{$c->chapter}}"> {{$c->name}} </a></td>
							<td><div class="col-md-6">
							</div></td>
							<td><div class="col-md-6 text-right">
								
							</div></td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div>
				{!! Form::open(['method' => 'GET','route' => ['books.{book}.content.create', $id]]) !!}
				{!! Form::submit('New Chapter', ['class' => 'btn btn-default']) !!}
				{!! Form::close() !!}
				{{--<a href="{{ route('books.create') }}" class="btn btn-primary">Create new Book</a>--}}
			</div>
		</div>
	</div>
@stop
