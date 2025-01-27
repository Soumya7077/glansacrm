<!DOCTYPE html>
<html>
<head>
    <title>Offer Letter</title>
</head>
<body>
    <h1>Congratulations {{ $name }}!</h1>
    <p>We are pleased to offer you the position of <strong>{{ $designation }}</strong> at <strong>{{ $organization }}</strong>.</p>
    <p><strong>Salary Offered:</strong> {{ $salary }}</p>
    <p><strong>Joining Date:</strong> {{ $joining_date }}</p>
    <p><strong>Shift:</strong> {{ $shift }}</p>
    <p><strong>Benefits:</strong> {{ $benefits }}</p>
    <p><strong>Remarks:</strong> {{ $remarks }}</p>
    <p>Attached is your official offer letter for your reference.</p>
    <p>Best regards,<br>The {{ $organization }} Team</p>
</body>
</html>
