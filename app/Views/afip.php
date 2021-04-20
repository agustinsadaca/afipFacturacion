<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
<?php if (isset($data['js_files'])) {
    //  var_dump($data['js_files']);die;
    foreach ($data['css_files'] as $file):
        // echo '<pre>';
        // var_dump($data['css_files']);die;
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
.fechaSearch{margin-left:10px;margin-top:50px}
.input-control{border-radius:2px;padding:4px}
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
<div class="fechaSearch">
<form name="frmSearch" method="post" action="#" onsubmit="return myfunc(this);">
	<p class="search_input">
	<input type="text" placeholder="Fecha Desde" id="post_at" name="fechaDesde"  value="<?php echo $post_at; ?>" class="input-control" onchange='saveValue(this);' />
	<input type="text" placeholder="Fecha Hasta" id="post_at_to_date" name="fechaHasta" style="margin-left:10px"  value="<?php echo $post_at_to_date; ?>" class="input-control"  onchange='saveValue(this);'/>			 
	<input type="submit" id="goSubmit" name="go" value="Buscar por fecha" class="btn btn-primary btn-sm bfecha" >
    </p>
</form>
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
    console.log(e);
   
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
$(function() {
    function mifunc(){
        var fD = $('#post_at').value();
        var fH = $('#post_at_to_date').value();
        console.log(fD);
        $.ajax({
            async: false,
            method: "POST",
            data: {fechaDes:fD,fechaHas:fH},
            url: "<?php echo base_url()?>"+'/afip/afip',
        }).done(function (prod) 
        {

            var prodJson = JSON.parse(prod)
            console.log(prodJson);
 
            
        })
    }
document.getElementById("post_at").value = getSavedValue("post_at");    // set the value to this input
document.getElementById("post_at_to_date").value = getSavedValue("post_at_to_date");   // set the value to this input
    /* Here you can add more inputs to set value. if it's saved */
// console.log(localStorage.getSavedValue("post_at"))
    //Save the value function - save it to localStorage as (ID, VALUE)
function saveValue(e){
    console.log(e);
   
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
