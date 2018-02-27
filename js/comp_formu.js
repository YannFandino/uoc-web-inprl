// Variables auxiliares
var a,b,c,d,e,f,g,h,i,j,k; 
// DNI	
$('[name="dni"]').focusout(function(){
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
$('[name="name"]').focusout(function(){
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
// Comunidad Autonoma
$('[name="ccaa"]').change(function(){
	var str = $(this).val();
	if (str != 0) {
		$(this).css("border-bottom", "2px inset green");
		c=true;
	} else {
		$(this).css("border-bottom", "2px inset red");
		c=false;
	}
});
// Edad
$('[name="age"]').change(function(){
	var str = $(this).val();
	if (str >= 18) {
		$(this).css("border-bottom", "2px inset green");
		d=true;
	} else {
		$(this).css("border-bottom", "2px inset red");
		d=false;
	}
});
// Sexo
$('[name="gender"]').change(function(){
	var str = $(this).val();
	if (str != 0) {
		$(this).css("border-bottom", "2px inset green");
		e=true;
	} else {
		$(this).css("border-bottom", "2px inset red");
		e=false;
	}
});
// Fecha
$('[name="fecha"]').focusout(function(){
	var regex = /(([1-9]|[12][0-9]|3[01])\/([1-9]|1[0-2])\/[12]\d{3})/;
	var str = new Date($(this).val());
	var hoy = Date.now();
	console.log(str.toLocaleDateString());
	console.log(regex.test(str.toLocaleDateString()));

	if (regex.test(str.toLocaleDateString()) && (str.getTime() <= hoy)) {
		$(this).css("border-bottom", "2px inset green");
		f = true;
	} else {
		$(this).css("border-bottom", "2px inset red");
		f = false;
	}
});
// HORA
$('[name="hora"]').focusout(function(){
	var regex = /(([01]\d|2[1-3]):(0[1-9]|[012345]\d))/;
	var str = $(this).val();

	if (regex.test(str)) {
		$(this).css("border-bottom", "2px inset green");
		g = true;
	} else {
		$(this).css("border-bottom", "2px inset red");
		g = false;
	}
});
// CAUSA
$('[name="causa"]').focusout(function(){
	var regex = /[A-Za-z]{5,}/;
	var str = $(this).val();
	if (regex.test(str)) {
		$(this).css("border-bottom", "2px inset green");
		h=true;
	} else {
		$(this).css("border-bottom", "2px inset red");
		h=false;
	}
});
// TIPO DE LESION
$('[name="tipoLesion"]').focusout(function(){
	var regex = /[A-Za-z]{5,}/;
	var str = $(this).val();
	if (regex.test(str)) {
		$(this).css("border-bottom", "2px inset green");
		i=true;
	} else {
		$(this).css("border-bottom", "2px inset red");
		i=false;
	}
});
// PARTE DEL CUERPO
$('[name="parteCuerpo"]').focusout(function(){
	var regex = /[A-Za-z]{5,}/;
	var str = $(this).val();
	if (regex.test(str)) {
		$(this).css("border-bottom", "2px inset green");
		j=true;
	} else {
		$(this).css("border-bottom", "2px inset red");
		j=false;
	}
});
// GRAVEDAD
$('[name="gravedad"]').change(function(){
	var str = $(this).val();
	if (str != 0) {
		$(this).css("border-bottom", "2px inset green");
		k=true;
	} else {
		$(this).css("border-bottom", "2px inset red");
		k=false;
	}
});
// Si no estan todos los campos rellenados de forma correcta no se envia el formulario para añadir nuevo parte
$("#nuevoParte").submit(function(){
	//Se verifica si esta seleccionado el input tipo radio
	var isChecked = $('[name="baja"]:checked').val();
	if(!isChecked){
		alert('Debe seleccionar si el accidente ha causado baja');
		return false;
	}else{
		if (a && b && c && d && e && f && g && h && i && j && k) {
			return true;
		} else {
			alert('Debe rellenar todos los campos correctamente');
			return false;
		}
	}
});
// Comprobación para formulario de edición-eliminación
$("#edit").submit(function(){
	//Se verifica si esta seleccionado el input tipo radio
	var isChecked = $('[name="baja"]:checked').val();
	if(!isChecked){
		alert('Debe seleccionar si el accidente ha causado baja');
		return false;
	}else{
		if (b && f && h && i && j && k) {
			return true;
		} else {
			alert('Debe rellenar todos los campos correctamente');
			return false;
		}
	}
});