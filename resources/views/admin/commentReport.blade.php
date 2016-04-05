@extends('app')

@section('title') Users @stop

@section('content')

<div class="col-lg-10 col-lg-offset-1">

    <h1><i class="fa fa-users"></i> Book Report <a href="/logout" class="btn btn-default pull-right">Logout</a></h1>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Comment ID</th>
                    <th>Comment</th>
                    <th>Number of report</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($commentReport as $report)
                <tr>
                    <td>{{ $report-> id }}</td>
                    <td>{{ $report->comment }}</td>
                    <td>{{ $report->count }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>

@stop
