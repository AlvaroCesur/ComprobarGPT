<?php

$fotito_nombre = $_FILES['imagen']['name'];
$fotito_tipo = $_FILES['imagen']['type'];
$fotito_tamano = $_FILES['imagen']['size'];

if ($fotito_tamano <= 3000000) {

  if ($fotito_tipo == "image/jpeg" || $fotito_tipo == "image/jpg" || $fotito_tipo == "image/png" || $fotito_tipo == "image/gif"){

  

    $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/CRUD_MODELO_VISTA_CONTROLADOR/fotos_subidas/';

    move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino . $fotito_nombre);

    echo "Se ha subido la imagen correctamente";

  }else {
    echo "Sólo se pueden subir imágenes jpg/jpeg/png/gif";
  }

} else {
    echo "El tamaño es demasiado grande";
}

try {
  $conexion=new PDO('mysql:host=localhost; dbname=pruebas', 'root', '');
  $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conexion->exec("SET CHARACTER SET UTF8");

  // obtener el último registro de la tabla
  $sql_last = "SELECT * FROM productos ORDER BY CODIGOARTICULO DESC LIMIT 1";
  $resultado_last = $conexion->query($sql_last);
  $ultimo_registro = $resultado_last->fetch(PDO::FETCH_ASSOC);

  // obtener el código del último registro
  $codigo_ultimo_registro = $ultimo_registro['CODIGOARTICULO'];

  // incrementar el código para insertar el nuevo registro
  $nuevo_codigo = "AR" . str_pad((intval(substr($codigo_ultimo_registro, 2)) + 1), 2, '0', STR_PAD_LEFT);

  $sql = "INSERT INTO productos (CODIGOARTICULO, FOTO) VALUES (:nuevo_codigo, :fotito_nombre)";
  $resultado = $conexion->prepare($sql);
  $resultado->execute(array(':nuevo_codigo' => $nuevo_codigo, ':fotito_nombre' => $fotito_nombre));

} catch(Exception $e) {
  die('Error' . $e->getMessage());
  echo "Linea del error" . $e->getLine();
}

header("location:index.php");

?>