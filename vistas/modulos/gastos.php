<?php

if($_SESSION["perfil"] == "Especial"){
 
  echo '<script>

    window.location = "inicio"; 

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Gastos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Gastos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarGasto">
          
          Agregar nuevo gasto

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaGastos" width="100%">
         
        <thead>
         
          <tr>
           
           <th style="width:10px">#</th>
           <th>Descripción</th>
           <th>Monto</th>
           <th>Pago</th>
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
MODAL AGREGAR GASTO
======================================-->

<div id="modalAgregarGasto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar gasto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDescripcionGasto" placeholder="Descripción de gasto" required>

                <input type="hidden" id="tipoPago" name="tipoPago" value="2">

                <input type="hidden" value="<?php echo $_SESSION['id']; ?>" id="idVendedor" name="idVendedor">

              </div>

            </div>

            <!-- ENTRADA PARA EL SECTOR DE PRODUCTOS -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="number" class="form-control input-lg" id="nuevoTotalGasto" name="nuevoTotalGasto" placeholder="Monto total" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">

              <div class="col-xs-6">

                <label>A pagar</label>
              
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                  <input type="number" class="form-control input-lg" id="nuevoPagoGasto" name="nuevoPagoGasto" placeholder="Monto pagado" required>

                </div>

              </div>

            </div>

            <!-- ENTRADA PARA LA REFERENCIA -->
            
            <div class="form-group">

              <div class="col-xs-6">

                <label>Deuda</label>
              
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                  <input type="text" class="form-control input-lg" id="nuevaDeudaGasto" name="nuevaDeudaGasto" placeholder="Monto en deuda" required readonly>

                </div>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar gasto</button>

        </div>

      </form>

      <?php

        $crearGasto = new ControladorGastos();
        $crearGasto -> ctrCrearGasto();

      ?>

    </div>

  </div>

</div>



<!--=====================================
MODAL AGREGAR PAGO
======================================-->

<div id="modalPagarGasto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Pagar gasto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE DEL PAGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevaDescripcionPago1" name="nuevaDescripcionPago1" required readonly>

                <input type="hidden" id="idPagoGasto" name="idPagoGasto" value="">

                <input type="hidden" id="tipoPago" name="tipoPago" value="2">

                <input type="hidden" value="<?php echo $_SESSION['id']; ?>" id="idVendedor" name="idVendedor">

              </div>

            </div>

            <!-- ENTRADA PARA EL TOTAL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="number" class="form-control input-lg" id="nuevoTotalPago" name="nuevoTotalPago" placeholder="Monto total" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">

              <div class="col-xs-6">

                <label>Pagado</label>
              
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                  <input type="number" class="form-control input-lg" id="pagado" name="pagado" value="" required readonly>

                </div>

              </div>

            </div>

            <!-- ENTRADA PARA LA REFERENCIA -->
            
            <div class="form-group">

              <div class="col-xs-6">

                <label>Deuda</label>
              
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                  <input type="text" class="form-control input-lg" id="deudaGasto" name="deudaGasto" value="" required readonly>

                </div>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">

              <div class="col-xs-6">

                <label>A pagar</label>
              
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                  <input type="number" class="form-control input-lg" id="nuevoPagoGasto1" name="nuevoPagoGasto1" placeholder="Monto a pagar" required>

                </div>

              </div>

            </div>

            <!-- ENTRADA PARA LA REFERENCIA -->
            
            <div class="form-group">

              <div class="col-xs-6">

                <label>Nuevo saldo</label>
              
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                  <input type="number" class="form-control input-lg" id="nuevaDeudaGasto1" name="nuevaDeudaGasto1" placeholder="Monto en deuda" value="" required readonly>

                </div>

                <br>

                <button class="btn btn-block" id="btnEstadoPago"></button>

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


<!--=====================================
MODAL EDITAR GASTO
======================================-->

<div id="modalEditarGasto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar gasto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDescripcionGasto" name="editarDescripcionGasto" required>

                <input type="hidden" name="idEditarGasto" id="idEditarGasto">

                <input type="hidden" id="tipoPago" name="tipoPago" value="2">

                <input type="hidden" value="<?php echo $_SESSION['id']; ?>" id="idVendedor" name="idVendedor">

              </div>

            </div>

            <!-- ENTRADA PARA EL SECTOR DE PRODUCTOS -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="number" class="form-control input-lg" id="editarTotalGasto" name="editarTotalGasto" placeholder="Monto total" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">

              <div class="col-xs-6">

                <label>Pagado</label>
              
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                  <input type="number" class="form-control input-lg" id="editarPagoGasto" name="editarPagoGasto" placeholder="Monto pagado" required readonly>

                </div>

              </div>

            </div>

            <!-- ENTRADA PARA LA REFERENCIA -->
            
            <div class="form-group">

              <div class="col-xs-6">

                <label>Deuda</label>
              
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                  <input type="text" class="form-control input-lg" id="editarDeudaGasto" name="editarDeudaGasto" placeholder="Monto en deuda" required readonly>

                </div>

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

        $editarGasto = new ControladorGastos();
        $editarGasto -> ctrEditarGasto();

      ?>

    </div>

  </div>

</div>


<?php

  // $eliminarProveedor = new ControladorGastos();
  // $eliminarProveedor -> ctrEliminarProveedor();

?>


