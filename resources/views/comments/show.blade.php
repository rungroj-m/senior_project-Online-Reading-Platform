<div class="thumbnail">
	<a href="#collapseComment{{$c->id}}" data-toggle="collapse" aria-controls="collapseComment" id ={{$c->id}}  onclick="commentaction({{$c->id}});">[-]</a>
	<div class="collapse in" id="collapseComment{{$c->id}}">
		<div class="caption">
			<p>{{$c->comment}}</p>
			<div style="text-align: right">
				<p>- {{$c->user->username}} |
					{{$c->rating}}
					<a href="/books/{{$id}}/content/comment/{{$c->id}}/up" class="first-letter" href="">+</a>
					<a href="/books/{{$id}}/content/comment/{{$c->id}}/down" class="first-letter">-</a>
					<a href="#collapseReply{{$c->id}}" data-toggle="collapse" aria-controls="collapseReply" class="first-letter">reply</a>
					<a href="#" class="first-letter" data-toggle="modal" data-target="#commentreport{{$c->id}}">report</a>
				@if(Auth::user()->isAdmin() || $book->isOwner() || $c->isOwner())
						<a href="#" class="first-letter" data-toggle="modal" data-target="#commentdelete{{$c->id}}">delete</a>
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

<!-- MODAL -->
<div id="commentreport{{$c->id}}" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Report Comment</h4>
			</div>
			<div class="modal-body">
				<p>Report this comment?</p>
			</div>
			{!! Form::open([
				'method' => 'GET',
				'route' => ['commentreport', $id, $c->id]
			]) !!}
			<div class="modal-footer">
				<button type="button" class="btn btn-default inline" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-warning inline">Report</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

<!-- MODAL -->
<div id="commentdelete{{$c->id}}" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Delete Comment</h4>
			</div>
			<div class="modal-body">
				<p>Delete this comment?</p>
			</div>
			{!! Form::open([
				'method' => 'DELETE',
				'route' => ['deletecomment', $id, $c->id]
			]) !!}
			<div class="modal-footer">
				<button type="button" class="btn btn-default inline" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-warning inline">Delete</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

<script>
	var hidden = false;
	function commentaction($value) {
		hidden = !hidden;
		if(document.getElementById($value).innerHTML == '[-]') {
			document.getElementById($value).innerHTML = '[+]';
		} else {
			document.getElementById($value).innerHTML = '[-]';
		}
	}
</script>
