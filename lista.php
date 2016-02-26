<?php
	session_start();
if(isset($_SESSION['id']))$login = 1;
if(isset($_COOKIE['Soundity']))$login = 1;
	if(isset($login)){
include('header_menu.html');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Soundity</title>
		<link href="css/generic.css" rel="stylesheet" type="text/css" />
		<link href="css/listas_reproducion.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div class="general">
			<?php
				include('conexion.php');
				$user = $_SESSION['id'];
				$llista = $_REQUEST['idllista'];
				$sql = "SELECT * FROM tbl_usuari inner join tbl_llistes on tbl_usuari.usu_id=tbl_llistes.usu_id inner join tbl_llistes_musica on tbl_llistes.lli_id=tbl_llistes_musica.lli_id inner join tbl_musica on tbl_llistes_musica.mus_id=tbl_musica.mus_id inner join tbl_genere on tbl_musica.gen_id=tbl_genere.gen_id left join tbl_valoracio on tbl_musica.mus_id=tbl_valoracio.mus_id where tbl_llistes.lli_id=".$llista;
				$datos = mysqli_query ($con, $sql);
				if(mysqli_num_rows($datos)>0){
					$llistanom="hola";
					echo "<div class='list'>";
					
					While ($send = mysqli_fetch_array($datos)){
						if($llistanom != utf8_encode($send['lli_nom'])){
							$llistanom = utf8_encode($send['lli_nom']);
							echo "<h1>".$llistanom."</h1>";
						}
						$nomCanço = $send['mus_titol'];
						echo $nomCanço."</br>";
					}
					echo "</div>";
				}else{
					echo "No hay listas de reprodución creadas.";
				}	
			?>
		</div>
    </div>
	</body>
</html>
<?php
	}else{
		$_SESSION['validarse'] = 'error de validacio';
		header("Location: login.php");
		die();
	}
?>