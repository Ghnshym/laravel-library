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
    @include('user.nav');

    <div class="container mt-5">
        <h2>Book Details</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Quantity</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>{{ $book->quantity }}</td>
                    <td>{{ $book->description }}</td>
                </tr>
            </tbody>
        </table>
        <h3><center>Borrow Book Now :</center></h3>
        <form method="post" action="{{ route('user.book.order', [$book->id]) }}">
            @csrf
        
            <div class="form-group">
                <label for="due_date">Due Date</label>
                <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" min="{{ date('Y-m-d') }}">
                @error('due_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        
            <div class="form-group">
                <label for="returned_at">Returned At</label>
                <input type="date" class="form-control @error('returned_at') is-invalid @enderror" id="returned_at" name="returned_at" min="{{ date('Y-m-d') }}">
                @error('returned_at')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
        @endif
    </div>

    <!-- Add Bootstrap JS and jQuery CDN just before the closing </body> tag -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>