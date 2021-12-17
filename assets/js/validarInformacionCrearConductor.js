function validar(){
    let nombre = document.getElementById("conductorNombre").value;
    let correo = document.getElementById("conductorCorreo").value;
    let contrasena = document.getElementById("conductorContrasena").value;
    let contrasenaRepetida = document.getElementById("conductorContrasenaDos").value;

    let nombreValido = false;
    let correoValido = false;
    let contrasenaValida = false;

    /*validación de nombre*/

    let soloLetras = /^[a-zA-Z]+[a-zA-Z]+$/;
    
    if (soloLetras.test(nombre)) {
        alert('Por favor ingrese su nombre completo (nombre y apellido).');
        return false ;
    } else {
        //alert('nombre válido dado.');
        nombreValido =  true ;
    }


    /*validación de correo*/

    let re=/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
    let esValido = re.test(correo);
    if(esValido==true){
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

    //return nombreValido=true && correoValido == true && contrasenaValida == true;

   if (nombreValido === true && correoValido === true && contrasenaValida === true) {
        return true;
    }else{
        return false;
    }

}