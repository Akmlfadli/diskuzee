<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f4f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 600px;
            padding: 30px;
        }
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-control, .form-floating {
            border-radius: 10px;
            box-shadow: none;
        }
        .form-floating label {
            color: #6c757d;
        }
        .btn-primary {
            background-color: #0069d9;
            border-color: #0062cc;
            border-radius: 10px;
            padding: 10px 20px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .form-floating textarea {
            border-radius: 10px;
            box-shadow: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">Report a Post</h2>
            <form action="/reportadd" method="GET">
                <!-- Hidden Inputs for UUID, Name, Profile, Title, and Description -->
                <div class="mb-3" style="display: none;">
                    <input type="text" class="form-control" name="uuid" value="{{ $uuid }}">
                    <input type="text" class="form-control" name="name" value="{{ $name }}">
                    <input type="text" class="form-control" name="profile" value="{{ $profile }}">
                    <input type="text" class="form-control" name="title" value="{{ $title }}">
                    <input type="text" class="form-control" name="deskripsi" value="{{ $deskripsi }}">
                </div>

                <!-- Reason for Report -->
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 150px;" name="alasan"></textarea>
                    <label for="floatingTextarea2">Why are you reporting this post?</label>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit Report</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
