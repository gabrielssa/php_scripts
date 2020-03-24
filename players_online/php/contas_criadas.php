<?php

$Host = "127.0.0.1";
$Database = "auth";
$Port = "3306";
$Username = "root";
$Pass = "trinity";
 
$conn = mysqli_connect($Host, $Username, $Pass, $Database);

if (!$conn){ 
    print("No database connection");
    exit(); 
    }

if ($stmt = $conn->prepare("SELECT * FROM account")){ 

    $stmt->execute();
    $stmt->store_result();
	
    if($stmt->num_rows > 0)
        echo $stmt->num_rows.' Contas Criadas até agora.';
    $stmt->close(); 
}
?>
                            