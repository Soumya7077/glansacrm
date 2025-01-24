<!DOCTYPE html>
<html>
<head>
    <title>Interview Invitation</title>
</head>
<body>
    <h2>Dear {{ $name }},</h2>
    <p>You are invited for an interview. Below are the details:</p>
    <ul>
        <li><strong>Interview Date:</strong> {{ $interviewDate }}</li>
        <li><strong>Time Slots:</strong> {{ implode(', ', $timeSlots) }}</li>
        <li><strong>Mode:</strong> {{ $mode }}</li>
        <li><strong>Location/Virtual Link:</strong> {{ $location }}</li>
        <li><strong>Description:</strong> {{ $description }}</li>
    </ul>
    <p>Best regards,<br>Your Recruitment Team</p>
</body>
</html>
