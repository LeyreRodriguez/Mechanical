<?php declare(strict_types=1);

$conn = require "../database.php";

$stm = $conn->prepare("select * from recambios where IdRecambio = :IdRecambio");
$stm->execute(array(':IdRecambio' => $_GET['IdRecambio']));

$recambio = $stm->fetch();

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
    <title>Recambios</title>
</head>
<body>
    <table>

        <tr>
            <th>Id Recambio</th><th>Descripción</th><th>UnidadBase</th><th>Stock</th><th>PrecioReferencia</th>
        </tr>
        <td><?=$recambio['IdRecambio'] ?></td>
        <td><?=$recambio['Descripcion'] ?></td>
        <td><?=$recambio['UnidadBase'] ?></td>
        <td> <?=$recambio['Stock'] ?></td>
        <td> <?=$recambio['PrecioReferencia'] ?></td>
        

    </table>
    <button id="new" onclick="location.href='../recambios/recambios.php'">Ver todas</button>
    <button id="new" onclick="location.href='../recambios/form.php?IdRecambio=<?=$recambio['IdRecambio']?>'">Modificar</button>
    <button id="new" onclick="location.href='../recambios/delete.php?IdRecambio=<?=$recambio['IdRecambio']?>'">Eliminar</button>  
   

</body>
</html>