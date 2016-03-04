$(document).ready(main);

var cont = 1;

function main(){
	$('.sidebar.icon').click(function(){
		//$('nav').toggle(); 

		
		if(cont == 1){
			$('nav').animate({
				left: '0',
				duration: 1000
			},500);
			cont = 0;
		} else {
			cont = 1;
			$('nav').animate({
				left: '-100%',
				duration: 1000
			},500);
		}

		

	});

};