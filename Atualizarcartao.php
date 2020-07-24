<?php
 //	Atualizar a entrada do cartão
include('Conexaodb.php');

	$status_id = filter_input(INPUT_POST, 'status_id', FILTER_SANITIZE_NUMBER_INT);
	$entrada = filter_input(INPUT_POST, 'entrada', FILTER_SANITIZE_STRING);

	$result_usuario = "UPDATE status SET entrada = '$entrada' WHERE status_id = '$status_id'";
	$resultado_usuario = mysqli_query($conn, $result_usuario);
	echo "<script> alert('Entrada Confirmada com Sucesso...'); window.location='historico.php'</script>";
