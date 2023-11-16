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
</head>

<body>
    <div class="wrapper">
        <?php
        include_once 'navbar.php';
        ?>
    </div>

    <h1>Sistem Diagnosa TBC</h1>
    <div class="container">
        <div class="wrapperbox">
            <form action="diagnosa.php" method="post">
                <!-- Input data pasien -->
                <div class="mb-3 row">
                    <label for="nama_pasien" class="col-3">Nama Pasien:</label>
                    <div class="col-md-8">
                        <input type="text" name="nama_pasien" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="umur" class="col-3">Umur:</label>
                    <div class="col-md-8">
                        <input type="number" name="umur" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jenis_kelamin" class="col-3">Jenis Kelamin:</label>
                    <div class="col-md-8">
                        <select name="jenis_kelamin" required>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <!-- Input gejala -->
                    <label for="jumlah_batuk" class="col-3">Jumlah Batuk:</label>
                    <div class="col-md-8">
                        <input type="number" name="jumlah_batuk" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="sesak_nafas" class="col-3">Sesak Nafas:</label>
                    <div class="col-md-8">
                        <input type="number" name="sesak_nafas" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="demam" class="col-3">Demam:</label>
                    <div class="col-md-8">
                        <input type="number" name="demam" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="berkeringat_malam" class="col-3">Berkeringat di Malam Hari:</label>
                    <div class="col-md-8">
                        <select name="berkeringat_malam" required>
                            <option value="Tidak">Tidak</option>
                            <option value="Ya">Ya</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nafsu_makan" class="col-3">Nafsu Makan:</label>
                    <div class="col-md-8">
                        <select name="nafsu_makan" required>
                            <option value="Baik">Baik</option>
                            <option value="Kurang">Kurang</option>
                        </select>
                    </div>
                </div>
                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-success buttons" onclick="return confirm('Input Data?')">Diagnosa</button>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; Sistem Pakar 2023</p>
    </footer>
</body>

</html>