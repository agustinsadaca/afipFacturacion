<?php

namespace App\Controllers;

use App\Libraries\GroceryCrud;
use App\Models\FacturaModel;


class ListaPrecios extends AdminLayout
{
    public function listaPrecios($id)
	{
	$crud = new GroceryCrud();
        
        $arrayColumns = [
            'fechaDesde','fechaHasta','precio' 	
        ];


        //// SETS GENERALES
        $crud->setTheme('datatables');
        $crud->setTable('lista_de_precios');
        $crud->setSubject('lista_de_precios', 'lista de precios');
        $crud->columns($arrayColumns);
        $crud->editFields($arrayColumns);
        $crud->fields($arrayColumns);
        $crud->where('id_Producto',$id);
        
        $data = array();
        $data['grocery'] = $crud;
        return $this->render($data);


    }

}
