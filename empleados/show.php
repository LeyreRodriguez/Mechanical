<?php declare(strict_types=1);

$conn = require "../database.php";

$stm = $conn->prepare("select * from empleados where CodEmpleado = :CodEmpleado");
$stm -> execute(array(':CodEmpleado' => $_GET['CodEmpleado']));

$empleado = $stm->fetch();

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
    <title>empleados</title>
</head>
<body>
<table>
        <tr>
            <th>Codigo Empleado</th><th>DNI</th><th>Nombre</th><th>Apellidos</th><th>Direccion</th><th>Telefono</th><th>CP</th><th>FechaAlta</th><th>Categoria</th>
        </tr>
        <td><?=$empleado['CodEmpleado'] ?></td>
        <td><?=$empleado['DNI'] ?></td>
        <td><?=$empleado['Apellidos'] ?></td>
        <td><?=$empleado['Nombre'] ?></td>
        <td><?=$empleado['Direccion'] ?></td>
        <td><?=$empleado['Telefono'] ?></td>
        <td><?=$empleado['CP'] ?></td>
        <td><?=$empleado['FechaAlta'] ?></td>
        <td><?=$empleado['Categoria'] ?></td>
    </table>  

    <button id="new" onclick="location.href='../empleados/empleados.php'">Ver todas</button>
    <button id="new" onclick="location.href='../empleados/form.php?CodEmpleado=<?=$empleado['CodEmpleado']?>'">Modificar</button>
    <button id="new" onclick="location.href='../empleados/delete.php?CodEmpleado=<?=$empleado['CodEmpleado']?>'">Eliminar</button>    
   

</body>
</html>