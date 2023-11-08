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

    <div class="container mt-5">
        <center>
            <h1>Your Order History</h1>
        </center>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Order No.</th>
                    <th>User Name</th>
                    <th>Book Title</th>
                    <th>Late Fine</th>
                    <th>Due date</th>
                    <th>Returned At</th>
                    <th>Return Status</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                <?php $sno = ($lendings->currentPage() - 1) * $lendings->perPage() + 1; ?>
                @foreach ($lendings as $lending)
                    <tr>
                        <td>{{ $sno++ }}</td>
                        <td>{{ $lending->user->name }}</td>
                        <td>{{ $lending->book->title }}</td>
                        <td>{{ $lending->late_fine }}</td>
                        <td>{{ $lending->due_date }}</td>
                        <td>{{ $lending->returned_at }}</td>
                        <td>{{ $lending->return_status }}</td>
                        <td>{{ $lending->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            <ul class="pagination">
                <li class="page-item {{ ($lendings->currentPage() == 1) ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $lendings->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                @for ($i = 1; $i <= $lendings->lastPage(); $i++)
                    <li class="page-item {{ ($lendings->currentPage() == $i) ? 'active' : '' }}">
                        <a class="page-link" href="{{ $lendings->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item {{ ($lendings->currentPage() == $lendings->lastPage()) ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $lendings->nextPageUrl() }}" aria-label="Next">
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
