<?php
class EstudianteServiceFile implements IServiceBase{

private $utilities;
private $fileHandler;
private $directory;
public $fileName;
public $fileNametxt;
public $fileNameCsv;

public function __construct($directory = "Data")
{
    $this->utilities = new Utilities();
    $this->directory = $directory;
    $this->fileName="estudiante";
    $this->fileHandler = new JsonFileHandler($this->directory,$this->fileName);
   
}

public function GetList()
{
    $ListadoEstudianteDecode = $this->fileHandler->ReadFile();
    $ListadoEstudiante = array();

    if($ListadoEstudianteDecode == false){

        $this->fileHandler->SaveFile($ListadoEstudiante);

    }else{

        foreach($ListadoEstudianteDecode as $elementDecode)
        {
            $element = new Estudiante();
            $element->set($elementDecode);

            array_push($ListadoEstudiante, $element);
        }
    }
    return $ListadoEstudiante;
}

public function GetById($id)
{
    $ListadoEstudiante = $this->GetList();
    $estudiante = $this->utilities->buscarCarreras($ListadoEstudiante,'id',$id)[0];
    return $estudiante;
}

public function Add($entity)
{
    $ListadoEstudiante =$this->GetList();
    $estudianteId =1;

    if(!empty($ListadoEstudiante)){
        $lastEstudiante = $this->utilities->getLastElement($ListadoEstudiante);
        $estudianteId = $lastEstudiante->id + 1;
    
    }

    $entity->id = $estudianteId;
    array_push($ListadoEstudiante, $entity);
    $this->fileHandler->SaveFile($ListadoEstudiante);
}

public function update($id, $entity)
{
    $element = $this->GetById($id);
    $ListadoEstudiante = $this->GetList();
    $elementIndex = $this->utilities->getIndexElement($ListadoEstudiante,'id',$id);
    $ListadoEstudiante[$elementIndex] = $entity;
    $this->fileHandler->SaveFile($ListadoEstudiante);
}

public function Delete($id)
{
    $ListadoEstudiante =$this->GetList();
    $elementIndex = $this->utilities->getIndexElement($ListadoEstudiante,'id',$id);
    unset($ListadoEstudiante[$elementIndex]);
    $ListadoEstudiante = array_values($ListadoEstudiante);
    $this->fileHandler->SaveFile($ListadoEstudiante);

}

}

?>