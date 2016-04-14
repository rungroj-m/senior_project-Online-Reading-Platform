@extends('app')

@section('title') Users @stop

@section('content')

<div class="col-lg-10 col-lg-offset-1">
    <div class="pull-right">
        <form action="/admin">
            <button type="submit" class="btn btn-success">Admin DashBoard</button>
        </form>
    </div>
    <h1><i class="fa fa-users"></i> User Administration </h1>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Allow to Create Comic?</th>
                    <th>Email Notification</th>
                    <th>Facebook Notification</th>
                    <th>Date/Time Added</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->firstName }}</td>
                    <td>{{ $user->lastName }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    @if($user->userLevel==0)
                      <td>Standard</td>
                    @elseif($user->userLevel==1)
                      <td>Critic</td>
                    @else
                      <td>Admin</td>
                    @endif
                    @if($user->imageLevel==0)
                      <td>Not Allow</td>
                    @else
                      <td>Allow</td>
                    @endif
                    @if($user->email_noti)
                      <td>Yes</td>
                    @else
                      <td>No</td>
                    @endif
                    @if($user->facebook_noti)
                      <td>Yes</td>
                    @else
                      <td>No</td>
                    @endif
                    <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                    <td>
                        <a href="/admin/user/{{ $user->id }}/edit" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                        {!! Form::open(['url' => '/admin/user/' . $user->userKey, 'method' => 'DELETE']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger'])!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="/admin/user/create" class="btn btn-success">Add User</a>

</div>

@stop
