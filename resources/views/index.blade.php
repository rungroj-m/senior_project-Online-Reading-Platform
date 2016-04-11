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
		</div>
		<div class="col-md-12">
			<div class="row">
				@for($i = 0; $i < 4; $i++)
					<?php $b = $books[$i] ?>
					<div class="thumbnail col-md-3" style="max-height: 480px; min-height: 150px; max-width: 220px; min-width: 110px; margin: 15px">
						@if($b->isComic())
							<a href="/comics/{{$b->id}}/content"><h4>{{$b->name}}</h4></a>
						@else
							<a href="/books/{{$b->id}}/content"><h4>{{$b->name}}</h4></a>
						@endif

						@if($b->image == null)
							<div class="thumbnail cover-image-thumbnail content">
								<h5>NO IMAGE</h5>
							</div>
						@else
							<img class="thumbnail cover-image-thumbnail content" src="/images/{{$b->image}}">
						@endif

						<div class="word-wrap"><span class="glyphicon glyphicon-user"></span> {{$b->user->username}}</div>
						@foreach($b->tags as $t)
							<span class="badge"> {{$t->tag}}</span>
						@endforeach
					</div>
				@endfor
			</div>
		</div>
		<div class="col-md-5">
			<div class="header">
				<h3><span class="first-letter">R</span>ECENT</h3><br/>
			</div>
			<table class="table" align="center">
				<tbody>
					@foreach($books as $b)
						<tr>
							@if($b->isComic())
								<td><h4><a href="/comics/{{$b -> id}}"> {{str_limit($b->name, $limit = 100, $end = '...')}} </a></h4>
							@else($b->category == 'Comic')
								<td><h4><a href="/books/{{$b -> id}}"> {{str_limit($b->name, $limit = 100, $end = '...')}} </a></h4>
							@endif
							Last updated: {{$b->updated_at}}
							in {{$b->category}}</td>
							<td><h5>+ {{$b->userRating}}</h5><h6>+ {{$b->criticRating}}</h6></td>
							<td><h5><span class="glyphicon glyphicon-list-alt"></span> {{$b->user->username}}</h5></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-7">
			<div class="header">
					<h3><span class="first-letter">E</span>XPLORE</h3>
			</div><br/>
			<div class="row">

			</div>
		</div>
	</div>
</div>
@stop
