<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use  App\clientePoliza;

class ClientePolizaController extends Controller
{


	public function eliminarClientePoliza() {

		$data = clientePoliza::eliminarClientePoliza($_GET['idClientePoliza']);
		$data->delete();
		return response()->json($data);

	}

		public function subirArchivos() {
			echo $_FILES['file']["name"];

		/*if(isset($_FILES['file_array'])){
		    $name_array = $_FILES['file_array']['name'];
		    $tmp_name_array = $_FILES['file_array']['tmp_name'];
		    $type_array = $_FILES['file_array']['type'];
		    $size_array = $_FILES['file_array']['size'];
		    $error_array = $_FILES['file_array']['error'];
		    for($i = 0; $i < count($tmp_name_array); $i++){

		    	//echo $i;
		        if(move_uploaded_file($tmp_name_array[$i], "test_uploads/".$name_array[$i])){
		            echo $name_array[$i]." upload is complete<br>";
		        } else {
		            echo "move_uploaded_file function failed for ".$name_array[$i]."<br>";
		        }
		    }
		}else{
			echo "no";
		}			


//		return response()->json($data);*/

	}	
   

}
