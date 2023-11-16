<!-- daftar_admin.php -->
<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$queryAdmin = "SELECT * FROM admin";
$resultAdmin = mysqli_query($koneksi, $queryAdmin);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Admin</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="../style.css">
    <script src="../js/jquery-1.8.3.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <style>
        body {
            display: flex !important;
            flex-direction: column !important;
            min-height: 100vh !important;
        }

        .wrapper {
            flex: 1 !important;
        }

        footer {
            padding: 10px !important;
            text-align: center !important;
            position: fixed !important;
            bottom: 0 !important;
            width: 100% !important;


        }
    </style>
</head>

<body>
    <?php
    include_once 'navbar.php';
    ?>
    <div class="wrapper">
        <h2>Daftar Admin</h2>
        <main>
            <div class="col-md-6 mt-5">
                <table class="table table-bordered table-striped text-center table-responsive custom-table">
                    <thead>
                        <tr>
                            <a class="btn btn-success" style=" text-decoration: none;
                            font-size: 20px; font-weight: bold; margin-left: 75%;" href="tambah_admin.php">Tambah Admin</a> <!-- Tambahkan tombol Tambah Admin di sini -->

                            <th scope="col">ID Admin</th>
                            <th scope="col">Username</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($admin = mysqli_fetch_assoc($resultAdmin)) {
                            echo "<tr>";
                            echo "<td>" . $admin['id'] . "</td>";
                            echo "<td>" . $admin['username'] . "</td>";
                            echo "<td>";
                            echo "<a style='color: orange; text-decoration: none;  left: 0%;
                            font-size: 14px;' href='edit_admin.php?id=" . $admin['id'] . "'>Edit</a> | ";
                            echo "<a style='color: red; text-decoration: none;  left: 0%;
                            font-size: 14px;' href='hapus_admin.php?id=" . $admin['id'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus admin ini?\")'>Hapus</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <footer>
        <p>&copy; Sistem Pakar 2023</p>
    </footer>
</body>

</html>