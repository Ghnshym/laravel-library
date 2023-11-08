<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Add Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    @include('user.nav')

    <div class="container">
        <h1>Your Notifications</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Notification No.</th>
                    <th>User Name</th>
                    <th>Book Title</th>
                    <th>Late Fine</th>
                    <th>Returned At</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php $sno = ($notifications->currentPage() - 1) * $notifications->perPage() + 1; ?>
                @foreach ($notifications as $notification)
                    <tr>
                        <td>{{ $sno++ }}</td>
                        <td>{{ $notification->user->name }}</td>
                        <td>{{ $notification->book->title }}</td>
                        <td>{{ $notification->late_fine }}</td>
                        <td>{{ $notification->returned_at }}</td>
                        <td>{{ $notification->message }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            <ul class="pagination">
                <li class="page-item {{ ($notifications->currentPage() == 1) ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $notifications->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                @for ($i = 1; $i <= $notifications->lastPage(); $i++)
                    <li class="page-item {{ ($notifications->currentPage() == $i) ? 'active' : '' }}">
                        <a class="page-link" href="{{ $notifications->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item {{ ($notifications->currentPage() == $notifications->lastPage()) ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $notifications->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Add Bootstrap JS and jQuery CDN just before the closing </body> tag -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
