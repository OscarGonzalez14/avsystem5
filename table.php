<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>JS Bin</title>
</head>
<body>
  <table border="1">
    <tr id="fila0">
      <td>Columna 1</td>
      <td>Columna 2</td>
      <td>Columna 3</td>
      <td>Columna 4</td>
      <td>Columna 5</td>
      <td>Columna 6</td>
      <td><input type="button" onclick="eliminarFila(0);" value="Eliminar" /></td>
    </tr>
    <tr id="fila1">
      <td>Columna 1</td>
      <td>Columna 2</td>
      <td>Columna 3</td>
      <td>Columna 4</td>
      <td>Columna 5</td>
      <td>Columna 6</td>
      <td><input type="button" onclick="eliminarFila(1);" value="Eliminar" /></td>
    </tr>
    <tr id="fila2">
      <td>Columna 1</td>
      <td>Columna 2</td>
      <td>Columna 3</td>
      <td>Columna 4</td>
      <td>Columna 5</td>
      <td>Columna 6</td>
      <td><input type="button" onclick="eliminarFila(2);" value="Eliminar" /></td>
    </tr>
    <tr id="fila3">
      <td>Columna 1</td>
      <td>Columna 2</td>
      <td>Columna 3</td>
      <td>Columna 4</td>
      <td>Columna 5</td>
      <td>Columna 6</td>
      <td><input type="button" onclick="eliminarFila(3);" value="Eliminar" /></td>
    </tr>
    <tr id="fila4">
      <td>Columna 1</td>
      <td>Columna 2</td>
      <td>Columna 3</td>
      <td>Columna 4</td>
      <td>Columna 5</td>
      <td>Columna 6</td>
      <td><input type="button" onclick="eliminarFila(4);" value="Eliminar" /></td>
    </tr>
  </table>
  <script>

 function eliminarFila(index) {
    $("#fila" + index).remove();
    //var indice = index;
    drop_tr(index);
 }

function drop_tr(indice_tr){
    var alerta = indice_tr;
	alert('Este es el indice'+alerta);
}

</script>

</body>
</html>