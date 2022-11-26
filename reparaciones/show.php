<?php declare(strict_types=1);

$conn = require "../database.php";

$stm = $conn->prepare("select * from reparaciones where IdReparacion =:IdReparacion");
$stm -> execute(array(':IdReparacion' => $_GET['IdReparacion']));

$reparacion = $stm->fetch();

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
    <title>Reparaciones</title>
</head>
<body>
    <table>

        <tr>
        <th>Id Reparacion</th><th>Matricula</th><th>FechaEntrada</th><th>Km</th><th>Averia</th><th>FechaSalida</th><th>Reparado</th><th>Observaciones</th>
        </tr>
        <td><?=$reparacion['IdReparacion'] ?></td>
        <td><?=$reparacion['Matricula'] ?></td>
        <td><?=$reparacion['FechaEntrada'] ?></td>
        <td> <?=$reparacion['Km'] ?></td>
        <td> <?=$reparacion['Averia'] ?></td>
        <td> <?=$reparacion['FechaSalida'] ?></td>
        <td> <?=$reparacion['Reparado'] ?></td>
        <td> <?=$reparacion['Observaciones'] ?></td>
    



    </table>
    <button id="new" onclick="location.href='../reparaciones/reparaciones.php'">Ver todas</button>
    <button id="new" onclick="location.href='../reparaciones/form.php?IdReparacion=<?=$reparacion['IdReparacion']?>'">Modificar</button>
    <button id="new" onclick="location.href='../reparaciones/delete.php?IdReparacion=<?=$reparacion['IdReparacion']?>'">Eliminar</button>
  

</body>
</html>