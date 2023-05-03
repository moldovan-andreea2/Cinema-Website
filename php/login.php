<?php
function check_users($param1, $param2) {
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

    $stmt = $mysqli->prepare("SELECT email FROM users_nou WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $param1, $param2);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $Name = $row['email'];

    $stmt->close();
    $mysqli->close();

    if (!$row) {
        return '0';
    }
    else if ($Name === "admin@admin.com") {
        return '2';
    }

    else{
        return '1';}
}

if(isset($_POST['param1']) && isset($_POST['param2'])){
    $param1 = $_POST['param1'];
    $param2 = $_POST['param2'];
    $returnValue = check_users($param1, $param2);
    echo $returnValue;
}
?>