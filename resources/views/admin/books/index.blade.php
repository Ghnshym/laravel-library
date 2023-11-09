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
    <!-- Bootstrap Navbar -->
    @include('admin.nav');

    <div class="container">
        <h2>All Book List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S no.</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Description</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php $sno = 1; ?>
                @foreach($books as $book)
                <tr>
                    <td>{{ $sno++ }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>{{ $book->price }}</td>
                    <td>{{ $book->quantity }}</td>
                    <td>{{ $book->description }}</td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('book.edit', ['id' => $book->id]) }}">Update</a>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('book.delete', ['id' => $book->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="d-flex justify-content-center">
            <ul class="pagination">
                <li class="page-item {{ ($books->currentPage() == 1) ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $books->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                @for ($i = 1; $i <= $books->lastPage(); $i++)
                    <li class="page-item {{ ($books->currentPage() == $i) ? 'active' : '' }}">
                        <a class="page-link" href="{{ $books->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item {{ ($books->currentPage() == $books->lastPage()) ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $books->nextPageUrl() }}" aria-label="Next">
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
