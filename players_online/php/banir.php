<?php
    $Host = "127.0.0.1";
    $Database = "auth";
    $Port = "3306";
    $Username = "root";
    $Pass = "trinity";

    $conta = $_POST['acct'];
    $razao = $_POST['razao'];
    $tempo = $_POST['tempo'];
    $senha = $_POST['senha'];

    $conexao = mysqli_connect($Host, $Username, $Pass);
    $banco = mysqli_select_db($conexao,$Database);

    if (!$conexao) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    $bandate = time();
    $bannedby = 'website';
    $unbandate = $bandate+($tempo*60);

    $senhaCerta = (sha1($senha) == '8a4787c0396a587fa659391b3141a14c88809c1d');

    if($conta > 0 && $senhaCerta){
        $query = "INSERT INTO account_banned (id, bandate, unbandate, bannedby, banreason, active)
        VALUES ($conta, $bandate, $unbandate, '$bannedby', '$razao', 1)";
    
        $result = $conexao->query($query) or die($conexao->error);
    
        echo 'A conta selecionada foi banida por '.$tempo.' minutos, razão: '.$razao;
    }else{
        header('Location: ../players_online.php');
        alert('test');
    }

    $conexao -> close();
?>