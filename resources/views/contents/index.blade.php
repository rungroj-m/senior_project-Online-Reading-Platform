@extends('app')

@section('content')
<div>
	<div class="col-md-10 col-md-offset-1">
		<div class="col-md-3">
			<br/>
			<div class="thumbnail content">
				{{--<img src="asd.jpeg" style="height: 300px; width: 100%">--}}
				<img src="/images/{{$book->image}}" style="height: 300px; width: 100%">
				<h1>SAMPLE PICTURE</h1>
			</div>
		</div>
		<div class="col-md-6">
			<div class="word-wrap"><h1>{{$book->name}}</h1></div>
			<span class="glyphicon glyphicon-list"></span> <a href="/user/{{$book->user->id}}">{{$book->user->username}} </a><span class="glyphicon glyphicon-time"></span> {{$book->created_at}}</p>
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
						@if($subscribe)
							{!! Form::open([
								'method' => 'GET',
								'route' => ['unsubscribe', $book->id]
							]) !!}
							{!! Form::submit('Unsubscribe', ['class' => 'btn btn-warning form-control']) !!}
							{!! Form::close() !!}
						@else
							{!! Form::open([
								'method' => 'GET',
								'route' => ['subscribe', $book->id]
							]) !!}
							{!! Form::submit('Subscribe', ['class' => 'btn btn-success form-control']) !!}
							{!! Form::close() !!}
						@endif
							{!! Form::open([
	                            'method' => 'GET',
	                            'route' => ['report', $book->id]
	                        ]) !!}

							{!! Form::submit('report', ['class' => 'btn btn-warning form-control']) !!}
							{!! Form::close() !!}

					</li>
					<li class="list-group-item">
						<div data-toggle="collapse" href="#collapseTags" aria-controls="collapseTags">
							<span class="glyphicon glyphicon-list"></span> Tags <span class="badge">{{$book->tags->count()}}</span>
						</div>
						<div class="collapse" id="collapseTags">
							@foreach($book->tags as $tag)
								<span class="badge">{{$tag->tag}}</span>
							@endforeach
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
				{{--@foreach($book->comments as $c)--}}
					{{--<div class="thumbnail">--}}
						{{--<div class="caption">--}}
							{{--<p>{{$c->comment}}</p>--}}
							{{--<div style="text-align: right">--}}
								{{--<p>- {{$c->user->username}} |--}}
									{{--{{$c->rating}}--}}
									{{--<a href="/books/{{$id}}/content/comment/{{$c->id}}/up" class="first-letter" href="">+</a>--}}
									{{--<a href="/books/{{$id}}/content/comment/{{$c->id}}/down" class="first-letter">-</a>--}}
									{{--<a href="/books/{{$id}}/content/comment/{{$c->id}}/report" class="first-letter">report</a>--}}
									{{--<form method="POST" action="/books/{{$id}}/content/comment/{{$c->id}}">--}}
										{{--<input class="form-control" type="text" name="comment" ng-model="comment"><br/>--}}
										{{--<button type="submit" class="btn btn-success form-control">Add Comment</button>--}}
										{{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
									{{--</form>--}}
								{{--</p>--}}
							{{--</div>--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--@endforeach--}}

			@foreach($book->comments as $comment)
					@if(!$comment->parent)
						@include('comments.show', ['c' => $comment])
					@endif

				@endforeach


			</div>
		</div>
	</div>
</div>

@if(Auth::user()->isCritic())
	<form method="POST" action="/books/{{$id}}/content/review/">
		<input class="form-control" type="text" name="review" ng-model="review"><br/>
		<button type="submit" class="btn btn-success form-control">Add Review</button>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
@endif

@foreach($book->reviews as $review)
	<p>{{$review->review}}</p>
	<div style="text-align: right">
		<p>- {{$review->user->username}} |
			{{$review->rating}}
			<a href="/books/{{$id}}/content/review/{{$review->id}}/up" class="first-letter" href="">+</a>
			<a href="/books/{{$id}}/content/review/{{$review->id}}/down" class="first-letter">-</a>
		</p>
	</div>
@endforeach
@stop
