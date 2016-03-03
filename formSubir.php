<?php
	//echo "<span>".$_REQUEST['nom'].": </span>";
	echo "<span>Titulo: </span>";
	echo "<input type='text' id='titulo[".$_REQUEST['num']."]'>";
	echo "<span>Categoria: </span>";
	echo "<select id='genero[".$_REQUEST['num']."]'>";

	include("conexion.php");
	$SQL = "SELECT * FROM tbl_genere";
	$datos = mysqli_query($con,$SQL);
	if(mysqli_num_rows($datos)>0){
		while($genero = mysqli_fetch_array($datos)){
			echo "<option value='".$genero['gen_id']."'>".$genero['gen_nom']."</option>";
		}
	}
?>
</select><br/><br/>