<?php
/*Install Midtrans PHP Library (https://github.com/Midtrans/midtrans-php)
composer require midtrans/midtrans-php
                              
Alternatively, if you are not using **Composer**, you can download midtrans-php library 
(https://github.com/Midtrans/midtrans-php/archive/master.zip), and then require 
the file manually.   

require_once dirname(__FILE__) . '/pathofproject/Midtrans.php'; */

require_once dirname(__FILE__) . '/midtrans-php-master/Midtrans.php'; 

//SAMPLE REQUEST START HERE

// Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'SB-Mid-server-MkWPtSUBmoSSOJ4UkdcyilCC';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;

include "../koneksi.php";

$order_id = rand();
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$items_details = $_POST['items'];
$subtotal = $_POST['total']; 

$query = "INSERT INTO transaksi (order_id, nama_customer, email, phone, items_details, subtotal, status_transaksi) VALUES ('$order_id', '$name', '$email', '$phone', '$items_details', '$subtotal', 'proses')";
$result = $koneksi->query($query);


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $params = array(
        'transaction_details' => array(
            'order_id' => $order_id,
            'gross_amount' => $_POST["total"],
        ),
        'item_details' => json_decode($_POST["items"], true),

        'customer_details' => array(
            'first_name' => $_POST["name"],
            'last_name' => $_POST["last_name"],
            'email' => $_POST["email"],
            'phone' => $_POST["phone"],
        ),
    );

    $snapToken = \Midtrans\Snap::getSnapToken($params);

    echo $snapToken;
        
} else {
    echo "Terjadi Kesalahan!";
}

?>