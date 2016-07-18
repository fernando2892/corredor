<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class clientePoliza extends Model {
	//

	protected $table = "cliente_poliza";

	public $id;
	public $idUsuario;
	public $idPoliza;
	public $idParentesco;
	public $tomador;
	public $menorEdad;

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
	public function setId($id) {
		$this->id = $id;

		return $this;
	}

	/**
	 * Gets the value of idUsuario.
	 *
	 * @return mixed
	 */
	public function getIdUsuario() {
		return $this->idUsuario;
	}

	/**
	 * Sets the value of idUsuario.
	 *
	 * @param mixed $idUsuario the id usuario
	 *
	 * @return self
	 */
	public function setIdUsuario($idUsuario) {
		$this->idUsuario = $idUsuario;

		return $this;
	}

	/**
	 * Gets the value of idPoliza.
	 *
	 * @return mixed
	 */
	public function getIdPoliza() {
		return $this->idPoliza;
	}

	/**
	 * Sets the value of idPoliza.
	 *
	 * @param mixed $idPoliza the id poliza
	 *
	 * @return self
	 */
	public function setIdPoliza($idPoliza) {
		$this->idPoliza = $idPoliza;

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

	/**
	 * Gets the value of menorEdad.
	 *
	 * @return mixed
	 */
	public function getMenorEdad() {
		return $this->menorEdad;
	}

	/**
	 * Sets the value of menorEdad.
	 *
	 * @param mixed $menorEdad the menor edad
	 *
	 * @return self
	 */
	public function setMenorEdad($menorEdad) {
		$this->menorEdad = $menorEdad;

		return $this;
	}

	static public function insertarClientePoliza($clientePoliza) {

		$data = DB::table('cliente_poliza')->insertGetId([

			'id_poliza' => $clientePoliza->getIdPoliza(),
			'id_usuario' => $clientePoliza->getIdUsuario(),
			'id_parentesco' => $clientePoliza->getIdParentesco(),
			'tomador' => $clientePoliza->getTomador(),
			'menor_edad' => $clientePoliza->getMenorEdad(),
		]);

		return $data;
	}

	static public function ModificarClientePoliza($clientePoliza) {

		$data = DB::table('cliente_poliza')->where('id_poliza', $clientePoliza->getIdPoliza())
			->where('id_usuario', $clientePoliza->getIdUsuario())
			->update([

				'id_poliza' => $clientePoliza->getIdPoliza(),
				'id_usuario' => $clientePoliza->getIdUsuario(),
				'id_parentesco' => $clientePoliza->getIdParentesco(),
				'tomador' => $clientePoliza->getTomador(),
				'menor_edad' => $clientePoliza->getMenorEdad(),
			]);

		return $data;
	}

	static public function consultarClientePoliza($clientePoliza) {

		$data = DB::table('cliente_poliza')->where('cliente_poliza.id_poliza', '=', $clientePoliza->getIdPoliza())
			->where('cliente_poliza.id_usuario', '=', $clientePoliza->getIdUsuario())->get();
		return $data;
	}

	static public function consultarClientesPoliza($clientePoliza) {

		$data = DB::table('cliente_poliza')
			->join('usuarios', 'usuarios.id', '=', 'cliente_poliza.id_usuario')
			->join('parentesco', 'cliente_poliza.id_parentesco', '=', 'parentesco.id')
			->where('cliente_poliza.id_poliza', '=', $clientePoliza->getIdPoliza())
			->select('usuarios.*', 'cliente_poliza.id as cliPolId', 'cliente_poliza.id_parentesco as parentId', 'cliente_poliza.id_usuario as usuId', 'cliente_poliza.tomador', 'parentesco.descripcion as parentDes', 'cliente_poliza.menor_edad')
			->get();
		return $data;
	}

	static public function eliminarClientePoliza($id) {

		$clienteoliza= clientePoliza::find($id);

		return $clienteoliza;
	}	

}
