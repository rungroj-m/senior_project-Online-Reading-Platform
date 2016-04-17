@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Create new Pledging</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('donation/plead/create') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="pleader" value="{{ $user->id }}">

            <div class="form-group">
							<label class="col-md-4 control-label">Donation</label>
							<div class="col-md-6">
                @foreach ($donations as $donation)
                  <input type="radio" name="donation" value="{{ $donation->id }}"> {{ $donation->description }}<br>
                @endforeach
							</div>
						</div>

            <div class="form-group">
							<label class="col-md-4 control-label">Amount</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="amount" value="{{ old('amount') }}">
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
