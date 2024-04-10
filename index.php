<?php
error_reporting(-1);
session_start();
require_once __DIR__ . '/funcs.php';
$phoneBook = [];
if (file_exists('phone.json')){
    $file = file_get_contents('phone.json');
    $phoneBook = json_decode($file, true);
}
if (isset($_POST['delete'])){
    unset($phoneBook[$_POST['id']]);
    file_put_contents('phone.json', json_encode($phoneBook, JSON_FORCE_OBJECT));
    header("Location: index.php");
    die;
}

if (isset($_POST['create'])){
    $phoneBook=add($phoneBook);
    header("Location: index.php");
    die;
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>



<div class="container my-5">
    <form action="index.php" method="post" class="row g-3">
        <div class="col-md-6 offset-md-3">
            <div class="form-floating mb-3">
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone">
                <label >Phone</label>
            </div>
        </div>

        <div class="col-md-6 offset-md-3">
            <div class="form-floating">
                <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                <label >Name</label>
            </div>
        </div>

        <div class="col-md-6 offset-md-3">
            <button type="submit" name="create" class="btn btn-primary">Submit</button>
        </div>
    </form>



    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Button</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i=0;
        foreach ($phoneBook as $key=>$item):?>
        <tr>
            <th scope="row"><?=++$i?></th>
            <td><?= htmlspecialchars($item[0]) ?></td>
            <td><?= htmlspecialchars($item[1]) ?></td>
            <td>
                <form action="index.php" method="post">
                    <input type="hidden" name="id" value="<?=$key?>"/>
                    <button type="submit" class="btn btn-danger" name="delete">Delete</button>

                    <form/>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>





</div>

</body>
</html>
