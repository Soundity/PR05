<?php 
session_start();
 if(isset($_SESSION['id']))$login = 1;
 if(isset($_COOKIE['Soundity']))$login = 1;
 if($login == 1){
include('../conexion.php');


$sql="SELECT * FROM tbl_llistes_musica WHERE lli_id=$_REQUEST[lli_id] AND mus_id=$_REQUEST[mus_id]";
$resultados= mysqli_query($con, $sql);
    if(mysqli_num_rows($resultados)<=0){

          $sqlIns="INSERT INTO tbl_llistes_musica(lli_id, mus_id) VALUES ($_REQUEST[lli_id],$_REQUEST[mus_id])";
          $insertar= mysqli_query($con, $sqlIns);
           

    }

  }else{
    $_SESSION['validarse'] = 'error';
    header("Location: login.php");
    die();
  }
?>