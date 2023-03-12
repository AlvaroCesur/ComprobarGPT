<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Crud MVC</title>
</head>

<body>

  <?php
    require("./modelo/paginacion.php");
  ?>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table width="50%" border="0" align="center">

      <tr>
      <tr>
        <td colspan="9" class="primera_fila">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="busqueda" placeholder="Introduzca la busqueda">
            <input type="submit" name="submit" value="Buscar">
            <a href="index.php"><button>Volver</button></a>
          </form>
        </td>
      </tr>
      <tr>
        <td class="primera_fila">CODIGOARTICULO</td>
        <td class="primera_fila">SECCION</td>
        <td class="primera_fila">NOMBREARTICULO</td>
        <td class="primera_fila">PRECIO</td>
        <td class="primera_fila">FECHA</td>
        <td class="primera_fila">IMPORTADO</td>
        <td class="primera_fila">PAISDEORIGEN</td>
        <td class="primera_fila">FOTO</td>
        <td class="primera_fila">ACCIONES</td>
        <td class="sin">&nbsp;</td>
        <td class="sin">&nbsp;</td>
        <td class="sin">&nbsp;</td>
      </tr>

      <?php
        foreach ($registros as $articulo): ?>
      <tr>

        <td>
          <?php echo $articulo["CODIGOARTICULO"] ?>
        </td>
        <td>
          <?php echo $articulo["SECCION"] ?>
        </td>
        <td>
          <?php echo $articulo["NOMBREARTICULO"] ?>
        </td>
        <td>
          <?php echo $articulo["PRECIO"] ?>
        </td>
        <td>
          <?php echo $articulo["FECHA"] ?>
        </td>
        <td>
          <?php echo $articulo["IMPORTADO"] ?>
        </td>
        <td>
          <?php echo $articulo["PAISDEORIGEN"] ?>
        </td>
        <td>
        <img src="/CRUD_MODELO_VISTA_CONTROLADOR/fotos_subidas/<?php echo $articulo["FOTO"]; ?>" alt="Suba su imagen" width = "30%">
        </td>
        <td ><a href="modelo/borrar.php?CODIGOARTICULO=<?php echo $articulo["CODIGOARTICULO"] ?>"><input type='button' name='del' id='del'
              value='Borrar'></a><a
            href="modelo/editar.php?CODIGOARTICULO=<?php echo $articulo["CODIGOARTICULO"] ?> & SECCION=<?php echo $articulo["SECCION"] ?> & NOMBREARTICULO=<?php echo $articulo["NOMBREARTICULO"] ?> & PRECIO=<?php echo $articulo["PRECIO"] ?>& FECHA=<?php echo  $articulo["FECHA"] ?> & IMPORTADO=<?php echo $articulo["IMPORTADO"] ?> & PAISDEORIGEN=<?php echo $articulo["PAISDEORIGEN"] ?>"><input
              type='button' name='up' id='up' value='Actualizar'></a></td>
        
              

      </tr>

      <?php

endforeach;

?>




<tr>
  <td><input type='text' name='CODIGOARTICULO' size='10' class='centrado'></td>
  <td><input type='text' name='SECCION' size='10' class='centrado'></td>
  <td><input type='text' name='NOMBREARTICULO' size='10' class='centrado'></td>
  <td><input type='text' name='PRECIO' size='10' class='centrado'></td>
  <td><input type='text' name=' FECHA' size='10' class='centrado'></td>
  <td><input type='text' name=' IMPORTADO' size='10' class='centrado'></td>
  <td><input type='text' name=' PAISDEORIGEN' size='10' class='centrado'></td>
  <td><input type="file" name="imagen" form="formulario_imagen" size='10' class='centrado'></td>
  <td ><input type='submit' name='imagen' id='cr' form="formulario_imagen" value='Insertar' ><input type='submit' name='imagen' id='cr' form="formulario_fotito" value='Sube o edita la imagen'></td>
  
  
<tr>
  <td colspan="9">

    <?php
    /*-------------------------PAGINACION-----------------*/

    for ($i = 1; $i <= $total_paginas; $i++) {
      echo "<a href='?pagina=" . $i . "'>" . $i . "</a>  ";
    }

    ?>
  </td>
</tr>
</tr>

</table>
</form>

<form action="fotito.php" method="post" enctype="multipart/form-data" id="formulario_imagen"></form>
<form action="fotito_formulario.php" method="post" enctype="multipart/form-data" id="formulario_fotito"></form>

</body>
</html>