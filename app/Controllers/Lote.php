<?php

namespace App\Controllers;

use App\Libraries\GroceryCrud;
use App\Models\FacturaModel;


class Lote extends AdminLayout
{
	public function lotes($id)
	{
		
		$crud = new GroceryCrud();
        
        $arrayColumns = [
            'id','fechaCompra','fechaVencimiento','cantidad'
        ];


        //// SETS GENERALES
        $crud->setTheme('datatables');
        $crud->setTable('lote');
        $crud->setSubject('lote', 'Lotes Producto');
        $crud->columns($arrayColumns);
        $crud->editFields($arrayColumns);
        $crud->fields($arrayColumns);
        $crud->where('id_Producto',$id);
        
        $data = array();
        $data['grocery'] = $crud;
        return $this->render($data);


    }

}
