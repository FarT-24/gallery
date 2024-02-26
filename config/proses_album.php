<?php
session_start();
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $nama_album = $_POST['nama_album'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal_dibuat = date('Y-m-d');
    $userid = $_SESSION['userid'];

    $sql = mysqli_query($koneksi, "INSERT INTO album VALUES('','$nama_album','$deskripsi','$tanggal_dibuat','$userid')");

    echo "<script>
    alert('Data berhasil disimpan!');
    location.href='../admin/album.php';
    </script>";
}

if (isset($_POST['edit'])) {
    $albumid = $_POST['albumid'];
    $nama_album = $_POST['nama_album'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal_dibuat = date('Y-m-d');
    $userid = $_SESSION['userid'];

    $sql = mysqli_query($koneksi, "UPDATE album SET nama_album='$nama_album', deskripsi='$deskripsi', 
        tanggal_dibuat='$tanggal_dibuat' WHERE albumid='$albumid'");

    echo "<script>
    alert('Data berhasil diperbarui!');
    location.href='../admin/album.php';
    </script>";
}

if (isset($_POST['hapus'])) {
    $albumid = $_POST['albumid'];

    $sql = mysqli_query($koneksi, "DELETE FROM album WHERE albumid='$albumid'");

    echo "<script>
    alert('Data berhasil dihapus');
    location.href='../admin/album.php';
    </script>";
}

?>