<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Administración de proyectos - Clientes</title>
</head>
<body>
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