<!DOCTYPE html>
<html>
<head>
    <title>Interview Invitation</title>
</head>
<body>
    <p>Dear {{ $ApplicantName }},</p>
    <p>We are pleased to invite you to an interview for the position of {{ $JobTitle }}.</p>
    <p>Interview Date: {{ date('d-m-Y', strtotime($InterviewDate)) }}</p>

    <p>Available Time Slots:</p>
    <ul>
        <li>{{ date('h:i A', strtotime($TimeSlots['FirstTimeSlot'])) }}</li>
        @if (!empty($TimeSlots['SecondTimeSlot']))
            <li>{{ date('h:i A', strtotime($TimeSlots['SecondTimeSlot'])) }}</li>
        @endif
        @if (!empty($TimeSlots['ThirdTimeSlot']))
            <li>{{ date('h:i A', strtotime($TimeSlots['ThirdTimeSlot'])) }}</li>
        @endif
    </ul>

    <p>Type: {{ $Type }}</p>
    <p>Location/Link: {{ $Link }}</p>
    <p>Description: {{ $Description }}</p>

    <p>We look forward to your participation.</p>

    <p>Best regards,<br>Recruitment Team</p>
</body>
</html>
