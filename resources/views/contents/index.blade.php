@extends('app')

@section('content')
<body>
	<div class="col-md-10 col-md-offset-1">
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
						<span class="glyphicon glyphicon-cloud"></span>
						Subscription
						{!! Form::open([
							'method' => 'GET',
							'route' => ['subscribe', $book->id]
						]) !!}
						{!! Form::submit('Subscribe', ['class' => 'btn btn-success form-control']) !!}
						{!! Form::close() !!}
						{!! Form::open([
							'method' => 'GET',
							'route' => ['unsubscribe', $book->id]
						]) !!}
						{!! Form::submit('Unsubscribe', ['class' => 'btn btn-warning form-control']) !!}
						{!! Form::close() !!}
					</li>
					<li class="list-group-item">
						<div data-toggle="collapse" href="#collapseTags" aria-controls="collapseTags">
							<span class="glyphicon glyphicon-list"></span> Tags <span class="glyphicon glyphicon-arrow-down"></span>
						</div>
						<div class="collapse" id="collapseTags">
							<h5><span class="badge">Sci-Fi</span></h5>
							<h5><span class="badge">Drama</span></h5>
							<h5><span class="badge">Light Novel</span></h5>
							<h5><span class="badge">Fantasy</span></h5>
							<h5><span class="badge">Comedy</span></h5>
							<h5><span class="badge">MMORPG</span></h5>
						</div>
					</li>
					<li class="list-group-item">
						<span class="glyphicon glyphicon-thumbs-up"></span>
						<span data-toggle="collapse" href="#collapseUserRating" aria-controls="collapseUserRating"> 
							User Rating
							<div>
								<h2>{{$book->userRating}}</h2>
							</div>
						</span>
						<div class="collapse" id="collapseUserRating">
							RATING FORM HERE
							<!-- RATING FORM HERE -->
						</div>
					</li>
					<li class="list-group-item">
						<span class="glyphicon glyphicon-hand-right"></span>
						<span data-toggle="collapse" href="#collapseCriticRating" aria-controls="collapseCriticRating">
							Critic Rating
							<h2>{{$book->criticRating}}</h2>
						</span>
						<div class="collapse" id="collapseCriticRating">
							RATING FORM ALSO HERE
							<!-- RATING FORM HERE -->
						</div>
					</li>
					<li class="list-group-item">
						<span class="glyphicon glyphicon-eye-open"></span> 
						Total Views
						<h3>1500</h3>
						{{$book->updated_at}}
					</li>
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
				<div class="pull-right" style="padding-top: 10px">
					<button class="btn btn-default glyphicon glyphicon-plus" data-toggle="collapse" href="#collapseComment" aria-controls="collapseComment"></button>
				</div>
				<h3><span class="first-letter">C</span>OMMENTS</h3><br/>
				<div class="collapse" id="collapseComment">
					<div class="thumbnail">
						<div class="caption">
							<form method="POST" action="/books/{{$id}}/content/comment">
								<input class="form-control" type="text" name="comment" ng-model="comment"><br/>
								<button type="submit" class="btn btn-success form-control">Add Comment</button>
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
							</form>
						</div>
					</div>
				</div>
				@foreach($book->comments as $c)
					<div class="thumbnail">
						<div class="caption">
							<p>{{$c->comment}}</p>
							<div style="text-align: right">
								<p>- {{$c->user->username}} | 
									{{$c->rating}}
									<a href="#" class="first-letter" href="">+</a>
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
