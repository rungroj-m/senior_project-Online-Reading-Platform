@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h1>Create New Book</h1>
			<hr/>
			<form method="POST" action="/books">
				<div class="form-group">
					<label class="h4" for="name">Name</label>
					<input class="form-control" type="text" name="name" ng-model="name">
				</div>
				<div class="form-group">
					<label class="h4" for="description">Description</label>
					<p>Short description about this book</p>
					<textarea class="form-control" name="description" ng-model="description"></textarea>
				</div>
				<div class="form-group">
					<label class="h4" for="category">Category</label>
					<p>Category is permanent.</p>
					<select class="form-control" name="category" ng-model="category">
						<option>Novel</option>
						<option>Comic</option>
					</select>
				</div>
				<div class="form-group">
					{!! Form::submit('Add new content',['class' => 'btn btn-primary form-control']) !!}
				</div>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
		</div>
		<div class="col-md-6">
			<h1 class="word-wrap">@{{name}}</h1>
			<p class="word-wrap">@{{description}}</p>
			<h3>@{{category}}</h3>
		</div>
	</div>
</div>
@stop
