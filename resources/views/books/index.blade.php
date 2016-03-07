@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
			<h1>Creator's Hub</h1>
			<h5>Find readable stuff here.</h5>
			<hr>
			<div class="container">
				<div class="row">
				<h3>Top Rated</h3>
					<div class="col-md-5">
						<div class="media">
							<div class="media-left">
								<a href="#">
									<img class="media-object" src="https://upload.wikimedia.org/wikipedia/en/0/0f/Heavy_Object_light_novel_volume_1_cover.jpg" alt="..." width="100" height="100">
								</a>
							</div>
							<div class="media-body">
								<h4 class="media-heading content-text word-wrap">Heavy Object</h4>
									<p class="content-text word-wrap">In the end, war couldn't be extinguished. But, there was a transformation. Even in the heart of a worthless accomplice in murder who was indifferently continuing his task, there was a transformation. The massive weapon "Object"...</p>
									<h5>User Rating: 8.5</h5>
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="media">
							<div class="media-left">
								<a href="#">
									<img class="media-object" src="http://static.zerochan.net/Chrome.Shelled.Regios.full.44266.jpg" alt="..." width="100" height="100">
								</a>
							</div>
							<div class="media-body">
								<h4 class="media-heading content-text word-wrap">Chrome Shelled Regios</h4>
									<p class="content-text word-wrap">Regios are moving cities, sheltering humanity on the barren and polluted Earth that is populated by Filth Monsters. Tired of fighting monsters and for a reason not yet revealed, Layfon left his home city to arrive at Zuellni, a city which...</p>
									<h5>User Rating: 7.78</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
			<center>
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
				<a href="{{ route('books.create') }}" class="btn btn-default">New Book</a>
			</center>
		</div>
	</div>
</div>
@stop
