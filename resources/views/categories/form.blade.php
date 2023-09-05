<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('comments.store') }}" method="post">
        <input type="text" name="comment">
        <button name="submit">ADD</button>
    </form>
</body>
</html>
