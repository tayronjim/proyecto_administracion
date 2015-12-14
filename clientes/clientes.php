<!DOCTYPE html>
<html>
<head>
	<?php include_once("../librerias_base.htm"); ?>
</head>
<body>
<?php include_once("../header.htm"); ?>
<h1>Registro de Cliente</h1>
<form action="registra_cliente.php" method="post">
	<table>
		<tr>
			<td>Codigo</td>	<td><input type="text" id="txtCodigoCliente" name="codigo"></td>
		</tr>
		<tr>
			<td>Nombre Comercial</td><td><input type="text" id="txtNombrePublico" name="publico"></td>
		</tr>
		<tr>
			<td>Fecha Alta</td><td><input type="text" id="txtFechaAlta" name="fecha"></td>
		</tr>
		
	</table>
	<input type="submit" value="Guardar">
</form>

</body>
</html>