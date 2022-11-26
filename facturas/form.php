<?php declare (strict_types=1);

if (isset($_POST['cancel'])) {//el usuario cancela la posible modificacion
    header("location: list.php");
    die();
}


$conn = require "../database.php";

if (isset($_POST['save'])) {//guarda una oficina nueva o modicar una ya registrada
    $factura = array(
        'IdFactura' =>$_POST['IdFactura'],
        'FechaFactura'       =>$_POST['FechaFactura'],
        'CodCliente'       =>$_POST['CodCliente'],
        'IdReparacion'       =>$_POST['IdReparacion']
    );

    //validación
    $errores = array();
    if (strlen($factura['FechaFactura'])<=0){
        $errores['FechaFactura']= 'Se debe indicar una fecha';
    }

    if (count($errores)==0){
        if(strlen($factura['IdFactura'])>0){
            $stm = $conn->prepare("update facturas set IdFactura=:IdFactura, FechaFactura=:FechaFactura, CodCliente=:CodCliente,
                                          IdReparacion=:IdReparacion
                                    where IdFactura=:IdFactura");
        }else{ //nuevo empleado
        $stm = $conn->prepare("select max(IdFactura) as maxFacturaId from facturas");
        $stm->execute();
        $result = $stm->fetch();
    
        $factura['IdFactura'] = $result['maxFacturaId'] + 1;
    
        $stm = $conn->prepare("insert into facturas (IdFactura, FechaFactura, CodCliente, IdReparacion)
                                      values (:IdFactura, :FechaFactura, :CodCliente, :IdReparacion)"); 
    }

    $stm->execute($factura);
    $stm = null;
    $conn = null;

    header("location: show.php?IdFactura=".$factura['IdFactura']);
    die();
    
    }

}else if (isset($_GET['IdFactura'])) { //modificar un empleado ya registrado

    $stm= $conn->prepare("select * from facturas where IdFactura=:IdFactura");
    $stm->execute(array(':IdFactura' => $_GET['IdFactura']));

    $factura = $stm->fetch();

}else { //se desea crear una oficina nueva
    $factura =array(
        'IdFactura' => '',
        'FechaFactura'       => '',
        'CodCliente'      => '',
        'IdReparacion'      => ''
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
    <title>Editar Factura</title>
</head>
<body>
    <?php if (isset($errores) && count($errores) > 0): ?>
        <p>Existen errores:</p>
        <?php foreach ($errores as $error): ?>
            <li><?=$error?></li>
        <?php endforeach; ?>
    <?php endif; ?>

    <div id="container">
        <h1>&bull; Facturas &bull;</h1>
        <div class="underline">
        </div>
        <div class="icon_wrapper">
        </div>
        <form action="form.php" method="post" id="contact_form">
          <div class="name">
            <label for="name">Id de Factura: <?=$factura['IdFactura']?></label>
           
          </div>

          <div class="name">
            <label for="name"></label>
            <input type="text" value="<?=$factura['FechaFactura']?>" placeholder="Fecha de Factura" name="telephone" id="telephone_input">
          </div>
        
        <div class="subject">
            <label for="subject"></label>
            <select placeholder="Matricula" name="subject" id="subject_input" required>
                <?php foreach($clientes as $cliente): ?>
                    <option value="<?=$cliente['CodCliente']?>"
                            <?=$factura['CodCliente']==$cliente['CodCliente']? 'selected': ''?>>
                        <?= $cliente['CodCliente'].'-'.$cliente['DNI']?>
                    </option>
                <?php endforeach; ?>
            </select>
          </div>
          

          <div class="subject">
            <label for="subject"></label>
            <select placeholder="Matricula" name="subject" id="subject_input" required>
                <?php foreach($facturas as $factura): ?>
                    <option value="<?=$factura['IdFactura']?>"
                            <?=$factura['IdFactura']==$factura['IdReparacion']? 'selected': ''?>>
                        <?= $factura['FechaFactura'].'-'.$factura['IdReparación']?>
                    </option>
                <?php endforeach; ?>
            </select>
          </div>
          
          <div class="submit">
            <input type="button" onclick="location.href='show.php'" value="Enviar" id="form_button" />
            <input type="button" onclick="location.href='facturas.php'" value="Cancelar" id="form_button" />
          </div>
        </form><!-- // End form -->
      </div><!-- // End #container -->
</body> 
</html>