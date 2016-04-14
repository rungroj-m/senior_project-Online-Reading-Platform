<div class="thumbnail">
	<a href="#collapseComment{{$c->id}}" data-toggle="collapse" aria-controls="collapseComment" id ={{$c->id}}  onclick="action({{$c->id}});">[-]</a>
	<div class="collapse in" id="collapseComment{{$c->id}}">
		<div class="caption">
			<p>{{$c->comment}}</p>
			<div style="text-align: right">
				<p>- {{$c->user->username}} |
					{{$c->rating}}
					<a href="/books/{{$id}}/content/comment/{{$c->id}}/up" class="first-letter" href="">+</a>
					<a href="/books/{{$id}}/content/comment/{{$c->id}}/down" class="first-letter">-</a>
					<a href="/books/{{$id}}/content/comment/{{$c->id}}/report" class="first-letter">report</a>
					<a href="#collapseReply{{$c->id}}" data-toggle="collapse" aria-controls="collapseReply" class="first-letter">reply</a>
				@if(Auth::user()->isAdmin() || $book->isOwner() || $c->isOwner())
					{!! Form::open([
						'method' => 'DELETE',
						'route' => ['deletecomment', $id, $c->id]
					]) !!}
					{!! Form::submit('delete', ['class' => 'btn btn-default']) !!}
					{!! Form::close() !!}
				@endif
				<div class="collapse" id="collapseReply{{$c->id}}">
					<form method="POST" action="/books/{{$id}}/content/comment/{{$c->id}}">
						<input class="form-control" type="text" name="comment" ng-model="comment{{$c->id}}"><br/>
						<button type="submit" class="btn btn-success form-control">Add Comment</button>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
					</form>
				</div>
				</p>
			</div>
			@foreach($c->childs as $comment)
				@include('comments.show', ['c' => $comment])
			@endforeach
		</div>
	</div>
</div>

<script>
	var hidden = false;
	function action($value) {
		hidden = !hidden;
		if(document.getElementById($value).innerHTML == '[-]') {
			document.getElementById($value).innerHTML = '[+]';
		} else {
			document.getElementById($value).innerHTML = '[-]';
		}
	}
</script>
