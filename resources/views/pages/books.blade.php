@extends('app')

@section('content')

	<center>
		<table class="table table-striped" style="width:90%" align="center">
			<thead>
			<th>Name</th>
			<th>Description</th>
			<th>User Rating</th>
			<th>Critic Rating</th>
			<th>Category</th>
			</thead>
			<tbody>
			@foreach($books as $b)
				<tr>
					<td><a href="/books/{{$b -> bookKey}}"> {{$b->name}} </a></td>
					<td>{{$b->description}}</td>
					<td>{{$b->userRating}}</td>
					<td>{{$b->criticRating}}</td>
					<td>{{$b->category}}</td>
					<td><div class="col-md-6">
							{!! Form::open([
                            'method' => 'GET',
                            'route' => ['books.edit', $b->bookKey]
                        ]) !!}
							{!! Form::submit('Edit this book?', ['class' => 'btn btn-primary']) !!}
							{!! Form::close() !!}
					</div></td>
					<td><div class="col-md-6 text-right">
						{!! Form::open([
                            'method' => 'DELETE',
                            'route' => ['books.destroy', $b->bookKey]
                        ]) !!}
						{!! Form::submit('Delete this book?', ['class' => 'btn btn-danger']) !!}
						{!! Form::close() !!}
					</div></td>
				</tr>
			@endforeach
			<img src="http://searchengineland.com/figz/wp-content/seloads/2011/11/html-5-for-seo.png">
			</tbody>
			<table>
	</center>
	<div class="col-md-6">
		<a href="{{ route('books.create') }}" class="btn btn-primary">Create new Book</a>
	</div>
@stop
