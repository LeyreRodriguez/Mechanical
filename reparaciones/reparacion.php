<?php declare(strict_types=1);

$conn = require "../database.php";

$stm = $conn->query("select * from reparaciones order by IdReparacion");
$stm->execute();
$reparaciones = $stm->fetchAll();

$stm = null;
$conn = null;

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="../css/mainPageCSS.css">
</head>
<body>
    <div class="root">
        <nav class="sidebar">
            <div class="burger-icon">
                <i class="fas fa-bars"></i>
            </div>
            <ul class="menu">
                <li class="menu__item">
                    <i id="clientesIcon" onclick="location.href='../clientes/clientes.php'" class="fas fa-user"></i>
                    <a id="clientesInfo"  href="../clientes/clientes.php" class="menu__link">Clientes</a>
                </li>
                <li class="menu__item">
                    <i id="facturasIcon" onclick="location.href='../facturas/facturas.php'" class="fas fa-solid fa-money-bill"></i>
                    <a id="facturasInfo" href="../facturas/facturas.php" class="menu__link">Facturas</a>
                </li>
                <li class="menu__item">
                    <i id="reparacionIcon" onclick="location.href='../reparaciones/reparacion.php'" class="fas fa-solid fa-toolbox"></i>
                    <a id="reparacionInfo" href="../reparaciones/reparacion.php" class="menu__link">Reparaciones</a>
                </li>

                <li class="menu__item">
                    <i id="reparacionIcon" onclick="location.href='../vehiculos/vehiculos.php'" class="fas fa-sharp fa-solid fa-car-side"></i>
                    <a id="reparacionInfo" href="../vehiculos/vehiculos.php" class="menu__link">Vehiculos</a>
                </li>

                <li class="menu__item">
                    <i id="reparacionIcon" onclick="location.href='../empleados/empleados.php'" class="fas fa-sharp fa-solid fa-briefcase"></i>
                    <a id="reparacionInfo" href="../empleados/empleados.php" class="menu__link">Empleados</a>
                </li>
                <li class="menu__item">
                    <i id="reparacionIcon" onclick="location.href='../recambios/recambios.php'" class="fas fa-sharp fa-solid fa-hammer"></i>
                    
                    <a id="reparacionInfo" href="../recambios/recambios.php" class="menu__link">Recambios</a>
                </li>
                <li class="menu__item">
                    <i id="reparacionIcon" onclick="location.href='../actuaciones/actuaciones.php'" class="fas fa-sharp fa-solid fa-stopwatch"></i>
                   
                    <a id="reparacionInfo" href="../actuaciones/actuaciones.php" class="menu__link">Actuaciones</a>
                </li>
                
            </ul>
        </nav>
        <section class="main-content">
            <section class="content">

                <div class="Facturas">
                    <h1 class="page-title">REPARACION</h1>
              
                    <button id="new" onclick="location.href='../reparaciones/form.php'">Nueva Reparacion</button>
                    
                    <table>
                        <tr>
                            <th>Id Reparacion</th><th>Matricula</th><th>FechaEntrada</th><th>Km</th><th>Averia</th><th>FechaSalida</th><th>Reparado</th><th>Observaciones</th>
                        </tr>

                        <?php foreach($reparaciones as $j): ?>
                            <tr>
                                <td>
                                    <a href="show.php?IdReparacion=<?=$j['IdReparacion']?>">
                                        <?=$j['IdReparacion']?>
                                    </a>
                                </td>
                                <td><?=$j['Matricula']?></td>
                                <td><?=$j['FechaEntrada']?></td>
                                <td><?=$j['Km']?></td>
                                <td><?=$j['Averia']?></td>
                                <td><?=$j['FechaSalida']?></td>
                                <td><?=$j['Reparado']?></td>
                                <td><?=$j['Observaciones']?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>

                    
                  
                </div>
                
            </section>
        </section>

    </div>
    <script type="text/javascript" src="../javaScript/mainPageJS.js"></script>
</body>
</html>
