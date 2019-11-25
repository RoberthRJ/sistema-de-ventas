<?php

require_once "../controladores/compras.controlador.php"; 
require_once "../modelos/compras.modelo.php";

require_once "../controladores/productos.controlador.php"; 
require_once "../modelos/productos.modelo.php";

require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

require_once "../modelos/pagos.modelo.php";

class TablaCompras{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/
  	public function mostrarTablaCompras(){

  		$item = null;
    	$valor = null;
    	$orden = "id";

  		$compras = ControladorCompras::ctrMostrarCompras($item, $valor, $orden);

  		if(count($compras) == 0){

  			echo '{"data": []}';

		  	return;
  		}


  		$datosJson = '{
		  "data": [';
		  	for ($i=0; $i < count($compras); $i++) { 

		  		
			  	$tabla = "pagos";

			  	$id_pago = $compras[$i]["id"];

			  	$tipo_pago = 1;

			  	$suma_pagos = ModeloPagos::mdlSumaPagos($tabla, $id_pago, $tipo_pago);


	  			/*=============================================
	 	 		TRAEMOS EL PRODUCTO
	  			=============================================*/ 

	  			$item = "id";
		  		$valor = $compras[$i]["id_producto"];
		  		$orden = null;

		  		$producto = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

		  		/*=============================================
	 	 		TRAEMOS EL PROVEEDOR
	  			=============================================*/ 

		  		$item = "id";
		  		$valor = $producto["id_proveedor"];
		  		$orden = null;

		  		$proveedor = ControladorProveedores::ctrMostrarProveedores($item, $valor, $orden);

		  		/*=============================================
	 	 		TRAEMOS EL VENDEDOR
	  			=============================================*/ 

	  			$item1 = "id";
	    		$valor1 = $compras[$i]['id_vendedor'];

	  			$vendedor = ControladorUsuarios::ctrMostrarUsuarios($item1, $valor1);

	  			if ($producto['precio_compra']*$compras[$i]['cantidad'] == $suma_pagos[0]) {

	  				$pago = "<button class='btn btn-success'>S/ ".$suma_pagos[0]."</i></button>";

			  		$deuda = "<button class='btn btn-warning'>S/ 0</i></button>";

			  		$disabled = "disabled";

	  			}else{

	  				$pago = "<button class='btn btn-primary'>S/ ".$suma_pagos[0]."</i></button>";

			  		$deuda = "<button class='btn btn-danger'>S/ ".($producto['precio_compra']*$compras[$i]['cantidad'] - $suma_pagos[0])."</i></button>";

			  		$disabled = "";

	  			}


	  			$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarCompra' idCompra='".$compras[$i]["id"]."' idProducto='".$producto['id']."' data-toggle='modal' data-target='#modalEditarCompra' descripcion='".$producto["descripcion"]."' title='Editar compra'><i class='fa fa-pencil'></i></button><button class='btn btn-success btnPagarCompra' idCompra='".$compras[$i]["id"]."' tipoPago='1' data-toggle='modal' data-target='#modalPagarCompra' title='Pagar compra' ".$disabled." descripcion='".$producto["descripcion"]."'><i class='fa fa-money'></i></button><button class='btn btn-danger btnEliminarCompra' idCompra='".$compras[$i]["id"]."' title='Eliminar Compra'><i class='fa fa-times'></i></button></div>";


		  		$datosJson .= '[
				      "'.($i+1).'",
				      "'.$vendedor['nombre'].'",
				      "'.$proveedor['razon_social'].'",
				      "'.$producto['descripcion'].'",
				      "S/ '.$producto['precio_compra'].'",
				      "'.$compras[$i]['cantidad'].'",
				      "S/ '.($producto['precio_compra']*$compras[$i]['cantidad']).'",
				      "'.$pago.'",
				      "'.$deuda.'",
				      "'.$botones.'"
				    ],'	;	
				}
			$datosJson = substr($datosJson, 0, -1);
				    
			$datosJson .=']
			}';

  		echo $datosJson;
  		
  	}

}


/*=============================================
ACTIVAR TABLA DE CompraS
=============================================*/ 
$activarCompras = new TablaCompras();
$activarCompras -> mostrarTablaCompras();