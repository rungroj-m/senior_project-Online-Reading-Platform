@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
		<h1>Edit Donation No. {{$donation->id}}</h1>
    <h4>Owner: {{!! $donation->user->username !!}}</h4>
    <h4>Book: {{!! $donation->book->name !!}}</h4>
		<hr/>
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		{!! Form::open(['method' => 'PUT','route' => ['plead-edit', $plead->id]]) !!}
			<div class="form-group">
				{!! Form::label('Amount','Amount: ') !!}
				{!! Form::text('amount', $plead->amount, ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('Confirmed','Confirmed: ') !!}
				{!! Form::text('confirmed', $plead->confirmed, ['class'=>'form-control']) !!}
			</div>

		<div class="form-group">
			{!! Form::submit('Edit',['class' => 'btn btn-default']) !!}
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		{!! Form::close() !!}
		</div>
	</div>
</div>

@stop
