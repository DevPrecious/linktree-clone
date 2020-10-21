<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
Welcome <?= esc($user['username']) ?> ! <a href="/logout">Logout</a>

<br>
<hr>
My Links
<hr>
<?php if(session()->get('success')) : ?>
<?= session()->get('success') ?>
<?php endif; ?>
<?php if(session()->get('update')) : ?>
    <?= session()->get('update') ?>
<?php endif; ?>
<br>
<?php if(!empty(esc($links))) : ?>
<?php foreach ($links as $link) : ?>
        <a href="<?= $link['links'] ?>" _target="blank"><?= $link['links'] ?></a>| <a href="/edit/<?= $link['id'] ?>">Edit</a> | <a
                href="/del/<?= $link['id'] ?>">Delete</a> <br>
<?php endforeach; ?>
<?php else: ?>
No links, <a href="/create">create one now</a>
<?php endif; ?>
</body>
</html>