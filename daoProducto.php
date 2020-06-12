<?php

require_once("Producto.php");
require_once("classConexion.php");

class daoProducto extends Conexion { //Esta clase hereda de Conexión.
	
              
               public $Productos=array();    //Array de objetos Productos
               	
	           public function Listar() //Función para listar los productos
	           {
				   
				  $this->Productos=array(); //Hay que vaciar el array de objetos productos

                  $consulta = "select * FROM producto"; 

                  $param=array(); //Creo un array para pasarle parámetros

                  $this->Consulta($consulta,$param); //Ejecuto la consulta
            			
				  foreach ($this->datos as $fila)  //Recorro el array de la consulta
				  {
					   
					  $producto = new Producto();  //Creo un nuevo objeto
                                             //Le seteo las variables, y así me ahorro el constructor   
                      $producto->cod = $fila["cod"]; //Accedo a la propiedad directamente
					  $producto->__SET("nombre",$fila["nombre"]);
					  $producto->__SET("nombre_corto",$fila["nombre_corto"]);
                      $producto->__SET("descripcion",$fila["descripcion"]);
                      $producto->__SET("PVP",$fila["PVP"]);
                      $producto->__SET("familia",$fila["familia"]);
                    //   $producto->__SET("stock",$fila["stock"]);
                      
                      $this->Productos[]=$producto; //Meto el producto en el array productos
                      
					  
				  }
               }

               public function FiltrarProductos($familia, $preciominimo, $preciomaximo){

                $this->Productos=array(); //Hay que vaciar el array de objetos productos
				   
                $consulta="select * from producto WHERE 1 ";
                
                $param=array(); //Creo un array para pasarle parámetros


                if($familia->__GET("cod") != "-1") { //Si es -1, no entra y no viene en el param
                    $consulta .= "AND familia=:familia ";
                    $param[':familia']=$familia->__GET("cod");
                }

                if(!empty($preciominimo)) {
                    $consulta .= "AND PVP>=:PVPMinimo ";
                    $param[':PVPMinimo']=intval($preciominimo); //Lo parseo a int, ya que me llega como texto
                }

                if(!empty($preciomaximo)){
                    $consulta .= "AND PVP<=:PVPMaximo ";
                    $param[':PVPMaximo']=intval($preciomaximo); //Lo parseo a int, ya que me llega como texto
                }


                $this->Consulta($consulta,$param); //Ejecuto la consulta
                      
                foreach ($this->datos as $fila)  //Recorro el array de la consulta
                {
                     
                    $producto = new Producto();  //Creo un nuevo objeto
                                           //Le seteo las variables, y así me ahorro el constructor   
                    $producto->cod = $fila["cod"]; //Accedo a la propiedad directamente
                    $producto->__SET("nombre",$fila["nombre"]);
                    $producto->__SET("nombre_corto",$fila["nombre_corto"]);
                    $producto->__SET("descripcion",$fila["descripcion"]);
                    $producto->__SET("PVP",$fila["PVP"]);
                    $producto->__SET("familia",$fila["familia"]);
                   
                    $this->Productos[]=$producto; //Meto el producto en el array productos
                    
                    
                }
             }










        }


?>