<!-- delete_diagnosa.php -->
<?php
session_start();
include('../koneksi.php'); // Asumsi bahwa file ini berisi kode koneksi ke database

// Pastikan admin sudah login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Validasi parameter ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_diagnosa = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Query untuk mendapatkan informasi diagnosa
    $queryGetDiagnosa = "SELECT * FROM hasil_diagnosa WHERE id_diagnosa = $id_diagnosa";
    $resultGetDiagnosa = mysqli_query($koneksi, $queryGetDiagnosa);

    if ($resultGetDiagnosa && mysqli_num_rows($resultGetDiagnosa) > 0) {
        $diagnosa = mysqli_fetch_assoc($resultGetDiagnosa);

        // Lakukan penghapusan
        $id_pasien = $diagnosa['id_pasien']; // Dapatkan id_pasien terkait dengan diagnosa
        $queryDeleteDiagnosa = "DELETE FROM hasil_diagnosa WHERE id_diagnosa = $id_diagnosa";
        $resultDeleteDiagnosa = mysqli_query($koneksi, $queryDeleteDiagnosa);

        // Hapus juga data pasien berdasarkan id_pasien
        $queryDeletePasien = "DELETE FROM pasien WHERE id_pasien = $id_pasien";
        $resultDeletePasien = mysqli_query($koneksi, $queryDeletePasien);

        if ($resultDeleteDiagnosa && $resultDeletePasien) {
            // Redirect ke pasien.php setelah penghapusan
            header("Location: pasien.php?success=1");
            exit();
        } else {
            echo "Gagal menghapus diagnosa atau pasien.";
            exit();
        }
    } else {
        echo "Diagnosa tidak ditemukan.";
        exit();
    }
} else {
    echo "Parameter ID tidak valid.";
    exit();
}
?>