<?php
include('Conexaodb.php');

        $consultorio = $_POST['consultorio'];
        $equipamento = $_POST['equipamento'];
        $quantidade = $_POST['quantidade'];
        $valor_equipamento = $_POST['valor_equipamento'];

		$insereDados = mysqli_query($conn, "INSERT INTO custos_diretos (consultorio , equipamento , quantidade, valor_equipamento , data_registro)
		VALUES ('$consultorio' , '$equipamento' , '$quantidade' , '$valor_equipamento' , NOW())");
		echo "<script> alert('Informações enviadas com sucesso.'); window.location='registrar-custos.php'</script>";
