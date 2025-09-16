<!DOCTYPE html>
<html>
<head>
    <title>Admin Action Logs</title>
</head>
<body>
    <h1>Admin Action Logs</h1>

    @foreach($logs as $log)
        <p>
            @if ($log->causer)
                **{{ $log->causer->name }}**
            @else
                **System**
            @endif

            **{{ $log->description }}**

            @if ($log->subject)
                on **{{ class_basename($log->subject_type) }}** with ID **{{ $log->subject_id }}**
            @endif

            at **{{ $log->created_at->format('Y-m-d H:i:s') }}**
        </p>
        <hr>
    @endforeach

</body>
</html>