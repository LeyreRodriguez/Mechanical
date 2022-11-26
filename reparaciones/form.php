<?php declare (strict_types=1);

if (isset($_POST['cancel'])) {//el usuario cancela la posible modificacion
    header("location: list.php");
    die();
}


$conn = require "../database.php";

if (isset($_POST['save'])) {//guarda una oficina nueva o modicar una ya registrada
    $reparacion = array(
        'IdReparacion' =>$_POST['IdReparacion'],
        'Matricula'       =>$_POST['Matricula'],
        'FechaEntrada'       =>$_POST['FechaEntrada'],
        'Km'       =>$_POST['Km'],
        'Averia'       =>$_POST['Averia'],
        'FechaSalida'       =>$_POST['FechaSalida'],
        'Reparado'       =>$_POST['Reparado'],
        'Observaciones'       =>$_POST['Observaciones']
    );

    $errores = array();
    if (strlen($reparacion['Matricula'])<=0){
        $errores['Matricula']= 'Se debe indicar la Matricula';
    }

    if (count($errores)==0){
        if(strlen($reparacion['IdReparacion'])>0){
            $stm = $conn->prepare("update reparaciones set IdReparacion=:IdReparacion, Matricula=:Matricula, FechaEntrada=:FechaEntrada,
                                          Km=:Km, Averia=:Averia, FechaSalida=:FechaSalida, Reparado=:Reparado, Observaciones=:Observaciones
                                    where IdReparacion=:IdReparacion");
        }else{ //nuevo empleado
        $stm = $conn->prepare("select max(IdReparacion) as maxIdentificador from reparaciones");
        $stm->execute();
        $result = $stm->fetch();
    
        $reparacion['IdReparacion'] = $result['maxIdentificador'] + 1;
    
        $stm = $conn->prepare("insert into reparaciones (IdReparacion, Matricula, FechaEntrada, Km, Averia, FechaSalida, Reparado, Observaciones)
                                      values (:IdReparacion, :Matricula, :FechaEntrada, :Km, :Averia, :FechaSalida, :Reparado, :Observaciones)"); 
    }

    $stm->execute($reparacion);
    $stm = null;
    $conn = null;

    header("location: show.php?IdReparacion=".$reparacion['IdReparacion']);
    die();
    
    }

}else if (isset($_GET['IdReparacion'])) { //modificar un empleado ya registrado

    $stm= $conn->prepare("select * from reparaciones where IdReparacion=:IdReparacion");
    $stm->execute(array(':IdReparacion' => $_GET['IdReparacion']));

    $reparacion = $stm->fetch();

}else { //se desea crear una oficina nueva
    $reparacion =array(
        'IdReparacion' => '',
        'Matricula'       => '',
        'FechaEntrada'      => '',
        'Km'      => '',
        'Averia'          => '',
        'FechaSalida'     => '',
        'Reparado'     => '',
        'Observaciones'     => ''
    );
}

$stm = $conn->prepare("select * from facturas");
$stm -> execute();
$facturas = $stm->fetchAll();

$stm = $conn->prepare("select * from vehiculos");
$stm -> execute();
$vehiculos = $stm->fetchAll();

$stm = $conn->prepare("select * from empleados");
$stm -> execute();
$empleados = $stm->fetchAll();

$stm = $conn->prepare("select * from recambios");
$stm -> execute();
$recambios = $stm->fetchAll();

$stm = $conn->prepare("select * from actuaciones");
$stm -> execute();
$actuaciones = $stm->fetchAll();

$stm = null;
$conn = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/formCSS.css">
    <title>Editar Reparaciones</title>
</head>
<body>
    <?php if (isset($errores) && count($errores) > 0): ?>
        <p>Existen errores:</p>
        <?php foreach ($errores as $error): ?>
            <li><?=$error?></li>
        <?php endforeach; ?>
    <?php endif; ?>

    <div id="container">
        <h1>&bull; Reparaciones &bull;</h1>
        <div class="underline">
        </div>
        <div class="icon_wrapper">
        </div>
        <form action="form.php" method="post" id="contact_form">
          <div class="name">
            <label for="name"></label>
            <input type="text" value="<?=$reparacion['IdReparacion']?>" placeholder="Id de reparacion" name="telephone" id="telephone_input">
          </div>

          <div class="name">
            <label for="name"></label>
            <input type="text" value="<?=$reparacion['Km']?>" placeholder="KM" name="telephone" id="telephone_input">
          </div>

          <div class="name">
            <label for="name"></label>
            <input type="text" value="<?=$reparacion['FechaEntrada']?>" placeholder="Fecha de entrada" name="telephone" id="telephone_input">
          </div>
          <div class="name">
            <label for="name"></label>
            <input type="text" value="<?=$reparacion['FechaSalida']?>" placeholder="Fecha de salida" name="telephone" id="telephone_input">
          </div>
          
          
               


          <div class="name">
            <label for="name"></label>
            <input type="text" value="<?=$reparacion['Averia']?>" placeholder="Averia" name="telephone" id="telephone_input">
            
        </div>

        <div class="name">
            <label for="name"></label>
            <input type="text" value="<?=$reparacion['Reparado']?>" placeholder="Reparado" name="telephone" id="telephone_input">
            
        </div>
        <div class="telephone">
            <label for="name"></label>
            <input type="text" value="<?=$reparacion['Observaciones']?>" placeholder="Observaciones" name="telephone" id="telephone_input">
            
        </div>
        
        <div class="subject">
            <label for="subject"></label>
            <select placeholder="Matricula" name="subject" id="subject_input" required>
                <?php foreach($vehiculos as $vehiculo): ?>
                    <option value="<?=$vehiculo['Matricula']?>"
                            <?=$reparacion['Matricula']==$vehiculo['Matricula']? 'selected': ''?>>
                        <?=$vehiculo['Matricula'].'-'.$vehiculo['Marca']?>
                    </option>
                <?php endforeach; ?>
            </select>
          </div>
          
          
          <div class="submit">
            <input type="button" onclick="location.href='show.php'" value="Enviar" id="form_button" />
            <input type="button" onclick="location.href='reparacion.php'" value="Cancelar" id="form_button" />
          </div>
        </form><!-- // End form -->
      </div><!-- // End #container -->
</body> 
</html>