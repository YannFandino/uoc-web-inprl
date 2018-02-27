<?php
    session_start();
    require_once 'class/ConexionBD.php';
    require_once 'class/Trabajador.php';
    $titulo = 'INPRL - Inicio';
    require 'head.php';
    // Comprobar si se ha iniciado sesión
    if (isset($_POST['user'])) {
        $_SESSION['user'] = $_POST['user'];
        $conn = new ConexionBD();
        $user = $conn->getWorkerByDNI($_SESSION['user'], $_POST['pw']);

        if ($user == 'Error') {
            echo "<script>
                      alert('Usuario o contraseña incorrecto');
                  </script>";
            unset($_SESSION['user']);
            unset($_POST['pw']);
        }
    }
    // Comprobar si se ha cerrado sesión
    if (isset($_GET['logout'])) {
        unset($_SESSION['user']);
        session_destroy();
    }
	require 'header.php';
?>
    
    <div class="content">
    <section class="who">
    	<h2>¿Quiénes somos?</h2>
    	<p>El Instituto Nacional de Prevensión de Riesgos Laborales es un organismo público que pertenece al Ministerio de Sanidad, Servicios Sociales e Igualdad.  A través de este sitio web ofrece información de libre acceso para todos los usuarios relacionada con la Prevensión de Riesgos Laborales (PRL). En sus actividades el INPRL promociona las normas y requerimientos necesarios para el buen desarrollo de la actividad laboral en un entorno seguro.</p>
    	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent felis neque, efficitur quis dapibus a, rutrum lacinia turpis. Quisque leo sem, suscipit at eros ut, dictum sagittis libero. Etiam eget commodo nibh. Nulla eu nisi id massa euismod porttitor. Nulla sodales, magna fringilla vestibulum porttitor, eros risus vestibulum leo, non rhoncus nisi sapien non lectus. Nam a purus consequat tortor finibus faucibus id eu massa. Morbi non tempus est. Nunc vel ipsum mi. Nulla non sapien vehicula metus volutpat sollicitudin. Maecenas ut venenatis augue. Phasellus sit amet purus at eros lacinia fermentum. Aenean fermentum magna eget nibh commodo, vitae varius nisl varius. Proin vel risus id turpis blandit dictum. Vestibulum nisi neque, consectetur eu eros id, dapibus sagittis orci.</p>
    </section>
    <section class="where">
    	<h2>¿Dónde estamos?</h2>
    	<p> Dirección: Paseo del Prado, 18, 28014 Madrid <br>
    	    Tel: 901 40 01 00</p>
    	
    	<div id="googleMap" style="width:100%;height:300px;"></div>

    </section>
    <div class="clear"></div>
    <section class="contact">
    	<h2>Contacto</h2>
    	<form class="contactForm" action="mailto:yfandino@fp.uoc.edu">
    		<input class="contactInput" type="text" name="nombre" placeholder="Nombre y Apellidos"><br>
    		<input class="contactInput" type="email" name="email" placeholder="Correo Electrónico"><br>
    		<input class="contactInput" type="tel" name="tel" placeholder="Teléfono"><br>
    		<textarea maxlength="500" name="msg" rows="10" placeholder="Escriba su mensaje"></textarea><br>
			<button type="submit">Enviar</button>
			<button type="reset">Restablecer</button>
    	</form>
    </section>
    </div>

    <?php
        require 'registro_form.php';
    ?>

    <footer>
    	<p>INPRL. Todos los derechos reservados &copy;</p>
    </footer>
	<script>
        // Función para generar el mapa
		function miMapa() {
			var direccion = new google.maps.LatLng(40.413397, -3.694118);
			var mapaDiv = 	document.getElementById("googleMap");
			var mapaProp = {center: direccion, zoom:15};
			var mapa = new google.maps.Map(mapaDiv, mapaProp);
			var marcador = new google.maps.Marker({position: direccion});
			marcador.setMap(mapa);
		}
		// Igualar altura de contenedores
		$(".who").height($(".where").height());
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAH0J-YqEdHvPi1X_tqmyb1W4hKIrKta6I&callback=miMapa"></script>
</body>
</html>
