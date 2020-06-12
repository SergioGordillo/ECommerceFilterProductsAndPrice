<?php

class Producto {
    
    //Atributos de la clase
     private $cod;
     private $nombre;
     private $nombre_corto;
     private $descripcion; 
     private $PVP;
     private $familia;
    

    //Creo los getters y setters. Por cómo voy a hacer el programa, no necesito constructor.
	 public function __GET($propiedad)
	 {
		 return $this->$propiedad;
	 }
	 public function __SET($propiedad,$valor)
	 {
		 $this->$propiedad=$valor;
	 }
		
}

?>