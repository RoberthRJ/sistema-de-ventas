<?php

require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

require_once "../controladores/sectores.controlador.php";
require_once "../modelos/sectores.modelo.php";

class TablaProveedores{

 	/*=============================================
 	 MOSTRAR LA TABLA DE Proveedores
  	=============================================*/ 

	public function mostrarTablaProveedores(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor, $orden);	

  		if(count($proveedores) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($proveedores); $i++){

		  	$item = "id";
    		// $valor = 1;
    		$valor = $proveedores[$i]["id_sector"];

  			$sector = ControladorSectores::ctrMostrarSectores($item, $valor);

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

  			if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial"){

  				$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProveedor' idProveedor='".$proveedores[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button></div>"; 

  			}else{

  				 $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProveedor' idProveedor='".$proveedores[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProveedor'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProveedor' idProveedor='".$proveedores[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

  			}

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$proveedores[$i]["razon_social"].'",
			      "'.$sector["sector"].'",
			      "'.$proveedores[$i]["direccion"].'",
			      "'.$proveedores[$i]["referencia"].'",
			      "'.$proveedores[$i]["telefono"].'",
			      "'.$proveedores[$i]["email"].'",
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE Proveedores
=============================================*/ 
$activarProveedores = new TablaProveedores();
$activarProveedores -> mostrarTablaProveedores();

