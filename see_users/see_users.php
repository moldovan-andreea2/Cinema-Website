<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style.css">
    <title>See Users</title>
    <style>
        body {
            background: #050404;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
<h1 style="color: aquamarine; margin-left: 600px; margin-top: 60px; font-size: 45px">DELETE A USER</h1>
</body>
</html>
<?php


$host = 'localhost';
$user = 'root';
$password = '';
$port=3310;
$database = 'cinemadatabase';
$conn = new mysqli($host, $user, $password, $database,$port);

if ($conn->connect_error) {
    die('Connect Error (' . $conn->connect_errno . ') '
        . $conn->connect_error);
}


// Query the users table
$sql = "SELECT * FROM users_nou WHERE email not in ('admin@admin.com')";
$result = $conn->query($sql);

// Display the results in a table
if ($result->num_rows > 0) {
    echo "<table class='delete_user_table'>
            <tr>
                <th>User</th>
                <th>Phone</th>
                <th>City</th>
                <th>Code</th>
                <th>Action</th>
            </tr>";
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["email"] . "</td>
                <td>" . $row["phone"] . "</td>
                <td>" . $row["city"] . "</td>
                <td>" . $row["postalcode"] . "</td>
                <td>
                    <a id='a_see_users' href='delete.php?email="  . $row["email"] . "'>Delete</a>
                </td>
            </tr>";
    }
    echo "</table>";
    echo "<footer style='margin-top: 650px;'><b>&copy; Andreea Moldovan :)</b></footer>";


} else {
    echo "0 results";
}

// Close the database connection
$conn->close();


