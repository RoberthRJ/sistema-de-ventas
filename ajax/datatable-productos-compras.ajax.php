<?php

require_once "../controladores/productos.controlador.php"; 
require_once "../modelos/productos.modelo.php";

require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class TablaProductosCompras{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/
  	public function mostrarTablaProductosCompras(){

  		$item = null;
    	$valor = null;
    	$orden = "id";

  		$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

  		if(count($productos) == 0){

  			echo '{"data": []}';

		  	return;
  		}

  		
  		

  		$datosJson = '{
		  "data": [';
		  	for ($i=0; $i < count($productos); $i++) { 

		  		$botones = "<div class='btn-group'><button class='btn btn-success btnAgregarCompra' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalAgregarCompra'><i class='fa fa-plus'></i> Agregar compra</button></div>";

		  		// $botones = "";


	  			$item = "id";
		  		$valor = $productos[$i]["id_categoria"];
		  		$orden = null;

		  		$categoria = ControladorCategorias::ctrMostrarCategorias($item, $valor, $orden);

		  		/*=============================================
	 	 		TRAEMOS EL VENDEDOR
	  			=============================================*/ 

	  			// $item1 = "id";
	    	// 	$valor1 = $productos[$i]['id_vendedor'];

	  			// $vendedor = ControladorUsuarios::ctrMostrarUsuarios($item1, $valor1);



		  		$datosJson .= '[
				      "'.($i+1).'",
				      "'.$productos[$i]['codigo'].'",
				      "'.$productos[$i]['descripcion'].'",
				      "'.$categoria['categoria'].'",
				      "'.$productos[$i]['stock'].'",
				      "S/ '.$productos[$i]['precio_compra'].'",
				      "S/ '.$productos[$i]['precio_venta'].'",
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
$activarProductosCompras = new TablaProductosCompras();
$activarProductosCompras -> mostrarTablaProductosCompras();