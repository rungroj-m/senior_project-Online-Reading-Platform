@extends('app')

@section('content')

<div  class="container">
	<div class="row">
		<div class="col-md-2">
		</div>

		<div class="col-md-8">
			<h1>{{ $content_chap->name }}</h1>
			<br/>
			<p>{{ $content_chap->content }}</p>
		</div>

		<div class="col-md-2">
		</div>
	</div>
</div>

@stop