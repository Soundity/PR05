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
    <link href="css/subscripciones.css" rel="stylesheet" type="text/css" />
    <link href="dist/semantic.min.css" rel="stylesheet" type="text/css" />
    
    <script>
function objetoAjax(){
  var xmlhttp=false;
  try {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e) {
 
  try {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  } catch (E) {
    xmlhttp = false;
  }
}
 
if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
    xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}
 

function suscri(idsub){


  ajax=objetoAjax();
 
 
  ajax.open("POST", "procs/subscripciones.proc.php",true);

  
  ajax.onreadystatechange=function() {
    

    if (ajax.readyState==4) {
      if (document.getElementById(idsub).className =="large empty star icon"){

      document.getElementById(idsub).className ="large star icon";
    }else{
      document.getElementById(idsub).className ="large empty star icon";
    }
  }
 }
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
 
  ajax.send("idsub="+idsub);
}


    </script>
  </head>
  <body>
    <?php 
        include('header_menu.html');
    ?>
                
    <div class="ui raised very centered padded text container segment">

  <?php
$sql="SELECT * FROM tbl_subscripcions INNER JOIN tbl_usuari ON tbl_subscripcions.usu_id=tbl_usuari.usu_id WHERE tbl_usuari.usu_id=$_SESSION[id]";
$datos = mysqli_query($con, $sql);
  if(mysqli_num_rows($datos)<=0){
    
    echo "<h2 class='ui centered header'>No estas suscrito a nada, aquí abajo tienes unas sugerencias a las cuales suscribirte</h2>";
    
    $destacados="Select sum(tbl_valoracio.val_puntuacio) as 'totalvots', tbl_usuari.usu_nom, tbl_usuari.usu_id From tbl_musica inner join tbl_usuari on tbl_musica.usu_id=tbl_usuari.usu_id inner join tbl_valoracio on tbl_musica.mus_id=tbl_valoracio.mus_id group by tbl_usuari.usu_id ORDER BY 'totalvots' DESC LIMIT 10";
    $res= mysqli_query($con, $destacados);
      while($sugerencias = mysqli_fetch_array($res)) {
             echo utf8_encode("<center><a href='verperfil.php?iduser=$sugerencias[usu_id]' >$sugerencias[usu_nom]</a>");
             echo "<i id=$sugerencias[usu_id] class='large empty star icon' onclick='suscri($sugerencias[usu_id]);'></i></center>";
              
      }
      
  }else{
    ?>
    
      <h2 class='ui centered header'>Tus suscripciones</h2>
      <?php
    while($suscr = mysqli_fetch_array($datos)) {
      $sql1="SELECT * FROM tbl_usuari WHERE usu_id=$suscr[usu_idorigen]";
      $datos1 = mysqli_query($con, $sql1);
      $user=mysqli_fetch_array($datos1);
      
      echo utf8_encode("<div class='ui horizontal divider'><a href='verperfil.php?iduser=$user[usu_id]' >$user[usu_nom]</a></div>");
     
      ?>
        <form method="post" action="procs/subscripciones.proc.php" id="formulario" >

        <input name="idsub" type="hidden" value="<?php echo $user['usu_id']; ?>">
        <input type="submit" id="btn_enviar" class='ui inverted orange button' value="Desuscribirse">
        </form> 


      <?php
      

    }
  }

?>
</div>
</body>
</html>
<?php
  }else{
    $_SESSION['validarse'] = 'error';
    header("Location: login.php");
    die();
  }
?>