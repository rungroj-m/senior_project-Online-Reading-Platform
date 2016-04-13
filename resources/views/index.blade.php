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
		</div><hr/>
		<div class="col-md-12">
			<div class="header">
				<h3><span class="first-letter">E</span>DITOR'S CHOICE</h3>
			</div>
			<div class="row">
				<?php $max = $books->count();
					if($max>4) $max = 4;
				?>
				@for($i = 0; $i < $max; $i++)
					<?php $b = $books[$i] ?>
					<div class="thumbnail col-md-3 book-thumbnail content">
						@if($b->isComic())
							<a href="/comics/{{$b->id}}/content"><h4>{{str_limit($b->name, $limit = 20, $end = '...')}}</h4>
						@else
							<a href="/books/{{$b->id}}/content"><h4>{{str_limit($b->name, $limit = 20, $end = '...')}}</h4>
						@endif

						@if($b->image == null)
							<div class="img-thumbnail cover-image-thumbnail">
								<h1>NO IMAGE</h1>
							</div>
						@else
							<img class="img-thumbnail cover-image-thumbnail" src="/images/{{$b->image}}">
						@endif
						</a>
						by {{$b->user->username}} in {{$b->category}}
						<div><h4>User Rating</h4></div>
						<div><h4>{{ $b->getUserRatingAverage() }}</div>
						<!-- @foreach($b->tags as $t)
							<span class="badge"> {{$t->tag}}</span>
						@endforeach -->
					</div>
				@endfor
			</div>
		</div>
		<div class="col-md-10">
			<div class="header">
				<h3><span class="first-letter">M</span>OST <span class="first-letter">R</span>ECENT</h3><br/>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered" align="center">
					<tbody>
						@foreach($books as $b)
							<tr>
								@if($b->image == null)
									<td align="center">
										<div>No</div> 
										<div>Image</div>
									</td>
								@else
									<td align="center"><img class="small-cover-image-thumbnail" src="/images/{{$b->image}}"></td>
								@endif
								@if($b->isComic())
									<td><h4><a href="/comics/{{$b -> id}}"> {{str_limit($b->name, $limit = 100, $end = '...')}} </a></h4>
								@else($b->category == 'Comic')
									<td><h4><a href="/books/{{$b -> id}}"> {{str_limit($b->name, $limit = 100, $end = '...')}} </a></h4>
								@endif
								Last updated: {{$b->updated_at}}
								in {{$b->category}}</td>
								<td><p>+ {{$b->getUserRatingAverage()}}</p><p>+ {{$b->getCriticRatingAverage()}}</p></td>
								<td><p><span class="glyphicon glyphicon-user"></span> {{$b->user->username}}</p></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-6">
		</div>
	</div>
</div>
@stop
