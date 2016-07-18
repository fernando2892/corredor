<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class usuario extends Model {
	//
	public $id;
	public $ci;
	public $nombre;
	public $apellido;
	public $sexo;
	public $direccion;
	public $correo;
	public $telefono;
	public $telefonoA;
	public $fechaNac;
	public $corredor; //booleam
	public $intermediario; //booleam
	public $clave;
	public $idPregunta;
	public $login; //booleam
	public $actividad;
	public $respuesta;
	public $insertar;
	public $modificar;
	public $consultar;
	public $eliminar;
	public $idParentesco;
	public $tomador;

	protected $table = 'usuarios';

	static public function validarLogin($usuario) {

		$data = DB::table('usuarios')->where('usuarios.correo', '=', $usuario->getCorreo())->where('usuarios.clave', '=', $usuario->getClave())->orWhere('usuarios.ci', '=', $usuario->getCi())->where('usuarios.clave', '=', $usuario->getClave())->get();
		return $data;
		//->where('usuarios.clave', '=', $usuario->getClave())////->orWhere('usuarios.ci', '=', $usuario->getCi())
	}

	static public function consultarCliente($usuario, $polizaId) {

		$data = DB::table('cliente_poliza')
			->join('usuarios', 'usuarios.id', '=', 'cliente_poliza.id_usuario')
			->join('parentesco', 'cliente_poliza.id_parentesco', '=', 'parentesco.id')
			->where('usuarios.ci', '=', $usuario->getCi())->where('cliente_poliza.id_poliza', '=', $polizaId)
			->select('usuarios.*', 'cliente_poliza.id as cliPolId', 'cliente_poliza.id_parentesco as parentId', 'cliente_poliza.id_usuario as usuId', 'cliente_poliza.tomador', 'parentesco.descripcion as parentDes')
			->get();
		return $data;

	}

	static public function consultarClienteDatos($usuario) {

		$data = DB::table('usuarios')
			->where('usuarios.ci', '=', $usuario->getCi())
			->get();
		return $data;

	}

	static public function insertarTomador($usuario) {

		$data = DB::table('usuarios')->insertGetId([
			'ci' => $usuario->getCi(),
			'nombre' => $usuario->getNombre(),
			'apellido' => $usuario->getApellido(),
			'sexo' => $usuario->getSexo(),
			'direccion' => $usuario->getDireccion(),
			'correo' => $usuario->getCorreo(),
			'telefono_principal' => $usuario->getTelefono(),
			'telefono_adicional' => $usuario->getTelefonoA(),
			'fecha_nacimiento' => $usuario->getFechaNac(),
			'clave' => $usuario->getClave(),

		]);
		return $data;

	}

	static public function modificarTomador($usuario) {

		$data = DB::table('usuarios')->where('id', $usuario->getId())->update([
			'ci' => $usuario->getCi(),
			'nombre' => $usuario->getNombre(),
			'apellido' => $usuario->getApellido(),
			'sexo' => $usuario->getSexo(),
			'direccion' => $usuario->getDireccion(),
			'correo' => $usuario->getCorreo(),
			'telefono_principal' => $usuario->getTelefono(),
			'telefono_adicional' => $usuario->getTelefonoA(),
			'fecha_nacimiento' => $usuario->getFechaNac(),
			'clave' => $usuario->getClave(),
		]);
		return $data;

	}

	static public function comboIntermediario() {

		$data = DB::table('usuarios')->where('usuarios.intermediario', '=', 'Y')->get();
		return $data;

	}

	static public function montoNegocioIntermediario($usuario) {

		$data = DB::table('usuarios')
			->where('id', $usuario->getId())
			->select('porcentaje_negocio')
			->get();
		return $data;

	}

	/**
	 * Gets the value of id.
	 *
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of id.
	 *
	 * @param mixed $id the id
	 *
	 * @return self
	 */
	public function _setId($id) {
		$this->id = $id;

		return $this;
	}

	/**
	 * Gets the value of ci.
	 *
	 * @return mixed
	 */
	public function getCi() {
		return $this->ci;
	}

	/**
	 * Sets the value of ci.
	 *
	 * @param mixed $ci the ci
	 *
	 * @return self
	 */
	public function _setCi($ci) {
		$this->ci = $ci;

		return $this;
	}

	/**
	 * Gets the value of nombre.
	 *
	 * @return mixed
	 */
	public function getNombre() {
		return $this->nombre;
	}

	/**
	 * Sets the value of nombre.
	 *
	 * @param mixed $nombre the nombre
	 *
	 * @return self
	 */
	public function _setNombre($nombre) {
		$this->nombre = $nombre;

		return $this;
	}

	/**
	 * Gets the value of apellido.
	 *
	 * @return mixed
	 */
	public function getApellido() {
		return $this->apellido;
	}

	/**
	 * Sets the value of apellido.
	 *
	 * @param mixed $apellido the apellido
	 *
	 * @return self
	 */
	public function _setApellido($apellido) {
		$this->apellido = $apellido;

		return $this;
	}

	/**
	 * Gets the value of sexo.
	 *
	 * @return mixed
	 */
	public function getSexo() {
		return $this->sexo;
	}

	/**
	 * Sets the value of sexo.
	 *
	 * @param mixed $sexo the sexo
	 *
	 * @return self
	 */
	public function _setSexo($sexo) {
		$this->sexo = $sexo;

		return $this;
	}

	/**
	 * Gets the value of direccion.
	 *
	 * @return mixed
	 */
	public function getDireccion() {
		return $this->direccion;
	}

	/**
	 * Sets the value of direccion.
	 *
	 * @param mixed $direccion the direccion
	 *
	 * @return self
	 */
	public function _setDireccion($direccion) {
		$this->direccion = $direccion;

		return $this;
	}

	/**
	 * Gets the value of correo.
	 *
	 * @return mixed
	 */
	public function getCorreo() {
		return $this->correo;
	}

	/**
	 * Sets the value of correo.
	 *
	 * @param mixed $correo the correo
	 *
	 * @return self
	 */
	public function _setCorreo($correo) {
		$this->correo = $correo;

		return $this;
	}

	/**
	 * Gets the value of telefono.
	 *
	 * @return mixed
	 */
	public function getTelefono() {
		return $this->telefono;
	}

	/**
	 * Sets the value of telefono.
	 *
	 * @param mixed $telefono the telefono
	 *
	 * @return self
	 */
	public function _setTelefono($telefono) {
		$this->telefono = $telefono;

		return $this;
	}

	/**
	 * Gets the value of telefonoA.
	 *
	 * @return mixed
	 */
	public function getTelefonoA() {
		return $this->telefonoA;
	}

	/**
	 * Sets the value of telefonoA.
	 *
	 * @param mixed $telefonoA the telefono
	 *
	 * @return self
	 */
	public function _setTelefonoA($telefonoA) {
		$this->telefonoA = $telefonoA;

		return $this;
	}

	/**
	 * Gets the value of fechaNac.
	 *
	 * @return mixed
	 */
	public function getFechaNac() {
		return $this->fechaNac;
	}

	/**
	 * Sets the value of fechaNac.
	 *
	 * @param mixed $fechaNac the fecha nac
	 *
	 * @return self
	 */
	public function _setFechaNac($fechaNac) {
		$this->fechaNac = $fechaNac;

		return $this;
	}

	/**
	 * Gets the value of corredor.
	 *
	 * @return mixed
	 */
	public function getCorredor() {
		return $this->corredor;
	}

	/**
	 * Sets the value of corredor.
	 *
	 * @param mixed $corredor the corredor
	 *
	 * @return self
	 */
	public function _setCorredor($corredor) {
		$this->corredor = $corredor;

		return $this;
	}

	/**
	 * Gets the value of intermediario.
	 *
	 * @return mixed
	 */
	public function getIntermediario() {
		return $this->intermediario;
	}

	/**
	 * Sets the value of intermediario.
	 *
	 * @param mixed $intermediario the intermediario
	 *
	 * @return self
	 */
	public function _setIntermediario($intermediario) {
		$this->intermediario = $intermediario;

		return $this;
	}

	/**
	 * Gets the value of clave.
	 *
	 * @return mixed
	 */
	public function getClave() {
		return $this->clave;
	}

	/**
	 * Sets the value of clave.
	 *
	 * @param mixed $clave the clave
	 *
	 * @return self
	 */
	public function _setClave($clave) {
		$this->clave = $clave;

		return $this;
	}

	/**
	 * Gets the value of idPregunta.
	 *
	 * @return mixed
	 */
	public function getIdPregunta() {
		return $this->idPregunta;
	}

	/**
	 * Sets the value of idPregunta.
	 *
	 * @param mixed $idPregunta the id pregunta
	 *
	 * @return self
	 */
	public function _setIdPregunta($idPregunta) {
		$this->idPregunta = $idPregunta;

		return $this;
	}

	/**
	 * Gets the value of login.
	 *
	 * @return mixed
	 */
	public function getLogin() {
		return $this->login;
	}

	/**
	 * Sets the value of login.
	 *
	 * @param mixed $login the login
	 *
	 * @return self
	 */
	public function _setLogin($login) {
		$this->login = $login;

		return $this;
	}

	/**
	 * Gets the value of actividad.
	 *
	 * @return mixed
	 */
	public function getActividad() {
		return $this->actividad;
	}

	/**
	 * Sets the value of actividad.
	 *
	 * @param mixed $actividad the actividad
	 *
	 * @return self
	 */
	public function _setActividad($actividad) {
		$this->actividad = $actividad;

		return $this;
	}

	/**
	 * Gets the value of respuesta.
	 *
	 * @return mixed
	 */
	public function getRespuesta() {
		return $this->respuesta;
	}

	/**
	 * Sets the value of respuesta.
	 *
	 * @param mixed $respuesta the respuesta
	 *
	 * @return self
	 */
	public function _setRespuesta($respuesta) {
		$this->respuesta = $respuesta;

		return $this;
	}

	/**
	 * Gets the value of insertar.
	 *
	 * @return mixed
	 */
	public function getInsertar() {
		return $this->insertar;
	}

	/**
	 * Sets the value of insertar.
	 *
	 * @param mixed $insertar the insertar
	 *
	 * @return self
	 */
	public function _setInsertar($insertar) {
		$this->insertar = $insertar;

		return $this;
	}

	/**
	 * Gets the value of modificar.
	 *
	 * @return mixed
	 */
	public function getModificar() {
		return $this->modificar;
	}

	/**
	 * Sets the value of modificar.
	 *
	 * @param mixed $modificar the modificar
	 *
	 * @return self
	 */
	public function _setModificar($modificar) {
		$this->modificar = $modificar;

		return $this;
	}

	/**
	 * Gets the value of consultar.
	 *
	 * @return mixed
	 */
	public function getConsultar() {
		return $this->consultar;
	}

	/**
	 * Sets the value of consultar.
	 *
	 * @param mixed $consultar the consultar
	 *
	 * @return self
	 */
	public function _setConsultar($consultar) {
		$this->consultar = $consultar;

		return $this;
	}

	/**
	 * Gets the value of eliminar.
	 *
	 * @return mixed
	 */
	public function getEliminar() {
		return $this->eliminar;
	}

	/**
	 * Sets the value of eliminar.
	 *
	 * @param mixed $eliminar the eliminar
	 *
	 * @return self
	 */
	public function _setEliminar($eliminar) {
		$this->eliminar = $eliminar;

		return $this;
	}

	/**
	 * Gets the value of idParentesco.
	 *
	 * @return mixed
	 */
	public function getIdParentesco() {
		return $this->idParentesco;
	}

	/**
	 * Sets the value of idParentesco.
	 *
	 * @param mixed $idParentesco the id parentesco
	 *
	 * @return self
	 */
	public function setIdParentesco($idParentesco) {
		$this->idParentesco = $idParentesco;

		return $this;
	}

	/**
	 * Gets the value of tomador.
	 *
	 * @return mixed
	 */
	public function getTomador() {
		return $this->tomador;
	}

	/**
	 * Sets the value of tomador.
	 *
	 * @param mixed $tomador the tomador
	 *
	 * @return self
	 */
	public function setTomador($tomador) {
		$this->tomador = $tomador;

		return $this;
	}
}
