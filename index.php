<!DOCTYPE html>
<html>
<head>
	<?php include_once("librerias_base.htm"); ?>
	<?php $dirActual = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>
	<?php //include_once("sesion\check_sesion.php"); ?>

	<script type="text/javascript">
	function imprimetablaproyectos(listCuerpo){
		$cont = 0;
		listado = {};
		while(listCuerpo[$cont]){
			listado = listCuerpo[$cont];
			$("#tblProyectos tbody").append("<tr "+listado.alt+"><td>"+listado.posicion+"</td><td>"+listado.kam+"</td><td>"+listado.convenio+"</td><td>"+listado.cliente+"</td><td>"+listado.estatus+"</td><td>"+listado.avance+"</td><td>"+listado.overtime+"</td><td>"+listado.prioridad+"</td><td><input type='hidden' value='"+listado.proyId+"'><span class='flechaProyecto boton' valor='"+listado.proyId+"'><img src='img/arrow-yellow.png' width='20px' height='auto'></span></td></tr>");
			$cont++;
		}
	}
		$(document).ready(function(){
			$("li").removeClass( "current" )
			$("#menuHome").addClass('current');
			$kams = [];
			$.ajax({
	 			type: "POST",
	 			url: "proyectos/control.php",
	 			data: { "funcion" : "buscaKam" },
	 			success: function(data){
	 				var obj = JSON.parse(data);
	 				$contKam = 0;
	 				while(obj[$contKam]){
						$kams[obj[$contKam].id] = JSON.parse(obj[$contKam].datos);
						$contKam ++;
	 				}
	 				
	 				//console.log($kams[1].nombrec);
	 			}
	 		});

			$.ajax({
	 			type: "POST",
	 			url: "proyectos/control.php",
	 			data: { "funcion" : "listadoInicialProyectos" },
	 			success: function(data){
	 				var listCuerpo = [];
	 				
	 				var obj = JSON.parse(data);
	 				//console.log(obj);
	 				$cont = 0;
	 				$alt = -1;
	 				while(obj.Proyectos[$cont]){
	 					//console.log(obj.Proyectos[$cont]);
	 					var proy = JSON.parse(obj.Proyectos[$cont].datos_proyecto);
	 					var cliente = JSON.parse(obj.Proyectos[$cont].cliente.otros.datos_cliente);
	 					var rs = JSON.parse(obj.Proyectos[$cont].cliente.otros.facturacion);
	 					var estatus = JSON.parse(obj.Estatus[proy.estatus].descripcion);
	 					var contrato = JSON.parse(obj.Proyectos[$cont].contrato);
	 					ot = Date.parse(proy.fCIdealY+"-"+proy.fCIdealM+"-"+proy.fCIdealD);
						fechaOvertime = new Date(ot);
						fechaActual = new Date();								
						var timeDiff = fechaOvertime.getTime() - fechaActual.getTime();
						var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
	 					if ($alt == 1) {$claseAlt = "class='alt'";}else $claseAlt = '';
	 					$overtime='IN TIME';
	 					$colorOvertime="green";
	 					if(diffDays < 60){$overtime='OVERTIME';$colorOvertime="red";}
	 					listado = new Object();
	 					listado.alt = $claseAlt;
	 					listado.posicion = proy.posicion;
	 					listado.kam = $kams[proy.kam].nombrec;
	 					listado.convenio = contrato.convenio;
	 					listado.cliente = cliente.publico;
	 					listado.rs = rs.rs;
	 					listado.fCIdeal = proy.fCIdealY+"-"+proy.fCIdealM+"-"+proy.fCIdealD;
	 					listado.fInicio = proy.fIniY+"-"+proy.fIniM+"-"+proy.fIniD;
	 					listado.estatus = estatus.nombre;
	 					listado.avance = estatus.avance;
	 					listado.overtime = "<label style='font-weight: bolder;color:"+$colorOvertime+";'>"+$overtime+"</label>"
	 					listado.proyId = obj.Proyectos[$cont].id;
	 					listado.prioridad = proy.prioridad;
	 					listCuerpo[$cont] = listado;
	 				
	 					

	 					
						$cont++;
						$alt = $alt * -1;
	 				}

	 				// listCuerpo=listCuerpo.filter(function(el){
	 				// 		return el.prioridad == 3;
	 				// 	});

	 				listCuerpo.sort(function (a, b){
					   return (b.prioridad - a.prioridad)
					});
					imprimetablaproyectos(listCuerpo);
	 				//console.log(listCuerpo);
	 			}
	 		});

	 		$(document).on('click','.flechaProyecto',function(){
	 			//alert($(this).attr('valor'));
	 			window.location="proyectos/proyectos.php?p="+$(this).attr('valor');
	 		});

		});//Fin Document Ready

	</script>
	<style type="text/css">
	
	.d{text-decoration:none;}
	.cuerpoHome{
		width: 90%;
		max-width: 1800px;
		min-width: 1330px;
		height: auto;
		margin: auto;
		position: relative;		
		background-color: rgba(255,255,255,0.4);
		color:#000;
	}
	</style>

</head>
<body>
<?php include_once("header.htm"); ?>
<div class="cuerpoHome">
	<!-- <div class="contenido" style="position: relative; float: left; max-width: 80%;">
		<div class="datagrid">
			<table id="tblProyectos" >
				<thead>
					<tr>
						<th>Proyecto</th><th>KAM</th><th>Conv.</th><th>Cliente</th><th>Estatus</th><th>Avance</th><th>Overtime</th><th></th><th></th>
					</tr>
				</thead>
				<tbody></tbody>
				<tfoot><tr><td colspan="8"></td></tr></tfoot>	
					
			</table>
		</div> -->
		<?php include_once("recordatorios/recordatorios_home.php"); ?>
	</div>
	<!-- <div class="recordatorios" style="position: relative;"> 
		
	</div> -->
</div>


<!-- --Ejemplo de diseño de tabla--


<div class="datagrid">
	<table>
	<thead><tr><th>header</th><th>header</th><th>header</th><th>header</th></tr></thead>
	<tfoot><tr><td colspan="4"><div id="paging"><ul><li><a href="#"><span>Previous</span></a></li><li><a href="#" class="active"><span>1</span></a></li><li><a href="#"><span>2</span></a></li><li><a href="#"><span>3</span></a></li><li><a href="#"><span>4</span></a></li><li><a href="#"><span>5</span></a></li><li><a href="#"><span>Next</span></a></li></ul></div></tr></tfoot>
	<tbody><tr><td>data</td><td>data</td><td>data</td><td>data</td></tr>
	<tr class="alt"><td>data</td><td>data</td><td>data</td><td>data</td></tr>
	<tr><td>data</td><td>data</td><td>data</td><td>data</td></tr>
	<tr class="alt"><td>data</td><td>data</td><td>data</td><td>data</td></tr>
	<tr><td>data</td><td>data</td><td>data</td><td>data</td></tr>
	</tbody>
	</table>
</div> -->

</body>
</html>