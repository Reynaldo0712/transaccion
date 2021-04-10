<?php
class Estudiante
{
    public $id;
    public $Monto;
    public $Descripcion; 
    public $fecha;


    private $utilities;

    public function __construct(){

        $this->utilities = New Utilities();
    }

    
    public function InicialiteData($id,$Monto,$Descripcion,$fecha/*,$status,$profilePhoto*/){
        $this->id = $id;
        $this->Monto= $Monto;
        $this->Descripcion=$Descripcion;
        $this->fecha=$fecha;

        
      /*$this->status =$status;
        $this->profilePhoto = $profilePhoto;*/
    }

    public function set($data)
    {
        foreach($data as $key =>$value) $this->{$key} = $value;

    }

    function getCarreraName()
    {
        if($this->carreraID != 0 && $this->carreraID != null)
        {
            return $this->utilities->carreras[$this->carreraID];
        }
    }

}

?>