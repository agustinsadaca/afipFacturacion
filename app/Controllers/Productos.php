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
    
    /* -------------------------------------------------------------------------- */
    /*            Seteo tabla de base de datos con respectivas columnas           */
    /* -------------------------------------------------------------------------- */
    /* -------------------------------------------------------------------------- */
    /*                y acciones de CRUD dela libreria GroceryCrud                */
    /* -------------------------------------------------------------------------- */
        
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
      
        /* -------------------------------------------------------------------------- */
        /*                         Tipo de datos de los campos                        */
        /* -------------------------------------------------------------------------- */
        $crud->fieldType( 'id_Producto', 'readonly');
        $crud->displayAs('idListaPrecios','Precio');
        $crud->fieldType('fechaCompra','datetime');
        $crud->fieldType('fechaVencimiento','datetime');
        $crud->fieldType('fecha Cambio precio','datetime');
        $crud->fieldType('Cantidad','float');
        $crud->unsetColumns(['fechaCompra','fechaVencimiento']);
        $crud->requiredFields(['nombre','cod_barras','fechaVencimiento','Cantidad']);
        $crud->unsetEditFields(['id_Producto','nombre','cod_barras','precio']);
        $crud->setRule('nombre','Nombre','is_unique[producto.nombre]');
        $crud->setRule('cod_barras','Cod barras','is_unique[producto.cod_barras]');
        $crud->setRule('Cantidad','Cantidad','greater_than[-1]');
        $crud->setRule('precio','Precio','greater_than[0]'); 

        /* -------------------------------------------------------------------------- */
        /*                 Labels de la pantalla de alta de productos                 */
        /* -------------------------------------------------------------------------- */
        $state = $crud->getState();
        if ($state == "add") 
        {
            $crud->fieldType('id_Producto', 'hidden');
        };
        /* -------------------------------------------------------------------------- */
        /*                                  Acciones                                  */
        /* -------------------------------------------------------------------------- */
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

        $crud->callbackUpdate(function ($stateParameters) 
        {
            $producto = new ProductoModel();
            $resultado =  $producto->editarProducto($stateParameters);
            return;
        });
        $crud->callbackColumn('Cantidad Total de Producto', function ($value, $row) {
            $producto = new ProductoModel();
            $resultado =  $producto->buscarCantTotalLotes($row);

            return "<p>".$resultado."</p>";
        });
        $crud->callbackColumn('precio Actual', function ($value, $row) {

            $producto = new ProductoModel();
            $resultado =  $producto->buscarPrecioActual($row);

            return "<p>".$resultado."</p>";
        });
        
        $crud->callbackColumn('fecha ultimo cambio de precio', function ($value, $row) {

            $producto = new ProductoModel();
            $resultado =  $producto->UltimaFechaCambioPrecio($row);

            return "<p>".$resultado."</p>";
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
    /* -------------------------------------------------------------------------- */
    /*                         API traer productos por id                         */
    /* -------------------------------------------------------------------------- */

    function getProducto($id){
        $producto = new ProductoModel();
        $resultado =  $producto->buscarProducto($id);
         echo json_encode($resultado);
    }
    /* -------------------------------------------------------------------------- */
    /*                         API traer productos por nombre                     */
    /* -------------------------------------------------------------------------- */
    function getProductoXNomb($nomb){
        $producto = new ProductoModel();
        $resultado =  $producto->buscarPrecioXNomb($nomb);
        return json_encode($resultado);
    }
}
