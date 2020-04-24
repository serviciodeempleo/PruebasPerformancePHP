$(document).ready(function(){
	$("#btn_crear_pdf").click(function(){
		var intro_SPE = $("#intro_SPE").val();
		var intro_4B = $("#intro_4B").val();		
		var titulo_01 = $("#titulo_01").val();
		var titulo_01_des_01 = $("#titulo_01_des_01").val();
		var titulo_01_des_02 = $("#titulo_01_des_02").val();	
		var titulo_02 = $("#titulo_02").val();
		var titulo_02_des = $("#titulo_02_des").val();
		var resp_nombres = $("#resp_nombres").val();
		var resp_docu = $("#resp_docu").val();
		var resp_fech_prueba = $("#resp_fech_prueba").val();
		var resp_prestador = $("#resp_prestador").val();		
		var num_estilo = $("#num_estilo").val();
		var estilo = $("#estilo").val();
		var estilo_desc = $("#estilo_desc").val();		
		var num_opuesto = $("#num_opuesto").val();
		var opuesto = $("#opuesto").val();
		var opuesto_desc = $("#opuesto_desc").val();		
		var num_perfil = $("#num_perfil").val();
		var perfil = $("#perfil").val();
		var perfil_desc = $("#perfil_desc").val();		
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
			intro_SPE:intro_SPE,
			intro_4B:intro_4B,
			titulo_01:titulo_01,
			titulo_01_des_01:titulo_01_des_01,
			titulo_01_des_02:titulo_01_des_02,
			titulo_02:titulo_02,
			titulo_02_des:titulo_02_des,
			resp_nombres:resp_nombres,
			resp_docu:resp_docu,
			resp_fech_prueba:resp_fech_prueba,
			resp_prestador:resp_prestador,			
			num_estilo:num_estilo,
			estilo:estilo,
			estilo_desc:estilo_desc,
			num_opuesto:num_opuesto,
			opuesto:opuesto,
			opuesto_desc:opuesto_desc,
			num_perfil:num_perfil,
			perfil:perfil,
			perfil_desc:perfil_desc,
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
