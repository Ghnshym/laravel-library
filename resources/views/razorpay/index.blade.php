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
<div class="panel panel-default">
    <div class="panel-body">
        <h1 class="text-3xl md:text-5xl font-extrabold text-center uppercase mb-12 bg-gradient-to-r from-indigo-400 via-purple-500 to-indigo-600 bg-clip-text text-transparent transform -rotate-2">Razorpay Payment Gateway</h1>
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <center>
            <form action="{{ route('razorpay.make.payment') }}" method="POST" id="razorpay-payment-form">
                @csrf 
                <input type="hidden" name="price" value="{{ request('price') }}">
                <input type="hidden" name="id" value="{{ request('id') }}">
                <!-- Add any other necessary input fields -->
            
                <script src="https://checkout.razorpay.com/v1/checkout.js"
                        data-key="{{ env('RAZORPAY_API_KEY') }}"
                        data-amount="{{ request('price') * 100 }}"
                        data-buttontext="Pay {{ request('price') }}"
                        data-id="{{ request('id') }}"
                        data-image="https://www.laravelia.com/storage/logo.png"
                        data-prefill.name="Ghanshyam"
                        data-prefill.email="bca1902113@gmail.com"
                        data-theme.color="#ff7529">
                </script>
            </form>
            
        </center>
    </div>
</div>
<!-- Add Bootstrap JS and jQuery CDN just before the closing </body> tag -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
