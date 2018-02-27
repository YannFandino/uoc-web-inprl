<div class="cont_registro">
    <form class="form_registro" action="registro.php" method="post">
        <input type="text" name="dni_user" placeholder="DNI" maxlength="9"><br>
        <input type="text" name="nombre_user" placeholder="Nombre y Apellidos"><br>
        <input type="email" name="email" placeholder="Email"><br>
        <input type="pass" name="pw" placeholder="Contraseña"><br>
        Género: <select name="genero">
                    <option value="0">Seleccionar</option>
                    <option value="mujer">Mujer</option>
                    <option value="hombre">Hombre</option>
                </select><br>
        <button type="submit">Registrar</button><button type="reset" id="cancel">Cancelar</button>
    </form>
</div>

<script>
    // Ocultar formulario de registro
    $('#cancel').click(function() {
        $('.cont_registro').slideToggle('medium');
        $('[name="dni_user"]').css("border-bottom", "");
        $('[name="nombre_user"]').css("border-bottom", "");
        $('[name="pw"]').css("border-bottom", "");
        $('[name="email"]').css("border-bottom", "");
    });

    // Comprobraciones
    // Variables auxiliares
    var a,b,c,d,e;
    // DNI/NIE
    $('[name="dni_user"]').focusout(function(){
        var regex = /^\d{8}[A-Za-z]{1}$/;
        var str = $(this).val();
        // Se comprueba si es un NIE
        if (str[0].toUpperCase() == "X") {
            str = "0" + str.substr(1,9);
        } else if (str[0].toUpperCase() == "Y") {
            str = "1" + str.substr(1,9);
        }
        // Calculo de letra de DNI/NIE
        var letras = "TRWAGMYFPDXBNJZSQVHLCKE";
        var numDNI = str.substr(0,8);
        var letraDNI = letras[numDNI%23];

        if (regex.test(str) && letraDNI == str[8].toUpperCase()) {
            $(this).css("border-bottom", "2px inset green");
            a = true;
        } else {
            $(this).css("border-bottom", "2px inset red");
            a = false;
        }
    });
    // NOMBRE
    $('[name="nombre_user"]').focusout(function(){
        var regex = /[A-Za-z]{2,}/;
        var str = $(this).val();
        if (regex.test(str)) {
            $(this).css("border-bottom", "2px inset green");
            b=true;
        } else {
            $(this).css("border-bottom", "2px inset red");
            b=false;
        }
    });
    // CONTRASEÑA
    $('[name="pw"]').focusout(function(){
        var regex = /[A-Za-z0-9]{7,}/;
        var str = $(this).val();
        if (regex.test(str)) {
            $(this).css("border-bottom", "2px inset green");
            c=true;
        } else {
            $(this).css("border-bottom", "2px inset red");
            c=false;
        }
    });
    // EMAIL
    $('[name="email"]').focusout(function(){
        var regex = /^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/;
        var str = $(this).val();
        if (regex.test(str)) {
            $(this).css("border-bottom", "2px inset green");
            d=true;
        } else {
            $(this).css("border-bottom", "2px inset red");
            d=false;
        }
    });
    // GENDER
    $('[name="genero"]').change(function(){
        var str = $(this).val();
        if (str != 0) {
            $(this).css("border-bottom", "2px inset green");
            e=true;
        } else {
            $(this).css("border-bottom", "2px inset red");
            e=false;
        }
    });

    $(".form_registro").submit(function(){
        //Se verifica si esta seleccionado el input tipo radio
        if (a && b && c && d && e) {
            return true;
        } else {
            alert('Debe rellenar todos los campos correctamente');
            return false;
        }
    });
</script>
<script src="js/comp_formu.js"></script>