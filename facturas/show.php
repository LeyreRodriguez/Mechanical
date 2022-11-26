<?php declare(strict_types=1);

$conn = require "../database.php";

$stm = $conn->prepare("select * from facturas where IdFactura = :IdFactura");
$stm -> execute(array(':IdFactura' => $_GET['IdFactura']));

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
            <th>ID Factura</th><th>Fecha</th><th>Código del cliente</th><th>Id Reparación</th>
        </tr>
        <td><?=$facturas['IdFactura'] ?></td>
        <td><?=$facturas['Fecha'] ?></td>
        <td><?=$facturas['CodCliente'] ?></td>
        <td><?=$facturas['IdReparacion'] ?></td>

    </table>
    <button id="new" onclick="location.href='../facturas/facturas.php'">Ver todas</button>
    <button id="new" onclick="location.href='../facturas/form.php?IdFactura=<?=$facturas['IdFacturas']?>'">Modificar</button>
    <button id="new" onclick="location.href='../facturas/delete.php?IdFactura=<?=$empleado['IdFactura']?>'">Eliminar</button>    
   
</body>
</html>