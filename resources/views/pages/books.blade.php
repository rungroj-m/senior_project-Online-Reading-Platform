@extends('app')

@section('content')

	<center>
		<table class="table table-striped" style="width:90%" align="center">
			<thead>
			<th>Name</th>
			<th>Description</th>
			<th>Category</th>
			</thead>
			<tbody>
			@foreach($books as $b)
				<tr>
					<td><a href="/books/{{$b -> bookKey}}"> {{$b->name}} </a></td>
					<td>
						{{ str_limit($b->description, $limit = 60, $end = '...') }}
					</td>
					<td>{{$b->category}}</td>
					<td><div class="col-md-6">
							{!! Form::open([
                            'method' => 'GET',
                            'route' => ['books.edit', $b->bookKey]
                        ]) !!}
							{!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
							{!! Form::close() !!}
					</div></td>
					<td><div class="col-md-6 text-right">
						{!! Form::open([
                            'method' => 'DELETE',
                            'route' => ['books.destroy', $b->bookKey]
                        ]) !!}
						{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
						{!! Form::close() !!}
					</div></td>
				</tr>
			@endforeach
			</tbody>
			<table>
	</center>
	<div class="col-md-4">
		<a href="{{ route('books.create') }}" class="btn btn-primary">Create new Book</a>
	</div>
	
@stop
