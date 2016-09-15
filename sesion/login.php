<?php session_start(); ?>
<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$claveErr = $emailErr = "";
$clave = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["clave"])) {
    $claveErr = "Clave is required";
  } else {
    $clave = test_input($_POST["clave"]); 
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }

   if ($claveErr == "" && $emailErr == "") {
   	$_SESSION["usuario"]=$email;
   	$_SESSION['LAST_ACTIVITY'] = time();
   //	header('Location: '.$_GET['rd']);
   	echo "<script type='text/javascript'> alert('".$_GET['rd']."');window.location='http://".$_GET['rd']."';</script>";
   }
  
 
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?rd=".$_GET['rd'];?>">  
 
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>

  Clave: <input type="text" name="clave" value="<?php echo $clave;?>">
  <span class="error">* <?php echo $claveErr;?></span>
  <br><br>
 
  <input type="submit" name="submit" value="Submit">  
</form>

</body>
</html>