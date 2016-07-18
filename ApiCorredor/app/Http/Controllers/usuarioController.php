<?php

namespace App\Http\Controllers;

use App\clientePoliza;
use App\Http\Controllers\Controller;
use App\usuario;
use Session;

class usuarioController extends Controller {

	public function __construct() {
		$this->middleware('cors');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function validaLogin() {
		$usuario = new usuario();
		$salt = '$2a$07$usesomadasdsadsadsadasdasdasdsadesillystringfors';

		$clave = crypt($_GET['clave'], $salt);

		$usuario->_setClave($clave);
		if (is_numeric($_GET['correo'])) {
			$usuario->_setCi($_GET['correo']);
			$usuario->_setCorreo('""');
		} else {
			$usuario->_setCorreo($_GET['correo']);
		}

		$data = usuario::validarLogin($usuario);

		if (empty($data)) {
			$data = null;
		}

		$this->crearSesion($data);

		return response()->json($data);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function crearSesion($data) {
		//
		Session::put('key', $data);
		$varSesion = Session::get('key');

	}

	public function cerrarSesion() {
		//
		Session::flush();

	}

	public function validarSesion() {
		//
		$sesion = session('key');
		return response()->json($sesion);

	}

	public function consultarCliente() {

		$usuario = new usuario();
		$usuario->_setCi($_GET['ci']);
		$idPol = $_GET['idPol'];
		$data = usuario::consultarCliente($usuario, $idPol);
		return response()->json($data);

	}

	public function consultarClienteDatos() {

		$usuario = new usuario();
		$usuario->_setCi($_GET['ci']);
		$menor = $_GET['menor'];
		$cont = 0;
		if ($menor == true) {

			do {
				$cont++;
				$usuario->_setCi($_GET['ci'] . $cont);
				$data = usuario::consultarClienteDatos($usuario);
				if (empty($data)) {
					$_GET['menor'] = false;
					$data = $_GET['ci'] . $cont;
					return $data;
				}
			} while ($_GET['menor'] == true);
		} else {

			$data = usuario::consultarClienteDatos($usuario);
			return response()->json($data);
		}

	}

	public function insertarModificarTomador() {

		$salt = '$2a$07$usesomadasdsadsadsadasdasdasdsadesillystringfors';
		$correoUsuario = null;
		$clave = crypt($_GET['ci'], $salt);
		$clientePoliza = new clientePoliza();
		$usuario = new usuario();
		$usuario->_setCi($_GET['ci']);
		$usuario->_setNombre($_GET['nombre']);
		$usuario->_setApellido($_GET['apellido']);
		$usuario->_setSexo($_GET['sexo']);
		$usuario->_setDireccion($_GET['direccion']);

		if (empty($_GET['correo'])) {
			$correoUsuario = null;
		} else {
			$correoUsuario = $_GET['correo'];
		}

		$usuario->_setCorreo($correoUsuario);
		$usuario->_setTelefono($_GET['telefono']);
		$usuario->_setTelefonoA($_GET['telefonoA']);
		$usuario->_setFechaNac($_GET['fechaNac']);
		$usuario->_setClave($clave);

		$clientePoliza->setIdParentesco($_GET['idParent']);
		$clientePoliza->setTomador($_GET['tomador']);
		$clientePoliza->setIdPoliza($_GET['idPol']);
		$clientePoliza->setMenorEdad($_GET['menor']);

		if ($_GET['id'] == 0) {

			$data = usuario::insertarTomador($usuario);
			$clientePoliza->setIdUsuario($data);

			if ($_GET['idParent'] != 0) {

				$dataCP = clientePoliza::insertarClientePoliza($clientePoliza);
			}

		} else {

			$usuario->_setId($_GET['id']);
			$clientePoliza->setIdUsuario($_GET['id']);
			$data = usuario::modificarTomador($usuario);

			if ($_GET['idParent'] != 0) {

				$dataCPE = clientePoliza::consultarClientePoliza($clientePoliza);

				if (empty($dataCPE)) {

					$dataCP = clientePoliza::insertarClientePoliza($clientePoliza);
				} else {

					$dataCP = clientePoliza::modificarClientePoliza($clientePoliza);
				}

			}

		}

		if ($data != 0) {
			$data = "Registro Exitoso";
		} else {
			$data = "Ha ocurrido un error intente mas tarde";
		}
		return response()->json($data);

	}

	public function consultarClientePoliza() {
//consulta si existe ya registrado para una poliza

		$clientePoliza = new clientePoliza();
		$clientePoliza->setIdPoliza($_GET['idPoliza']);
		$clientePoliza->setIdUsuario($_GET['idUsuario']);
		$data = clientePoliza::consultarClientePoliza($clientePoliza);
		return response()->json($data);

	}

	public function consultarClientesPoliza() {

		$clientePoliza = new clientePoliza();
		$clientePoliza->setIdPoliza($_GET['idPoliza']);
		$data = clientePoliza::consultarClientesPoliza($clientePoliza);
		return response()->json($data);

	}

	public function comboIntermediario() {

		$usuario = new usuario;
		$data = usuario::comboIntermediario();
		return response()->json($data);

	}

	public function montoNegocioIntermediario() {

		$usuario = new usuario;
		$usuario->_setId($_GET['idInter']);
		$data = usuario::montoNegocioIntermediario($usuario);
		return response()->json($data);

	}

}
