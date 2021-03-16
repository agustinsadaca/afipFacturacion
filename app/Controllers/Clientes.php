<?php

namespace App\Controllers;
use App\Models\ProductoModel;
use App\Libraries\GroceryCrud;
use App\Models\FacturaModel;


class Clientes extends AdminLayout
{

    public function clientes()
    {
  
    $crud = new GroceryCrud();
        
        $arrayColumns = [
            'id','nombre_completo'
        ];
       
       

        //// SETS GENERALES
        $crud->setTheme('datatables');
        $crud->setTable('cliente');
        $crud->setSubject('cliente', 'Clientes');
        $crud->columns($arrayColumns);
        $crud->editFields([ 'id_Producto','nombre','cod_barras','precio']);
        $crud->addFields($arrayColumns);
        $crud->fields($arrayColumns);
        $crud->fieldType( 'id', 'readonly');
        $crud->displayAs('nombre_completo','Nombre Completo');
     
        $crud->requiredFields(['nombre_completo']);

    //     if ($crud->getState() == 'add') {
    //         $crud->fieldType('id_Producto', 'hidden'); 
    //    }

        $crud->setActionButton('Admin facturas Cliente', 'el el-user', function ($primaryKey) { 
            return site_url('/ClienteFactura/ClienteFactura/' . $primaryKey); 
        }, true);

      

       

          //SETS DATA TO VIEW
        $data = array();
        $data['grocery'] = $crud;
        return $this->render($data);

    }

}
