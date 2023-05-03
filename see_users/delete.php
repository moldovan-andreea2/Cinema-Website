<html>
<head>
    <meta charset="UTF-8">
    <title>Find</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            background: rgb(8, 1, 2);
        }
    </style>
    <script src="JavaScript/sidenav.js"> </script>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<header>
    <div class="navbar-container">
        <a class="logo"><img src="/images/popcorn.png" alt="Logo"></a>
        <h1>CINEMA POPCORN TIME</h1>
    </div>
</header>
<div class="sidebar">
    <p><a href="../main.html">
            <img src="../images/home.png" id="home-image" width="40" height="40">
        </a></p>
</div>
<footer style="margin-top: 650px">
    <b>&copy; Andreea Moldovan :)</b>
</footer>
</body>
</html>
<?php

$host = 'localhost';
$user = 'root';
$password = '';
$port = 3310;
$database = 'cinemadatabase';
$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die('Connect Error (' . $conn->connect_errno . ') '
        . $conn->connect_error);
}

// Get the email of the user to delete
$email = $_GET["email"];

// Delete the user from the database
$sql = "DELETE FROM users_nou WHERE email = '$email'";

if ($conn->query($sql) === TRUE) {
    header("Location: see_users.php");
    exit();
} else {
    echo "Error deleting user: " . $conn->error;
}


// Close the database connection
$conn->close();

?>
