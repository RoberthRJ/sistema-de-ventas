<?php

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxCategorias{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idCategoria;

	public function ajaxEditarCategoria(){

		$item = "id";
		$valor = $this->idCategoria;
		$orden = null;

		$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor, $orden);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["idCategoria"])){

	$categoria = new AjaxCategorias();
	$categoria -> idCategoria = $_POST["idCategoria"];
	$categoria -> ajaxEditarCategoria();
}
