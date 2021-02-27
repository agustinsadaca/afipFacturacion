<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
<?= $menu; ?>

</html>