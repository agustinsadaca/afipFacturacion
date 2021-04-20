<?php

namespace App\Controllers;
use App\Libraries\GroceryCrud;
use App\Models\FacturaModel;
use MercadoPago; 




class Afip extends AdminLayout
{
    public function afip()
	{
        global $fD;
        global $fH;

        
        $crud = new GroceryCrud();
        
        $arrayColumns = [
            'id','date','cliente','total','tipoFactura','estado_factura'
        ];


        //// SETS GENERALES
        $crud->setTheme('datatableCheckBox');
        $crud->setTable('factura');
        $crud->displayAs('date','Fecha de emisión');
        $crud->setSubject('factura', 'Facturacion Afip');
        $crud->columns($arrayColumns);
        $crud->editFields($arrayColumns);
        $crud->fields($arrayColumns);      
        $crud->unsetAdd(); 
        $crud->unsetEdit(); 
        $crud->unsetDelete();
     
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fD = $_POST['fechaDesde'];
            $fH = $_POST['fechaHasta'];
           
            if(empty($fd)){}
        }
        if($fD!="" || $fH!="" ){
         
            try {
            $fechaDesde = explode('/',$fD);
            $fechaDesde = $fechaDesde[2].$fechaDesde[0].$fechaDesde[1];
            } catch (\Throwable $th) {
                
            }
            try{
           
            $fechaHasta = explode('/',$fH);
            $fechaHasta = $fechaHasta[2].$fechaHasta[0].$fechaHasta[1];
            }catch (\Throwable $th) {
              
            }
       
            if( $fD!="" && $fH=="" ){
                $crud->where("id IN (SELECT id FROM factura WHERE date >= $fechaDesde)");
            }elseif( $fH!="" && $fD==""){
                $crud->where("id IN (SELECT id FROM factura WHERE Convert(date,date) <= $fechaHasta)");
            }elseif($fD!="" && $fH!=""){
                $crud->where("id IN (SELECT id FROM factura WHERE date >= $fechaDesde AND Convert(date,date) <= $fechaHasta)");   
            }
            
        }
        // if(isset($fD) || isset($fH)){
        // $_SESSION["fechaDesde"]= $fD;
        // $_SESSION["fechaHasta"]= $fH;
        // var_dump( $_SESSION["fechaHasta"]);
        // }
        $data = array();
        
        $data['view'] = 'afip.php';
        $data['grocery'] = $crud;
        return $this->render($data);


    }
   

}
