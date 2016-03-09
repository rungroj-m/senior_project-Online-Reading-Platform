@extends('app')

@section('content')
<body>
	<div>
		<div class="col-md-10 col-md-offset-1">
			<div>
				<div align="right" style="float: right">
					<a href="{{ route('books.create') }}" class="btn btn-default">Create New</a>
					<input type="textarea">
					<button type="submit">
						<i class="glyphicon glyphicon-search"></i>
					</button>
				</div>
				<h1>Readi CREATORS</h1>
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
				<div class="col-md-6">
					<table class="table" style="width:100%" align="center">
<!-- 						<thead>
							<th>Title</th>
							<th>Description</th>
							<th>User Rating</th>
							<th>Category</th>
						</thead> -->
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
				</div>
				<div class="col-md-6">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus quam ut orci dignissim interdum. Curabitur ipsum mi, facilisis id nisl mollis, consequat egestas felis. Cras id lacus faucibus, vehicula nibh tincidunt, porta sem. Sed ornare scelerisque vehicula. Duis tempor maximus purus. Curabitur gravida, magna sit amet semper viverra, lorem lorem lacinia justo, a feugiat quam lectus quis purus. Pellentesque pretium neque vitae accumsan tincidunt.

					Donec id pellentesque mauris. Donec at arcu lorem. Aenean fringilla metus eu consequat suscipit. Fusce id dignissim erat. Suspendisse dignissim urna ut dolor sagittis sollicitudin. Cras ornare leo odio, vel egestas metus ornare ut. Curabitur sagittis neque vel sem tempor convallis. Praesent a diam cursus, feugiat neque et, ornare leo. Morbi mattis ultricies ullamcorper. Phasellus vehicula, mi eget gravida placerat, tellus felis congue quam, facilisis vestibulum ligula elit vitae tellus. Aenean non euismod neque, non sagittis orci. Vestibulum convallis mollis tellus et maximus.
				</div>
			</div>
		</div>
	</div>
</body>
@stop
