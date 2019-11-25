<?php

class ControladorCompras{ 
 
	/*=============================================
	MOSTRAR COMPRAS
	=============================================*/

	static public function ctrMostrarCompras($item, $valor, $orden){

		$tabla = "compras";

		$respuesta = ModeloCompras::mdlMostrarCompras($tabla, $item, $valor, $orden);

		return $respuesta;

	}

	/*=============================================
	CREAR COMPRA
	=============================================*/

	static public function ctrCrearCompra(){

		if(isset($_POST["nuevoStock"])){

			if(preg_match('/^[0-9]+$/', $_POST["nuevoStock"])){

				$tabla = "compras";

				$datos = array("id_vendedor"=>$_POST["idVendedor"],
							   "id_producto" => $_POST["idProducto"],
							   "cantidad" => $_POST["nuevoIngreso"]);

				$respuesta = ModeloCompras::mdlCrearCompra($tabla, $datos);

				if($respuesta == "ok"){

					$tabla = "productos";
					$item1 = "stock";
					$valor1 = $_POST["nuevoStock"];
					$valor = $_POST["idProducto"];

					$respuesta = ModeloProductos::mdlActualizarProducto($tabla, $item1, $valor1, $valor);

					if ($respuesta == "ok") {

						$tabla = "compras";

						$ultimo_pago = ModeloCompras::mdlUltimoRegistro($tabla);

						$tabla = "pagos";

						$datos = array("tipo_pago"=>$_POST["tipoPago"],
									   "id_pago" => $ultimo_pago['id'],
									   "pago"=>$_POST["nuevoPago"],
									   "total" => $_POST["nuevoTotal"]);

						$respuesta = ModeloPagos::mdlCrearPago($tabla, $datos);
						echo '<pre>'; print_r($respuesta); echo '</pre>';

						if ($respuesta == "ok") {
							
							echo'<script>

							swal({
								  type: "success",
								  title: "La compra ha sido guardada correctamente",
								  showConfirmButton: true,
								  confirmButtonText: "Cerrar"
								  }).then(function(result){
											if (result.value) {

											window.location = "compras";

											}
										})

							</script>';

						}
					}
				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "compras";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	EDITAR COMPRA
	=============================================*/

	static public function ctrEditarCompra(){

		if(isset($_POST["editarDescripcionCompra"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcionCompra"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editarPago"]) &&	
			   preg_match('/^[0-9.]+$/', $_POST["editarPrecioCompra1"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarCantidadCompra"])){

		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/

			   	$ruta = $_POST["imagenActualCompra"];

			   	if(isset($_FILES["editarImagenCompra"]["tmp_name"]) && !empty($_FILES["editarImagenCompra"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarImagenCompra"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/compras/".$_POST["editarCodigoCompra"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["imagenActualCompra"]) && $_POST["imagenActualCompra"] != "vistas/img/compras/default/anonymous.png"){

						unlink($_POST["imagenActualCompra"]);

					}else{

						mkdir($directorio, 0755);	
					
					}

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarImagenCompra"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/compras/".$_POST["editarCodigoCompra"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImagenCompra"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarImagenCompra"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/compras/".$_POST["editarCodigoCompra"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarImagenCompra"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "compras";

				$datos = array("id_proveedor" => $_POST["editarProveedor"],
							   "codigo_compra" => $_POST["editarCodigoCompra"],
							   "descripcion" => $_POST["editarDescripcionCompra"],
							   "costo_unitario" => $_POST["editarPrecioCompra1"],
							   "cantidad" => $_POST["editarCantidadCompra"],
							   "pagado100" => $_POST["editarEstadoCompra"],
							   "pagado" => $_POST["editarPago"],
							   "debe" => $_POST["editarDeuda"],
							   "imagen" => $ruta);

				$respuesta = ModeloCompras::mdlEditarCompra($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "La compra ha sido editada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "compras";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "compras";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarCompra(){

		if(isset($_GET["idCompra"])){

			$tabla ="compras";
			$datos = $_GET["idCompra"];

			if($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/compras/default/anonymous.png"){

				unlink($_GET["imagen"]);
				rmdir('vistas/img/compras/'.$_GET["codigoCompra"]);

			}

			$respuesta = ModeloCompras::mdlEliminarCompra($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "compras";

								}
							})

				</script>';

			}		
		}


	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/

	static public function ctrMostrarSumaVentas(){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarSumaVentas($tabla);

		return $respuesta;

	}


	/*=============================================
	DESCARGAR EXCEL
	=============================================*/

	public function ctrDescargarReporteCompras(){

		if(isset($_GET["reporte"])){

			$tabla = "compras";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;
				$orden = null;
				$compras = ModeloCompras::mdlMostrarCompras($tabla, $item, $valor, $orden);

			}


			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO COMPRA</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>PROVEEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>DESCRIPCION</td>
					<td style='font-weight:bold; border:1px solid #eee;'>COSTO UNITARIO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>
					<td style='font-weight:bold; border:1px solid #eee;'>ESTADO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PAGADO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>DEUDA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		
					</tr>");

			foreach ($compras as $row => $item){

				$proveedor = ControladorProveedores::ctrMostrarProveedores("id", $item["id_proveedor"],null);

					if ($item["pagado100"]==1) {
						$pagado100 = "Pagado";
					}else{
						$pagado100 = "Deuda";
					}

			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["codigo_compra"]."</td> 
			 			<td style='border:1px solid #eee;'>".$proveedor["razon_social"]."</td>
			 			<td style='border:1px solid #eee;'>".$item["descripcion"]."</td>
			 			<td style='border:1px solid #eee;'>S/ ".number_format($item["costo_unitario"],2)."</td>
						<td style='border:1px solid #eee;'>S/ ".number_format($item["cantidad"],2)."</td>	
						<td style='border:1px solid #eee;'>S/ ".number_format($item["costo_unitario"]*$item["cantidad"],2)."</td>
						<td style='border:1px solid #eee;'>".$pagado100."</td>
						<td style='border:1px solid #eee;'>S/ ".number_format($item["pagado"],2)."</td>
						<td style='border:1px solid #eee;'>S/ ".number_format($item["debe"],2)."</td>
						<td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>		
			 			</tr>");

			}


			echo "</table>";

		}

	}


}