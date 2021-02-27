<?php

namespace App\Controllers;

use App\Libraries\GroceryCrud;
use App\Models\FacturaModel;


class Lote extends AdminLayout
{
	// public function venta()
	// {
		
	// 	$crud = new GroceryCrud();
        
    //     $arrayColumns = [
    //         'total','date','Comenzar venta'
    //     ];


    //     //// SETS GENERALES
    //     $crud->setTheme('datatables');
    //     $crud->setTable('factura');
    //     $crud->setSubject('factura', 'Facturas');
    //     $crud->columns($arrayColumns);
    //     $crud->unsetAddFields(['fechaCreacion']);
    //     $crud->editFields($arrayColumns);
    //     $crud->fields($arrayColumns);

    //     $crud->fieldType('total', 'readonly');

    //     // if( $crud->getState() == 'edit' ) { //add these only in edit form
    //     //     $crud->set_css('assets/grocery_crud/css/ui/simple/'.grocery_CRUD::JQUERY_UI_CSS);
    //     //     $crud->set_js_lib('assets/grocery_crud/js/'.grocery_CRUD::JQUERY);
    //     //     $crud->set_js_lib('assets/grocery_crud/js/jquery_plugins/ui/'.grocery_CRUD::JQUERY_UI_JS);
    //     //     $crud->set_js_config('assets/grocery_crud/js/jquery_plugins/config/jquery.datepicker.config.js');
    //     // }
       

    //     $crud->callbackAddField('date',array($this,'_add_default_date_value'));
    //     $crud->callbackAddField('Comenzar venta', function () {

    //         return '<a class="form-control" href="'.base_url().'/PuntoVenta/carrito" name="contact_telephone_number" id="something-unique" >Carrito</a>';

    //     });
    //     $crud->callbackEditField('Comenzar venta', function () {

    //         return '<a class="form-control" href="'.base_url().'/PuntoVenta/carrito" name="contact_telephone_number" id="something-unique" >Carrito</a>';

    //     });

    //     ////SETS DATA TO VIEW
    //     $data = array();
    //     $data['grocery'] = $crud;


    //     return $this->render($data);
	// }

    // function _add_default_date_value(){
    //     $value = !empty($value) ? $value : date("d/m/Y H:i:s");
    //     $return = '<input type="text" style="width:200px!important" name="date" value="'.$value.'" class="datepicker-input" /> ';
    //     $return .= '<a class="datepicker-input-clear" tabindex="-1">Clear</a> (dd/mm/yyyy)';
    //     return $return;
    // }   

    // public function carrito()
    // {
    //     $crud = new GroceryCrud();
        
    //     $arrayColumns = [
    //         'Cantidad','subtotal'
    //     ];


    //     //// SETS GENERALES
    //     $crud->setTheme('datatables');
    //     $crud->setTable('detalle_factura');
    //     $crud->setSubject('detalle_factura', 'Productos del Carrito');
    //     $crud->columns($arrayColumns);
    //     $crud->editFields($arrayColumns);
    //     $crud->fields($arrayColumns);
    //     $crud->fieldType('subtotal', 'readonly');

    //     $data = array();
    //     $data['grocery'] = $crud;

    //     $crud->callbackAddField('Cantidad', function () {

    //         return '<input type="number" name="num">';

    //     });

    //     return $this->render($data);
    // }

}
