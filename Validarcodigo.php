<?php
    session_start(); 
    //Incluindo a conexão com banco de dados   
    include_once("Conexaodb.php");    
    //O campo usuário e senha preenchido entra no if para validar
    if((isset($_POST['codigo']))){
		$codigo = mysqli_real_escape_string($conn, $_POST['codigo']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
        //$senha = mysqli_real_escape_string($conn, $_POST['senha']);
        $codigo = md5($codigo);

        //Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
        $tabela = "SELECT * FROM usuarios WHERE codigo = '$codigo' LIMIT 1";
        $verifica = mysqli_query($conn, $tabela);
        //$resultado = mysqli_fetch_assoc($resultado_usuario);

    //Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
    if(isset($verifica)){
		$busca = mysqli_num_rows($verifica);
	if(($busca) == '0'){
        $_SESSION['codigoErro'] = "<center><font color='#FF0000'> Código  Inv&aacute;lido </font></center>";
        header("Location: verificar.php");
    }else{
		$listarDados = mysqli_query($conn, "SELECT codigo FROM usuarios WHERE codigo = '$codigo'");
		while($escrever = mysqli_fetch_array($listarDados)){
        header("Location: liberaracesso.php?codigo=". $escrever['codigo'] . "");
    }}
	// Free result set
	mysqli_free_result($verifica);
    }}else{
        $_SESSION['codigoErro'] = "<center><font color='#FF0000'> Código  Inv&aacute;lido </font></center>";
        header("Location: verificar.php");
    }
	// Connection close
	mysqli_close($conn);
