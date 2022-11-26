<?php declare (strict_types=1);

if(isset($_POST['cancel'])) {
    header("location: list.php");
    die();
 } 
 
 $conn = require "../database.php";
 
 if (isset($_POST['save'])) {
     $actuacion = array(
         'Referencia' => $_POST['Referencia'],
         'Descripcion' => $_POST['Descripcion'],
         'TiempoEstimado' => $_POST['TiempoEstimado'],
         'Importe' => $_POST['Importe']
     );
 
     $errores = array();
  
     if(count($errores) == 0){
         if(strlen($actuacion['Referencia']) >0){
             $stm = $conn->prepare("update actuaciones set TiempoEstimado=:TiempoEstimado,Descripcion=:Descripcion, Importe=:Importe where Referencia=:Referencia");
 
         } else {
 
             $stm=$conn->prepare("select max(SUBSTRING(Referencia,2,100)*1) as maxReferencia from actuaciones");
             $stm->execute();
             $result=$stm->fetch();
 
             $actuacion['Referencia'] = "A".$result['maxReferencia'] + 1;
             
             $stm = $conn->prepare("insert into actuaciones (Referencia, Descripcion, TiempoEstimado, Importe) values (:Referencia, :Descripcion, :TiempoEstimado, :Importe)");
         }
 
         $stm->execute($actuacion);
         $stm = null;
         $conn = null;
         header("location: show.php?Referencia=".$actuacion['Referencia']);
         die();
     }
 } else if (isset($_GET['Referencia'])){
     $stm = $conn->prepare("select * from actuaciones where Referencia=:Referencia");
     $stm->execute(array(':Referencia' => $_GET['Referencia']));
 
     $actuacion = $stm->fetch();
 
 } else {
     $actuacion = array(
         'Referencia' => '',
         'Descripcion'       => '',
         'TiempoEstimado'      => '',
         'Importe'      => ''
     );
 }
 
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
    <title>Editar Actuacion</title>
</head>
<body>
    <?php if (isset($errores) && count($errores) > 0): ?>
        <p>Existen errores:</p>
        <?php foreach ($errores as $error): ?>
            <li><?=$error?></li>
        <?php endforeach; ?>
    <?php endif; ?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/formCSS.css">
    <title>Editar Actuacion</title>
</head>

<body>
    <div id="container">
        <h1>&bull; Actuaciones &bull;</h1>
        <div class="underline">
        </div>
        <div class="icon_wrapper">
        </div>
        <form action="form.php" method="post" id="contact_form">
          <div class="name">
            <label for="name"> Referencia: <?=$actuacion['Referencia']?> </label>
          </div>
          <div class="email">
            <label for="name"></label>
            <input type="text" value="<?=$actuacion['TiempoEstimado']?>" placeholder="Tiempo estimado" name="telephone" id="telephone_input" >
          </div>
          <div class="telephone">
            
            <label for="email"></label>
            <input type="text" value="<?=$actuacion['Importe']?>" placeholder="Importe" id="email_input" required>
          </div>
          <div class="message">
            <label for="message"></label>
            <textarea name="message" value="<?=$actuacion['Descripcion']?>" placeholder="Descripcion" id="message_input" cols="30" rows="5" ></textarea>
          </div>
          
          
          
          <div class="submit">
            <input type="button" onclick="location.href='show.php'" value="Enviar" id="form_button" />
            <input type="button" onclick="location.href='actuaciones.php'" value="Cancelar" id="form_button" />
          </div>
        </form><!-- // End form -->
      </div><!-- // End #container -->
    
</body>
</html>

</body> 
</html>