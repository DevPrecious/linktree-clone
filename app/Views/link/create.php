<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create</title>
</head>
<body>
    <h3>Create Link</h3>
    <hr>
    <form action="" method="post">
        <?php if(isset($validation)) : ?>
        <?= $validation->listErrors() ?>
        <?php endif; ?>
        <label for="Link">Web Address</label><br>
        <input type="text" name="link" id=""><br>
        <button>Add</button>
    </form>
</body>
</html>