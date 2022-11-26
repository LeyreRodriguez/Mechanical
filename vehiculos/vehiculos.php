<?php declare(strict_types=1);

$conn = require "../database.php";

$stm = $conn->query("select * from vehiculos order by Matricula");
$stm->execute();
$vehiculos = $stm->fetchAll();

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

                <div class="Vehiculos">
                    <h1>Listado de vehiculos</h1>
                    <button id="new" onclick="location.href='../vehiculos/form.php'">Nuevo vehiculo</button>
                        <table>
                            <tr>
                                <th>Matricula</th><th>Marca</th><th>Modelo</th><th>Color</th><th>FechaMatriculacion</th><th>CodCliente</th>
                            </tr>

                            <?php foreach($vehiculos as $vehiculo): ?>
                                <tr>
                                    <td>
                                        <a href="../vehiculos/show.php?Matricula=<?=$vehiculo['Matricula']?>">
                                            <?=$vehiculo['Matricula']?>
                                        </a>
                                    </td>
                                    <td><?=$vehiculo['Marca']?></td>
                                    <td><?=$vehiculo['Modelo']?></td>
                                    <td><?=$vehiculo['Color']?></td>
                                    <td><?=$vehiculo['FechaMatriculacion']?></td>
                                    <td><?=$vehiculo['CodCliente']?></td>
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
