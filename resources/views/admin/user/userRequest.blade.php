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
                @if($user->isRequestComicCreator())
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><a href="/user/{{$user->id}}">{{ $user->username }}</a></td>
                        <td>
                            <a href="/admin/user/{{ $user->id }}/accept" class="btn btn-info pull-left" style="margin-right: 3px;">Accept</a>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
