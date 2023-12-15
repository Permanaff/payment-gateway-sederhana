<?php
// Contoh data JSON dari PHP
$items = json_encode(["senin", "selasa", "kamis"]);

// Escape data JSON agar tidak mempengaruhi HTML
$escapedItems = htmlspecialchars($items, ENT_QUOTES, 'UTF-8');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form PHP Pertama</title>
</head>
<body>

<form id="myForm" action="file2.php" method="post">
    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama" required>

    <label for="alamat">Alamat:</label>
    <textarea id="alamat" name="alamat" required></textarea>

    <input type="hidden" name="items" value="<?php echo $escapedItems; ?>">


    <button type="button" onclick="submitForm()">Kirim Data</button>
</form>

<div id="response"></div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
function submitForm() {
    $.ajax({
        type: "POST",
        url: "file2.php",
        data: $("#myForm").serialize(),
        success: function(response) {
            $("#response").html(response);
        },
        error: function(error) {
            console.log("Error: " + error);
        }
    });
}
</script>

</body>
</html>
