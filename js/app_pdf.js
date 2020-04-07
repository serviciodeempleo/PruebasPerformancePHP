$(document).ready(function(){
	$("#btn_crear_pdf").click(function(){
		var resp_nombres = $("#resp_nombres").val();
		var resp_docu = $("#resp_docu").val();
		var resp_fech_prueba = $("#resp_fech_prueba").val();
		var resp_prestador = $("#resp_prestador").val();
		var num_perfil = $("#num_perfil").val();
		var perfil = $("#perfil").val();
		var desc_perfil = $("#desc_perfil").val();
		var ei = $("#ei").val();
		var ai = $("#ai").val();
		var ad = $("#ad").val();
		var ed = $("#ed").val();
		var joven_ei = $("#joven_ei").val();
		var joven_ai = $("#joven_ai").val();
		var joven_ad = $("#joven_ad").val();
		var joven_ed = $("#joven_ed").val();		
		var libre_ei = $("#libre_ei").val();
		var libre_ai = $("#libre_ai").val();
		var libre_ad = $("#libre_ad").val();
		var libre_ed = $("#libre_ed").val();		
		var laboral_ei = $("#laboral_ei").val();
		var laboral_ai = $("#laboral_ai").val();
		var laboral_ad = $("#laboral_ad").val();
		var laboral_ed = $("#laboral_ed").val();		
		var auto_ei = $("#auto_ei").val();
		var auto_ai = $("#auto_ai").val();
		var auto_ad = $("#auto_ad").val();
		var auto_ed = $("#auto_ed").val();
		
		variables = { 
			resp_nombres:resp_nombres,
			resp_docu:resp_docu,
			resp_fech_prueba:resp_fech_prueba,
			resp_prestador:resp_prestador,
			num_perfil:num_perfil,
			perfil:perfil,
			desc_perfil:desc_perfil,
			ei:ei,
			ai:ai,
			ad:ad,
			ed:ed,
			joven_ei:joven_ei,
			joven_ai:joven_ai,
			joven_ad:joven_ad,
			joven_ed:joven_ed,
			libre_ei:libre_ei,
			libre_ai:libre_ai,
			libre_ad:libre_ad,
			libre_ed:libre_ed,
			laboral_ei:laboral_ei,
			laboral_ai:laboral_ai,
			laboral_ad:laboral_ad,
			laboral_ed:laboral_ed,
			auto_ei:auto_ei,
			auto_ai:auto_ai,
			auto_ad:auto_ad,
			auto_ed:auto_ed			
		};
		
		$.ajax({
            type: 'POST',
            url: 'respuesta_pdf.php',
            data: variables,
            success: function(result) {
                $('#respuesta').html(result);
				
				var req = new XMLHttpRequest();
				req.open("GET", "archivos/"+resp_docu+".pdf", true);
				req.responseType = "blob";

				req.onload = function (event) {
				var blob = req.response;
				console.log(blob.size);
				var link=document.createElement('a');
				link.href=window.URL.createObjectURL(blob);
				link.download=resp_docu + ".pdf";
				link.click();
				};

				req.send();	

				$.ajax({
					type: 'POST',
					url: 'drespuesta_pdf.php',
					data: variables,
					success: function(result) {
						$('#respuesta').html(result);			
					},
					error: function() {
						alert('Ocurrió un error, por favor intente de nuevo.');
					}	
				});
            },
            error: function() {
                alert('Ocurrió un error, por favor intente de nuevo.');
            }	
        });
				
	});
		
});

function cargar_graf_barras(){
	var newImg = jQuery('<img>', {src: 'respuesta_graf_barras.php'});
	jQuery('#resp_barras').empty().append(newImg);
}
