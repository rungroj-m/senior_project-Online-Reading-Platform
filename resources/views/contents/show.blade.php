@extends('app')

@section('content')


<div>
	<div class="col-md-8 col-md-offset-2 content-body">
		<h1 align="center">{{ $book-> name }}</h1><br/>
		<h3 align="center">Chapter {{ $content_chap->chapter }}</h3><br/>
		<h4 align="center">{{ $content_chap->name }}</h1>
		<hr>
			@if($book->isComic())
				<!-- <p class="content-text" align="center"> -->
					<?php $i = 1 ?>
					<div class="owl-carousel">
						@foreach($content_images as $content)
							<div class="item">
								<img src="/images/{{$content}}">
								<p align="center">{{$i}}/{{count($content_images)}}</p>
								<?php $i++ ?>
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
	    				loop:false,
	    				nav:true,
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
					'route' => ['books.{book}.content.edit',$id,$content_chap->chapter]
				]) !!}
				{!! Form::submit('Edit Chapter', ['class' => 'btn btn-default']) !!}
				{!! Form::close() !!}
				<button type="button" class="btn btn-default form-control" data-toggle="modal" data-target="#deleteModal">Delete Chapter</button>
			</div>
		@endif
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
				<h4 class="modal-title">Delete Chapter</h4>
			</div>
			{!! Form::open(['method' => 'DELETE','route' => ['books.{book}.content.destroy', $id, $content_chap->chapter]]) !!}
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
