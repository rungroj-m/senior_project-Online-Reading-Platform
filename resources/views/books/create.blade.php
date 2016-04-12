@extends('app')

@section('content')

<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="header">
			<h1><span class="first-letter">C</span>REATE</h1>
		</div>
		<form method="POST" action="/books" enctype="multipart/form-data">
			<div class="col-md-8">
				<div class="form-group">
					<label class="h3" for="name">Title</label>
					<p>Title for this new book</p>
					<input class="form-control" type="text" name="name" ng-model="name">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="h3" for="category">Category</label>
					<p>Where this book permanently belongs to</p>
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
			<div class="form-group col-md-4">
				{!! Form::label('image', 'Cover Image', ['class'=>'h3']) !!}
				<p>Cover of this book</p>
				{!! Form::file('image', ['class'=>'content']) !!}
			</div>
			<div class="form-group col-md-6">
				<label class="h3" for="tags">Tags</label><br/>
				<p>Select or add tags to this book</p>
				<div>
					<input type="checkbox" name="checkbox[]" value="Fantasy"> <span class="badge">Fantasy</span>
					<input type="checkbox" name="checkbox[]" value="Sci-Fi"> <span class="badge">Sci-Fi</span>
					<input type="checkbox" name="checkbox[]" value="Comedy"> <span class="badge">Comedy</span>
					<input type="checkbox" name="checkbox[]" value="Action"> <span class="badge">Action</span>
					<input type="checkbox" name="checkbox[]" value="Drama"> <span class="badge">Drama</span>
					<input type="checkbox" name="checkbox[]" value="MMO"> <span class="badge">MMO</span><br/>
					<input type="checkbox" name="checkbox[]" value="Male-Protagonist"> <span class="badge">Male-Protagonist</span>
					<input type="checkbox" name="checkbox[]" value="Female-Protagonist"> <span class="badge">Female-Protagonist</span><br/>
					<input type="checkbox" ng-model="checked" ng-init="checked=false"> <span class="badge">Other...</span>
					<div ng-if="checked">
						<br/>
						<p>Add custom tags, separated by a whitespace</p>
						<input class="form-control" type="text" name="tags">
					</div>
				</div>
			</div>
			<div class="form-group">
				<br/>
				<div align="right">
					<button type="submit" class="btn btn-success">Submit</button>
				</div>
			</div>

			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		</form>
	</div>
</div>

@stop