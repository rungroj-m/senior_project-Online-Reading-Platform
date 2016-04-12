@extends('app')

@section('content')
<div class="main-container">
	<div class="row">
		<div class="header">
			<div class="pull-right">
				<a href="{{ route('books.create') }}" class="btn btn-info">Learn More</a>
				<a href="{{ route('books.create') }}" class="btn btn-success">Create Now</a>
			</div>
			<div>
				<h1 class="inline"><span class="first-letter">C</span>REATORS</h1>
				<h4 class="inline">feed</h4>
			</div>
		</div><br/>
		<div class="col-md-12">
			<div class="header">
				<h3><span class="first-letter">E</span>DITOR'S CHOICE</h3>
			</div>
			<div class="row">
				@for($i = 0; $i < $books->count(); $i++)
					<?php $b = $books[$i] ?>
					<div class="thumbnail col-md-3 book-thumbnail content">
						@if($b->isComic())
							<a href="/comics/{{$b->id}}/content"><h4>{{str_limit($b->name, $limit = 100, $end = '...')}}</h4>
						@else
							<a href="/books/{{$b->id}}/content"><h4>{{str_limit($b->name, $limit = 100, $end = '...')}}</h4>
						@endif

						@if($b->image == null)
							<div class="img-thumbnail cover-image-thumbnail">
								<h1>NO IMAGE</h1>
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
		<div class="col-md-6">
			<div class="header">
				<h3><span class="first-letter">R</span>ECENT</h3><br/>
			</div>
			<table class="table" align="center">
				<tbody>
					@foreach($books as $b)
						<tr>
							@if($b->isComic())
								<td><h5><a href="/comics/{{$b -> id}}"> {{str_limit($b->name, $limit = 100, $end = '...')}} </a></h5>
							@else($b->category == 'Comic')
								<td><h5><a href="/books/{{$b -> id}}"> {{str_limit($b->name, $limit = 100, $end = '...')}} </a></h5>
							@endif
							Last updated: {{$b->updated_at}}
							in {{$b->category}}</td>
							<td><p>+ {{$b->userRating}}</p><p>+ {{$b->criticRating}}</p></td>
							<td><p><span class="glyphicon glyphicon-user"></span> {{$b->user->username}}</p></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-6">
			<div class="header">
					<h3><span class="first-letter">E</span>XPLORE</h3>
			</div><br/>
			<div class="row">

			</div>
		</div>
	</div>
</div>
@stop
