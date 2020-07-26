<?php
include('Conexaodb.php');

        $consultorio = $_POST['consultorio'];
        $equipamento = $_POST['equipamento'];
        $quantidade = $_POST['quantidade'];
        $valor_custo_direto = $_POST['valor_custo_direto'];

		$insereDados = mysqli_query($conn, "INSERT INTO custos_diretos (consultorio , equipamento , quantidade, valor_custo_direto , data_entrada)
		VALUES ('$consultorio' , '$equipamento' , '$quantidade' , '$valor_custo_direto' , NOW())");
		echo "<script> alert('Informações enviadas com sucesso.'); window.location='registrar-custo.php'</script>";
