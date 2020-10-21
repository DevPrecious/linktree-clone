<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
Register
<hr>
<fieldset>
    <legend>Register</legend>

    <form action="" method="post">
        <?php if(isset($validation)): ?>
            <?= $validation->listErrors() ?>
        <?php endif; ?>
        <label for="Username">Username</label><br>
        <input type="text" name="username" id=""><br>
        <label for="email">Email</label><br>
        <input type="text" name="email" id="" /><br>
        <label for="password">Password</label><br>
        <input type="password" name="password" id=""><br><br>
        <button>Register</button>
    </form>
</fieldset>
</body>
</html>