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
    <link rel="stylesheet" href="css/modal.css">
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
        function pasarVariable(cancion){
            document.getElementById("buscarBD").value=cancion;
        }
        function listaBD(id){
            var lli_id=document.getElementById("listaFORM").value;
            var mus_id=document.getElementById("buscarBD").value;
            /* alert(lli_id);
            alert(mus_id);*/
            ajax=objetoAjax();
            ajax.open("POST", "procs/AmusLista.proc.php?lli_id="+lli_id+"&mus_id="+mus_id,true);
            ajax.onreadystatechange=function() {
                if (ajax.readyState==4) {
                }
            }
            ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            ajax.send(null);
            alert("Cancion añadida correctamente");
            window.locationf="busqueda.php";
        }
    </script>
</head>
<body>
    <!-- ######################################################################## -->
    <?php
        // HEADER Y MENUS
        include('header_menu.html');
    ?>
    <!-- ######################################################################## -->
        <div class="ui grid" id="personal">
            <?php
                $contador=0;
             ?>
            <div class='nine wide centered column'>
                <div class='ui red raised segment'>
                    <!-- ######################################################################## -->
                    <!-- FICHA DEL USUARIO -->
                    <div class='ui horizontal divider'>
                        <?php
                            while($perfil = mysqli_fetch_array($datos)) {
                                if ($contador==0){
                                    if(mysqli_num_rows($suscrito)<=0){
                                        echo utf8_encode("<h2>".$perfil['usu_nom']."<i id=$perfil[usu_id] class='large empty star icon' onclick='suscri($perfil[usu_id]);'></i></h2></div>");
                                    }else{
                                        echo utf8_encode("<h2>".$perfil['usu_nom']."<i id=$perfil[usu_id] class='large star icon' onclick='suscri($perfil[usu_id]);'></i></h2></div>");
                                        //echo "<i id=$perfil[usu_id] class='large star icon' onclick='suscri($perfil[usu_id]);'></i></div>";
                                    }
                                    $totalSuscrip = mysqli_fetch_array($totales);
                                    if(!empty($perfil['usu_avatar'])){
                                        $fichero="media/images/avatares/$perfil[usu_avatar]";
                                        echo"</br><img  class='ui small center left circular floated image' src='$fichero'>";
                                    }else{
                                        echo"</br><img  class='ui small left circular floated image' src='media/images/avatar.png'>";
                                    }
                                    echo "<h3 class='ui header'>" . utf8_encode($perfil['usu_descripcio']) . "</h3>";
                                    echo "<h4 class='ui header'>" .$totalSuscrip['contador'] ." suscriptores </h4>";
                        ?>
                        <!-- ######################################################################## -->
                       
                        <?php
                            $contador=$contador+1;
                        }
                        echo "</br>";
                        
                        ?>
                    </div>
                </div>
            </div>
                    <!-- ######################################################################## -->
                    <!-- CADA CANCIÓN -->
                    <div class="ui grid" id="parche">
                        <div class="three wide column">
                            <div class="ui raised center aligned segment">
                                <?php
                                if(isset($perfil['mus_titol'])){
                                echo utf8_encode("<h2>$perfil[mus_titol] </h2>");
                                echo "<div class='cancion' data-source='media/music/$perfil[mus_nom]'><i class='play icon' ></i><p style='display:none'>Nombre: ".$perfil['mus_titol']."</p></div>";
                                echo utf8_encode("<h3>Autor: </h3><p>$perfil[usu_nom]</p>");
                                $valor=$perfil['mus_id'];
                        ?>
                            <h3><a href='#lista' onclick="pasarVariable(<?php echo $valor; ?>);">Añadir a mi lista</a></h3>
                
                        <?php
                            /*echo "<h3>Valoración: </h3><div class='ui label'>";
                            $usuari=$_SESSION['id'];
                            $sql2 = "Select * from tbl_valoracio where mus_id=$perfil[mus_id] & usu_id=$usuari";
                            //echo $sql2;
                            $datos2 = mysqli_query($con, $sql2);
                            if(mysqli_num_rows($datos2)==0){
                                // POTS VOTAR
                                echo"<i id=$perfil[mus_id] class=' thumbs outline up icon' onclick='suscriM($perfil[mus_id]);'></i>";
                                echo"<i id=$perfil[mus_id] class=' thumbs outline down icon' onclick='suscriN($perfil[mus_id]);'></i>";
                                if ($perfil['totalvots']!=0){
                                    echo $perfil['totalvots']. " Votos";
                                } else {
                                    echo "0 Votos";
                                }
                            }else{
                                // JA HAS VOTAR 
                                while($pro2 = mysqli_fetch_array($datos2)) {    
                                    if ($pro2['val_puntuacio']==1){
                                        echo"<i id=$perfil[mus_id] class=' thumbs outline down icon' onclick='suscriN($perfil[mus_id]);'></i>$perfil[totalvots] Te Gusta ";
                                    } else {
                                        echo"<i id=$perfil[mus_id] class=' thumbs outline up icon' onclick='suscriM($perfil[mus_id]);'></i>$perfil[totalvots] Ya no te gusta ";
                                        
                                    }
                                }
                            }*/
                        }
                    }
                            ?>
                            </div>
                        </div>
                    </div>

                    <!-- ######################################################################## -->
                    <!-- REPRODUCTOR -->
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
                    <!-- ######################################################################## -->
                    <footer></footer>
                </div>
            </div>
        
         <!-- MODALBOX AÑADIR A LISTA -->
                        <div id="lista" class="modalmask">
                            <div class="modalbox movedown" id="resultadoContent">
                                <?php
                                    $sqlListas="SELECT COUNT(lli_id) AS total, usu_id, lli_id,lli_nom FROM tbl_llistes WHERE usu_id=$_SESSION[id] group by lli_id";
                                    $listas = mysqli_query($con, $sqlListas);
                                    if(mysqli_num_rows($listas)>0){
                                ?>
                                <!-- Seleccionar lista -->
                                <form name="lista" action="#">
                                    <label><input id="buscarBD" name="buscarBD" type="hidden" value="" /></label>
                                    <label><input id="buscar" name="buscar" type="hidden" value="" /></label>
                                    <a href="#close" class="boxclose"><img src="media/images/close.png" alt=""></a>
                                    <h2 >Selecciona una lista</h2>
                                    <?php
                                        $filas=mysqli_num_rows($listas);
                                    ?>
                                    <div id="contenidoListas">
                                        <select id="listaFORM" name="Listas">                   
                                            <?php                       
                                                echo $_REQUEST['idmusicaadd'];                      
                                                while($misListas=mysqli_fetch_array($listas)) {                         
                                                    echo "<option value=\"$misListas[lli_id]\">$misListas[lli_nom]</option>";
                                                }
                                            ?>
                                        </select>
                                        <input type="submit" onClick="listaBD()" class='ui orange button' value="Añadir">
                                    </div>
                                </form>
                                <div>
                                    <?php
                                        }else{
                                    ?>
                                    <div>
                                        <a href="#close" class="boxclose"><img src="media/images/close.png" alt=""></a>
                                        <?php
                                            echo "No tienes ninguna lista:</br>";
                                            echo "<a class='ui orange button' href=listas_reproducion.php>Crear nueva lista</a>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ######################################################################## -->
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
            echo "<div class='four wide centered column'>";
                echo "<div class='ui red raised segment'>";
                echo "<div class='ui horizontal divider'>";
            while($perfil = mysqli_fetch_array($datos)) {
                if ($contador==0){
                echo utf8_encode("<h2>".$perfil['usu_nom']."</h2></div>");
                $totalSuscrip = mysqli_fetch_array($totales);
                
                
                    if(!empty($perfil['usu_avatar'])){
                        $fichero="media/images/avatares/$perfil[usu_avatar]";
                        echo"</br><img  class='ui small center left  circular floated image' src='$fichero'>";
                    }else{
                        echo"</br><img  class='ui small left circular floated image' src='media/images/avatar.png'>";
                    }  
                
                echo "<h3 class='ui header'>" . utf8_encode($perfil['usu_descripcio']) . "</h3>";
                 echo "<h4 class='ui header'>" .$totalSuscrip['contador'] ." suscriptores </h4>";
        ?>
    
    <?php
                $contador=$contador+1;
                }
                echo "</br>";
                if(isset($perfil['mus_titol'])){
    ?>
    </div>
    
    <div id="generos">  
        <article class="cancion" data-source="media/music/<?php echo $perfil['mus_nom'] ?>">
        <i class="play icon"></i>
        <p>
       <?php 
            echo "Nombre: ".$perfil['mus_titol']."   |   Autor: ".$perfil['usu_nom']; 
            
            $mus_id=$perfil['mus_id'];
           ?>
            <a href="procs/eliminar_cancion_propia.proc.php?mus_id=<?php echo $mus_id;?>" onClick ="return confirm('Seguro que deseas eliminar esta cancion?')"> Eliminar </a>
            
        </p>
        </article>   
    </div>     
    <?php
                }
            }
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
    <footer></footer>
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