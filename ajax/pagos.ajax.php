<?php

require_once "../controladores/pagos.controlador.php"; 
require_once "../modelos/pagos.modelo.php";

class AjaxPagos{

  
  /*=============================================
  EDITAR Compra
  =============================================*/ 

  public $idPago;
  public $tipoPago;

  public function ajaxAgregarPago(){

      $item = "id_pago";

      $datos = array("tipo_pago" => $this->tipoPago, "id_pago" => $this->idPago);

      $orden = null;

      $respuesta = ControladorPagos::ctrMostrarPagos($item, $datos, $orden);

      // $respuesta = $datos;

      echo json_encode($respuesta);

  }

}


/*=============================================
EDITAR Compra
=============================================*/ 

if(isset($_POST["idCompra"])){

  $agregarPago = new AjaxPagos();
  $agregarPago -> idPago = $_POST["idCompra"];
  $agregarPago -> tipoPago = $_POST["tipoPago"];
  $agregarPago -> ajaxAgregarPago();

}








