<?php declare(strict_types=1);

$conn = require "../database.php";

$stm = $conn->prepare("select * from vehiculos where Matricula =:Matricula");
$stm -> execute(array(':Matricula' => $_GET['Matricula']));

$vehiculo = $stm->fetch();

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
    <title>Vehiculos</title>
</head>
<body>
    <table>

        <tr>
            <th>Matricula</th><th>Marca</th><th>Modelo</th><th>Color</th><th>FechaMatriculacion</th><th>CodCliente</th>
        </tr>
        <td><?=$vehiculo['Matricula'] ?></td>
        <td><?=$vehiculo['Marca'] ?></td>
        <td><?=$vehiculo['Modelo'] ?></td>
        <td><?=$vehiculo['Color'] ?></td>
        <td> <?=$vehiculo['FechaMatriculacion'] ?></td>
        <td> <?=$vehiculo['CodCliente'] ?></td>




    </table>
    <button id="new" onclick="location.href='../vehiculos/vehiculos.php'">Ver todas</button>
    <button id="new" onclick="location.href='../vehiculos/form.php?Matricula=<?=$vehiculo['Matricula']?>'">Modificar</button>
    <button id="new" onclick="location.href='../vehiculos/delete.php?Matricula=<?=$vehiculo['Matricula']?>'">Eliminar</button>
</body>
</html>