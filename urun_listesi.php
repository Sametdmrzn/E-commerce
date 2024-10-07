<?php
include 'db.php'; // Veritabanı bağlantısını ekledik

// Ürünleri veritabanından çekme sorgusu
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Listesi</title>
</head>
<body>

<h2>Ürün Listesi</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Ürün Adı</th>
        <th>Fiyat</th>
        <th>Stok Miktarı</th>
        <th>Kategori</th>
        <th>İşlemler</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["price"] . "</td>";
            echo "<td>" . $row["stock_quantity"] . "</td>";
            echo "<td>" . $row["category"] . "</td>";
            echo "<td><a href='delete_product.php?id=" . $row["id"] . "'>Sil</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Ürün bulunamadı.</td></tr>";
    }
    ?>
</table>

</body>
</html>
