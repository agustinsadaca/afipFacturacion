<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo(base_url().'/styles.css')?>"> 
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
<?= $menu; ?>

<section id="hero">
    <div class="container">
        <div class="content-center hhome" >
            <h1 class="mt-5 hometext1" >Casa Sadaca</h1>
            <p class="hometext phome">Casa Sadaca o como lo llaman de antaño "Las puertas azules", es un antiguo negocio familiar que data
                    de los comienzos del siglo XX</p>
        </div>
    </div>
    
</section>
<style>
    section#hero{
        background-image:url("<?php echo(base_url().'/26a.jpg')?>");
    }
</style>

</html>