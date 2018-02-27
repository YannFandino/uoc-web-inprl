<?php
	$titulo = 'INPRL - Nuevo parte';
	require 'head.php';
	require 'header.php';
	require_once('class/ConexionBD.php');
	require_once('class/Parte.php');
	require_once('class/Trabajador.php');

	if (!isset($_POST["name"]) && !isset($_POST["fecha"]) &&
	    !isset($_POST["causa"]) && !isset($_POST["tipoLesion"]) &&
	    !isset($_POST["parteCuerpo"]) && !isset($_POST["gravedad"]) &&
	    !isset($_POST["baja"])) {
?>        
    <script>
	    window.onload = function() {
			setTimeout(function() {
				window.location = "index.php";
			}, 0);
    	};
    </script>
				 
<?php 
	} else {
		$accion = $_POST["accion"];
		$codigo = $_POST["codigo"];
		
		// Conectar a la BBDD
		$conexion = new ConexionBD();
		
		// Datos del parte
		$parte = new Parte($codigo);
		$parte->set_fecha($_POST["fecha"]);
		$parte->set_causa($_POST["causa"]);
		$parte->set_tipoLesion($_POST["tipoLesion"]);
		$parte->set_parteCuerpo($_POST["parteCuerpo"]);
		$parte->set_baja($_POST["baja"]);
		$parte->set_gravedad($_POST["gravedad"]);
		
		// Datos del trabajador
		$trabajador = $conexion->getWorker($parte->get_cod_parte());
		$trabajador->set_nombre($_POST["name"]);
		
		if ($accion == 'modif') {
			
			$result_Parte = $conexion->updateParte($parte);
			$result_Trabajador = $conexion->updateWorker($trabajador);
			
			if ($result_Parte && $result_Trabajador) {
				echo "<div class='error'>Datos modificados correctamente.</div>";
			} else {
				mysqli_rollback($conexion->conexion);
				echo "<div class='error'>Error ocurrido al modificar datos en el sistema. Contacte con el administrador.</div>";
			}
			$conexion->close_conn();
		} elseif ($accion == 'elim') {
			
			$result = $conexion->deleteParte($parte);
			
			if ($result) {
				echo "<div class='error'>Datos eliminados correctamente.</div>";
			} else {
				mysqli_rollback($conexion->conexion);
				echo "<div class='error'>Error ocurrido al eliminar datos en el sistema. Contacte con el administrador.</div>";
			}
			$conexion->close_conn();
		}
		
	}
?>
<footer>
    	<p>INPRL. Todos los derechos reservados &copy;</p>
</footer>
</body>
</html>