<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <script src="js/index.js"></script>
    <title>Incepta Pharmacy</title>
</head>
<body>
    <?php
        include("connection.php");
        include("Fun.php");
        session_start();
        $err = 1;
        if(isset($_POST['admin_submit'])){
            $name = $_POST['admin_username'];
            $password = $_POST['admin_password'];
            $get = getBy("admin","WHERE admin_name = '$name' AND admin_password = '$password'");
            if(!empty($get)){
                foreach($get as $k => $v){
                    foreach($v as $key => $value){
                        $_SESSION[$key] = $value;
                    }
                }
                // print_r($get);
                if($_SESSION['admin_name'] == $name && $_SESSION['admin_password'] == $password){
                    echo "Hello Admin";
                    $err = 1;
                    header("location:admin.php");
                }else{
                    $err = 0;
                }
            }
            

        }
    ?>

    <div class="header">
        <img class="logo" src="pics/incepta.png" alt="logo">
        <h1>Incepta Pharmacy</h1>
    </div>
     <h1 style="color: limegreen; background-color: beige; text-align: center;">
        <?php if($err == 0){echo "ACCESS DENIED";}?> 
    </h1>
    <div class="logins">
        <button class="admin-btn" onclick="Show_admin()">Log in as Admin</button>
        <button class="staff-btn" onclick=" Show_staff()">Log in as staff</button>
    </div>
    <div id="admin-login">
        <div class="btn-close"><button onclick="Hide_admin()">Close</button></div>
        <form action="index.php" method="POST" enctype="multipart/form-data">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="admin_username" required placeholder="Your username"><br><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="admin_password" required placeholder="Your password"><br><br>
            <input type="reset">
            <input type="submit" name = "admin_submit">
        </form>
    </div>
    <div id="staff-login">
        <div class="btn-close"><button onclick="Hide_staff()">Close</button></div>
        
        <form action="index.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="staff_username" required placeholder="Your username"><br><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="staff_password" required placeholder="Your password"><br><br>
            <input type="reset">
            <input type="submit">
        </form>
    </div>
    <div class="footer">
        &copy; Incepta Pharmacy
    </div>
</body>
</html>