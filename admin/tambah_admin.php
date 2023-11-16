<!-- tambah_admin.php -->
<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Proses penambahan admin
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = mysqli_real_escape_string($koneksi, $_POST['new_username']);
    $newPassword = mysqli_real_escape_string($koneksi, $_POST['new_password']);

    // Hash password menggunakan password_hash
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Query untuk menambahkan admin baru
    $queryInsertAdmin = "INSERT INTO admin (username, password) VALUES ('$newUsername', '$hashedPassword')";
    $resultInsertAdmin = mysqli_query($koneksi, $queryInsertAdmin);

    if ($resultInsertAdmin) {
        header("Location: daftar_admin.php?success=1");
        exit();
    } else {
        echo "Gagal menambahkan admin.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="../style.css">
    <script src="../js/jquery-1.8.3.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <style>
        button {
            text-align: center;
        }

        .boxet {

            margin-top: 5%;
            background-color: rgba(246, 247, 247, 0.637);
            position: relative;
            box-shadow: 3px 5px 5px 5px rgba(22, 22, 22, 0.2);
            border-radius: 3px;
            margin-left: 22%;
            margin-right: 22%;
            padding-left: 4%;
            padding-right: 2%;
            padding-top: 4%;
            padding-bottom: 4%;
            text-align: justify;
        }

        .log {
            margin-left: 30%;
        }
    </style>
</head>

<body>
    <?php
    include_once 'navbar.php';
    ?>

    <div class="boxet">
        <div class="log">
            <h2>Tambah Admin</h2>
            <form action="tambah_admin.php" method="post">
                <label for="new_username">Username:</label>
                <input type="text" name="new_username" required>
                <br><br>
                <label for="new_password">Password:</label>
                <input type="password" name="new_password" required>
                <br><br>
                <button type="submit" class="btn btn-primary" onclick="return confirm ('Tambah Data?')">Tambah Admin</button>
                <a href="daftar_admin.php" class="btn btn-primary">Kembali</a>
            </form>
        </div>
    </div>
    <footer>
        <p>&copy; Sistem Pakar 2023</p>
    </footer>
</body>

</html>