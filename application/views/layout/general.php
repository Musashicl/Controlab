<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
<head>
     <title><? if (isset($title)){ echo $title;} ?></title>
     <meta http-equiv="content-type" content="application/xhtml; charset=UTF-8" />
     <SCRIPT type="text/javascript">
        CI_ROOT = "<?=base_url();?>";
     </SCRIPT>
     <link rel="stylesheet" type="text/css" href="<?=base_url();?>css/jquery-ui-1.8.21.css" />
     <link rel="stylesheet" type="text/css" href="<?=base_url();?>css/style.css" />
     <link rel="stylesheet" type="text/css" href="<?=base_url();?>css/ui.jqgrid.css" />
     <script type="text/javascript" src="<?=base_url();?>javascript/jquery-1.10.2.js" ></script>
     <script type="text/javascript" src="<?=base_url();?>javascript/jquery-ui-1.8.21.custom.min.js"></script>
     <script type="text/javascript" src="<?=base_url();?>javascript/jquery.jqGrid.min.js"></script>
     <script type="text/javascript" src="<?=base_url();?>javascript/i18n/grid.locale-en.js"></script>
     <link rel="stylesheet" type="text/css" href="<?=base_url();?>css/validationEngine.jquery.css" />
     <script type="text/javascript" src="<?=base_url();?>javascript/jquery.validationEngine-es.js" ></script>
     <script type="text/javascript" src="<?=base_url();?>javascript/jquery.validationEngine.js" ></script>
     <script type="text/javascript" src="<?=base_url();?>javascript/controlab.js"> </script>
     <script type="text/javascript" src="<?=base_url();?>javascript/jquery-ui-timepicker-addon.js" ></script>
     
     
      <!--[if lt IE 8.]>
    <link rel="stylesheet" type="text/css" href="css/style-ie.css" />
    <![endif]-->
     <!--[if lt IE 7.]>
    <link rel="stylesheet" type="text/css" href="css/style-ie6.css" />
    <![endif]-->

    </head>

<body>
    
<div id="main_body"> <!-- Main Body Starts Here -->
    <div id="top_part"> <!-- Top Part Starts Here -->
        <div id="top_part_image"> <!-- Top Part Image Starts Here -->
            <div id="main_logo"> <!-- Logo Part Starts Here -->
                <a href="http://www.ima.cl"><img src="<?=base_url();?>images/logo.png"  alt="LogoIMA"  /></a>
            </div> <!-- Logo Part Ends Here -->
        </div> <!-- Top Part Image Ends Here -->

    <div id="main_menu_bg"> <!-- Main Menu Starts Here -->
        <div id="main_menu_body"><!-- Main Menu Body Starts Here -->
            <? $this->load->view('layout/appmenu/menu'); ?>
        </div> <!-- Main Menu Body Ends Here -->
    </div><!-- Main Menu Ends Here -->
    </div> <!-- Top Part Ends Here -->

<div id="ajaxLoadAni">
    <img src="<?=base_url();?>images/ajax-loader.gif" alt="Ajax Loading Animation" />
    <span>Cargando...</span>
</div>  
    
<div id="content_body"> <!-- Content Body Starts Here -->

<? if(isset($page)) {$this->load->view($page); }else { echo "<div id=\"grid_fill\"></div>"; }?>
    
</div>  <!-- Content Body Ends Here -->


<div id="dialog" title="titulo"><span></span></div>
<div id="eliminarDialog" title="Eliminar Ingreso"><span></span></div>
<div id="equipoDialog" title="Detalle de Equipo"></div>
<div id="ingresoDialog" title="Ingreso de Equipo"><span></span></div>
	



<div class="clear"><!-- Clear -->
</div><!-- Clear -->


<? $this->load->view('layout/footer'); ?>    


</div><!-- Main Body Ends Here -->
<div id="infoEquipoPop">  
    <a id="popupEquipoClose">&nbsp;&nbsp;&nbsp;</a>  
    <div id="popEquipoContent"></div>
</div>  
    <div id="backgroundPopup"></div>  


 </body>
</html>
