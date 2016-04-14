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
					{!! Form::open([
						'method' => 'DELETE',
						'route' => ['deletecomment', $id, $c->id]
					]) !!}
					{!! Form::submit('delete', ['class' => 'btn btn-default']) !!}
					{!! Form::close() !!}
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
