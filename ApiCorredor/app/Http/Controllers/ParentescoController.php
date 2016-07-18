<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\parentesco;

class ParentescoController extends Controller
{
        public function comboParentesco()
    {
        $data=parentesco::comboParentesco();
        return  response()->json($data);

    }
}
