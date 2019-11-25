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

$('.tablaProveedores').DataTable( {
    "ajax": "ajax/datatable-proveedores.ajax.php?perfilOculto="+perfilOculto,
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

$(".tablaProveedores tbody").on("click", "button.btnEditarProveedor", function(){

	var idProveedor = $(this).attr("idProveedor");

	var datos = new FormData();
    datos.append("idProveedor", idProveedor);

     $.ajax({

      url:"ajax/proveedores.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
      	console.log("respuesta", respuesta);
          
           $("#editarProveedor").val(respuesta["razon_social"]);       

           $("#editarSectorActual").val(respuesta["id_sector"]);

           

           $("#editarDireccionProveedor").val(respuesta["direccion"]);

           $("#editarReferencia").val(respuesta["referencia"]);

           $("#editarTelefonoProveedor").val(respuesta["telefono"]);

           $("#editarEmailProveedor").val(respuesta["email"]);




           	var idSector = respuesta["id_sector"];

			var datos = new FormData();
		    datos.append("idSector", idSector);

		     $.ajax({

		      url:"ajax/sectores.ajax.php",
		      method: "POST",
		      data: datos,
		      cache: false,
		      contentType: false,
		      processData: false,
		      dataType:"json",
		      success:function(respuesta){

		      	var sector = document.getElementById('editarSectorActual');

				sector.innerHTML = respuesta["sector"];
		          
		      }

		  })

      }

  })

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
