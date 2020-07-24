<?php
include('Conexaodb.php');

        $nome = $_POST['nome'];
		$consultorio = $_POST['consultorio'];
		$inicio_plano = $_POST['inicio_plano'];
		$data_nascimento = $_POST['data_nascimento'];
		$telefone = $_POST['telefone'];
        $situacoe_id = 1;
		$niveis_acesso_id = $_POST['niveis_acesso_id'];
		$endereco = $_POST['endereco'];
		$num = $_POST['num'];
		$bairro = $_POST['bairro'];
		$status_vencimento = 'N';

		// GERAR NÚMERO ALEATÓRIO PARA O BÔNUS
		$upper = implode('', range('A', 'Z')); // ABCDEFGHIJKLMNOPQRSTUVWXYZ
		$lower = implode('', range('a', 'z')); // abcdefghijklmnopqrstuvwxyzy
		$nums = implode('', range(0, 9)); // 0123456789

		$alphaNumeric = $upper.$lower.$nums; // ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789
		$codigo = '';
		$len = 7; // numero de chars
		for($i = 0; $i < $len; $i++) {
			$codigo .= $alphaNumeric[rand(0, strlen($alphaNumeric) - 1)];
		}

		$tabela = "SELECT * FROM usuarios WHERE nome = '$nome'";
		$verifica = mysqli_query($conn, $tabela);

		if($verifica){
		$busca = mysqli_num_rows($verifica);

		if(($busca) == '0'){
        $insereDados = mysqli_query($conn, "INSERT INTO usuarios (nome , consultorio , inicio_plano , data_nascimento , telefone , situacoe_id , niveis_acesso_id , endereco , num , bairro , status_vencimento , codigo , data_registro)
		VALUES ('$nome' , '$consultorio' , '$inicio_plano' , '$data_nascimento' , '$telefone' , '$situacoe_id' , '$niveis_acesso_id' , '$endereco' , '$num' , '$bairro' , '$status_vencimento' , md5('$codigo') , NOW())");
			echo "<script> alert('Informações enviadas com sucesso. Seu código é: $codigo md5($codigo). Oriente seu enquanto o uso do mesmo.'); window.location='registrar-usuario.php'</script>";
		 }else{
			echo "<script> alert('$nome, já está cadastrado(a).); window.location='registrar-usuario.php'</script>";
		 }
		// Free result set
		mysqli_free_result($verifica);
		}
		// Connection close 
		mysqli_close($conn);
