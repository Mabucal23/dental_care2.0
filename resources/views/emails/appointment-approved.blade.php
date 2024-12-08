<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Approved</title>
</head>
<body>
    <h1>Dear {{ $appointment->first_name }} {{ $appointment->last_name }},</h1>
    <p>We are pleased to inform you that your appointment scheduled for {{ $appointment->appointment_date }} has been approved.</p>
    <p>Thank you for choosing Dental Care. We look forward to seeing you!</p>
    <p>Best Regards,<br>Dental Care Team</p>
</body>
</html>
