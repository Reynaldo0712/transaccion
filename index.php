<?php
require_once 'Layouts/layoutHF.php';
require_once 'Helpers/Utilities.php';
require_once 'Estudiantes/Estudiante.php';
require_once 'service/IServicesBase.php';
require_once 'Estudiantes/EstudianteServiceCookie.php';
require_once 'Helpers/FileHandler/IFileHandler.php';
require_once 'Helpers/FileHandler/JsonFileHandler.php';
require_once 'Estudiantes/EstudianteServiceFile.php';

$layout = new Layout(false);
$services = new EstudianteServiceFile("Estudiantes/Data");
$utilities = new Utilities();


$listadoEstudiantes=$services->GetList();







?>

<?php $layout->headerLY();?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<h2 class="pt-5 text-center">Transaccion</h2>
<table class="table  table-striped container mt-5">
  <thead class="table table-warning">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Monto</th>
      <th scope="col">Fecha</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Mantenimiento</th>
    </tr>
  </thead>
  <tbody>
   <?php foreach($listadoEstudiantes as $estudiante):?>
    <tr>
      <th scope="row"><?php echo $estudiante->id?></th>
      <td><?php echo $estudiante->Monto?></td>
      <td><?php echo $estudiante->fecha?></td>
      <td><?php echo $estudiante->Descripcion?></td>

      <td>
      <div class="btn-group-vertical">
        <a href="Estudiantes/Editar.php?id=<?php echo $estudiante->id?>" class="btn btn-success">Actualizar</a>
        <a href="#" data-id="<?php echo $estudiante->id?>" class="btn btn-danger delete-transacciones">Eliminar</a>
        </div>
      </td>
    </tr>
    <?php endforeach;?>

  </tbody>
</table>
</body>
</html>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>   

$(document).ready(function(){

    $(".delete-transacciones").on("click",function(){
        if(confirm("Esta seguro que desea eliminar esta transaccion?"))
        {
            let id = $(this).data("id");
            window.location.href="Estudiantes/Eliminar.php?id=" + id;
        }
        
        
    });

});



</script>


