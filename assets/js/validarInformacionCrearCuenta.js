function validarInformacion(){
    let nombre = document.getElementById("formularioNombre").value;
    let correo = document.getElementById("formularioCorreo").value;
    let contrasena = document.getElementById("formularioContrasena").value;
    let contrasenaRepetida = document.getElementById("formularioContrasenaConfirma").value;

    let nombreValido = false;
    let correoValido = false;
    let contrasenaValida = false;

    //let errores = "";

    /*validación de nombre*/

    let soloLetras = /^[a-zA-Z]+[a-zA-Z]+$/;
    
    if (soloLetras.test(nombre)) {
        alert('Por favor ingrese su nombre completo (nombre y apellido).');
        //error = error + ""
        document.getElementById("formularioNombre").focus();
        return false;
    } else {
        //alert('nombre válido dado. Por favor ingrese su nombre completo (nombre y apellido)');
        nombreValido =  true ;
    }


    /*validación de correo*/

    let re=/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
    let esValido = re.test(correo);
    if(esValido===true){
        correoValido = true;
    }
    else {
        alert('El correo que ha ingresado no es valido.');  
        return false;
    }

    /*Validación de contraseña*/

    if (contrasena.normalize()!== contrasenaRepetida.normalize()) {
        //son diferentes
        alert('Las contraseñas no coinciden.');
        return false;
    } else {
        if(contrasena.length==0 || contrasena.length<8){
            alert('La contraseña es debil.');
            return false;
        }
        else{
            contrasenaValida = true;
        }
    }

    /*Confirmación de que todas las validaciones son correctas*/

   // return nombreValido=true && correoValido == true && contrasenaValida == true;

    if (nombreValido === true && correoValido === true && contrasenaValida === true) {
        return true;
    }else{
        return false;
    }

}