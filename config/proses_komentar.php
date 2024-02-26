<?php
session_start();
include '../config/koneksi.php';

$fotoid = $_POST['fotoid'];
$userid = $_SESSION['userid'];
$isi_komentar = $_POST['isi_komentar'];
$tanggal_komentar = date('Y-m-d');

$query = mysqli_query($koneksi, "INSERT INTO komentarfoto VALUES('','$fotoid','$userid','$isi_komentar','$tanggal_komentar')");

echo "<script>
location.href='../admin/index.php';
</script>"

?>