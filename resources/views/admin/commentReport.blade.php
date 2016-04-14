<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Comment ID</th>
            <th>Comment</th>
            <th>Number of report</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($commentreports as $report)
            <tr>
                <td>{{ $report-> id }}</td>
                <td>{{ $report->comment }}</td>
                <td>{{ $report->count }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>