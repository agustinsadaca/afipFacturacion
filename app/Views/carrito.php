<!DOCTYPE html>
<html>
<head>
    <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js">
	window.Mercadopago.setPublishableKey("TEST-13e47bff-5adf-4fff-80a0-9dea0f291474");
	</script>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo(base_url().'/bootstrap.min.css')?>"> 
<?php if (isset($data['js_files'])) {
    foreach ($data['css_files'] as $file): 
      
    ?>

        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php
endforeach;
}
?>
    <title>
        <?php 
            if(isset($data['title'])) 
            {
                echo $data['title'];
            }
        ?>
    </title>
</head>
<body>

<style>
.errors_validation{
    color:red;
    padding: 50px 0 0 10px ;
}
.bcode{
    border:2;
    outline:none;
}
.bcode:hover{
    border:1;
    outline:none;
}
.labelsAppend{
    display: flex;
}
.inputLabel{
    width:20%;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}
table{
    table-layout: fixed;
    width: 700px;
}
.compraDatos{
    margin-left:30px;
}
.finalizarComp{
    margin-top:20px;
    border-radius:2px;
    box-shadow: none;
}
.barcodes{
    padding:25px 10px;
}

</style>

<?= $menu; ?>
<div class="click barcodes">
    <div class="input-group labelsAppend">
        <div class="input-group-prepend">
            <img class="input-group-text" src="<?php echo(base_url().'/barcode-solid.png')?>" />
        </div>
        <input  class="form-control inputLabel bcode" name="barcode"  autofocus onchange="myfunc(this)"  >
    </div>

    <!-- <input class="bcode" name="barcode"  autofocus onchange="myfunc(this)" ></input> -->
</div>
<?php foreach($data['errors'] as $error) { ?>
        <div  class="errors_validation click">   
            <?php echo $error;?>
        </div>
<?php } ?>

	<div class="click" style='height: 10px;'></div>
    <div  style="padding: 10px">

<?php

if (isset($data['output'])) {
    echo $data['output'];
}
?>

    </div>
    <?php if (isset($data['js_files'])) {
    foreach ($data['js_files'] as $file): ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach;
}?>
<form id="formulario" >
    <!-- <label for="fname" class="click">Total</label><span id="totalCompra" name="totalCompra" ></span>

    <span id="valorTotal" class="click"></span><br>

    <span>Paga con: </span><input id="pagaCon" /><br>

    <span>Vuelto : </span><input id="vuelto" type="text" readonly><br> -->

    <p class="compraDatos"><input type="radio" name="pago" value="mercadopago">MercadoPago<input type="radio" name="pago" value="Contado">Contado </p>
    
    <TABLE class="compraDatos">
        <tr>
            <td>
                <div class="input-group labelsAppend click" >
                    <div class="input-group-prepend">
                        <span class="input-group-text">Total</span>
                    </div>
                    <span id="valorTotal" class="form-control inputLabel" readonly>
                </div>
            </td>
          
            <td>
                <div class="input-group labelsAppend">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Paga con</span>
                    </div>
                    <input id="pagaCon" class="form-control inputLabel" >
                </div>
            </td>
          
            <td>
                <div class="input-group labelsAppend">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Vuelto</span>
                    </div>
                    <input class="form-control inputLabel vuelto" id="vuelto" readonly >
                </div>
            </td>
          
       
          
        </tr>  
    </TABLE> 

    <!-- <script
    src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
    data-preference-id="<?php //echo $data['preference']->id; ?>">
    console.log($data['preference']->id)
    </script> -->
    
    <label for="fname" class="click compraDatos "><input class="finalizarComp" type="button" value="Finalizar Compra" onclick="finalizarCompra(this)"/></label><br>
 
   
    

<div class="click" style="padding-bottom:500px">

    <p><?php echo $data['total']?></p>

</div>
<script type="text/javascript" >
       
        function finalizarCompra(hola){
                var valorTotal = $("#valorTotal").text();
                var paga_con = $("#pagaCon").val();
                window.location = "<?php echo base_url()?>"+"/PuntoVenta/finalizarCompra/"+"<?php echo $data['title'].'/'?>"+String(valorTotal)+"/"+String(paga_con);
             
               
        }
		function myfunc(control){
			if(control.value.length>8){
			 window.location = "<?php echo base_url().'/PuntoVenta/agregarDetalleAutomatico/'?>"+ control.value+"/"+<?= $data['title']?>;
            }
		}
        var showMenu = document.getElementsByClassName("click");
       
        for ( var i = 0; i < showMenu.length; ++i ) {
            showMenu[i].addEventListener("click", function(){
            document.getElementsByClassName("bcode")[0].focus();
            });
        } 
    
      
        $(document).on('ready', function(){


           
            $('.dataTables_length label select option[value="50"]').prop('selected', true)
      
            var urlAct= String(window.location)
            var a = urlAct.search("edit") 
            var b = urlAct.search("add") 
            if(a>=0 || b>=0){
                    $('#formulario').hide();
            }
            $.ajax({
                async: false,
                method: "GET",
                url: "<?php echo base_url().'/PuntoVenta/getTotalFactura/'.$data['title']?>",
            }).done(function (total) 
            {
                
                var prodJson = JSON.parse(total)
                
                $("#valorTotal").text(prodJson);
            
                
            })
            $('#pagaCon').on('keypress',function(e) {
                

                if(e.which == 13) {
                    var totalFact = $('#valorTotal').text();
                    var pagaCon = $(this).val();
                    var vuelto = pagaCon-totalFact
                    $('#vuelto').val(vuelto)
                }
            });

           
            if(($("#field_id_Producto_chosen .chosen-single span").text()) != "Seleccionar Productos") {

                    $("#precio_input_box").trigger("chosen:updated");
                
                    $.ajax({
                        async: false,
                        method: "GET",
                        url: "<?php echo base_url()?>"+'/Productos/getProductoXNomb/' + $("#field_id_Producto_chosen .chosen-single span").text(),
                    }).done(function (prod) 
                    {
                        var prodJson = JSON.parse(prod)
                        
                        $("input[name=precio_unitario]").val(prodJson.precio);
                        $("input[name=cod_barras]").val(prodJson.cod_barras);
                        
                    })
            }
            
            $("#id_Producto_input_box ").on('change','#field-id_Producto',function(e){
                
                if(($("#field_id_Producto_chosen .chosen-single span").text()) != "Seleccionar Productos") {
                    // $("#field_productos_chosen").trigger("chosen:updated");
                    console.log(($("#field_id_Producto_chosen .chosen-single span").text()))
                    $("#precio_input_box").trigger("chosen:updated");
                
                    $.ajax({
                        async: false,
                        method: "GET",
                        url: "<?php echo base_url()?>"+'/Productos/getProductoXNomb/' + $("#field_id_Producto_chosen .chosen-single span").text(),
                    }).done(function (prod) 
                    {
                        
                        var prodJson = JSON.parse(prod)
                        $("input[name=precio_unitario]").val(prodJson.precio);
                        $("input[name=cod_barras]").val(prodJson.cod_barras);

                        // $("#precio_input_box").trigger("chosen:updated");
                        // $("#field_productos_chosen .chosen-single span").trigger("click")
                        // $("#field_productos_chosen .chosen-single span").trigger("click")
                        
                    })
               }});
            });

</script>

</body>
</html>
