<?php
class ConexionBD {
	public $conexion;
	private $host = 'localhost';
	private $user = 'id3027500_root';
	private $pass = 'webinprl';
	private $bbdd = 'id3027500_parteaccidente';
	private $query_GetDatos = "SELECT p.Fecha_accidente, t.nombre, t.DNI, p.Causa_accidente, p.Tipo_lesion, 
	                                  p.Partes_cuerpo_lesionado, p.Gravedad, p.Baja
	                           FROM parte p, trabajador t
				               WHERE p.DNI = t.DNI
				               AND p.cod_parte = ";
	
	// Constructor
	public function __construct() {
		$this->conexion = $this->connect();
	}
	
	// Función para conectar a la base de datos
	public function connect() {
		try {
			$conn = @mysqli_connect($this->host, $this->user, $this->pass, $this->bbdd);
			if (mysqli_connect_errno() != 0) {
				throw new Exception;
			}
			return $conn;
		} catch(Exception $e) {
			 echo "<div class='error'>En este momento no podemos procesar su solicitud. Inténtelo más tarde.</div>";
		     die();
		}
	}

	public function insertUser($dni, $nombre, $email, $pw, $genero) {
		$query = "INSERT INTO trabajador (DNI, nombre, correo_elec, password, sexo)
				 VALUES ('$dni', '$nombre','$email','$pw','$genero');";
		try {
			$resultado = @mysqli_query($this->conexion, $query);
			if (!$resultado) {
				throw new Exception;
			}
			return true;
		} catch(Exception $e) {
			echo "<div class='error'>En este momento no podemos procesar su solicitud. Inténtelo más tarde.</div>";
		}
	}
	
	// Función para obtener los datos para el formulario de modificar un parte
	public function getDatos($cod_parte) {
		$this->query_GetDatos .= "'$cod_parte';";
		try {
			$resultado = @mysqli_query($this->conexion, $this->query_GetDatos);
			if (!$resultado) {
				throw new Exception;
			}
			return $resultado;
		} catch(Exception $e) {
			echo "<div class='error'>Error al procesar su solicitud. Contacte al Administrador del sitio. (Cod. 04).</div>";
				die();
		}
		
	}
	
	// Función para actualizar los datos de un parte
	public function updateParte(Parte $parte) {
		$query = "UPDATE parte
				  SET Fecha_accidente = '{$parte->get_fecha()}',
				      Causa_accidente = '{$parte->get_causa()}',
				      Tipo_lesion     = '{$parte->get_tipoLesion()}',
				      Gravedad        = '{$parte->get_gravedad()}',
				      Baja            = '{$parte->get_baja()}',
				      Partes_cuerpo_lesionado = '{$parte->get_parteCuerpo()}'
				  WHERE cod_parte = '{$parte->get_cod_parte()}';";
		try {
			$resultado = @mysqli_query($this->conexion, $query);
			if (!$resultado) {
				throw new Exception;
			}
			return true;
		} catch(Exception $e) {
			
		}
		
	}
	
	// Función para buscar el trabajador de un parte
	public function getWorker($cod_parte) {
		$query = "SELECT * FROM trabajador WHERE DNI IN (SELECT DNI FROM parte WHERE cod_parte = '$cod_parte');";
		try {
			$resultado = mysqli_query($this->conexion, $query);
			$fila = @mysqli_fetch_assoc($resultado);
			if (!$resultado) {
				throw new Exception;
			} else {
				$trabajador = new Trabajador($fila['DNI']);
				$trabajador->set_nombre($fila['nombre']);
				$trabajador->set_sexo($fila["sexo"]);
				$trabajador->set_fecha_nacimiento($fila["fecha_nacimiento"]);
				$trabajador->set_direccion($fila["direccion"]);
				$trabajador->set_com_autonoma($fila["com_autonoma"]);
				$trabajador->set_telefono($fila["telefono"]);
				$trabajador->set_correo_elec($fila["correo_elec"]);
				$trabajador->set_sector($fila["sector"]);
			}
			return $trabajador;
		} catch(Exception $e) {
			
		}
	}

	// Función para buscar el trabajador de un parte por su DNI
	public function getWorkerByDNI($dni, $pass) {
		$query = "SELECT * FROM trabajador WHERE DNI = '$dni';";
		try {
			$resultado = mysqli_query($this->conexion, $query);
			$fila = @mysqli_fetch_assoc($resultado);
			if (!mysqli_num_rows($resultado)) {
				throw new Exception;
			} else {
				if ($fila['password'] != $pass) {
					throw new Exception();
				}
				$trabajador = new Trabajador($fila['DNI']);
				$trabajador->set_nombre($fila['nombre']);
				$trabajador->set_sexo($fila["sexo"]);
				$trabajador->set_fecha_nacimiento($fila["fecha_nacimiento"]);
				$trabajador->set_direccion($fila["direccion"]);
				$trabajador->set_com_autonoma($fila["com_autonoma"]);
				$trabajador->set_telefono($fila["telefono"]);
				$trabajador->set_correo_elec($fila["correo_elec"]);
				$trabajador->set_sector($fila["sector"]);

			}
			return $trabajador;
		} catch(Exception $e) {
			return "Error";
		}
	}
	
	// Función para actualizar los datos de un parte
	public function updateWorker(Trabajador $trabajador) {
		$query = "UPDATE trabajador
				  SET nombre = '{$trabajador->get_nombre()}'
				  WHERE dni = '{$trabajador->get_dni()}';";
		try {
			$resultado = @mysqli_query($this->conexion, $query);
			if (!$resultado) {
				throw new Exception;
			}
			return true;
		} catch(Exception $e) {
			
		}
	}
	
	// Función para borrar un parte de la base de datos
	public function deleteParte(Parte $parte) {
		$query = "DELETE FROM parte
			      WHERE cod_parte = '{$parte->get_cod_parte()}';";
		try {
			$resultado = @mysqli_query($this->conexion, $query);
			if (!$resultado) {
				throw new Exception;
			}
			return true;
		} catch(Exception $e) {
			
		}
	}
	// Función para cerrar la conexión a la base de datos
	public function close_conn() {
		try {
			$closeBD = @mysqli_close($this->conexion);
			
			if ($closeBD == false) {
				throw new Exception;
			}
		} catch (Exception $e) {
			echo "<div class='error'>Error al procesar su solicitud. Contacte al Administrador del sitio. (Cod. 05).</div>";
		}
	}

	// Función para buscar un parte
	public function searchDatos($codigo,$fecha,$name,$causa,$tipoLesion,$parteCuerpo,$gravedad,$baja,$ccaa,$sexo) {
		$query = "SELECT * FROM parte p, trabajador t
		          WHERE p.DNI = t.DNI
		          AND (p.cod_parte = '$codigo'
		          OR p.Fecha_accidente = '$fecha'
		          OR t.nombre LIKE '%$name%'
		          OR p.Causa_accidente LIKE '%$causa%'
		      	  OR p.Tipo_lesion LIKE '%$tipoLesion%'
		      	  OR p.Partes_cuerpo_lesionado LIKE '%$parteCuerpo%'
		      	  OR p.Gravedad = '$gravedad'
		      	  OR p.Baja = '$baja'
		      	  OR t.com_autonoma = '$ccaa'
		      	  OR t.sexo = '$sexo');";
		try {
			$resultado = @mysqli_query($this->conexion, $query);
			if (!mysqli_num_rows($resultado)) {
				throw new Exception;
			}
			return $resultado;
		} catch(Exception $e) {
			return "Error";
		}
		
	}
}
?>