@extends('app')

@section('content')
<div class="main-container">
	<header>
		<h3 class="inline"><span class="first-letter">P</span>ROFILE</h3>
		<h3 class="inline"><span class="first-letter">D</span>ASHBAORD</h3>
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
					<img src="images/{{$user->image}}">
				</div>
				@endif
				<div class="content">
					<button class="btn btn-success" data-toggle="modal" data-target="#myModal">Upload Avatar</button>
				</div>
			</div>
		</div>
		<div class="col-md-9">
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
					<a data-toggle="tab" href="#notification"><h4><span class="first-letter">N</span>otifications</h4></a>
				</li>
				<li>
					<a data-toggle="tab" href="#subscription"><h4><span class="first-letter">S</span>ubscriptions</h4></a>
				</li>
			</ul>
			<!-- Tab Content -->
			<div class="tab-content">
				<div id="notification" class="tab-pane fade in active">
					<!-- NOTIFICATIONS TABLE -->
					<div class="table-responsive">
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
				                      <a href="{{ $noti->url }}" class="btn btn-info pull-left" style="margin-right: 3px;">
				                        Chapter{{ $noti->extra->chapter }}: {{ $noti->extra->chaptername }}
				                      </a>
				                    </td>
				                </tr>
				                @endforeach
				            </tbody>
				        </table>
				    </div>
				</div>
				<div id="subscription" class="tab-pane fade">
					<!-- SUBSCRIPTIONS TABLE -->
					<div class="table-responsive">
				        <table class="table table-bordered">
				            <thead>
				                <tr>
				                    <th>Book ID</th>
				                </tr>
				            </thead>
				            <tbody>
				                @foreach ($subscriptions as $subscribe)
				                <tr>
				                    <td>
				                      <a href="/books/{{ $subscribe->book_id }}/content" class="btn btn-info pull-left" style="margin-right: 3px;">
				                        {{ $subscribe->book_id }}
				                      </a>
				                    </td>
				                </tr>
				                @endforeach
				            </tbody>
				        </table>
				    </div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<header>
				<h3><span class="first-letter">P</span>UBLISHED BOOKS</h3>
			</header>
			<div class="table-responsive">
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