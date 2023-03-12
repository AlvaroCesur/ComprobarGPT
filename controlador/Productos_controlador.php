<?php
  require_once("./modelo/Productos_modelo.php");
  $producto=new Productos_model();
  $registros=$producto->get_productos();
  require_once("./vista/Productos_view.php");
?>