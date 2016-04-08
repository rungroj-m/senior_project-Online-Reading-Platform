<div class="thumbnail">
	<div class="caption">
		<p>{{$c->comment}}</p>
		<div style="text-align: right">
			<p>- {{$c->user->username}} |
				{{$c->rating}}
				<a href="/books/{{$id}}/content/comment/{{$c->id}}/up" class="first-letter" href="">+</a>
				<a href="/books/{{$id}}/content/comment/{{$c->id}}/down" class="first-letter">-</a>
				<a href="/books/{{$id}}/content/comment/{{$c->id}}/report" class="first-letter">report</a>


			@if(Auth::user()->isAdmin() || $book->isOwner() || $c->isOwner())
				{!! Form::open([
					'method' => 'DELETE',
					'route' => ['deletecomment', $id, $c->id]
				]) !!}
				{!! Form::submit('Delete Chapter', ['class' => 'btn btn-default']) !!}
				{!! Form::close() !!}
			@endif
				<form method="POST" action="/books/{{$id}}/content/comment/{{$c->id}}">
					<input class="form-control" type="text" name="comment" ng-model="comment{{$c->id}}"><br/>
					<button type="submit" class="btn btn-success form-control">Add Comment</button>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
				</form>
			</p>
		</div>
	</div>
</div>

@foreach($c->childs as $comment)
	@include('comments.show', ['c' => $comment])
@endforeach
