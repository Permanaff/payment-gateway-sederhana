<?php
include '../koneksi.php';


// Query untuk mengambil data dari tabel cart dan products
$keranjang = "SELECT cart.*, products.name, products.price, products.image
              FROM cart
              INNER JOIN products ON cart.id_barang = products.id";

$hasil = $koneksi->query($keranjang);

// Memproses data
$dataBarang = array();

if ($hasil->num_rows > 0) {
    while ($row = $hasil->fetch_assoc()) {
        $id = $row['id'];
        $id_barang = $row['id_barang'];
        $jumlah = $row['jumlah'];
        $nama_barang = $row['name'];
        $harga_barang = $row['price'];
        $gambar_barang = $row['image'];

        $dataBarang[] = array(
            'nama_barang' => $nama_barang,
            'jumlah' => $jumlah,
            'harga' => $harga_barang,
            'subtotal' => $harga_barang*$jumlah,
        );
    }
    $items = json_encode($dataBarang);

    

} else {
    echo "Tidak ada data ditemukan.";
}

// Menutup koneksi
$koneksi->close();





?>