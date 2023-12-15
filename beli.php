<?php
include 'koneksi.php';

$id_produk = $_GET['id'];

$cek_data = $koneksi->prepare("SELECT * FROM cart WHERE id_barang = ?");
$cek_data->bind_param("i", $id_produk);
$cek_data->execute();
$result = $cek_data->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $jumlah_barang = $row['jumlah'] + 1;

    $update_data = $koneksi->prepare("UPDATE cart SET jumlah = ? WHERE id_barang = ?");
    $update_data->bind_param("ii", $jumlah_barang, $id_produk);
    $update_data->execute();
    $update_data->close();

} else {
    $insert_data = $koneksi->prepare("INSERT INTO cart (id_barang, jumlah) VALUES (?, ?)");
    $jumlah_default = 1; 
    $insert_data->bind_param("ii", $id_produk, $jumlah_default);
    $insert_data->execute();
    $insert_data->close();
}

$cek_data->close();
$koneksi->close();

echo "<script>location='index.php';</script>";
?>
