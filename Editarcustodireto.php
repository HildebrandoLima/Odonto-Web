<?php
	include("Conexaodb.php");

	//	ALTERAR SISTEMA DE ACORDO COM O ID SELECIONADO
	$custo_direto_id = filter_input(INPUT_POST, 'custo_direto_id', FILTER_SANITIZE_NUMBER_INT);
	$equipamento = filter_input(INPUT_POST, 'equipamento', FILTER_SANITIZE_STRING);
	$valor_custo_direto = filter_input(INPUT_POST, 'valor_custo_direto', FILTER_SANITIZE_STRING);

	$result_usuario = "UPDATE custos_diretos SET equipamento = '$equipamento', valor_custo_direto = '$valor_custo_direto', data_registro = NOW() WHERE custo_direto_id = '$custo_direto_id'";
	$resultado_usuario = mysqli_query($conn, $result_usuario);

	// ENCERRAR CÓDIGO E REDIRECINAR PÁGINA
	if(mysqli_affected_rows($conn)){
		echo "<script> alert('Informações editadas com Sucesso.'); window.location='custos-diretos.php'</script>";
	}else{
		echo "<script> alert('Informações não editadas com Sucesso.'); window.location='editar-custo-direto.php?custo_direto_id = '$custo_direto_id''</script>";
	}
