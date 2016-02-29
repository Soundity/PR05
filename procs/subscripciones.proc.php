<?php 
session_start();
 if(isset($_SESSION['id']))$login = 1;
 if(isset($_COOKIE['Soundity']))$login = 1;
 if($login == 1){
include('../conexion.php');

echo "hola pepe";
$sql="SELECT * FROM tbl_subscripcions WHERE usu_idorigen=$_REQUEST[idsub] AND usu_id=$_SESSION[id]";
$resultados= mysqli_query($con, $sql);
    if(mysqli_num_rows($resultados)<=0){

          $sqlIns="INSERT INTO tbl_subscripcions(usu_idorigen, usu_id) VALUES ($_REQUEST[idsub],$_SESSION[id])";
          $insertar= mysqli_query($con, $sqlIns);
          //header("Location: ../subscripciones.php");

    }else{
          $sqlDel="DELETE FROM tbl_subscripcions WHERE usu_idorigen=$_REQUEST[idsub] AND usu_id=$_SESSION[id]";
          $borrar= mysqli_query($con, $sqlDel);
            header("Location: ../subscripciones.php");
}

  }else{
    $_SESSION['validarse'] = 'error';
    header("Location: login.php");
    die();
  }
?>