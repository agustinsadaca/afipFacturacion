<?php

namespace App\Controllers;
use App\Libraries\GroceryCrud;
use App\Models\FacturaModel;
use App\Models\ProductoModel;
use App\Models\DetalleFacturaModel;



class PuntoVenta extends AdminLayout
{
	public function venta()
	{       
		$crud = new GroceryCrud();
 
        $arrayColumns = [
           'id','date','total'
        ];

        $columnas = [
            'id','date','total','venta'
        ];
    
        //// SETS GENERALES
        $crud->setTheme('datatables');
        $crud->setTable('factura');
        $crud->setSubject('factura', 'Facturas');
        $crud->columns($columnas);
        $crud->displayAs('id','Numero de Factura');
        $crud->editFields($arrayColumns);
        $crud->fields($arrayColumns);
        $crud->fieldType('total', 'readonly');
        $crud->fieldType('id', 'readonly');
        $crud->unsetAddFields(['id','total']);
        // $crud->fieldType('date','datetime');
     
        if ($crud->getState() == 'add') {

            $crud->fieldType('id', 'hidden');
            $crud->fieldType('total', 'hidden');
       };

        $crud->callbackAddField('date',array($this,'_add_default_date_value'));
        $crud->callbackColumn('venta', function ($value, $row) {

            return '<a class="button" href="'.base_url().'/PuntoVenta/carrito/'.$row->id.'" name="contact_telephone_number" id="something-unique" >Venta</a>';
            
        });

            $data = array();
    
            $data['grocery'] = $crud;
            
            return $this->render($data);
        
	}
  
    function _add_default_date_value(){
        $value = !empty($value) ? $value : date("d/m/Y H:i:s");
        $return = '<input type="text" style="width:200px!important" name="date" value="'.$value.'" class="datepicker-input" /> ';
        $return .= '<a class="datepicker-input-clear" tabindex="-1"></a> (dd/mm/yyyy)';
        return $return;
    }   

    public function carrito($id)
    {
        
        $crud = new GroceryCrud();
        
        $arrayColumns = [
           'id_detalle_factura','productos','cod_barras','precio','cantidad','subtotal','id_factura'
        ];
        $arrayAddColumns = ['productos','cod_barras','precio','cantidad'];
        //// SETS GENERALES
        $crud->setTheme('datatables');
        $crud->setTable('detalle_factura');
        $crud->setSubject('detalle_factura', 'Productos del Carrito','');
        $crud->columns($arrayColumns);
        $crud->unsetColumns(['id_factura','id_detalle_factura']);
        $crud->unsetFields(['id_factura']);
        $crud->editFields($arrayColumns);
        $crud->where('id_factura',$id);
        $crud->fieldType('subtotal', 'readonly');
        $crud->fieldType('id_detalle_factura', 'readonly');
        $crud->unsetAddFields(['subtotal']);
        $crud->addFields($arrayAddColumns);



        if ($crud->getState() == 'add') {

            $crud->fieldType('id_factura', 'hidden'); 
            $crud->fieldType('id_detalle_factura', 'hidden'); 
       }
        if ($crud->getState() == 'edit') {

            $crud->fieldType('subtotal', 'hidden'); 
            $crud->fieldType('id_factura', 'hidden'); 
       }

        $productoModel = new ProductoModel();
        $resultados =  $productoModel->buscarListaProductos();

        $crud->fieldType('productos','dropdown',$resultados);
    
        $crud->callbackAfterInsert(function ($stateParameters) use ($id,$crud) {
           
            $detalleFacturaModel = new DetalleFacturaModel();

            $resultado =  $detalleFacturaModel->guardarProducto($stateParameters,$id);
         
            return $resultado;
        });

        $crud->callbackColumn('cod_barras', function ($value, $row) {
            $producto = new ProductoModel();

            $resultado =  $producto->buscarCodBarra($row);
            return "<p>".$resultado."</p>";
            
        });
          
        $crud->callbackColumn('productos', function ($value, $row) {

            $producto = new ProductoModel();
            $resultado =  $producto->buscarProducto($row);

            return "<p>".$resultado."</p>";
        });
        $crud->callbackAddField('otro_Producto', function ()
        {
            return '<input type="text" " name="otro_Producto">';

        }); $crud->callbackAddField('precio', function ()
        {
            return '<input type="text" class="form-controls"  name="precio">';
        });
    
        $crud->callbackAddField('cantidad', function ()
        {
            return '<input type="number" value="1" name="num">';
        });
        
        $crud->callbackEditField('cantidad', function ()
        {
            return '<input type="number" value="1" name="num">';
        });
        

        // $validation =  \Config\Services::validation();
        // $validation->setRule('cod_barras', 'cod_barras', 'required');
        // $errors = $validation->getErrors();

        $data['grocery'] = $crud;
        $data['view'] = 'carrito'; 
        $data['title'] = (string)$id;
        $data['total'] = '';
        return $this->render($data);
    }

    function agregarDetalleAutomatico($codBarra,$id) 
    {
        $guardarDetalle = new DetalleFacturaModel();

        $guardarDetalle->agregarDetalleAutomatico($codBarra,$id);
       
        return ;
    }

   
    
    

}
