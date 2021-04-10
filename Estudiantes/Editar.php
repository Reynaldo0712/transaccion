<?php
require_once '../Layouts/layoutHF.php';
require_once '../Helpers/Utilities.php';
require_once 'Estudiante.php';
require_once '../service/IServicesBase.php';
require_once 'EstudianteServiceCookie.php';
require_once '../Helpers/FileHandler/IFileHandler.php';
require_once '../Helpers/FileHandler/JsonFileHandler.php';
require_once 'EstudianteServiceFile.php';

$layout = new Layout();
$services = new EstudianteServiceFile();
$utilities = new Utilities();

if(isset($_GET['id']))
{

    $estudianteID=$_GET['id'];
    $element =  $services->GetById($estudianteID);

    if(isset($_POST['Monto']) && isset($_POST['Descripcion'])&&isset($_POST['fecha']))
    {
        $updateEstudiante= new Estudiante();
        $updateEstudiante->InicialiteData($estudianteID,$_POST['Monto'],$_POST['Descripcion'],$_POST['fecha']);

        $services->update($estudianteID, $updateEstudiante);

        header('Location:../index.php');
        exit();

    }
}
else
{
    header('Location:../index.php');
    var_dump($estudiantes);
    exit();
}








?>
<?php $layout->headerLY();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <LINK REL=StyleSheet HREF="../CSS/Estilos.css" TYPE="text/css" MEDIA=screen>
    <title>Document</title>
</head>
<body>
<h2 class="text-center mt-5">Editar Transacciones</h2>
<form action="Editar.php?id=<?php echo $element->id?>" method="POST">
    <div class="container mt-5 bg-secondary rounded">
        <div class="pt-5 row ">
            <div class="col">
                <label class="text-white">Monto a enviar</label>
               <input type="text" class="form-control mt-3" placeholder="Nombre del Estudiante..." name="Monto" value="<?php echo $element->Monto?>">
            </div>
            <div class="col">
            <label class="text-white">Descripcion de la transaccion</label>
                <input class="form-control mt-3" type="text" placeholder="Escriba la descripcion de la transaccion" value="<?php echo $element->Descripcion?>" name="Descripcion">
            </div>
            <div class="col">
                <label class="text-white">Descripcion de la transaccion</label>
                <input type="text" class="form-control mt-3" placeholder="Apellido del Estudiante" name="fecha" value="<?php echo $element->fecha?>">
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success ml-2 btn-lg btn-block mt-5 mb-5">Enviar</button>
        </div>
    </div>
</form>
</body>
</html>

