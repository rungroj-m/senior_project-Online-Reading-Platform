@extends('app')

@section('content')
<div>
	<div class="row">
		<div class="col-md-6">
		<h1>Edit Donation No. {{$donation->id}}</h1>
    <h4>Owner: {!! $donation->user->username !!}</h4>
    <h4>Book: {!! $donation->book->name !!}</h4>
		<hr/>
		{!! Form::open(['method' => 'PUT','route' => ['donation-edit', $donation->id]]) !!}
			<div class="form-group">
				{!! Form::label('Amount','Amount: ') !!}
				{!! Form::text('amount', $donation->goal_amount, ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('Description','Description: ') !!}
				{!! Form::text('description', $donation->description, ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('Active','Active:') !!}
				{!! Form::checkbox('active', 1, $donation->active) !!}
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
