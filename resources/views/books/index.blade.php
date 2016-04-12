@extends('app')

@section('content')
<div class="main-container">
	<div class="header">
		@if(Request::path() == 'books')
			<h1 class="inline"><span class="first-letter">N</span>OVEL</h1>
		@elseif(Request::path() == 'comics')
			<h1 class="inline"><span class="first-letter">C</span>OMIC</h1>
		@endif
		<!-- <form class="navbar-form navbar-left" role="search" method="GET" action="/books/search">
			<div class="input-group inline">
				<input type="text" class="form-control" name="request" placeholder="Search">
				<div class="input-group-btn">
					<button class="btn btn-success form-control">Go</button>
				</div>
			</div>
		</form> -->
	</div><hr/>
	<div>
		@for($i = 0; $i < count($books); $i++)
			<?php $b = $books[$i] ?>
			<div class="thumbnail col-md-3 book-thumbnail content">
				@if($b->isComic())
					<a href="/comics/{{$b->id}}/content"><h4>{{str_limit($b->name, $limit = 20, $end = '...')}}</h4></a>
				@else
					<a href="/books/{{$b->id}}/content"><h4>{{str_limit($b->name, $limit = 20, $end = '...')}}</h4></a>
				@endif

				@if($b->image == null)
					<div class="img-thumbnail cover-image-thumbnail">
						<h1>NO IMAGE FOR THIS BOOK</h1>
					</div>
				@else
					<img class="img-thumbnail cover-image-thumbnail" src="/images/{{$b->image}}">
				@endif

				<div class="word-wrap"><span class="glyphicon glyphicon-user"></span> {{$b->user->username}}</div>
				@foreach($b->tags as $t)
					<span class="badge"> {{$t->tag}}</span>
				@endforeach
			</div>
		@endfor
	</div>
</div>
@stop
