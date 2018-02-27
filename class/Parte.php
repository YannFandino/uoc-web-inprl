<?php
class Parte {
	private $cod_parte;
	private $dni;
	private $fecha;
	private $hora;
	private $causa;
	private $tipoLesion;
	private $parteCuerpo;
	private $gravedad;
	private $baja;
	
	// Costructor
	public function __construct($cod_parte) {
		$this-> cod_parte = $cod_parte;
	}
	
	// Setters
	public function set_dni($dni) {
		$this->dni = $dni;
	}
	public function set_fecha($fecha) {
		$this->fecha = $fecha;
	}
	public function set_hora($hora) {
		$this->hora = $hora;
	}
	public function set_causa($causa) {
		$this->causa = $causa;
	}
	public function set_tipoLesion($tipoLesion) {
		$this->tipoLesion = $tipoLesion;
	}
	public function set_parteCuerpo($parteCuerpo) {
		$this->parteCuerpo = $parteCuerpo;
	}
	public function set_gravedad($gravedad) {
		$this->gravedad = $gravedad;
	}
	public function set_baja($baja) {
		$this->baja = $baja;
	}
	
	// Getters
	public function get_cod_parte() {
		return $this->cod_parte;
	}
	public function get_dni() {
		return $this->dni;
	}
	public function get_fecha() {
		return $this->fecha;
	}
	public function get_hora() {
		return $this->hora;
	}
	public function get_causa() {
		return $this->causa;
	}
	public function get_tipoLesion() {
		return $this->tipoLesion;
	}
	public function get_parteCuerpo() {
		return $this->parteCuerpo;
	}
	public function get_gravedad() {
		return $this->gravedad;
	}
	public function get_baja() {
		return $this->baja;
	}
}
?>