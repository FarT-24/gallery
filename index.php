<?php
session_start();
include 'config/koneksi.php';

?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Website Galeri Foto</title>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/custom.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>
    <div class="masterhead" style="background-image: url('assets/bg/bg.jpg'); background-size: cover;">
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
            <div class="container">
                <a class="navbar-brand fw-bold text-white fs-1" href="index.php">GA<span style="color: red;">LL</span>ERY PHOTO</a>
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
        </nav>

        <!---- Isi Halaman ---->
        <div class="container p-1 bg-hero rounded">
            <div class="py-5 text-white">
                <p class="fs-3 fw-bold">Gallery Photo</p>
                <p class="fs-5 col-md-10">Simpan dan bagikan momen indahmu disini😊</p>
            </div>
        </div>
        <div class="container mt-3">
            <div class="row">
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM foto INNER JOIN user ON foto.userid=user.userid INNER JOIN album ON foto.albumid=album.albumid");
                while ($data = mysqli_fetch_array($query)) {
                ?>
                    <div class="col-md-3">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>">

                            <div class="card">
                                <img src="assets/img/<?php echo $data['lokasi_file'] ?>" class="card-img-top" title="<?php echo $data['judul_foto'] ?>" style="height: 12rem;">
                                <div class="card-footer text-center">
                                    <?php
                                    $fotoid = $data['fotoid'];
                                    $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                                    if (mysqli_num_rows($ceksuka) == 1) { ?>
                                        <a href="config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                                    <?php } else { ?>
                                        <a href="config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>
                                    <?php }
                                    $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                                    echo mysqli_num_rows($like) . ' Suka';
                                    ?>
                                    <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>"><i class="fa-regular fa-comment"></i></a>
                                    <?php
                                    $jmlkomentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
                                    echo mysqli_num_rows($jmlkomentar) . ' Komentar';
                                    ?>
                                </div>
                            </div>
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="komentar<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <img src="assets/img/<?php echo $data['lokasi_file'] ?>" class="card-img-top" title="<?php echo $data['judul_foto'] ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <div class="m-2">
                                                    <div class="overflow-auto">
                                                        <div class="sticky-top">
                                                            <strong><?php echo $data['judul_foto'] ?></strong><br>
                                                            <span class="badge bg-secondary"><?php echo $data['nama_lengkap'] ?></span>
                                                            <span class="badge bg-secondary"><?php echo $data['tanggal_unggah'] ?></span>
                                                            <span class="badge bg-primary"><?php echo $data['nama_album'] ?></span>
                                                        </div>
                                                        <hr>
                                                        <p align="left">
                                                            <?php echo $data['deskripsi_foto'] ?>
                                                        </p>
                                                        <hr>
                                                        <?php
                                                        $fotoid = $data['fotoid'];
                                                        $komentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$fotoid'");
                                                        while ($row = mysqli_fetch_array($komentar)) {
                                                        ?>
                                                            <p align="left">
                                                                <strong><?php echo $row['username'] ?></strong>
                                                                <?php echo $row['isi_komentar'] ?>
                                                            </p>
                                                        <?php } ?>
                                                        <hr>
                                                        <div class="sticky-bottom">
                                                            <form action="config/proses_komentar.php" method="POST">
                                                                <div class="input-group">
                                                                    <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                                                    <input type="text" name="isi_komentar" class="form-control" placeholder="Tambah Komentar">
                                                                    <div class="input-group-prepend">
                                                                        <button type="submit" name="kirim_komentar" class="btn btn-outline-primary">Kirim</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <footer class="d-flex justify-content-center border-top mt-3 fs-5 text-white bg-transparent fixed-bottom">
            <p>&copy; UKK RPL 2024 | Farisa Tunnadhiroh</p>
        </footer>

        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>

</html>