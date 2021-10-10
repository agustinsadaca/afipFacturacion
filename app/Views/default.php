<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if (isset($data['js_files'])) {
    /* -------------------------------------------------------------------------- */
    /*                                 CSS import                                 */
    /* -------------------------------------------------------------------------- */
    foreach ($data['css_files'] as $file):
        // echo '<pre>';
        // var_dump($data['css_files']);die;
    ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php
endforeach;
}
/* -------------------------------------------------------------------------- */
/*                                   Titulo                                   */
/* -------------------------------------------------------------------------- */
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
</style>

<?=
/* -------------------------------------------------------------------------- */
/*                                  Menu Bar                                  */
/* -------------------------------------------------------------------------- */
$menu; ?>

<?php foreach($data['errors'] as $error) { 
/* -------------------------------------------------------------------------- */
/*                                   errores                                  */
/* -------------------------------------------------------------------------- */
?>
        <div  class="errors_validation">   
            <?php echo $error;?>
        </div>
<?php } ?>

	<div style='height: 30px;'></div>
    <div style="padding: 10px">

        <?php
/* -------------------------------------------------------------------------- */
/*                          CRUD tabla de GroceryCrud                         */
/* -------------------------------------------------------------------------- */
if (isset($data['output'])) {
    echo $data['output'];
}
?>

    </div>
    <?php
/* -------------------------------------------------------------------------- */
/*                                 JS imports                                 */
/* -------------------------------------------------------------------------- */
    if (isset($data['js_files'])) {
    foreach ($data['js_files'] as $file): ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach;
}?>

</body>
</html>
