<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Website Galeri Foto</title>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/custom.css">
</head>

<body>
    <div class="masterhead" style="background-image: url('assets/bg/bg.jpg');">
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
            <div class="container">
                <a class="navbar-brand fw-bold text-white " href="index.php">GA<span style="color: red;">LL</span>ERY PHOTO</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
                    <div class="navbar-nav me-auto">

                    </div>
                    <a href="registrasi.php" class="btn btn-outline-primary m-2">Daftar</a>
                    <a href="login.php" class="btn btn-outline-success m-2">Masuk</a>
                </div>
            </div>
        </nav><br>

        <!-- login form --->
        <br>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card bg-transparent">
                        <div class="card-body bg-light bg-transparent">
                            <div class="text-center text-white fw-bold">
                                <h3>Login</h3>
                            </div><br>
                            <form action="config/proses_login.php" method="POST">
                                <input type="text" name="username" class="form-control" placeholder="Username" required><br>
                                <input type="password" name="password" class="form-control" placeholder="password" required>
                                <div class="d-grid mt-2">
                                    <button class="btn btn-primary" type="submit" name="kirim">Masuk</button>
                                </div>
                            </form><hr>
                            <p class="text-center text-white">Belum punya akun? <a href="registrasi.php">Daftar disini</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="d-flex justify-content-center border-top mt-3 text-white bg-transparent fixed-bottom">
            <p>&copy; UKK RPL 2024 | Farisa Tunnadhiroh</p>
        </footer>

        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>

</html>