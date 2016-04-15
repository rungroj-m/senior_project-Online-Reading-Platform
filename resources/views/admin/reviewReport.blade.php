<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Review ID</th>
            <th>Review</th>
            <th>From Book</th>
            <th>Number of report</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($reviewreports as $report)
            <tr>
                <td>{{ $report-> id }}</td>
                <td>{{ $report->review }}</td>
                @if(\App\Models\Review::find($report -> id)->book->category == 'Novel')
                    <td><a href="/books/{{\App\Models\Review::find($report -> id)->book->id}}">{{ \App\Models\Review::find($report -> id)->book->name }}</a></td>
                @else
                    <td><a href="/comics/{{\App\Models\Review::find($report -> id)->book->id}}">{{ \App\Models\Review::find($report -> id)->book->name }}</a></td>
                @endif
                <td>{{ $report->count }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>