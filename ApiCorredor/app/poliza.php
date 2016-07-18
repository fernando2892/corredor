<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class poliza extends Model {
	//

	public $id;
	public $numPoliza;
	public $idEmpresa;
	public $idRamo;
	public $fechaCreacion;
	public $fechaInicio;
	public $anulacion;
	public $fechaAnulacion;

	protected $table = "poliza";

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
	 * Gets the value of numPoliza.
	 *
	 * @return mixed
	 */
	public function getNumPoliza() {
		return $this->numPoliza;
	}

	/**
	 * Sets the value of numPoliza.
	 *
	 * @param mixed $numPoliza the num poliza
	 *
	 * @return self
	 */
	public function setNumPoliza($numPoliza) {
		$this->numPoliza = $numPoliza;

		return $this;
	}

	/**
	 * Gets the value of idEmpresa.
	 *
	 * @return mixed
	 */
	public function getIdEmpresa() {
		return $this->idEmpresa;
	}

	/**
	 * Sets the value of idEmpresa.
	 *
	 * @param mixed $idEmpresa the id empresa
	 *
	 * @return self
	 */
	public function setIdEmpresa($idEmpresa) {
		$this->idEmpresa = $idEmpresa;

		return $this;
	}

	/**
	 * Gets the value of idRamo.
	 *
	 * @return mixed
	 */
	public function getIdRamo() {
		return $this->idRamo;
	}

	/**
	 * Sets the value of idRamo.
	 *
	 * @param mixed $idRamo the id ramo
	 *
	 * @return self
	 */
	public function setIdRamo($idRamo) {
		$this->idRamo = $idRamo;

		return $this;
	}

	/**
	 * Gets the value of fechaCreacion.
	 *
	 * @return mixed
	 */
	public function getFechaCreacion() {
		return $this->fechaCreacion;
	}

	/**
	 * Sets the value of fechaCreacion.
	 *
	 * @param mixed $fechaCreacion the fecha creacion
	 *
	 * @return self
	 */
	public function setFechaCreacion($fechaCreacion) {
		$this->fechaCreacion = $fechaCreacion;

		return $this;
	}

	/**
	 * Gets the value of anulacion.
	 *
	 * @return mixed
	 */
	public function getAnulacion() {
		return $this->anulacion;
	}

	/**
	 * Sets the value of anulacion.
	 *
	 * @param mixed $anulacion the anulacion
	 *
	 * @return self
	 */
	public function setAnulacion($anulacion) {
		$this->anulacion = $anulacion;

		return $this;
	}

	/**
	 * Gets the value of fechaAnulacion.
	 *
	 * @return mixed
	 */
	public function getFechaAnulacion() {
		return $this->fechaAnulacion;
	}

	/**
	 * Sets the value of fechaAnulacion.
	 *
	 * @param mixed $fechaAnulacion the fecha anulacion
	 *
	 * @return self
	 */
	public function setFechaAnulacion($fechaAnulacion) {
		$this->fechaAnulacion = $fechaAnulacion;

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

	static public function insertarPoliza1($poliza) {

		$data = DB::table('poliza')->insertGetId([

			'numero_poliza' => $poliza->getNumPoliza(),
			'id_empresa' => $poliza->getIdEmpresa(),
			'id_ramo' => $poliza->getIdRamo(),
			'anulada' => $poliza->getAnulacion(),
			'fecha_anulacion' => $poliza->getFechaAnulacion(),
		]);

		return $data;
	}

	static public function modificarPoliza1($poliza) {
		echo $poliza->getFechaAnulacion();
		$data = DB::table('poliza')->where('id', $poliza->getId())->update([

			'numero_poliza' => $poliza->getNumPoliza(),
			'id_empresa' => $poliza->getIdEmpresa(),
			'id_ramo' => $poliza->getIdRamo(),
			'anulada' => $poliza->getAnulacion(),
			'fecha_anulacion' => $poliza->getFechaAnulacion(),
		]);

		return $data;
	}

	static public function consultaPoliza1($poliza) {

		$data = DB::table('poliza')
			->join('datos_poliza', 'poliza.id', '=', 'datos_poliza.id_poliza')
			->join('recibo_poliza', 'datos_poliza.id', '=', 'recibo_poliza.id_datos_poliza')
			->join('usuarios', 'usuarios.id', '=', 'datos_poliza.id_intermediario')
			->where('datos_poliza.reciente', 'Y')
			->where('recibo_poliza.reciente', 'Y')
			->where('poliza.id', $poliza->getId())->orWhere('poliza.numero_poliza', $poliza->getNumPoliza())
			->select('poliza.*', 'datos_poliza.*', 'recibo_poliza.*', 'usuarios.porcentaje_negocio', 'datos_poliza.id as id_datosPol', 'recibo_poliza.id as id_reciboPol')
			->get();

		return $data;

	}

	static public function consultaPolizaFiltrosAll() {

		$data = DB::table('poliza')
			->join('datos_poliza', 'poliza.id', '=', 'datos_poliza.id_poliza')
			->leftjoin('financiamiento', 'datos_poliza.id_tipo_financiamiento', '=', 'financiamiento.id')
			->join('aseguradoras', 'poliza.id_empresa', '=', 'aseguradoras.id')
			->join('ramo', 'poliza.id_ramo', '=', 'ramo.id')
			->join('usuarios', 'datos_poliza.id_intermediario', '=', 'usuarios.id')
			->join('recibo_poliza', 'datos_poliza.id', '=', 'recibo_poliza.id_datos_poliza')
			->where('datos_poliza.reciente', 'Y')
			->where('recibo_poliza.reciente', 'Y')
			->select('poliza.numero_poliza', 'aseguradoras.descripcion as aseguradora', 'ramo.descripcion as ramo', 'poliza.anulada',
				'poliza.fecha_anulacion', 'datos_poliza.fecha_inicio', 'datos_poliza.fecha_vigencia', 'usuarios.nombre',
				'usuarios.apellido', 'datos_poliza.numero_financiamiento', 'financiamiento.inicial', 'financiamiento.cuotas', 'recibo_poliza.monto_prima as prima',
				'recibo_poliza.comision', 'recibo_poliza.bono', 'poliza.id')
			->orderBy('datos_poliza.fecha_inicio', 'desc')

			->get();

		return $data;

	}

	static public function consultaPolizaHistorico($poliza) {

		$data = DB::table('poliza')
			->join('datos_poliza', 'poliza.id', '=', 'datos_poliza.id_poliza')
			->leftjoin('financiamiento', 'datos_poliza.id_tipo_financiamiento', '=', 'financiamiento.id')
			->join('aseguradoras', 'poliza.id_empresa', '=', 'aseguradoras.id')
			->join('ramo', 'poliza.id_ramo', '=', 'ramo.id')
			->join('usuarios', 'datos_poliza.id_intermediario', '=', 'usuarios.id')
			->join('recibo_poliza', 'datos_poliza.id', '=', 'recibo_poliza.id_datos_poliza')
			->where('datos_poliza.reciente', 'N')
			->where('recibo_poliza.reciente', 'N')
			->where('poliza.id', $poliza->getId())
			->select('poliza.numero_poliza', 'aseguradoras.descripcion as aseguradora', 'ramo.descripcion as ramo', 'poliza.anulada',
				'poliza.fecha_anulacion', 'datos_poliza.fecha_inicio', 'datos_poliza.fecha_vigencia', 'usuarios.nombre',
				'usuarios.apellido', 'datos_poliza.numero_financiamiento', 'financiamiento.inicial', 'financiamiento.cuotas', 'recibo_poliza.monto_prima as prima',
				'recibo_poliza.comision', 'recibo_poliza.bono', 'poliza.id')

			->get();

		return $data;

	}

	static public function consultaPolizaFiltros($polizaQuery) {

		$data = DB::select($polizaQuery);

		return $data;

	}

	static public function consultaDatosReporte($polizaQuery) {

				$data = DB::select($polizaQuery);

				return $data;

	}

}
