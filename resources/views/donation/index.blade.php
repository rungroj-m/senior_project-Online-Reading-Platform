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
                    <th>Description</th>
                    <th>Date/Time Added</th>
                    <th>Edit</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($donations as $donation)
                <tr>
                    <td>{{ $donation->id }}</td>
                    <td>{{ $donation->book->name }}</td>
                    <td>{{ $donation->goal_amount }}</td>
                    <td>{{ $donation->active }}</td>
                    <td>{{ $donation->description }}</td>
                    <td>{{ $donation->created_at->format('F d, Y h:ia') }}</td>
                    <td>
                      <a href="/donation/{{ $user->id }}/edit" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="/donation/create" class="btn btn-success">Add Donation</a>

</div>

@stop
