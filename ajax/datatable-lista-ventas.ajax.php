<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";


class TablaVentas{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaVentas(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$ventas = ControladorVentas::ctrMostrarVentas($item, $valor, $orden);
 		
  		if(count($ventas) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($ventas); $i++){

		  	/*=============================================
 	 		TRAEMOS EL VENDEDOR
  			=============================================*/ 

  			$item = "id";
    		$valor = $ventas[$i]['id_vendedor'];

  			$vendedor = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

  			/*=============================================
 	 		TRAEMOS EL CLIENTE
  			=============================================*/ 

  			$item = "id";
       	 	$valor = $ventas[$i]['id_cliente'];

        	$cliente = ControladorClientes::ctrMostrarClientes($item, $valor);


		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

		  	if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Vendedor"){

  				$botones =  "<div class='btn-group'><a class='btn btn-success btnGenerarXML' href='index.php?ruta=ventas&xml=".$ventas[$i]['codigo']."'>XML</a><button class='btn btn-info btnImprimirFactura' codigoVenta='".$ventas[$i]['codigo']."'><i class='fa fa-print'></i></button></div>"; 

  			}else{

  				 $botones =  "<div class='btn-group'><a class='btn btn-success btnGenerarXML' href='index.php?ruta=ventas&xml=".$ventas[$i]['codigo']."'>XML</a><button class='btn btn-info btnImprimirFactura' codigoVenta='".$ventas[$i]['codigo']."'><i class='fa fa-print'></i></button><button class='btn btn-warning btnEditarVenta' idVenta='".$ventas[$i]['id']."'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarVenta' idVenta='".$ventas[$i]['id']."'><i class='fa fa-times'></i></button></div>"; 

  			}

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$ventas[$i]["codigo"].'",
			      "'.$cliente["nombre"].'",
			      "'.$vendedor["nombre"].'",
			      "'.$ventas[$i]["metodo_pago"].'",
			      "'.$ventas[$i]["neto"].'",
			      "'.$ventas[$i]["total"].'",
			      "'.$ventas[$i]["fecha"].'",
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
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarVentas = new TablaVentas();
$activarVentas -> mostrarTablaVentas();

