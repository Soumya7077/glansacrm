<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>{{ $details['message'] ?? 'Email Content' }}</h2>

    <!-- Render the HTML table -->
    {!! $details['table'] ?? '' !!}
</body>
</html>
