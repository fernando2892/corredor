<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class reciboPoliza extends Model {
	//

	public $id;
	public $idDatosPoliza;
	public $prima;
	public $comision;
	public $bono;
	public $fechaCobro;
	public $numeroRecibo;
	public $reciente;

	protected $table = 'recibo_poliza';

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
	 * Gets the value of idDatosPoliza.
	 *
	 * @return mixed
	 */
	public function getIdDatosPoliza() {
		return $this->idDatosPoliza;
	}

	/**
	 * Sets the value of idDatosPoliza.
	 *
	 * @param mixed $idDatosPoliza the id datos poliza
	 *
	 * @return self
	 */
	public function setIdDatosPoliza($idDatosPoliza) {
		$this->idDatosPoliza = $idDatosPoliza;

		return $this;
	}

	/**
	 * Gets the value of prima.
	 *
	 * @return mixed
	 */
	public function getPrima() {
		return $this->prima;
	}

	/**
	 * Sets the value of prima.
	 *
	 * @param mixed $prima the prima
	 *
	 * @return self
	 */
	public function setPrima($prima) {
		$this->prima = $prima;

		return $this;
	}

	/**
	 * Gets the value of comision.
	 *
	 * @return mixed
	 */
	public function getComision() {
		return $this->comision;
	}

	/**
	 * Sets the value of comision.
	 *
	 * @param mixed $comision the comision
	 *
	 * @return self
	 */
	public function setComision($comision) {
		$this->comision = $comision;

		return $this;
	}

	/**
	 * Gets the value of bono.
	 *
	 * @return mixed
	 */
	public function getBono() {
		return $this->bono;
	}

	/**
	 * Sets the value of bono.
	 *
	 * @param mixed $bono the bono
	 *
	 * @return self
	 */
	public function setBono($bono) {
		$this->bono = $bono;

		return $this;
	}

	/**
	 * Gets the value of fechaCobro.
	 *
	 * @return mixed
	 */
	public function getFechaCobro() {
		return $this->fechaCobro;
	}

	/**
	 * Sets the value of fechaCobro.
	 *
	 * @param mixed $fechaCobro the fecha cobro
	 *
	 * @return self
	 */
	public function setFechaCobro($fechaCobro) {
		$this->fechaCobro = $fechaCobro;

		return $this;
	}

	/**
	 * Gets the value of numeroRecibo.
	 *
	 * @return mixed
	 */
	public function getNumeroRecibo() {
		return $this->numeroRecibo;
	}

	/**
	 * Sets the value of numeroRecibo.
	 *
	 * @param mixed $numeroRecibo the numero recibo
	 *
	 * @return self
	 */
	public function setNumeroRecibo($numeroRecibo) {
		$this->numeroRecibo = $numeroRecibo;

		return $this;
	}

	/**
	 * Gets the value of reciente.
	 *
	 * @return mixed
	 */
	public function getReciente() {
		return $this->reciente;
	}

	/**
	 * Sets the value of reciente.
	 *
	 * @param mixed $reciente the reciente
	 *
	 * @return self
	 */
	public function setReciente($reciente) {
		$this->reciente = $reciente;

		return $this;
	}

	static public function insertarPoliza3($reciboPoliza) {

		$data = DB::table('recibo_poliza')->insert([

			'id_datos_poliza' => $reciboPoliza->getidDatosPoliza(),
			'monto_prima' => $reciboPoliza->getPrima(),
			'comision' => $reciboPoliza->getComision(),
			'bono' => $reciboPoliza->getBono(),
			'fecha_cobro' => $reciboPoliza->getFechaCobro(),
			'numero_recibo' => $reciboPoliza->getNumeroRecibo(),
			'reciente' => 'Y',

		]);

		return $data;
	}

	static public function modificarPoliza3($reciboPoliza) {

		$data = DB::table('recibo_poliza')->where('id_datos_poliza', $reciboPoliza->getidDatosPoliza())
			->where('id', $reciboPoliza->getId())
			->update([

				'id_datos_poliza' => $reciboPoliza->getidDatosPoliza(),
				'monto_prima' => $reciboPoliza->getPrima(),
				'comision' => $reciboPoliza->getComision(),
				'bono' => $reciboPoliza->getBono(),
				'fecha_cobro' => $reciboPoliza->getFechaCobro(),
				'numero_recibo' => $reciboPoliza->getNumeroRecibo(),
			]);

		return $data;
	}

	static public function modificarRecibo($reciboPoliza) {

		$data = DB::table('recibo_poliza')->where('id', $reciboPoliza->getId())
			->where('id', $reciboPoliza->getId())
			->update([
				'reciente' => 'N',
			]);

		return $data;
	}

	static public function consultaReciboHistorico($reciboPoliza) {

		$data = DB::table('recibo_poliza')
			->where('recibo_poliza.reciente', 'N')
			->where('recibo_poliza.id_datos_poliza', $reciboPoliza->getIdDatosPoliza())
			->get();

		return $data;
	}

}
