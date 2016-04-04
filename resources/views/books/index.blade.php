@extends('app')

@section('content')
<body>
	<div>
		<div class="col-md-10 col-md-offset-1">
			<div>
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
				<div>
					<div id="carousel-data" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner" role="listbox">
							<div class="item active carousel-image">
								<img src="" alt="">
								<div class="carousel-caption">
									<h2>Novel 1</h2>
								</div>
							</div>
							<div class="item carousel-image">
								<img src="" alt="">
								<div class="carousel-caption">
									<h2>Novel 2</h2>
								</div>
							</div>
						</div>
						<a class="left carousel-control" href="#carousel-data" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#carousel-data" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div><br/>
				<div class="col-md-6">
					<div class="header">
						<h2><span class="first-letter">R</span>ECENT</h2><br/>
					</div>
					<table class="table" style="width:100%" align="center">
						<tbody>
							@foreach($books as $b)
								<tr>
									<td><h4><a href="/books/{{$b -> id}}"> {{str_limit($b->name, $limit = 100, $end = '...')}} </a></h4>
									Last updated: {{$b->updated_at}}
									in {{$b->category}}</td>
									<td><h5>+ {{$b->userRating}}</h5><h6>+ {{$b->criticRating}}</h6></td>
									<td><h5><span class="glyphicon glyphicon-list-alt"></span> {{$b->user->username}}</h5></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="col-md-6">
					<h1>TEST</h1>
				</div>
				<div class="col-md-6">
					<div class="header">
							<h2><span class="first-letter">E</span>XPLORE</h2>
					</div><br/>
					<div>
						<p>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus quam ut orci dignissim interdum. Curabitur ipsum mi, facilisis id nisl mollis, consequat egestas felis. Cras id lacus faucibus, vehicula nibh tincidunt, porta sem. Sed ornare scelerisque vehicula. Duis tempor maximus purus. Curabitur gravida, magna sit amet semper viverra, lorem lorem lacinia justo, a feugiat quam lectus quis purus. Pellentesque pretium neque vitae accumsan tincidunt.

						Donec id pellentesque mauris. Donec at arcu lorem. Aenean fringilla metus eu consequat suscipit. Fusce id dignissim erat. Suspendisse dignissim urna ut dolor sagittis sollicitudin. Cras ornare leo odio, vel egestas metus ornare ut. Curabitur sagittis neque vel sem tempor convallis. Praesent a diam cursus, feugiat neque et, ornare leo. Morbi mattis ultricies ullamcorper. Phasellus vehicula, mi eget gravida placerat, tellus felis congue quam, facilisis vestibulum ligula elit vitae tellus. Aenean non euismod neque, non sagittis orci. Vestibulum convallis mollis tellus et maximus.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
@stop
