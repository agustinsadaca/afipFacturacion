<?php

namespace App\Controllers;

use App\Libraries\GroceryCrud;
use App\Libraries\MailChimp\MailChimpAPI;
use App\Models\LoginModel;

class Login extends AdminLayout
{
	public function auth(){

        $data = array();

        $data['view'] = 'login.php';
        
        return $this->render($data);

    }

    public function index(){

        return $this->auth();

    }
	public function salir()
	{
		session()->destroy();

		$data = array();
		$data['view'] = 'login.php';
		
		return $this->render($data);
	}
    
	
	public function validatelogin(){
		
		
		$loginModel = new LoginModel();
		

        $usuario = $loginModel->getUser($_POST['username'], $_POST['password']);
		
		try {
			
			if($usuario['username'] !== null){
			
				session()->set('userID', $usuario['id']);
				
				// $data = array();
				// $data['view'] = 'blank';
				$data = array();
	
				$data['view'] = 'inicio.php';
				
				return $this->render($data);
			}
			else
			{
				$error='usuario o contraseña incorrecta';
				session()->destroy();
	
							$data = array();
							$data['errors'] = $errors;
							$data['view'] = 'login.php';
							
							return $this->render($data);
			}
		} catch (\Throwable $th) {
			$error='usuario o contraseña incorrecta';
			$errores = array();
			array_push($errores,$error);
			// session()->destroy();
	
			$data = array();
			$data['errors'] = $errores;
			$data['view'] = 'login.php';
			
			return $this->render($data);
		}
	
	}

	public function inicio()
	{
		$data = array();

		$data['view'] = 'inicio.php';
		
		return $this->render($data);
	
	}

}
