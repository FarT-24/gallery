<?php
session_start();
include '../config/koneksi.php';
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda belum Login!');
    location.href='../index.php';
    </script>";
}
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE userid='" . $_SESSION['userid'] . "'");
$data = mysqli_fetch_object($query);
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Website Galeri Foto</title>
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/custom.css">
</head>

<body>
    <div class="masterhead" style="background-image: url('../assets/bg/bg.jpg'); background-size: cover;">
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
            <div class="container">
                <a class="navbar-brand fw-bold text-white fs-1" href="index.php">GA<span style="color: red;">LL</span>ERY PHOTO</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
                    <div class="navbar-nav me-auto">
                        <a href="home.php" class="nav-link fw-bold fs-5 text-white">Home</a>
                        <a href="album.php" class="nav-link fw-bold fs-5 text-white">Album</a>
                        <a href="foto.php" class="nav-link fw-bold fs-5 text-white">Foto</a>
                        <a href="profil.php" class="nav-link right fw-bold fs-5 text-white"><?= ucwords($_SESSION['username']) ?></a>
                    </div>

                    <a href="../config/proses_logout.php" class="btn btn-outline-danger m-2">Keluar</a>
                </div>
            </div>
        </nav>

        <div class="py-5 bg-transparent">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-lg-6 mb-4 mb-lg-0">
                        <div class="card mb-3" style="border-radius: .5rem;">
                            <div class="row g-0">
                                <div class="col-md-4 gradient-custom text-center" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                    <img src="../assets/bg/user.png" alt="Avatar" class="img-fluid my-5" style="width: 100px;" />
                                    <h3><?= ucwords($_SESSION['username']) ?></h3>
                                    <i class="far fa-edit mb-5"></i>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body p-4">
                                        <h4>Informasi</h4>
                                        <hr class="mt-0 mb-4">
                                        <div class="row pt-0">
                                            <form action="" method="POST">
                                                <h5>Nama Lengkap</h5>
                                                <input type="text" name="nama_lengkap" class="bg-transparent border-0" value="<?php echo $data->nama_lengkap ?>">
                                                <br><br>
                                                <h5>Email</h5>
                                                <input type="text" name="email" class="bg-transparent border-0" value="<?php echo $data->email ?>">
                                                <br><br>
                                                <h5>Alamat</h5>
                                                <input type="text" name="alamat" class="bg-transparent border-0" value="<?php echo $data->alamat ?>">
                                                <br><br>
                                                <input class="btn btn-primary" type="submit" name="edit" value="Ubah Profil">
                                            </form>
                                            <?php
                                            if (isset($_POST['edit'])) {
                                                $nama_lengkap = $_POST['nama_lengkap'];
                                                $email = $_POST['email'];
                                                $alamat = $_POST['alamat'];
                                                $userid = $_SESSION['userid'];

                                                $sql = mysqli_query($koneksi, "UPDATE user SET nama_lengkap='$nama_lengkap', email='$email', alamat='$alamat' WHERE userid='$userid'");

                                                if ($sql) {
                                                    echo"<script>
                                                        alert('Ubah data berhasil');
                                                        location.href='profil.php';
                                                        </script>";
                                                } else {
                                                    echo 'gagal '.mysqli_error($koneksi);
                                                }
                                            }
                                            ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <footer class="d-flex justify-content-center border-top mt-3 fs-5 text-white bg-transparent fixed-bottom">
        <p>&copy; UKK RPL 2024 | Farisa Tunnadhiroh</p>
    </footer>

    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>