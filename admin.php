<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <script src="js/admin.js"></script>
    <title>Incepta Pharmacy</title>
</head>
<body>
     <?php 
       include('Fun.php');
       session_start();
       $admin_name = $_SESSION['admin_name'];
       if(empty($admin_name)){
           header("location:index.php");
       }

       if(isset($_POST['add_member'])){
          $name = $_POST['staff_name'];
          $surnname = $_POST['staff_surname'];
          $user_name = $_POST['staff_username'];
          $dob = $_POST['staff_dob'];
          $password = $_POST['staff_password'];

          $data = array($name , $surnname, $dob, $user_name, $password);

          myInsert("staff",$data , "admin.php");
       }

       if(isset($_POST['staff_remover'])){
           $remove_id = $_POST['staff'];
           deleteBy("staff","WHERE staff_id = '$remove_id'", "admin.php");
       }

     ?> 
    <div class="header">
        <img class="logo" src="pics/incepta.png" alt="logo">
        <h1>Incepta Pharmacy</h1>
    </div>
    <h2>Welcome <?php echo $admin_name; ?>!</h2>
    <button class="func-1" onclick="Show_staff()">Add or remove a staff member</button>
    <button class="func-2" onclick="Show_drug()">Add or remove an item</button>
    <button class="func-3" onclick="Show_info()">About Incepta Pharmacy</button>
    <div class="footer">
        &copy; Incepta Pharmacy
    </div>
    <div id="about" class="modal">
        <div class="modal-content">
        <button class="close" onclick="Hide_info()">&times;</button>
        <h3>About Incepta Pharmacy</h3>
        <p>Incepta Pharmacy was founded in 1978 and is one of the lagest branch of pharmacies in Bangladesh. 
        It has medicines and medical equipments of all types, both from local and international brands. The main 
        branch is located in Jatrabari, Dhaka. It proves to be the top pharmacy among all other pharmacies in 
        Bangladesh. Currently, Incepta Pharmacy has 40 branches all over the country.
        </p>
        </div>
    </div>
    <div id="staff" class="modal-2">
        <div class="modal-2-content">
            <button class="close-2" onclick="Hide_staff()">&times;</button>
            <h3>Add a new member</h3><br>
            <div class="form">
                <form action="#" target="#" method="post" enctype="multipart/form-data" autocomplete="off">
                    <label for="name">Name: </label>
                    <input type="text" id="name" name="staff_name" placeholder="Name" required><br><br>
                    <label for="surname">Surname: </label>
                    <input type="text" id="surname" name="staff_surname" placeholder="Surname" required><br><br>
                    <label for="dob">Date of birth: </label>
                    <input type="date" id="dob" name="staff_dob" required><br><br> 
                    <label for="username">Username: </label>
                    <input type="text" id="username" name="staff_username" placeholder="Username" required><br><br>
                    <label for="password">Password: </label>
                    <input type="password" id="password" name="staff_password" placeholder="Password" required><br><br>
                    <input type="submit" value="Add member" name = "add_member">
                </form>
            </div><br><br>
            <h3>Remove an existing member</h3>
            <form action="admin.php" method="POST">
                <div class="rmv">
                <label for="member"></label>
                <select name="staff" id="member" class="member">
                    <?php $memebers = getAll("staff");
                        for($i = 0 ; $i < count($memebers); $i++){
                            ?>
                         <option value=<?php echo $memebers[$i]['staff_id'];?> > <?php echo $memebers[$i]['staff_username']; ?> </option>
                       <?php }
                     ?>
                    
                    
                </select><br><br>

                <input type = "submit" name = "staff_remover" value = "Remove members" class="member-btn"/>
            </div>
            </form>
        </div>
    </div>
    <div id="drug" class="modal-3">
        <div class="modal-3-content">
            <button class="close-3" onclick="Hide_drug()">&times;</button>
            <div class="content">
            <h3>Add a new item</h3><br>
            <label for="drug-name">Name of item</label><br><br>
            <input id="drug-name" name="drug-name" type="text" placeholder="Drug name" required><br><br>
            <label for="drug-price">Price per unit</label><br><br>
            <input id="drug-price" name="drug-price" type="number" placeholder="Price per unit" required><br><br>
            <button class="add-drug">Add item</button><br><br>
            <h3>Remove an item</h3><br>
            <select name="drug"></select><br><br>
            <button class="rmv-drug">Remove</button>
            </div>
        </div>
    </div>
</body>
</html>