$(document).ready(main);

var contador = 1;

function main(){
	$('.sidebar.icon').click(function(){
		//$('nav').toggle(); 

		
		if(contador == 1){
			$('nav').animate({
				left: '0',
				duration: 1000
			},500);
			contador = 0;
		} else {
			contador = 1;
			$('nav').animate({
				left: '-100%',
				duration: 1000
			},500);
		}

		

	});

};