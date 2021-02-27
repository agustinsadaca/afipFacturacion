
<style>
 /* The navigation menu */
body{
  font-family: arial;
  margin: 0px;
}


 .navbar {
  overflow: hidden;
  background-color: #ce1f26;
}

/* Navigation links */
.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: left;
  padding: 8px 16px;
  text-decoration: none;
}

/* The subnavigation menu */
.subnav {
  float: left;
  overflow: hidden;
}

/* Subnav button */
.subnav .subnavbtn {
  font-size: 16px;
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  font-weight: 600;
  margin: 0;
}

/* Add a red background color to navigation links on hover */
.navbar a:hover, .subnav:hover .subnavbtn {
  background-color: #eee;
  color: #ce1f26;
}

/* Style the subnav content - positioned absolute */
.subnav-content {
   display: none;
  position: absolute;
  /* left: 0; */
  background-color: #ce1f26;
  width: auto;
  z-index: 1; 
  left: unset;
  flex-direction: column;
  margin-top:46px;
 
}

/* Style the subnav links */
.subnav-content a {
  float: left;
  color: white;
  text-decoration: none;
}

/* Add a grey background color on hover */
.subnav-content a:hover {
  background-color: #eee;
  color: #ce1f26;
}

/* When you move the mouse over the subnav container, open the subnav content */
/* .subnav{
  position: relative;
}  */

.subnav:hover .subnav-content {
  display: flex;
} 
</style>

 <!-- Load font awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- The navigation menu -->
<div class="navbar">
<?php foreach ($this->data as $menu_nombre => $menues) { ?>
  <div class="subnav">
    <a href="<?= base_url().'/'.$menues['menu']['url'];?>" class="subnavbtn"><?= $menu_nombre;?> <?php if(count($menues['submenu'])){ ?><i class="fa fa-caret-down"><?php }?></i></a>
    <div class="subnav-content">
     <?php foreach ($menues['submenu'] as $key => $submenu) { ?>
        <a href="<?= base_url().'/'.$submenu['url'];?>"><?= $submenu['nombre'];?></a>
     <?php } ?> 
     </div>
  </div>
<?php }?>
 
</div> 