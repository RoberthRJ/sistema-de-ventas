<?php

require_once "../controladores/pagos.controlador.php";
require_once "../modelos/pagos.modelo.php";

require_once "../controladores/gastos.controlador.php";
require_once "../modelos/gastos.modelo.php";

class TablaGastos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE Proveedores
  	=============================================*/ 

	public function mostrarTablaGastos(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$gastos = ControladorGastos::ctrMostrarGastos($item, $valor, $orden);	

  		if(count($gastos) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($gastos); $i++){


		  	$tabla = "pagos";

		  	$id_pago = $gastos[$i]["id"];

		  	$tipo_pago = 2;

		  	$suma_pagos = ModeloPagos::mdlSumaPagos($tabla, $id_pago, $tipo_pago);


		  	$item = "id_pago";

			$datos = array("tipo_pago" => 2, "id_pago" => $id_pago);

			$orden = null;

			$pagos = ControladorPagos::ctrMostrarPagos($item, $datos, $orden);
			// echo '<pre>'; print_r($pagos); echo '</pre>';

			// echo "Este es el pago: ".$pagos[0]["total"];
			if (count($pagos) > 0) {
				$pago = $pagos[0]["total"];
				
			}else{
				$pago = 0;
			}

			
		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

  			

			$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarGasto' idGasto='".$gastos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarGasto' descripcion='".$gastos[$i]["descripcion"]."'><i class='fa fa-pencil'></i></button><button class='btn btn-success btnPagarGasto' idGasto='".$gastos[$i]["id"]."' tipoPago='2' data-toggle='modal' data-target='#modalPagarGasto' descripcion='".$gastos[$i]["descripcion"]."' title='Realizar pago'><i class='fa fa-money'></i></button><button class='btn btn-danger btnEliminarPGasto' idGasto='".$gastos[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$gastos[$i]["descripcion"].'",
			      "S/ '.$pago.'",
			      "S/ '.$suma_pagos[0].'",
			      "S/ '.($pago-$suma_pagos[0]).'",
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
$activarGastos = new TablaGastos();
$activarGastos -> mostrarTablaGastos();

