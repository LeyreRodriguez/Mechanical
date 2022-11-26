<?php declare (strict_types=1);

if (isset($_POST['cancel'])) {//el usuario cancela la posible modificacion
    header("location: list.php");
    die();
}


$conn = require "../database.php";

if (isset($_POST['save'])) {//guarda una oficina nueva o modicar una ya registrada
    $cliente = array(
        'CodCliente' =>$_POST['CodCliente'],
        'DNI'       =>$_POST['DNI'],
        'Apellidos'       =>$_POST['Apellidos'],
        'Nombre'       =>$_POST['Nombre'],
        'Direccion'       =>$_POST['Direccion'],
        'Telefono'       =>$_POST['Telefono']
    );

    //validación
    $errores = array();
    if (strlen($cliente['DNI'])<=0){
        $errores['DNI']= 'Se debe indicar el DNI';
    }

    if (count($errores)==0){
        if(strlen($cliente['CodCliente'])>0){
            $stm = $conn->prepare("update clientes set CodCliente=:CodCliente, DNI=:DNI, Apellidos=:Apellidos,
                                          Nombre=:Nombre, Direccion=:Direccion, Telefono=:Telefono 
                                    where CodCliente=:CodCliente");
        }else{ //nuevo empleado
        $stm = $conn->prepare("select max(CodCliente) as maxClienteCodigo from clientes");
        $stm->execute();
        $result = $stm->fetch();
    
        $cliente['CodCliente'] = $result['maxClienteCodigo'] + 1;
    
        $stm = $conn->prepare("insert into clientes (CodCliente, DNI, Apellidos, Nombre, Direccion, Telefono)
                                      values (:CodCliente, :DNI, :Apellidos, :Nombre, :Direccion, :Telefono)"); 
    }

    $stm->execute($cliente);
    $stm = null;
    $conn = null;

    header("location: show.php?CodCliente=".$cliente['CodCliente']);
    die();
    
    }

}else if (isset($_GET['CodCliente'])) { //modificar un empleado ya registrado

    $stm= $conn->prepare("select * from clientes where CodCliente=:CodCliente");
    $stm->execute(array(':CodCliente' => $_GET['CodCliente']));

    $cliente = $stm->fetch();

}else { //se desea crear una oficina nueva
    $cliente =array(
        'CodCliente' => '',
        'DNI'       => '',
        'Apellidos'      => '',
        'Nombre'      => '',
        'Direccion'          => '',
        'Telefono'     => ''
    );
}

$stm = $conn->prepare("select * from clientes");
$stm -> execute();
$clientes = $stm->fetchAll();

$stm = $conn->prepare("select * from facturas");
$stm -> execute();
$facturas = $stm->fetchAll();

$stm = $conn->prepare("select * from vehiculos");
$stm -> execute();
$vehiculos = $stm->fetchAll();

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
    <title>Editar Cliente</title>
</head>
<body>
    <?php if (isset($errores) && count($errores) > 0): ?>
        <p>Existen errores:</p>
        <?php foreach ($errores as $error): ?>
            <li><?=$error?></li>
        <?php endforeach; ?>
    <?php endif; ?>

    <div id="container">
        <h1>&bull; Clientes &bull;</h1>
        <div class="underline">
        </div>
        <div class="icon_wrapper">
        </div>
        <form action="form.php" method="post" id="contact_form">
          <div class="name">
            <label for="name">Codigo de cliente: <?=$cliente['CodCliente']?></label>
           
          </div>

          <div class="name">
            <label for="name"></label>
            <input type="text" value="<?=$cliente['DNI']?>" placeholder="DNI" name="telephone" id="telephone_input">
          </div>

          <div class="name">
            <label for="name"></label>
            <input type="text" value="<?=$cliente['Apellidos']?>" placeholder="Apellidos" name="telephone" id="telephone_input">
          </div>

          <div class="name">
            <label for="name"></label>
            <input type="text" value="<?=$cliente['Nombre']?>" placeholder="Nombre" name="telephone" id="telephone_input">
          </div>

          <div class="name">
            <label for="name"></label>
            <input type="text" value="<?=$cliente['Direccion']?>" placeholder="Direccion" name="telephone" id="telephone_input">
          </div>

          <div class="name">
            <label for="name"></label>
            <input type="text" value="<?=$cliente['Telefono']?>" placeholder="Telefono" name="telephone" id="telephone_input">
          </div>
        
          
          <div class="submit">
            <input type="button" onclick="location.href='show.php'" value="Enviar" id="form_button" />
            <input type="button" onclick="location.href='clientes.php'" value="Cancelar" id="form_button" />
          </div>
        </form><!-- // End form -->
      </div><!-- // End #container -->
</body> 
</html>