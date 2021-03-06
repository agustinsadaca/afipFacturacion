<?php 

namespace App\Controllers;

class AdminLayout extends BaseController {
	
	public function __construct(){
		
		if(
			(strpos($_SERVER['REQUEST_URI'], 'login/auth') === false) and 
			(strpos($_SERVER['REQUEST_URI'], 'login/validateLogin') === false) 
		)
		{
			if(session()->get('userID') == null)
			{
				header('Location: '. base_url().'/login/auth'); 
			}
		}
		
 
	}

	public function render($data){
		
		if(!isset($data['errors']))
		{
			$data['errors'] = array();
		}
	
		if(!isset($data['title'])) $data['title'] = 'Puertas Azules';

		if(isset($data['grocery']))
		{
			if(!isset($data['view'])) $data['view'] = 'default';

			// $data['grocery']->unsetJquery();
			
			// // para sacar para todos los abm el read
			// $data['grocery']->unsetRead();

			try{
	 
				$data = array_merge($data, (array)$data['grocery']->render() );

			} catch(Exception $e) {
				print_r('error rendwer');die;
				if($e->getCode() == 14) //The 14 is the code of the "You don't have permissions" error on grocery CRUD.
				{
					if(isset($data['crud-deny-redirect']))
					{
						redirect($data['crud-deny-redirect'], 'refresh');
					}
					else
					{
						// por el unset_read cuando sea read lo mando al edit
						if(grocery_CRUD_States::STATE_READ == $data['grocery']->get_state_code()) {
							$url = current_url();
							$url = str_replace('/read/', '/edit/', $url);
							redirect($url, 'refresh');
						}

						show_error('Acceso Denegado', '403');
					}
				} else {
					print_r($e->getMessage());
				}
			}
		}

		$menues = array();
		if(session()->get('userID') != null)
		{
			$menuModel = new \App\Models\MenuModel();
			$menues = $menuModel->parseMenues();
		}
		
		$menu = view('menu', $menues);
		$header = view('header');
		


		$view = \Config\Services::renderer();
		return $view->setVar('data', $data)->setVar('header', $header)->setVar('menu', $menu)->render($data['view']);

	}
}  // end class
