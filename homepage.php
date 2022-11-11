<?php include('functions.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <?php if (isset($_SESSION['session'])): ?>
        <h3>
            <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            ?>
        </h3>
    <?php endif ?>

    <?php if(isset($_SESSION['username'])): ?>
        <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
        <br>
        <p><a href="homepage.php?logout='1'" style="color: red;">Logout</a></p>
    <?php endif ?>
</body>
</html>