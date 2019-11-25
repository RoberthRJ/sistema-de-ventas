<?php

class ControladorProveedores{  

	/*=============================================
	CREAR Proveedores
	=============================================*/

	static public function ctrCrearProveedor(){

		if(isset($_POST["nuevoProveedor"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoProveedor"]) &&

			   preg_match('/^[0-9]+$/', $_POST["nuevoSector"]) &&

			   preg_match('/^[#\.\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDireccion"]) && 
			   
			   preg_match('/^[#\.\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaReferencia"]) && 
			    
			   preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) && 

			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"])){

			   	$tabla = "proveedores";

			   	$datos = array("razon_social"=>$_POST["nuevoProveedor"],
					           "id_sector"=>$_POST["nuevoSector"],
					           "direccion"=>$_POST["nuevaDireccion"],
					           "referencia"=>$_POST["nuevaReferencia"],
					           "telefono"=>$_POST["nuevoTelefono"],
					           "email"=>$_POST["nuevoEmail"]);

			   	$respuesta = ModeloProveedores::mdlIngresarProveedor($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El proveedor ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "proveedores";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El proveedor no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "proveedores";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR Proveedores
	=============================================*/

	static public function ctrMostrarProveedores($item, $valor, $orden){

		$tabla = "proveedores";

		$respuesta = ModeloProveedores::mdlMostrarProveedores($tabla, $item, $valor, $orden);

		return $respuesta;

	}

	/*=============================================
	EDITAR Proveedor
	=============================================*/

	static public function ctrEditarProveedor(){

		if(isset($_POST["editarProveedor"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarProveedor"]) &&

			   preg_match('/^[#\.\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarSector"]) &&

			   preg_match('/^[#\.\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDireccionProveedor"]) && 
			   
			   preg_match('/^[#\.\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarReferencia"]) && 
			    
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefonoProveedor"]) && 

			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmailProveedor"])){

			   	$tabla = "proveedores";

			   	$datos = array("razon_social"=>$_POST["editarProveedor"],
					           "sector_productos"=>$_POST["editarSector"],
					           "direccion"=>$_POST["editarDireccionProveedor"],
					           "referencia"=>$_POST["editarReferencia"],
					           "telefono"=>$_POST["editarTelefonoProveedor"],
					           "email"=>$_POST["editarEmailProveedor"]);

			   	$respuesta = ModeloProveedores::mdlEditarProveedor($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El proveedor ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "proveedores";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El proveedor no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "proveedores";

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

