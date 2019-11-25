<?php

require_once "../controladores/sectores.controlador.php";
require_once "../modelos/sectores.modelo.php";

class TablaSectores{

 	/*=============================================
 	 MOSTRAR LA TABLA DE Proveedores
  	=============================================*/ 

	public function mostrarTablaSectores(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$sectores = ControladorSectores::ctrMostrarSectores($item, $valor, $orden);	

  		if(count($sectores) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($sectores); $i++){

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

  			if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial"){

  				$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarSector' idSector='".$sectores[$i]["id"]."' data-toggle='modal' data-target='#modalEditarSector'><i class='fa fa-pencil'></i></button></div>"; 

  			}else{

  				 $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarSector' idSector='".$sectores[$i]["id"]."' data-toggle='modal' data-target='#modalEditarSector'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarSector' idSector='".$sectores[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

  			}

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$sectores[$i]["sector"].'",
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
$activarSectores = new TablaSectores();
$activarSectores -> mostrarTablaSectores();

