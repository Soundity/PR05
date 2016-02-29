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
 
//Función para recoger los datos del formulario y enviarlos por post  
function enviarDatosEmpleado(idsub){
  alert(idsub);
  //div donde se mostrará lo resultados
  //divResultado = document.getElementById('resultado');
  //recogemos los valores de los inputs

  //alert(document.nuevo_empleado[1].mandar.value);
//alert(document.nuevo_empleado1.mandar.value);
//var texto="document.nuevo_empleado"+idsub+".mandar.value";
  //alert(eval(texto));

  
 // eval(document.nuevo_empleado+idsub+.mandar.value)="feo";
  
  //instanciamos el objetoAjax
  ajax=objetoAjax();
 //alert(idsub);
  //uso del medotod POST
  //archivo que realizará la operacion
  //registro.php
 
  ajax.open("POST", "procs/subscripciones.proc.php",true);

  //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
  ajax.onreadystatechange=function() {
    
    //la función responseText tiene todos los datos pedidos al servidor
    if (ajax.readyState==4) {
      //mostrar resultados en esta capa
    //divResultado.innerHTML = ajax.responseText
      //llamar a funcion para limpiar los inputs
    LimpiarCampos(idsub);
  }
 }
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviando los valores a registro.php para que inserte los datos
  ajax.send("idsub="+idsub);
}
 
//función para limpiar los campos
function LimpiarCampos(idsub){
  //document.nuevo_empleado1.mandar.value="Desubscribirse";
  //alert(idsub);
  //"document.nuevo_empleado"+idsub+".mandar.value"='Desubscribirse';
  //"document.nuevo_empleado"+idsub+".mandar.value"="Desubscribirse";
  //alert(eval("document.nuevo_empleado"+idsub+".mandar.value"));

  //document.nuevo_empleado"+idsub+".mandar.value="Desubscribirse";
  
  
}
    </script>
  </head>
  <body>
      <div class="recuadro">
  <?php 
  include('header_menu.html');
$sql="SELECT * FROM tbl_subscripcions INNER JOIN tbl_usuari ON tbl_subscripcions.usu_id=tbl_usuari.usu_id WHERE tbl_usuari.usu_id=$_SESSION[id]";
$datos = mysqli_query($con, $sql);
  if(mysqli_num_rows($datos)<=0){
    
    echo "<center>No estas suscrito a nada, aquí abajo tienes unas sugerencias a las cuales suscribirte";
    echo "</br>";
    $destacados="SELECT * FROM tbl_usuari INNER JOIN tbl_valoracio ON tbl_usuari.usu_id=tbl_valoracio.usu_id ORDER BY tbl_valoracio.val_puntuacio DESC LIMIT 10";
    $res= mysqli_query($con, $destacados);
      while($sugerencias = mysqli_fetch_array($res)) {
             echo "$sugerencias[usu_nom]</br>";


            ?>
            <form name="nuevo_empleado" action="#" onsubmit="enviarDatosEmpleado(<?php echo $sugerencias['usu_id']; ?>); return false">
                  <label><input id="idsub" name="idsub" type="hidden" value="<?php echo $sugerencias['usu_id']; ?>" /></label>
                    <input type="submit" id="mandar" name="mandar" value="Suscribirse" />
                
                
    </form>
    <?php
      }
      echo "</center>";
  }else{
    while($suscr = mysqli_fetch_array($datos)) {
      $sql1="SELECT * FROM tbl_usuari WHERE usu_id=$suscr[usu_idorigen]";
      $datos1 = mysqli_query($con, $sql1);
      $user=mysqli_fetch_array($datos1);
      echo "<center>";
      echo "$user[usu_nom]";
     
      ?>
<form method="post" action="procs/subscripciones.proc.php" id="formulario" >




<input  name="idsub" type="hidden" value="<?php echo $user['usu_id']; ?>">
<input type="submit" id="btn_enviar" value="Desubscribirse">


</form>


      <?php
      

    }
  }

?>
</center>
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