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



        	// function myfunc(control){
		// 	if(control.value.length>8){
        //         // alert();
		// 	 window.location = "<?php echo base_url().'/PuntoVenta/agregarDetalleAutomatico/'?>"+ control.value+"/"+<?= $data['title']?>;
        //     }
		// }


                document.addEventListener("click", function(){
            document.getElementsByClassName("bcode")[0].focus();
        });




<!-- 
        <?php if(isset($trabajador->usuario_Tiktok)){
										echo '<p><span class="first_span">Cuenta de Tiktok: </span><span><a target="blank" href="http://www.tiktok.com/@';
										echo $trabajador->usuario_Tiktok.'"><img src="'; 
										echo base_url().'assets/octopia_style/css/img/admin/tiktok.png"/></a></span></p>';
									}
									?>
        	</article>
								</div>
								<div class="col-lg-12">
									<article>
									<?php if(isset($trabajador->usuario_Tiktok)){
										echo '<p><span class="first_span">Followers de Tiktok: </span><span>';
										echo $trabajador->followers_Tiktok.'</span></p>';
									
									}?>
									</article> -->



----------------carrito add

 $productoModel = new ProductoModel();
         $resultados =  $productoModel->buscarListaProductos();

         $crud->fieldType('productos','dropdown',$resultados); 




         // $validation =  \Config\Services::validation();
        // $validation->setRule('cod_barras', 'cod_barras', 'required');
        // $errors = $validation->getErrors();




        $crud->callbackAddField('otro_Producto', function ()
        {
            return '<input type="text" " name="otro_Producto">';

        }); $crud->callbackAddField('precio', function ()
        {
            return '<input type="text" class="form-controls"  name="precio">';
        });

        

        <?php echo base_url()?>/PuntoVenta/finalizarCompra/<?php echo $data['title'].'/'?>




        session_set_cookie_params(100000,"/");













        Afip------------------------------------
        
        // echo 'Este es el estado del servidor:';
        // echo '<pre>';
        // print_r($server_status);
        
        // $voucher_info = $afip->ElectronicBilling->GetVoucherInfo(1,1,6); //Devuelve la información del comprobante 1 para el punto de venta 1 y el tipo de comprobante 6 (Factura B)
        
        // echo '<pre>';
        // var_dump($voucher_info);die;
        
        // if($voucher_info === NULL){
        //     echo 'El comprobante no existe';
        // }
        // else{
        //     echo 'Esta es la información del comprobante:';
        //     echo '<pre>';
        //     print_r($voucher_info);
        //     echo '</pre>';
        // }
        // var_dump($iva);die;
        
        // echo '<pre>';
        // $sales_points= $afip->ElectronicBilling->GetVoucherTypes();
        // var_dump($sales_points);die;
        
        // $sales_points= $afip->ElectronicBilling->GetVoucherTypes();
        // // var_dump($sales_points);die;
        // $last_voucher = $afip->ElectronicBilling->GetLastVoucher(1,6);
        // var_dump($last_voucher);
        
        // $res = $afip->ElectronicBilling->CreateNextVoucher($data);
        // $last_voucher = $afip->ElectronicBilling->GetVoucherInfo($last_voucher,1,6);
        // var_dump($last_voucher);
        // var_dump($res);die;