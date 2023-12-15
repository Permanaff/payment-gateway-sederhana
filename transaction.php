<?php
include "koneksi.php";

$order_id = $_GET['order_id'];

$query = $koneksi->query("SELECT * FROM transaksi WHERE order_id = '$order_id'");
$result = $query->fetch_assoc();

echo $result;

?>