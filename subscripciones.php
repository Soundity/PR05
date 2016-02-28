<?php
 include('conexion.php');
  session_start();
if(isset($_SESSION['id']))$login = 1;
if(isset($_COOKIE['Soundity']))$login = 1;
  if(isset($login)){

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Soundity</title>
    <link href="css/generic.css" rel="stylesheet" type="text/css" />
  <body>
  <?php include('header_menu.html');
$sql="SELECT * FROM tbl_subscripcions INNER JOIN tbl_usuari ON tbl_subscripcions.usu_id=tbl_usuari.usu_id WHERE tbl_usuari.usu_id=1";
$datos = mysqli_query($con, $sql);
  if(mysqli_num_rows($datos)<=0){
    echo "</br>";
    echo "No estas subscrito a nada";
  }else{
    while($suscr = mysqli_fetch_array($datos)) {
      $sql1="SELECT * FROM tbl_usuari WHERE usu_id=$suscr[usu_idorigen]";
      $datos1 = mysqli_query($con, $sql1);
      $user=mysqli_fetch_array($datos1);
      echo "</br>";
      echo "$user[usu_nom]  ";
      echo "<a href=subscripciones.proc.php>Desubscribirse</a>";
    }
  }
?>
    </body>
</html>
<?php
  }else{
    $_SESSION['validarse'] = 'error';
    header("Location: login.php");
    die();
  }
?>