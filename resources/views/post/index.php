<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container">
    <h1 style="color:blue;">This is main page for entering your content</h1>
</div>

<div class="container">

    <form action="/PHP-routing/public/posts" method="post">
        <div class="form-group">
            <label for="title">Post title</label>
            <input type="text" name="title" class="form-control" id="title" aria-describedby="title post"
                   placeholder="Enter post title">
        </div>
        <div class="form-group">
            <label for="text">Your post content</label>
            <textarea class="form-control" id="text" name="content" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">POST</button>
    </form>
    <div class="container pt-5">
        <h2><?php if (isset($_SESSION['title'])) {
                echo $_SESSION['title'];
            } ?>
        </h2>
        <p><?php if (isset($_SESSION['content'])) {
                echo $_SESSION['content'];
            } ?></p>
    </div>
</div>
</body>
</html>


