<?php

class ControladorGastos{  

	/*=============================================
	CREAR Proveedores
	=============================================*/

	static public function ctrCrearGasto(){

		if(isset($_POST["nuevaDescripcionGasto"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcionGasto"]) &&

			   preg_match('/^[0-9]+$/', $_POST["nuevoTotalGasto"]) &&

			   preg_match('/^[0-9.]+$/', $_POST["nuevoPagoGasto"])){

			   	$tabla = "gastos";

			   	$datos = array("descripcion"=>$_POST["nuevaDescripcionGasto"]);

			   	$respuesta = ModeloGastos::mdlIngresarGasto($tabla, $datos);

			   	$respuesta = "ok";

			   
			   	if($respuesta == "ok"){

			   		$tabla = "gastos";

					$ultimo_gasto = ModeloCompras::mdlUltimoRegistro($tabla);

					$tabla = "pagos";

					$datos = array("tipo_pago"=>$_POST["tipoPago"],
								   "id_pago" => $ultimo_gasto['id'],
								   "id_vendedor" => $_POST["idVendedor"],
								   "pago"=>$_POST["nuevoPagoGasto"],
								   "total" => $_POST["nuevoTotalGasto"]);

					$respuesta = ModeloPagos::mdlCrearPago($tabla, $datos);
					echo '<pre>'; print_r($respuesta); echo '</pre>';

					if($respuesta == "ok"){

						echo'<script>

						swal({
							  type: "success",
							  title: "El gasto ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "gastos";

										}
									})

						</script>';
					}

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El gasto no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "gastos";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR Proveedores
	=============================================*/

	static public function ctrMostrarGastos($item, $valor, $orden){

		$tabla = "gastos";

		$respuesta = ModeloGastos::mdlMostrarGastos($tabla, $item, $valor, $orden);

		return $respuesta;

	}

	/*=============================================
	EDITAR Proveedor
	=============================================*/

	static public function ctrEditarGasto(){

		if(isset($_POST["editarDescripcionGasto"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcionGasto"]) &&

			   preg_match('/^[0-9]+$/', $_POST["editarTotalGasto"])){

			   	$tabla = "gastos";

			   	$datos = array("id"=>$_POST["idEditarGasto"],
			   				   "descripcion"=>$_POST["editarDescripcionGasto"]);

			   	$respuesta = ModeloGastos::mdlEditarGasto($tabla, $datos);

			   	if($respuesta == "ok"){


			   		$tabla = "pagos";

			   		$datos = array("id_pago"=>$_POST["idEditarGasto"],
			   				       "total"=>$_POST["editarTotalGasto"],
			   				       "tipo_pago" => 2);

			   		$respuesta = ModeloPagos::mdlEditarPago($tabla, $datos);


			   		if($respuesta == "ok"){

						echo'<script>

						swal({
							  type: "success",
							  title: "El gasto ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "gastos";

										}
									})

						</script>';
					}

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El gasto no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "gastos";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	ELIMINAR Proveedor
	=============================================*/

	static public function ctrEliminarProveedor(){

		if(isset($_GET["idProveedor"])){

			$tabla ="proveedores";
			$datos = $_GET["idProveedor"];

			$respuesta = ModeloProveedores::mdlEliminarProveedor($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El proveedor ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "proveedores";

								}
							})

				</script>';

			}		

		}

	}

}

