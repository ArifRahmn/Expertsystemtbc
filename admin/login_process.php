<!-- login_process.php -->
<?php
session_start();
include('../koneksi.php'); // Asumsi bahwa file ini berisi kode koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    // Ambil data admin dari database
    $query = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $admin = mysqli_fetch_assoc($result);

        if ($admin && password_verify($password, $admin['password'])) {
            // Password benar
            $_SESSION['admin_id'] = $admin['id'];
            header("Location: index.php");
            exit();
        } else {
            // Username atau password salah
            echo "Username atau password salah.";
        }
    } else {
        // Kesalahan query database
        echo "Error dalam query database: " . mysqli_error($koneksi);
    }
}
?>