<?php

require_once "../controladores/compras.controlador.php"; 
require_once "../modelos/compras.modelo.php";

class AjaxCompras{

  
  /*=============================================
  EDITAR Compra
  =============================================*/ 

  public $idCompra;

  public function ajaxMostrarCompra(){

      $item = "id";

      $valor = $this->idCompra;

      $orden = null;

      $respuesta = ControladorCompras::ctrMostrarCompras($item, $valor, $orden);

      echo json_encode($respuesta);

  }

}


/*=============================================
EDITAR Compra
=============================================*/ 

if(isset($_POST["idCompra"])){

  $compra = new AjaxCompras();
  $compra -> idCompra = $_POST["idCompra"];
  $compra -> ajaxMostrarCompra();

}








