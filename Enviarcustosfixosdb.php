<?php
include('Conexaodb.php');

        $consultorio = $_POST['consultorio'];
        $categoria = $_POST['categoria'];
        $valor_custo_fixo = $_POST['valor_custo_fixo'];

		$insereDados = mysqli_query($conn, "INSERT INTO custos_fixos (consultorio , categoria , valor_custo_fixo , data_entrada)
		VALUES ('$consultorio' , '$categoria' , '$valor_custo_fixo' , NOW())");
		echo "<script> alert('Informações enviadas com sucesso.'); window.location='registrar-custo.php'</script>";
