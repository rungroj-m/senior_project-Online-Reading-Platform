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
		<div class="col-md-10 col-md-offset-1">
			<div class="thumbnail">
				<h1 align="middle">Welcome To <span class="first-letter">R</span>EADI!</h1>
				<h3 align="middle">Write</h3>
				<h3 align="middle">Read</h3>
				<h3 align="middle">Contribute</h3>
			</div>
		</div>
		<div class="col-md-5">
			<div class="header">
				<h3><span class="first-letter">T</span>op Novels</h3>
			</div>
			<div class="row">
				<?php $max = $books->count();
					if($max>2) $max = 2;
				?>
				@for($i = 0; $i < $max; $i++)
					<?php $b = $books[$i] ?>
					@if($b->category == 'Novel')
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
						</div>
					@endif
				@endfor
			</div>
		</div>
		<div class="col-md-7">
			<div class="header">
				<h3><span class="first-letter">R</span>ecent Novels</h3><br/>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered" align="center">
					<tbody>
						<?php $bookCount = 0;?>
						@foreach($books as $b)
							@if($bookCount == 6)
								<?php break; ?>
							@endif
							@if($b->category == 'Novel')
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
								<?php $bookCount++; ?>
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
			<a href="/books"><h4 align="right">Load more Novels...</h4></a>
		</div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-md-5">
			<div class="header">
				<h3><span class="first-letter">T</span>op Comics</h3>
			</div>
			<div class="row">
				<?php 	$max = $books->count();
						$comicCount = 0; ?>
				@for($i = 0; $i < $max; $i++)
					<?php $b = $books[$i] ?>
					@if($comicCount >= 2)
						<?php break; ?>
					@endif
					@if($b->category == 'Comic')
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
						</div>
						<?php $comicCount++ ?>
					@endif
				@endfor
			</div>
		</div>
		<div class="col-md-7">
			<div class="header">
				<h3><span class="first-letter">R</span>ecent Comics</h3><br/>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered" align="center">
					<tbody>
						<?php $bookCount = 0;?>
						@foreach($books as $b)
							@if($bookCount == 6)
								<?php break; ?>
							@endif
							@if($b->category == 'Comic')
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
								<?php $bookCount++; ?>
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
			<a href="/comics"><h4 align="right">Load more Comics...</h4></a>
		</div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-md-6">
			<header>
				<h3><span class="first-letter">T</span>ags</h3>
			</header>
		</div>
	</div>
</div>
@stop
