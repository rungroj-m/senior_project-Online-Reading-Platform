<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Comment ID</th>
            <th>Comment</th>
            <th>From Book</th>
            <th>Number of report</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($commentreports as $report)
            <tr>
                <td>{{ $report-> id }}</td>
                <td>{{ $report->comment }}</td>
                @if(\App\Models\Comment::find($report -> id)->book->category == 'Novel')
                    <td><a href="/books/{{\App\Models\Comment::find($report -> id)->book->id}}">{{ \App\Models\Comment::find($report -> id)->book->name }}</a></td>
                @else
                    <td><a href="/comics/{{\App\Models\Comment::find($report -> id)->book->id}}">{{ \App\Models\Comment::find($report -> id)->book->name }}</a></td>
                @endif
                <td>{{ $report->count }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>