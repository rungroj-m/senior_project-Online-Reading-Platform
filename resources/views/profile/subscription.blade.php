@extends('app')

@section('content')

<div class="col-lg-10 col-lg-offset-1">

    <h1><i class="fa fa-users"></i> Subscription </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Book ID</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subscribes as $subscribe)
                <tr>
                    <td>
                      <a href="/book/{{ $subscribe->book_id }}" class="btn btn-info pull-left" style="margin-right: 3px;">
                        {{ $subscribe->book_id }}
                      </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop
