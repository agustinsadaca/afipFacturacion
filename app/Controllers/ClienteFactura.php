<?php

namespace App\Controllers;
use App\Models\ProductoModel;
use App\Libraries\GroceryCrud;
use App\Models\FacturaModel;


class ClienteFactura extends AdminLayout
{

    public function clienteFactura()
    {
  
    $crud = new GroceryCrud();
        
        $arrayColumns = [
            'id','mes','total','abonado','debe','id_cliente'
        ];
       
       

        //// SETS GENERALES
        $crud->setTheme('datatables');
        $crud->setTable('cliente_factura');
        $crud->setSubject('clienteFactura', 'Facturas de Cliente');
        $crud->columns($arrayColumns);
        $crud->editFields($arrayColumns);
        $crud->addFields($arrayColumns);
        // $crud->fields($arrayColumns);
        // $crud->fieldType( 'id', 'readonly');
        // $crud->displayAs('nombre_completo','Nombre Completo');
     
        // $crud->requiredFields(['nombre_completo']);

    //     if ($crud->getState() == 'add') {
    //         $crud->fieldType('id_Producto', 'hidden'); 
    //    }


       

          //SETS DATA TO VIEW
        $data = array();
        $data['grocery'] = $crud;
        return $this->render($data);

    }

}
