<!-- login.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
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
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <div class="" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../index.php">Sistem Diagnosa TBC</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="boxet">
        <div class="log">
            <h2>Login Admin</h2>
            <form action="login_process.php" method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" required>
                <br><br>
                <label for="password">Password:</label>
                <input type="password" name="password" required>
                <br><br>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
    <footer>
        <p>&copy; Sistem Pakar 2023</p>
    </footer>
</body>

</html>