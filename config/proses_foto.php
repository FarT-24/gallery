<?php
session_start();
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $judul_foto = $_POST['judul_foto'];
    $deskripsi_foto = $_POST['deskripsi_foto'];
    $tanggal_unggah = date('Y-m-d');
    $albumid = $_POST['albumid'];
    $userid = $_SESSION['userid'];
    $foto = $_FILES['lokasi_file']['name'];
    $tmp = $_FILES['lokasi_file']['tmp_name'];
    $lokasi = '../assets/img/';
    $nama_foto = rand().'-'.$foto;

    move_uploaded_file($tmp, $lokasi.$nama_foto); 

    $sql = mysqli_query($koneksi, "INSERT INTO foto VALUES('','$judul_foto','$deskripsi_foto','$tanggal_unggah','$nama_foto','$albumid','$userid')");

    echo "<script>
    alert('Data berhasil disimpan!');
    location.href='../admin/foto.php';
    </script>";
}

if (isset($_POST['edit'])) {
    $fotoid = $_POST['fotoid'];
    $judul_foto = $_POST['judul_foto'];
    $deskripsi_foto = $_POST['deskripsi_foto'];
    $tanggal_unggah = date('Y-m-d');
    $albumid = $_POST['albumid'];
    $userid = $_SESSION['userid'];
    $foto = $_FILES['lokasi_file']['name'];
    $tmp = $_FILES['lokasi_file']['tmp_name'];
    $lokasi = '../assets/img/';
    $nama_foto = rand().'-'.$foto;

    if ($foto == null) {
        $sql = mysqli_query($koneksi, "UPDATE foto SET judul_foto='$judul_foto', deskripsi_foto='$deskripsi_foto', tanggal_unggah='$tanggal_unggah', albumid='$albumid' WHERE fotoid='$fotoid'");
    } else {
        $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE fotoid='$fotoid'");
        $data = mysqli_fetch_array($query);
        if (is_file('../assets/img/'.$data['lokasi_file'])) {
            unlink('../assets/img/'.$data['lokasi_file']);
        }
        move_uploaded_file($tmp, $lokasi.$nama_foto); 
        $sql = mysqli_query($koneksi, "UPDATE foto SET judul_foto='$judul_foto', deskripsi_foto='$deskripsi_foto', tanggal_unggah='$tanggal_unggah', lokasi_file='$nama_foto', albumid='$albumid' WHERE fotoid='$fotoid'");
    }
    echo "<script>
    alert('Data berhasil diperbarui!');
    location.href='../admin/foto.php';
    </script>";
}

if (isset($_POST['hapus'])) {
    $fotoid = $_POST['fotoid'];
    $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE fotoid='$fotoid'");
    $data = mysqli_fetch_array($query);
    if (is_file('../assets/img/'.$data['lokasi_file'])) {
        unlink('../assets/img/'.$data['lokasi_file']);
    }

    $sql = mysqli_query($koneksi, "DELETE FROM foto WHERE fotoid='$fotoid'");
    echo "<script>
    alert('Data berhasil dihapus!');
    location.href='../admin/foto.php';
    </script>";
}