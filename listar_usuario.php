<!-- Responsável por buscar os arquivos no banco de dados -->
<?php
include_once "conexao.php";

//consultar no banco de dados
$result_usuario = "SELECT * FROM usuarios ORDER BY id DESC";
//Executando a query
$resultado_usuario = mysqli_query($conn, $result_usuario);

//Verificar se encontrou resultado na tabela "usuarios"
if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
	?>

	<table class="table table-bordered table-striped table-hover">
		<thead>
    		<tr>
    	  		<th>ID</th>
    	  		<th>Tempo</th>
                <th>Valor 1</th>
                <th>Valor 2</th>
                <th>Valor 3</th>
    		</tr>
  		</thead>
	<tbody>

<?php
	while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
?>

	<tr>
      <th> <?php echo $row_usuario['id']; ?> </th>
      <td> <?php echo $row_usuario['tempo']; ?> </td>
      <td> <?php echo $row_usuario['valor1']; ?> </td>
      <td> <?php echo $row_usuario['valor2']; ?> </td>
      <td> <?php echo $row_usuario['valor3']; ?> </td>
    </tr>

<?php
	} ?>
	</tbody>
	</table>
	<?php
}else{
	echo "<div class='alert alert-danger' role='alert'>Nenhum usuário encontrado!</div>";
}
?>

<script>

function mostraLista(){
    lista.style.display="inline"
}

</script>