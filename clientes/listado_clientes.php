<!DOCTYPE html>
<html>
<head>
	<?php include_once("../librerias_base.htm"); ?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("li").removeClass( "current" )
			$("#menuClientes").addClass('current');
			$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "listado" },
	 			success: function(data){
	 				//console.log(data);
	 				var obj = JSON.parse(data);
	 				$cont = 0;
	 				$alt = -1;
	 				while(obj.Cliente[$cont]){
	 					//console.log(obj.Cliente[$cont]);
	 					var datos = JSON.parse(obj.Cliente[$cont].datos_cliente);
	 					//console.log(datos);
	 					if ($alt == 1) {$claseAlt = "class='alt'";}else $claseAlt = '';
	 					$("#tblClientes tbody").append("<tr "+$claseAlt+"><td class='colCliente' style='width:300px;'>"+datos.publico+"</td><td><span class='flechaClientes boton' valor='"+obj.Cliente[$cont].id+"'><img src='../img/arrow-yellow.png' width='20px' height='auto'></span></td></tr>");
						$cont++;
						$alt = $alt * -1;
	 				}
	 			}
	 		});

	 		$(document).on('click','.flechaClientes',function(){
	 			window.location="clientes.php?c="+$(this).attr('valor');
	 		});

		});
		function filtraTabla(){
			$("#tblClientes tbody > tr").show();
			
 			if( $("#filtroCliente").val() != ""){
				$("#tblClientes tbody > tr:visible > td.colCliente:not(:contains-ci('" + $("#filtroCliente").val() + "'))").parent("tr").hide();
			}
			
		}
		// jQuery expression for case-insensitive filter
		$.extend($.expr[":"], 
		{
		    "contains-ci": function(elem, i, match, array) 
			{
				return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
			}
		});
	</script>
	<style type="text/css">
	.datagrid{
		max-width: 80%;
		margin: auto;
	}
	label.txtmini{
		font-size: 14px;
	}
#areaFiltros{
	float: left;
	height: 100%;
	width: auto;
	position: relative;
	margin-right: 30px;
}
	
	</style>
</head>
<body>
<?php include_once("../header.htm"); ?>
<div class="cuerpo" ><h1>Listado de Cliente</h1>
	<div id="areaFiltros">
		<label class="txtmini"><b>Cliente:</b></label><br>
		<input type="text" id="filtroCliente" onkeyup="filtraTabla()">
	</div>
	<div class="contenido" style="position: relative; float: left;">
		
		<div class="datagrid">
			<table id="tblClientes" border="1">
				<thead>
					<tr>
						<th >Nombre Comercial</th><th></th>
					</tr>
				</thead>
				<tbody></tbody>
				<tfoot></tfoot>	
					
			</table>
		</div>
	</div>
		
	<!-- <div class="recordatorios" style="position: relative;float: right;">
		<?php //include_once("../recordatorios/recordatorios.php"); ?>
	</div> -->

</div>
	
	



</body>
</html>