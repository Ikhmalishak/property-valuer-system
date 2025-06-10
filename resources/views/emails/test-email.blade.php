<!DOCTYPE html>
<html>
<head>
    <title>Invoice Reminder</title>
</head>
<body>
    <p>Hi {{ $user->name }},</p>

    <p>This is a reminder that your invoice <strong>#{{ $invoice->invoice_number }}</strong> of <strong>RM{{ $invoice->amount }}</strong> is due on <strong>{{ \Carbon\Carbon::parse($invoice->due_date)->toFormattedDateString() }}</strong>.</p>

    <p>Please make your payment at your earliest convenience.</p>

    <p>Thank you,<br>Property Valuer Team</p>
</body>
</html>
