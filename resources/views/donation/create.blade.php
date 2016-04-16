@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Create new Donation</div>
				<div class="panel-body">
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/donation/create') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="owner" value="{{ $user->id }}">

            <div class="form-group">
							<label class="col-md-4 control-label">Book</label>
							<div class="col-md-6">
                @foreach ($books as $book)
                  <input type="radio" name="book" value="{{ $book->id }}"> {{ $book->name }}<br>
                @endforeach
							</div>
						</div>

            			<div class="form-group">
							<label class="col-md-4 control-label">Goal Amount</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="amount" value="{{ old('amount') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Description</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="description" value="{{ old('description') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Active?</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="active" value="{{ old('active') }}">
							</div>
						</div>



						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Create
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
