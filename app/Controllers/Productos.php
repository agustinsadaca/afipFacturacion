<?php

namespace App\Controllers;


use App\Libraries\GroceryCrud;
use App\Models\FacturaModel;


class Productos extends AdminLayout
{

    public function listadoProductos()
    {
  
    $crud = new GroceryCrud();
        
        $arrayColumns = [
            'id_Producto','nombre','idLote','idListaPrecios'
        ];

        //// SETS GENERALES
        $crud->setTheme('datatables');
        $crud->setTable('producto');
        $crud->setSubject('producto', 'Productos');
        $crud->columns($arrayColumns);
        $crud->editFields($arrayColumns);
        $crud->fields($arrayColumns);
        $crud->fieldType( 'id_Producto', 'readonly');
        $crud->setRelation( 'idListaPrecios', 'lista_de_precios','precio');
        $crud->displayAs('idListaPrecios','Precio');

          //SETS DATA TO VIEW
        $data = array();
        $data['grocery'] = $crud;
        return $this->render($data);

    }
}
