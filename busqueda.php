<?php  
	session_start();
include('header_menu.html');
include('conexion.php');
	$sql0 = "SELECT * FROM tbl_usuari WHERE usu_nom LIKE'%$_REQUEST[buscar]%'";
	$datos0 = mysqli_query($con, $sql0);
	$sql1 = "SELECT * FROM tbl_musica INNER JOIN tbl_genere ON tbl_musica.gen_id=tbl_genere.gen_id INNER JOIN tbl_usuari on tbl_musica.usu_id = tbl_usuari.usu_id WHERE mus_titol LIKE'%$_REQUEST[buscar]%'";
	$datos1 = mysqli_query($con, $sql1);

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>¡web de resultados!</title>
		
		<link rel="stylesheet" href="css/busqueda.css">
	</head>
	<body>
		<div class="ui grid">
		<?php
			if(mysqli_num_rows($datos0)<=0){
				echo "<div class='seven wide centered column'>";
				echo "<div class='ui horizontal divider'>";
				echo "No hay resultados de Autores";
				echo "</div></div>";
			}else{
				echo "<div class='twelve wide centered column'><div class='ui horizontal divider'>";
				echo "<h2>Artistas</h2></div></div>";
				while($pro0 = mysqli_fetch_array($datos0)) {
					
					echo "<div class='six wide centered column'>";
						echo "<div class='ui yellow center aligned raised segment'>";
						echo "<div class='ui horizontal divider'>";
						echo utf8_encode("<h2>$pro0[usu_nom]</h2>");
						echo "</div>";
					
						if(!empty($pro0['usu_avatar'])){
	          				$fichero="media/images/avatares/$pro0[usu_avatar]";
	          				echo"<img class='ui small  centered circular image' src='$fichero'>";
	        			}else{
	          				echo"<img  src='media/images/avatar.jpg'>";
	        			}
						
							echo "<a href='verperfil.php?iduser=$pro0[usu_id]' class='ui orange button'>
								<i class='info circle large icon'></i>
								Ver Perfil
							</a>";
					echo "</div></div>";
				}
			}
		?>
		</div> 
		<div class="ui grid">
			<?php
				if(mysqli_num_rows($datos1)<=0){
					echo "<div class='seven wide centered column'>";
					echo "<div class='ui horizontal divider'>";
					echo "No hay resultados de Música";
					echo "</div></div>";
						
				}else{
					echo "<div class='twelve wide centered column'><div class='ui horizontal divider'>";
					echo "<h2>Canciones</h2></div></div>";
					while($pro1 = mysqli_fetch_array($datos1)) {
						echo "<div class='six wide centered column'>";
						echo "<div class='ui orange center aligned raised segment'>";
						echo "<div class='ui horizontal divider'>";
						echo utf8_encode("<h2>$pro1[mus_titol]</h2>");
						echo "</div>";
						
						echo "<h3>Género: </h3><p>$pro1[gen_nom]</p>";
						echo "<h3>Autor: </h3><p>$pro1[usu_nom]</p>";
						echo "<h3>Valoración: </h3>
								<div class='ui label'>
  									<i class='thumbs up large icon'></i> 23
								</div></div></div>";
					}
				}
			?>
  		</div> 
	</body>
</html>