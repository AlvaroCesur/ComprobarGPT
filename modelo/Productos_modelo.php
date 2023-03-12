<?php
 class Productos_model {
  private $db;
  private $productos;

  public function __construct() {
    require_once("./modelo/Conectar.php");
    $this->db = Conectar::conexion();
    $this->productos = array();
  }


  public function get_productos() {
    require("paginacion.php");
    if (isset($_POST["cr"])) {
      $codigoarticulo = $_POST["CODIGOARTICULO"];
      $seccion = $_POST["SECCION"];
      $nombrearticulo = $_POST["NOMBREARTICULO"];
      $precio = $_POST["PRECIO"];
      $fecha = $_POST["FECHA"];
      $importado = $_POST["IMPORTADO"];
      $paisdeorigen = $_POST["PAISDEORIGEN"];
      $fotito=$_POST["FOTO"];
   


      $sql = "INSERT INTO productos (CODIGOARTICULO, SECCION, NOMBREARTICULO, PRECIO, FECHA, IMPORTADO, PAISDEORIGEN) VALUES(:codigoArticulo, :seccion, :nombreArticulo, :precio, :fecha, :importado, :paisDeOrigen)";
      $resultado = $this->db->prepare($sql);
      $resultado->execute(array(":codigoArticulo" => $codigoarticulo, ":seccion" => $seccion, ":nombreArticulo" => $nombrearticulo, ":precio" => $precio, ":fecha" => $fecha, ":importado" => $importado, ":paisDeOrigen" => $paisdeorigen));

      header("location:index.php");
    }

    if (isset($_POST["submit"]) && !empty($_POST["busqueda"])) {
      $busqueda = "%" . $_POST["busqueda"] . "%";
      $consulta = $this->db->prepare("SELECT * FROM productos WHERE CODIGOARTICULO LIKE :busqueda OR SECCION LIKE :busqueda OR NOMBREARTICULO LIKE :busqueda OR PRECIO LIKE :busqueda OR FECHA LIKE :busqueda OR IMPORTADO LIKE :busqueda OR PAISDEORIGEN LIKE :busqueda OR FOTO LIKE :busqueda LIMIT :empezar_desde, :registros_por_pagina");
      $consulta->bindValue(":busqueda", $busqueda, PDO::PARAM_STR);
      $consulta->bindValue(":empezar_desde", $empezar_desde, PDO::PARAM_INT);
      $consulta->bindValue(":registros_por_pagina", $registros_por_pagina, PDO::PARAM_INT);
      $consulta->execute();
    } else {
      $consulta = $this->db->prepare("SELECT * FROM productos LIMIT :empezar_desde, :registros_por_pagina");
      $consulta->bindValue(":empezar_desde", $empezar_desde, PDO::PARAM_INT);
      $consulta->bindValue(":registros_por_pagina", $registros_por_pagina, PDO::PARAM_INT);
      $consulta->execute();
    }

    while($filas = $consulta->fetch(PDO::FETCH_ASSOC)) {
      $this->productos[] = $filas;
    }

    return $this->productos;
  }
}


/*
      if (isset($_POST["submit"]) && !empty($_POST["busqueda"])) {
    
        $codigoarticulo = "%" . $_POST["busqueda"] . "%";
        $seccion = "%" . $_POST["busqueda"] . "%";
        $nombrearticulo = "%" . $_POST["busqueda"] . "%";
        $precio = "%" . $_POST["busqueda"] . "%";
        $fecha = "%" . $_POST["busqueda"] . "%";
        $importado = "%" . $_POST["busqueda"] . "%";
        $paisdeorigen = "%" . $_POST["busqueda"] . "%";
    
        $consulta=$this->db->query("SELECT * FROM productos WHERE CODIGOARTICULO LIKE 'codigoArticulo' or SECCION LIKE 'seccion' or NOMBREARTICULO LIKE 'nombreArticulo' or PRECIO LIKE 'precio' or FECHA LIKE 'fecha' or IMPORTADO LIKE 'importado' or PAISDEORIGEN LIKE 'paisDeOrigen' LIMIT $empezar_desde, $registros_por_pagina");
        //$conexion->execute(array(":codigoArticulo" => $codigoarticulo, ":seccion" => $seccion, ":nombreArticulo" => $nombrearticulo, ":precio" => $precio, ":fecha" => $fecha, ":importado" => $importado, ":paisDeOrigen" => $paisdeorigen));
        //$registros = $conexion->fetchAll(PDO::FETCH_OBJ);
      } else {
        $consulta=$this->db->query("SELECT * FROM PRODUCTOS LIMIT $empezar_desde, $registros_por_pagina");
      }
      */

?>


