			function objetoAjax(){
			  var xmlhttp=false;
			  try {
			    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			  } catch (e) {
			 
			  try {
			    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			  } catch (E) {
			    xmlhttp = false;
			  }
			}
			 
			if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
			    xmlhttp = new XMLHttpRequest();
			  }
			  return xmlhttp;
			}
			 

			function suscriN(idval){
				//alert(idval);
				ajax=objetoAjax();
				ajax.open("POST", "procs/valoracion.proc.php",true);
				ajax.onreadystatechange=function() {
					if (ajax.readyState==4) {

					}
				}
				ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				ajax.send("idvalN="+idval);
			}
			function suscriM(idval){
				//alert(idval);
				ajax=objetoAjax();
				ajax.open("POST", "procs/valoracion.proc.php",true);
				ajax.onreadystatechange=function() {
					if (ajax.readyState==4) {

					}
				}
				ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				ajax.send("idvalM="+idval);
			}