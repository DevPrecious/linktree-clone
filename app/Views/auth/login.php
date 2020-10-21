<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
Login
<hr>
<fieldset>
    <legend>Login</legend>
    <?php if(session()->get('error')) : ?>
        <?= session()->get('error') ?>
    <?php endif; ?>
    <form action="" method="post">
        <?php if(isset($validation)): ?>
            <?= $validation->listErrors() ?>
        <?php endif; ?>
        <label for="Username">Username</label><br>
        <input type="text" name="username" id=""><br>
        <label for="password">Password</label><br>
        <input type="password" name="password" id=""><br><br>
        <button>Login</button>
    </form>
</fieldset>
</body>
</html>