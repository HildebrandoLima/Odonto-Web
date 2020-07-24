<?php
include('Conexaodb.php');

        $consultorio = $_POST['consultorio'];
        $nome = $_POST['nome'];
        $data_marcada = $_POST['data_marcada'];
		$servico = 'Manutenção';
		$valor = '70,00';

		$tabela = "SELECT data_marcada FROM consulta WHERE data_marcada = DATE(NOW())";
		$verifica = mysqli_query($conn, $tabela);

		if($verifica){
			$total = mysqli_num_rows($verifica);

		if($total < 30){
			$insereDados = mysqli_query($conn, "INSERT INTO consulta (consultorio , nome , data_marcada , data_registro , servico , valor)
			VALUES ('$consultorio' , '$nome' , '$data_marcada' , NOW() , '$servico' , '$valor')");
			echo "<script> alert('Informações enviadas com sucesso.'); window.location='consultorio.php'</script>";
       }else{
			echo "<script> alert('Limite de cadastro ultrapasado...'); window.location='registrar-consulta.php'</script>";
	   }
	   mysqli_free_result($verifica);
	}
