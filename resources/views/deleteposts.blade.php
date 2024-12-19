<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <form action="/reportadd" method="GET">
        <div class="mb-3" style="display: none;">
            <input type="text" class="form-control" id="exampleInputPassword1" name="uuid"  value="{{ $uuid }}">
            <input type="text" class="form-control" id="exampleInputPassword1" name="name"  value="{{ $name }}">
            <input type="text" class="form-control" id="exampleInputPassword1" name="profile" value="{{ $profile }}">
            <input type="text" class="form-control" id="exampleInputPassword1" name="title" value="{{ $title }}">
            <input type="text" class="form-control" id="exampleInputPassword1" name="deskripsi" value="{{ $deskripsi }}">
        </div>
        <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="alasan"></textarea>
            <label for="floatingTextarea2">Comments</label>
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</body>
</html>