<?php

require_once "conexion.php";  

class ModeloCompras{

	/*=============================================
	MOSTRAR COMPRA
	=============================================*/

	static public function mdlMostrarCompras($tabla, $item, $valor, $orden){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ");
			//ORDER BY id DESC

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			//ORDER BY $orden DESC

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE COMPRA
	=============================================*/
	static public function mdlCrearCompra($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_vendedor, id_producto, cantidad) VALUES (:id_vendedor, :id_producto, :cantidad)");

		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR COMPRA
	=============================================*/
	static public function mdlEditarCompra($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_proveedor = :id_proveedor, descripcion = :descripcion, imagen = :imagen, costo_unitario = :costo_unitario, cantidad = :cantidad, pagado100 = :pagado100, pagado = :pagado, debe = :debe WHERE codigo_compra = :codigo_compra");

		$stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo_compra", $datos["codigo_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":costo_unitario", $datos["costo_unitario"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":pagado100", $datos["pagado100"], PDO::PARAM_INT);
		$stmt->bindParam(":pagado", $datos["pagado"], PDO::PARAM_STR);
		$stmt->bindParam(":debe", $datos["debe"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR COMPRA
	=============================================*/

	static public function mdlEliminarCompra($tabla, $datos){

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

	static public function mdlActualizarProducto($tabla, $item1, $valor1, $valor){

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



	static public function mdlUltimoRegistro($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id FROM $tabla ORDER BY id DESC LIMIT 1");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}


}