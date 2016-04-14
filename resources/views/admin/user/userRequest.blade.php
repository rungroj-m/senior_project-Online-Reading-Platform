@extends('app')

@section('title') Users @stop

@section('content')

<div class="col-lg-10 col-lg-offset-1">

    <h1><i class="fa fa-users"></i> User Request <a href="/logout" class="btn btn-default pull-right">Logout</a></h1>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Option</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>
                        <a href="/admin/user/{{ $user->id }}/accept" class="btn btn-info pull-left" style="margin-right: 3px;">Accept</a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>

@stop
