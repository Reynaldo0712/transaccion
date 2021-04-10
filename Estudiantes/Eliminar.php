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
$isContainId = isset($_GET['id']);

if($isContainId)
{
    $estudiantesID=$_GET['id'];
    $services->Delete($estudiantesID);
   
    
}

header("Location: ../index.php");
exit();
?>