@extends('app')

@section('content')
<div class="main-container">
	<header>
		<h3 class="inline">{{$user->username}}</h3>
	</header><br/>
	<div class="row">
		<div class="col-md-3">
			<div class="thumbnail content">
				@if($user->image == null)
				<div class="thumbnail content user-image">
					<h3>NO IMAGE</h3>
				</div>
				@else
				<div class="thumbnail content user-image">
					<img src="/images/{{$user->image}}">
				</div>
				@endif
			</div>
		</div>
		<div class="col-md-6">
			<div>
				<div class="user-profile">
					<span class="glyphicon glyphicon-user"></span>
					<b class="inline">Username: </b> {{$user->username}}
				</div>
				<div class="user-profile">
					<span class="glyphicon glyphicon-hourglass"></span>
					<b class="inline">Member Since: </b> {{$user->created_at}}
				</div>
				<div class="user-profile">
					<span class="glyphicon glyphicon-lock"></span>
					<b class="inline">Permission Level: </b> {{$user->userLevel}}
				</div>
				<div class="user-profile">
					<span class="glyphicon glyphicon-book"></span>
					<b class="inline">Books Published: </b> {{$user->books->count()}}
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<ul class="nav nav-tabs">
				<li class="active">
					<a data-toggle="tab" href="#books"><h4><span class="first-letter">B</span>ooks</h4></a>
				</li>
				<li>
				<a data-toggle="tab" href="#donations"><h4><span class="first-letter">D</span>onations</h4></a>
				</li>
			</ul>
			<!-- Tab Content -->
			<div class="tab-content">
				<div id="books" class="tab-pane fade in active">
					<table class="table table-bordered" align="center">
						<tbody>
							@foreach($user->books as $b)
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
									<td><p>+ {{$b->userRating}}</p><p>+ {{$b->criticRating}}</p></td>
									<td><p><span class="glyphicon glyphicon-user"></span> {{$b->user->username}}</p></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</td>
			</div>
			<div id="donations" class="tab-pane fade">
				<table class="table table-bordered" align="center">
					<tbody>
						@foreach($user->donations as $d)
							<tr>
								<td>{{ $d->id }}</td>
			                    <td>{{ $d->book->name }}</td>
			                    <td>{{ $d->goal_amount }}</td>
			                    <td>{{ $d->active }}</td>
			                    <td>{{ $d->description }}</td>
			                    <td>{{ $d->created_at->format('F d, Y h:ia') }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-12">
			
		</div>
	</div>
</div>
@stop