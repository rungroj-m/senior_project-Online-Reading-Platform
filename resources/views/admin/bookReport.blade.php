@extends('app')

@section('title') Users @stop

@section('content')

<div class="col-lg-10 col-lg-offset-1">

    <h1><i class="fa fa-users"></i> Book Report <a href="/logout" class="btn btn-default pull-right">Logout</a></h1>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Book Name</th>
                    <th>Number of report</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($bookReport as $report)
                <tr>
                    <td>{{ $report->book_id }}</td>
                    <td>{{ $report->name }}</td>
                    <td>{{ $report->count }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>

@stop
