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
            echo "<h1><span id=\"logo\">Players</span> Online</h1>";

            $jogadores = 'player';

            if ($numrows > 1){
                $jogadores = 'players';
            }
            echo '<nav>';
            echo '<button class="nav-btn" id="cc-btn">Contas Criadas</button>';
            echo '</nav>';
            echo "<p>Atualmente temos $numrows $jogadores online</p>";
            echo "<h3>Os players que estão online são:</h3>";

            echo '<div id="players">';
            while($row = $result->fetch_assoc()){
                echo '<div class="player" data-player="'.$row['name'].'">';

                    echo '<div id="info" class="info">';
                        echo '<p>';
                        echo $row['name'];
                        echo '</p>';
                    echo '</div>';

                    echo '<div id="action">';
                        echo '<form action="php/banir.php" method="post">';
                            /*Campos invisíveis*/
                            echo '<input type="text" id="'.$row['account'].'" name="acct" style="display:none">';
                            echo '<input type="text" id="'.$row['account'].'razao'.'" name="razao" style="display:none">';
                            echo '<input type="text" id="'.$row['account'].'tempo'.'" name="tempo" style="display:none">';
                            echo '<input type="text" id="'.$row['account'].'senha'.'" name="senha" style="display:none">';

                            //Botão
                            echo '<button type="submit" data-acct="'.$row['account'].'" class="btn">Banir</button>';
                        echo'</form>';
                    echo '</div>';

                    echo '<div id='.$row['name'].' style="display: none" class="moreinfo" onload="alert("test")">';
                        //Começa aqui as informações detalhadas

                        //dinheiro
                        echo '<h1>'.$row['name'].'</h1>';
                        $money = $row['money'];
                        $copper = substr($money,-2,2);
                        $silver = substr($money, -4,2);
                        $gold = substr($money,0, strlen($money)-4);
                        echo '<span>Dinheiro: '.$gold.' ';
                        echo '<img src="img/gold.gif"></img>';
                        echo $silver;
                        echo '<img src="img/silver.gif"></img>';
                        echo $copper;
                        echo '<img src="img/copper.gif"></img>';
                        echo '</span>';
                        echo '<hr>';
                        echo '<p>Level: '.$row["level"].'</p>';
                        echo '<hr>';
                        echo '<p>Position_x: '.$row["position_x"].'</p>';
                        echo '<p>Position_y: '.$row["position_y"].'</p>';
                        echo '<p>Position_z: '.$row["position_z"].'</p>';
                        echo '<p>Map: '.$row["map"].'</p>';
                        echo '<hr>';
                        $tempoJogado = $row["totaltime"]/60;
                        $tempoJogado = number_format($tempoJogado, 2, '.', '');
                        echo '<p>Tempo de jogo total: '.($tempoJogado).'Minutos</p>';
                        echo '<p>Ping: '.$row["latency"].'</p>';

                        //fim das informações detalhadas
                    echo '</div>';

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

