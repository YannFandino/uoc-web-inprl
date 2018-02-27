<?php
    require_once 'class/ConexionBD.php';
    require_once 'class/Trabajador.php';
    $titulo = 'INPRL - Inicio';
    require 'head.php';
	require 'header.php';

	$conn = new ConexionBD();
	$registrado = $conn->insertUser($_POST['dni_user'], $_POST['nombre_user'],$_POST['email'],$_POST['pw'], $_POST['genero']);
	if ($registrado) {
		echo "<div class='error'>Se ha registrado exitosamente. Puede iniciar sesión.</div>";
	}
?>
	<footer>
    	<p>INPRL. Todos los derechos reservados &copy;</p>
    </footer>
</body>
</html>