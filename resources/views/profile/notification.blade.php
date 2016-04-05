@extends('app')

@section('content')

<div class="col-lg-10 col-lg-offset-1">

    <h1><i class="fa fa-users"></i> Notification </h1>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Notification ID</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>URL</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($notifications as $noti)
                <tr>
                    <td>{{$noti->id}}</td>
                    <td>
                      @if (true)
                        {{$noti->extra->bookname}}
                      @else

                      @endif
                    </td>
                    <td>
                    </td>
                    <td>
                      <a href="{{ $noti->url }}" class="btn btn-info pull-left" style="margin-right: 3px;">
                        {{ $noti->url }}
                      </a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@stop
