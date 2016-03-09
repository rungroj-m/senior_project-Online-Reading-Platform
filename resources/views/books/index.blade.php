@extends('app')

@section('content')
<body>
	<div class="container transparent-white">
		<div class="col-md-10 col-md-offset-1">
			<div>
				<h1>Readi CREATORS</h1><br/>

				<div>
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<!-- <ol class="carousel-indicators">
							<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
							<li data-target="#carousel-example-generic" data-slide-to="1"></li>
						</ol> -->
						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
							<div class="item active carousel-image">
								<img src="/images/book1.jpg" alt="">
								<div class="carousel-caption">
									Book 1
								</div>
							</div>
							<div class="item carousel-image">
								<img src="/images/book2.jpg" alt="">
								<div class="carousel-caption">
									Book 2
								</div>
							</div>
						</div>
						<!-- Controls -->
						<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div><br/>
				<div>
					<table class="table" style="width:100%" align="center">
						<thead>
							<th>Title</th>
							<th>Description</th>
							<th>User Rating</th>
							<th>Category</th>
						</thead>
						<tbody>
							@foreach($books as $b)
								<tr>
									<td><a href="/books/{{$b -> bookKey}}"> {{$b->name}} </a></td>
									<td>
										{{ str_limit($b->description, $limit = 120, $end = '...') }}</p>
									</td>
									<td>{{$b->userRating}}</td>
									<td>{{$b->category}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					<a href="{{ route('books.create') }}" class="btn btn-primary">New Book</a>
				</div>
			</div>
		</div>
	</div>
</body>
@stop
