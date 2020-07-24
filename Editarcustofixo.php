<?php
	include("Conexaodb.php");

	//	ALTERAR SISTEMA DE ACORDO COM O ID SELECIONADO
	$custo_fixo_id = filter_input(INPUT_POST, 'custo_fixo_id', FILTER_SANITIZE_NUMBER_INT);
	$categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRING);
	$valor_custo_fixo = filter_input(INPUT_POST, 'valor_custo_fixo', FILTER_SANITIZE_STRING);

	$result_usuario = "UPDATE custos_fixos SET categoria = '$categoria', valor_custo_fixo = '$valor_custo_fixo', data_registro = NOW() WHERE custo_fixo_id = '$custo_fixo_id'";
	$resultado_usuario = mysqli_query($conn, $result_usuario);

	// ENCERRAR CÓDIGO E REDIRECINAR PÁGINA
	if(mysqli_affected_rows($conn)){
		echo "<script> alert('Informações editadas com Sucesso.'); window.location='custos-fixos.php'</script>";
	}else{
		echo "<script> alert('Informações não editadas com Sucesso.'); window.location='custos-fixos.php?custo_fixo_id = '$custo_fixo_id''</script>";
	}
