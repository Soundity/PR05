
<?php 
session_start();
	if(isset($_SESSION['id']))$login = 1;
	if(isset($_COOKIE['Soundity']))$login = 1;
	if($login == 1){
		include('../conexion.php');
		if(isset($_REQUEST['idvalM'])){
			$idval=$_REQUEST['idvalM'];
			$sql="SELECT * FROM tbl_valoracio WHERE mus_id=$idval AND usu_id=$_SESSION[id]";
			echo $sql . "</br>";
			$resultados= mysqli_query($con, $sql);
			if(mysqli_num_rows($resultados)==0){
				$sqlIns="INSERT INTO tbl_valoracio (mus_id, usu_id, val_puntuacio) VALUES ($idval, $_SESSION[id], 1)";
				echo "1". $sqlIns;
				$insertar= mysqli_query($con, $sqlIns);
			}else{
				while($pro1 = mysqli_fetch_array($resultados)) {
					echo $pro1['val_puntuacio'];
			
					if($pro1['val_puntuacio']==1){
						$sqlIns1="DELETE  from tbl_valoracio WHERE mus_id='$idval' AND usu_id='$_SESSION[id]' AND val_puntuacio=1";
						echo "2". $sqlIns1;
						$insertar1= mysqli_query($con, $sqlIns1);
					}else{
						$sqlDel="UPDATE tbl_valoracio SET val_puntuacio=1 WHERE mus_id='$idval' AND usu_id='$_SESSION[id]' AND val_puntuacio=-1";
						echo "3.1";
						echo $sqlDel;
						$borrar= mysqli_query($con, $sqlDel);
					}
				}
			}
	
		}else if(isset($_REQUEST['idvalN'])){
			$idval=$_REQUEST['idvalN'];
			$sql="SELECT * FROM tbl_valoracio WHERE mus_id=$idval AND usu_id=$_SESSION[id]";
			echo $sql . "</br>";
			$resultados= mysqli_query($con, $sql);
			if(mysqli_num_rows($resultados)==0){
				$sqlIns="INSERT INTO tbl_valoracio (mus_id, usu_id, val_puntuacio) VALUES ($idval, $_SESSION[id], 1)";
				echo "1". $sqlIns;
				$insertar= mysqli_query($con, $sqlIns);
			}else{
				while($pro1 = mysqli_fetch_array($resultados)) {
					echo $pro1['val_puntuacio'];
			
					if($pro1['val_puntuacio']==-1){
						$sqlIns1="DELETE  from tbl_valoracio WHERE mus_id='$idval' AND usu_id='$_SESSION[id]' AND val_puntuacio=-1";
						echo "2". $sqlIns1;
						$insertar1= mysqli_query($con, $sqlIns1);
					}else{
						$sqlDel="UPDATE tbl_valoracio SET val_puntuacio=-1 WHERE mus_id='$idval' AND usu_id='$_SESSION[id]' AND val_puntuacio=1";
						echo "3.1";
						echo $sqlDel;
						$borrar= mysqli_query($con, $sqlDel);
					}
				}
			}
	
		}else{
			header("Location: ../index.php");
			die();
		}
	}else{
		$_SESSION['validarse'] = 'error de validacio';
		header("Location: ../login.php");
		die();
	}
?>
