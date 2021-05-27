<?php

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchase confirmation</title>
</head>
<body>

<?php echo "<p>$orderMessage</p>";

if (!empty($_POST['products'])) {
    echo "Your order:";
    foreach (($_POST['products']) as $key => $value) {
        $price = $products[$key]['price'];
        $totalValue += $price;
        $orderItemName = $products[$key]['name'];
        echo "<li>Item: $orderItemName - Price: €$price</li>";
    }
    if (isset($_POST['express_delivery'])) {
        $totalValue += 5;
    }


echo getDeliveryTime();

echo "Total: €$$orderValue <br />"; }
?>





</body>
</html>



