<?php

require_once "../controladores/sectores.controlador.php";
require_once "../modelos/sectores.modelo.php";

class AjaxSectores{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $idSector;

	public function ajaxEditarSector(){

		$item = "id";
		$valor = $this->idSector;

		$respuesta = ControladorSectores::ctrMostrarSectores($item, $valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["idSector"])){

	$sector = new AjaxSectores();
	$sector -> idSector = $_POST["idSector"];
	$sector -> ajaxEditarSector();

}