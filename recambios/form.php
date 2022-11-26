<?php declare (strict_types=1);

if(isset($_POST['cancel'])) {
    header("location: list.php");
    die();
 } 
 
 $conn = require "../database.php";
 
 if (isset($_POST['save'])) {
     $recambio = array(
         'IdRecambio' => $_POST['IdRecambio'],
         'Descripcion' => $_POST['Descripcion'],
         'UnidadBase' => $_POST['UnidadBase'],
         'Stock' => $_POST['Stock'],
         'PrecioReferencia' => $_POST['PrecioReferencia']
     );
 
     $errores = array();
  
     if(count($errores) == 0){
         if(strlen($recambio['IdRecambio']) >0){
             $stm = $conn->prepare("update recambios set UnidadBase=:UnidadBase,Descripcion=:Descripcion, Stock=:Stock, PrecioReferencia=:PrecioReferencia where IdRecambio=:IdRecambio");
 
         } else {
 
             $stm=$conn->prepare("select max(IdRecambio*1) as maxIdRecambio from recambios");
             $stm->execute();
             $result=$stm->fetch();
 
             $recambio['IdRecambio'] = $result['maxIdRecambio'] + 1;
             
             $stm = $conn->prepare("insert into recambios (IdRecambio, Descripcion, UnidadBase, Stock, PrecioReferencia) values (:IdRecambio, :Descripcion, :UnidadBase, :Stock, :PrecioReferencia)");
         }
 
         $stm->execute($recambio);
         $stm = null;
         $conn = null;
         header("location: show.php?IdRecambio=".$recambio['IdRecambio']);
         die();
     }
 } else if (isset($_GET['IdRecambio'])){
     $stm = $conn->prepare("select * from recambios where IdRecambio=:IdRecambio");
     $stm->execute(array(':IdRecambio' => $_GET['IdRecambio']));
 
     $recambio = $stm->fetch();
 
 } else {
     $recambio = array(
         'IdRecambio' => '',
         'Descripcion'       => '',
         'UnidadBase'      => '',
         'Stock'      => '',
         'PrecioReferencia'          => ''
     );
 }

$stm = $conn->prepare("select * from recambios");
$stm -> execute();
$recambios = $stm->fetchAll();

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
    <title>Editar Recambios</title>
</head>
<body>
    <?php if (isset($errores) && count($errores) > 0): ?>
        <p>Existen errores:</p>
        <?php foreach ($errores as $error): ?>
            <li><?=$error?></li>
        <?php endforeach; ?>
    <?php endif; ?>

    <div id="container">
        <h1>&bull; Recambios &bull;</h1>
        <div class="underline">
        </div>
        <div class="icon_wrapper">
        </div>
        <form action="form.php" method="post" id="contact_form">
          <div class="name">
            <label for="name"> Id Recambio: <?=$recambio['IdRecambio']?> </label>
          </div>
          <div class="email">
            <label for="name"></label>
            <input type="text" value="<?=$recambio['UnidadBase']?>" placeholder="Unidad Base" name="telephone" id="telephone_input">
          </div>
          <div class="telephone">
            <label for="email"></label>
            <input type="text" value="<?=$recambio['Stock']?>" placeholder="Stock" id="email_input" >
            <label for="email"></label>
            <input type="text" value="<?=$recambio['PrecioReferencia']?>" placeholder="Precio de referencia" id="email_input" >
            

        </div>
          <div class="message">
            <label for="message"></label>
            <textarea name="message" value="<?=$recambio['Descripcion']?>" placeholder="Descripcion" id="message_input" cols="30" rows="5" ></textarea>
          </div>
          
          
          <div class="submit">
            <input type="button" onclick="location.href='show.php'" value="Enviar" id="form_button" />
            <input type="button" onclick="location.href='recambios.php'" value="Cancelar" id="form_button" />
          </div>
        </form><!-- // End form -->
      </div><!-- // End #container -->
</body> 
</html>