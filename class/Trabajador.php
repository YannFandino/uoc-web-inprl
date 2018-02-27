<?php
class Trabajador {
	private $dni;
	private $nombre;
	private $sexo;
	private $fecha_nacimiento;
	private $direccion;
	private $com_autonoma;
	private $telefono;
	private $correo_elec;
	private $sector;
	
	// Costructor
	public function __construct($dni) {
		$this-> dni = $dni;
	}
	
	// Setters
	public function set_dni($dni) {
		$this->dni = $dni;
	}
	public function set_nombre($nombre) {
		$this->nombre = $nombre;
	}
	public function set_sexo($sexo) {
		$this->sexo = $sexo;
	}
	public function set_fecha_nacimiento($fecha_nacimiento) {
		$this->fecha_nacimiento = $fecha_nacimiento;
	}
	public function set_direccion($direccion) {
		$this->direccion = $direccion;
	}
	public function set_com_autonoma($com_autonoma) {
		$this->com_autonoma = $com_autonoma;
	}
	public function set_telefono($telefono) {
		$this->telefono = $telefono;
	}
	public function set_correo_elec($correo_elec) {
		$this->correo_elec = $correo_elec;
	}
	public function set_sector($sector) {
		$this->sector = $sector;
	}
	
	// Getters
	public function get_dni() {
		return $this->dni;
	}
	public function get_nombre() {
		return $this->nombre;
	}
	public function get_sexo() {
		return $this->sexo;
	}
	public function get_fecha_nacimiento() {
		return $this->fecha_nacimiento;
	}
	public function get_direccion() {
		return $this->direccion;
	}
	public function get_com_autonoma() {
		return $this->com_autonoma;
	}
	public function get_telefono() {
		return $this->telefono;
	}
	public function get_correo_elec() {
		return $this->correo_elec;
	}
	public function get_sector() {
		return $this->sector;
	}
}
?>