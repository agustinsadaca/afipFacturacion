<?php

namespace App\Controllers;
use App\Models\ProductoModel;
use App\Libraries\GroceryCrud;
use App\Models\FacturaModel;
use GlobeAPI\Classes\Sammy\Sammy;





class Productos extends AdminLayout
{
    public function __construct()
    {}
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

        $crud->setRule('Cantidad','Cantidad','greater_than[-1]');
        $crud->setRule('precio','Precio','greater_than[0]'); 
        // $crud->unsetJquery();

        /* -------------------------------------------------------------------------- */
        /*                 Labels de la pantalla de alta de productos                 */
        /* -------------------------------------------------------------------------- */
        $currentURL = current_url();
        $edit = strpos($currentURL,'edit');
        $add = strpos($currentURL,'add');

        // if($add!=false) {
            $crud->setRule('nombre','Nombre','is_unique[producto.nombre]');
            $crud->setRule('cod_barras','Cod barras','is_unique[producto.cod_barras]');
            $crud->fieldType('id_Producto', 'hidden');
        // }
        // echo '<pre>';
        // var_dump($crud);
    
        // /* -------------------------------------------------------------------------- */
        /*                                  Acciones                                  */
        /* -------------------------------------------------------------------------- */
        $crud->setActionButton('Admin lotes de producto', 'el el-user', function ($primaryKey) { 
            return site_url('/Lote/lotes/' . $primaryKey); 
        }, false);

        $crud->setActionButton('Admin precios', 'el el-user', function ($primaryKey) { 
            return site_url('/ListaPrecios/listaPrecios/' . $primaryKey); 
        }, false);

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

        $crud->callbackDelete(function ($stateParameters) {
            $producto = new ProductoModel();
            $resultado =  $producto->borrarProductoLoteYLP($stateParameters);

            return $stateParameters;
        });
   
     
       
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
    public function importExcelProductos(){
        
        $data = array();
        $data['view'] = 'importProductos.php';
        return $this->render($data);
    }
    public function imortarDatosExcel(){
        // require_once __DIR__.'\..\..\vendor\autoload.php'; // You have to require the library from your Composer vendor folder

        if($this->request->getMethod()=='post'){
			$ruta = 'uploads/';
			if(!is_dir($ruta)){
				mkdir($ruta,0755);
			}
			$file = $this->request->getFile('file_excel');
            if (!$file->isValid()){
				throw new RuntimeException($file->getErrorString().'('.$file->getError().')');
			}
			else{
				$name_file = $file->getName();
				$file->move($ruta);
				if ($file->hasMoved())
				{
         
                    require_once 'PhpSpreadsheet/src/PhpSpreadsheet/IOFactory.php';
                    // PhpSpreadsheet\src\PhpSpreadsheet

                    // ExcelFile($filename, $encoding);
                    $data = new PhpSpreadsheet\PhpOffice\PhpSpreadsheet\IOFactory();

               
                    var_dump($var);die;

                }
            }
        }
    }
}
