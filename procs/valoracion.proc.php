
<?php 
session_start();
 if(isset($_SESSION['id']))$login = 1;
 if(isset($_COOKIE['Soundity']))$login = 1;
 if($login == 1){
include('../conexion.php');


$sql="SELECT * FROM tbl_valoracio WHERE mus_id=$_REQUEST[idval] AND usu_id=$_SESSION[id]";
$resultados= mysqli_query($con, $sql);
    if(mysqli_num_rows($resultados)==0){

          $sqlIns="INSERT INTO tbl_valoracio (mus_id, usu_id, val_puntuacio) VALUES ($_REQUEST[idval], $_SESSION[id], 1)";
          $insertar= mysqli_query($con, $sqlIns);



    }else{

      if(mysqli_num_rows($resultados)==1){

          $sqlIns1="UPDATE tbl_valoracio SET val_puntuacio=0 WHERE 'mus_id=$_REQUEST[idval]' AND 'usu_id=$_SESSION[id]' AND val_puntuacio=1";
          $insertar1= mysqli_query($con, $sqlIns1);
      } else {
          $sqlDel="UPDATE tbl_valoracio SET val_puntuacio=0 WHERE 'mus_id=$_REQUEST[idval]' AND 'usu_id=$_SESSION[id]' AND val_puntuacio=1";
          $borrar= mysqli_query($con, $sqlDel);
      }

            header("Location: ../subscripciones.php");
}

  }else{
    $_SESSION['validarse'] = 'error';
    header("Location: login.php");
    die();
  }
?>
