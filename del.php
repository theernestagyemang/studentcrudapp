<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentcruddb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else{
    echo "Connected successfully";
}


if(isset($_GET['del'])){
    $id = $_GET['del'];
    // echo $id;
    $query = "DELETE FROM student WHERE id = $id";
    if(mysqli_query($conn, $query)){
        echo '<script>alert("Student deleted successfully")</script>';
        echo '<script>window.open("index.php", "_self")</script>';
    }
}

?>