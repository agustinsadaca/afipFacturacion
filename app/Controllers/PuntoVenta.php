<?php

namespace App\Controllers;
use App\Libraries\GroceryCrud;
use App\Models\FacturaModel;
use App\Models\ProductoModel;
use App\Models\DetalleFacturaModel;
use App\Models\ClienteModel;

class PuntoVenta extends AdminLayout
{
	public function venta()
	{       
		$crud = new GroceryCrud();
 
        $arrayColumns = [
           'id','date','total','id_cliente'
        ];

        $columnas = [
            'id','date','total','paga_con','vuelto','medio_pago','id_cliente','venta'
        ];
    
        //// SETS GENERALES
        $crud->setTheme('datatables');
        $crud->setTable('factura');
        $crud->setSubject('factura', 'Facturas');
        $crud->columns($columnas);
        $crud->displayAs('id','Numero de Factura');
        $crud->displayAs('id_cliente','Cliente');
        $crud->editFields($arrayColumns);
        $crud->fields($arrayColumns);
        $crud->fieldType('total', 'readonly');
        $crud->fieldType('id', 'readonly');
        $crud->unsetAddFields(['id','total']);
        $crud->setRelation('id_cliente', 'cliente', 'nombre_completo');
        $crud->defaultOrdering('id', 'asc');
        $crud->unsetBackToDatagrid();

        if ($crud->getState() == 'add') 
        {

            $crud->fieldType('id', 'hidden');
            $crud->fieldType('total', 'hidden');
       };

        $crud->callbackAddField('date',array($this,'_add_default_date_value'));
  
        $crud->callbackColumn('venta', function ($value, $row)
        {
            return '<a class=" btn btn-block btn-success btn-sm" href="'.base_url().'/PuntoVenta/carrito/'.$row->id.'" name="contact_telephone_number" id="something-unique" >Venta</a>';
        }); 

        $crud->callbackAfterInsert(function ($stateParameters) use ($crud) {
       
            $link = base_url()."/PuntoVenta/carrito/".$stateParameters->insertId;
           
            $data = "Tu factura ha sido creada redirigiendo a los items de la factura";
            $data .= "<script type='text/javascript'> window.location = '" . $link . "';</script><div style='display:none'></div>";

            $crud->setLangString('insert_success_message',$data);

            return $crud;
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

    public function carrito($id,$error=null)
    {
        
        $crud = new GroceryCrud();
        
        $arrayColumns = [
           'id_detalle_factura','id_Producto','cod_barras','precio_unitario','cantidad','subtotal','id_factura'
        ];
        $arrayAddColumns = ['id_Producto','cod_barras','precio_unitario','cantidad'];
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
        $crud->setRelation('id_Producto','producto','nombre');
        $crud->displayAs('id_Producto','Productos');
        $crud->limit(25);

        $crud->unsetEditFields([  'id_detalle_factura','id_Producto','cod_barras','precio','cantidad','subtotal','id_factura']);

        if ($crud->getState() == 'add') 
        {
            $crud->fieldType('id_factura', 'hidden'); 
            $crud->fieldType('id_detalle_factura', 'hidden'); 
        }
        if ($crud->getState() == 'edit') 
        {
            $crud->fieldType('subtotal', 'readonly'); 
            $crud->fieldType('id_factura', 'hidden'); 
            $crud->fieldType('id_detalle_factura', 'hidden'); 
        }

        $productoModel = new ProductoModel();
        $resultados =  $productoModel->buscarListaProductos();
    
        $crud->callbackAfterInsert(function ($stateParameters) use ($id,$crud) 
        {
           
            $detalleFacturaModel = new DetalleFacturaModel();

            $resultado =  $detalleFacturaModel->guardarProducto1($stateParameters,$id);
         
            return $resultado;
        });
        $crud->callbackUpdate(function ($stateParameters) use ($id,$crud) 
        {
      
            $detalleFacturaModel = new DetalleFacturaModel();

            $resultado =  $detalleFacturaModel->editarProductoDetalle($stateParameters,$id);
           
            return $resultado;
        });
        $crud->callbackBeforeDelete(function ($stateParameters) 
        {
            
            $detalleFacturaModel = new DetalleFacturaModel();

            $resultado =  $detalleFacturaModel->deleteAumentarStock($stateParameters);
         
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
    
        $crud->callbackAddField('cantidad', function ()
        {
            return '<input type="number" value="1" name="num">';
        });
        
        $crud->callbackEditField('cantidad', function ($fieldValue, $primaryKeyValue ) 
        {
           $cantidad = new DetalleFacturaModel();

           $resultado =  $cantidad->buscarCantidadDetalle($primaryKeyValue);
            return '<input type="number" value="'.$resultado.'" name="num">';
        });
        // $mercadopago = new MercadoPago1();
        // $preference = $mercadopago->mercadoP();
        // $data['preference'] = $preference;

        if($error=='su producto no existe, ingreselo de nuevo o agregue el producto'){
            
            $data['errors'] = [$error];
        }
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
        if($guardarDetalle==false){
            // var_dump('hola');
            header('Location:'.base_url().'/PuntoVenta/carrito/'.$id);
            exit;
        }
        return ;
    }

   function getTotalFactura($id){

        $total = new DetalleFacturaModel();

        $totalFact= $total->obtenerTotal($id);
    
        return  json_encode($totalFact);

   }
    
    public function finalizarCompra($idFactura,$totalFact=null,$pagaCon=null)
    {
       
        $finalizarFactura = new FacturaModel();

        $result= $finalizarFactura->finalizarCompra($idFactura,$totalFact,$pagaCon);
    
        return  json_encode($totalFact);

    }

}
