<!DOCTYPE html>
<html>
<head>
    <title>Out of Stock Books Notification</title>
</head>
<body>
    <p>Hello Manager,</p>

    <p>The following books are currently out of stock:</p>

    
        @foreach($outOfStockBooks as $book)
        <ul>
            <li>Book Title: {{ $book->title }}</li>
            <li>Book Author:  {{ $book->author }}</li>
            <li> (ISBN: {{ $book->isbn }})</li>
        </ul>
        @endforeach
    

    <p>Please take necessary actions to restock these books.</p>

    <p>Thank you.</p>
</body>
</html>
