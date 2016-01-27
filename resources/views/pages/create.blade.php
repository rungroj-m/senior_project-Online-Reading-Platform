@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h1>New contentInfo</h1>
			<hr/>
			<form method="POST" action="/books">
				<div class="form-group">
					<label>Name</label>
					<input class="form-control" type="text" name="name" ng-model="name">
				</div>
				<div class="form-group">
					{!! Form::label('description','Description:') !!}
					{!! Form::textarea('description',null,['class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('userRating','UserRating:') !!}
					{!! Form::text('userRating',null,['class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('criticRating','CriticRating:') !!}
					{!! Form::text('criticRating',null,['class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('category','Category:') !!}
					{!! Form::textarea('category',null,['class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::submit('Add new content',['class' => 'btn btn-primary form-control']) !!}
				</div>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
		</div>
		<div class="col-md-6">
			<h1>@{{name}}</h1>
		</div>
	</div>
</div>
@stop
