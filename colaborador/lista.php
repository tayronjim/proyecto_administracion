<!DOCTYPE html>

<html>
<head>
	<?php include_once("../librerias_base.htm"); ?>
	<script type="text/javascript">
	$(document).ready(function(){
		$("li").removeClass( "current" )
		$("#menuColaboradores").addClass('current');
		$arreglo = {};
		
		
		
		$.ajax({
 			type: "POST",
 			url: "control.php",
 			data: { "funcion" :  "listaColaborador" },
 			success: function(data){
 				console.log(data);
 				// var Col2 = JSON.parse(data);
 				var col = JSON.parse(data);
 				$cont = 0;
 				$alt = -1;
 				while(col[$cont]){
 					console.log(col[$cont]);
 					var dato = JSON.parse(col[$cont].datos);
 					if ($alt == 1) {$claseAlt = "class='alt'";}else $claseAlt = '';
 					$("#tblColaboradores tbody").append('<tr '+$claseAlt+'><td>'+dato.codigo+'</td><td>'+dato.nombrec+'</td><td>'+dato.puesto+'</td><td><span class="flechaColaborador boton" valor="'+col[$cont].id+'"><img src="../img/arrow-yellow.png" width="20px" height="auto"></span></td></tr>');
 					$cont++;
 					$alt = $alt * -1;
 				}
 				// console.log(Col);
 				// 	$("#txtCodigo").val(Col.codigo);
 				// 	$("#txtNombreCorto").val(Col.nombrec);
 				// 	$("#txtNombreLargo").val(Col.nombrel);
 				// 	$("#idColaborador").val($colaborador);
 			}
 		});

 		$(document).on('click','.flechaColaborador',function(){
 			window.location="alta.php?c="+$(this).attr('valor');
 		});

	}); // fin document ready
		

	</script>
	<style type="text/css">
	.datagrid{
		
		
		margin: auto;
	}
	
	</style>
</head>
<body>
	<?php include_once("../header.htm"); ?>
	<div class="cuerpo">
		<h1>Registro de Colaboradores</h1>
		<div class="datagrid">
			<table border="1" id="tblColaboradores">
				<thead>
					<tr>
						<th width="100px">Codigo</th><th width="300px">Nombre</th><th>Puesto</th><th width="20px"></th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>

		<div class="recordatorios">
			<?php include_once("../recordatorios/recordatorios.php"); ?>
		</div>
	</div>
		

</body>
</html>