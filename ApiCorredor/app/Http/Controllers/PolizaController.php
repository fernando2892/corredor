<?php

namespace App\Http\Controllers;

use App\datosPoliza;
use App\Http\Controllers\Controller;
use App\poliza;
use App\reciboPoliza;

class PolizaController extends Controller {
	public function __construct() {
		$this->middleware('cors');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function insertarPoliza() {
		$poliza = new poliza();
		$datosPoliza = new datosPoliza();
		$reciboPoliza = new reciboPoliza();

		$poliza->setId($_GET["idPol"]);
		$poliza->setNumPoliza($_GET["numPol"]);
		$poliza->setIdEmpresa($_GET["idEmpresa"]);
		$poliza->setIdRamo($_GET["idRamo"]);
		$poliza->setAnulacion($_GET["anul"]);
		if (empty($_GET["fechaAnu"])) {
			$fechaAnul = NULL;
		} else {
			$fechaAnul = $_GET["fechaAnu"];
		}

		$poliza->setFechaAnulacion($fechaAnul);

		///////////////////////////////////////////////

		$datosPoliza->setFechaInicio($_GET["fechaIni"]);
		$datosPoliza->setFechaVigencia($_GET["fechaVig"]);
		$datosPoliza->setIdIntermediario($_GET["intermediario"]);
		if (empty($_GET["numFin"])) {
			$NumFinanciamiento = NULL;
		} else {
			$NumFinanciamiento = $_GET["numFin"];
		}
		$datosPoliza->setNumFinanciamiento($NumFinanciamiento);
		$datosPoliza->setIdTipoFin($_GET["idFin"]);

		///////////////////////////////////////////////

		$reciboPoliza->setPrima($_GET["prima"]);
		$reciboPoliza->setBono($_GET["bono"]);
		$reciboPoliza->setComision($_GET["comision"]);
		if (empty($_GET["fecha_cobro"])) {
			$fechaCobro = NULL;
		} else {
			$fechaCobro = $_GET["fecha_cobro"];
		}
		$reciboPoliza->setFechaCobro($fechaCobro);
		$reciboPoliza->setNumeroRecibo($_GET["num_recibo"]);

		//////////////////////////////////////////////
		$data = poliza::insertarPoliza1($poliza);

		if (empty($data)) {
			$data = null;
		} else {
			$datosPoliza->setIdPoliza($data);
			$data2 = datosPoliza::insertarPoliza2($datosPoliza);
			$reciboPoliza->setIdDatosPoliza($data2);
			$data3 = reciboPoliza::insertarPoliza3($reciboPoliza);
		}

		return response()->json($data);

	}

	public function modificarPoliza() {
		$poliza = new poliza();
		$datosPoliza = new datosPoliza();
		$reciboPoliza = new reciboPoliza();

		$poliza->setId($_GET["idPol"]);
		$poliza->setNumPoliza($_GET["numPol"]);
		$poliza->setIdEmpresa($_GET["idEmpresa"]);
		$poliza->setIdRamo($_GET["idRamo"]);
		$poliza->setAnulacion($_GET["anul"]);
		if (empty($_GET["fechaAnu"])) {
			$fechaAnul = 0;
		} else {
			$fechaAnul = $_GET["fechaAnu"];
		}

		$poliza->setFechaAnulacion($fechaAnul);
		///////////////////////////////////////////////

		$datosPoliza->setFechaInicio($_GET["fechaIni"]);
		$datosPoliza->setFechaVigencia($_GET["fechaVig"]);
		$datosPoliza->setIdIntermediario($_GET["intermediario"]);
		if (empty($_GET["numFin"])) {
			$NumFinanciamiento = NULL;
		} else {
			$NumFinanciamiento = $_GET["numFin"];
		}
		$datosPoliza->setNumFinanciamiento($NumFinanciamiento);
		$datosPoliza->setIdTipoFin($_GET["idFin"]);

		///////////////////////////////////////////////

		$reciboPoliza->setPrima($_GET["prima"]);
		$reciboPoliza->setBono($_GET["bono"]);
		$reciboPoliza->setComision($_GET["comision"]);
		if (empty($_GET["fecha_cobro"])) {
			$fechaCobro = NULL;
		} else {
			$fechaCobro = $_GET["fecha_cobro"];
		}
		$reciboPoliza->setFechaCobro($fechaCobro);
		if (empty($_GET["num_recibo"])) {
			$NumRecibo = NULL;
		} else {
			$NumRecibo = $_GET["num_recibo"];
		}
		$reciboPoliza->setNumeroRecibo($NumRecibo);

		//////////////////////////////////////////////

		$data = poliza::modificarPoliza1($poliza);
		echo $data;
		if ($data == false) {
			$data = "Ha ocurrido un error intente mas tarde";
		} else {
			$datosPoliza->setIdPoliza($_GET["idPol"]);
			$data2 = datosPoliza::modificarPoliza2($datosPoliza);
			$reciboPoliza->setIdDatosPoliza($_GET["idDatosPol"]);
			$reciboPoliza->setId($_GET["idReciboPol"]);
			$data3 = reciboPoliza::modificarPoliza3($reciboPoliza);
			$data = "Registro Exitoso";
		}

		return response()->json($data);

	}

	public function renovarPoliza() {
		$poliza = new poliza();
		$datosPoliza = new datosPoliza();
		$reciboPoliza = new reciboPoliza();

		$poliza->setId($_GET["idPol"]);
		$poliza->setNumPoliza($_GET["numPol"]);
		$poliza->setIdEmpresa($_GET["idEmpresa"]);
		$poliza->setIdRamo($_GET["idRamo"]);
		$poliza->setAnulacion($_GET["anul"]);
		if (empty($_GET["fechaAnu"])) {
			$fechaAnul = NULL;
		} else {
			$fechaAnul = $_GET["fechaAnu"];
		}

		$poliza->setFechaAnulacion($fechaAnul);

		///////////////////////////////////////////////

		$datosPoliza->setFechaInicio($_GET["fechaIni"]);
		$datosPoliza->setFechaVigencia($_GET["fechaVig"]);
		$datosPoliza->setIdIntermediario($_GET["intermediario"]);
		if (empty($_GET["numFin"])) {
			$NumFinanciamiento = NULL;
		} else {
			$NumFinanciamiento = $_GET["numFin"];
		}
		$datosPoliza->setNumFinanciamiento($NumFinanciamiento);
		$datosPoliza->setIdTipoFin($_GET["idFin"]);

		///////////////////////////////////////////////

		$reciboPoliza->setPrima($_GET["prima"]);
		$reciboPoliza->setBono($_GET["bono"]);
		$reciboPoliza->setComision($_GET["comision"]);
		if (empty($_GET["fecha_cobro"])) {
			$fechaCobro = NULL;
		} else {
			$fechaCobro = $_GET["fecha_cobro"];
		}
		$reciboPoliza->setFechaCobro($fechaCobro);
		if (empty($_GET["num_recibo"])) {
			$NumRecibo = NULL;
		} else {
			$NumRecibo = $_GET["num_recibo"];
		}
		$reciboPoliza->setNumeroRecibo($NumRecibo);

		//////////////////////////////////////////////

		$data = poliza::modificarPoliza1($poliza);

		if ($data == false) {
			$data = "Ha ocurrido un error intente mas tarde";
		} else {
			$datosPoliza->setIdPoliza($_GET["idPol"]);
			$datosPoliza->setId($_GET["idDatosPol"]);
			datosPoliza::modificarDatosPolReciente($datosPoliza);
			$data2 = datosPoliza::insertarPoliza2($datosPoliza);
			$reciboPoliza->setIdDatosPoliza($data2);
			$reciboPoliza->setId($_GET["idReciboPol"]);
			reciboPoliza::modificarRecibo($reciboPoliza);
			$data3 = reciboPoliza::insertarPoliza3($reciboPoliza);
			$data = "Registro Exitoso";
		}

		return response()->json($data);

	}

	public function consultarPoliza() {
		$poliza = new poliza();

		if (empty($_GET["idPol"]) || $_GET["idPol"]==0 ) {
			$poliza->setId(0);
		} else {
			$poliza->setId($_GET["idPol"]);
		}

		if (empty($_GET["numPol"]) || $_GET["numPol"]==0 ) {
			$poliza->setNumPoliza(0);
		} else {
			$poliza->setNumPoliza($_GET["numPol"]);
		}

		$data = poliza::consultaPoliza1($poliza);

		return response()->json($data);

	}

	public function cargarArchivos() {

		$files = $_FILES['file_load']['tmp_name'];
		//$nombre=$_FILES['name'];

		move_uploaded_file($_FILES['file_load']['tmp_name'], base_path() . '/public/archivos/' . $_FILES['file_load']['name']);

	}

	public function consultaPolizaFiltrosAll() {
		$data = poliza::consultaPolizaFiltrosAll();
		return response()->json($data);
	}

	public function consultaPolizaFiltros() {


		if($_GET['queryFechaIniHasta']==""){
			$fechaQueryHasta='now()';
		}else{
			$fechaQueryHasta='"'.$_GET['queryFechaIniHasta'].'"';
		}

		$queryNp=($_GET['queryNp']!="")?'AND poliza.numero_poliza LIKE "'.$_GET['queryNp'].'%"':'';
		$queryNr=($_GET['queryNr']!="")?'AND recibo_poliza.numero_recibo LIKE "'.$_GET['queryNr'].'%"':'';
		$queryNf=($_GET['queryNf']!="")?'AND datos_poliza.numero_financiamiento LIKE "'.$_GET['queryNf'].'%"':'';
		$queryFechaIni=($_GET['queryFechaIni']!="")?'AND datos_poliza.fecha_inicio BETWEEN '.'"'.$_GET['queryFechaIni'].'" AND '.$fechaQueryHasta:'';



		$queryP='select poliza.numero_poliza, aseguradoras.descripcion as aseguradora, ramo.descripcion as ramo, poliza.anulada,
				poliza.fecha_anulacion, datos_poliza.fecha_inicio, datos_poliza.fecha_vigencia, usuarios.nombre,
				usuarios.apellido, datos_poliza.numero_financiamiento, financiamiento.inicial, financiamiento.cuotas, recibo_poliza.monto_prima as prima,
				recibo_poliza.comision, recibo_poliza.bono,recibo_poliza.numero_recibo, poliza.id from poliza 
		INNER JOIN datos_poliza ON poliza.id=datos_poliza.id_poliza
		LEFT JOIN financiamiento ON datos_poliza.id_tipo_financiamiento=financiamiento.id
		INNER JOIN aseguradoras ON poliza.id_empresa=aseguradoras.id
		INNER JOIN ramo ON poliza.id_ramo=ramo.id
		INNER JOIN usuarios ON datos_poliza.id_intermediario=usuarios.id
		INNER JOIN recibo_poliza ON datos_poliza.id=recibo_poliza.id_datos_poliza
		WHERE datos_poliza.reciente="Y" AND recibo_poliza.reciente="Y"';
		
		$query=$queryP." ".$queryNp." ".$queryNr." ".$queryNf." ".$queryFechaIni." order By datos_poliza.fecha_inicio desc ";

		//echo $query;

		$data = poliza::consultaPolizaFiltros($query);
		return response()->json($data);
	}

	public function agregarRecibo() {

		$reciboPoliza = new reciboPoliza();

		$reciboPoliza->setPrima($_GET["prima"]);
		$reciboPoliza->setBono($_GET["bono"]);
		$reciboPoliza->setComision($_GET["comision"]);
		if (empty($_GET["fecha_cobro"])) {
			$fechaCobro = NULL;
		} else {
			$fechaCobro = $_GET["fecha_cobro"];
		}
		$reciboPoliza->setFechaCobro($fechaCobro);
		$reciboPoliza->setNumeroRecibo($_GET["num_recibo"]);
		$reciboPoliza->setIdDatosPoliza($_GET["idDatosPol"]);
		$reciboPoliza->setId($_GET["idReciboPol"]);
		reciboPoliza::modificarRecibo($reciboPoliza);
		$data = reciboPoliza::insertarPoliza3($reciboPoliza);
		if ($data == false) {
			$data = "Ha ocurrido un error intente mas tarde";
		} else {
			$data = "Registro Exitoso";
		}
		return response()->json($data);

	}

	public function compararFecha() {
		$fechaVigencia = $_GET['fechaVig'];
		$fecha = date("Y-m-d");
		$data = ($fecha >= $fechaVigencia);
		return response()->json($data);
	}

	public function consultaPolizaHistorico() {
		$poliza = new poliza();
		$poliza->setId($_GET['idPol']);
		$data = poliza::consultaPolizaHistorico($poliza);
		return response()->json($data);
	}

	public function consultaReciboHistorico() {
		$reciboPoliza = new reciboPoliza();
		$reciboPoliza->setIdDatosPoliza($_GET['idDatosPol']);
		$data = reciboPoliza::consultaReciboHistorico($reciboPoliza);
		return response()->json($data);
	}

	public function consultaDatosReporte() {


		if($_GET['queryFechaIniHasta']==""){
			$fechaQueryHasta='now()';
		}else{
			$fechaQueryHasta='"'.$_GET['queryFechaIniHasta'].'"';
		}

		//$queryNp=($_GET['queryNp']!="")?'AND poliza.numero_poliza LIKE "'.$_GET['queryNp'].'%"':'';
		//$queryNr=($_GET['queryNr']!="")?'AND recibo_poliza.numero_recibo LIKE "'.$_GET['queryNr'].'%"':'';
		//$queryNf=($_GET['queryNf']!="")?'AND datos_poliza.numero_financiamiento LIKE "'.$_GET['queryNf'].'%"':'';
		$queryFechaIni=($_GET['queryFechaIni']!="")?'AND datos_poliza.fecha_vigencia BETWEEN '.'"'.$_GET['queryFechaIni'].'" AND '.$fechaQueryHasta:'';


		$queryP='select poliza.numero_poliza, aseguradoras.descripcion as aseguradora, ramo.descripcion as ramo, poliza.anulada,
				poliza.fecha_anulacion, datos_poliza.fecha_inicio, datos_poliza.fecha_vigencia, usuarios.nombre,
				usuarios.apellido, datos_poliza.numero_financiamiento, financiamiento.inicial, financiamiento.cuotas, recibo_poliza.monto_prima as prima,
				recibo_poliza.comision, recibo_poliza.bono,recibo_poliza.numero_recibo, poliza.id from poliza 
		INNER JOIN datos_poliza ON poliza.id=datos_poliza.id_poliza
		LEFT JOIN financiamiento ON datos_poliza.id_tipo_financiamiento=financiamiento.id
		INNER JOIN aseguradoras ON poliza.id_empresa=aseguradoras.id
		INNER JOIN ramo ON poliza.id_ramo=ramo.id
		INNER JOIN usuarios ON datos_poliza.id_intermediario=usuarios.id
		INNER JOIN recibo_poliza ON datos_poliza.id=recibo_poliza.id_datos_poliza
		WHERE datos_poliza.reciente="Y" AND recibo_poliza.reciente="Y"';
		
		$query=$queryP." ".$queryFechaIni;//." order By datos_poliza.fecha_inicio desc ";

		//echo $query;

		$data = poliza::consultaPolizaFiltros($query);
		return response()->json($data);
	}
}
