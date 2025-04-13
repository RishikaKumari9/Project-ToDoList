
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo Create</title>

</head>
<body style="text-align:center">
    <h1>Add Your Task Here</h1>
    <form method="POST" action="/upload">
        @csrf
        <input type="text" name="title" class="form-control" placeholder="Enter your Task ">
        <input type="submit" value="ADD">
    </form>
    <br>
    <a href="/list">Show All</a>

</body>
</html>
