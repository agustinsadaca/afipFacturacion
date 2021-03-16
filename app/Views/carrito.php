<!DOCTYPE html>
<html>
<head>
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
    border:0;
    outline:none;
}
.bcode:hover{
    border:0;
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
<form id="formulario">
  <label for="fname">Total</label><span id="totalCompra" name="totalCompra" ></span>
  <span id="valorTotal"></span><br>
  <span>Paga con: </span><input id="pagaCon" /><br>
  <span>Vuelto : </span><input id="vuelto" type="text" readonly><br>
  <label for="fname"><a href="<?php echo base_url()?>/PuntoVenta/venta"><input type="button" value="Finalizar Compra"/></a></label><br>

<div class="click" style="padding-bottom:500px">

    <p><?php echo $data['total']?></p>

</div>
<script type="text/javascript" >
       
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
                    var vuelto = totalFact-pagaCon
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
                        $("input[name=precio]").val(prodJson.precio);
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
                        $("input[name=precio]").val(prodJson.precio);
                        $("input[name=cod_barras]").val(prodJson.cod_barras);

                        // $("#precio_input_box").trigger("chosen:updated");
                        // $("#field_productos_chosen .chosen-single span").trigger("click")
                        // $("#field_productos_chosen .chosen-single span").trigger("click")
                        
                    })
               }});
            });



    //     $(document).ready(function(){
    //     $(".field-form").click(function(){
    //         $.getJSON("/add.php",{id: $(this).val(), ajax: 'true'}, function(j){
    //             var options = '';
    //             for (var i = 0; i < j.length; i++) {
    //                  options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
                  
                   
    //   }
      
    // }}}
        // var campoDeseleccion = document.getElementsByClassName("fg-toolbar");
        // var campoDeseleccion2 = document.getElementsByClassName("ui-state-default");
        // document.addEventListener("click", function(){
        //     document.getElementsByClassName("bcode")[0].focus();
        // });
</script>

</body>
</html>
