<?php declare(strict_types=1);

$conn = require "../database.php";

$stm = $conn->prepare("select * from actuaciones where Referencia = :Referencia");
$stm->execute(array(':Referencia' => $_GET['Referencia']));

$actuacion = $stm->fetch();

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
    <title>Actuaciones</title>
</head>
<body>



    <table>
        <tr>
            <th>Referencia</th><th>Descripción</th><th>TiempoEstimado</th><th>Importe</th>
        </tr>
        <td><?=$actuacion['Referencia'] ?></td>
        <td><?=$actuacion['Descripcion'] ?></td>
        <td><?=$actuacion['TiempoEstimado'] ?></td>
        <td><?=$actuacion['Importe'] ?></td>
    </table>  

    <button id="new" onclick="location.href='../actuaciones/actuaciones.php'">Ver todas</button>
    <button id="new" onclick="location.href='../actuaciones/form.php?Referencia=<?=$actuacion['Referencia']?>'">Modificar</button>
    <button id="new" onclick="location.href='../actuaciones/delete.php?Referencia=<?=$actuacion['Referencia']?>'">Eliminar</button>                

    
</body>
</html>