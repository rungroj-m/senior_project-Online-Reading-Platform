@extends('app')

@section('content')
<div class="main-container">
	<div class="row">
		<div class="col-md-3">
			<br/>
			<div class="thumbnail content">
				@if($book->image == null)
					<div class="cover-image">
						<h1 class="word-wrap">NO IMAGE FOR THIS BOOK</h1>
					</div>
				@else
					<img class="cover-image" src="/images/{{$book->image}}">
				@endif
				<br/>
				<div>
					<span class="glyphicon glyphicon-list"></span> Tags <span class="badge">{{$book->tags->count()}}</span>
				</div>
				<div>
					@foreach($book->tags as $tag)
						<span class="badge">{{$tag->tag}}</span>
					@endforeach
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="word-wrap"><h1>{{$book->name}}</h1></div>
			<span class="glyphicon glyphicon-list"></span> <a href="/user/{{$book->user->id}}">{{$book->user->username}} </a><span class="glyphicon glyphicon-time"></span> {{$book->created_at}}</p>
			<hr/>
			<p>{!! $book->description !!}</p>
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
	                    <button type="button" class="btn btn-warning form-control" data-toggle="modal" data-target="#myModal">Report</button>
						<!-- {!! Form::submit('Report', ['class' => 'btn btn-warning form-control']) !!}
						{!! Form::close() !!} -->
					</li>
					<li class="list-group-item">
						<span class="glyphicon glyphicon-thumbs-up"></span>
						<span data-toggle="collapse" href="#collapseUserRating" aria-controls="collapseUserRating">
							User Rating
							<div>
								<h4>{{$book->userRating}}</h4>
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
							<h4>{{$book->criticRating}}</h4>
						</span>
						<div class="collapse" id="collapseCriticRating">
							RATING FORM ALSO HERE
							<!-- RATING FORM HERE -->
						</div>
					</li>
					<li class="list-group-item">
						<span class="glyphicon glyphicon-eye-open"></span>
						Total Views
						<h4>1500</h4>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="row">
		<div>
			<div class="col-md-8">
				@if($owness)
				<div class="pull-right" style="padding-top: 10px">
					@if($book->isComic())
						{!! Form::open(['method' => 'GET','route' => ['comics.{book}.content.create', $id]]) !!}
					@else
						{!! Form::open(['method' => 'GET','route' => ['books.{book}.content.create', $id]]) !!}
					@endif
					{!! Form::submit('New Chapter', ['class' => 'btn btn-success']) !!}
					{!! Form::close() !!}
				</div>
				<div class="pull-right" style="padding-top: 10px">
					@if($book->isComic())
						{!! Form::open(['method' => 'GET','route' => ['comics.edit', $book->id]]) !!}
					@else
						{!! Form::open(['method' => 'GET','route' => ['books.edit', $book->id]]) !!}
					@endif
					{!! Form::submit('Edit This Book', ['class' => 'btn btn-default']) !!}
					{!! Form::close() !!}
				</div>
				<div class="pull-right" style="padding-top: 10px">
					@if($book->isComic())
						{!! Form::open(['method' => 'DELETE','route' => ['comics.destroy', $book->id]]) !!}
					@else
						{!! Form::open(['method' => 'DELETE','route' => ['books.destroy', $book->id]]) !!}
					@endif
					{!! Form::submit('Delete This Book', ['class' => 'btn btn-default']) !!}
					{!! Form::close() !!}
					{{--<a href="{{ route('books.create') }}" class="btn btn-primary">Create new Book</a>--}}
				</div>
				@endif
				<h2 class="pull-left"><span class="first-letter">C</span>HAPTERS</h2><br/>
				<table class="table" style="width:100%">
					<tbody>
						@foreach($contents as $c)
							<tr>
								<td><h5>{{$c->chapter}}</h5></td>
								@if($book->isComic())
									<td><h4><a href="/comics/{{$id}}/content/{{$c->chapter}}">{{$c->name}}</a></h4>
								@else
									<td><h4><a href="/books/{{$id}}/content/{{$c->chapter}}">{{$c->name}}</a></h4>
								@endif
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
								<button type="submit" class="btn btn-success">Add Comment</button>
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
							</form>
						</div>
					</div>
				</div>
			@foreach($book->comments as $comment)
					@if(!$comment->parent)
						@include('comments.show', ['c' => $comment,'book' => $book])
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

<!-- MODAL -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Submit Report</h4>
			</div>
			<div class="modal-body">
				<p>Briefly explain why this content should be flagged</p>
				<input type="textarea" class="form-control">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default inline" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success inline">Submit</button>
			</div>
		</div>
	</div>
</div>