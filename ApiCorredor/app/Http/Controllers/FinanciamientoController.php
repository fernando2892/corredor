<?php

namespace App\Http\Controllers;

use App\financiamiento;
use App\Http\Controllers\Controller;

class FinanciamientoController extends Controller {

	public function comboFinanciamiento() {
		$data = financiamiento::comboFinanciamiento();

		return response()->json($data); //
	}

	public function insertarFinanciamiento() {

		$financiamiento = new financiamiento();

		$financiamiento->setInicial($_GET['inicial']);
		$financiamiento->setCuotas($_GET['cuotas']);
		$data = financiamiento::insertarFinanciamiento($financiamiento);

		return response()->json($data); //
	}

}
