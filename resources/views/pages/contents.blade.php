@extends('app')

				@section('content')

					<table class="table table-striped" style="width:90%" align="center">
						<thead>
						<th>Name</th>
						<th>chapter</th>
						<th>content</th>
						</thead>
						<tbody>
						@foreach($contents as $c)
							<tr>
								<td><a href="/books/{{$id}}/content/{{$c->chapter}}"> {{$c->name}} </a></td>
								<td>{{$c->chapter}}</td>
								<td>{{$c->content}}</td>
								<td><div class="col-md-6">
										{!! Form::open([
                                        'method' => 'GET',
                                        'route' => ['books.{book}.content.edit',$id,$c->chapter]
                                    ]) !!}
										{!! Form::submit('Edit this book?', ['class' => 'btn btn-primary']) !!}
										{!! Form::close() !!}
										{{--<a href="{{ route('books.content.edit',['id' => $id,'chapter' => $c->chapter]) }}" class="btn btn-primary">Edit Content</a>--}}
									</div></td>
								{{--<td><div class="col-md-6">--}}
								{{--<a href="{{ route('books.content.delete',['id' => $id,'chapter' => $c->chapter]) }}" class="btn btn-danger">Delete Content</a>--}}
								{{--</div></td>--}}

								<td><div class="col-md-6 text-right">
										{!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['books.{book}.content.destroy', $id,$c->chapter]
                                        ]) !!}
										{!! Form::submit('Delete this Book?', ['class' => 'btn btn-danger']) !!}
										{!! Form::close() !!}
									</div></td>
							</tr>
						@endforeach
						</tbody>
						</table>
		<div class="col-md-6">
			{!! Form::open(['method' => 'GET','route' => ['books.{book}.content.create', $id]]) !!}
			{!! Form::submit('Create New Content', ['class' => 'btn btn-primary']) !!}
			{!! Form::close() !!}
		{{--<a href="{{ route('books.create') }}" class="btn btn-primary">Create new Book</a>--}}
		</div>
@stop
