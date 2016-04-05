@extends('app')

@section('content')
<div>
	<div class="main-container">
		<div class="header">
			<h1><span class="first-letter">N</span>OVEL</h1>
		</div>
		<div>
			@for($i = 0; $i < count($books); $i++)
				<?php $b = $books[$i] ?>
				<div class="thumbnail col-md-3" style="height: auto; min-height: 150px; width: auto; min-width: 200px; margin: 15px">
					<a href="/books/{{$b->id}}/content"><h2>{{$b->name}}</h2></a>
					<div class="word-wrap"><h4>{{$b->user->username}}</h4></div>
					@foreach($b->tags as $t)
						<span class="badge"> {{$t->tag}}</span>
					@endforeach
				</div>
			@endfor
		</div>
	</div>
</div>
@stop
