<?php session_start();
include('includes.html');
?>
<html>
  <head>
    <title>TGSP</title>
    <meta content="">
    <style></style>
  </head>
  <body>
  <h1>Welcome to TheGarageSale Project.</h1>
  <form method="POST" action="list_items.php" name="Info">
      <h1>Login</h1>
      <?php
      $_SESSION['additem_prev'] = false; 
      $_SESSION['userloggedin'] = false; 
      unset($_SESSION['additem_prev']);
        if (isset($_SESSION['msg'])){
          echo $_SESSION['msg'];
          unset($_SESSION['msg']);
          echo '<br><br>Password: <input name="passwd" type="password" style="border:1px solid red"><br><br>
          <input type="submit" value="See List of Items">';
        }
        else{
          echo 'Password: <input name="passwd" type="password"><br><br>
          <input type="submit" value="See List of Items">';
        }
      ?>
      
      
  </form>
  </body>
</html>