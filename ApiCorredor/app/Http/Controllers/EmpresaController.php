<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\empresa;

class EmpresaController extends Controller
{
        public function comboEmpresa()
    {

        $data=empresa::comboEmpresa();
        return  response()->json($data);

    }
}
