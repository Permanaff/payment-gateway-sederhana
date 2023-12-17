<?php
include "koneksi.php";

$order_id = $_GET["order_id"];

$transaksi = "SELECT 
    t.id,
    t.order_id,
    t.nama_customer AS nama,
    t.email,
    t.phone,
    t.subtotal,
    t.items_details AS product,
    t.status_transaksi,
    p.image AS product_image
FROM transaksi t
JOIN products p ON JSON_UNQUOTE(JSON_EXTRACT(t.items_details, '$[0].id')) = p.id
WHERE t.order_id = $order_id
ORDER BY t.id DESC";


$result = $koneksi->query($transaksi);

$data = $result->fetch_all(MYSQLI_ASSOC);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TokoSneakers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm bg-body  py-3">
        <div class="container-fluid mx-5">
            <a class="navbar-brand" href="index.php">TokoSneakers</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-flex ">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pembelian.php">Purchase</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="cart.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                            </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5 d-flex justify-content-center flex-wrap">
        <?php foreach ($data as $row): ?>
        <div class="card rounded-0">
            <div class="card-header text-center">
                <?php if ($row['status_transaksi'] == "settlement"): ?>
                <img src="image/check.gif" width="25%">
                <h3>Pembayaran Sukses</h3>
                <?php elseif ($row['status_transaksi'] == "pending"): ?>
                <!-- <img src="image/check.gif" width="25%"> -->
                <h3>Pembayaran Pending</h3>
                <?php elseif ($row['status_transaksi'] == "cancel"): ?>
                <img class="my-2 mx-2" src="image/error.gif" width="15%">
                <h3>Pembayaran Dibatalkan</h3>
                <?php else: ?>
                <img class="my-2 mx-2" src="image/error.gif" width="15%">
                <h3>Pembayaran Gagal</h3>
                <?php endif; ?>
                <p class="text-secondary">Order ID : #<?php echo $row['order_id'] ?></p>

            </div>

            <div class="card-body">
                <p class="fs-5">Customer Details</p>
                <hr class="mt-3 mb-2">
                <p class="fs-6 my-1"><?php echo $row['nama']?></p>
                <p class="fs-6 my-1"><?php echo $row['email']?></p>
                <p class="fs-6 my-1"><?php echo $row['phone']?></p>
                <hr class="my-2">
                <p class="fs-5">Product Details</p>
                <?php foreach (json_decode($row['product'], true) as $product): 
                    $product_id = $product['id'];
                    $images = $koneksi->query("SELECT image FROM products WHERE id = '$product_id'");
                    $image = $images->fetch_assoc();
                ?> 
                <hr class="my-3">
                <div class="row">
                    <div class="col-2 pe-0">
                        <img class="rounded" src="image/<?php echo $image['image'] ?>" width="100%">
                    </div>
                    <div class="col-7">
                        <p class="mb-0 fw-medium"><?php echo $product['name']?></p>
                        <p class="mb-0">x <?php echo $product['quantity']?></p>
                    </div>
                    <div class="col-3 text-end align-self-center">
                        <p class="mb-0">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                    </div> 
                </div>
                <?php endforeach; ?>
                <hr class="my-3">
                <div class="row mb-2 text-end ">
                    <div class="col-9 fs-6 align-self-center">Subtotal</div>
                    <div class="col-3 align-self-center text-end fw-medium fs-5">
                        Rp  <?php echo number_format($row['subtotal'], 0, ',', '.'); ?>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <a href="index.php" class="btn btn-primary rounded-0">Back To Home</a>
                </div>
            </div>
        <?php endforeach; ?>

        </div>
        <div class="row mt-5 pt-5"></div>
    </div>
    
    <footer class="mt-5" style="background-color: #fff ;padding: 20px 0; position: relative; bottom: 0; width: 100%;">
        <hr class="my-4">
        <div class="container"><p class="m-0 text-center text-black">Copyright &copy; TokoSneakers 2023</p></div>
    </footer>

    





</body>
</html>