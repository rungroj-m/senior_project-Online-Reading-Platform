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
				<h3>1. Start your own creation right now.</h3>
				<h3>2. Browse through other creator's masterpiece.</h3>
				<h3>3. Give others rating and useful comments.</h3>
				<h3 align="right">4. Subscribe and get notifications.</h3>
				<h3 align="right">5. Spread the word of their creations.</h3>
				<h2 align="middle">Share it everywhere!</h2>
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
						@foreach($books as $b)
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
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-md-5">
			<div class="header">
				<h3><span class="first-letter">T</span>op Comics</h3>
			</div>
			<div class="row">
				<?php $max = $books->count();
					if($max>2) $max = 2;
				?>
				@for($i = 0; $i < $max; $i++)
					<?php $b = $books[$i] ?>
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
						@foreach($books as $b)
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
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@stop
