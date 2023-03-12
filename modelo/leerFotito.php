<?php
require("fotito.php");

try {
    $conexion=new PDO('mysql:host=localhost; dbname=pruebas', 'root', '');
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->exec("SET CHARACTER SET UTF8");
  
    $nombre_imagen = $_GET['nombre_imagen'];
  
    $sql = "SELECT FOTO FROM productos WHERE FOTO = :nombre_imagen";
    $resultado = $conexion->prepare($sql);
    $resultado->execute(array(':nombre_imagen' => $nombre_imagen));
    $fila = $resultado->fetch(PDO::FETCH_ASSOC);
  
   
  } catch(Exception $e) {
    die('Error' . $e->getMessage());
    echo "Linea del error" . $e->getLine();
  }
  ?>

  