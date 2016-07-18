<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ramo;

class RamoController extends Controller
{
    public function __construc(){

        $this->middleware('corse');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function comboRamo()
    {
	   $data = ramo::comboRamo();

       return  response()->json($data);  //
    }

}
