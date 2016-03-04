<div class="ui two column centered grid">
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
	          				echo"<img class='ui small centered circular image' src='$fichero'>";
	        			}else{
	          				echo"<img class='ui small centered circular image' src='media/images/avatar.png'>";
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