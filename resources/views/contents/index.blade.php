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
			</div><br/>
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
					</li>
					<li class="list-group-item">
						<span class="glyphicon glyphicon-fire"></span>
						Report Content
						<button type="button" class="btn btn-warning form-control" data-toggle="modal" data-target="#myModal">Report this Book</button>
						
					</li>
					<li class="list-group-item">
						<span class="glyphicon glyphicon-thumbs-up"></span>
						<a data-toggle="collapse" href="#collapseUserRating" aria-controls="collapseUserRating">
							User Rating
						</a>
						<h4>{{$book->getUserRatingAverage()}}</h4>
						<div class="collapse" id="collapseUserRating">
							<!-- RATING FORM HERE -->
							@if(!Auth::user()->isCritic() && !$book->alreadyVote())
								@if($book->isComic())
									{!! Form::open(['method' => 'POST','route' => ['comics.rating', $book->id]]) !!}
								@else
									{!! Form::open(['method' => 'POST','route' => ['books.rating', $book->id]]) !!}
								@endif
									<fieldset class="rating">
										<input type="submit" id="star5" name="rating" value="5" > <label for="star5" title="Rocks!">5 stars</label>
										<input type="submit" id="star4" name="rating" value="4" > <label for="star4" title="Pretty good">4 stars</label>
										<input type="submit" id="star3" name="rating" value="3" > <label for="star3" title="Meh">3 stars</label>
										<input type="submit" id="star2" name="rating" value="2" > <label for="star2" title="Kinda bad">2 stars</label>
										<input type="submit" id="star1" name="rating" value="1" > <label for="star1" title="Sucks big time">1 star</label>
									</fieldset>
								{!! Form::close() !!}
							@endif
						</div>
					</li>
					<li class="list-group-item">
						<span class="glyphicon glyphicon-hand-right"></span>
						<a data-toggle="collapse" href="#collapseCriticRating" aria-controls="collapseCriticRating">
							Critic Rating
						</a>
						<h4>{{$book->getCriticRatingAverage()}}</h4>
						<div class="collapse" id="collapseCriticRating">
							<!-- RATING FORM HERE -->
							@if(Auth::user()->isCritic() && !$book->alreadyVote())
								@if($book->isComic())
									{!! Form::open(['method' => 'POST','route' => ['comics.rating', $book->id]]) !!}
								@else
									{!! Form::open(['method' => 'POST','route' => ['books.rating', $book->id]]) !!}
								@endif
								<fieldset class="rating">
									<input type="submit" id="star5" name="rating" value="5" > <label for="star5" title="Rocks!">5 stars</label>
									<input type="submit" id="star4" name="rating" value="4" > <label for="star4" title="Pretty good">4 stars</label>
									<input type="submit" id="star3" name="rating" value="3" > <label for="star3" title="Meh">3 stars</label>
									<input type="submit" id="star2" name="rating" value="2" > <label for="star2" title="Kinda bad">2 stars</label>
									<input type="submit" id="star1" name="rating" value="1" > <label for="star1" title="Sucks big time">1 star</label>
								</fieldset>
								{!! Form::close() !!}
							@endif
						</div>
					</li>
					<li class="list-group-item">
						<span class="glyphicon glyphicon-eye-open"></span>
						Total Views
						<h4>{{$book->view_count}}</h4>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-md-8">
			@if($owness)
			<div class="pull-right" style="padding-top: 10px">
				@if($book->isComic())
					{!! Form::open(['method' => 'GET','route' => ['comics.{book}.content.create', $book->id]]) !!}
				@else
					{!! Form::open(['method' => 'GET','route' => ['books.{book}.content.create', $book->id]]) !!}
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
				<button type="button" class="btn btn-default form-control" data-toggle="modal" data-target="#deleteModal">Delete This Book</button>
			</div>
			@endif
			<h2 class="pull-left"><span class="first-letter">C</span>HAPTERS</h2><br/>
			<table class="table table-bordered" style="width:100%">
				<tbody>
					@foreach($contents as $c)
						@if(!$c->private || $book->isOwner() || Auth::user()->isAdmin())
							<tr>
								<td><h4>{{$c->chapter}}</h4></td>
								@if($book->isComic())
									<td><h4><a href="/comics/{{$book->id}}/content/{{$c->chapter}}">{{$c->name}}</a></h4>
								@else
									<td><h4><a href="/books/{{$book->id}}/content/{{$c->chapter}}">{{$c->name}}</a></h4>
								@endif
								Last Updated: {{$c->updated_at}}</td>
							</tr>
						@endif
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-4">
			@if($book->donations->count())
				<button class="pull-right btn btn-success" data-toggle="modal" data-target="#pleadModal" style="padding-top: 10px">Plead</button>
			@endif
			<h3><span class="first-letter">D</span>ONATIONS</h3>
			@foreach($book->donations as $d)
				@if($d->active == 1)
					<div class="thumbnail">
						<h3>{{$d->description}}</h3>
						<h4 align="right">Open for Pleading!</h4>
						<h4 align="right">Goals: {{$d->goal_amount}} THB</h4>
					</div>
				@endif
			@endforeach
		</div>
	</div><hr/>
	<div class="row">
		<div class="col-md-8">
			<div class="pull-right" style="padding-top: 10px">
				@if(Auth::user()->isCritic())
					<button class="btn btn-success glyphicon glyphicon-plus" data-toggle="collapse" href="#collapseReview" aria-controls="collapseReview"></button>
				@endif
			</div>
			<h3><span class="first-letter">R</span>EVIEWS</h3><br/>
			@if(Auth::user()->isCritic())
				<div class="collapse" id="collapseReview">
					<div class="thumbnail">
						<form method="POST" action="/books/{{$book->id}}/content/review/">
							<textarea class="form-control" type="text" name="review" ng-model="review"></textarea><br/>
							<button type="submit" class="btn btn-success">Add Review</button>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						</form>
					</div>
				</div>
			@endif

			@foreach($book->reviews as $review)
				@include('reviews.show', ['r' => $review,'book' => $book])
			@endforeach
		</div>
	</div><hr/>
	<div class="row">
		<div class="col-md-8">
			<div class="pull-right" style="padding-top: 10px">
				<button class="btn btn-success glyphicon glyphicon-plus" data-toggle="collapse" href="#collapseComment" aria-controls="collapseComment"></button>
			</div>
			<h3><span class="first-letter">C</span>OMMENTS</h3><br/>
			<div class="collapse" id="collapseComment">
				<div class="thumbnail">
					<div class="caption">
						<form method="POST" action="/books/{{$book->id}}/content/comment">
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

