<?php
include("../header.php");
include("../../connection.php");  
// receving the value
$regId = $_GET['regId'];

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

    // Update the data in the database
    $gradeSql = "UPDATE grade SET grade = '$grade', result = '$result' WHERE reg_id = '$regId' ";

    if (mysqli_query($conn, $gradeSql)) {
        echo "<script type='text/javascript'>alert('Student grade updated successfully');window.location.href='add_result.php';</script>";
    } else {
        echo "Error: " . $gradeSql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}

// Fetch the existing data from the database for pre-populating the form
// $regId = 11102;

// Query the database to get the existing grade and result
$existingDataSql = "SELECT grade, result FROM grade WHERE reg_id = '$regId'";
$result = mysqli_query($conn, $existingDataSql);
$row = mysqli_fetch_assoc($result);

// Close the result set
mysqli_free_result($result);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student Result</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

  <div class="container">
      <h2>Edit Student Result</h2>
      <form action="edit_result.php" method="POST"> <!-- Corrected action attribute -->
          <div class="form-group">
              <label for="reg_id">Registration ID:</label>
              <input type="text" class="form-control" id="reg_id" placeholder="Enter registration ID" name="reg_id" value="<?php echo $regId; ?>" readonly>
          </div>

          <div class="form-group">
              <label for="grade">Grade:</label>
              <input type="text" class="form-control" id="grade" placeholder="Enter grade" name="grade" value="<?php echo $row['grade']; ?>" required>
          </div>
          <div class="form-group">
              <label for="grade">Result:</label>
              <input type="text" class="form-control" id="result" placeholder="Enter result" name="result" value="<?php echo $row['result']; ?>" required>
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>

<?php 
include("../footer.php");
?>