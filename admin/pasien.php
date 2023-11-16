<!-- admin_dashboard.php -->
<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include('../koneksi.php'); // Asumsi bahwa file ini berisi kode koneksi ke database

// Lakukan query untuk mendapatkan hasil diagnosa pasien
$query = "SELECT * FROM hasil_diagnosa JOIN pasien ON hasil_diagnosa.id_pasien = pasien.id_pasien";
$result = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pasien</title>
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
        <h3>Hasil Diagnosa Pasien</h3>
        <main>
            <div class="col-md-6 mt-5">
                <table class="table table-bordered table-striped text-center table-responsive custom-table">
                    <thead>
                        <tr>
                            <th scope="col">Nama Pasien</th>
                            <th scope="col">Umur</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Tingkat Keparahan</th>
                            <th scope="col">Hasil Diagnosa</th>
                            <th scope="col">Aksi</th> <!-- Tambahkan kolom Aksi -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['nama_pasien'] . "</td>";
                            echo "<td>" . $row['umur'] . "</td>";
                            echo "<td>" . $row['jenis_kelamin'] . "</td>";
                            echo "<td>" . $row['tingkat_keparahan'] . "</td>";
                            echo "<td>" . $row['hasil'] . "</td>";
                            // Tambahkan tombol delete dengan tautan ke skrip delete
                            echo "<td><a style='color: red; text-decoration: none;  left: 0%;
                            font-size: 12px;' onclick=\"return confirm('Hapus data?')\" href='delete_diagnosa.php?id=" . $row['id_diagnosa'] . "'>Delete</a></td>";
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