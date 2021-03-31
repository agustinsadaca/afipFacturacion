<?php

namespace App\Controllers;

use App\Libraries\GroceryCrud;
use App\Models\FacturaModel;
use App\Models\LoteModel;


class Lote extends AdminLayout
{
	public function lotes($id)
	{
		
		$crud = new GroceryCrud();
        
        $arrayColumns = [
            'id','fechaCompra','fechaVencimiento','cantidad'
        ];


        //// SETS GENERALES
        $crud->setTheme('datatables');
        $crud->setTable('lote');
        $crud->setSubject('lote', 'Lotes Producto');
        $crud->columns($arrayColumns);
        $crud->editFields($arrayColumns);
        $crud->fields($arrayColumns);
        $crud->where('id_Producto',$id);
        
        if ($crud->getState() == 'add') 
        {
            $crud->fieldType('id', 'hidden');
          
       };
        if ($crud->getState() == 'edit') 
        {
            $crud->fieldType('id', 'hidden');
          
       };
       $crud->callbackAfterInsert(function($stateParameters) use($id){

            $loteModel = new LoteModel();
            $resultado =  $loteModel->agregarProductoAlLote($stateParameters,$id);
            return $resultado;
        });

        $data = array();
        $data['grocery'] = $crud;
        return $this->render($data);


    }

}
