<?php 
session_start();
include('includes.html');
 ?>
<!DOCTYPE html>
<head>
<title>List</title>
<style>
table {
    border-collapse: collapse;
}

table, th, td{
    border: 1px solid black;
    padding: 10px 10px
}
#homenav{
    text-decoration:none; 
    color:black; 
}
</style>
</head>
<body>
<a href="index.php" id="homenav"><h1>Welcome to TheGarageSale Project.</h1></a>


<button id="rightbtn"><a href="index.php" id="homenav">Logout</a></button>
<br>

<?php
if(isset($_SESSION['msg']) and $_SESSION['additem_prev'] == true){
    echo $_SESSION['msg'];
    unset($_SESION['msg']);
}
$servername = "localhost";
$username = "default_u";
$password = "letmeinmysql";
//check if previous page was additem.php
    $_SESSION['additem_prev'] = false;
    $conn = new mysqli($servername, $username, $password, "tgsp_users");
   

//Make sure connection works


if (!$_SESSION['userloggedin']){
$_SESSION['userloggedin'] = false; 
$users_chk = $conn->query("SELECT passwd FROM users WHERE username='default';");
while($row = $users_chk->fetch_assoc()){
    if($_POST['passwd'] == $row["passwd"]){
        $_SESSION['userloggedin'] = true; 
    }
}
if($_SESSION['userloggedin'] == false){
    $_SESSION['msg'] = "Your passsword is incorrect. Please try again.";
    header("Location: index.php");
    
}
}
$conn->query("USE tgsp_catalog;");


$sql = "SELECT * FROM Items";
$result = $conn->query($sql);

if($result->num_rows > 0){
    echo "
    <br>
    <table>
    <tr>
    <th>Name</th>
    <th>List Price</th>
    <th>Quantity</th>
    <th>Sale Price</th>
    </tr>";
    $counter = 1; 
    while($row = $result->fetch_assoc()){
        echo "<tr><td>".$row["name"]."</td><td>$".$row["price"]."</td><td>".$row["qty"]."</td>
        <td onclick='$(\"#mod_saleprice_" . $counter. "\").show()' >$" . $row["saleprice"] . "
        <form method=\"GET\" action=\"modifysalepriceitem.php\" id=\"mod_saleprice_".$counter."\" style=\"display:none\">
        <input type=\"hidden\" name=\"item_name\" value=\"" .$row['name']."\">
        <input name=\"newprice\" type=\"number\" step=\"0.01\" min=\"0\">
        <input type=\"submit\" value=\"Go\" >
        </form>
        </td></tr>";
        $counter = $counter + 1; 
    }
    echo "</table>";
    $saletotal = $conn->query("SELECT SUM(saleprice) FROM Items;");
    if($saletotal->num_rows > 0){
    while($row = $saletotal->fetch_assoc()){
        echo "<br>Total Made: $" . $row["SUM(saleprice)"] . "<br>";
    }}
}

else{
   echo "No Items! Press \"Add Item\" to get started.<br><br>";
}
?>

<br><button onclick="document.getElementById('additemform').style.display='block'">Add Item</button>
<br><br><form style="display:none;" method="GET" action="additem.php" id="additemform">
    Name: <input name="name" id="name"><br><br>
    Price: <input name="price" id="price"><br><br>
    Quantity: <input name="qty" id="qty"><br><br>
    <input type="submit" value="Submit" name="submit" >
 </form>

<!--modify qty-->
 <button id="modifyqtybtn">Modify Quantity</button>
<br><br><form method="GET" action="modifyqtyitem.php" style="display:none" id="mod_itemqty_form">
Name of Item: <input id="item_name" name="item_name"><br><br>
New Quantity for Item: <input name="newqty"><br><br>
<input type="submit" value="Submit">
</form>
<script>
    $('#modifyqtybtn').click(function(){
       $('#mod_itemqty_form').show(); 
    });
</script>


<!--modify price-->
<button id="modifypricebtn">Modify Price</button>
<br><br><form method="GET" action="modifypriceitem.php" style="display:none" id="mod_itemprice_form">
Name of Item: <input id="item_name" name="item_name"><br><br>
New Price for Item: <input name="newprice"><br><br>
<input type="submit" value="Submit">
</form>
<script>
    $('#modifypricebtn').click(function(){
       $('#mod_itemprice_form').show(); 
    });
</script>



<!--modify sale price-->
<button id="modifysalepricebtn">Modify Sale Price</button>
<br><br><form method="GET" action="modifysalepriceitem.php" style="display:none" id="mod_itemsaleprice_form">
Name of Item: <input id="item_name" name="item_name"><br><br>
Sale Price for Item: <input name="newprice"><br><br>
<input type="submit" value="Submit">
</form>
<script>
    $('#modifysalepricebtn').click(function(){
       $('#mod_itemsaleprice_form').show(); 
    });
</script>




<!--rem-item-->
<button id="remitembtn">Remove Item</button>
<br><br><form method="GET" action="removeitem.php" style="display:none" id="rem_item_form">
Name of Item: <input name="item_name"><br><br>
<input type="submit" value="Submit (WARNING: This cannot be undone!)">
</form>
<script>
    $('#remitembtn').click(function(){
       $('#rem_item_form').show(); 
    });
</script>
</body>