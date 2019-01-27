<?php

session_start();

include_once("conexao.php");


//Receber os dados do formulário
//$arquivo = $_FILES['arquivo'];
//var_dump($arquivo);
$arquivo_tmp =$_FILES['arquivo']['tmp_name'];

//ler todo o arquivo para um array
$dado = file($arquivo_tmp);
//var_dump($dado);

foreach($dado as $linha){
    $linha = trim($linha);
    $valor = explode(',',$linha);
    //var_dump($valor);

    $dia = $valor[0];
    $hora = $valor[1];
    $valor1 = $valor[2];
    $valor2 = $valor[3];
    $valor3 = $valor[4];

    $result_usuario = "INSERT INTO usuarios (dia, hora, valor1, valor2, valor3) VALUES('$dia', '$hora', '$valor1', '$valor2', '$valor3')";

    $resultado_usuario = mysqli_query($conn, $result_usuario);
}
$_SESSION['msg'] = "<p style='color: green;'>Carregado os dados com sucesso</p>";
header("Location: index.php");