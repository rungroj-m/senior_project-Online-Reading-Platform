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
				</tr>
			@endforeach
			</tbody>
			<table>
	</center>
@stop
