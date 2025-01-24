<!DOCTYPE html>
<html>
<head>
    <title>Interview Invitation</title>
</head>
<body>
    <p>Dear {{ $ApplicantName }},</p>

    <p>
        We are pleased to invite you to an interview for the position you applied for. Please find the details below:
    </p>

    <p>
        <strong>Interview Type:</strong> {{ $Type }}<br>
        <strong>Link/Location:</strong> {{ $Link }}/Location<br>
        <strong>Interview Date:</strong> {{ \Carbon\Carbon::parse($InterviewDate)->format('F d, Y') }}
    </p>

    <p>
        <strong>Available Time Slots:</strong><br>
        1. {{ $FirstTimeSlot ?? 'N/A' }}<br>
        2. {{ $SecondTimeSlot ?? 'N/A' }}<br>
        3. {{ $ThirdTimeSlot ?? 'N/A' }}
    </p>

    <p>
        <strong>Additional Details:</strong><br>
        {{ $Description }}
    </p>

    <p>
        Please confirm your availability by responding to this email at your earliest convenience.
    </p>

    <p>
        Best regards,<br>
        The Hiring Team
    </p>
</body>
</html>
