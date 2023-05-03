<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style.css">
    <title>Gallery</title>
    <style>
        body {
            background: #050404;
        }
    </style>
</head>
<body>
<header>
    <div class="navbar-container">
        <a class="logo"><img src="/images/popcorn.png" alt="Logo"></a>
        <div class="menu-container">
        </div>
    </div>
</header>
<div class="sidebar">
    <p><a href="../main.html">
            <img src="../images/home.png" id="home-image" width="40px" height="40px">
        </a></p>
</div>
<h1 style="color: aquamarine; margin-left: 400px; margin-top: 60px; font-size: 45px">OUR USERS' FAVOURITE MOVIES</h1>
<form action="upload.php" method="post" enctype="multipart/form-data" style="margin-left: 550px">
    <label>Select Image File:</label>
    <input type="file" name="image">
    <input type="submit" name="submit" value="Click to upload your image!" style="width: 20%">
</form>


</body>
</html>
<?php

// Include the database configuration file

$host = 'localhost';
$user = 'root';
$password = '';
$port=3310;
$database = 'cinemadatabase';
$db = new mysqli($host, $user, $password, $database,$port);

if ($db->connect_error) {
    die('Connect Error (' . $db->connect_errno . ') '
        . $db->connect_error);
}

// If file upload form is submitted
$status = $statusMsg = '';
if (isset($_POST["submit"])) {
    $status = 'error';
    if (!empty($_FILES["image"]["name"])) {
        // Get file info
        $fileName = basename($_FILES["image"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            $image = $_FILES['image']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));

            // Insert image content into database
            $insert = $db->query("INSERT into images (image, created) VALUES ('$imgContent', NOW())");

            if ($insert) {
                $status = 'success';
                $statusMsg = "File uploaded successfully.";
            } else {
                $statusMsg = "File upload failed, please try again.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select an image file to upload.';
    }
}

// Display status message
echo $statusMsg;

//
// Get image data from database
$result = $db->query("SELECT image FROM images ORDER BY id DESC");
?>

<?php if($result->num_rows > 0){ ?>
    <div class="galleryy">
        <?php while($row = $result->fetch_assoc()){ ?>
            <img class="galleryy-img" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" />
        <?php } ?>
    </div>
<?php }else{ ?>
    <p class="status error">Image(s) not found...</p>
<?php } ?>
<footer>
    <b>&copy; Andreea Moldovan :)</b>
</footer>

