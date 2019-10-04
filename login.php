<?php 
    session_start();
    include ("conexao.php");

    if(empty($_POST['usuario']) || empty($_POST['senha'])){
        header('Location: index.php');
        exit;
    }

    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    $query = "SELECT * FROM tb_usuarios WHERE db_usuario = '{$usuario}' AND db_senha = '{$senha}'";

    $result = mysqli_query($conexao, $query);
    $dado = mysqli_fetch_array($result); 
    $row = mysqli_num_rows($result);

    if($row > 0){
        $_SESSION['db_usuario'] = $usuario;
        $_SESSION['nome_usuario'] = $dado["db_nome"];
        $_SESSION['cargo_usuario'] = $dado["db_cargo"];

        if($_SESSION['cargo_usuario'] == 'Administrador' || $_SESSION['cargo_usuario'] == 'Gerente'){
            header('Location: painel_admin.php');
            exit();
        }

        if($_SESSION['cargo_usuario'] == 'Tesoureiro'){
            header('Location: painel_tesouraria.php');
            exit();
        }

        if($_SESSION['cargo_usuario'] == 'Funcionario'){
            header('Location: painel_funcionario.php');
            exit();
        }


       
        exit();

    }else{
        $_SESSION['nao_autenticado'] = true;
        header('Location: index.php');
        exit();

    }

?>