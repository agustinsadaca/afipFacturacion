<!DOCTYPE html>
<html>
<head>
        <link rel="stylesheet" href="<?php echo(base_url().'/bootstrap.min.css')?>"> 

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
    <script src="<?php echo (base_url().'/assets/grocery_crud/js/jquery-1.11.1.js')?>" type="text/javascript"></script>

</head>
<body>

<style>
.errors_validation{
    color:red;
    padding: 50px 0 0 10px ;
}
.table-content{border-top:#CCCCCC 4px solid; width:50%;}
.table-content th {padding:5px 20px; background: #F0F0F0;vertical-align:top;} 
.table-content td {padding:5px 20px; border-bottom: #F0F0F0 1px solid;vertical-align:top;} 
.fechaSearch{margin-left:10px;align-self: center;
}
.input-control{border-radius:4px;padding:4px;border-width: 2px;
   
}
.delete_all_button{top:0px!important;}
.navbar{display: block !important; padding: 0 !important;margin: 0 !important;}
.bfecha{margin-bottom:4px;margin-left:10px}
.flexigrid table tr.hDiv th, .flexigrid div.bDiv td {text-align: center!important;vertical-align:middle !important; }
.print{display: none !important}
.btn-sm {
    padding: .25rem .5rem;
    font-size: .875rem;
    line-height: 1.5;
    border-radius: .2rem;}
.btn-primary {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    box-shadow: none;}
.btn-primary:hover {
    color: #fff;
    background-color: #0069d9;
    border-color: #0062cc;
}
.checkbox1{
    -webkit-appearance: none;
	background-color: #fafafa;
	border: 1px solid #cacece;
	box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05);
	padding: 9px;
	border-radius: 3px;
	display: inline-block;
	position: relative;
}
.checkbox1:checked{
    background-color: #007bff;
	border: 1px solid #007bff;
	box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05), inset 15px 10px -12px rgba(255,255,255,0.1);
	color: #007bff;
}
.checkbox1:checked:after{
    content: '\2714';
	font-size: 14px;
	position: absolute;
	top: 0px;
	left: 3px;
	color: #fff;
}
.cabecera{
    display: flex;
    justify-content: space-between;
}
.status{
    align-self: center;
}
.labelsAppend{display: flex;}
.exito{
    background-color: #28a745 !important;
    width: 20% !important;
    border-bottom-left-radius:0;
    border-top-left-radius:0;
}
.fracaso{
    background-color: #dc3545 !important;
    width: 20% !important;
    border-bottom-left-radius:0;
    border-top-left-radius:0;
}
#ajax_refresh_and_loading{
    display:none;
}
</style>

<?= $menu; ?>

<?php foreach($data['errors'] as $error) { ?>
        <div  class="errors_validation">   
            <?php echo $error;?>
        </div>
<?php } ?>

	<div style='height: 30px;'></div>
    <div style="padding: 10px">
<?php 
$post_at = "";
$post_at_to_date = "";
?>
<div class="cabecera">
    <div class="fechaSearch">
    <form name="frmSearch" method="post" action="#" onsubmit="return myfunc(this);">
        <p class="search_input">
        <input type="text" placeholder="Fecha Desde" id="post_at" name="fechaDesde"  value="<?php echo $post_at; ?>" class="input-control" onchange='saveValue(this);' />
        <input type="text" placeholder="Fecha Hasta" id="post_at_to_date" name="fechaHasta" style="margin-left:10px"  value="<?php echo $post_at_to_date; ?>" class="input-control"  onchange='saveValue(this);'/>			 
        <input type="submit" id="goSubmit" name="go" value="Buscar por fecha" class="btn btn-primary btn-sm bfecha" >
        </p>
    </form>
    </div>
    <div class="status">
        <div class="input-group labelsAppend">
            <div class="input-group-prepend">
                <span class="input-group-text">Estado del servidor de Afip</span>
            </div>
            <input class="form-control inputLabel status" id="status" readonly >
        </div>

    </div>
    <div>
        <input type="button" name="enviarAfip" value="enviarAfip" onclick="afip()">
    </div>
</div>

<?php
if (isset($data['output'])) {
    echo $data['output'];
}

?></div>
<!-- 
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-1.9.1.js"></script> -->
<script src="<?php echo (base_url().'/assets/grocery_crud/js/jquery_plugins/ui/jquery-ui-1.10.3.custom.min.js')?>"></script>


</div>
<script>
$.datepicker.setDefaults({
showOn: "button",
});
    
document.getElementById("post_at").value = getSavedValue("post_at");    // set the value to this input
document.getElementById("post_at_to_date").value = getSavedValue("post_at_to_date");   // set the value to this input
    /* Here you can add more inputs to set value. if it's saved */
// console.log(localStorage.getSavedValue("post_at"))
    //Save the value function - save it to localStorage as (ID, VALUE)
function saveValue(e){
   
    var id = e.id;  // get the sender's id to save it . 
    var val = e.value; // get the value. 
    localStorage.setItem(id, val);// Every time user writing something, the localStorage's value will override . 
}

    //get the saved value function - return the value of "v" from localStorage. 
function getSavedValue(v){
    if (!localStorage.getItem(v)) {
        return "";// You can change this to your defualt value. 
    }
    return localStorage.getItem(v);
}
function afip() {
    var val = []
    $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
    });
   var resultado = JSON.stringify(val)
   $.ajax({
            async: false,
            method: "POST",
            data: {resultado},
            url: "<?php echo base_url()?>"+'/AfipFacturacion/guardarFacturasSeleccionadasAfip',
        }).done(function (prod) 
        {
            var prodJson = JSON.parse(prod)
        })
}

$(function() {

    function myfunc(){
        var fD = $('#post_at').value();
        var fH = $('#post_at_to_date').value();
        $.ajax({
            async: false,
            method: "POST",
            data: {fechaDes:fD,fechaHas:fH},
            url: "<?php echo base_url()?>"+'/afip/afip',
        }).done(function (prod) 
        {

            var prodJson = JSON.parse(prod)
 
            
        })
    }

if (<?php echo  $data['serverStatus']?>==true) {
    $("#status").val("OK");
    $("#status").addClass("exito");
} else {
    $("#status").val("Error");
    $("#status").addClass("fracaso");
}
document.getElementById("post_at").value = getSavedValue("post_at");    // set the value to this input
document.getElementById("post_at_to_date").value = getSavedValue("post_at_to_date");   // set the value to this input
    /* Here you can add more inputs to set value. if it's saved */
// console.log(localStorage.getSavedValue("post_at"))
    //Save the value function - save it to localStorage as (ID, VALUE)
function saveValue(e){
   
    var id = e.id;  // get the sender's id to save it . 
    var val = e.value; // get the value. 
    localStorage.setItem(id, val);// Every time user writing something, the localStorage's value will override . 
}

    //get the saved value function - return the value of "v" from localStorage. 
function getSavedValue(v){
    if (!localStorage.getItem(v)) {
        return "";// You can change this to your defualt value. 
    }
    return localStorage.getItem(v);
}

$("#post_at").datepicker();
$("#post_at_to_date").datepicker();
});
</script>

</body></html>

    <?php if (isset($data['js_files'])) {
    foreach ($data['js_files'] as $file): ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach;
}?>

</body>
</html>
