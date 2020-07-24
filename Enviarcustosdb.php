<?php
include('Conexaodb.php');

        $consultorio = $_POST['consultorio'];
        $total_valor_consultas = $_POST['total_valor_consultas'];
        $total_custos_fixos = $_POST['total_custos_fixos'];
        $total_custos_diretos = $_POST['total_custos_diretos'];
		$demonstracao_lucro = $_POST['demonstracao_lucro'];

		$insereDados = mysqli_query($conn, "INSERT INTO demonstracao_lucro (consultorio , total_valor_consultas , total_custos_fixos , total_custos_diretos , demonstracao_lucro, data_entrada)
		VALUES ('$consultorio' , '$total_valor_consultas' , '$total_custos_fixos' , '$total_custos_diretos', '$demonstracao_lucro', NOW())");
		echo "<script> alert('Informações enviadas com sucesso.'); window.location='demonstracao-lucro.php'</script>";
