<?php
	session_start();
	if(isset($_SESSION['id']))$login = 1;
		if(isset($_COOKIE['Soundity']))$login = 1;
		if($login == 1){
	include('header_menu.html');
?>
<link rel="stylesheet" type="text/css" href="css/generos.css">
<script type="text/javascript">
	var element = document.getElementsByClassName('elemento_genero');
	element.onmouseover = function(){
		this.element.innerHTML = "<p>hola</p>";
	}
</script>
	<section id="contenido">
		<section id="generos">
			<?php
			include("conexion.php");
			$sql = "SELECT * FROM tbl_genere";
			$datos = mysqli_query($con, $sql);
			if(mysqli_num_rows($datos)>0){
				while($genero = mysqli_fetch_array($datos)){
					?>
					<article class='elemento_genero' onclick="location.href='genero.php?gen=<?php echo $genero['gen_id']; ?>&genNom=<?php echo $genero['gen_nom']; ?>'">
						<p><?php echo $genero['gen_nom']; ?></p>
					</article>
					<?php
				}
			}
			?>
		</section>
	</section>
</body>
</html>
<?php
	}else{
		$_SESSION['validarse'] = 'error';
		header("Location: login.php");
		die();
	}
?>