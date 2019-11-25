/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/ 

// $.ajax({

// 	url: "ajax/datatable-productos.ajax.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// })


$('.tablaCompras').DataTable( {
    "ajax": "ajax/datatable-compras.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {
	 		"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
});


$('.tablaProductosCompras').DataTable( {
    "ajax": "ajax/datatable-productos-compras.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {
	 		"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
});
/*=============================================
CALCULANDO EL TOTAL
=============================================*/

$("#nuevaCantidadCompra, #editarCantidadCompra").change(function(){


	var valorCompra = $("#nuevoPrecioCompra1").val() * $("#nuevaCantidadCompra").val();
	$("#nuevoTotalCompra").val(valorCompra);

	var valorEditarCompra = $("#editarPrecioCompra1").val() * $("#editarCantidadCompra").val();
	$("#editarTotalCompra").val(valorEditarCompra);

})

$("#nuevoPrecioCompra1, #editarPrecioCompra1").change(function(){

	var valorCompra = $("#nuevoPrecioCompra1").val() * $("#nuevaCantidadCompra").val();
	$("#nuevoTotalCompra").val(valorCompra);

	var valorEditarCompra = $("#editarPrecioCompra1").val() * $("#editarCantidadCompra").val();
	$("#editarTotalCompra").val(valorEditarCompra);

})


/*=============================================
ELIMINAR COMPRA
=============================================*/
$(".tablaCompras tbody").on("click", "button.btnEliminarCompra", function(){
	var idCompra = $(this).attr("idCompra");
	var codigoCompra = $(this).attr("codigoCompra");
	var imagenCompra = $(this).attr("imagenCompra");
	
	swal({

		title: '¿Está seguro de borrar la compra?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar compra!'
        }).then(function(result) {
        if (result.value) {

        	window.location = "index.php?ruta=compras&idCompra="+idCompra+"&imagen="+imagenCompra+"&codigo="+codigoCompra;

        }


	})
})



/*=============================================
AGREGAR COMPRA
=============================================*/
$(".tablaProductosCompras tbody").on("click", "button.btnAgregarCompra", function(){

	var idProducto = $(this).attr("idProducto");
	
	var datos = new FormData();
    datos.append("idProducto", idProducto); 

	$.ajax({

      	url:"ajax/compras.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){

          	$("#idProducto").val(respuesta["id"]);

          	$("#stock").val(respuesta["stock"]);

          	$("#costo").val(respuesta["precio_compra"]);

          	$("#precio").val(respuesta["precio_venta"]);

          	$("#descripcion").val(respuesta["descripcion"]);
           	
    	}
  	})

})


$("#nuevoIngreso").change(function(){

	var nuevoIngreso = Number($("#stock").val()) + Number($("#nuevoIngreso").val());

	$("#nuevoStock").val(nuevoIngreso);

	var nuevoTotal = Number($("#costo").val()) * Number($("#nuevoIngreso").val());

	$("#nuevoTotal").val(nuevoTotal);

})


$("#nuevoPago").change(function(){

	var nuevoSaldo = Number($("#nuevoTotal").val())  - Number($("#nuevoPago").val());

	if (nuevoSaldo >= 0) {

		$("#nuevoSaldo").val(nuevoSaldo);

		if (nuevoSaldo == 0) {

			$("#botonEstadoCompra").removeClass("btn-warning");

			$("#botonEstadoCompra").addClass("btn-success");

			$("#botonEstadoCompra").html("Pagado");

		}else{

			$("#botonEstadoCompra").removeClass("btn-success");

			$("#botonEstadoCompra").addClass("btn-warning");

			$("#botonEstadoCompra").html("Deuda");

		}

	}else{

		swal({
		  type: "info",
		  text: "¡No puedes pagar más de lo que cuesta el monto total!",
		});

		$("#nuevoPago").val($("#nuevoTotal").val());

		$("#nuevoSaldo").val(0);

		$("#botonEstadoCompra").removeClass("btn-warning");

		$("#botonEstadoCompra").addClass("btn-success");

		$("#botonEstadoCompra").html("Pagado");
		
 	}

})



/*=============================================
EDITAR COMPRA
=============================================*/
$(".tablaCompras tbody").on("click", "button.btnEditarCompra", function(){

	var idCompra = $(this).attr("idCompra");
	var idProducto = $(this).attr("idProducto");
	var descripcion = $(this).attr("descripcion");

	$("#idEditarCompra").val(idCompra);
	$("#editarDescripcion").val(descripcion);

	var datos = new FormData();
    datos.append("idCompra", idCompra); 

	$.ajax({

      	url:"ajax/compras-editar.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
          
          	var datosProducto = new FormData();
          	datosProducto.append("idProducto", respuesta["id_producto"]);

           	$.ajax({

	            url:"ajax/compras.ajax.php",
	            method: "POST",
	            data: datosProducto,
	            cache: false,
	            contentType: false,
	            processData: false,
	            dataType:"json",
	            success:function(respuesta){

	                $("#editarStock").val(respuesta["stock"]);
	                $("#editarCostoCompra").val(respuesta["precio_compra"]);
	                $("#editarPrecioCompra").val(respuesta["precio_venta"]);
	                $("#editarNuevoStock").val(respuesta["stock"]);
	            }

          	})

          	$("#editarNuevoIngreso").val(respuesta["cantidad"]);
          	$("#editarNuevoIngresoHidden").val(respuesta["cantidad"]); 
           	
    	}
  	})


  	var datosPago = new FormData();
    datosPago.append("idCompra", idCompra);
    datosPago.append("tipoPago", 1); 

	$.ajax({

      	url:"ajax/pagos.ajax.php",
      	method: "POST",
      	data: datosPago,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      		console.log("respuestaPagos", respuesta);

      		var suma = 0;
      		for (var i = 0; i < respuesta.length; i++) {
      			suma = suma + Number(respuesta[i]["pago"])
      		}

      		$("#editarNuevoTotal").val(respuesta[0]["total"]);

      		$("#editarNuevoPago").val(suma);

      		var saldo = respuesta[0]["total"] - suma;

      		$("#editarNuevoSaldo").val(saldo);
    	}
  	})

})

$("#editarNuevoIngreso").change(function(){

	var nuevoIngreso = Number($("#editarStock").val()) - Number($("#editarNuevoIngresoHidden").val()) + Number($("#editarNuevoIngreso").val());

	$("#editarNuevoStock").val(nuevoIngreso);

	var nuevoTotal = Number($("#editarCostoCompra").val()) * Number($("#editarNuevoIngreso").val());

	$("#editarNuevoTotal").val(nuevoTotal);

	var saldo1 = nuevoTotal - $("#editarNuevoPago").val();

	$("#editarNuevoSaldo").val(saldo1);

})
