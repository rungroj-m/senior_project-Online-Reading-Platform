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
				<img src="asd.jpeg" style="height: 300px; width: 100%">
				<h1>SAMPLE PICTURE</h1>
			</div>
		</div>
		<div class="col-md-6">
			<h1>{{$book->name}}</h1>
			<span class="glyphicon glyphicon-list"></span> <a href="/profile/{{$book->user->id}}">{{$book->user->username}} </a><span class="glyphicon glyphicon-time"></span> {{$book->created_at}}</p>
			<hr/>
			{!! $book->description !!}
			<br/>
		</div>
		<div class="col-md-3">
			<div>
				<ul style="width: 100%">
					<li class="list-group-item">
						<div>
							<span class="glyphicon glyphicon-list"></span> Tags
						</div>
						<div>
							<span class="label label-success">Sci-Fi</span></h5>
							<span class="label label-success">Drama</span></h5>
							<span class="label label-success">Light Novel</span>
							<span class="label label-success">Fantasy</span>
							<span class="label label-success">Comedy</span>
							<span class="label label-success">MMORPG</span>
						</div>
					</li>
					<li class="list-group-item"><span class="glyphicon glyphicon-thumbs-up"></span><a data-toggle="collapse" href="#collapseUserRating" aria-controls="collapseUserRating"> User Rating</a></li>
					<div class="collapse" id="collapseUserRating">
						<div class="well">
							TEST
						</div>
					</div>
					<li class="list-group-item"><span class="glyphicon glyphicon-thumbs-up" style="color: green"></span> Critic Rating</li>
					<li class="list-group-item">Total Views</li>
				</ul>
			</div>
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
				<div class="pull-right" style="padding-top: 10px">
					{!! Form::open([
						'method' => 'GET',
						'route' => ['books.edit', $book->id]
					]) !!}
					{!! Form::submit('Edit This Book', ['class' => 'btn btn-default']) !!}
					{!! Form::close() !!}
				</div>
				<div class="pull-right" style="padding-top: 10px">
					{!! Form::open([
						'method' => 'DELETE',
						'route' => ['books.destroy', $book->id]
					]) !!}
					{!! Form::submit('Delete This Book', ['class' => 'btn btn-default']) !!}
					{!! Form::close() !!}
					{{--<a href="{{ route('books.create') }}" class="btn btn-primary">Create new Book</a>--}}
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
				@foreach($book->comments as $c)
					<div class="thumbnail">
						<div class="caption">
							<p>{{$c->comment}}</p>
							<div style="text-align: right">
								<p>- {{$c->user->username}} | 
									{{$c->rating}}
									<a href="#" class="first-letter">+</a>
									<a href="#" class="first-letter">-</a>
								</p>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</body>
@stop
