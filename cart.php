<?php
include 'koneksi.php';


$keranjang = "SELECT cart.*, products.name, products.price, products.image
              FROM cart
              INNER JOIN products ON cart.id_barang = products.id";


$result = $koneksi->query($keranjang);

$rows = $result->fetch_all(MYSQLI_ASSOC);

$dataBarang = array();
foreach ($rows as $row) {
    $subtotal = $row['jumlah'] * $row['price'];
    $total += $subtotal;

    $id = $row['id'];
    $id_barang = $row['id_barang'];
    $jumlah = $row['jumlah'];
    $nama_barang = $row['name'];
    $harga_barang = $row['price'];
    $gambar_barang = $row['image'];

    $dataBarang[] = array(
        'id' => $id_barang,
        'price' => $harga_barang,
        'quantity' => $jumlah,
        'name' => $nama_barang,
    );
};

$items = json_encode($dataBarang);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript"
		src="https://app.sandbox.midtrans.com/snap/snap.js"data-client-key="SB-Mid-client-DG3O1SszFRlzErbv"></script>
    <title>Cart | TokoSneakers</title>
    <?php include 'layout.php' ?>
</head>
<body>
    <div class="container mt-5"></div>
        <div class="container">
                <div class="row d-flex">
                    <div class="col">
                        <p class="fs-5 fw-medium">Customer Detail</p>
                        <form id="form-detail-cart" action="payment/paymentProcess.php" method="POST">
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="First name">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <textarea id="address" name="address" class="form-control" rows="2" placeholder="Address"></textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                                </div>
                                <input type="hidden" id="items" name="items" value='<?php echo json_encode($dataBarang); ?>'>
                                <input type="hidden" id="total" name="total" value="<?php echo $total ?>">
                            </div>
                        
                        </form>
                        <hr class="my-3">
                        <div class="row">
                            <div class="col" id="snap-container">
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mx-1">
                                    <a href="" style="text-decoration: none;">
                                        <i class="bi bi-cart" style="color: #000;">
                                            <p class="fs-4 text fw-medium text-start">Cart</p>
                                        </i>
                                    </a>
                                    
                                    <?php foreach ($rows as $row): ?>
                                    <div class="row mt-3">
                                        <div class="col d-flex align-items-center">
                                            <div class="col-2">
                                                <img class="rounded" src="image/<?php echo $row['image'] ?>" width="100%" alt="Product Image">
                                            </div>
                                            <div class="col-4 ms-4">
                                                <p class="mb-0"><?php echo $row['name'] ?></p>
                                            </div>
                                            <div class="col-2 text-center">
                                                <p class="mb-0">x <?php echo  $row['jumlah'] ?></p>
                                            </div>
                                            <div class="col-3 text-end">
                                                <p class="mb-0">Rp <?php echo number_format($row['price']*$row['jumlah'], 0, ',', '.'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    
                                </div>
                                <hr class="my-2">
                                <div class="row mx-1">
                                    <div class="row mb-2 text-end">
                                        <div class="col-8 fs-6 ">Subtotal</div>
                                        <div class="col-4">
                                            <p class="text-end fw-medium fs-5">Rp  <?php echo number_format($total, 0, ',', '.'); ?></p>
                                        </div>
                                    </div>
                                    <button id="checkout-btn" type="button" class="btn btn-primary" onclick="submitForm()" disabled>Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
        </div>
        <div class="row mt-5 pt-5"></div>
    </div>
    
    <footer class="mt-5" style="background-color: #fff ;padding: 20px 0; position: relative; bottom: 0; width: 100%;">
        <hr class="my-4">
        <div class="container"><p class="m-0 text-center text-black">Copyright &copy; TokoSneakers 2023</p></div>
    </footer>
    

             
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>

        const form = document.querySelector('#form-detail-cart')
        const checkoutBtn = document.querySelector('#checkout-btn')
                
        form.addEventListener('input', function() {
            for (let i = 0; i < form.elements.length; i++){
                if (form.elements[i].value.length !== 0 ) {
                    checkoutBtn.removeAttribute("disabled");
                    checkoutBtn.setAttribute("disabled", true);
                } else {
                    return false;
                }
            }
            checkoutBtn.removeAttribute("disabled");
        });


        function submitForm() {
            $.ajax({
                type: "POST",
                url: "payment/paymentProcess.php",
                data: $("#form-detail-cart").serialize(),
                success: function(response) {
                    window.snap.embed(response, {
                        embedId: 'snap-container'
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

    </script>

</body>
</html>