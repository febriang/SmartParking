<?php
session_start();
//koneksi
$koneksi = mysqli_connect(
    'localhost', 'root', '', 'tubesiot'
);

//login
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $cek = mysqli_query($koneksi, "select * from user where username = '$username' and password = '$password'");
    $hitung = mysqli_num_rows($cek);

    if($hitung>0){
        $_SESSION['login'] = "True";
        header('location: index.php');
    } else{
        echo '<script>
        alert("Username atau Password Salah");
        window.location.href="login.php"
        </script>';
    }
}

//registrasi
function registerUser($koneksi, $username, $password)
{
    // Escape input to prevent SQL injection
    $username = mysqli_real_escape_string($koneksi, $username);
    $password = mysqli_real_escape_string($koneksi, $password);

    // Check if the username already exists
    $checkQuery = "SELECT * FROM user WHERE username = '$username'";
    $checkResult = mysqli_query($koneksi, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        return "Username sudah digunakan";
    } else {
        // Insert the new user into the database
        $insertQuery = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
        mysqli_query($koneksi, $insertQuery);
        return "Registrasi berhasil";
    }
}

// Handle registration form submission
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = registerUser($koneksi, $username, $password);

    if ($result == "Registrasi berhasil") {
        $_SESSION['register'] = "True";
        header('location: login.php');
    } else {
        echo '<script>
        alert("' . $result . '");
        window.location.href="register.php"
        </script>';
    }
}

?>