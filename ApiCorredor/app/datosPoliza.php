<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class datosPoliza extends Model {
	//

	public $id;
	public $idPoliza;
	public $fechaInicio;
	public $fechaVigencia;
	public $idIntermediario;
	public $numFinanciamiento;
	public $idTipoFin;

	protected $table = "datos_poliza";

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
	 * Gets the value of fechaInicio.
	 *
	 * @return mixed
	 */
	public function getFechaInicio() {
		return $this->fechaInicio;
	}

	/**
	 * Sets the value of fechaInicio.
	 *
	 * @param mixed $fechaInicio the fecha inicio
	 *
	 * @return self
	 */
	public function setFechaInicio($fechaInicio) {
		$this->fechaInicio = $fechaInicio;

		return $this;
	}

	/**
	 * Gets the value of fechaVigencia.
	 *
	 * @return mixed
	 */
	public function getFechaVigencia() {
		return $this->fechaVigencia;
	}

	/**
	 * Sets the value of fechaVigencia.
	 *
	 * @param mixed $fechaVigencia the fecha vigencia
	 *
	 * @return self
	 */
	public function setFechaVigencia($fechaVigencia) {
		$this->fechaVigencia = $fechaVigencia;

		return $this;
	}

	/**
	 * Gets the value of idIntermediario.
	 *
	 * @return mixed
	 */
	public function getIdIntermediario() {
		return $this->idIntermediario;
	}

	/**
	 * Sets the value of idIntermediario.
	 *
	 * @param mixed $idIntermediario the id intermediario
	 *
	 * @return self
	 */
	public function setIdIntermediario($idIntermediario) {
		$this->idIntermediario = $idIntermediario;

		return $this;
	}

	/**
	 * Gets the value of numFinanciamiento.
	 *
	 * @return mixed
	 */
	public function getNumFinanciamiento() {
		return $this->numFinanciamiento;
	}

	/**
	 * Sets the value of numFinanciamiento.
	 *
	 * @param mixed $numFinanciamiento the num financiamiento
	 *
	 * @return self
	 */
	public function setNumFinanciamiento($numFinanciamiento) {
		$this->numFinanciamiento = $numFinanciamiento;

		return $this;
	}

	/**
	 * Gets the value of idTipoFin.
	 *
	 * @return mixed
	 */
	public function getIdTipoFin() {
		return $this->idTipoFin;
	}

	/**
	 * Sets the value of idTipoFin.
	 *
	 * @param mixed $idTipoFin the id tipo fin
	 *
	 * @return self
	 */
	public function setIdTipoFin($idTipoFin) {
		$this->idTipoFin = $idTipoFin;

		return $this;
	}

	static public function insertarPoliza2($poliza) {

		$data = DB::table('datos_poliza')->insertGetId([

			'id_poliza' => $poliza->getIdPoliza(),
			'fecha_inicio' => $poliza->getFechaInicio(),
			'fecha_vigencia' => $poliza->getFechaVigencia(),
			'id_intermediario' => $poliza->getIdIntermediario(),
			'numero_financiamiento' => $poliza->getNumFinanciamiento(),
			'id_tipo_financiamiento' => $poliza->getIdTipoFin(),
			'reciente' => true,
		]);

		return $data;
	}

	static public function modificarPoliza2($poliza) {

		$data = DB::table('datos_poliza')->where('id_poliza', $poliza->getIdPoliza())
			->where('reciente', true)
			->update([

				'id_poliza' => $poliza->getIdPoliza(),
				'fecha_inicio' => $poliza->getFechaInicio(),
				'fecha_vigencia' => $poliza->getFechaVigencia(),
				'id_intermediario' => $poliza->getIdIntermediario(),
				'numero_financiamiento' => $poliza->getNumFinanciamiento(),
				'id_tipo_financiamiento' => $poliza->getIdTipoFin(),
			]);

		return $data;
	}

	static public function modificarDatosPolReciente($poliza) {

		$data = DB::table('datos_poliza')->where('id', $poliza->getId())
			->where('id', $poliza->getId())
			->update([
				'reciente' => false,
			]);

		return $data;
	}
}
