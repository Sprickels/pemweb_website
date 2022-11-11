<?php include('functions.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>

    <h2>Login</h2>

    <form method="post" action="login.php">

        <?php 
        // Menampilkan jika belum full
        include('errors.php') 
        
        ?>

        <label for="">Username</label>
        <input type="text" name="username" id="username" value="<?php 
        if(isset($_COOKIE['username'])) { echo $_COOKIE['username'];}; ?>">
            <br><br>
        <label for="">Password</label>
        <input type="password" name="password" id="password" value="<?php 
        if(isset($_COOKIE['password'])) { echo $_COOKIE['password'];}; ?>">
            <br><br>
        <input type="checkbox" name="remember" id="remember"> Remember Me
            <br><br>
        <button type="submit" name="login">Login</button>
        <p>Belum punya akun? <a href="register.php">Register here</a></p>
    </form>

</body>
</html>