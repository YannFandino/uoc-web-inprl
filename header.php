<body>
	<header>
			<img alt="Logo INPRL" class="logo" src="img/logo.png"><div class="name">Instituto Nacional<br>
			de Prevensión de Riesgos Laborales</div>
	</header>
<?php
	if (!isset($_SESSION['user'])) {
?>
	<nav class="menu">
		<ul>
			<li><a href="index.php">El INPRL</a></li>
			<li><a href="info_riesgos.php">Información sobre riesgos</a></li>
			<li id="login_b"><a href="#login">Iniciar Sesión</a></li>
		</ul>
	</nav>
	<div class="login_cont">
	<div class="login">
		<form class="login_form" action="index.php" method="post">
			<input type="text" name="user" placeholder="DNI">
			<input type="pass" name="pw" placeholder="Contraseña">
			<button>Entrar</button>
		</form>
		<div>¿No tienes una cuenta? <a id="registro" href="#">Registrate</a></div>
	</div>
	</div>
<?php
	}
	else {
?>
	<nav class="menu">
		<ul>
			<li><a href="index.php">El INPRL</a></li>
			<li><a href="info_riesgos.php">Información sobre riesgos</a></li>
			<li><a href="nuevo-parte.php">Nuevo Parte</a></li>
			<li><a href="modificar-parte.php">Modificar Parte</a></li>
			<li><a href="consulta-parte.php">Consulta de Partes</a></li>
			<li><a href="index.php?logout=true">Cerrar Sesión</a></li>
		</ul>
	</nav>
<?php 
	}
?>
<script type="text/javascript">
	$('.login').css('left', ($('#login_b').position().left));

	// Mostrar o esconder formulario de login
	$('#login_b').click(function() {
		$('.login').toggle('medium');
	});

	// Mostrar ocultar formulario de registro
    $('#registro').click(function() {
    	$('.cont_registro').slideToggle('medium');
    });
</script>