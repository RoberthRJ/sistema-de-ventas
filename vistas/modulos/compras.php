<?php

if($_SESSION["perfil"] == "Vendedor"){ 

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar compras
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar compras</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

           
        <button class="btn btn-success" style="margin-top:5px">

          Descargar reporte en Excel

        </button>

        <!-- </div> -->
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaProductosCompras" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Código</th>
           <th>Descripción</th>
           <th>Categoría</th>
           <th>Stock</th>
           <th>Compra</th>
           <th>Venta</th>
           <th>Acciones</th>
           
         </tr> 

        </thead>      

       </table>

       <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaCompras" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Vendedor</th>
           <th>Proveedor</th>
           <th>Descripción</th>
           <th>Costo</th>
           <th>Cantidad</th>
           <th>Total</th>
           <th>Pagado</th>
           <th>Deuda</th>
           <th>Acciones</th>
           
         </tr> 

        </thead> 


       </table>

       <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">

      </div>

    </div>

  </section>

</div>


<!--=====================================
MODAL AGREGAR COMPRA
======================================-->

<div id="modalAgregarCompra" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar compra</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA PRODUCTO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="descripcion" name="descripcion" value="Textil de cuero" required readonly>

                <input type="hidden" id="idProducto" name="idProducto">

                <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">

              </div>

            </div>


            <!-- ENTRADA PARA STOCK -->

            <div class="form-group">

              <label >Stock actual</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="number" class="form-control input-lg" id="stock" name="stock" value="" readonly>

              </div>

            </div>


             <!-- ENTRADA PARA PRECIO VENTA -->

             <div class="form-group row">

                <div class="col-xs-6">

                  <label >Precio de compra</label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="costo" name="costo" value="15" readonly>

                  </div>

                </div>

                <div class="col-xs-6">

                  <label >Precio de venta</label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="precio" name="precio" value="50" readonly>

                  </div>

                </div>

              </div>

               <!-- ENTRADA PARA TOTAL -->

             <div class="form-group row">

              
                <!-- ENTRADA Stock-->

                <div class="col-xs-6">

                  <label >Stock a comprar</label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoIngreso" name="nuevoIngreso" step="any" min="0" placeholder="Stock a comprar" required>

                  </div>

                </div>

                <!-- ENTRADA Stock-->
                <div class="col-xs-6">

                  <label >Stock final</label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-money"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoStock" name="nuevoStock" step="any" min="0" placeholder="Total" readonly required>

                  </div>

                </div>
              </div>

              <hr>


              <!-- ENTRADA PARA TOTAL -->

             <div class="form-group row">

              <!-- ENTRADA TOTAL-->

                <div class="col-xs-12">

                  <label >TOTAL</label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoTotal" name="nuevoTotal" step="any" min="0" placeholder="Total a pagar" required readonly>

                  </div>

                </div>

              
                <!-- ENTRADA Stock-->

                <div class="col-xs-6">

                  <label>Pago</label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPago" name="nuevoPago" step="any" min="0" placeholder="Pago a realizar" required>

                  </div>

                </div>

                <!-- ENTRADA Stock-->
                <div class="col-xs-6">

                  <label >Saldo</label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-money"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoSaldo" name="nuevoSaldo" step="any" min="0" placeholder="Total" readonly required>

                  </div>

                  <br>

                  <button type="button" id="botonEstadoCompra" class="btn btn-block ">Estado</button>

                  <input type="hidden" name="tipoPago" value="1">

                </div>

              </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar compra</button>

        </div>

      </form>

        <?php

          $crearCompra = new ControladorCompras();
          $crearCompra -> ctrCrearCompra();

        ?>  

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR COMPRA
======================================-->

<div id="modalEditarCompra" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar compra</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA PRODUCTO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" value="" required readonly>

                <input type="hidden" id="idEditarCompra" name="idEditarCompra">

                <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">

              </div>

            </div>


            <!-- ENTRADA PARA STOCK -->

            <div class="form-group">

              <label >Stock actual</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" value="" readonly>

              </div>

            </div>


             <!-- ENTRADA PARA PRECIO VENTA -->

             <div class="form-group row">

                <div class="col-xs-6">

                  <label >Precio de compra</label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarCostoCompra" name="editarCostoCompra" value="" readonly>

                  </div>

                </div>

                <div class="col-xs-6">

                  <label >Precio de venta</label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" value="" readonly>

                  </div>

                </div>

              </div>

               <!-- ENTRADA PARA TOTAL -->

             <div class="form-group row">

              
                <!-- ENTRADA Stock-->

                <div class="col-xs-6">

                  <label >Stock a comprar</label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarNuevoIngreso" name="editarNuevoIngreso" step="any" min="0" value="" required>

                    <input type="hidden" id="editarNuevoIngresoHidden" name="editarNuevoIngresoHidden">

                  </div>

                </div>

                <!-- ENTRADA Stock-->
                <div class="col-xs-6">

                  <label >Stock final</label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-money"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarNuevoStock" name="editarNuevoStock" step="any" min="0" placeholder="Total" readonly required>

                  </div>

                </div>
              </div>

              <hr>


              <!-- ENTRADA PARA TOTAL -->

             <div class="form-group row">

              <!-- ENTRADA TOTAL-->

                <div class="col-xs-12">

                  <label >TOTAL</label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarNuevoTotal" name="editarNuevoTotal" step="any" min="0" required readonly>

                  </div>

                </div>

              
                <!-- ENTRADA Stock-->

                <div class="col-xs-6">

                  <label>Pago</label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarNuevoPago" name="editarNuevoPago" step="any" min="0" readonly required>

                  </div>

                </div>

                <!-- ENTRADA Stock-->
                <div class="col-xs-6">

                  <label >Saldo</label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-money"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarNuevoSaldo" name="editarNuevoSaldo" step="any" min="0" readonly required>

                  </div>

                  <br>

                  <button type="button" id="botonEstadoCompra" class="btn btn-block ">Estado</button>

                </div>

              </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      </form>

        <?php

          $editarCompra = new ControladorCompras();
          $editarCompra -> ctrEditarCompra();

        ?>  

    </div>

  </div>

</div>

<?php

 $eliminarCompra = new ControladorCompras();
 $eliminarCompra -> ctrEliminarCompra();

?>      




<!--=====================================
MODAL PAGAR COMPRA
======================================-->

<div id="modalPagarCompra" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Pagar compra</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA PRODUCTO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="descripcionCompra" name="descripcionCompra" value="" required readonly>

                <input type="hidden" id="idCompra" name="idCompra">

                <input type="hidden" id="tipo_pago" name="tipo_pago">

                <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">

              </div>

            </div>


            <!-- ENTRADA PARA TOTAL PAGADO -->

            <div class="form-group">

              <label >Total de compra</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="number" class="form-control input-lg" id="nuevoTotalPago" name="nuevoTotalPago" value="" readonly>

              </div>

            </div>


             <!-- ENTRADA PARA PRECIO VENTA -->

             <div class="form-group row">

                <div class="col-xs-6">

                  <label >Pagado</label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="pagado" name="pagado" value="15" readonly>

                  </div>

                </div>

                <div class="col-xs-6">

                  <label >Deuda</label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="deuda" name="deuda" value="50" readonly>

                  </div>

                </div>

              </div>

               <!-- ENTRADA PARA TOTAL -->

             <div class="form-group row">

              
                <!-- ENTRADA Stock-->

                <div class="col-xs-6">

                  <label >A pagar</label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPagoCompra" name="nuevoPagoCompra" step="any" min="0" placeholder="Pago a realizar" required>

                  </div>

                </div>

                <!-- ENTRADA Stock-->
                <div class="col-xs-6">

                  <label >Saldo final</label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-money"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoSaldoCompra" name="nuevoSaldoCompra" step="any" min="0" placeholder="Total" readonly required>

                  </div>

                  <br>

                  <button type="button" class="btn btn-block" id="btnEstadoPago">Estado</button>

                </div>
              </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar pago</button>

        </div>

      </form>

        <?php

          $crearPago = new ControladorPagos();
          $crearPago -> ctrCrearPago();

        ?>  

    </div>

  </div>

</div>

