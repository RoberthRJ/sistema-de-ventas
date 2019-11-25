<?php

require_once "../controladores/productos.controlador.php"; 
require_once "../modelos/productos.modelo.php";

class AjaxCompras{

  
  /*=============================================
  EDITAR Compra
  =============================================*/ 

  public $idProducto;

  public function ajaxAgregarCompra(){

      $item = "id";

      $valor = $this->idProducto;

      $orden = null;

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

      echo json_encode($respuesta);

  }

}


/*=============================================
EDITAR Compra
=============================================*/ 

if(isset($_POST["idProducto"])){

  $agregarCompra = new AjaxCompras();
  $agregarCompra -> idProducto = $_POST["idProducto"];
  $agregarCompra -> ajaxAgregarCompra();

}








