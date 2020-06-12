<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu tienda de confianza</title>
    <!-- Sobre la BBDD tienda.sql utilizada en los ejercicios de clase deberá hacer lo siguiente:

Implementar una página para realizar pedidos de productos con las siguientes especificaciones:

La página mostrará un desplegable cargando los nombres de los clientes.
Al cargar la página por primera vez listará en una tabla todos los productos, mostrando de cada uno un checkbox, el nombre(Corto),Familia, Precio de los productos, Cantidad Disponible y la Cantidad Pedida.
A la hora de listar los productos se deberá poder filtrar por familia, por rango de precios o la combinación de ambos.
-->
</head>
<body>
<?php

    require_once "Cliente.php";
    require_once "daoCliente.php";
    require_once "Producto.php";
    require_once "daoProducto.php";
    require_once "Familia.php";
    require_once "daoFamilia.php";

    $daoProducto=new daoProducto("tarea 5"); 

    if(isset($_POST['Filtrar'])){

        $preciominimo = $_POST['preciominimo'];
        $preciomaximo= $_POST['preciomaximo'];

        $familia = new Familia();
        $familia->__SET("cod", $_POST['FiltroFamilia']); 

        $daoProducto->FiltrarProductos($familia, $preciominimo, $preciomaximo); 
    
    }else if(!isset($_POST['Filtrar'])){
        $daoProducto->Listar();     
    } 
?>

<form method="POST" name="formulario" action="<?php $_SERVER['PHP_SELF']?>">

<label for="Cliente"> Seleccione un cliente </label>
        <select name="Cliente" id="Cliente">
            <option value="-1">Seleccione un cliente</option>
        <?php 
            $daoCliente=new DaoCliente("tarea 5"); //Creo un objeto daoCliente y le paso la BBDD como parámetro, así conecta
            $daoCliente->Listar(); //llamo al método listar
            foreach ($daoCliente->Clientes as $key => $value) { //Dado que con listar lo que hago es rellenar el array de Clientes, accedo a él y lo recorro ya con normalidad. Recorro el array que he rellenado con el DAO y lo muestro
                echo "<option value='" . $value->NIF . "'>" . $value->Apellido1 ." ". $value->Nombre . "</option>";
                }
        ?>    
        </select>


<p>Puede filtrar por familia de productos, por precio o por una combinación de ambos</p>
<label for="FiltroFamilia"> Seleccione por qué familia de productos quiere filtrar </label>
<select name="FiltroFamilia" id="FiltroFamilia">
    <option value="-1">Seleccione una familia por la que filtrar</option>
        <?php 
          $daoFamilia=new daoFamilia("tarea 5");  //Creo un objeto daoFamilia y le paso la BBDD como parámetro, así conecta
          $daoFamilia->Listar(); //llamo al método listar
                foreach ($daoFamilia->Familias as $key => $value) { //Dado que con listar lo que hago es rellenar el array de Familias, accedo a él y lo recorro ya con normalidad. Recorro el array que he rellenado con el DAO y lo muestro
                    echo "<option value='" . $value->cod . "'>" . $value->nombre . "</option>";
                }
        ?>    
</select>
<br><br>
<label for="preciominimo"> Precio Mínimo </label>
<input type="text" name="preciominimo" id="preciominimo">
<br><br>
<label for="preciomaximo"> Precio Máximo </label>
<input type="text" name="preciomaximo" id="preciomaximo">
<br><br>
<input type="submit" name="Filtrar" value="Filtrar"/>




        <table>
    <tr>
        <th></th>
        <th>Nombre (corto)</th>
        <th>Familia</th>
        <th>Precio de los productos</th>
    </tr>
    
    <?php
     
        foreach ($daoProducto->Productos as $key => $producto) { //Como ya hice el listar arriba, simplemente recorro el array que he rellenado con dicho método y voy poniendo los names y values que me permitan mostrarlo en formato tabla
            echo "<tr>";

            echo "<td>";
            echo "<input type='checkbox' name='Productos[]' value='".$producto->cod."'>";
            echo "</td>";

            echo "<td>";
            echo "<input type='text' name='".$producto->cod."_nombreCorto' value='".$producto->nombre_corto."'>"; 
            echo "</td>";

            echo "<td>";
            echo "<input type='text' name='".$producto->cod."_familia' value='".$producto->familia."'>";
            echo "</td>";

            echo "<td>";
            echo "<input type='text' name='".$producto->cod."_PVP' value='".$producto->PVP."'>";
            echo "</td>";

            echo "</tr>"; 

        }

    ?>

</form>

    
</body>
</html>