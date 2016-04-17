@extends('app')

@section('title') Users @stop

@section('content')

<div class="col-lg-10 col-lg-offset-1">

    <h1><i class="fa fa-users"></i>Pledger of Donation No. {!! $donation->id !!}</h1>
    <h4>Goal Amount: {!! $donation->goal_amount !!}</h4>
    <p>{!! $donation->description !!}</p>
    @if(!empty($status))
      <p>{{$status}}</p>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>No.</th>
                    <th>Pledger Username</th>
                    <th>Amount</th>
                    <th>Confirmed</th>
                    <th>Date/Time Added</th>
                    <th>Confirm</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($pleaders as $pleader)
                <tr>
                    <td>{{ $pleader->id }}</td>
                    <td>{{ $pleader->user->username }}</td>
                    <td>{{ $pleader->amount }}</td>
                    <td>{{ $pleader->confirmed }}</td>
                    <td>{{ $pleader->created_at->format('F d, Y h:ia') }}</td>
                    <td>
                      @if(!$pleader->confirmed)
                        {!! Form::open(['method' => 'PUT','route' => ['plead-confirm', $pleader->id]]) !!}
                        {!! Form::submit('Confirm',['class' => 'btn btn-default']) !!}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {!! Form::close() !!}
                      @else
                        {!! Form::open(['method' => 'PUT','route' => ['plead-unconfirm', $pleader->id]]) !!}
                        {!! Form::submit('Unconfirm',['class' => 'btn btn-default']) !!}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {!! Form::close() !!}
                      @endif
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="/donation/plead/create" class="btn btn-success">Add Pledger</a>
    <a href="/donation/{{$donation->id}}/edit" class="btn btn-success">Edit Donation</a>

</div>

@stop
