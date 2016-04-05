@extends('app')

@section('content')

<div>
	<div>
		<div class="col-md-10 col-md-offset-1">
			<div class="header">
				<h1><span class="first-letter">C</span>REATE</h1>
			</div>
			<form method="POST" action="/books" enctype="multipart/form-data">
				<div class="col-md-8">
					<div class="form-group">
						<label class="h3" for="name">Title</label>
						<p>Title for this content</p>
						<input class="form-control" type="text" name="name" ng-model="name">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="h3" for="category">Category</label>
						<p>Category is permanent.</p>
						<select class="form-control" name="category">
							<option>Novel</option>
							<option>Comic</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="h3" for="description">Description</label>
					<p>Short description about this book</p>
					<textarea id="description" rows="6" class="form-control" name="description" ng-model="description"></textarea>
				</div>

				<div class="form-group">
					{!! Form::label('image', 'Choose an image') !!}
					{!! Form::file('image') !!}
				</div>

				<div class="form-group">
					<br/>
					<div align="right">
						<button type="submit" class="btn btn-default">Submit</button>
					</div>
				</div>

				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
		</div>
	</div>
</div>
@stop
