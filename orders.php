<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/orders.css">
    <script src="js/orders.js"></script>
    <title>Incepta Pharmacy</title>
</head>
<body>
    <div class="header">
        <img class="logo" src="pics/incepta.png" alt="logo">
        <h1>Incepta Pharmacy</h1>
    </div>
    <div class="orders">
        <table>
            <caption>Orders</caption>
            <tr>
                <th>Reciept Id</th>
                <th>Item name</th>
                <th>Item price</th>
                <th>Quantity</th>
                <th>Date of purchase</th>
            </tr>
        </table>
    </div>
    <div class="refund-order">
        <button class="refund-btn" onclick="Refund()">Refund an order</button>
    </div>
    <div class="footer">
        &copy; Incepta Pharmacy
    </div>
    <div id="refund" class="modal-1">
        <div class="modal-1-content">
            <button class="close" onclick="Refund_close()">&times;</button>
            <label for="refund-order">Reciept number:</label><br><br>
            <input id="refund-order" name="refund" type="text" placeholder="Reciept number"><br><br>
            <button>Refund order</button>
        </div>
    </div>
</body>
</html>