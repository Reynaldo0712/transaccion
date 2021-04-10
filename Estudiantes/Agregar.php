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


$_POST['fecha']=$fechaActual = date('d-m-Y');


if(isset($_POST['Monto']) && isset($_POST['Descripcion'])&& isset($_POST['fecha']))
{
    $newEstudiante = new Estudiante();

    $newEstudiante->InicialiteData(0, $_POST['Monto'],$_POST['Descripcion'],$_POST['fecha']);

    var_dump($newEstudiante);

    $services->Add($newEstudiante);

    header('Location:../index.php');
    exit();
}

?>
<?php $layout->headerLY();?>

<form action="Agregar.php" method="POST">
    <div class="container mt-5 table table-warning rounded">
        <div class="pt-5 row ">
            <div class="col">
                <label class="text-dark">Monto a enviar</label>
                <input type="number" class="form-control" placeholder="Escriba el monto..." name="Monto" id="name" required>
            </div>
            <div class="col">
            <label class="text-dark">Descripcion de la transaccion</label>
                <textarea class="form-control" placeholder="Escriba la descripcion de la transaccion" name="Descripcion" rows="4" cols="50">
                
                </textarea>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success ml-1 btn-lg  mt-5 mb-5">Enviar</button>
        </div>
    </div>
</form>