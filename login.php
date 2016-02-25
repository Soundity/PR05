<?php
 	//Iniciamos sesion.
	session_start();
	if(isset($_SESSION['error_login'])) $error_login = $_SESSION['error_login'];
	if(isset($_SESSION['creado_correctamente'])) $creado_correctamente = $_SESSION['creado_correctamente'];
	if(isset($_SESSION['validarse'])) $validarse = $_SESSION['validarse'];
	session_destroy();
	setcookie('Soundity', '', time() - 3600);
?>
<html>
<head>
    <title>Soundity</title>
    
    <link rel="stylesheet" type="text/css" href="dist/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>

	<form class="ui center aligned orange segment" method="POST" action="procs/login.proc.php">
		<input type="hidden" name="login" value="si">
		<h2 class="ui header">
  			Login
		</h2>
		<!-- MENSAJES BUENOS -->
		<?php
		if(isset($creado_correctamente)) echo $creado_correctamente;
		?>
		<!-- MENSAJES MALOS -->
		<?php
		if(isset($error_login)) echo $error_login;
		if(isset($validarse)) echo $validarse;
		?>
		<div class="ui form">
	  		<div class="five wide field">
	   			<div class="ui left icon input">
	  				<input type="text" placeholder="Email" name="correo">
	  				<i class="mail icon"></i>
	  				<!-- <div class="ui mini corner label">
    					<i class="asterisk icon"></i>
  					</div> -->
				</div>
	  		</div>
	  		<div class="five wide field">
	  			<div class="ui left icon input">
	  				<input type="password" placeholder="Password" name="contrasena">
	  				<i class="lock icon"></i>
	  				<!-- <div class="ui mini corner label">
    					<i class="asterisk icon"></i>
  					</div> -->
				</div>
	 		 </div>
	 		 <i class="sign in large icon"></i><input type="submit" class="ui inverted orange button" value="Login"/>
	 		 <input type="button" class="ui inverted orange button" onclick="location='registro.php'" value="Registrate"/><i class="edit large icon"></i>
	 		<!--<button class="ui inverted orange button">Login</button>
	 		<button class="ui inverted orange button">Registrate</button>-->
		</div>
	</form>
	
</body>
</html>