@extends('app')

@section('content')

<body>
	<div>
		<div class="col-md-10 col-md-offset-1">
			<h1>Add {{$bookName}} Chapter</h1>
			{!! Form::open(['url' => URL::to("/books/$bookId/content")]) !!}
			<div class="form-group">
				{!! Form::label('name','Name:') !!}
				{!! Form::text('name',null,['class'=>'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('content','Content:') !!}
				{!! Form::textarea('content',null,['class'=>'form-control']) !!}
			</div>

			<div class="error"><font color="red">{{ $errors->first() }}</font></div>
			<div class="form-group">
				{!! Form::label('chapter','Chapter:') !!}
				{!! Form::text('chapter',null,['class'=>'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::submit('Add Chapter',['class' => 'btn btn-default']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</body>

@stop
