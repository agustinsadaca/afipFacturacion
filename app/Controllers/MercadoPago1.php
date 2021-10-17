<?php

namespace App\Controllers;
use App\Libraries\GroceryCrud;
use App\Models\FacturaModel;
use MercadoPago; 


class MercadoPago1 extends AdminLayout
{
    public function mercadoPago()
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


        //  var_dump(__DIR__.'\..\..\vendor\autoload.php');die;
       
       
        $data = array();
        $data['view'] = 'mercadopago.php';
        $data['preference'] = $preference;
        $data['grocery'] = $crud;
        return $this->render($data);

    }
    public function mercadoP( )
    {
        require_once __DIR__.'\..\..\vendor\autoload.php'; // You have to require the library from your Composer vendor folder
				
        MercadoPago\SDK::setAccessToken("TEST-6807067096388700-101915-9248b0a0b2914097aea2c6222cb13485-167854830"); // Either Production or SandBox AccessToken

        $preference = new MercadoPago\Preference();

        // Crea un ítem en la preferencia
        $item = new MercadoPago\Item();
        $item->title = 'Mi producto';
        $item->quantity = 1;
        $item->unit_price = 75.56;
        $preference->items = array($item);
        $item = new MercadoPago\Item();
        $item->title = 'Mi producto';
        $item->quantity = 1;
        $item->unit_price = 75.56;
        $preference->items = array($item);
        $preference->save();
        return $preference;
    }

}
