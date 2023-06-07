<?php 
include("../header.php");
include("../../connection.php");  

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the form data
    $regId = $_POST['reg_id'];
    $grade = $_POST['grade'];
    $result = $_POST['result'];

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert the data into the database
    $gradeSql = "INSERT INTO grade (reg_id, grade, result) 
                  VALUES ('$regId', '$grade', '$result')";

    if (mysqli_query($conn, $gradeSql)) {
        echo "<script type='text/javascript'>alert('Student grade updated successfully');window.location.href='add_result.php';</script>";
    } else {
        echo "Error: " . $gradeSql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Register Student Result</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

    <div class="container">
        <h2>Register Student Result</h2>
        <form action="add_result.php" method="POST">
            <div class="form-group">
                <label for="reg_id">Registration ID:</label>
                <input type="text" class="form-control" id="reg_id" placeholder="Enter registration ID" name="reg_id" required>
            </div>
            <div class="form-group">
                <label for="grade">Grade:</label>
                <input type="text" class="form-control" id="grade" placeholder="Enter grade" name="grade" required>
            </div>
            <div class="form-group">
                <label for="grade">Result:</label>
                <input type="text" class="form-control" id="result" placeholder="Enter result" name="result" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

<?php 
include("../footer.php");
?>
