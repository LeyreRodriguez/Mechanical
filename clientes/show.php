<?php declare(strict_types=1);

$conn = require "../database.php";

$stm = $conn->prepare("select * from clientes where CodCliente = :CodCliente");
$stm -> execute(array(':CodCliente' => $_GET['CodCliente']));

$cliente = $stm->fetch();

$stm = null;
$conn = null;

?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/mainPageCSS.css">
    <title>Clientes</title>
</head>
<body>
    

    <table>
        <tr>
            <th>Codigo Cliente</th><th>DNI</th><th>Apellidos</th><th>Nombre</th><th>Direccion</th><th>Telefono</th>
        </tr>
        <td><?=$cliente['CodCliente'] ?></td>
        <td><?=$cliente['DNI'] ?></td>
        <td><?=$cliente['Apellidos'] ?></td>
        <td><?=$cliente['Nombre'] ?></td>
        <td><?=$cliente['Direccion'] ?></td>
        <td><?=$cliente['Telefono'] ?></td>
    </table>  

    <button id="new" onclick="location.href='../clientes/clientes.php'">Ver todas</button>
    <button id="new" onclick="location.href='../clientes/form.php?CodCliente=<?=$cliente['CodCliente']?>'">Modificar</button>
    <button id="new" onclick="location.href='../clientes/delete.php?CodCliente=<?=$cliente['CodCliente']?>'">Eliminar</button>      

</body>
</html>