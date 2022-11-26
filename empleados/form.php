<?php declare (strict_types=1);

if (isset($_POST['cancel'])) {//el usuario cancela la posible modificacion
    header("location: list.php");
    die();
}


$conn = require "../database.php";

if (isset($_POST['save'])) {//guarda una oficina nueva o modicar una ya registrada
    $empleado = array(
        'CodEmpleado' =>$_POST['CodEmpleado'],
        'DNI'       =>$_POST['DNI'],
        'Nombre'       =>$_POST['Nombre'],
        'Apellidos'       =>$_POST['Apellidos'],
        'Direccion'       =>$_POST['Direccion'],
        'Telefono'       =>$_POST['Telefono'],
        'CP'       =>$_POST['CP'],
        'FechaAlta'       =>$_POST['FechaAlta'],
        'Categoria'       =>$_POST['Categoria']
    );

    //validación
    $errores = array();
    if (strlen($empleado['DNI'])<=0){
        $errores['DNI']= 'Se debe indicar el DNI';
    }
   

    if (count($errores)==0){
        if(strlen($empleado['CodEmpleado'])>0){
            $stm = $conn->prepare("update empleados set CodEmpleado=:CodEmpleado, DNI=:DNI, Nombre=:Nombre,
                                          Apellidos=:Apellidos, Direccion=:Direccion, Telefono=:Telefono, CP=:CP, FechaAlta=:FechaAlta, Categoria=:Categoria 
                                    where CodEmpleado=:CodEmpleado");
        }else{ //nuevo empleado
            $stm = $conn->prepare("select max(CodEmpleado*1) as maxCodigoEmpleado from empleados");
            $stm->execute();
            $result = $stm->fetch();
        
            $empleado['CodEmpleado'] = $result['maxCodigoEmpleado'] + 1;
    
        $stm = $conn->prepare("insert into empleados (CodEmpleado, DNI, Nombre, Apellidos, Direccion, Telefono, CP, FechaAlta, Categoria)
                                      values (:CodEmpleado, :DNI, :Nombre, :Apellidos, :Direccion, :Telefono, :CP, :FechaAlta, :Categoria)"); 
    }

    $stm->execute($empleado);
    $stm = null;
    $conn = null;

    header("location: show.php?CodEmpleado=".$empleado['CodEmpleado']);
    die();
    
    }

}else if (isset($_GET['CodEmpleado'])) { //modificar un empleado ya registrado

    $stm= $conn->prepare("select * from empleados where CodEmpleado=:CodEmpleado");
    $stm->execute(array(':CodEmpleado' => $_GET['CodEmpleado']));

    $empleado = $stm->fetch();

}else { //se desea crear una oficina nueva
    $empleado =array(
        'CodEmpleado' => '',
        'DNI'       => '',
        'Nombre'      => '',
        'Apellidos'      => '',
        'Direccion'          => '',
        'Telefono'     => '',
        'CP'     => '',
        'FechaAlta'     => '',
        'Categoria'     => ''
    );
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/formCSS.css">
    <title>Editar empleado</title>
</head>
<body>
    <?php if (isset($errores) && count($errores) > 0): ?>
        <p>Existen errores:</p>
        <?php foreach ($errores as $error): ?>
            <li><?=$error?></li>
        <?php endforeach; ?>
    <?php endif; ?>

    <div id="container">
        <h1>&bull; Empleados &bull;</h1>
        <div class="underline">
        </div>
        <div class="icon_wrapper">
        </div>
        <form action="form.php" method="post" id="contact_form">
          <div class="name">
            <label for="name"> Codigo de Empleado: <?=$empleado['CodEmpleado']?> </label>
          </div>

          <div class="name">
            <label for="name"></label>
            <input type="text" value="<?=$empleado['DNI']?>" placeholder="DNI" name="telephone" id="telephone_input">
          </div>

          <div class="name">
            <label for="name"></label>
            <input type="text" value="<?=$empleado['Nombre']?>" placeholder="Nombre" name="telephone" id="telephone_input">
          </div>
          
          <div class="email">
            <label for="name"></label>
            <input type="text" value="<?=$empleado['Apellidos']?>" placeholder="Apellidos" name="telephone" id="telephone_input">
          </div>
               


          <div class="telephone">
            <label for="name"></label>
            <input type="text" value="<?=$empleado['FechaAlta']?>" placeholder="Fecha de Alta" name="telephone" id="telephone_input">
            <label for="name"></label>
            <input type="text" value="<?=$empleado['CP']?>" placeholder="Codigo Postal" name="telephone" id="telephone_input">
            <label for="email"></label>
            <input type="text" value="<?=$empleado['Direccion']?>" placeholder="Direccion" id="email_input" >
            <label for="email"></label>
            <input type="text" value="<?=$empleado['Telefono']?>" placeholder="Telefono" id="email_input" >
            <label for="email"></label>
            <input type="text" value="<?=$empleado['Categoria']?>" placeholder="Categoria" id="email_input" >
        </div>
       
          
          
        <div class="submit">
            <input type="button" onclick="location.href='show.php'" value="Enviar" id="form_button" />
            <input type="button" onclick="location.href='empleados.php'" value="Cancelar" id="form_button" />
          </div>
        </form><!-- // End form -->
      </div><!-- // End #container -->
</body> 
</html>