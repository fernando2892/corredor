<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Mail;

class EmailController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function test() {

		Mail::send([], [], function ($message) {

			$message->to('fernandoescalona92@gmail.com')
				->subject('prueba')
				->setBody('<img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcRX3Wepp_YuzgwA49tGk-tfbgaRP8ZO12xew6C731ektDQyPR0B" alt="">', 'text/html');

		});

	}

}
