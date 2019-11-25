/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/

// $.ajax({

// 	url: "ajax/datatable-productos.ajax.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// })

var perfilOculto = $("#perfilOculto").val();

$('.tablaGastos').DataTable( {
    "ajax": "ajax/datatable-gastos.ajax.php",
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

} );

/*=============================================
EDITAR PRODUCTO
=============================================*/

$(".tablaGastos tbody").on("click", "button.btnEditarGasto", function(){

	var idGasto = $(this).attr("idGasto");
	var tipoPago = 2;
	var descripcion = $(this).attr("descripcion");
	$("#editarDescripcionGasto").val(descripcion);
	$("#idEditarGasto").val(idGasto);

	var datos = new FormData();
    datos.append("idGasto", idGasto);
    datos.append("tipoPago", tipoPago);

     $.ajax({

      url:"ajax/gastos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
      	console.log("respuesta", respuesta);

      	$("#editarTotalGasto").val(respuesta[0]["total"]);

      	var suma = 0;
      	for (var i = 0; i < respuesta.length; i++) {
      		suma = suma + Number(respuesta[i]["pago"]);
      	}

      	$("#editarPagoGasto").val(suma);

      	var deuda = Number(respuesta[0]["total"]) - suma;

      	$("#editarDeudaGasto").val(deuda);
         
      }

  })

})


$("#editarTotalGasto").change(function(){

	var pagado = Number($("#editarPagoGasto").val());

	var deuda = Number($("#editarTotalGasto").val()) - pagado;

	$("#editarDeudaGasto").val(deuda);

})

/*=============================================
ELIMINAR Proveedor
=============================================*/

$(".tablaProveedores tbody").on("click", "button.btnEliminarProveedor", function(){

	var idProveedor = $(this).attr("idProveedor");
	
	swal({

		title: '¿Está seguro de borrar el Proveedor?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Proveedor!'
        }).then(function(result) {
        if (result.value) {

        	window.location = "index.php?ruta=proveedores&idProveedor="+idProveedor;

        }


	})

})

$("#nuevoPagoGasto").change(function(){

	var pago = Number($("#nuevoPagoGasto").val());

	var deuda = Number($("#nuevoTotalGasto").val()) - pago;

	$("#nuevaDeudaGasto").val(deuda);

})
