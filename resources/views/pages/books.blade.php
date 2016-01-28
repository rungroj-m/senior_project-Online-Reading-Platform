@extends('app')

@section('content')
<div class="row">
	<div class="col-md-2">
	</div>
	<div class="col-md-8">
		<h1>Creator's Hub</h1>
		<h5>Find readable stuff here.</h5>
		<hr>
		<center>
			<table class="table" style="width:100%" align="center">
				<thead>
				<th>Title</th>
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
						<!-- <td>
							<div class="col-md-6">
								{!! Form::open([
									'method' => 'GET',
									'route' => ['books.edit', $b->bookKey]
								]) !!}
								{!! Form::submit('Edit', ['class' => 'btn btn-default']) !!}
								{!! Form::close() !!}
							</div>
						</td>
						<td>
							<div class="col-md-6 text-right">
								{!! Form::open([
									'method' => 'DELETE',
									'route' => ['books.destroy', $b->bookKey]
								]) !!}
								{!! Form::submit('Delete', ['class' => 'btn btn-default']) !!}
								{!! Form::close() !!}
							</div>
						</td> -->
					</tr>
				@endforeach
				</tbody>
			</table>
			<a href="{{ route('books.create') }}" class="btn btn-default">New Book</a>
		</center>
	</div>
</div>
@stop
