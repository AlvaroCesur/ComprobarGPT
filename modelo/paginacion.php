<?php

    require_once("Conectar.php");
    $base=Conectar::conexion();

    $registros_por_pagina=5; /* CON ESTA VARIABLE INDICAREMOS EL NUMERO DE REGISTROS QUE QUEREMOS POR PAGINA*/
    $estoy_en_pagina=1;/* CON ESTA VARIABLE INDICAREMOS la pagina en la que estamos*/
    
    if (isset($_GET["pagina"])){
    $estoy_en_pagina=$_GET["pagina"];				
    }
    
    $empezar_desde=($estoy_en_pagina-1)*$registros_por_pagina;
    
    $sql_total="SELECT * FROM productos";
    /* CON LIMIT 0,3 HACE LA SELECCION DE LOS 3 REGISTROS QUE HAY EMPEZANDO DESDE EL REGISTRO 0*/
    $resultado=$base->prepare($sql_total);
    $resultado->execute(array());
    
    $num_filas=$resultado->rowCount(); /* nos dice el numero de registros del reusulset*/
    $total_paginas=ceil($num_filas/$registros_por_pagina); /* FUNCION CEIL REDONDEA EL RESULTADO*/

    /* CON ESTA VARIABLE INDICAREMOS EL NUMERO DE REGISTROS QUE QUEREMOS POR PAGINA*/

?>