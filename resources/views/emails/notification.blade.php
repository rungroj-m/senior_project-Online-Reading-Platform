<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Notification for {{ $book->name }}</h2>

<div>
    {{ $book->name }} have new chapter!!
    <a href="{{ $link }}" class="btn btn-info pull-left" style="margin-right: 3px;">
      Chapter{{ $content->chapter }}: {{ $content->name }}
    </a>
</div>

</body>
</html>
