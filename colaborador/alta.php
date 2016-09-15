<!DOCTYPE html>

<html>
<head>
	<?php include_once("../librerias_base.htm"); ?>
	<script type="text/javascript">
	$(document).ready(function(){
		$("li").removeClass( "current" )
		$("#menuColaboradores").addClass('current');
		$arreglo = {};
		$filasRS=0;
		<?php 
			$colaborador = "";
			if(isset($_GET['c'])){
				$colaborador = $_GET['c'];
			}
				
		 ?>
		
		$colaborador = "<?php echo $colaborador; ?>";
		
		if ($colaborador != "") {
			
			
			$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" :  "buscaColaborador", "id":$colaborador },
	 			success: function(data){
	 				
	 				var Col2 = JSON.parse(data);
	 				var Col = JSON.parse(Col2.datos);
	 				var puestos = Col.puesto;
	 		 console.log(puestos);
	 					//$("#txtCodigo").val(Col.codigo);
	 					$("#txtNombreCorto").val(Col.nombrec);
	 					$("#txtNombreLargo").val(Col.nombrel);
	 					$("#idColaborador").val($colaborador);
	 					$("#txtEMail").val(Col.email);
	 					$("#txtPuesto").val(Col.puesto);
	 					if (Col.activo == "1") {$("#chkactivo").attr('checked',true);}
	 					else{$("#chkactivo").attr('checked',false);}

	 					if (puestos.consultor == "1") {$("#chkPuestoConsultor").attr('checked',true);}
	 					else{$("#chkPuestoConsultor").attr('checked',false);}

	 					if (puestos.recrutador == "1") {$("#chkPuestoRecrutador").attr('checked',true);}
	 					else{$("#chkPuestoRecrutador").attr('checked',false);}

	 					if (puestos.apoyo == "1") {$("#chkPuestoApoyo").attr('checked',true);}
	 					else{$("#chkPuestoApoyo").attr('checked',false);}
	 					
	 			}
	 		});
	 		
		};
		$("#guardaColabolador").click(function(){
			if ($("#chkactivo").is(':checked')) {$("#chkactivo").val("1");}
			else {$("#chkactivo").val("0");}
			if ($("#chkPuestoConsultor").is(':checked')) {$("#chkPuestoConsultor").val("1");}
			else {$("#chkPuestoConsultor").val("0");}
			if ($("#chkPuestoRecrutador").is(':checked')) {$("#chkPuestoRecrutador").val("1");}
			else {$("#chkPuestoRecrutador").val("0");}
			if ($("#chkPuestoApoyo").is(':checked')) {$("#chkPuestoApoyo").val("1");}
			else {$("#chkPuestoApoyo").val("0");}
			$(".dataColaborador").each(function(){
				$arreglo[$(this).attr('name')] = $(this).val();
			});
			$arreglo['puesto'] = {
									'consultor' : $("#chkPuestoConsultor").val(),
									'reclutador' : $("#chkPuestoRecrutador").val(),
									'apoyo' : $("#chkPuestoApoyo").val()
								}
			$funcion = "guardaColaborador";
			if ($colaborador != "") {
				$funcion = "actualizaColaborador";
			}
			
			guardaColabodaor($funcion);
		});

	}); // fin document ready


		function guardaColabodaor($funcion){

		     $datos = JSON.stringify($arreglo);
		     $id = $("#idColaborador").val();

		     $.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : $funcion, "datos" : $datos, "id" : $id },
	 			success: function(data){
	 				// var obj = JSON.parse(data);
	 				window.location="lista.php";
	 				
	 			}
	 		});
		
		}

	</script>
	<style type="text/css">
		input[type="text"].dataColaborador,input[type="email"].dataColaborador{
			width: 200px;
		}
	</style>
</head>
<body>
	<?php include_once("../header.htm"); ?>
<div class="cuerpo">
	<h1>Registro de Colaboradores</h1>
	<input	type="hidden" value="0" class="dataColaborador"  name="idColaborador" id="idColaborador">
	<table class="tblFormularios" border="0">
		<!-- <tr>
			<td>Codigo</td>	<td><input type="text" class="dataColaborador" id="txtCodigo" name="codigo"></td>
		</tr> -->
		<tr>
			<td>Nombre Corto</td><td><input type="text" class="dataColaborador" id="txtNombreCorto" name="nombrec"></td><td>e-Mail</td><td><input type="email" class="dataColaborador" id="txtEMail" name="email"></td>
		</tr>
		<tr>
			<td>Nombre Completo</td><td><input type="text" class="dataColaborador" id="txtNombreLargo" name="nombrel"></td><td colspan="2"></td>
		</tr>
		<tr>
			<td>Puesto</td>
			<td>
				<table>
					<tr>
						<td>Consultor<input type="checkbox" class="dataColaboradorPuesto" id="chkPuestoConsultor" name="consultor"></td><td>Reclutador <input type="checkbox" class="dataColaboradorPuesto" id="chkPuestoRecrutador" name="recrutador"> </td>
					</tr>
					<tr><td>Apoyo<input type="checkbox" class="dataColaborador" id="chkPuestoApoyo" name="apoyo"></td></tr>
				</table>
			
			<!-- <input type="text" class="dataColaboradorPuesto" id="txtPuesto" name="puesto"> --></td><td colspan="2"></td>
		</tr>
		<tr>
			<td></td><td>Activo <input type="checkbox" class="dataColaborador" id="chkactivo" name="activo" checked></td><td colspan="2"></td>
		</tr>
		
	</table>
	<br><br>

	<input type="button" value="Guardar" id="guardaColabolador">
</div>
	
</body>
</html>