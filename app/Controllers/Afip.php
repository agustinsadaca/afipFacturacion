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
            'id','fecha_creacion','total','nro_cae','id_cliente','id_tipo_comprobante'
        ];


        //// SETS GENERALES
        $crud->setTheme('datatableCheckBox');
        $crud->setTable('factura_afip');
        $crud->displayAs('fecha_creacion','Fecha de creación');
        $crud->displayAs('id_tipo_comprobante','Tipo de Comprobante');
        $crud->displayAs('id','Id');
        $crud->setSubject('Factura Afip');
        $crud->columns($arrayColumns);
        $crud->editFields($arrayColumns);
        $crud->fields($arrayColumns); 
        $crud->setRelation('id_cliente', 'cliente', '{nombre} {apellido}');
        $crud->setRelation('id_tipo_comprobante', 'tipo_comprobante', 'nombre_tipo');
        // $crud->setRule('total','total','is_natural_no_zero');

     
        // $crud->unsetAdd(); 
        // $crud->unsetEdit(); 
        // $crud->unsetDelete();
        if ($crud->getState() == 'add') {
            $crud->fieldType('id', 'hidden'); 
            $crud->fieldType('nro_cae', 'hidden'); 
       }

        if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
           try {
                $fD = $_POST['fechaDesde'];
                $fH = $_POST['fechaHasta'];
           } catch (\Throwable $th) {
               
           }
        
           
            if(empty($fd)){}
        }
        if($fD!="" || $fH!="" ){
         
            try {
            $fechaDesde = explode('/',$fD);
            $fechaDesde = $fechaDesde[2].$fechaDesde[0].$fechaDesde[1];
            // var_dump($fechaDesde);
        
            } catch (\Throwable $th) {
                
            }
            try{
           
            $fechaHasta = explode('/',$fH);
            $fechaHasta = $fechaHasta[2].$fechaHasta[0].$fechaHasta[1];
            }catch (\Throwable $th) {
              
            }
            // var_dump($fechaDesde);
            // var_dump($fechaHasta);

            if( $fechaDesde!="" && is_array($fechaHasta) ){
                var_dump($fechaDesde);
                $crud->where(
                    "factura_afip.fecha_creacion>=$fechaDesde"
                );
            }elseif( $fechaHasta!="" && is_array($fechaDesde)){
                $crud->where(
                    "factura_afip.fecha_creacion<=$fechaHasta"
                );
            }elseif(!is_array($fechaHasta) && !is_array($fechaDesde)){
                $crud->where(
                    "factura_afip.fecha_creacion<=$fechaHasta"
                );   
                $crud->where(
                    "factura_afip.fecha_creacion>=$fechaDesde"
                );
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
