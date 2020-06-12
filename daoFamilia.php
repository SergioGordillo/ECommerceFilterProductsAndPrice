<?php

require_once("Familia.php");
require_once("classConexion.php");

class daoFamilia extends Conexion { //Esta clase hereda de Conexión.
	
              
               public $Familias=array();    //Array de objetos Familias
               	
	           public function Listar() //Función para listar las familias
	           {
				   
				  $this->Familias=array(); //Hay que vaciar el array de familias
				   
				  $consulta="select * from familia";

                  $param=array(); //Creo un array para pasarle parámetros

                  $this->Consulta($consulta,$param); //Ejecuto la consulta
            			
				  foreach ($this->datos as $fila)  //Recorro el array de la consulta
				  {
					   
					  $familia = new Familia();  //Creo un nuevo objeto
                                             //Le seteo las variables, y así me ahorro el constructor   
                      $familia->cod = $fila["cod"]; //Accedo a la propiedad directamente
					  $familia->__SET("nombre",$fila["nombre"]);
					 
                      $this->Familias[]=$familia; //Meto el producto en el array familia
                      
					  
				  }
               }

        }


?>