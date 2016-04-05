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
                        @if ($noti->category->name == 'book.updatechapter')
                        {{ $noti->extra->bookname }} updated!
                      @else

                      @endif
                    </td>
                    <td>
                      {{ $noti->description }}
                    </td>
                    <td>
                      <a href="{{ $noti->url }}" class="btn btn-info pull-left" style="margin-right: 3px;">
                        Chapter{{ $noti->extra->chapter }}: {{ $noti->extra->chaptername }}
                      </a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@stop
