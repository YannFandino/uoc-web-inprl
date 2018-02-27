<?php
	$titulo = 'INPRL - Modificar parte';
	session_start();
    require_once 'class/ConexionBD.php';
    require_once 'class/Trabajador.php';
    require 'head.php';
	require 'header.php';

	if (!isset($_POST["codigo"])) {
?>
	<div class="content">
	<section class="contact">
    	<h2>Modificar un parte</h2>
    	<form class="contactForm parteForm" action="modificar-parte.php" method="post">
    		<input type="text" maxlength="5" name="codigo" placeholder="Código del parte">
    		<button type="submit">Buscar</button>
		</form>
    </section>
    </div>
        
    <script>
	    // Variable auxiliar
		var codigo;
		// DNI	
		$('[name="codigo"]').focusout(function(){
			var regex = /^\d{5}/;
			var str = $(this).val();

			if (regex.test(str)) {
				$(this).css("border-bottom", "2px inset green");
				codigo = true;
			} else {
				$(this).css("border-bottom", "2px inset red");
				codigo = false;
			}
		});
		
		$(".parteForm").submit(function(){
			if (a) {
				return true;
			} else {
				alert('Debe rellenar todos los campos correctamente');
				return false;
			}
		});
    </script>
<?php 
	} else {
		$codigo = $_POST["codigo"];		
		$conexion = new ConexionBD();

		$result = $conexion->getDatos($codigo);
		$fila = @mysqli_fetch_assoc($result);
		
		if ($fila) {
			// Comprobar si el usuario es propietario del parte
			if ($_SESSION['user'] == $fila['DNI']) {
				echo "<div class='content'>
				      <section class='contact'>
					      <h2>Modificar parte $codigo</h2>
					          <form class='contactForm parteForm editForm' id ='edit' action='action-parte.php' method='post'>
						          <label for='cod'>Cod. parte </label>
								      <input type='text' id='cod' name='codigo' value='$codigo' readonly>
								  <label for='fecha'>Fecha del accidente</label>
								      <input type='date' id='fecha' name='fecha' value='{$fila['Fecha_accidente']}'><br>
								  <label for='name'>Nombre del accidentado</label>
								      <input type='text' id='name' name='name' value='{$fila['nombre']}'><br>
								  <label for='causa'> Causa del accidente</label>
								      <input type='text' id='causa' name='causa' value='{$fila['Causa_accidente']}'><br>
								  <label for='tipoLesion'> Tipo o naturaleza de la lesión</label>
								      <input type='text' id='tipoLesion' name='tipoLesion' value='{$fila['Tipo_lesion']}'><br>
								  <label for='parteCuerpo'> Parte del cuerpo lesionada</label>
								      <input type='text' id='parteCuerpo' name='parteCuerpo' value='{$fila['Partes_cuerpo_lesionado']}'>
								  <label for='gravedad'> Gravedad del accidente</label>
								  	  <select id='gravedad' name='gravedad'>
								  		  <option value='Baja'>Baja</option>
								  		  <option value='Normal'>Normal</option>
								  		  <option value='Alta'>Alta</option>
								  	  </select>
								  <label>¿El accidente ha causado baja?</label>
									  <label>Si<input type='radio' id='si' name='baja' value='Si'></label>
						              <label>No<input type='radio' id='no' name='baja' value='No'></label><br><br>
						          <button type='submit' name='accion' value='modif'>Modificar</button>
								  <button type='submit' name='accion' value='elim'>Eliminar</button>
						      </form>
					  </section>
					  </div>";
			} else {
				// Si el arte no pertenece al trabajador
				echo "<div class='content'>
			      <section class='contact'>
				      <h2>Modificar un parte</h2>
					  	  <div class='error'>El trabajador no tiene parte con código <span style='color:white'>$codigo</span></div>
				          <form class='contactForm parteForm' action='modificar-parte.php' method='post'>
					          <input type='text' maxlength='5' name='codigo' placeholder='Código del parte'>
					          <button type='submit'>Buscar</button>
					      </form>
				  </section>
				  </div>";
			}
		} else {
			// Si no se ha encontrado el parte
			echo "<div class='content'>
			      <section class='contact'>
				      <h2>Modificar un parte</h2>
					  	  <div class='error'>El código <span style='color:white'>$codigo</span> no se encuentra en  la base de datos</div>
				          <form class='contactForm parteForm' action='modificar-parte.php' method='post'>
					          <input type='text' maxlength='5' name='codigo' placeholder='Código del parte'>
					          <button type='submit'>Buscar</button>
					      </form>
				  </section>
				  </div>";
		}
?>
			  	  <script src="js/comp_formu.js"></script>
				  <script>
					  // Pasar el foco a los campos para activar las comprobaciones
					  $('[name="fecha"]').focus();
					  $('[name="causa"]').focus();
					  $('[name="tipoLesion"]').focus();
					  $('[name="parteCuerpo"]').focus();
					  $('[name="name"]').focus();
				  	  // Marcar la opcion seleccionada que está almacenada en la base de datos
				  	  $('[name="gravedad"]').val(<?php echo "'{$fila['Gravedad']}'" ?>).trigger('change');
    
				  	  // Marcar la opcion seleccionada que está almacenada en la base de datos
				  	  if (<?php echo "'{$fila['Baja']}'" ?> == 'Si') {
				  	  	  $("[name='baja'][value='Si']").attr('checked', true);
				  	  } else {
				  	  	  $("[name='baja'][value='No']").attr('checked', true);
				  	  }
				  </script>
				 
<?php
		$conexion->close_conn();
	}
?>
<footer>
    	<p>INPRL. Todos los derechos reservados &copy;</p>
</footer>
</body>
</html>