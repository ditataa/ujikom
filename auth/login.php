<?php
session_start();
include '../koneksi.php';

if (isset($_POST['login'])) {
$username = $_POST['username'];
$password = $_POST['password'];

$sql = mysqli_query($koneksi, query: "SELECT * FROM user where username='$username' and password='$password'");

$cek_user = mysqli_fetch_assoc($sql);
// debug($cek_user);

if($cek_user != null) {
    $_SESSION ['username']      = $username;
    $_SESSION ['id_user']       = $cek_user['id_user'];
    $_SESSION ['nama_lengkap']  = $cek_user['nama_lengkap'];
    $_SESSION ['level']         = $cek_user['level'];
    $_SESSION ['status']        = 'login';
    echo "<script>
    alert('Login Berhasil');
    location.href= '../home.php';
    </script>";

} else {
    echo "<script>
    alert('Username atau Password salah!');
    location.href= 'login.php';
    </script>";
}
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ujikom</title>
    
    <?php include '../assets/layout/css.php' ?>
  </head>
  <body>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            margin-bottom: 20px;
        }
        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>


<div class="login-container">
    <h2>Login</h2>
    <form action="login.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
        <hr>
        <p>Belum punya akun? <a href="register.php">Daftar disini!</a></p>
    </form>
</div>

</body>
</html>


