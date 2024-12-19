<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Account</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }
        h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
        }
        p {
            color: #555;
        }
        .btn {
            padding: 10px 20px;
            margin: 10px 0;
            border-radius: 5px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="container">
        @if(Auth::check())
            <h1>Welcome Back, {{ Auth::user()->name }}</h1>
            <p>You are already logged in.</p>
            <a href="{{ route('home') }}" class="btn btn-success">Go to Dashboard</a>
        @else
            <h1>Don't have an account?</h1>
            <p>Register now to get started!</p>
            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
            <p>Already have an account?</p>
            <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
        @endif
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
