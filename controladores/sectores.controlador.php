<?php

class ControladorSectores{  

	/*=============================================
	CREAR Proveedores
	=============================================*/

	static public function ctrCrearSector(){

		if(isset($_POST["nuevoSector"])){

			if(preg_match('/^[#\.\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoSector"])){

			   	$tabla = "sectores";

			   	$datos = array("sector"=>$_POST["nuevoSector"]);

			   	$respuesta = ModeloSectores::mdlIngresarSector($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El sector ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "sectores";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El sector no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "sectores";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR Proveedores
	=============================================*/

	static public function ctrMostrarSectores($item, $valor){

		$tabla = "sectores";

		$respuesta = ModeloSectores::mdlMostrarSectores($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR Proveedor
	=============================================*/

	static public function ctrEditarSector(){

		if(isset($_POST["editarSector"])){

			if(preg_match('/^[#\.\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarSector"])){

			   	$tabla = "sectores";

			   	$datos = array("id"=>$_POST["idSector"],
			   				   "sector"=>$_POST["editarSector"]);

			   	$respuesta = ModeloSectores::mdlEditarSector($tabla, $datos);

			   	// $respuesta = "ok";

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El sector ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "sectores";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El sector no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "sectores";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	ELIMINAR Proveedor
	=============================================*/

	static public function ctrEliminarSector(){

		if(isset($_GET["idSector"])){

			$tabla ="sectores";
			$datos = $_GET["idSector"];

			$respuesta = ModeloSectores::mdlEliminarSector($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El sector ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "sectores";

								}
							})

				</script>';

			}		

		}

	}

}

