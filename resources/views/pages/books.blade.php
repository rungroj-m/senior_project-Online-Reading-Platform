@extends('app')

@section('content')
<div class="row">
	<div class="col-md-1">
	</div>
	<div class="col-md-10">
		<center>
			<table class="table" style="width:90%" align="center">
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
						<td>

<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="#">Action</a></li>
    <li><a href="#">Another action</a></li>
    <li><a href="#">Something else here</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="#">Separated link</a></li>
  </ul>
</div>
</td>
						<td>
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
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			<a href="{{ route('books.create') }}" class="btn btn-default">Create new Book</a>
		</center>
	</div>
</div>
@stop
