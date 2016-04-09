@extends('app')

@section('title') Users @stop

@section('content')

<div class="col-lg-10 col-lg-offset-1">

    <h1><i class="fa fa-users"></i> Donation</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>No.</th>
                    <th>Related Book</th>
                    <th>Goal Amount</th>
                    <th>Active</th>
                    <th>Pleaders</th>
                    <th>Date/Time Added</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($donations as $donation)
                <tr>
                    <td>{{ $donation->id }}</td>
                    <td>{{ $donation->book->name }}</td>
                    <td>{{ $donation->goal_amount }}</td>
                    <td>{{ $donation->active }}</td>
                    <td>
                      <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Amount</th>
                                <th>Confirmed</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($donation->plead as $pleader)
                          <tr>
                            <td>{{ $pleader->user->username }}</td>
                            <td>{{ $pleader->amount }}</td>
                            <td>{{ $pleader->confirmed }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                    <td>{{ $donation->created_at->format('F d, Y h:ia') }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="/donation/create" class="btn btn-success">Add User</a>

</div>

@stop
