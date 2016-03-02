@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
		{!! Form::open(['method' => 'POST','files'=>true,'route' => ['profile/image/save']]) !!}

			<div class="form-group">
				{!! Form::label('title', 'Title:') !!}
				{!! Form::text('title', null, ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('description', 'Description:') !!}
				{!! Form::textarea('description', null, ['class'=>'form-control', 'rows'=>5] ) !!}
			</div>

			<div class="form-group">
				{!! Form::label('image', 'Choose an image') !!}
				{!! Form::file('image') !!}
			</div>

			<div class="form-group">
			{!! Form::submit('Save',['class' => 'btn btn-default']) !!}
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		{!! Form::close() !!}
		</div>
	</div>
</div>

@stop