var validaFormulario=function(){
  var devolver = true;
  ///////////////// NOMBRE /////////////////
  var valor = document.getElementById("apodo").value;
  if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
    document.getElementById("error_apodo").style.display = "block";
    document.getElementById("error_apodo").innerHTML = "Debe introducir un nombre.";
    devolver = false;
  }else{
    document.getElementById("error_apodo").style.display = "none";
    //document.getElementById("apodo").style.backgroundColor = "#9AFE2E";
  }
  ///////////////// EMAIL /////////////////
  var email = document.getElementById("correo").value;
  if(email == null || email.length == 0){
    document.getElementById("error_correo_vacio").style.display = "block";
    document.getElementById("error_correo_vacio").innerHTML='Debe introducir una dirección email.';
    devolver = false;
  }else if(!/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(email)){
    document.getElementById("error_correo_vacio").style.display = "none";
     document.getElementById("error_correo_formato").style.display = "block";
    document.getElementById("error_correo_formato").innerHTML='El formato de dirección es incorrecto.';
    devolver = false;
  }else{
    document.getElementById("error_correo_vacio").style.display = "none";
    document.getElementById("error_correo_formato").style.display = "none";
    //document.getElementById("correo").style.backgroundColor = "#9AFE2E";
  }
  /////////////// CONTRASEÑA ///////////////
  var contrasena = document.getElementById("contrasena").value;
  if(contrasena == null || contrasena.length == 0){
     document.getElementById("error_contrasena_vacio").style.display = "block";
    document.getElementById("error_contrasena_vacio").innerHTML = 'Debe introducir una contraseña.';
    devolver = false;
  }else{  
    document.getElementById("error_contrasena_vacio").style.display = "none";
    //document.getElementById("contrasena").style.backgroundColor = "#9AFE2E";
  }
  ////////// CONFIRMAR CONTRASEÑA //////////
  var pass = document.getElementById("contrasena").value;
  var confirmar_contrasena = document.getElementById("confirmar_contrasena").value;
  if(confirmar_contrasena == null || confirmar_contrasena.length == 0) {
    document.getElementById("error_confirmar_contrasena_vacio").style.display = "block";
    document.getElementById("error_confirmar_contrasena_vacio").innerHTML = 'Debe introducir de nuevo su contraseña.';
    devolver = false;
  } else if(pass!=confirmar_contrasena){
    document.getElementById("error_confirmar_contrasena_vacio").style.display = "none";
    document.getElementById("error_confirmar_contrasena_incorrecto").style.display = "block";
    document.getElementById("error_confirmar_contrasena_incorrecto").innerHTML = 'Las contraseñas no coinciden.';
    devolver = false;
  }else{
    document.getElementById("error_confirmar_contrasena_vacio").style.display = "none";
    document.getElementById("error_confirmar_contrasena_incorrecto").style.display = "none";
    //document.getElementById("confirmar_contrasena").style.backgroundColor = "#9AFE2E";
  }

  

  return devolver;
  
}