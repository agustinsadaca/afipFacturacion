<?php

namespace App\Controllers;
use App\Models\ProductoModel;
use App\Libraries\GroceryCrud;
use App\Models\FacturaModel;


class Productos extends AdminLayout
{

    public function listadoProductos()
    {
  
    $crud = new GroceryCrud();
        
        $arrayColumns = [
            'id_Producto','nombre','cod_barras','fechaCompra','fechaVencimiento','Cantidad','precio','fecha Cambio precio'
        ];
        $columnasArray = ['id_Producto','nombre','cod_barras','Cantidad Total de Producto','precio Actual','fecha ultimo cambio de precio'];
       

        //// SETS GENERALES
        $crud->setTheme('datatables');
        $crud->setTable('producto');
        $crud->setSubject('producto', 'Productos');
        $crud->columns($columnasArray);
        $crud->editFields([ 'id_Producto','nombre','cod_barras','precio']);
        $crud->addFields($arrayColumns);
        // $crud->fields($arrayColumns);
        $crud->fieldType( 'id_Producto', 'readonly');
        $crud->displayAs('idListaPrecios','Precio');
        $crud->fieldType('fechaCompra','datetime');
        $crud->fieldType('fechaVencimiento','datetime');
        $crud->fieldType('fecha Cambio precio','datetime');
        $crud->fieldType('Cantidad','float');
        $crud->unsetColumns(['fechaCompra','fechaVencimiento']);
       

        $crud->setActionButton('Adm lotes de producto', 'el el-user', function ($primaryKey) { 
            return site_url('/Lote/lotes/' . $primaryKey); 
        }, true);

        $crud->setActionButton('Adm precios', 'el el-user', function ($primaryKey) { 
            return site_url('/Lote/lotes/' . $primaryKey); 
        }, true);


          //SETS DATA TO VIEW
        $data = array();
        $data['grocery'] = $crud;
        return $this->render($data);

    }

    function getProducto($id){
        $producto = new ProductoModel();
        $resultado =  $producto->buscarProducto($id);
         echo json_encode($resultado);
    }
    function getProductoXNomb($nomb){
        $producto = new ProductoModel();
        $resultado =  $producto->buscarPrecioXNomb($nomb);
        return json_encode($resultado);
    }
}
