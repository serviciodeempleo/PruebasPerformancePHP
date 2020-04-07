var expr = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;

$(document).ready(function(){
	$("#btn_enviar").click(function(){
		var num_cedula = $("#num_cedula").val();
		var correo_e = $("#correo_e").val();
		$("#msg_error").html("");
		
		if(num_cedula == "" && correo_e == ""){
			$("#msg_error").html("Ingrese número de cédula o correo electrónico.");
			return false;
		}
		
		if(num_cedula == "" && correo_e != ""){
			
			if(correo_e != ""){
				if(!expr.test(correo_e)){
					$("#msg_error").html("Ingrese un correo electrónico válido.");
					return false;
				}
			}else{
				$("#msg_error").html("Ingrese un correo electrónico.");
				return false;
			}
		}
		
		if(num_cedula != "" && correo_e != ""){
			
			if(correo_e != ""){
				if(!expr.test(correo_e)){
					$("#msg_error").html("Ingrese un correo electrónico válido.");
					return false;
				}
			}else{
				$("#msg_error").html("Ingrese un correo electrónico.");
				return false;
			}
		}

		variables = { 
			num_cedula:num_cedula, 
			correo_e:correo_e
		};
		
		$.ajax({
            type: 'POST',
            url: 'respuesta.php',
            data: variables,
            success: function(result) {
                $('#respuesta').html(result);
            },
            error: function() {
                alert('Ocurrió un error, por favor intente de nuevo.');
            }
        });
		
		return false;
	});
		
});
