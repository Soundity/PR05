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
		<link href="css/js-image-slider.css" rel="stylesheet" type="text/css" />
		<script src="js/js-image-slider.js" type="text/javascript"></script>
		<link href="generic.css" rel="stylesheet" type="text/css" />
	</head>

	<body>
		<div class="general">
			<div id="sliderFrame">
				<div id="slider">
					<img src="media/images/Slider/JPG/slider1.jpg" alt="Top 1" />
					<img src="media/images/Slider/JPG/slider2.jpg" alt="Top 2" />
					<img src="media/images/Slider/JPG/slider3.jpg" alt="Top 3" />
					<img src="media/images/Slider/JPG/slider4.jpg" alt="Top 4" />
					<img src="media/images/Slider/JPG/slider5.jpg" alt="Top 5"/>
				</div>
			</div>
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