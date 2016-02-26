<?php
session_start();
include('header_menu.html');
include('conexion.php');
  if(isset($_SESSION['id']))$login = 1;
  if(isset($_COOKIE['Soundity']))$login = 1;
  if($login == 1){
      if (isset($_REQUEST['iduser'])){
          $sql="SELECT * FROM tbl_usuari LEFT JOIN tbl_musica ON tbl_usuari.usu_id=tbl_musica.usu_id WHERE tbl_usuari.usu_id=$_REQUEST[iduser]";
          $datos = mysqli_query($con, $sql);

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
        </head>
            <body>
            <div class="ui grid">
                <?php
                $contador=0;
                
                while($perfil = mysqli_fetch_array($datos)) {
                    echo "<div class='seven wide centered column'>";
          echo "<div class='ui orange raised segment'>";
          echo "<div class='ui horizontal divider'>";
          echo utf8_encode("<h2>".$perfil['usu_nom']."</h2></div>");

                  if ($contador==0){
                            if(!empty($perfil['usu_avatar'])){
                              $fichero="media/images/avatares/$perfil[usu_avatar]";
                              echo"</br><img  class='ui small center left circular floated image' src='$fichero'>";
                             }else{
                              echo"</br><img  src=media/images/avatares/usuario.jpeg>";
                             }
                    
                    echo "</br>";
                    echo utf8_encode($perfil['usu_descripcio']);

                    ?>
                    <section id="player" data-autoplay='1' data-loop='1'>
      <section id="controls">
        <section id="songTitle">
          <span>Selecciona una canción</span>
        </section>
        <section id="playertrols">
          <div id="plauseStop">
            <div id="plause"></div>
            <div id="stop"></div>
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
     }         }
           
                ?>

              </div>
            </body>
        </html>



          
          <?php
      }elseif(isset($_SESSION['id'])){
          $sql="SELECT * FROM tbl_usuari LEFT JOIN tbl_musica ON tbl_usuari.usu_id=tbl_musica.usu_id WHERE tbl_usuari.usu_id=$_SESSION[id]";
          
          $datos = mysqli_query($con, $sql);
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
           <div class="ui grid">
                <?php
                $contador=0;
                
                while($perfil = mysqli_fetch_array($datos)) {
                  
                  echo "<div class='seven wide centered column'>";
                  echo "<div class='ui orange raised segment'>";
                  echo "<div class='ui horizontal divider'>";
                  echo utf8_encode("<h2>".$perfil['usu_nom']."</h2></div>");
                  if ($contador==0){
             
                    if(!empty($perfil['usu_avatar'])){
          $fichero="media/images/avatares/$perfil[usu_avatar]";
          echo"</br><img  src='$fichero'>";
        }else{
          echo"</br><img  src=media/images/avatares/usuario.jpeg>";
        }
                   
                    echo "</br>";
                    echo utf8_encode($perfil['usu_descripcio']);

                                  ?>
                    <section id="player" data-autoplay='1' data-loop='1'>
      <section id="controls">
        <section id="songTitle">
          <span>Selecciona una canción</span>
        </section>
        <section id="playertrols">
          <div id="plauseStop">
            <div id="plause"></div>
            <div id="stop"></div>
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
            echo "Nombre: ".$perfil['mus_titol']."   |   Autor: ".$perfil['usu_nom']; ?></p>
          </article>
          
<?php
     }         }
                 
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