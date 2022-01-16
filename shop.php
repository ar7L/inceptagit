<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/shop.css">
    <title>Incepta Pharmacy</title>
</head>
<body>
    <div class="header">
        <img class="logo" src="pics/incepta.png" alt="logo">
        <h1>Incepta Pharmacy</h1>
    </div>
    <div class="search">
        <label for="search-item">Search:</label>
        <input type="search" id="search-item" name="search" placeholder="Search item">
        <input type="button" value="Search">
    </div>
    <div class="stock">
        <table>
            <div class="caption">
                <caption>Stock</caption>
            </div>
            <tr>
                <th>Item Id</th>
                <th>Item name</th>
                <th>Price per unit</th>
                <th>Refill</th>
                <th>Delete item</th>
                <th>Quantity</th>
            </tr>
        </table>
    </div>
    <div class="cart">
        <table>
            <caption>Cart</caption>
            <tr>
                <th>Item Id</th>
                <th>Item name</th>
                <th>Price per unit</th>
                <th>Quantity</th>
                <th>Total price</th>
            </tr>
        </table>
        <div class="button">
           <h3>Know your discount</h3><br>
           <p>
            $50 and above - 5% <br>
            $100 and above - 10% <br>
            $150 and above - 15% <br>
            $200 and above - 20% <br> 
           </p><br>
           <h4>Total price: </h4>
           <h4>Discount: </h4>
           <h4>Final price: </h4><br>
           <button class="clear">Clear cart</button><br>
           <button class="purchase">Confirm purchase</button>
        </div>
    </div>
    <div class="orders">
        <button class="order"><a href="orders.php">Show orders</a></button>
    </div>
    <div class="footer">
        &copy; Incepta Pharmacy
    </div>
</body>
</html>