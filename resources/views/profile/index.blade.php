@extends('app')

@section('content')
<div class="main-container">
	<header>
		<h3 class="inline"><span class="first-letter">P</span>ROFILE</h3>
		<h3 class="inline"><span class="first-letter">D</span>ASHBAORD</h3>
		<div class="pull-right">
			<a href="{{ route('profile.edit') }}" class="btn btn-success">Edit Profile</a>
		</div>
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
				<br>
				<div class="content">
					<button class="btn btn-success" data-toggle="modal" data-target="#myModal">Upload Avatar</button>
				</div>
			</div>
		</div>
		<div class="col-md-4">
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
					<b class="inline">Permission Level: </b> 
					@if($user->userLevel == 0)
						Standard
					@elseif($user->userLevel == 1)
						Critic
					@else
						Administrator
					@endif
				</div>
				<div class="user-profile">
					<span class="glyphicon glyphicon-book"></span>
					<b class="inline">Books Published: </b> {{$user->books->count()}}
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<header>
				<h4><span class="first-letter">N</span>otification</h4>
			</header>
			<div class="table" style="overflow: auto; height:200px">
		        <table class="table">
		            <tbody>
		                @foreach ($notifications as $noti)
		                <tr>
		                    <td>
		                    	@if ($noti->category->name == 'book.updatechapter')
		                        	<h5><b>{{ $noti->extra->bookname }}</b></h5> has updated!
		                    	@else
		                    	@endif
		                    </td>
		                    <td>
		                    	<a href="{{ $noti->url }}" class="btn btn-success" style="margin-right: 3px;" onclick=myNotification("{{$noti->id}}");>
		                    		New! Chapter {{ $noti->extra->chapter }}
		                    	</a>
		                    </td>
		                </tr>
		                @endforeach
		            </tbody>
		        </table>
			</div>
		</div>
		<div class="col-md-12">
			<ul class="nav nav-tabs">
				<li class="active">
					<a data-toggle="tab" href="#notification"><h4><span class="first-letter">N</span>otifications</h4></a>
				</li>
				<li>
					<a data-toggle="tab" href="#subscription"><h4><span class="first-letter">S</span>ubscriptions</h4></a>
				</li>
				<li>
					<a data-toggle="tab" href="#books"><h4><span class="first-letter">P</span>ublished Works</h4></a>
				</li>
				<li>
					<a data-toggle="tab" href="#donations"><h4><span class="first-letter">D</span>onations</h4></a>
				</li>
				<li>
					<a data-toggle="tab" href="#pleads"><h4><span class="first-letter">P</span>leads</h4></a>
				</li>
			</ul>
			<!-- Tab Content -->
			<div class="tab-content">
				<!-- NOTIFICATIONS TABLE -->
				<div id="notification" class="tab-pane fade in active">
			        <table class="table table-bordered">
			            <thead>
			                <tr>
			                    <th>Notification ID</th>
			                    <th>Category</th>
			                    <th>Description</th>
			                    <th>URL</th>
			                </tr>
			            </thead>
			            <tbody>
			                @foreach ($notifications as $noti)
			                <tr>
			                    <td>{{$noti->id}}</td>
			                    <td>
			                    	@if ($noti->category->name == 'book.updatechapter')
			                        {{ $noti->extra->bookname }} updated!
			                    	@else
			                    	@endif
			                    </td>
			                    <td>
			                      {{ $noti->description }}
			                    </td>
			                    <td>
			                      <a href="{{ $noti->url }}" class="btn btn-success pull-left" style="margin-right: 3px;" onclick=myNotification("{{$noti->id}}");>
			                        Chapter {{ $noti->extra->chapter }}: {{ $noti->extra->chaptername }}
			                      </a>
			                    </td>
			                </tr>
			                @endforeach
			            </tbody>
			        </table>
				</div>
				<!-- SUBSCRIPTIONS TABLE -->
				<div id="subscription" class="tab-pane fade">
					<div>
				        <table class="table table-bordered">
				            <tbody>
				                @foreach ($subscriptions as $subscribe)
									@if($subscribe->active)
									<tr>
										<td>
										  <a href="/books/{{ $subscribe->book_id }}/content" class="btn btn-info pull-left" style="margin-right: 3px;">
											{{ $subscribe->book_id }}
										  </a>
										</td>
										@if($subscribe->book->image == null)
											<td align="center">
												<div>No</div>
												<div>Image</div>
											</td>
										@else
											<td align="center"><img class="small-cover-image-thumbnail" src="/images/{{$subscribe->book->image}}"></td>
										@endif
										@if($subscribe->book->isComic())
											<td><h4><a href="/comics/{{$subscribe->book->id}}"> {{str_limit($subscribe->book->name, $limit = 100, $end = '...')}} </a></h4>
										@else($subscribe->book->category == 'Comic')
											<td><h4><a href="/books/{{$subscribe->book->id}}"> {{str_limit($subscribe->book->name, $limit = 100, $end = '...')}} </a></h4>
										@endif
										Subscribed since: {{$subscribe->updated_at}}
										in {{$subscribe->book->category}}</td>
											<td>
												{!! Form::open([
													'method' => 'GET',
													'route' => ['unsubscribe', $subscribe->book->id]
												]) !!}
												{!! Form::submit('Unsubscribe', ['class' => 'btn btn-warning form-control']) !!}
												{!! Form::close() !!}
											</td>
									</tr>
								@endif
				                @endforeach
				            </tbody>
				        </table>
				    </div>
				</div>
				<!-- BOOKS TABLE -->
				<div id="books" class="tab-pane fade">
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
									Total Chapters: {{$b->contents->count()}}
									Last updated: {{$b->updated_at}}
									in {{$b->category}}</td>
									<td><p>+ {{$b->getUserRatingAverage()}}</p><p>+ {{$b->getCriticRatingAverage()}}</p></td>
									<td><p><span class="glyphicon glyphicon-user"></span> {{$b->user->username}}</p></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				<!-- DONATIONS TABLE -->
				<div id="donations" class="tab-pane fade">
					<table class="table table-bordered">
			            <thead>
			                <tr>
			                    <th>No.</th>
			                    <th>Related Book</th>
			                    <th>Goal Amount</th>
			                    <th>Active</th>
			                    <th>Description</th>
			                    <th>Date/Time Added</th>
			                    <th>View</th>
			                    <th>Edit</th>
			                </tr>
			            </thead>
			            <tbody>
			                @foreach ($user->donations as $donation)
			                <tr>
			                    <td>{{ $donation->id }}</td>
			                    <td>
			                    	@if($donation->book->isComic())
			                    		<a href="/comics/{{$donation->book_id}}/content">{{ $donation->book->name }}</a></td>
			                    	@else
			                    		<a href="/books/{{$donation->book_id}}/content">{{ $donation->book->name }}</a></td>
			                    	@endif
			                    <td>{{ $donation->goal_amount }}</td>
			                    <td>{{ $donation->active }}</td>
			                    <td>{{ $donation->description }}</td>
			                    <td>{{ $donation->created_at->format('F d, Y h:ia') }}</td>
			                    <td><a href="/donation/{{ $donation->id }}" class="btn btn-success pull-left" style="margin-right: 3px;">View</a></td>
			                    <td>
			                      <a href="/donation/{{ $donation->id }}/edit" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
			                    </td>
			                </tr>
			                @endforeach
			            </tbody>
			        </table>
			    </div>

			    <!-- PLEADS TABLE -->
			    <div id="pleads" class="tab-pane fade">
			        <table class="table table-bordered">
			            <thead>
			                <tr>
			                    <th>No.</th>
			                    <th>Book</th>
			                    <th>Description</th>
			                    <th>Amount</th>
			                    <th>Confirmed</th>
			                    <th>Date/Time Added</th>
			                </tr>
			            </thead>
			            <tbody>
			                @foreach ($user->pleadings as $pleader)
			                <tr>
			                    <td>{{ $pleader->id }}</td>
			                    <td>{{ $pleader->donation->book->name}}</td>
			                    <td>{{ $pleader->donation->description}}</td>
			                    <td>{{ $pleader->amount }}</td>
			                    <td>{{ $pleader->confirmed }}</td>
			                    <td>{{ $pleader->created_at->format('F d, Y h:ia') }}</td>
			                </tr>
			                @endforeach
			            </tbody>
			        </table>
			    </div>
			</div>
		</div>
	</div>
</div>
@stop

<!-- UPLOAD AVATAR MODAL -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			{!! Form::open(array('url' => 'profile/image/', 'files' => true)) !!}
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Upload Avatar</h4>
			</div>
			<div class="modal-body">
				{!! Form::label('image', 'Select Avatar', ['class'=>'h3']) !!}
				{!! Form::file('image', ['class'=>'content']) !!}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default inline" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success inline">Upload</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

<script>
	function myNotificaiton($notiId) {
//		window.location = "/login/facebook";
		Auth::user()->readNoti($noti->id);
	}
</script>
