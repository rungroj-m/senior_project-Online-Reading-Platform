@extends('app')

@section('content')
<div>
	<div>
		<div class="col-md-10 col-md-offset-1">
			<div class="header">
				<h1><span style="color: teal; font-weight: bold">C</span>REATE</h1>
			</div>
			<form method="POST" action="/books">
				<div class="form-group">
					<label class="h3" for="name">Title</label>
					<input class="form-control" type="text" name="name" ng-model="name">
				</div>
				<div class="form-group">
					<label class="h3" for="description">Description</label>
					<p>Short description about this book</p>
					<textarea rows="5" class="form-control" name="description" ng-model="description"></textarea>
				</div>
				<div class="form-group">
					<label class="h3" for="category">Category</label>
					<p>Category is permanent.</p>
					<select class="form-control" name="category">
						<option>Novel</option>
						<option>Comic</option>
					</select>
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
