<?php include('functions.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
</head>
<body>

    <h2>Register</h2>

        <?php

        // Ketika button register ditekan
        if(isset($_POST["register"])) {
            if(registrasi($_POST) > 0 ) {
                echo "<script>
                alert('User baru berhasil ditambahkan!')
                </script>";
            } else {
                echo mysqli_error($host);
            }
        }

        ?>

    <form method="post" action="">

        <?php 
        // Menampilkan jika belum full
        include('errors.php') 
        
        ?>

        <label for="">Username</label>
        <input type="text" name="username">
            <br><br>
        <label for="">Password</label>
        <input type="password" name="password_1">
            <br><br>
        <label for="">Confirm Password</label>
        <input type="password" name="password_2">
            <br><br>
        <button type="submit" name="register">Register</button>
        <p>Sudah punya akun? <a href="login.php">Sign in</a></p>
    </form>

</body>
</html>