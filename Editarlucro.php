<?php
	include("Conexaodb.php");

	//	ALTERAR SISTEMA DE ACORDO COM O ID SELECIONADO
	$demonstracao_lucro_id = filter_input(INPUT_POST, 'demonstracao_lucro_id', FILTER_SANITIZE_NUMBER_INT);
	$total_valor_consultas = filter_input(INPUT_POST, 'total_valor_consultas', FILTER_SANITIZE_STRING);
	$total_custos_fixos = filter_input(INPUT_POST, 'total_custos_fixos', FILTER_SANITIZE_STRING);
	$total_custos_diretos = filter_input(INPUT_POST, 'total_custos_diretos', FILTER_SANITIZE_STRING);

	$result_usuario = "UPDATE demonstracao_lucro SET total_valor_consultas = '$total_valor_consultas', total_custos_fixos = '$total_custos_fixos', total_custos_diretos = '$total_custos_diretos' WHERE demonstracao_lucro_id = '$demonstracao_lucro_id'";
	$resultado_usuario = mysqli_query($conn, $result_usuario);

	// ENCERRAR CÓDIGO E REDIRECINAR PÁGINA
	if(mysqli_affected_rows($conn)){
		echo "<script> alert('Informações editadas com Sucesso.'); window.location='demonstracao-lucro.php'</script>";
	}else{
		echo "<script> alert('Informações não editadas com Sucesso.'); window.location='demonstracao-lucro.php?demonstracao_lucro_id = '$demonstracao_lucro_id''</script>";
	}
