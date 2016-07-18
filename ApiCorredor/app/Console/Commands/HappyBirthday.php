<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;

class HappyBirthday extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'email:EnviarEmail';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		Mail::send([], [], function ($message) {

			$message->to('fernandoescalona92@gmail.com')
				->subject('prueba')
				->setBody('<img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcRX3Wepp_YuzgwA49tGk-tfbgaRP8ZO12xew6C731ektDQyPR0B" alt="">', 'text/html');

		});
	}
}
