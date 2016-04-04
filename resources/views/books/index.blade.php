@extends('app')

@section('content')
<body>
	<div>
		<div class="col-md-10 col-md-offset-1">
			<div class="header">
				<h1><span class="first-letter">N</span>OVEL</h1>
			</div>
			@foreach($books as $b)
				<div class="thumbnail content" style="width: 200px; height: 200px">
					<h2>{{$b->name}}</h2>
					<h4>{{$b->user->username}}</h4>
				</div>
			@endforeach
		</div>
	</div>
</body>
@stop
