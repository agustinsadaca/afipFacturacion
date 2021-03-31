<!DOCTYPE html>
<html>
<head>
    <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js">
	window.Mercadopago.setPublishableKey("TEST-13e47bff-5adf-4fff-80a0-9dea0f291474");
	</script>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    margin-top:15px;
    border:1;
    outline:none;
}
.bcode:hover{
    border:1;
    outline:none;
}


</style>

<?= $menu; ?>
<div class="click">
    <input class="bcode" name="barcode"  autofocus onchange="myfunc(this)" ></input>
</div>
<?php foreach($data['errors'] as $error) { ?>
        <div  class="errors_validation click">   
            <?php echo $error;?>
        </div>
<?php } ?>

	<div class="click" style='height: 30px;'></div>
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
    <label for="fname" class="click">Total</label><span id="totalCompra" name="totalCompra" ></span>

    <span id="valorTotal" class="click"></span><br>

    <span>Paga con: </span><input id="pagaCon" /><br>

    <span>Vuelto : </span><input id="vuelto" type="text" readonly><br>

    <p><input type="radio" name="pago" value="mercadopago">MercadoPago<input type="radio" name="pago" value="Contado">Contado </p>
    
    <label for="fname" class="click"><input type="button" value="Finalizar Compra" onclick="finalizarCompra(this)"/></label><br>
 
    <div visibility: hidden>
    <!-- <script
    src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
    data-preference-id="<?php //echo $data['preference']->id; ?>">
    console.log($data['preference']->id)
    </script> -->
    </div><br>

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
                url: 'https://localhost/nuevop/public/PuntoVenta/getTotalFactura/' + <?= $data['title']?>,
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
                        url: 'https://localhost/nuevop/public/Productos/getProductoXNomb/' + $("#field_id_Producto_chosen .chosen-single span").text(),
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
                        url: 'https://localhost/nuevop/public/Productos/getProductoXNomb/' + $("#field_id_Producto_chosen .chosen-single span").text(),
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
