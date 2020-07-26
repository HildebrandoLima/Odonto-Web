<?php
include('Conexaodb.php');

        $consultorio = $_POST['consultorio'];
        $nome = $_POST['nome'];
		$modalidade = $_POST['modalidade'];
        $data_marcada = $_POST['data_marcada'];
		$valor_servico = $_POST['valor_servico'];

		$tabela = "SELECT data_marcada FROM consultas WHERE data_marcada = DATE(NOW())";
		$verifica = mysqli_query($conn, $tabela);

		if($verifica){
			$total = mysqli_num_rows($verifica);

		if($total < 30){
			$insereDados = mysqli_query($conn, "INSERT INTO consultas (consultorio , nome , modalidade , data_marcada , valor_servico)
			VALUES ('$consultorio' , '$nome' , '$modalidade' , '$data_marcada' , '$valor_servico')");
			echo "<script> alert('Informações enviadas com sucesso.'); window.location='consultorio.php'</script>";
       }else{
			echo "<script> alert('Limite de cadastro ultrapasado...'); window.location='registrar-consulta.php'</script>";
	   }
	   mysqli_free_result($verifica);
	}
