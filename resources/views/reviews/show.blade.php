<div class="thumbnail">
	<a href="#collapseReview{{$r->id}}" data-toggle="collapse" aria-controls="collapseComment" id ={{$r->id}}  onclick="action({{$r->id}});">[-]</a>
	<div class="collapse in" id="collapseReview{{$r->id}}">
		<div class="caption">
			<p>{{$r->review}}</p>
			<div style="text-align: right">
				<p>- {{$r->user->username}} |
					{{$r->rating}}
					<a href="/books/{{$book->id}}/content/review/{{$r->id}}/up" class="first-letter" href="">+</a>
					<a href="/books/{{$book->id}}/content/review/{{$r->id}}/down" class="first-letter">-</a>
				@if(Auth::user()->isAdmin() || $book->isOwner() || $r->isOwner())
					<a href="#" class="first-letter" data-toggle="modal" data-target="#myModal{{$r->id}}">delete</a>
				@endif
				</p>
			</div>
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

<!-- MODAL -->
<div id="myModal{{$r->id}}" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Delete Review</h4>
			</div>
			<div class="modal-body">
				<p>Delete this review?</p>
			</div>
			{!! Form::open([
				'method' => 'DELETE',
				'route' => ['deletereview', $id, $r->id]
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
	function action($value) {
		hidden = !hidden;
		if(document.getElementById($value).innerHTML == '[-]') {
			document.getElementById($value).innerHTML = '[+]';
		} else {
			document.getElementById($value).innerHTML = '[-]';
		}
	}
</script>
