@extends('app')

@section('content')
<div>
	<div class="header">
		@if(Request::path() == 'books')
			<h1><span class="first-letter">N</span>OVEL</h1>
		@elseif(Request::path() == 'comics')
			<h1><span class="first-letter">C</span>OMIC</h1>
		@endif
	</div>
	<div>
		@for($i = 0; $i < count($books); $i++)
			<?php $b = $books[$i] ?>
			<div class="thumbnail col-md-3" style="height: auto; min-height: 150px; width: auto; min-width: 200px; margin: 15px">
				@if($b->isComic())
					<a href="/comics/{{$b->id}}/content"><h2>{{$b->name}}</h2></a>
				@else
					<a href="/books/{{$b->id}}/content"><h2>{{$b->name}}</h2></a>
				@endif

				<div class="word-wrap"><h4>{{$b->user->username}}</h4></div>
				@foreach($b->tags as $t)
					<span class="badge"> {{$t->tag}}</span>
				@endforeach
			</div>
		@endfor
	</div>
</div>
@stop
