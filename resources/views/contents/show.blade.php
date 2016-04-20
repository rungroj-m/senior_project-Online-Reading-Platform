@extends('app')

@section('content')


<div>
	<div class="col-md-8 col-md-offset-2 content-body" style="padding-bottom: 100px">
		<h1 align="center">{{ $book-> name }}</h1><br/>
		<h3 align="center">Chapter {{ $content_chap->chapter }}</h3><br/>
		<h4 align="center">{{ $content_chap->name }}</h1>
		<hr>
			@if($book->isComic())
				<button id="leftbutton" class="btn-success pull-left" >&lt;</button>
				<button id="rightbutton" class="btn-success pull-right">&gt;</button>
				<br>
				<!-- <p class="content-text" align="center"> -->
					<?php $i = 1 ?>
					<div class="owl-carousel">
						@foreach($content_images as $content)
							<div class="item">
								<center>
									<img src="/images/{{$content}}" style="display: block;width: auto;height: 100% !important;max-width: 100%">
									<p align="center">{{$i}}/{{count($content_images)}}</p>
									<?php $i++ ?>
								</center>
							</div>
						@endforeach
					</div>
				<!-- </p> -->
				<script type="text/javascript" display="none">
					$(document).ready(function(){
						$('.owl-carousel').owlCarousel({
							lazyLoad: true,
							loop:false,
							margin:5,
//	    				nav:true,
							responsive:{
					        0:{
					            items:1
					        }
					    }
						});
					});
				</script>
			@else
				<p class="content-text">{!! $content_chap->content !!}</p>
			@endif
	</div>

	<div class="col-md-2">
		@if($book->isOwner())
			<div class="btn-group-vertical">
				{!! Form::open([
					'method' => 'GET',
					'route' => ['books.{book}.content.edit',$book->id,$content_chap->chapter]
				]) !!}
				{!! Form::submit('Edit Chapter', ['class' => 'btn btn-default']) !!}
				{!! Form::close() !!}
				<button type="button" class="btn btn-default form-control" data-toggle="modal" data-target="#deleteModal">Delete Chapter</button>
			</div>
		@endif
	</div>
</div>

<!-- FIXED NAVBAR BOTTOM -->
<nav class="navbar-default navbar-fixed-bottom">
	<div class="container-fluid">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
			<span class="sr-only">Toggle Navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
			<ul class="nav navbar-left">
				@if($book->isComic())
					@if($book->prevChapter($content_chap->chapter) >= 0)
						<a class="btn btn-success" href="/comics/{{$book->id}}/content/{{$book->prevChapter($content_chap->chapter)}}" role="button">Previous Chapter</a>
					@endif
					@if($book->nextChapter($content_chap->chapter) >= 0)
						<a class="btn btn-success" href="/comics/{{$book->id}}/content/{{$book->nextChapter($content_chap->chapter)}}" role="button">Next Chapter</a><
					@endif
				@else
					@if($book->prevChapter($content_chap->chapter) >= 0)
						<a class="btn btn-success" href="/books/{{$book->id}}/content/{{$book->prevChapter($content_chap->chapter)}}/" role="button">Previous Chapter</a>
					@endif
					@if($book->nextChapter($content_chap->chapter) >= 0)
						<a class="btn btn-success" href="/books/{{$book->id}}/content/{{$book->nextChapter($content_chap->chapter)}}" role="button">Next Chapter</a>
					@endif
				@endif
			</ul>
			<ul class="nav navbar-right">
				@if($book->isComic())
					<a class="btn btn-primary" href="/comics/{{$book->id}}/content/" role="button">Content Page</a>
				@else
					<a class="btn btn-primary" href="/books/{{$book->id}}/content/" role="button">Content Page</a>
				@endif
			</ul>
		</div>
	</div>
</nav>

<script>

	$("#leftbutton").click(function(){
		var owl = jQuery(".owl-carousel");
		owl.trigger('prev.owl');
	});

	$("#rightbutton").click(function(){
		var owl = jQuery(".owl-carousel");
		owl.trigger('next.owl');
	});

	jQuery(document.documentElement).keyup(function (event) {

		var owl = jQuery(".owl-carousel");

		// handle cursor keys
		if (event.keyCode == 37) {
			// go left
			owl.trigger('prev.owl');
		} else if (event.keyCode == 39) {
			// go right
			owl.trigger('next.owl');
		}

	});

</script>


@stop

<!-- MODAL -->
<div id="deleteModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Delete Chapter</h4>
			</div>
			{!! Form::open(['method' => 'DELETE','route' => ['books.{book}.content.destroy', $book->id, $content_chap->chapter]]) !!}
			<div class="modal-body">
				<p>Delete this chapter?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default inline" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success inline">Submit</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>