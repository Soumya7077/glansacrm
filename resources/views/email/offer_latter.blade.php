<!DOCTYPE html>
<html>
<head>
    <title>Offer Letter</title>
</head>
<body>
    <h1>Dear {{ $name }},</h1>
    <p>Congratulations! We are excited to offer you the position of {{ $designation }} at {{ $organization }}.</p>
    <p>Your salary will be <strong>Rs.{{ $salary }}</strong>, and your joining date is set for {{ $joining_date }}.</p>
    <p>Shift: {{ $shift }}</p>
    @if($benefits)
        <p>Benefits: {{ $benefits }}</p>
    @endif
    @if($remarks)
        <p>Remarks: {{ $remarks }}</p>
    @endif
    <br>
    <p>We look forward to welcoming you to our team!</p>
    <p>Sincerely,</p>
    <p><strong>{{ $organization }}</strong></p>
</body>
</html>
