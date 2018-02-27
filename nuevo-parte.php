<?php
	$titulo = 'INPRL - Nuevo parte';
	session_start();
    require_once 'class/ConexionBD.php';
    require 'head.php';

    if (isset($_POST['user'])) {
        $_SESSION['user'] = $_POST['user'];
        $conn = new ConexionBD();
    }
	require 'header.php';
	
	if (!isset($_POST["dni"]) && !isset($_POST["name"]) &&
	    !isset($_POST["ccaa"]) && !isset($_POST["age"]) &&
	    !isset($_POST["gender"])) {
?>
	<div class="content">
	<section class="contact">
    	<h2>Nuevo parte</h2>
    	<form class="contactForm parteForm" id="nuevoParte" action="nuevo-parte.php" method="post">
			<fieldset>
				<legend>
					Datos del empleado
				</legend>
				<input class="dni" type="text" name="dni" placeholder="DNI" maxlength="9">
				<input type="text" name="name" placeholder="Nombre y Apellidos" maxlength="100"><br>
				<select name="ccaa">
					<option value="0">CCAA</option>
					<option value="Andalucia">Andalucía</option>
					<option value="Aragon">Aragón</option>
					<option value="Asturias">Principado de Asturias</option>
					<option value="Islas Baleares">Islas Baleares</option>
					<option value="Pais Vasco">País Vasco</option>
					<option value="Canarias">Canarias</option>
					<option value="Cantabria">Cantabria</option>
					<option value="Castilla-La Mancha">Castilla-La Mancha</option>
					<option value="Castilla y Leon">Castilla y León</option>
					<option value="Cataluna">Cataluña</option>
					<option value="Extremadura">Extremadura</option>
					<option value="Galicia">Galicia</option>
					<option value="Comunidad de Madrid">Comunidad de Madrid</option>
					<option value="Region de Murcia">Región de Murcia</option>
					<option value="Navarra">Comunidad Foral de Navarra</option>
					<option value="La Rioja">La Rioja</option>
					<option value="Comunidad Valenciana">Comunidad Valenciana</option>
					<option value="Ceuta">Ceuta</option>
					<option value="Melilla">Melilla</option>
				</select>
				<input type="number" name="age" placeholder="Edad">
				<select name="gender">
					<option value="0">Sexo</option>
					<option value="mujer">Mujer</option>
					<option value="hombre">Masculino</option>

				</select>
			</fieldset>
			<fieldset>
				<legend>
					Datos parte
				</legend>
				<label> Fecha del accidente
					<input type="date" name="fecha"></label>
				<label> Hora del accidente
					<input type="time" name="hora"></label><br>
				<input type="text" name="causa" placeholder="Causa del accidente" maxlength="50">
				<input type="text" name="tipoLesion" placeholder="Tipo de lesión" maxlength="30"><br>
				<input type="text" name="parteCuerpo" placeholder="Parte del cuerpo afectada" maxlength="30">
				<label> ¿El accidente ha causado baja del trabajador?
					<label>Si<input type="radio" name="baja" value="Si"></label>
					<label>No<input type="radio" name="baja" value="No"></label><br>
				</label><br>
				<label> Gravedad del accidente:
					<select name="gravedad">
						<option value="0">Seleccionar</option>
						<option value="Baja">Baja</option>
						<option value="Normal">Normal</option>
						<option value="Alta">Alta</option>
					</select>
				</label>
				
			</fieldset>
			<button type="submit">Enviar</button>
			<button type="reset">Restablecer</button>
    	</form>
    </section>
    </div>
<?php
	} else {
		$dni = $_POST["dni"];
		$name = $_POST["name"];
		$ccaa = $_POST["ccaa"];
		$age = $_POST["age"];
		$gender = $_POST["gender"];
		$fecha = $_POST["fecha"];
		$hora = $_POST["hora"];
		$causa = $_POST["causa"];
		$tipoLesion = $_POST["tipoLesion"];
		$partCuerpo = $_POST["parteCuerpo"];
		$baja = $_POST["baja"];
		$gravedad = $_POST["gravedad"];
		$codigo;
		$checkCodigo = true;
		
		// Funcion para crear codigo aleatorio
		function generarCodigo() {
			$chars = "1234567890";
			$cadena = "";
			for($i = 0; $i < 5; $i++) {
				$cadena .= substr($chars,rand(0,strlen($chars)),1);
			}
			return $cadena;
		}
		
		// Conexion con la base de datos
		$conexion = @mysqli_connect('localhost', 'id3027500_root', 'webinprl', 'id3027500_parteaccidente') 
			        or die("<div class='error'>En este momento no podemos procesar su solicitud. Intentelo más tarde.</div>");
		// Generar codigo de parte
		do {
			$codigo = generarCodigo();
			$query_CompCodigo = "SELECT * FROM parte WHERE cod_parte = '$codigo';";
			$resultado = mysqli_query($conexion, $query_CompCodigo) or die("Error en la generación del código");
			$checkCodigo = mysqli_fetch_assoc($resultado);
			// Si no existe el codigo, se sale del loop
			if ($checkCodigo == NULL) {
				$checkCodigo = false;
			}
		} while ($checkCodigo);
		
		// Query para insertar el registro del trabajador
		$query_Trabajador = "INSERT INTO trabajador (DNI, nombre, sexo, com_autonoma)
		                     VALUES ('$dni', '$name', '$gender','$ccaa');";
		$insert = mysqli_query($conexion, $query_Trabajador);
		if (mysqli_errno($conexion) == 1062) {
			echo "<div class='error'>El trabajador ya posee un parte (Cod. 02).</div>";
			die();
		};
		// Query para insertar el registro del parte
		$query_Parte = "INSERT INTO parte (cod_parte, DNI, Fecha_accidente, Hora_accidente, Causa_accidente,                                         Tipo_lesion, 	Partes_cuerpo_lesionado, Gravedad, Baja)
		                     VALUES ('$codigo', '$dni', '$fecha','$hora','$causa','$tipoLesion','$partCuerpo',
							         '$gravedad', '$baja');";
		$insert = mysqli_query($conexion, $query_Parte);
		if (mysqli_errno($conexion) == 1062) {
			mysqli_rollback($conexion);
			echo "<div class='error'>El trabajador ya posee un parte (Cod. 03).</div>";
			die();
		};
		
		echo "<div class='error'>El parte se ha registrado correctamente. Su código es <span style='color=white'>$codigo</span></div>";
		
		mysqli_close($conexion);
		
	}
?>
	<footer>
    	<p>INPRL. Todos los derechos reservados &copy;</p>
    </footer>
    <script src="js/comp_formu.js"></script>
</body>
</html>