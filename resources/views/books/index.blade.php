@extends('app')

@section('content')
<div class="main-container">
	<div class="header">
		@if(Request::path() == 'books')
			<h1><span class="first-letter">N</span>OVEL</h1>
		@elseif(Request::path() == 'comics')
			<h1><span class="first-letter">C</span>OMIC</h1>
		@endif
	</div><hr/>
	<div>
		@for($i = 0; $i < count($books); $i++)
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
@stop
