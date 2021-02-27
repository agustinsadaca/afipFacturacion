<?

// $link = base_url()."/PuntoVenta/carrito";

// $data = "Your data has been successfully stored into the database.<br/>Please wait while you are redirecting to the another page.";
// $data .= "<script type='text/javascript'> window.location = '" . $link . "';</script><div style='display:none'></div>";

// $crud->setLangString('insert_success_message',$data);



// echo('<pre>');
// var_dump($a);die;
// echo('</pre>');




 // $crud->callbackAddField('Comenzar venta', function () {

        //     return '<a class="form-control" href="'.base_url().'/PuntoVenta/carrito" name="contact_telephone_number" id="something-unique" >Carrito</a>';

        // });



// $crud->callbackAfterInsert(array($this,'redirect'));





// $crud->callbackAddField('test1', function (){
          
        //     $productoModel = new ProductoModel();

        //     $resultado =  $productoModel->traerPrecioActualizado();
    
        //     return $resultado;

        // });
      

        // $crud->callbackBeforeInsert(array($this,'callback_before_insert_or_update_test1'));
        // $crud->callbackBeforeUpdate(array($this,'callback_before_insert_or_update_test1'));


        // $crud->where(['SELECT lista_de_precios.fechaHasta FROM producto INNER JOIN lista_de_precios ON producto.idListaPrecios=lista_de_precios.id' => NULL]);


        // $this->model = new ProductoModel($db);
        // $crud->setModel($this->model->traerPrecioActualizado($db)) ;


        // $crud->callbackColumn('id_Producto', function ($value, $row) {
        //     var_dump($row);die;
        //     $this->model = new EstablecimientoModel();
        //     $this->model->traerPrecioActualizado($row);
        // });