<!-- hapus_admin.php -->
<?php
include('../koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $admin_id = mysqli_real_escape_string($koneksi, $_GET['id']);

    $queryDelete = "DELETE FROM admin WHERE id = $admin_id";
    $resultDelete = mysqli_query($koneksi, $queryDelete);

    if ($resultDelete) {
        header("Location: daftar_admin.php");
        exit();
    } else {
        echo "Gagal menghapus admin.";
        exit();
    }
} else {
    header("Location: daftar_admin.php");
    exit();
}
?>