<?php
include('Conexaodb.php');

        $consultorio = $_POST['consultorio'];
        $modalidade = $_POST['modalidade'];
        $valor_modalidade = $_POST['valor_modalidade'];

		$insereDados = mysqli_query($conn, "INSERT INTO modalidades (consultorio , modalidade , valor_modalidade)
		VALUES ('$consultorio' , '$modalidade' , '$valor_modalidade')");
		echo "<script> alert('Informações enviadas com sucesso.'); window.location='consultorio.php'</script>";
