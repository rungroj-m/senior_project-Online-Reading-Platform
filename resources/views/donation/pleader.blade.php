@extends('app')

@section('title') Users @stop

@section('content')

<div class="col-lg-10 col-lg-offset-1">

    <h1><i class="fa fa-users"></i>Pleader of Donation No. {{!! $donation->id !!}}</h1>
    <h4>Goal Amount: {{!! $donation->goal_amount !!}}</h4>
    <p>{{!! $donation->description !!}}</p>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>No.</th>
                    <th>Pleader Username</th>
                    <th>Amount</th>
                    <th>Confirmed</th>
                    <th>Date/Time Added</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($pleaders as $pleader)
                <tr>
                    <td>{{ $pleader->id }}</td>
                    <td>{{ $pleader->user->username }}</td>
                    <td>{{ $pleader->amount }}</td>
                    <td>{{ $pleader->confirmed }}</td>
                    <td>{{ $donation->created_at->format('F d, Y h:ia') }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="/donation/plead/create" class="btn btn-success">Add Pleader</a>

</div>

@stop
