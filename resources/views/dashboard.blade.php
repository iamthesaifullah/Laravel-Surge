<!DOCTYPE html>
<html>
<head>
    <title>Surge Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 2rem; }
        h1 { color: #333; }
        .status { margin-top: 1rem; }
        .status p { font-size: 1.1rem; }
    </style>
</head>
<body>
    <h1>Surge Dashboard</h1>
    <div class="status">
        @if ($status['running'])
            <p><strong>Status:</strong> <span style="color: green;">Running</span></p>
            <p><strong>Worker PIDs:</strong> {{ implode(', ', $status['pids']) }}</p>
        @else
            <p><strong>Status:</strong> <span style="color: red;">Stopped</span></p>
        @endif
    </div>
    <div class="info">
        <p>You can manage Surge using Artisan commands:</p>
        <ul>
            <li><code>php artisan surge:start</code> - Start worker processes.</li>
            <li><code>php artisan surge:stop</code> - Stop all workers.</li>
            <li><code>php artisan surge:restart</code> - Restart the workers.</li>
            <li><code>php artisan surge:status</code> - Check worker status.</li>
        </ul>
    </div>
</body>
</html>
