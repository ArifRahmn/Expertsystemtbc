<!-- edit_admin.php -->
<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Fungsi untuk mendapatkan data admin berdasarkan ID
function getAdminById($admin_id)
{
    global $koneksi;
    $query = "SELECT * FROM admin WHERE id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Fungsi untuk menyimpan perubahan data admin
function updateAdmin($admin_id, $newUsername, $newPassword)
{
    global $koneksi;

    // Hash password menggunakan password_hash
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Query untuk mengupdate data admin
    $queryUpdate = "UPDATE admin SET username = ?, password = ? WHERE id = ?";
    $stmt = $koneksi->prepare($queryUpdate);
    $stmt->bind_param("ssi", $newUsername, $hashedPassword, $admin_id);
    $resultUpdate = $stmt->execute();

    return $resultUpdate;
}

// Mendapatkan admin berdasarkan ID dari parameter URL
$admin_id = $_GET['id'];
$admin = getAdminById($admin_id);

// Memproses form setelah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = mysqli_real_escape_string($koneksi, $_POST['new_username']);
    $newPassword = mysqli_real_escape_string($koneksi, $_POST['new_password']);

    // Validasi input
    if (empty($newUsername) || empty($newPassword)) {
        echo "Username dan password harus diisi.";
        exit();
    }

    // Menyimpan perubahan admin
    $resultUpdate = updateAdmin($admin_id, $newUsername, $newPassword);

    if ($resultUpdate) {
        header("Location: daftar_admin.php?success=1");
        exit();
    } else {
        echo "Gagal mengedit admin.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
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
            <h2>Edit Admin</h2>
            <form action="edit_admin.php?id=<?php echo $admin['id']; ?>" method="post">
                <label for="new_username">Username Baru:</label>
                <input type="text" name="new_username" value="<?php echo $admin['username']; ?>" required>
                <br><br>
                <label for="new_password">Password Baru:</label>
                <input type="password" name="new_password" required>
                <br><br>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="daftar_admin.php" class="btn btn-primary">Batal</a>
            </form>
        </div>
    </div>
    <footer>
        <p>&copy; Sistem Pakar 2023</p>
    </footer>
</body>

</html>