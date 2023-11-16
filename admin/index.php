<!-- admin_dashboard.php -->
<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include('../koneksi.php'); // Asumsi bahwa file ini berisi kode koneksi ke database

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="../style.css">
    <script src="../js/jquery-1.8.3.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <?php
        include_once 'navbar.php';
        ?>
        <div class="wrapperbox">
            <header>
                <h1>Selamat Datang Admin</h1>
            </header>

        </div>
    </div>
    <footer>
        <p>&copy; Sistem Pakar 2023</p>
    </footer>

</body>

</html>