<?php
    session_start();

    $username = "";
    $errors = array();

// Koneksi untuk ke database
    $host = mysqli_connect('localhost', 'root', '', 'registrasi');

// Functions
    function registrasi ($data) {
        global $host;
        global $username;
        global $errors;

        $username = strtolower(stripslashes($data['username']));
        $password_1 = mysqli_real_escape_string($host,$data['password_1']);
        $password_2 = mysqli_real_escape_string($host,$data['password_2']);

        // Cek jika username dan password sudah terisi atau belum
        if(empty($username)) {
            array_push($errors, "Harus isi username!");
        }   

        if(empty($password_1)) {
            array_push($errors, "Harus isi password!");
        }

        // Cek username sudah ada atau belum
        $result = mysqli_query($host, "SELECT username FROM user WHERE username = '$username'");
        if(mysqli_fetch_assoc($result)) {
            array_push($errors, "Username sudah terdaftar!");
        }

        // Cek Konfirmasi password
        if($password_1 !== $password_2) {
            array_push($errors, "Konfirmasi password tidak sesuai");
        }

        // Cek jika kolom sudah terisi semua
        if(count($errors) == 0) {
            // Enkripsi password
            $password = password_hash($password_1, PASSWORD_DEFAULT);
            // Tambahkan user baru ke database
            $add = "INSERT INTO user VALUES (NULL, '$username', '$password')";
            mysqli_query($host, $add);

        }
    }   

    // Login
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $remember = $_POST['remember'];

        // Pengecekan kolom ke isi
        if(empty($username)) {
            array_push($errors, "Isikan username!");
        }   

        if(empty($password)) {
            array_push($errors, "Isikan password!");
        }

        if (count($errors) == 0 ) {
            $query = mysqli_query($host, "SELECT * FROM user WHERE username = '$username'");
            $hitung = mysqli_num_rows($query);
            $pw = mysqli_fetch_array($query);
            $passwordsekarang = $pw['password'];

            if ($hitung > 0) {
                // verifikasi password
                if(password_verify($password, $passwordsekarang)) {
                    // jika passwordnya benar
                    if(isset($_POST['remember'])) {
                        setcookie('username', $username, time()+10);
                        setcookie('password', $password, time()+10);
                        setcookie('remember', $remember, time()+10);
                    }

                    $_SESSION['username'] = $username;
                    $_SESSION['success'] = "Anda berhasil login!";
                    header('location: homepage.php');  
                } else {
                    array_push($errors, "Cek password anda lagi");
                }
            } else {
                array_push($errors, "Username/Password anda salah!");
            }
        }
    }
        
    // Logout 
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }
?>