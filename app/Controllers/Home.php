<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}
	public function error(){

		return view('errors/cli/error_404');

	}
}
