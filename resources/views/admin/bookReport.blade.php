<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Book ID</th>
                <th>Book Name</th>
                <th>Category</th>
                <th>Number of report</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($bookreports as $report)
            <tr>
                <td>{{ $report->book_id }}</td>
                @if($report->category == 'Novel')
                    <td><a href="/books/{{$report->book_id}}">{{ $report->name }}</a></td>
                @else
                    <td><a href="/comics/{{$report->book_id}}">{{ $report->name }}</a></td>
                @endif
                    {{--<td>{{ $report->name }}</td>--}}
                <td>{{ $report->category }}</td>
                <td>{{ $report->count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>