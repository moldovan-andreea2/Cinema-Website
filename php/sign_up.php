<?php
function add_users($param1, $param2, $param3,$param4, $param5) {
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'cinemadatabase';
    $port = 3310;
    $mysqli = new mysqli($host, $user, $password, $database, $port);

    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
    }

    $stmt = $mysqli->prepare("SELECT email FROM users_nou WHERE email = ?");
    $stmt->bind_param("s", $param1);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    //$Name = $row['name'];

    if (!$row) {
        $stmt = $mysqli->prepare("INSERT INTO users_nou VALUES (?, ?, ?,?,?)");
        $stmt->bind_param("sssss", $param1, $param2, $param3, $param4, $param5);
        $stmt->execute();
        $stmt->close();
        $mysqli->close();
        return '1';
    }

    else{
        $mysqli->close();
        return '0';
    }
}

if(isset($_POST['param1']) && isset($_POST['param2']) && isset($_POST['param3']) && isset($_POST['param4']) && isset($_POST['param5'])){
    $param1 = $_POST['param1'];
    $param2 = $_POST['param2'];
    $param3 = $_POST['param3'];
    $param4 = $_POST['param4'];
    $param5 = $_POST['param5'];
    $returnValue = add_users($param1, $param2, $param3, $param4,$param5);
    echo $returnValue;
}




