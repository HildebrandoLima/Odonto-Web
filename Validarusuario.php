<?php
    session_start(); 
    //Incluindo a conexão com banco de dados   
    include_once("Conexaodb.php");    
    //O campo usuário e senha preenchido entra no if para validar
    if((isset($_POST['nome'])) && (isset($_POST['senha']))){
		$nome = mysqli_real_escape_string($conn, $_POST['nome']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
        $senha = mysqli_real_escape_string($conn, $_POST['senha']);
        $senha = md5($senha);

        //Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
        $result_usuario = "SELECT * FROM usuarios WHERE nome = '$nome' && senha = '$senha' LIMIT 1";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        $resultado = mysqli_fetch_assoc($resultado_usuario);

    //Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
    if(isset($resultado)){
        $_SESSION['usuarioId'] = $resultado['usuario_id'];
        $_SESSION['usuarioNome'] = $resultado['nome'];
        $_SESSION['usuarioNiveisAcessoId'] = $resultado['niveis_acesso_id'];
        $_SESSION['usuarioEmail'] = $resultado['email'];
    if($_SESSION['usuarioNiveisAcessoId'] == "1"){
		header("Location: administrador.php");
    }elseif($_SESSION['usuarioNiveisAcessoId'] == "2"){
		header("Location: financeiro.php");
    }elseif($_SESSION['usuarioNiveisAcessoId'] == "3"){
		header("Location: consultorio.php");
    }elseif($_SESSION['usuarioNiveisAcessoId'] == "4"){
		header("Location: colaborador.php");
	}elseif($_SESSION['usuarioNiveisAcessoId'] == "5"){
		header("Location: usuario.php");
	}
    //Não foi encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
    //redireciona o usuario para a página de login
    }else{    
        //Váriavel global recebendo a mensagem de erro
        $_SESSION['loginErro'] = "<center><font color='#FF0000'> Usu&aacute;rio ou senha Inv&aacute;lido </font></center>";
        header("Location: index.php");
    }
    //O campo usuário e senha não preenchido entra no else e redireciona o usuário para a página de login
    }else{
        $_SESSION['loginErro'] = "<center><font color='#FF0000'> Usu&aacute;rio ou senha inv&aacute;lido </font></center>";
        header("Location: index.php");
    }
