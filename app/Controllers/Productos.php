<?php

namespace App\Controllers;
use App\Models\ProductoModel;
use App\Libraries\GroceryCrud;
use App\Models\FacturaModel;


class Productos extends AdminLayout
{

    public function listadoProductos($errors=null)
    {
    
        $crud = new GroceryCrud();
    
       
        
        $arrayColumns = [
            'id_Producto','nombre','cod_barras','fechaVencimiento','Cantidad','precio'
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
        $crud->requiredFields(['nombre','cod_barras','fechaVencimiento','Cantidad','precio']);

        if ($crud->getState() == 'add') {
            $crud->fieldType('id_Producto', 'hidden'); 
        };
    

        $crud->setRule('cod_barras','Cod barras','is_unique[producto.cod_barras]');
        $crud->setRule('nombre','Nombre','is_unique[producto.nombre]');
        $crud->setRule('Cantidad','Cantidad','is_natural_no_zero');
        $crud->setRule('precio','Precio','is_natural_no_zero');

        $crud->setActionButton('Admin lotes de producto', 'el el-user', function ($primaryKey) { 
            return site_url('/Lote/lotes/' . $primaryKey); 
        }, true);

        $crud->setActionButton('Admin precios', 'el el-user', function ($primaryKey) { 
            return site_url('/ListaPrecios/listaPrecios/' . $primaryKey); 
        }, true);

        $crud->callbackAfterInsert(function ($stateParameters) use ($crud) {
           
            $productoModel = new ProductoModel();

            $resultado =  $productoModel->añadirProducto($stateParameters);
            if(is_array($resultado)){
                $error = $resultado['errors'];
                $data['errors'] = [$error];
                $crud->setLangString('insert_error', 'Cannot add the record' );

                return $crud;
               
            }
            return $resultado;
        });
        
        $currentURL = current_url();
        $edit = strpos($currentURL,'edit');
        $add = strpos($currentURL,'add');
        if($add !== false || $edit !== false ){
            $data['errors'] = $errors;
        }
   

          //SETS DATA TO VIEW
        $data = array();
        $data['grocery'] = $crud;
        return $this->render($data);

    }
    function test_check($str){
        return false;

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
