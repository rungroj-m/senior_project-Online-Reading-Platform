@extends('app')

@section('content')
<div class="main-container">
	<div class="header">
		@if(Request::path() == 'books')
			<h1 class="inline"><span class="first-letter">N</span>OVEL</h1>
		@elseif(Request::path() == 'comics')
			<h1 class="inline"><span class="first-letter">C</span>OMIC</h1>
		@endif

		@if(Request::path() == 'comics' && !Auth::user()->isComicCreator())
			<div class="pull-right">
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Request for create comic</button>
			</div>
		@endif

		<!-- <form class="navbar-form navbar-left" role="search" method="GET" action="/books/search">
			<div class="input-group inline">
				<input type="text" class="form-control" name="request" placeholder="Search">
				<div class="input-group-btn">
					<button class="btn btn-success form-control">Go</button>
				</div>
			</div>
		</form> -->
	</div>
	@if(Request::path() == 'books/search')
		<div>
			<div class="form-group">
				<label class="h4 inline">Show Novels 
					<input align="middle" type="checkbox" ng-model="novel" ng-init="novel=true"/>
				</label>
			</div>
			<div class="form-group">
				<label class="h4 inline">Show Comics 
					<input type="checkbox" ng-model="comic" ng-init="comic=true"/>
				</label>
			</div>
		</div>
	@endif
	<hr/>
	<div>
		@for($i = 0; $i < count($books); $i++)
			<?php $b = $books[$i] ?>
			@if($b->isComic() && Request::path() == 'books/search')
				<div class="thumbnail col-md-3 book-thumbnail content" ng-show="comic">
			@elseif(Request::path() == 'books/search')
				<div class="thumbnail col-md-3 book-thumbnail content" ng-show="novel">
			@else
				<div class="thumbnail col-md-3 book-thumbnail content">
			@endif
				@if($b->isComic())
					<a href="/comics/{{$b->id}}/content"><h4>{{str_limit($b->name, $limit = 20, $end = '...')}}</h4>
				@else
					<a href="/books/{{$b->id}}/content"><h4>{{str_limit($b->name, $limit = 20, $end = '...')}}</h4>
				@endif
				@if($b->image == null)
					<div class="img-thumbnail cover-image-thumbnail">
						<h1>NO IMAGE FOR THIS BOOK</h1>
					</div>
				@else
					<img class="img-thumbnail cover-image-thumbnail" src="/images/{{$b->image}}">
				@endif
				</a>
				<div class="word-wrap"><span class="glyphicon glyphicon-user"></span> {{$b->user->username}}</div>
				@foreach($b->tags as $t)
					<span class="badge"> {{$t->tag}}</span>
				@endforeach
			</div>
		@endfor
	</div>
</div>
@stop

		<!-- MODAL -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Request to create comic</h4>
			</div>
			<div class="modal-body">
				{!! Form::label('Request to create comic') !!}
			</div>
			{!! Form::open(['method' => 'POST','route' => ['requestcomic']]) !!}
			<div class="modal-footer">
				<button type="button" class="btn btn-default inline" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success inline">Submit</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>