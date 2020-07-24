<?php
include('Conexaodb.php');

        $consultorio = $_POST['consultorio'];
        $categoria = $_POST['categoria'];
        $valor_despesa = $_POST['valor_despesa'];

		$insereDados = mysqli_query($conn, "INSERT INTO custos_fixos (consultorio , categoria , valor_despesa , data_registro)
		VALUES ('$consultorio' , '$categoria' , '$valor_despesa' , NOW())");
		echo "<script> alert('Informações enviadas com sucesso.'); window.location='registrar-custos.php'</script>";
