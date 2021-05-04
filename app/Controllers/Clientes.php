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
            'id','nombre','apellido','cuit'
        ];
       
       

        //// SETS GENERALES
        $crud->setTheme('datatables');
        $crud->setTable('cliente');
        $crud->setSubject('cliente', 'Clientes');
        $crud->columns($arrayColumns);
        $crud->addFields($arrayColumns);
        $crud->fields($arrayColumns);
        $crud->fieldType( 'id', 'readonly');
        $crud->displayAs('nombre','Nombre');
        $crud->displayAs('apellido','Apellido');
        $crud->requiredFields(['nombre','apellido']);
        // $crud->setRule('cuit','cuit','is_natural');
        // $crud->setRule('CUIT','CUIT','is_unique[cliente.cuit]');

        if ($crud->getState() == 'add' ) {
            $crud->fieldType('id', 'hidden'); 
       }

        $crud->setActionButton('Admin facturas Cliente', 'el el-user', function ($primaryKey) { 
            return site_url('/ClienteFactura/ClienteFactura/' . $primaryKey); 
        }, true);

      

       

          //SETS DATA TO VIEW
        $data = array();
        $data['grocery'] = $crud;
        return $this->render($data);

    }

}
