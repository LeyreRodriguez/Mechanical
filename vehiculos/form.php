<?php declare (strict_types=1);

if (isset($_POST['cancel'])) {//el usuario cancela la posible modificacion
    header("location: list.php");
    die();
}


$conn = require "../database.php";

if (isset($_POST['save'])) {//guarda una oficina nueva o modicar una ya registrada
    $vehiculo = array(
        'Matricula' =>$_POST['Matricula'],
        'Marca'       =>$_POST['Marca'],
        'Modelo'       =>$_POST['Modelo'],
        'Color'       =>$_POST['Color'],
        'FechaMatriculacion'       =>$_POST['FechaMatriculacion'],
        'CodCliente'       =>$_POST['CodCliente']
    );

    //validación
    $errores = array();
    if (strlen($vehiculo['Marca'])<=0){
        $errores['Marca']= 'Se debe indicar la marca';
    }

    $stm = $conn->prepare("select * from vehiculos");
    $stm -> execute();
    $matriculas = $stm->fetchAll();  
    
    foreach ($matriculas as $matriculasA)
         {if ( in_array ($vehiculo['Matricula'], $matriculasA )){
            $existe = true;
         }
        
    }

    if (count($errores)==0){
        if($existe){
            $stm = $conn->prepare("update vehiculos set Matricula=:Matricula, Marca=:Marca, Modelo=:Modelo,
                                          Color=:Color, FechaMatriculacion=:FechaMatriculacion, CodCliente=:CodCliente 
                                    where Matricula=:Matricula");
        }else{ //nuevo empleado
    
        $stm = $conn->prepare("insert into vehiculos (Matricula, Marca, Modelo, Color, FechaMatriculacion, CodCliente)
                                      values (:Matricula, :Marca, :Modelo, :Color, :FechaMatriculacion, :CodCliente)"); 
    }

    $stm->execute($vehiculo);
    $stm = null;
    $conn = null;

    header("location: show.php?Matricula=".$vehiculo['Matricula']);
    die();
    
    }

}else if (isset($_GET['Matricula'])) { //modificar un empleado ya registrado

    $stm= $conn->prepare("select * from vehiculos where Matricula=:Matricula");
    $stm->execute(array(':Matricula' => $_GET['Matricula']));

    $vehiculo = $stm->fetch();

}else { //se desea crear una oficina nueva
    $vehiculo =array(
        'Matricula' => '',
        'Marca'       => '',
        'Modelo'      => '',
        'Color'      => '',
        'FechaMatriculacion'          => '',
        'CodCliente'     => ''
    );
}

$stm = $conn->prepare("select * from clientes");
$stm -> execute();
$clientes = $stm->fetchAll();

$stm = $conn->prepare("select * from reparaciones");
$stm -> execute();
$reparaciones = $stm->fetchAll();

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
    <title>Editar Vehiculo</title>
</head>
<body>
    <?php if (isset($errores) && count($errores) > 0): ?>
        <p>Existen errores:</p>
        <?php foreach ($errores as $error): ?>
            <li><?=$error?></li>
        <?php endforeach; ?>
    <?php endif; ?>

    <div id="container">
        <h1>&bull; Vehiculos &bull;</h1>
        <div class="underline">
        </div>
        <div class="icon_wrapper">
        </div>
        <form action="form.php" method="post" id="contact_form">
          <div class="name">
            <label for="name"></label>
            <input type="text" value="<?=$vehiculo['Matricula']?>" placeholder="Matricula" name="telephone" id="telephone_input">
          </div>

          <div class="name">
            <label for="name"></label>
            <input type="text" value="<?=$vehiculo['Marca']?>" placeholder="Marca" name="telephone" id="telephone_input">
          </div>

          <div class="name">
            <label for="name"></label>
            <input type="text" value="<?=$vehiculo['Modelo']?>" placeholder="Modelo" name="telephone" id="telephone_input">
          </div>
          
          <div class="email">
            <label for="name"></label>
            <input type="text" value="<?=$vehiculo['Color']?>" placeholder="Color" name="telephone" id="telephone_input">
          </div>
               


          <div class="telephone">
            <label for="name"></label>
            <input type="text" value="<?=$vehiculo['FechaMatriculacion']?>" placeholder="Fecha de Matriculacion" name="telephone" id="telephone_input">
            
        </div>
        
        <div class="subject">
            <label for="subject"></label>
            <select placeholder="Codigo de cliente" name="subject" id="subject_input" required>
                <?php foreach($clientes as $cliente): ?>
                    <option value="<?=$cliente['CodCliente']?>"
                            <?=$vehiculo['CodCliente']==$cliente['CodCliente']? 'selected': ''?>>
                        <?=$cliente['CodCliente'].'-'.$cliente['DNI']?>
                    </option>
                <?php endforeach; ?>
            </select>
          </div>
          
          
          <div class="submit">
            <input type="button" onclick="location.href='show.php'" value="Enviar" id="form_button" />
            <input type="button" onclick="location.href='vehiculos.php'" value="Cancelar" id="form_button" />
          </div>
        </form><!-- // End form -->
      </div><!-- // End #container -->
</body> 
</html>