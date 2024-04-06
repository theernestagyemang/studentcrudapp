<!DOCTYPE html>
<?php
// username, user password, database name, server name
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
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $query = "SELECT * FROM student WHERE id = $id";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
            
        ?>
        <form method="post" action="#" enctype="multipart/form-data">
            <div class="modal-header">
                <h4 class="modal-title">Edit Student</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="firstname" value="<?php echo $row['firstname']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="lastname" value="<?php echo $row['lastname']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Guardian</label>
                    <input type="text" name="guardian" value="<?php echo $row['guardian']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $row['email']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" class="form-control">
                        <option value="<?php echo $row['gender']; ?>"><?php echo $row['gender']; ?></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Program</label>
                    <input type="text" name="program" value="<?php echo $row['program']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Country</label>
                    <select name="country" id="" name="country" value="" class="form-control">
                        <option value="<?php echo $row['country']; ?>"><?php echo $row['country']; ?></option>
                        <option value="Ghana">Ghana</option>
                        <option value="USA">USA</option>
                        <option value="UK">UK</option>
                        <option value="UK">UK</option>
                        <option value="Greece">Greece</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" value="<?php echo $row['city']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>DOB</label>
                    <input type="date" name="dob" value="<?php echo $row['dob']; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" name="address"><?php echo $row['address']; ?></textarea>
                </div>
                <div class="form-group">
                    <label>Picture</label>
                    <input type="file" name="picture" class="form-control">
                    <img src="uploads/<?php echo $row['picture']; ?>" width="40" height="40" alt="<?php echo $row['picture']; ?>">
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                <input type="submit" name="update" class="btn btn-success" value="Update">
            </div>
        </form>
        <?php
            }
        ?>
    </div>
    <?php
        if(isset($_POST['update'])){
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $guardian = $_POST['guardian'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $program = $_POST['program'];
            $country = $_POST['country'];
            $city = $_POST['city'];
            $dob = $_POST['dob'];
            $address = $_POST['address'];
            $picture = $_FILES['picture']['name'];
            $tmp_name = $_FILES['picture']['tmp_name'];
            move_uploaded_file($tmp_name, "uploads/$picture");
            $query = "UPDATE student SET firstname = '$firstname', lastname = '$lastname', guardian = '$guardian', email = '$email', gender = '$gender', program = '$program', country = '$country', city = '$city', dob = '$dob', address = '$address', picture = '$picture' WHERE id = $id";
            if(mysqli_query($conn, $query)){
                echo '<script>alert("Student updated successfully")</script>';
                echo '<script>window.open("index.php", "_self")</script>';
            }
        }
    ?>
</body>
</html>