<?php

require_once "conexion.php";  

class ModeloPagos{

	/*=============================================
	MOSTRAR Pago
	=============================================*/

	static public function mdlMostrarPagos($tabla, $item, $datos, $orden){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ");
			//ORDER BY id DESC

			$stmt -> bindParam(":".$item, $datos["id_pago"], PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

			return $datos;

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
			//ORDER BY $orden DESC

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE Pago
	=============================================*/
	static public function mdlCrearPago($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(tipo_pago, id_pago, id_vendedor,  pago, total) VALUES (:tipo_pago, :id_pago, :id_vendedor, :pago, :total)");

		$stmt->bindParam(":tipo_pago", $datos["tipo_pago"], PDO::PARAM_INT);
		$stmt->bindParam(":id_pago", $datos["id_pago"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":pago", $datos["pago"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR Pago
	=============================================*/
	static public function mdlEditarPago($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET total = :total WHERE (id_pago = :id_pago AND tipo_pago = :tipo_pago)");

		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_INT);
		$stmt->bindParam(":id_pago", $datos["id_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_pago", $datos["tipo_pago"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR Pago
	=============================================*/

	static public function mdlEliminarPago($tabla, $datos){

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
	ACTUALIZAR PRODUCTO
	=============================================*/

	static public function mdlActualizarPago($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/	

	static public function mdlMostrarSumaVentas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	}

	/*=============================================
	MOSTRAR SUMA PAGOS PRODUCTO
	=============================================*/	

	static public function mdlSumaPagos($tabla, $id_pago, $tipo_pago){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(pago) as pagos FROM $tabla WHERE (id_pago = $id_pago AND tipo_pago = $tipo_pago)");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	}


}