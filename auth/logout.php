<?php 
session_start();
session_destroy();

echo "<script>
alert('Anda Berhasil Logout');
    location.href= 'login.php';
</script>";
?>