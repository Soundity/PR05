$(document).ready(function() {
    // DECLARAR VARIABLES Y EVENTO JQUERY
    jQuery.event.props.push('dataTransfer');     
    var maxFiles = 5;
    var errMessage = 0;
    var dataArray = [];

    $('#drop-files').bind('drop', function(e) {        
    	var files = e.dataTransfer.files;
    	$('#uploaded-holder').show();

    	$.each(files, function(index, file) {
            // CONTROL DE ERRORES
			if (!files[index].type.match('audio.*')) {
    			if(errMessage == 0) {
        			$('#drop-files').html('Hey! Audios only');
        			++errMessage;
    			}
    			else if(errMessage == 1) {
        			$('#drop-files').html('Stop it! Audios only!');
        			++errMessage;
    			}
    			else if(errMessage == 2) {
        			$('#drop-files').html("Can't you read?! Audios only!");
        			++errMessage;
    			}
    			else if(errMessage == 3) {
        			$('#drop-files').html("Fine! Keep dropping non-audios.");
        			errMessage = 0;
    			}
    			return false;
			}
            // AL DROPPEAR CANCIONES CENTRA EL BOTÓN
			if($('#dropped-files > .audio').length < maxFiles) {
    			$('#upload-button').css({'display' : 'inline-block'});
			}

			var fileReader = new FileReader();

    		fileReader.onload = (function(file) {         
		        return function(e) { 
            		dataArray.push({name : file.name, value : this.result});
            		var audio = this.result;

                    if(dataArray.length == 1) {
                        $('#upload-button span').html("1 file to be uploaded");
                        document.getElementById("myForm").innerHTML = "<p>Introduce los datos de mayor a menor tamaño (Mb)</p>";
                        document.getElementById("myForm").innerHTML += "<div id='formulario"+dataArray.length+"'</div>";
                        $('#formulario'+dataArray.length).load("formSubir.php?num="+dataArray.length);
                    } else {
                        $('#upload-button span').html(dataArray.length+" files to be uploaded");
                        document.getElementById("myForm").innerHTML += "<div id='formulario"+dataArray.length+"'</div>";
                        $('#formulario'+dataArray.length).load("formSubir.php?num="+dataArray.length);
                    }
                };

            })(files[index]);

        fileReader.readAsDataURL(file);

    });
});


function restartFiles(){
    $('#loading-bar .loading-color').css({'width' : '0%'});
    $('#loading').css({'display' : 'none'});
    $('#loading-content').html(' ');
    $('#upload-button').hide();
    $('#dropped-files > .audio').remove();
    $('#extra-files #file-list li').remove();
	$('#extra-files').hide();
	$('#uploaded-holder').hide();
    document.getElementById("myForm").innerHTML = "";
    dataArray.length = 0;
	return false;
}

	
$('#upload-button .upload').click(function() {
     
    // Show the loading bar
    $("#loading").show();
    // How much each element will take up on the loading bar
    var totalPercent = 100 / dataArray.length;
    // File number being uploaded
    var x = 0;
    var y = 0;
     
    // Show the file name
	$('#loading-content').html('Espera unos instantes...');
     
     
    // Upload each file separately
	$.each(dataArray, function(index, file) {   
        
    	// Post to the upload.php file
        $.post('upload.php', dataArray[index], function(data) {
       		//var fileName = dataArray[index].name;
       		x=x+1;
       		// Change the loading  bar to represent how much has loaded
       		$('#loading-bar .loading-color').css({'width' : x*totalPercent+'%'});
        
   		    if(totalPercent*(x) == 100) {
           		// Show the upload is complete
           		$('#loading-content').html('Uploading Complete!');

           		// The name of the file
                for(var i=0;i<dataArray.length;i++){
                    var fileName = dataArray[i].name;
                    alert(fileName);
                    num = i + 1;
                    ajaxFunction(fileName,num);
                }

           	   // Reset everything when the loading is completed
           		setTimeout(restartFiles, 500);
             
       		} else {
         
           		// Show that the files are uploading
           		$('#loading-content').html('Uploading '+fileName);
   		    }
        });
    });     
    return false;
});

// Just some styling for the drop file container.
$('#drop-files').bind('dragenter', function() {
    $(this).css({'box-shadow' : 'inset 0px 0px 20px rgba(0, 0, 0, 0.1)', 'border' : '4px dashed #bb2b2b'});
    	return false;
	});
 
	$('#drop-files').bind('drop', function() {
    	$(this).css({'box-shadow' : 'none', 'border' : '4px dashed rgba(0,0,0,0.2)'});
    	return false;
	});
 
	// Restart files when the user presses the delete button
	$('#dropped-files #upload-button .delete').click(restartFiles);
});




function ajaxFunction(fileName,i){
	var ajaxRequest;
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				alert("Your browser broke!");
				return false;
			}
		}
	}

	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
            if(ajaxRequest.status == 200) {
                //alert(ajaxRequest.responseText);
    			//document.myForm.time.value = ajaxRequest.responseText;
            }
		}
	}

	var titulo = document.getElementById("titulo["+i+"]").value;
	var genero = document.getElementById("genero["+i+"]").value;
	var usuario = document.getElementById("usuario").value;
	
	var queryString = "?titulo=" + titulo + "&genero=" + genero + "&usuario=" + usuario + "&nombre=" + fileName;
	alert(queryString);
	ajaxRequest.open("GET", "procs/subir.proc.php" + queryString, true);
    ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxRequest.send(null); 
}