<!-- MODAL -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Submit Report</h4>
			</div>
			{!! Form::open(['method' => 'POST','route' => ['report', $book->id]]) !!}
			<div class="modal-body">
				<select name="report" class="form-control">
					<option value="1">Inappropriate content</option>
					<option value="2">Piracy content</option>
				</select>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default inline" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success inline">Submit</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

@stop

<!-- MODAL -->
<div id="deleteModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Delete Book</h4>
			</div>
			{!! Form::open(['method' => 'DELETE','route' => ['comics.destroy', $book->id]]) !!}
			<div class="modal-body">
				<p>Delete this book?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default inline" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success inline">Submit</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

<div id="pleadModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Donation Pleading</h4>
			</div>
			<form class="form-horizontal" role="form" method="POST" action="{{ url('donation/plead/create') }}">
				<div class="modal-body">
					<h4>Select Donation:</h4>
					@foreach ($book->donations as $donation)
						@if($donation->active == 1)
                  			<input type="radio" name="donation" value="{{ $donation->id }}"> {{ $donation->description }}<br/>
                  		@endif
                	@endforeach
                	<br/>
                	<h4>Amount: </h4>
                	<p>How much are you pleading for this donation.</p>
                	<input type="text" class="form-control" name="amount" value="{{ old('amount') }}">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default inline" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success inline">Submit</button>
				</div>
				<input type="hidden" name="pleader" value="{{ Auth::user()->id }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
		</div>
	</div>
</div>
