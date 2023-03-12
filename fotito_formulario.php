<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="vista/hoja.css">
    <title>Editar Imagen</title>
</head>
<body>
<?php

if(isset($_POST['submit'])) {

  $fotito_nombre = $_FILES['imagen']['name'];
  $fotito_tipo = $_FILES['imagen']['type'];
  $fotito_tamano = $_FILES['imagen']['size'];
  $codigo_articulo = $_POST['codigo_articulo'];

  if ($fotito_tamano <= 3000000) {

    if ($fotito_tipo == "image/jpeg" || $fotito_tipo == "image/jpg" || $fotito_tipo == "image/png" || $fotito_tipo == "image/gif"){

      $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/CRUD_MODELO_VISTA_CONTROLADOR/fotos_subidas/';

      move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino . $fotito_nombre);

      echo "Se ha subido la imagen correctamente";

      try {
        $conexion=new PDO('mysql:host=localhost; dbname=pruebas', 'root', '');
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexion->exec("SET CHARACTER SET UTF8");

        $sql = "UPDATE productos SET FOTO=:fotito_nombre WHERE CODIGOARTICULO=:codigo_articulo";
        $resultado = $conexion->prepare($sql);
        $resultado->execute(array(':fotito_nombre' => $fotito_nombre, ':codigo_articulo' => $codigo_articulo));

      } catch(Exception $e) {
        die('Error' . $e->getMessage());
        echo "Linea del error" . $e->getLine();
      }

      header("location:index.php");

    } else {
      echo "Sólo se pueden subir imágenes jpg/jpeg/png/gif";
    }

  } else {
    echo "El tamaño es demasiado grande";
  }

}

?>

<?php
// Obtener el codigo_articulo de la URL
$codigo_articulo = isset($_GET['codigo_articulo']) ? $_GET['codigo_articulo'] : null;

// Obtener los códigos de todos los artículos de la base de datos
try {
  $conexion=new PDO('mysql:host=localhost; dbname=pruebas', 'root', '');
  $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conexion->exec("SET CHARACTER SET UTF8");

  $sql = "SELECT CODIGOARTICULO FROM productos";
  $resultado = $conexion->query($sql);

  // Mostrar el formulario con el campo select predeterminado en el código del artículo actual
  ?>
  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
  <table class="formumagen">
    <td>
  <label for="imagen">Selecciona una imagen:</label><br>
    <input type="file" id="imagen" name="imagen"><br>
    <?php if ($codigo_articulo) { ?>
      <input type="hidden" name="codigo_articulo" value="<?php echo $codigo_articulo ?>">
    <?php } else { ?>
      <label for="codigo_articulo">Selecciona el código del artículo:</label><br>
      <select name="codigo_articulo" id="codigo_articulo">
        <?php while($codigo = $resultado->fetch(PDO::FETCH_ASSOC)) {
          $selected = $codigo_articulo == $codigo['CODIGOARTICULO'] ? 'selected' : '';
          echo "<option value='".$codigo['CODIGOARTICULO']."' ".$selected.">".$codigo['CODIGOARTICULO']."</option>";
        } ?>
      </select><br>
    <?php } ?>
    <input type="submit" name="submit" value="Subir imagen" class="subida">
    <input type="button" value="Volver" onclick="window.location.href='index.php'">
      </td>
    </table>
  </form>
  <?php

} catch(Exception $e) {
  die('Error' . $e->getMessage());
  echo "Linea del error" . $e->getLine();
}
?>
</body>
</html>


