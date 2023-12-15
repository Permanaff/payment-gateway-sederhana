<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Mengambil data yang dikirim melalui POST
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $items = $_POST["items"];

    // Proses data atau lakukan operasi lain sesuai kebutuhan
    
    // Merespons ke PHP File Pertama
    echo "Data yang dikirim:<br>";
    echo "Nama: " . $nama . "<br>";
    echo "Alamat: " . $alamat;
    echo "Alamat: " . $items;
} else {
    // Jika akses langsung ke file_kedua.php tanpa melalui POST, berikan pesan error
    echo "Akses tidak sah.";
}
?>
