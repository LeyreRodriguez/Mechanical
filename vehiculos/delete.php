<?php declare(strict_types=1);

if (isset($_POST['cancel'])) { //has cancelado porque no quieres eliminar la oficina
    header("location: list.php"); //vuelves al listado de oficinas
} else if (isset($_POST['delete'])){ //has seleccionado que quieres eliminar la oficina
    $conn = require "../database.php";

    $stm = $conn->prepare("delete from vehiculos where Matricula = :Matricula");
    $stm->execute(array(':Matricula' => $_POST['Matricula']));

    $stm = null; //se cierra la conexión
    $conn = null;

    header("location: list.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/formCSS.css">
    <link rel="stylesheet" href="../css/mainPage.css">
    <title>Document</title>
</head>
<body>

<div id="container">
        <h1>&bull; <?=$_GET['Matricula']?> &bull;</h1>
        <br>
        <div class="underline">
        </div>
        <form action="delete.php" method="post" id="contact_form">
          <div class="telephone">
            <label for="name">¿Seguro que quiere eliminar el vehiculo con matricula <?=$_GET['Matricula']?>?</label>
            
          </div>

          
          <div class="submit">


              <input type="button" onclick="location.href='../vehiculos/vehiculos.php'" value="Enviar" id="form_button" />
                <input type="button" onclick="location.href='../vehiculos/form.php?Matricula=<?=$vehiculo['Matricula']?>'" value="Cancelar" id="form_button" />
          </div>
        </form><!-- // End form -->
      </div><!-- // End #container -->


</body>
</html>