<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class financiamiento extends Model {
	//

	protected $table = 'financiamiento';

	public $id;
	public $inicial;
	public $cuotas;

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
	 * Gets the value of inicial.
	 *
	 * @return mixed
	 */
	public function getInicial() {
		return $this->inicial;
	}

	/**
	 * Sets the value of inicial.
	 *
	 * @param mixed $inicial the inicial
	 *
	 * @return self
	 */
	public function setInicial($inicial) {
		$this->inicial = $inicial;

		return $this;
	}

	/**
	 * Gets the value of cuotas.
	 *
	 * @return mixed
	 */
	public function getCuotas() {
		return $this->cuotas;
	}

	/**
	 * Sets the value of cuotas.
	 *
	 * @param mixed $cuotas the cuotas
	 *
	 * @return self
	 */
	public function setCuotas($cuotas) {
		$this->cuotas = $cuotas;

		return $this;
	}

	static public function comboFinanciamiento() {

		$data = financiamiento::all();
		return $data;
	}

	static public function insertarFinanciamiento($financiamiento) {
		$data = DB::table('financiamiento')->insert([

			'inicial' => $financiamiento->getInicial(),
			'cuotas' => $financiamiento->getCuotas(),

		]);
		return $data;
	}
}
