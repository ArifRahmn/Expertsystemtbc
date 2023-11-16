<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Diagnosa TBC</title>
    <link rel="stylesheet" href="style.css">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

    <script src="js/jquery-1.8.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        if (performance.navigation.type === 1) {
            // Tipe navigasi 1 adalah "TYPE_RELOAD", yang menunjukkan halaman dimuat ulang
            window.location.href = "input_diagnosa.php";
        }
    </script>

</head>

<body>
    <?php
    include('koneksi.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil nilai input dari formulir
        $nama_pasien = mysqli_real_escape_string($koneksi, $_POST["nama_pasien"]);
        $umur = intval($_POST["umur"]);
        $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST["jenis_kelamin"]);

        // Simpan data pasien ke database
        $id_pasien = savePatientToDatabase($nama_pasien, $umur, $jenis_kelamin);



        // Ambil nilai gejala dari formulir
        $jumlah_batuk = isset($_POST["jumlah_batuk"]) ? intval($_POST["jumlah_batuk"]) : 0;
        $sesak_nafas = isset($_POST["sesak_nafas"]) ? intval($_POST["sesak_nafas"]) : 0;
        $demam = isset($_POST["demam"]) ? intval($_POST["demam"]) : 0;
        $berkeringat_malam = isset($_POST["berkeringat_malam"]) ? $_POST["berkeringat_malam"] : "Tidak";
        $nafsu_makan = isset($_POST["nafsu_makan"]) ? $_POST["nafsu_makan"] : "Baik";

        // Implementasi logika Fuzzy Tsukamoto
        $tingkat_keparahan = fuzzyTsukamoto($jumlah_batuk, $sesak_nafas, $demam, $berkeringat_malam, $nafsu_makan);

        // Simpan hasil diagnosa ke database
        saveDiagnosisToDatabase($id_pasien, $tingkat_keparahan);

        // Tampilkan hasil diagnosa
        $hasil_diagnosa = getDiagnosisResult($tingkat_keparahan);
    ?>
        "<div class='konsen'>";
            <?php
            echo "<h2>Hasil Diagnosa untuk pasien $nama_pasien:</h2>";
            echo "<p>Umur: $umur tahun</p>";
            echo "<p>Jenis Kelamin: $jenis_kelamin</p>";
            echo "<p>Gejala:</p>";
            echo "<ul>";
            echo "<li>Jumlah Batuk: $jumlah_batuk</li>";
            echo "<li>Sesak Nafas: $sesak_nafas</li>";
            echo "<li>Demam: $demam</li>";
            echo "<li>Berkeringat Malam: $berkeringat_malam</li>";
            echo "<li>Nafsu Makan: $nafsu_makan</li>";
            echo "</ul>";
            echo "<p style='font-size: 22px; box-shadow: inset;
            text-shadow: 3px 10px 10px rgb(155, 124, 243);'>Hasil Diagnosa: <span style='color: " . getColorBasedOnResult($hasil_diagnosa) . ";'>$hasil_diagnosa</span></p>";
            ?>
            <a href="input_diagnosa.php" class="btn btn-success buttons konsen" onclick="return confirm('Diagnosa kembali?')">Lakukan Diagnosa Lagi</a>
            "
        </div>";
    <?php } ?>


</body>

</html>

<?php

// Fungsi untuk menyimpan data pasien ke database
function savePatientToDatabase($nama_pasien, $umur, $jenis_kelamin)
{
    global $koneksi;

    $query = "INSERT INTO pasien (nama_pasien, umur, jenis_kelamin) VALUES (?, ?, ?)";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("sis", $nama_pasien, $umur, $jenis_kelamin);
    $stmt->execute();

    // Penanganan kesalahan
    if ($stmt->errno) {
        echo "Kesalahan selama penyisipan data: " . $stmt->error;
    } else {
        return $koneksi->insert_id;
    }
}

// Fungsi untuk menyimpan hasil diagnosa ke database
function saveDiagnosisToDatabase($id_pasien, $tingkat_keparahan)
{
    global $koneksi;

    $hasil_diagnosa = getDiagnosisResult($tingkat_keparahan);
    $query = "INSERT INTO hasil_diagnosa (id_pasien, tingkat_keparahan, hasil) VALUES (?, ?, ?)";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ids", $id_pasien, $tingkat_keparahan, $hasil_diagnosa);
    $stmt->execute();
}

// Fungsi Fuzzy Tsukamoto
function fuzzyTsukamoto($jumlah_batuk, $sesak_nafas, $demam, $berkeringat_malam, $nafsu_makan)
{
    // Aturan Fuzzy
    $rule1 = min($jumlah_batuk, $sesak_nafas, $demam);
    $rule2 = max($berkeringat_malam == "Ya" ? 1 : 0, $nafsu_makan == "Kurang" ? 1 : 0);

    // Defuzzifikasi - Metode centroid sederhana
    $tingkat_keparahan = ($rule1 + $rule2) / 2;

    return $tingkat_keparahan;
}

// Fungsi untuk mendapatkan hasil diagnosa berdasarkan tingkat keparahan
function getDiagnosisResult($tingkat_keparahan)
{
    if ($tingkat_keparahan <= 3) {
        return "Ringan";
    } elseif ($tingkat_keparahan <= 7) {
        return "Sedang";
    } else {
        return "Berat";
    }
}
function getColorBasedOnResult($result)
{
    switch ($result) {
        case 'Ringan':
            return 'green'; // Set the color for 'Ringan' result
        case 'Sedang':
            return 'orange'; // Set the color for 'Sedang' result
        case 'Berat':
            return 'red'; // Set the color for 'Berat' result
        default:
            return 'black'; // Set a default color if needed
    }
}
