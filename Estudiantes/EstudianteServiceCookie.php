<?php
class EstudianteServiceCookie implements IServiceBase{

private $utilities;
private $cookieName;

public function __construct()
{
    $this->utilities = new Utilities();
    $this->cookieName ="estudiantes";
}

public function GetList()
{
    $ListadoEstudiante = array();
    if(isset($_COOKIE[$this->cookieName])){
        $ListadoEstudianteDecode =json_decode($_COOKIE[$this->cookieName],false);
        foreach($ListadoEstudianteDecode as $elementDecode)
        {
            $element = new Estudiante();
            $element->set($elementDecode);

            array_push($ListadoEstudiante, $element);
        }
    }else{
        setcookie($this->cookieName,json_encode($ListadoEstudiante),$this->utilities->GetCookieTime(),"/");
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
        $estudianteId = $lastEstudiante->id + 1;}

    $entity->id = $estudianteId;
    array_push($ListadoEstudiante, $entity);
    setcookie($this->cookieName,json_encode($ListadoEstudiante),$this->utilities->GetCookieTime(),"/");
}

public function update($id, $entity)
{
    $element = $this->GetById($id);
    $ListadoEstudiante = $this->GetList();
    $elementIndex = $this->utilities->getIndexElement($ListadoEstudiante,'id',$id);
    $ListadoEstudiante[$elementIndex] = $entity;
    setcookie($this->cookieName,json_encode($ListadoEstudiante),$this->utilities->GetCookieTime(),"/");
}

public function Delete($id)
{
    $ListadoEstudiante =$this->GetList();
    $elementIndex = $this->utilities->getIndexElement($ListadoEstudiante,'id',$id);
    unset($ListadoEstudiante[$elementIndex]);
    $ListadoEstudiante = array_values($ListadoEstudiante);
    setcookie($this->cookieName,json_encode($ListadoEstudiante),$this->utilities->GetCookieTime(),"/");
}

}

?>