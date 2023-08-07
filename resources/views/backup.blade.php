<!DOCTYPE html>
<html>
<head>
    <title>Backup SQL Server Database</title>
</head>
<body>
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <form action="{{ route('backup.sqlserver') }}" method="post">
        @csrf
        <button type="submit">Backup SQL Server Database</button>
    </form>
</body>
</html>
