<?php
include 'koneksi.php';

$query = "SELECT * FROM products";
$result = $koneksi->query($query);


$row1 = $result->fetch_assoc();
$row2 = $result->fetch_assoc();
$row3 = $result->fetch_assoc();
$row4 = $result->fetch_assoc();
$row5 = $result->fetch_assoc();

$order_id = $_GET['order_id'];
echo $order_id;
// $order_id2 = $_POST['order_id'];
// echo $order_id2;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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


    <div id="carouselExampleRide" class="carousel slide" data-bs-ride="true">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="image/header1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="image/header2.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <div class="container mt-5 mb-5" id="semua-product">
        <div class="d-flex mt-3 ms-4" style="margin-bottom: -5px;">
            <h4>Semua Produk</h4>
        </div>

        <div class="d-flex justify-content-center gap-5 mt-3 flex-wrap" id="semua-produk">
            <div class="card h-100 shadow-sm" style="width: 12rem; height: 16rem;">
                <img src="image/<?php echo $row1['image']; ?>" class="card-img-top rounded-0" alt="<?php echo $row1['name']; ?>"
                    style="height: 10rem;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row1['name']; ?></h5>
                    <p class="card-text">Rp<?php echo number_format($row1['price'], 0, ',', '.'); ?></p>
                    <a href="beli.php?id=<?php echo $row1['id'];?>" class="btn btn-primary">Beli</a>
                </div>
            </div>

            <div class="card h-100 shadow-sm" style="width: 12rem; height: 16rem;">
                <img src="image/<?php echo $row2['image']; ?>" class="card-img-top" alt="<?php echo $row2['name']; ?>"
                    style="height: 10rem;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row2['name']; ?></h5>
                    <p class="card-text">Rp<?php echo number_format($row2['price'], 0, ',', '.'); ?></p>
                    <a href="beli.php?id=<?php echo $row2['id'];?>" class="btn btn-primary">Beli</a>
                </div>
            </div>
            <div class="card h-100 shadow-sm" style="width: 12rem; height: 16rem;">
                <img src="image/<?php echo $row3['image']; ?>" class="card-img-top" alt="<?php echo $row3['id'];?>"
                    style="height: 10rem;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row3['name']; ?></h5>
                    <p class="card-text">Rp<?php echo number_format($row3['price'], 0, ',', '.'); ?></p>
                    <a href="beli.php?id=<?php echo $row3['id'];?>" class="btn btn-primary">Beli</a>
                </div>
            </div>
            <div class="card h-100 shadow-sm" style="width: 12rem; height: 16rem;">
                <img src="image/<?php echo $row4['image']; ?>" class="card-img-top" alt="<?php echo $row4['name']; ?>"
                    style="height: 10rem;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row4['name']; ?></h5>
                    <p class="card-text">Rp<?php echo number_format($row4['price'], 0, ',', '.'); ?></p>
                    <a href="beli.php?id=<?php echo $row4['id'];?>" class="btn btn-primary">Beli</a>
                </div>
            </div>
            <div class="card h-100 shadow-sm" style="width: 12rem; height: 16rem;">
                <img src="image/<?php echo $row5['image']; ?>" class="card-img-top" alt="<?php echo $row5['name']; ?>"
                    style="height: 10rem;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row5['name']; ?></h5>
                    <p class="card-text">Rp<?php echo number_format($row5['price'], 0, ',', '.'); ?></p>
                    <a href="beli.php?id=<?php echo $row5['id'];?>" class="btn btn-primary">Beli</a>
                </div>
            </div>
            
        </div>
        <div class="row mt-5 pt-5"></div>

    </div>


    <footer class="mt-5" style="background-color: #fff ;padding: 20px 0; position: relative; bottom: 0; width: 100%;">
        <hr class="my-4">
        <div class="container"><p class="m-0 text-center text-black">Copyright &copy; TokoSneakers 2023</p></div>
    </footer>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // document.querySelector('.myButton').addEventListener('click', function() {
        //     alert('Tombol diklik!');
        // });
    </script>
</body>
</html>
