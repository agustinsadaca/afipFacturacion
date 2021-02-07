<?php

namespace App\Controllers;

class Inicio extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}
	public function error(){

		echo("hola");
	}
}
