<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class UtilidadesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function fechaVigencia() // funcion que suma fecha usada para años biciestos
	{

		$fecha = $_GET['fecha'];
		$nuevafecha = strtotime('+365 day', strtotime($fecha));
		$nuevafecha = date('Y-m-d', $nuevafecha);
		return $nuevafecha;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function modificarFechaVista() /// modifica fecha a dia mes año
	{
		$fecha = $_GET['fecha'];
		$fecha = strtotime($fecha);
		$nuevafecha = date('d-m-Y', $fecha);
		return response()->json($nuevafecha);
	}

	public function modificarFechaBd() /// modifica fecha a dia mes año
	{
		$fecha = $_GET['fecha'];
		$fecha = strtotime($fecha);
		$nuevafecha = date('Y-m-d', $fecha);
		return response()->json($nuevafecha);
	}

}
