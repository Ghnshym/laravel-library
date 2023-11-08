<!DOCTYPE html>
<html>
<head>
    <title>Fine Notification</title>
</head>
<body>
    <h1>Fine Notification</h1>
    
    <p>Dear {{ $lending->user->name }},</p>

    <p>Your book with the following details:</p>

    <ul>
        <li>Title: {{ $lending->book->title }}</li>
        <li>Author: {{ $lending->book->author }}</li>
        <li>Due Date: {{ $lending->due_date }}</li>
        <li>Returned At: {{ $lending->returned_at }}</li>
        <li>Late Fine: {{ $lending->late_fine }} Rupees</li>
    </ul>

    <p>Is overdue, and a fine has been calculated.</p>

    <p>Please make the necessary payment to clear the fine.</p>

    <p>Thank you for using our library services.</p>

    <p>Sincerely,<br>Your Library Team</p>
</body>
</html>
