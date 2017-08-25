<?php session_start() ?>
<!DOCTYPE html>
<head>
<title>Add Item</title>
<style>
#homenav{
    text-decoration:none; 
    color:black; 
}

</style>
</head>
<body>
<a href="index.php" id="homenav"><h1>Welcome to TheGarageSale Project.</h1></a>


<?php
if($_SESSION['userloggedin']){
    $conn = new mysqli("localhost", "default_u", "password", "tgsp_catalog");
}
else{
    $_SESSION['msg'] = "You need to log in.";
    header("Location: index.php");
}
?>

<?php

    $name = $_GET['name'];
    $price = $_GET['price'];
    $qty = $_GET['qty'];
    echo $name . "<br>" . $price . "<br>" . $qty ."<br>";
    if(is_numeric($qty) and is_numeric($price)){
        $query = "INSERT INTO Items VALUES (\"" . $name . "\"," . $price . "," . $qty . ", NULL)";
        //echo $query; 
        $result = $conn->query($query);
        echo $result; 
        if(!$result){
            $conn->close(); 
            echo "Query did not go through: " -> $conn->mysql_error(); 
        }
        else{
            $conn->close();
            $_SESSION['additem_prev'] = true; 
            header("Location: list_items.php");
        }
        
    }
    else{
        $_SESSION['msg'] = 'Error: Your inputs for adding the item were invalid. Please try again.<br>';
        $_SESSION['additem_prev'] = true; 
        header("Location: list_items.php");
    }
   




?>
</body>
