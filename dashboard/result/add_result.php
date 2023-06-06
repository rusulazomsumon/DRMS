<?php 
  include("../header.php");
  include("../../connection.php");  
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // Get the form data
        $name = $_POST['name'];
        $regId = $_POST['reg_id'];
        $roll = $_POST['roll'];

        $picture = $_FILES['picture']['name'];
        
        $fName = $_POST['f_name'];
        $mName = $_POST['m_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $branchId = $_POST['branch_id'];

        // Upload the picture file
        $targetDir = "imgs/";
        $targetFile = $targetDir . basename($_FILES["picture"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["picture"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFile)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["picture"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }


        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        // s_id 	name 	reg_Id 	roll 	picture 	f_name 	m_name 	email 	phone 	address 	branch_id 	
        // Insert the data into the database
        $sql = "INSERT INTO students (name, reg_Id, roll, picture, f_name, m_name, email, phone, address, branch_id) 
                VALUES ('$name', '$regId', '$roll', '$picture', '$fName', '$mName', '$email', '$phone', '$address', '$branchId')";

        if (mysqli_query($conn, $sql)) {
            echo "<script type='text/javascript'>alert('Student information updated successfully');window.location.href='all_student.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    }
?>


<!DOCTYPE html>
<html>
<head>
	<title>Register New Student</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container">
		<h2>Register New Student</h2>
		<form action="add_student.php" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="name">Name:</label>
				<input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
			</div>
			<div class="form-group">
				<label for="reg_id">Registration ID:</label>
				<input type="text" class="form-control" id="reg_id" placeholder="Enter registration ID" name="reg_id" required>
			</div>
			<div class="form-group">
				<label for="roll">Roll:</label>
				<input type="text" class="form-control" id="roll" placeholder="Enter roll" name="roll" required>
			</div>
			<div class="form-group">
				<label for="picture">Picture:</label>
				<input type="file" class="form-control-file" id="picture" name="picture" required>
			</div>
			<div class="form-group">
				<label for="f_name">Father's Name:</label>
				<input type="text" class="form-control" id="f_name" placeholder="Enter father's name" name="f_name" required>
			</div>
			<div class="form-group">
				<label for="m_name">Mother's Name:</label>
				<input type="text" class="form-control" id="m_name" placeholder="Enter mother's name" name="m_name" required>
			</div>
			<div class="form-group">
				<label for="email">Email:</label>
				<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
			</div>
			<div class="form-group">
				<label for="phone">Phone:</label>
				<input type="text" class="form-control" id="phone" placeholder="Enter phone number" name="phone" required>
			</div>
			<div class="form-group">
				<label for="address">Address:</label>
				<textarea class="form-control" id="address" placeholder="Enter address" name="address" required></textarea>
			</div>
            <div class="form-group">
				<label for="crs_id">Course ID:</label>
				<input type="text" class="form-control" id="crs_id" placeholder="Enter Courses ID" name="crs_id" required>
			</div>
			<div class="form-group">
				<label for="branch_id">Branch ID:</label>
				<input type="text" class="form-control" id="branch_id" placeholder="Enter branch ID" name="branch_id" required>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    


<?php 
  include("../footer.php");
?>