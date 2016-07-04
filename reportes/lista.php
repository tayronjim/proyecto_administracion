<!DOCTYPE html>
<html>
<head>
	<title></title>

  <head>
  <?php include_once("../librerias_base.htm"); ?>
  	<!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  	<script type="text/javascript">

  	$(document).ready(function(){


			$("li").removeClass( "current" );
			$("#menuProyectos").addClass('current');
			$estatusArr = [];
			$kamArr = [];
			$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "buscaEstatus" },
	 			success: function(data){
	 				var obj = JSON.parse(data);
	 				$cont = 0;
	 				while(obj[$cont]){
	 					var estatus = JSON.parse(obj[$cont]);
	 					$estatusArr[estatus.id] = estatus.nombre;
	 					$cont ++ ;
	 				}
	 				console.log($estatusArr);
	 			}
	 			
	 		});

	 		$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "buscaKam" },
	 			success: function(data){
	 				var obj = JSON.parse(data);
	 				$cont = 0;
	 				while(obj[$cont]){
	 					var kam = JSON.parse(obj[$cont].datos);
	 					$kamArr[obj[$cont].id] = kam;
	 					$cont ++ ;
	 				}
	 				console.log($kamArr);
	 			}
	 		});

	 		$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "listadoInicialProyectos" },
	 			success: function(data){
	 				
	 				var obj = JSON.parse(data);
	 				console.log(obj);
	 				$cont = 0;
	 				$alt = -1;
	 				$arrKam = [];
	 				$estatus = [];
	 				while(obj.Proyectos[$cont]){

	 				var proy = JSON.parse(obj.Proyectos[$cont].datos_proyecto);
	 				$arrKam[proy.kam]={
	 					'nombre' : $kamArr[proy.kam].nombrec,
	 					'puesto' : $kamArr[proy.kam].puesto
	 				};
	 				$estatus[proy.estatus] = {
	 					'titulo': $estatusArr[proy.estatus].proy.estatus
	 				};
	 				
	 				// 	var cliente = JSON.parse(obj.Proyectos[$cont].cliente.otros.datos_cliente);
	 				// 	var rs = JSON.parse(obj.Proyectos[$cont].cliente.otros.facturacion);
	 				// 	var estatus = JSON.parse(obj.Estatus[proy.estatus].descripcion);
	 				// 	var facturacion = JSON.parse(obj.Proyectos[$cont].facturacion);

	 				// 	ot = Date.parse(proy.fCIdealY+"-"+proy.fCIdealM+"-"+proy.fCIdealD);
						// fechaOvertime = new Date(ot);
						// fechaActual = new Date();								
						// var timeDiff = fechaOvertime.getTime() - fechaActual.getTime();
						// var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
	 				// 	if ($alt == 1) {$claseAlt = "class='alt'";}else $claseAlt = '';
	 				// 	$overtime='IN TIME';
	 				// 	$colorOvertime="green";
	 				// 	if(diffDays < 60){$overtime='OVERTIME';$colorOvertime="red";}
	 				// 	$("#tblProyectos tbody").append("<tr "+$claseAlt+"><td class='colProy'>"+proy.posicion+"</td><td class='colCliente'>"+cliente.publico+" / "+rs.rs+"</td><td>"+proy.fIniY+"/"+proy.fIniM+"/"+proy.fIniD+"</td><td>"+proy.fCIdealY+"/"+proy.fCIdealM+"/"+proy.fCIdealD+"</td><td class='colEstatus'>"+estatus.nombre+"</td><td>"+estatus.avance+"</td><td>"+parseFloat(facturacion.porcfacturado).toFixed(2)+"</td><td style='font-weight: bolder;color:"+$colorOvertime+";' class='colOvertime'>"+$overtime+"</td><td><input type='hidden' value='"+obj.Proyectos[$cont].id+"'><span class='flechaProyecto boton' valor='"+obj.Proyectos[$cont].id+"'><img src='../img/arrow-yellow.png' width='20px' height='auto'></span></td></tr>");
						// $cont++;
						// $alt = $alt * -1;
	 				}
	 			}
	 		});


	 });  //Fin document Ready
    
  
      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});
      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);
      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Mushrooms', 3],
          ['Onions', 1],
          ['Olives', 1],
          ['Zucchini', 1],
          ['Pepperoni', 2]
        ]);
        // Set chart options
        var options = {'legend':'left',
        				'title':'How Much Pizza I Ate Last Night',
        				'is3D':true,
                       'width':400,
                       'height':300};
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        function selectHandler() {
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
            var topping = data.getValue(selectedItem.row, 0);
            alert('The user selected ' + topping);
          }
        }
        google.visualization.events.addListener(chart, 'select', selectHandler);  
        chart.draw(data, options);
      }

    </script>
  </head>

  <body>
  <?php include_once("../header.htm"); ?>
	<div class="cuerpo">
	    <!--Div that will hold the pie chart-->
	    <div id="chart_div"></div>
	    <iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTz=0&amp;height=600&amp;wkst=2&amp;hl=es_419&amp;bgcolor=%23FFFFFF&amp;src=es.mexican%23holiday%40group.v.calendar.google.com&amp;color=%23125A12&amp;src=diazmorones.com.mx_651fm0i4dhmmqogs0cqgjbkk5k%40group.calendar.google.com&amp;color=%230F4B38&amp;ctz=America%2FMexico_City" style="border-width:0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
	    <iframe src="https://docs.google.com/spreadsheets/d/1fKNsvJYjTytYOEN_ofAeSSXgfW3DN0JftrG8hjtXHUU/pubhtml?widget=true&amp;headers=false"></iframe>
    </div>
  </body>
</html>