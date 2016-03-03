<?php
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
		<link rel="stylesheet" type="text/css" href="css/ss-standard.css" />
		<script type="text/javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
		<script src="js/subirMusica.js" type="text/javascript"></script>
	</head>

	<body>
	<?php include('header_menu.html'); ?>
		<div>
			<form action="procs/subir.proc.php">
				<input type="hidden" id="usuario" value="<?php echo $_SESSION['id'] ?>">
				<div id="drop-files" ondragover="return false"> <!-- ondragover for firefox -->
		    		Arrasta tu musica para Subir
				</div>
				<div id="myForm">
					
				</div>
				<div id="uploaded-holder">
				    <div id="dropped-files">
				        <div id="upload-button">
				            <input type="submit" value="Subir!" class="ui inverted orange button"><i class="ss-upload"> </i>

				            <a href="#" class="delete"><i class="ss-delete"> </i>X</a>
				            <span>0 Files</span>
				        </div>
				    </div>
				</div>
				 
				<div id="loading">
				    <div id="loading-bar">
				        <div class="loading-color"> </div>
				    </div>
				    <div id="loading-content">Uploading audio.mp3</div>
				</div>
				 
				<!--<div id="file-name-holder">
				    <ul id="uploaded-files">
				        <h1>Uploaded Files</h1>
				    </ul>
				</div>-->
		    </form>
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