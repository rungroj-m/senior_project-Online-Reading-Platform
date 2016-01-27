@extends('app')

<style>
	.container {
		text-align: center;
		vertical-align: middle;
		margin-top: 130px;
	}
</style>

@section('content')
<body>
	<div class="container">
		<div class="content">
			<div class="title">
				<span class="glyphicon glyphicon-book"></span>
				READISM
			</div>
			<div class="quote">Read. Write. Create. In one place.
				<a href="/books" role="button" class="btn btn-default"><div class="quote">Go to Creator's Hub</div></a>
			</div>
		</div>
	</div>
</body>
@endsection