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
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Student Management CRUD App</title>
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
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Manage <b>Student</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addStudentModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Student</span></a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Father Name</th>
						<th>Email</th>
						<th>Gender</th>
						<th>Subject</th>
						<th>Country</th>
						<th>City</th>
						<th>DOB</th>
						<th>Address</th>
						<th>Picture</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
					<?php
					$query = "SELECT * FROM student";
					$result = mysqli_query($conn, $query);
					while($row = mysqli_fetch_array($result)){
					?>
						<td><?php echo $row['firstname']; ?></td>
						<td><?php echo $row['lastname']; ?></td>
						<td><?php echo $row['guardian']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['gender']; ?></td>
						<td><?php echo $row['program']; ?></td>
						<td><?php echo $row['country']; ?></td>
						<td><?php echo $row['city']; ?></td>
						<td><?php echo $row['dob']; ?></td>
						<td><?php echo $row['address']; ?></td>
						<td><img src="uploads/<?php echo $row['picture']; ?>" width="40" height="40"></td>
					<td>
						<a href="edit.php?id=<?php echo $row['id']; ?>" class="edit" data-toggle=""><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
						<a href="del.php?id=<?php echo $row['id']; ?>" class="delete" data-toggle=""><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
					</td>
					</tr>
					<?php
					}
					?>
				</tbody>
			</table>

		</div>
	</div>        
</div>
<!-- Edit Modal HTML -->
<div id="addStudentModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="#" enctype="multipart/form-data">
				<div class="modal-header">						
					<h4 class="modal-title">Add Student</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>First Name</label>
						<input type="text" name="firstname" class="form-control" >
					</div>
					<div class="form-group">
						<label>Last Name</label>
						<input type="text" name="lastname" class="form-control" >
					</div>
					<div class="form-group">
						<label>Guardian</label>
						<input type="text" name="guardian" class="form-control" >
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control" >
					</div>
					<div class="form-group">
						<label>Gender</label>
						<select name="gender" id="" class="form-control" >
							<option value="Male">Male</option>
							<option value="Female">Female</option>
							<option value="Other">Other</option>
						</select>
					</div>
					<div class="form-group">
						<label>Program</label>
						<input type="text" name="program" class="form-control" >
					</div>	
					<div class="form-group">
						<label>Country</label>
						<select name="country" id="" class="form-control">
							<option value="Ghana">Ghana</option>
							<option value="USA">USA</option>
							<option value="UK">UK</option>
							<option value="UK">UK</option>
							<option value="Greece">Greece</option>
						</select>					
					</div>
					<div class="form-group">
						<label>City</label>
						<input type="text" name="city" class="form-control" >
					</div>						
					<div class="form-group">
						<label>DOB</label>
						<input type="date" name="dob" class="form-control" >
					</div>	
					<div class="form-group">
						<label>Address</label>
						<textarea class="form-control" name="address"  ></textarea>
					</div>
					<div class="form-group">
						<label>Picture</label>
						<input type="file" name="picture"  class="form-control" >
					</div>		
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" name="addstd" class="btn btn-success" value="Add">
				</div>
				
			</form>

			<?php
			if(isset($_POST['addstd'])){
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
				$target_dir = "uploads/";
				$target_file = $target_dir . basename($_FILES["picture"]["name"]);
				// Select file type
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				// Valid file extensions
				$extensions_arr = array("jpg","jpeg","png","gif");
				// Check extension
				if( in_array($imageFileType,$extensions_arr) ){
					// Insert record
					$query = "INSERT INTO student(firstname,lastname,guardian,email,gender,program,country,city,dob,address,picture) VALUES('$firstname','$lastname','$guardian','$email','$gender','$program','$country','$city','$dob','$address','$picture')";
					// Upload file
					move_uploaded_file($_FILES['picture']['tmp_name'],$target_dir.$picture);
					if(mysqli_query($conn, $query)){
						echo "<script>window.open('index.php','_self')</script>";
					}
					else{
						echo "Record not added successfully.";
					}
				}
			}

			?>
		</div>
	</div>
</div>
</body>
</html>