<?php include('Fun.php');
   include('connection.php');
   session_start();
   if(empty($_SESSION['admin_name']) && empty($_SESSION['staff_name'])){
      header("location: index.php");
   }

?>

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
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Item Id</th>
                <th scope="col">Item name</th>
                <th scope="col">Price per unit</th>
                <th scope="col">Refill</th>
                <th scope="col">Delete item</th>
                <th scope="col">Quantity</th>
                <!-- <th scope="col">Add</th> -->
            </tr>
        </thead>
        <tbody>
            <?php 

                $drugs = getAll("drugs");
                for($i = 0 ; $i < count($drugs); $i++){
                    $meta = $drugs[$i]['drug_id'].'-'.$drugs[$i]['drug_name'].'-'.$drugs[$i]['drug_price'].'-'.$drugs[$i]['drug_quantity'];
                    ?>

                 <tr class = "t-row">
                     <th scope="row"><?php echo $i+1; ?></th>
                     <td class = "p-name"> <?php echo $drugs[$i]['drug_id'] ?> </td>
                     <td  id = "t-name"> <?php echo $drugs[$i]['drug_name'] ?> </td>
                     <td> <?php echo $drugs[$i]['drug_price'] ?> </td>
                     <td> <a href="#" id = "mySizeChart" data-met = "<?php echo $meta;?>" >Refil</a> </td>
                     <td> <a href="shop.php?del_id = <?php?>">Delete</a> </td>
                     <td> <input id = "<?php echo "quantity".$meta[0]; ?>" type="text" placeholder="Quantity"/></td>
                     <td> <button class = "dev-btn" id = "<?php echo $meta; ?>" onclick = "add_to(this.id)" >+</button> </td>
                 </tr>
               <?php }
                     
            ?>
            </tbody>
        </table>
    </div>
    <div class="cart">
        <table id = "cart_table">
            <caption>Cart</caption>
            <tr>
                <th>Item Id</th>
                <th>Item name</th>
                <th>Price per unit</th>
                <th>Quantity</th>
                <th>Total price</th>
            </tr>
        </table>
        <hr>
        <h4>Total amount <span id = "gtotal">  </span></h4>
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
           <form action="shop.php" method="POST">
               <input type="hidden" id = "hidden-info" name = "hidden-info" value="" />
               <input type = "submit" name = "confirm" class="purchase" value = "Confirm purchase">
           </form>
           <?php
                
                //Confirming purchase//

               if(isset($_POST['confirm'])){
                  $info = $_POST['hidden-info'];
                  if(!empty($info)){
                    $phpArr = json_decode($info,true);
                    
                    foreach($phpArr as $k => $v){
                        $order_reciept = uniqid();
                        $order_name = $v['name'];
                        $order_price = $v['price'];
                        $order_quantity = $v['quantity'];
                        $order_dop = date('Y-m-d H:i:s');
                        $upd = $v['actual'];
                        $send = array($order_reciept, $order_name,$order_price,$order_quantity,$order_dop);
                        myInsert("order_list",$send,"orders.php");
                    }

                  }
               }

                //Confirming purchase//

           ?>
        </div>
    </div>
    <div class="orders">
        <button class="order"><a href="orders.php">Show orders</a></button>
    </div>
    <div class="footer">
        &copy; Incepta Pharmacy
    </div>

    <!-- MY MODAL  -->
            <!-- <h2>Modal Example</h2>   -->


        <!-- <a href="#" id="mySizeChart">Open Modal</a> -->


        <div id="mySizeChartModal" class="ebcf_modal">

            <?php
               if(isset($_POST['refil'])){
                  $drug_quantity = $_POST['modal-quant'];
                  $drug_id = $_POST['hide'];
                  $data = compact('drug_quantity');
                  $sql = "UPDATE drugs SET drug_quantity = '$drug_quantity' WHERE drug_id = '$drug_id'";
                  $res = mysqli_query($conn , $sql);
                  if($res){
                    header("location: shop.php");
                  }
                  // myDelete("drugs",$data,$drug_id,"shop.php");
                  // header("location:shop.php");
               }
            ?>

          <form action="shop.php" method="POST">
              <div class="ebcf_modal-content">
                <span class="ebcf_close">&times;</span>
                <p id = "my-modal">Some text in the Modal..</p>
                <input name = "hide" id = "hide" type="hidden"/>
                <input type= "text" name = "modal-quant" id = "modal-input" placeholder="refill" />
                <input type = "submit" name = "refil" value = "Refill" />
              </div>
          </form>

        </div>
    <!-- MY MODAL  -->

    <script>
        let hidden = document.getElementById('hidden-info');
        let grand = 0;
        let deduced = 0;
        let php_data = [];
        function add_to(meta){
            let cart = document.getElementById('cart_table');
            let arr = meta.split('-');
            let val = document.getElementById('quantity'+arr[0]).value;
            let createRow = document.createElement("tr");
            let gt = document.getElementById('gtotal');
            php_data.push({
                id: arr[0],
                name: arr[1],
                price: arr[2],
                quantity: val,
                actual: arr[3]
            })
            let tot = parseInt(val) * parseInt(arr[2]);
            hidden.value = JSON.stringify(php_data);
            grand += tot;
            deduced = grand;
            if(grand > 200)deduced = grand*0.20;
            else if(grand > 150)deduced = grand*0.15;
            else if(grand > 100)deduced = grand*0.10;
            else if(grand > 50)deduced = grand*0.05;
            createRow.innerHTML += `
              <td>${arr[0]}</td>
              <td>${arr[1]}</td>
              <td>${arr[2]}</td>
              <td>${val}</td>
              <td>${tot}</td>
            `;
            cart.appendChild(createRow);
            gt.innerText = deduced;
        }

        //MODAL javascript 
        // Get the modal
        var ebModal = document.getElementById('mySizeChartModal');

        // Get the button that opens the modal
        var ebBtn = document.getElementById("mySizeChart");

        // Get the <span> element that closes the modal
        var ebSpan = document.getElementsByClassName("ebcf_close")[0];
        var p = document.getElementById("my-modal");
        var inp = document.getElementById("modal-input");
        var hide = document.getElementById("hide");
        // When the user clicks the button, open the modal 
        ebBtn.onclick = function() {
            let x = this.dataset.met;
            let y = x.split('-');
            p.innerText = `Drug Name : ${y[1]}`;
            inp.value = `${y[3]}`;
            hide.value = `${y[0]}`;
            ebModal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        ebSpan.onclick = function() {
            ebModal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == ebModal) {
                ebModal.style.display = "none";
            }
        }
        //MODAL javascript

        //searching 
        function searching(){
            console.log("hello");
            let x = document.querySelector("#search-item");
            x.addEventListener("keyup",(e)=>{
                let searchVal = e.target.value;
                console.log(searchVal.length);
                let rows = document.querySelectorAll(".t-row");
                for(let row of rows){
                    let td = row.querySelector('#t-name').textContent.toLowerCase().trim();
                    console.log(td);
                    if(td.startsWith(searchVal)){
                        row.style.display = "";
                    }else{
                        row.style.display = "none";
                    }
                }
            });
        }
        searching();
        //searching 
        function sendMe(){
            console.log(php_data)
        }
    </script>
</body>
</html>