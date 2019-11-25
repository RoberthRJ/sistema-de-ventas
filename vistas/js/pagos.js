
/*=============================================
PAGAR COMPRAS 
=============================================*/
$(".tablaCompras tbody").on("click", "button.btnPagarCompra", function(){

	var idCompra = $(this).attr("idCompra");
	var tipoPago = $(this).attr("tipoPago");
	var descripcion = $(this).attr("descripcion");

	$("#descripcionCompra").val(descripcion);
	
	var datos = new FormData();
    datos.append("idCompra", idCompra);
    datos.append("tipoPago", tipoPago); 

	$.ajax({

      	url:"ajax/pagos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){

      		$("#idCompra").val(idCompra);

      		$("#tipo_pago").val(Number(respuesta[0]["tipo_pago"]));

      		$("#nuevoTotalPago").val(Number(respuesta[0]["total"]));

      		var pagado = 0;

      		for (var i = 0; i < respuesta.length; i ++ ) {

      			pagado = pagado + Number(respuesta[i]["pago"]);
      		}

          	$("#pagado").val(pagado);

          	var deuda = Number(respuesta[0]["total"]) - pagado;

          	$("#deuda").val(deuda);

          	if (deuda == 0) {

          		$("#btnEstadoPago").addClass("btn-success");

				$("#btnEstadoPago").html("Pagado");

				$("#nuevoPagoCompra").attr('readonly', true);

          	}else{

          		$("#btnEstadoPago").addClass("btn-warning");

				$("#btnEstadoPago").html("Deuda");

          	}	
    	}
  	})
})





$("#nuevoPagoCompra").change(function(){

	var nuevoSaldo = Number($("#deuda").val())  - Number($("#nuevoPagoCompra").val());

	if (nuevoSaldo >= 0) {

		$("#nuevoSaldoCompra").val(nuevoSaldo);

		if (nuevoSaldo == 0) {

			$("#btnEstadoPago").removeClass("btn-warning");

			$("#btnEstadoPago").addClass("btn-success");

			$("#btnEstadoPago").html("Pagado");

		}else{

			$("#btnEstadoPago").removeClass("btn-success");

			$("#btnEstadoPago").addClass("btn-warning");

			$("#btnEstadoPago").html("Deuda");
		}

	}else{

		swal({
		  type: "info",
		  text: "¡No puedes pagar más de lo que cuesta el monto total!",
		});

		$("#nuevoPagoCompra").val($("#deuda").val());

		$("#nuevoSaldoCompra").val(0);

		$("#btnEstadoPago").removeClass("btn-warning");

		$("#btnEstadoPago").addClass("btn-success");

		$("#btnEstadoPago").html("Pagado");
		
 	}

})


/*=============================================
PAGAR GASTOS
=============================================*/
$(".tablaGastos tbody").on("click", "button.btnPagarGasto", function(){

	var idGasto = $(this).attr("idGasto");
	var tipoPago = $(this).attr("tipoPago");
	var descripcion = $(this).attr("descripcion");

	$("#nuevaDescripcionPago1").val(descripcion);

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

      		$("#idPagoGasto").val(idGasto);

      		$("#tipo_pago").val(Number(respuesta[0]["tipo_pago"]));

      		$("#nuevoTotalPago").val(Number(respuesta[0]["total"]));

      		var pagado = 0;

      		for (var i = 0; i < respuesta.length; i ++ ) {

      			pagado = pagado + Number(respuesta[i]["pago"]);
      		}

          	$("#pagado").val(pagado);

          	var deuda = Number(respuesta[0]["total"]) - pagado;

          	$("#deudaGasto").val(deuda);

          	if (deuda == 0) {

          		$("#btnEstadoPago").addClass("btn-success");

				$("#btnEstadoPago").html("Pagado");

				$("#nuevoPagoCompra").attr('readonly', true);

          	}else{

          		$("#btnEstadoPago").addClass("btn-warning");

				$("#btnEstadoPago").html("Deuda");
          	}	
		}
	})
})


$("#nuevoPagoGasto1").change(function(){

	var nuevoSaldo = Number($("#deudaGasto").val())  - Number($("#nuevoPagoGasto1").val());

	if (nuevoSaldo >= 0) {

		$("#nuevaDeudaGasto1").val(nuevoSaldo);

		if (nuevoSaldo == 0) {

			$("#btnEstadoPago").removeClass("btn-warning");

			$("#btnEstadoPago").addClass("btn-success");

			$("#btnEstadoPago").html("Pagado");

		}else{

			$("#btnEstadoPago").removeClass("btn-success");

			$("#btnEstadoPago").addClass("btn-warning");

			$("#btnEstadoPago").html("Deuda");

		}

	}else{

		swal({
		  type: "info",
		  text: "¡No puedes pagar más de lo que cuesta el monto total!",
		});

		$("#nuevoPagoGasto1").val($("#deudaGasto").val());

		$("#nuevoDeudaGasto1").val(0);

		$("#btnEstadoPago").removeClass("btn-warning");

		$("#btnEstadoPago").addClass("btn-success");

		$("#btnEstadoPago").html("Pagado");
		
 	}

})
