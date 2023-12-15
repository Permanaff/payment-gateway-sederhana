<?php
include "koneksi.php";

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
</head>
<body>
    <?php include "layout.php"?>
    <div class="container mt-5 mb-5">
        <div class="d-flex gap-5 mt-3 ms-5 flex-wrap" style="margin-bottom: -5px;">
            <h4  class="">Semua Transaksi</h4>
        </div>
        <div class="d-flex justify-content-center gap-5 mt-3 flex-wrap">   
        <?php foreach ($data as $row): ?>
            <div class="card h-100 shadow-sm" style="width: 50rem; height: 16rem;">
                <div class="card-body">
                    <p class="text-secondary">
                        Order ID : <span class="text-black" >#<?php echo $row['order_id']?></span> 
                        | Status : <span class="fw-medium text-black"><?php echo strtoupper($row['status_transaksi'])?></span>
                        </p>
                   
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
                            <p class="mb-0">x 3</p>
                        </div>
                        <div class="col-3 text-end align-self-center">
                            <p class="mb-0">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                        </div> 
                    </div>
                    <?php endforeach; ?>
                    <hr class="my-3">
                    <div class="row mb-2 text-end ">
                        <div class="col-8 fs-6 align-self-center">Subtotal</div>
                        <div class="col-4 align-self-center text-end fw-medium fs-5">
                            Rp  <?php echo number_format($row['subtotal'], 0, ',', '.'); ?>
                        </div>
                    </div>
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