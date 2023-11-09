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

    <div class="container mt-3">
      <div class="d-flex justify-content-center">
          <form action="{{ route('admin.search') }}" method="GET">
              @csrf
              <div class="form-row">
                  <div class="col-md-8">
                      <input type="text" name="query" class="form-control" placeholder="Search Title or Author" value="{{ old('query') }}">
                  </div>
                  <div class="col-md-4">
                      <button type="submit" class="btn btn-primary">Search</button>
                  </div>
              </div>
          </form>
      </div>
      </div>
  
      <div class="container">
          <h2>All Book List</h2>
          <div class="row">
              @if (count($books) === 0)
              <center><p>Book Not Found.</p></center>
              @endif
              @foreach($books as $book)
              <div class="col-md-4 mb-4">
                  <div class="card">
                      <img src="https://source.unsplash.com/300x200/?book,{{ $book->title}}" class="card-img-top" alt="Random Image" style="height:100px;">
                      <div class="card-body">
                          <h5 class="card-title">{{ $book->title }}</h5>
                          <p class="card-text">Author: {{ $book->author }}</p>
                          <p class="card-text">Price: {{ $book->price }}</p>
                      </div>
                  </div>
              </div>
              @endforeach
          </div>
      </div>

    <!-- Add Bootstrap JS and jQuery CDN just before the closing </body> tag -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
