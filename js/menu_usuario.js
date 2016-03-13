$(document).ready(main);

var contador = 1;

function main(){
	$('.large.user.icon').click(function(){
		//$('nav').toggle(); 
		if(contador == 1){
			$('.desplegable').animate({
				marginTop: "+=18%",
				
				duration: 1000
			},500);
			contador = 0;
		} else {
			contador = 1;
			$('.desplegable').animate({
				marginTop: "-=18%",
				duration: 1000
			},500);
		}
	});

};