<?php
    $Host = "127.0.0.1";
    $Database = "auth";
    $Port = "3306";
    $Username = "root";
    $Pass = "trinity";

    $conta = $_POST['acct'];

    $conexao = mysqli_connect($Host, $Username, $Pass);
    $banco = mysqli_select_db($conexao,$Database);

    if (!$conexao) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    $row = $result->fetch_assoc();

    echo $row;

?>