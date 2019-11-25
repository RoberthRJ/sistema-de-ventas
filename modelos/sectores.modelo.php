<?php

require_once "conexion.php"; 

class ModeloSectores{

	/*=============================================
	CREAR Proveedor
	=============================================*/

	static public function mdlIngresarSector($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(sector) VALUES (:sector)");

		$stmt->bindParam(":sector", $datos["sector"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";		
		}


		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR Proveedores
	=============================================*/

	static public function mdlMostrarSectores($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR Proveedor
	=============================================*/

	static public function mdlEditarSector($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET sector = :sector WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":sector", $datos["sector"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR Proveedor
	=============================================*/

	static public function mdlEliminarSector($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR Proveedor
	=============================================*/

	// static public function mdlActualizarProveedor($tabla, $item1, $valor1, $valor){

	// 	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

	// 	$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
	// 	$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

	// 	if($stmt -> execute()){

	// 		return "ok";
		
	// 	}else{

	// 		return "error";	

	// 	}

	// 	$stmt -> close();

	// 	$stmt = null;

	// }

}