<?php
	session_start();
	include("Conexaodb.php");

	//	ALTERAR SISTEMA DE ACORDO COM O ID SELECIONADO
	$codigo = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_STRING);
	$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
	$senha = md5($senha);

	$result_usuario = "UPDATE usuarios SET senha = '$senha' WHERE codigo = '$codigo'";
	$resultado_usuario = mysqli_query($conn, $result_usuario);

	// ENCERRAR CÓDIGO E REDIRECINAR PÁGINA
	if(mysqli_affected_rows($conn)){
		$_SESSION['msgSenha'] = "<center><p style='color: green;'> Informação Enviada Com Sucesso... </p></center>";
		header("Location: index.php");
	}else{
		$_SESSION['msgSenha'] = "<center><p style='color: red;'> Informação Não Enviada Com Sucesso... </p></center>";
		header("Location: liberaracesso.php?codigo=$codigo");
	}
