<?php
session_start();
include('conexion.php');
if(isset($_SESSION['id']))$login = 1;
if(isset($_COOKIE['Soundity']))$login = 1;
if($login == 1){
    if (isset($_REQUEST['iduser'])){
        $sql="SELECT * FROM tbl_usuari LEFT JOIN tbl_musica ON tbl_usuari.usu_id=tbl_musica.usu_id WHERE tbl_usuari.usu_id=$_REQUEST[iduser]";
        $datos = mysqli_query($con, $sql);
        $seguir="SELECT * FROM tbl_subscripcions WHERE usu_idorigen=$_REQUEST[iduser] AND usu_id=$_SESSION[id]";
        $suscrito = mysqli_query($con, $seguir);
        $total="SELECT  COUNT(DISTINCT sub_id) AS contador FROM tbl_subscripcions WHERE usu_idorigen=$_REQUEST[iduser]";
        $totales= mysqli_query($con, $total);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Soundity</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="css/generos.css">
    <link rel="stylesheet" type="text/css" href="css/styleRep1.css">
    <link rel="stylesheet" type="text/css" href="css/busqueda.css">
    <script type="text/javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js"></script>
    <script type="text/javascript" src="js/botonesReproductor1.js"></script>
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
    <?php include('header_menu.html'); ?>
    <div class="ui grid" id="personal">
        <?php
            $contador=0;
            while($perfil = mysqli_fetch_array($datos)) {
            ?>
                <div class='nine wide centered column'>
                <div class='ui red raised segment'>
                <div class='ui horizontal divider'>
            <?php
                
                if(mysqli_num_rows($suscrito)<=0){
                echo utf8_encode("<h2>".$perfil['usu_nom']."<i id=$perfil[usu_id] class='large empty star icon' onclick='suscri($perfil[usu_id]);'></i></h2></div>");
                
              }else{
                echo utf8_encode("<h2>".$perfil['usu_nom']."<i id=$perfil[usu_id] class='large star icon' onclick='suscri($perfil[usu_id]);'></i></h2></div>");
                  //echo "<i id=$perfil[usu_id] class='large star icon' onclick='suscri($perfil[usu_id]);'></i></div>";
              }
            $totalSuscrip = mysqli_fetch_array($totales);
                
              
                if ($contador==0){
                    if(!empty($perfil['usu_avatar'])){
                        $fichero="media/images/avatares/$perfil[usu_avatar]";
                        echo"</br><img  class='ui small center left rounded floated image' src='$fichero'>";
                    }else{
                        echo"</br><img  src=media/images/avatar.jpg>";
                    }
                    echo "<h3 class='ui header'>" . utf8_encode($perfil['usu_descripcio']) . "</h3>";
                    echo "<h4 class='ui header'>" .$totalSuscrip['contador'] ." suscriptores </h4>";
            ?>
                <section id="player" data-autoplay='1' data-loop='1'>
                    <section id="controls">
                        <section id="songTitle">
                            <span>Selecciona una canción</span>
                        </section>
                        <section id="playertrols">
                            <div id="plauseStop">
                                <div id="plause"><i id="playPause" class="play icon"></i></div>
                                <div id="stop"><i class="stop icon"></i></div>
                            </div>

                        <div id="progressBar">
                            <div id="timeLoaded"></div>
                            <div id="timePlayed"></div>
                        </div>
                        </section>
                    <section id="volumeTime">
                        <input type="range" min="0" max="1" step="0.1" value="0.5" />
                        <div id="timeStatus">
                            <time id="played">00:00</time>
                            <span>/</span>
                            <time id="totalTime">00:00</time>
                        </div>
                    </section>
                    </section>
                </section>
            <?php
                    $contador=$contador+1;
            }
            echo "</br>";
            if(isset($perfil['mus_titol'])){
            ?>
        <article class="cancion" data-source="media/music/<?php echo $perfil['mus_nom'] ?>">
        <p><?php 
            echo $perfil['mus_titol']."   |   ".$perfil['usu_nom']; ?></p>
        </article> 
        <?php
            }
        }
        ?>

    </div>
</body>
</html>



          
<?php
    }elseif(isset($_SESSION['id'])){
        $sql="SELECT * FROM tbl_usuari LEFT JOIN tbl_musica ON tbl_usuari.usu_id=tbl_musica.usu_id WHERE tbl_usuari.usu_id=$_SESSION[id]";
        $datos = mysqli_query($con, $sql);
        $total="SELECT  COUNT(DISTINCT sub_id) AS contador FROM tbl_subscripcions WHERE usu_idorigen=$_SESSION[id]";
        $totales= mysqli_query($con, $total);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Soundity</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="css/generos.css">
    <link rel="stylesheet" type="text/css" href="css/styleRep1.css">
    <script type="text/javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js"></script>
    <script type="text/javascript" src="js/botonesReproductor1.js"></script>
</head>
<body>
    <?php include('header_menu.html'); ?>
    <div class="ui grid">
        <?php
            $contador=0;
            while($perfil = mysqli_fetch_array($datos)) {
                echo "<div class='four wide centered column'>";
                echo "<div class='ui red raised segment'>";
                echo "<div class='ui horizontal divider'>";
                echo utf8_encode("<h2>".$perfil['usu_nom']."</h2></div>");
                $totalSuscrip = mysqli_fetch_array($totales);
                
                if ($contador==0){
                    if(!empty($perfil['usu_avatar'])){
                        $fichero="media/images/avatares/$perfil[usu_avatar]";
                        echo"</br><img  class='ui small center left rounded floated image' src='$fichero'>";
                    }else{
                        echo"</br><img  class='ui small left rounded floated image' src='media/images/avatares/usuario.jpeg'>";
                    }  
                
                echo "<h3 class='ui header'>" . utf8_encode($perfil['usu_descripcio']) . "</h3>";
                 echo "<h4 class='ui header'>" .$totalSuscrip['contador'] ." suscriptores </h4>";
        ?>
    <section id="player" data-autoplay='1' data-loop='1'>
        <section id="controls">
            <section id="songTitle">
                <span>Selecciona una canción</span>
            </section>
            <section id="playertrols">
                <div id="plauseStop">
                    <div id="plause"><i class="play icon"></i></div>
                    <div id="stop"><i class="stop icon"></i></div>
                </div>
                <div id="progressBar">
                    <div id="timeLoaded"></div>
                    <div id="timePlayed"></div>
                </div>
            </section>
            <section id="volumeTime">
                <input type="range" min="0" max="1" step="0.1" value="0.5" />
                <div id="timeStatus">
                    <time id="played">00:00</time>
                    <span>/</span>
                    <time id="totalTime">00:00</time>
                </div>
            </section>
       </section>
    </section>
    <?php
                $contador=$contador+1;
                }
                echo "</br>";
                if(isset($perfil['mus_titol'])){
    ?>
    <article class="cancion" data-source="media/music/<?php echo $perfil['mus_nom'] ?>">
        <p>
            <?php 
            echo "Nombre: ".$perfil['mus_titol']."   |   Autor: ".$perfil['usu_nom']; 
            // AQUI ESTA EL HREF A ELIMINAR LA CANCION PROPIA DE UN USUARIO SUBIDA POR EL
            $mus_id=$perfil['mus_id'];
           ?>
            <a href="procs/eliminar_cancion_propia.proc.php?mus_id=<?php echo $mus_id;?>" onClick ="return confirm('Seguro que deseas eliminar esta cancion?')"> Eliminar </a>
            
        </p>
    </article>        
    <?php
                }
            }
    ?>

    </div>
</body>
</html>
<?php
    }else{
    header("Location: index.php");
    }
}else{
    $_SESSION['validarse'] = 'error';
    header("Location: login.php");
    die();
}
?>