
<?php 
session_start();
 if(isset($_SESSION['id']))$login = 1;
 if(isset($_COOKIE['Soundity']))$login = 1;
 if($login == 1){
    include('../conexion.php');

    $sqllista="INSERT INTO `tbl_llistes` (`lli_nom`,`usu_id`) VALUES ('$_REQUEST[lista]', '$_SESSION[id]]')";
    $datos1 = mysqli_query($con, $sqllista);
    header("Location: ../listas_reproducion.php");


  }else{
    $_SESSION['validarse'] = 'error';
    header("Location: login.php");
    die();
  }
?>
