<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Players online</title>
</head>
<body>
    <main>
        <?php
            $cHost = "127.0.0.1";
            $cDatabase = "characters";
            $cPort = "3306";
            $cUsername = "root";
            $cPass = "trinity";

            $conexao = mysqli_connect($cHost, $cUsername, $cPass);
            $banco = mysqli_select_db($conexao,$cDatabase);

            if (!$conexao) {
                echo "Error: Unable to connect to MySQL." . PHP_EOL;
                echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
                echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
                exit;
            }

            $query = "SELECT * FROM characters WHERE online = 1";
            $result = $conexao->query($query) or die($conexao->error);
            $numrows = $result->num_rows;
            echo "<h1>Players online</h1>";

            $jogadores = 'player';

            if ($numrows > 1){
                $jogadores = 'players';
            }

            echo "<p>Atualmente temos $numrows $jogadores online</p>";
            echo "<h3>Os players que estão online são:</h3>";

            echo '<div id="players">';
            while($row = $result->fetch_assoc()){
                echo '<div class="player">';
                echo $row['name'].' - Level: '.$row['level'];
                echo ' Dinheiro: '.$row['money'].' ';
                echo '<form action="php/banir.php" method="post">';
                echo '<input type="text" id="'.$row['account'].'" name="acct" style="display:none">';
                echo '<input type="text" id="'.$row['account'].'razao'.'" name="razao" style="display:none">';
                echo '<input type="text" id="'.$row['account'].'tempo'.'" name="tempo" style="display:none">';
                echo '<button type="submit" data-acct="'.$row['account'].'" class="btn">Banir</button>';
                echo'</form>';
                echo "</div>";
            }
            echo '</div>';
            /* Testando umas paradas
            $newMoney = 6000;
            $personagem = "Motumba";
            $query = "UPDATE characters SET money = ".$newMoney." WHERE name = '".$personagem."'";

            $result = $conexao->query($query) or die($conexao->error);*/

        ?>
    </main>
</body>
<script src="js/main.js" type="text/javascript"></script>
</html>

