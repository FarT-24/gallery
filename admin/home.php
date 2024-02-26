<?php
session_start();
$userid = $_SESSION['userid'];
include '../config/koneksi.php';
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda belum Login!');
    location.href='../index.php';
    </script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Website Galeri Foto</title>
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/custom.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
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

                    <a href="../config/proses_logout.php" class="btn btn-outline-danger m-1">Keluar</a>
                </div>
            </div>
        </nav>

        <div class="container p-1 bg-hero rounded">
            <div class="py-5 text-white">
                <p class="fs-3 fw-bold">Gallery Photo</p>
                <p class="fs-5 col-md-10">Simpan dan bagikan momen indahmu disini😊</p>
            </div>
        </div>
        <div class="container mt-3 text-white">
            Album :
            <?php
            $album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
            while ($row = mysqli_fetch_array($album)) { ?>
                <a href="home.php?albumid=<?php echo $row['albumid'] ?>" class="btn btn-outline-primary"><?php echo $row['nama_album'] ?></a>
            <?php } ?>

            <div class="row">

                <?php
                if (isset($_GET['albumid'])) {
                    $albumid = $_GET['albumid'];
                    $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid' AND albumid='$albumid'");
                    while ($data = mysqli_fetch_array($query)) { ?>
                        <div class="col-md-3 mt-2">
                            <div class="card">
                                <img style="height: 12rem;" src="../assets/img/<?php echo $data['lokasi_file'] ?>" class="card-img-top" title="<?php echo $data['judul_foto'] ?>">
                                <div class="card-footer text-center">
                                    <?php
                                    $fotoid = $data['fotoid'];
                                    $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
                                    if (mysqli_num_rows($ceksuka) == 1) { ?>
                                        <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                                    <?php } else { ?>
                                        <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>
                                    <?php }
                                    $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                                    echo mysqli_num_rows($like) . ' Suka';
                                    ?>
                                    <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>"><i class="fa-regular fa-comment"></i></a>
                                    <?php
                                    $jmlkomentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
                                    echo mysqli_num_rows($jmlkomentar). ' Komentar';
                                    ?>
                                </div>
                            </div>
                        </div>

                    <?php }
                } else {

                    $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid'");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <div class="col-md-3 mt-2">
                            <div class="card">
                                <img style="height: 12rem;" src="../assets/img/<?php echo $data['lokasi_file'] ?>" class="card-img-top" title="<?php echo $data['judul_foto'] ?>">
                                <div class="card-footer text-center">

                                    <?php
                                    $fotoid = $data['fotoid'];
                                    $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
                                    if (mysqli_num_rows($ceksuka) == 1) { ?>
                                        <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                                    <?php } else { ?>
                                        <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>
                                    <?php }
                                    $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                                    echo mysqli_num_rows($like) . ' Suka';
                                    ?>
                                    <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>"><i class="fa-regular fa-comment"></i></a>
                                    <?php
                                    $jmlkomentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
                                    echo mysqli_num_rows($jmlkomentar). ' Komentar';
                                    ?>
                                </div>
                            </div>
                        </div>

                <?php }
                } ?>

            </div>
        </div>
        <footer class="d-flex justify-content-center border-top mt-3 fs-5 text-white bg-transparent fixed-bottom">
            <p>&copy; UKK RPL 2024 | Farisa Tunnadhiroh</p>
        </footer>

        <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>