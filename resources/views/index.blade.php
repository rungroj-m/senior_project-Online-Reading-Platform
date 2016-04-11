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
		</div>
		<div class="col-md-12">
			<div class="content">
				<h2>EDITOR'S pick</h2>
			</div>
			<div class="row">
				<div class="thumbnail carousel-thumbnail col-md-2">
					<h1>TEST 1</h1>
				</div>
				<div class="thumbnail carousel-thumbnail col-md-2">
					<h1>TEST 2</h1>
				</div>
				<div class="thumbnail carousel-thumbnail col-md-2">
					<h1>TEST 3</h1>
				</div>
				<div class="thumbnail carousel-thumbnail col-md-2">
					<h1>TEST 4</h1>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="header">
				<h2><span class="first-letter">R</span>ECENT</h2><br/>
			</div>
			<table class="table" align="center">
				<tbody>
					@foreach($books as $b)
						<tr>
							@if($b->isComic())
								<td><h4><a href="/comics/{{$b -> id}}"> {{str_limit($b->name, $limit = 100, $end = '...')}} </a></h4>
							@else($b->category == 'Comic')
								<td><h4><a href="/books/{{$b -> id}}"> {{str_limit($b->name, $limit = 100, $end = '...')}} </a></h4>
							@endif
							Last updated: {{$b->updated_at}}
							in {{$b->category}}</td>
							<td><h5>+ {{$b->userRating}}</h5><h6>+ {{$b->criticRating}}</h6></td>
							<td><h5><span class="glyphicon glyphicon-list-alt"></span> {{$b->user->username}}</h5></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-7">
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
@stop
