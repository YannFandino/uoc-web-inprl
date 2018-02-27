<?php
	$titulo = 'INPRL - Consultar partes';
	session_start();
    require_once 'class/ConexionBD.php';
    require_once 'class/Trabajador.php';
    require 'head.php';
	require 'header.php';

	if (!isset($_GET['accion'])) {
?>
	<div class='content'>
		<section class='contact'>
		<h2>Consulta de parte</h2>
			<form class='contactForm parteForm editForm' id ='edit' action='consulta-parte.php' method='GET'>
				<label for='cod'>Cod. parte </label>
					<input type='text' id='cod' name='codigo'>
				<label for='fecha'>Fecha del accidente</label>
					<input type='date' id='fecha' name='fecha'><br>
				<label for='name'>Nombre del accidentado</label>
					<input type='text' id='name' name='name'><br>
				<label for='causa'> Causa del accidente</label>
					<input type='text' id='causa' name='causa'><br>
				<label for='tipoLesion'> Tipo o naturaleza de la lesión</label>
					<input type='text' id='tipoLesion' name='tipoLesion'><br>
				<label for='parteCuerpo'> Parte del cuerpo lesionada</label>
					<input type='text' id='parteCuerpo' name='parteCuerpo'>
				<label for='gravedad'> Gravedad del accidente</label>
					<select id='gravedad' name='gravedad'>
						<option value='0'>Seleccionar</option>	
						<option value='Baja'>Baja</option>
						<option value='Normal'>Normal</option>
						<option value='Alta'>Alta</option>
					</select>
				<label>¿El accidente ha causado baja?</label>
					<label>Si<input type='radio' id='si' name='baja' value='Si'></label>
					<label>No<input type='radio' id='no' name='baja' value='No'></label><br>
				<label for='ccaa'> Comunidad Autónoma</label>
					<select id="ccaa" name="ccaa">
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
					<label for='sexo'> Sexo</label>
						<select id='sexo' name='sexo'>
							<option value='0'>Seleccionar</option>
							<option value='mujer'>Mujer</option>
							<option value='hombre'>Hombre</option>
						</select>

				<button type='submit' name='accion' value='search'>Buscar</button>
			</form>
		</section>
	</div>
        
<?php 
	} elseif ($_GET['accion'] == 'search') {

		$codigo = $_GET["codigo"];
		$fecha = $_GET['fecha'];
		$name = ($_GET['name'] != '') ? $_GET['name']:'*';
		$causa = ($_GET['causa'] != '') ? $_GET['causa']:'*';
		$tipoLesion = ($_GET['tipoLesion'] != '') ? $_GET['tipoLesion']:'*';
		$parteCuerpo = ($_GET['parteCuerpo'] != '') ? $_GET['parteCuerpo']:'*';
		$gravedad = $_GET['gravedad'];
		$baja = (isset($_GET['baja'])) ? $_GET['baja']:'*';
		$ccaa = $_GET['ccaa'];
		$sexo = $_GET['sexo'];

		$conexion = new ConexionBD();
		$result = $conexion->searchDatos($codigo,$fecha,$name,$causa,$tipoLesion,$parteCuerpo,$gravedad,$baja,$ccaa,$sexo);
		$fila = @mysqli_fetch_assoc($result);
		
		if ($fila) {
			do {
	?>			<div class='content'>
					<table class='contactForm parteForm editForm' cellspacing="0" cellpadding="5">
						<tr class="impar">
							<th>Código</th><td><?php echo $fila['cod_parte']?></td>
							<th>Nombre</th><td><?php echo $fila['nombre']?></td>
							<th>Causa</th><td><?php echo $fila['Causa_accidente']?></td>
						</tr>
						<tr class="par">
							<th>Tipo de lesión</th><td><?php echo $fila['Tipo_lesion']?></td>
							<th>Parte del cuerpo<br>lesionada</th><td><?php echo $fila['Partes_cuerpo_lesionado']?></td>
							<th>Gravedad</th><td><?php echo $fila['Gravedad']?></td>
						</tr>
						<tr class="impar">
							<th>Ha causado<br>baja</th><td><?php echo $fila['Baja']?></td>
							<th>Comunidad Autónoma</th><td><?php echo $fila['com_autonoma']?></td>
							<th>Sexo</th><td><?php echo $fila['sexo']?></td>
						</tr>
					</table>
				</div>
<?php
			} while ($fila = @mysqli_fetch_assoc($result));
		} elseif ($result == 'Error') {
			echo "<div class='content'>
			      <section class='contact'>
				      <h2>Consulta de partes</h2>
					  	  <div class='error'>No se han encuentrado datos con los criterios de busqueda</div>
				  </section>
				  </div>";
		}
?>
			  
				 
<?php
		$conexion->close_conn();
	}
?>
<footer>
    	<p>INPRL. Todos los derechos reservados &copy;</p>
</footer>
</body>
</html>