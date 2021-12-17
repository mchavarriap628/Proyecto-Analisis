function CheckPasswordStrength(password) { //password es lo que se evalua todo el rato
      var password_strength = document.getElementById("password_strength"); //Esto es lo que se pinta en el html

 
        //Si la caja de texto está vacia entonces no se muestra nada
        if(password.length==0){
            password_strength.innerHTML = "";
            return;
        }

        //Expresiones regulares para validar
        var regex = new Array();
        regex.push("[A-Z]"); //Mayusculas
        regex.push("[a-z]"); //Minusculas
        regex.push("[0-9]"); //Números
        regex.push("[$@$!%*#?&]"); //Caracteres especiales

        var passed = 0;

        //Que se cumpla cada expresión regular
        for (var i = 0; i < regex.length; i++) {
            if((new RegExp (regex[i])).test(password)){
                passed++;
            }
        }

        //Que sea un password largo
        if(passed > 2 && password.length > 8){
            passed++;
        }

        //Resultado
        var color = "";
        var passwordStrength = "";
        switch(passed){
            case 0:
              	break;
            case 1:
                passwordStrength = "La contraseña es muy debil.";
                color = "Red";
                break;
            case 2:
                passwordStrength = "La contraseña podría ser mejor.";
                color = "darkorange";
                break;
            case 3:
            		break;
            case 4:
                passwordStrength = "La contraseña está bien.";
                color = "Green";
                break;
            case 5:
                passwordStrength = "La contraseña es muy buena.";
                color = "darkgreen";
                break;
        }
        password_strength.innerHTML = passwordStrength;
        password_strength.style.color = color;
    }