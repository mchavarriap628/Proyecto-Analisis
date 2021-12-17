function validarCredenciales(){
    let correo = document.getElementById("correoElectronico").value;
    let contrasena = document.getElementById("contrasena").value;
    let correoValido, contrasenaValida;

    /*validación de correo*/

    let re=/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
    let esValido = re.test(correo);
    if(esValido==true){
        /*alert('Email es valido');*/
        correoValido = true;
    }
    else {
        alert('El correo que ha ingresado no es valido.');  
        correoValido = false;
    }

    /*Validación de contraseña*/

    if(contrasena.length==0 || contrasena.length<8){
        alert('Por favor ingrese una contraseña valida.');
        contrasenaValida = false;
    }
    else{
        contrasenaValida = true;
    }

    /*Confirmación de que ambos valores son validos*/

    return correoValido == true && contrasenaValida == true;

    /*if (correoValido == true && contrasenaValida == true) {
        return true;
    }else{
        return false;
    }*/

}